<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\ApiBaseController;
use App\Models\User;
use App\Repositories\AuthRepository;

use Illuminate\Http\Request;
use Auth;
use Validator;


class AuthenticationController extends ApiBaseController
{

    private $authRepository;
    public function __construct(AuthRepository $authRepo){
        $this->authRepository = $authRepo;
    }

    public function registration(Request $request)
    {
    
        $input = $request->all();
        $validators = Validator::make($input, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,user_email',
            'password' => 'required|min:4',
        ]);

        if ($validators->fails()) {
            return $this->sendError('', $validators->messages(), 400);
        }

        $name = $input['name'];
        $email = $input['email']; 
        $password = $input['password'];

        $user = $this->authRepository->registerUser($name, $email, $password);
    
        if ($user) {
            return $this->sendSuccess('Registration Successfull!');
        } else {
            return $this->sendError(null, "Registration Failed!", 404);
        }

    }

    public function login(Request $request)
    {
        $input = $request->all();
        $validators = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validators->fails()) {
            return $this->sendError('', $validators->messages(), 400);
        }

        $email = $input['email']; 
        $password = $input['password'];
        $result = $this->authRepository->loginUser($email, $password);
       
        if($result == 'blocked'){
            return $this->sendError('', 'Your Account is Blocked', 400);
        }

        if($result == 'wrong_cred'){
            return $this->sendError('', 'Invalid User Name OR Password!!');
        }

        return $this->sendResponse($result, 'Login Successfull!');
        // return $this->sendResponse($token, Auth::user(), 'Loged In Successfull!');

    }

    public function logout(Request $request) {
        // $input = $request->all();

        // $validators = Validator::make($input, [
        //     'token' => 'required'
        // ]);

        // if ($validators->fails()) {
        //     return $this->sendError('', $validators->messages(), 400);
        // }

        // $playerID = isset($input['token']) ? $input['token'] : '';

        try {

            $resp = [];
            $logged = Auth::check();
            if ($logged) {
                $resp = $request->user()->token()->revoke();
            }

            return $this->sendResponse(["isRevoked" => $resp, "loggedOut" => $logged], 'User token revoked Successfully');
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), "Internal server error", 500);
        }
    }

    public function verifyEmail(Request $request)
    {
        $input = $request->all();
      
        $validators = Validator::make($input, [
            'email' => 'required|email',
        ]);

        if ($validators->fails()) {
            return $this->sendError('', $validators->messages(), 400);
        }

        $result = $this->authRepository->verifyUser($request->email);
    
        if ($result == 'success') {
            return $this->sendSuccess("We sended Reset Code to ".$request->email);
        }

        if($result == 'error_1') {
            return $this->sendError(null, "Error in sending Code! try again!", 404);
        }

        if($result == 'error_2') {
            return $this->sendError(null, "Email Dosen't Exist", 404);
        }
    }

    public function verifyCode(Request $request)
    {
        $input = $request->all();
      
        $validators = Validator::make($input, [
            'email' => 'required|email',
            'code' => 'required|min:4',
        ]);

        if ($validators->fails()) {
            return $this->sendError('', $validators->messages(), 400);
        }

        $result = $this->authRepository->verifyOTPCode($request->email, $request->code);

        if ($result) {
            return $this->sendSuccess("code Verified");
        }
        return $this->sendError(null, "Invalid Code", 404);
    }

    public function setNewPassword(Request $request)
    {
        $input = $request->all();
        $validators = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validators->fails()) {
            return $this->sendError('', $validators->messages(), 400);
        }

        $result = $this->authRepository->setNewPasswprd($request->email, $request->password);

        if ($result) {
            return $this->sendSuccess("Password Updated");
        }
        return $this->sendError(null, "Password Not Updated", 404);
    }
}