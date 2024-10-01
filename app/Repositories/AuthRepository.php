<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\User;
use App\Mail\UserPasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Auth;

class AuthRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_name',
        'user_email',
        'user_password',
        'profileImage',
        'block_user',
        'resetCode',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function registerUser($name, $email, $password)
    {
        $userData = [
            'user_name' => $name,
            'user_email' => $email,
            'user_password' => Hash::make($password),
            'profileImage' => 'images/profile.png',
            'block_user' => '0',
            'resetCode' => '0',
        ];
        return User::create($userData);
    }

    public function loginUser($email, $password)
    {
        $user = User::where('user_email', $email)->orderBy('id', 'desc')->first();
        if ($user && Hash::check($password, $user->user_password)) {
            if ($user->block_user != 0) {
                return "blocked";
            }
            $userData = [
                'id' => $user->id,
                'userName' => $user->user_name,
                'userEmail' => $user->user_email,
                'profileImage' => $user->profileImage,
            ];

            $randomString = Str::random(30);
            $token = $user->createToken($randomString)->accessToken;
            Auth::login($user);

            return array(
                'details' => $userData,
                'token' => [
                    'access' => $token,
                    'refresh' => "",
                ],
            );
        }
        return "wrong_cred";
    }

    public function verifyUser($email)
    {
        $user = User::where('user_email', '=', $email)->first();

        if ($user) {
            //genarate code
            $randomNumber = random_int(1000, 9999);
            $ganaretCode = User::where('id', $user->id)->update([
                'resetCode' => $randomNumber,
            ]);

            if ($ganaretCode) {
                $isMailed = Mail::to($email)->send(new UserPasswordReset($randomNumber));
                if ($isMailed) {
                    return 'success';
                }
                return 'error_1';
            }
        }
        return 'error_2';
    }

    public function verifyOTPCode($email, $code)
    {
        $user = User::where('user_email', '=', $email)
            ->where('resetCode', '=', $code)
            ->update(['resetCode' => 0]);
        if ($user) {
            return true;
        }
        return false;
    }

    public function setNewPasswprd($email, $password)
    {
        $updated = User::where('user_email', $email)->update([
            'user_password' => Hash::make($password)
        ]);
        if ($updated) {
            return true;
        }
        return false;
    }
}