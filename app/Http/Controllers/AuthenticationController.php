<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Validator;


class AuthenticationController extends Controller
{
    //if Response Success
    public function sendResponse($token, $result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'token' => $token,
            'message' => $message,
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


    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,user_email',
            'password' => 'required|min:4',
        ]);

        $userData = [
            'user_name' => $fields['name'],
            'user_email' => $fields['email'],
            'user_password' => Hash::make($fields['password']),
            'profileImage'=> 'images/profile.png',
            'block_user' => '0',
            'resetCode' => '0',
        ];
        $user = User::create($userData);

        if ($user) {
            return $this->sendResponse(null, $user, 'Register Successfull!');
        } else {
            return $this->sendError(null, "Employee not found!", 404);
        }

    }


    public function login(Request $request)
    {

        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('user_email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->user_password)) {

            return $this->sendError(null, "user not found!", 404);

        } else {
            $randomString = Str::random(30);
            $token = $user->createToken($randomString)->plainTextToken;

            Auth::login($user);

            return $this->sendResponse($token, Auth::user(), 'Loged In Successfull!');

        }
    }


    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logout',
        ];
    }
}