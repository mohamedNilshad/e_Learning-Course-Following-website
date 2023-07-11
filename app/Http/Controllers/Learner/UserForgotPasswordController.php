<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Mail\UserPasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserForgotPasswordController extends Controller
{
    public function sendResponse($result, $code = 200)
    {
        $response = [
            'success' => true,
            'data' =>  $result,
        ];
        return response($response, $code);
    }
    public function sendError($error, $errorMessage = "Authentication failed!", $code = 401)
       {
           $response = [
               'success' => false,
               'data' => $error,
               'message' => $errorMessage,
           ];
   
           return response($response, $code);
       }


       public function verifyEmail(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('user_email', '=', $request->email)->first();

        if ($user) {
            //genarate code
            $randomNumber = random_int(1000, 9999);
            $ganaretCode = User::where('id', $user->id)->update([
                'resetCode' => $randomNumber,
            ]);

            if ($ganaretCode) {
                $isMailed = Mail::to($request->email)->send(new UserPasswordReset($randomNumber));
            }

            if ($isMailed) {
                return $this->sendResponse("We sended Reset Code to ".$request->email);
            }
            return $this->sendError(null, "Error in sending Code! try again!", 404);
        }
        return $this->sendError(null, "Email Dosen't Exist", 404);
        
    }

    public function verifyCode(Request $request)
    {

        $user = User::where('user_email', '=', $request->email)
            ->where('resetCode', '=', $request->code)
            ->first();
        if ($user) {
            return $this->sendResponse("code Verified");
        }
        return $this->sendError(null, "Invalid Code", 404);
    }

    public function setNewPassword(Request $request)
    {

        $updated = User::where('user_email', $request->email)->update([
            'user_password' => Hash::make($request->password),
            'resetCode'=> 0
        ]);
        if ($updated) {
            return $this->sendResponse("Password Updated");
        }
        return $this->sendError(null, "Password Not Updated", 404);

    }
}