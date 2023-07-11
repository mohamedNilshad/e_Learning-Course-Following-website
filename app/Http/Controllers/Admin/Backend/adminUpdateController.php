<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\CourseDetail;
use App\Models\Educator;
use App\Models\NotifyEdu;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class adminUpdateController extends Controller
{
    //updateAdminProfile
    //profile update
    public function updateAdminProfile(Request $request)
    {
        $profileURL = '';
        $admin = Admin::where('id', '=', $request->id)->first();

        $request->validate([
            'full_name' => 'required|string',
        ]);

        // return $request;

        if (($admin->admin_email) != ($request->email)) {
            $request->validate([
                'email' => 'email|unique:admins,admin_email',
            ]);
        }

        if ($request->file('profile') != '') {
            $image = $request->file('profile');
            $imageURL = $input['profileimagename'] = 'adm' . time() . '.' . $image->getClientOriginalExtension();
            $dpath = public_path('/images/Admin/Profile/');

            // if(($dpath.'/'.$imageURL)!=$educator->educatorProfileImage){
            $image->move($dpath, $input['profileimagename']);
            $profileURL = 'images/Admin/Profile/' . $imageURL;
            // }
        } else {
            $profileURL = $admin->adminProfileImage;
        }

        if ($request->password == '') {
            $newPass = $admin->admin_password;
        } else {
            $newPass = Hash::make($request->password);
        }

        try {
            Admin::where('id', $request->id)->update([
                'admin_name' => $request->full_name,
                'admin_email' => $request->email,
                'admin_password' => $newPass,
                'adminProfileImage' => $profileURL,
                'block_admin' => $admin->block_admin,
                'created_at' => $admin->created_at,
            ]);
        } catch (\Throwable $th) {
            return back()->with('fail', 'Error in Updating data' . $th);
        }
        $defaultURL = 'images\Admin\Profile\profile.png';
        $filename = $admin->adminProfileImage;
        if (($filename != $defaultURL) && ($request->file('profile') != '')) {
            unlink(public_path($filename));
        }

        return redirect('admin-profile')->with('success', 'Updated');

    }

    public function updatePassword(Request $request)
    {
        try {
            $newPass = Hash::make($request->password);
            Admin::where('id', $request->eID)->update([
                'admin_password' => $newPass,
                'resetCode' => 0,
            ]);
        } catch (\Throwable $th) {
            return back()->with('fail', 'Error in Changing Password' . $th);
        }
        return redirect('admin')->with('success', 'Password Changed');
        // return view('Educator.Auth.login');

    }


    // 
    public function updateStatus(Request $request)
    {
        $block = 0;
        $admin = Admin::where('id', '=', $request->id)->first();

        $admin->block_admin == 0 ? $block = 1 : $block = 0;

        try {
            Admin::where('id', $request->id)->update([
                'block_admin' => $block,
                'created_at' => $admin->created_at,
            ]);
        } catch (\Throwable $th) {
            return back()->with('fail', 'Error in Updating data' . $th);
        }
        return back()->with('success', 'Updated');

    }

    public function updateEduStatus(Request $request)
    {
        $block = 0;
        $educator = Educator::where('id', '=', $request->id)->first();

        $educator->blockEducator == 0 ? $block = 1 : $block = 0;

        try {
            Educator::where('id', $request->id)->update([
                'blockEducator' => $block,
                'created_at' => $educator->created_at,
            ]);
        } catch (\Throwable $th) {
            return back()->with('fail', 'Error in Updating data' . $th);
        }
        return back()->with('success', 'Updated');

    }
    public function updateStuStatus(Request $request)
    {
        $block = 0;
        $student = User::where('id', '=', $request->id)->first();

        $student->block_user == 0 ? $block = 1 : $block = 0;

        try {
            User::where('id', $request->id)->update([
                'block_user' => $block,
                'created_at' => $student->created_at,
            ]);
        } catch (\Throwable $th) {
            return back()->with('fail', 'Error in Updating data' . $th);
        }
        return back()->with('success', 'Updated');

    }

    public function publishCourse(Request $request)
    {

        if ($request->delete == 1) {
            try {
                $course = CourseDetail::where('id', $request->cid)->update([
                    'publishCourse' => 1,
                    'deleteCourse' => 0,
                ]);

                $course = CourseDetail::where('id', $request->cid)->first();

                $notify = new NotifyEdu();
                $notify->courseId = $request->cid;
                $notify->adminId = Session::get('adminloginId');
                $notify->educatorId = $course->educator_id;
                $notify->message = 'You Course ' . $course->courseName . ' is Now Published';
                $notify->isRead = 0;
                $notify->delete = 0;
                $response = $notify->save();

            } catch (\Throwable $th) {
                return back()->with('fail', 'Error in Updating data' . $th);
            }
            return redirect('deleted-approval')->with('success', 'Course Published');
        } else {
            try {
                CourseDetail::where('id', $request->cid)->update([
                    'publishCourse' => 1,
                ]);

                $course = CourseDetail::where('id', $request->cid)->first();

                $notify = new NotifyEdu();
                $notify->courseId = $request->cid;
                $notify->adminId = Session::get('adminloginId');
                $notify->educatorId = $course->educator_id;
                $notify->message = 'You Course ' . $course->courseName . ' is Now Published';
                $notify->isRead = 0;
                $notify->delete = 0;
                $response = $notify->save();


            } catch (\Throwable $th) {
                return back()->with('fail', 'Error in Updating data' . $th);
            }
            if ($request->status == 0) {
                return redirect('pending-approval')->with('success', 'Course Published');
            } elseif ($request->status == 3) {
                return redirect('rejected-approval')->with('success', 'Course Published');
            }
        }



    }
    public function rejectCourse(Request $request)
    {


        if ($request->delete == 1) {
            try {
                CourseDetail::where('id', $request->cid)->update([
                    'publishCourse' => 3,
                    'deleteCourse' => 0,
                ]);

                $course = CourseDetail::where('id', $request->cid)->first();

                $notify = new NotifyEdu();
                $notify->courseId = $request->cid;
                $notify->adminId = Session::get('adminloginId');
                $notify->educatorId = $course->educator_id;
                $notify->message = 'You Course ' . $course->courseName . ' is Rejected by admin';
                $notify->isRead = 0;
                $notify->delete = 0;
                $response = $notify->save();

            } catch (\Throwable $th) {
                return back()->with('fail', 'Error in Updating data' . $th);
            }
            return redirect('deleted-approval')->with('success', 'Course Published');
        } else {
            try {
                CourseDetail::where('id', $request->cid)->update([
                    'publishCourse' => 3,
                ]);

                $course = CourseDetail::where('id', $request->cid)->first();

                $notify = new NotifyEdu();
                $notify->courseId = $request->cid;
                $notify->adminId = Session::get('adminloginId');
                $notify->educatorId = $course->educator_id;
                $notify->message = 'You Course ' . $course->courseName . ' is Rejected by admin';
                $notify->isRead = 0;
                $notify->delete = 0;
                $response = $notify->save();

            } catch (\Throwable $th) {
                return back()->with('fail', 'Error in Updating data' . $th);
            }
            if ($request->status == 0) {
                return redirect('pending-approval')->with('success', 'Course Rejected');
            } elseif ($request->status == 1) {
                return redirect('published-approval')->with('success', 'Course Rejected');
            }
        }

    }

    public function deleteCourse(Request $request)
    {
        try {
            CourseDetail::where('id', $request->cid)->update([
                'deleteCourse' => 1,
            ]);

            $course = CourseDetail::where('id', $request->cid)->first();

            $notify = new NotifyEdu();
            $notify->courseId = $request->cid;
            $notify->adminId = Session::get('adminloginId');
            $notify->educatorId = $course->educator_id;
            $notify->message = 'You Course ' . $course->courseName . ' is Deleted by admin';
            $notify->isRead = 0;
            $notify->delete = 0;
            $response = $notify->save();

        } catch (\Throwable $th) {
            return back()->with('fail', 'Error in Updating data' . $th);
        }
        if ($request->status == 0) {
            return redirect('pending-approval')->with('success', 'Course Deleted');
        } elseif ($request->status == 1) {
            return redirect('published-approval')->with('success', 'Course Deleted');
        } elseif ($request->status == 3) {
            return redirect('rejected-approval')->with('success', 'Course Deleted');
        }

    }
}