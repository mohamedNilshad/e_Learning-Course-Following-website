<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\FavoriteCourse;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserUpdateController extends Controller
{
    public function sendResponse($token, $result, $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'token' => $token,
        ];
        return response($response, $code);
    }
    //if Response Faild
    public function sendError($error, $errorMessage = "Authentication failed!", $code = 401)
    {
        $response = [
            'success' => false,
            'data' => $error,
            'message' => $errorMessage,
        ];

        return response($response, $code);
    }
    //profile update
    public function userUpdateProfile(Request $request)
    {
        $user = User::where('id', '=', $request->id)->first();


        if ($request->name != null) {
            $request->validate([
                'name' => 'required|string',
            ]);
            $newName = $request->name;
        } else {
            $newName = $user->user_name;
        }

        if (($request->email != null)&&($request->email != $user->user_email)) {
            $request->validate([
                'email' => 'email|unique:users,user_email',
            ]);
            $newEmail = $request->email;
        } else {
            $newEmail = $user->user_email;
        }


        // if (($user->user_email) != ($request->email)) {
        //     $request->validate([
        //         'email' => 'email|unique:users,user_email',
        //     ]);
        // }

        if ($request->password == '') {
            $newPass = $user->user_password;
        } else {
            $newPass = Hash::make($request->password);
        }

        try {
            $userData = User::where('id', $request->id)->update([
                'user_name' => $newName,
                'user_email' => $newEmail,
                'user_password' => $newPass,
            ]);

        } catch (\Throwable $th) {
            return $this->sendError(null, $th, 404);
        }
        return $this->sendResponse(null, $userData);
    }

    public function addProfileImage(Request $request)
    {
        $user = User::where('id', '=', $request->id)->first();

        if ($request->file('profileImage') != '') {
            $image = $request->file('profileImage');
            $imageURL = $input['profileimagename'] = time() . '.' . $image->getClientOriginalExtension();
            $dpath = public_path('/images/profile/learner');

            if (($dpath . '/' . $imageURL) != $user->profileImage) {
                $image->move($dpath, $input['profileimagename']);
                $profileURL = 'images/profile/learner/' . $imageURL;

                try {
                    $userData = User::where('id', $request->id)->update([
                        'profileImage' => $profileURL,
                    ]);
                } catch (\Throwable $th) {
                    return $this->sendError(null, $th, 404);
                }
            }
        }

        return $this->sendResponse(null, $userData);
    }

    public function myFavorites(Request $request)
    {

       $result = FavoriteCourse::where('userId', '=', $request->uid)
       ->where('courseId', '=', $request->course_id)
       ->first();

       if($result){
            $value = 1;
            if(($result->like)==1){
                $value = 0;
            }
            $favData = FavoriteCourse::where('id', $result->id)->update([
                'like' => $value,
            ]);

            if(!$favData){
                return $this->sendError(null, "Error in Updating Favorite", 404);
            }
       }else{
        $fData = [
            'courseId' => $request->course_id,
            'userId' => $request->uid,
            'like' => 1,
        ];
        $favData = FavoriteCourse::create($fData);
        if(!$favData){
            return $this->sendError(null, "Error in Updating Favorite", 404);
        }
       }
       $newResult = FavoriteCourse::where('userId', '=', $request->uid)
       ->where('courseId', '=', $request->course_id)
       ->first();
       return $this->sendResponse(null, $newResult);
        
    }
}