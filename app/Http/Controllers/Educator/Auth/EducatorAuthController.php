<?php

namespace App\Http\Controllers\Educator\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordReset;
use App\Models\Educator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class EducatorAuthController extends Controller
{
    //register user
    public function educatorRegister(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:educators,educatorEmail',
            'password' => 'required',
        ]);

        $educator = new Educator();
        $educator->educatorName = $request->name;
        $educator->educatorEmail = $request->email;
        $educator->educatorPassword = Hash::make($request->password);
        $educator->educatorBio = '';
        $educator->educatorProfileImage = '';
        $educator->educatorCoverImage = '';
        $educator->blockEducator = 0;
        $educator->resetCode = 0;
        $response = $educator->save();

        if ($response) {
            //return back()->with('success', 'You have Registered Successfuly');
            $request->session()->put('loginId', $educator->id);
            return redirect('home');
        } else {
            return back()->with('fail', 'Something Wrong');
        }
    }

    
    //check login
    public function educatorLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $educator = Educator::where('educatorEmail', '=', $request->email)->first();
        if ($educator) {
            if (Hash::check($request->password, $educator->educatorPassword)) {
                if ($educator->blockEducator == 0) {
                    //return back()->with('success', 'You have Registered Successfuly');
                    $request->session()->put('loginId', $educator->id);
                    return redirect('home');
                } else {
                    return back()->with('fail', 'You are bloked by admin');
                }
            } else {
                return back()->with('fail', 'Invalid Password');
            }
        } else {
            return back()->with('fail', 'Email Doesn\'t Exisit');
        }
    }

     //logout oparetaion
     public function logout()
     {
         if (Session::has('loginId')) {
             Session::pull('loginId');
             return redirect('login');
         }
     }
 
     //genarate code for password reset
     public function generateCode(Request $request){
         $request->validate([
             'email' => 'required|email',
         ]);
 
         $educator = Educator::where('educatorEmail', '=', $request->email)->first();
         $randomNumber = random_int(1000, 9999);
         $ganaretCode = Educator::where('id', $educator->id)->update([
            'resetCode' => $randomNumber,
        ]);

         if ($educator) {

            $userEmail = $educator->educatorEmail;
            $isMailed = Mail::to($userEmail)->send(new PasswordReset($randomNumber));
            if($isMailed){
                $request->session()->put('userGmail', $educator->educatorEmail);
                // return view('Educator.Auth.get-code', compact('educator'));
                return redirect('otp-code');

            }
             
         } else {
             return back()->with('fail', 'Email Doesn\'t Exisit');
         }
     }

     public function verifyCode(Request $request){
        $educator = Educator::where('id', '=', $request->eID)->where('resetCode', '=', $request->code)->first();
        if($educator){
            // $request->session()->put('loginId', $educator->id);
            return view('Educator.Auth.new_password',compact('educator'));
        }else{
            return back()->with('fail', 'Wrong OTP');
        }
     }
}
