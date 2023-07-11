<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CourseTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminCreateController extends Controller
{
    public function newAdmin(Request $request)
    {
        $profileURL = '';
        $admin = Admin::where('id', '=', $request->id)->first();

        $request->validate([
            'full_name' => 'required|string',
            'email' => 'email|unique:admins,admin_email',
            'password' => 'required|string|min:4'
        ]);

        $profileURL = 'images\Admin\Profile\profile.png';

        try {
            $admin = new Admin();
            $admin->admin_name = $request->full_name;
            $admin->admin_email = $request->email;
            $admin->admin_password = Hash::make($request->password);
            $admin->adminProfileImage = $profileURL;
            $admin->block_admin = 0;
            $response = $admin->save();

            if ($response) {
                return redirect('admin-manage')->with('success', 'New Admin Added');
            } else {
                return back()->with('fail', 'Something Wrong');
            }
        } catch (\Throwable $th) {
            return back()->with('fail', 'Error in Updating data' . $th);
        }

    }

    public function newCat(Request $request)
    {
        
        $request->validate([
            'category' => 'required|string|unique:course_topics,topic',
        ]);


        try {
            $topic = new CourseTopic();
            $topic->topic = $request->category;
            $topic->deleteTopic = 0;
            $response = $topic->save();

            if ($response) {
                return back()->with('success', 'New Admin Added');
            } else {
                return back()->with('fail', 'Something Wrong');
            }
        } catch (\Throwable $th) {
            return back()->with('fail', 'Error in Updating data' . $th);
        }

    }
}