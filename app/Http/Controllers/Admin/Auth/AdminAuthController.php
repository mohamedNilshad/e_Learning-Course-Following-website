<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AdminPasswordReset;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
     //check login
     public function adminLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('admin_email', '=', $request->email)->first();
        if ($admin) {
            if (Hash::check($request->password, $admin->admin_password)) {
                if ($admin->block_admin == 0) {
                    //return back()->with('success', 'You have Registered Successfuly');
                    $request->session()->put('adminloginId', $admin->id);
                    return redirect('admin-home');
                } else {
                    return back()->with('fail', 'You are bloked');
                }
            } else {
                return back()->with('fail', 'Invalid Password');
            }
        } else {
            return back()->with('fail', 'Email Doesn\'t Exisit');
        }
    }

    public function generateOTP(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        $admin = Admin::where('admin_email', '=', $request->email)->first();
        $randomNumber = random_int(1000, 9999);
        $ganaretCode = Admin::where('id', $admin->id)->update([
           'resetCode' => $randomNumber,
       ]);

        if ($admin) {

           $userEmail = $admin->admin_email;
           $isMailed = Mail::to($userEmail)->send(new AdminPasswordReset($randomNumber));
           if($isMailed){
               $request->session()->put('adminGmail', $admin->admin_email);
               return redirect('admin-otp-code');

           } 
            
        } else {
            return back()->with('fail', 'Email Doesn\'t Exisit');
        }
    }


    public function verifyCode(Request $request){
        $admin = Admin::where('id', '=', $request->eID)->where('resetCode', '=', $request->code)->first();
        if($admin){
            return view('Admin.Auth.new_password',compact('admin'));
        }else{
            return back()->with('fail', 'Wrong OTP');

            
        }
     }

    

    public function logoutAdmin(Request $request){
        if (Session::has('adminloginId')) {
            Session::pull('adminloginId');
            return redirect('login-admin');
        }
       
    }
}
