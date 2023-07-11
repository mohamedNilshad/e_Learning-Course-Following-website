<?php

namespace App\Http\Controllers\Admin\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Common\CompanyAmountDetail;
use App\Models\Common\UserPaymentDetail;
use App\Models\CourseDetail;
use App\Models\CourseTopic;
use App\Models\Educator;
use App\Models\VideoStore;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class adminNavigationController extends Controller
{
    public function login()
    {
        return view('Admin.Auth.login');
    }

    public function adminHome()
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }
        // $course = CourseDetail::all()->where('educator_id','=',$data->id)->where('deleteCourse','=',0);
        //    return  view('Admin.index', compact('data','course'));
        return view('Admin.index', compact('data'));
    }
    public function adminProfile()
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }
        // $course = CourseDetail::all()->where('educator_id','=',$data->id)->where('deleteCourse','=',0);
        //    return  view('Admin.index', compact('data','course'));
        return view('Admin.profile', compact('data'));

    }

    public function adminManage()
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }
        $allAdmin = Admin::all();
        return view('Admin.manage_users.manage_admin', compact('data', 'allAdmin'));
    }

    public function educatorManage()
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }
        $educator= Educator::all();
        return view('Admin.manage_users.manage_educator', compact('data','educator'));
    }

    public function studentManage()
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }
        $student = User::all();
        return view('Admin.manage_users.manage_student', compact('data','student'));
    }

    public function pendingApproval()
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }
        $course = CourseDetail::all()->where('publishCourse','=',0)->where('deleteCourse','=',0);
        return view('Admin.courses.pending_courses', compact('data','course'));
    }

    public function rejectedApproval()
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }
        $course = CourseDetail::all()->where('publishCourse','=',3)->where('deleteCourse','=',0);
        return view('Admin.courses.rejected_courses', compact('data','course'));
    }
    public function publishedApproval()
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }
        $course = CourseDetail::all()->where('publishCourse','=',1)->where('deleteCourse','=',0);
        return view('Admin.courses.published_courses', compact('data','course'));
    }
    public function deletedApproval()
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }
        $course = CourseDetail::all()->where('deleteCourse','=',1);
        return view('Admin.courses.deleted_courses', compact('data','course'));
    }

    public function myWallet()
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }
        // $course = CourseDetail::all()->where('educator_id','=',$data->id)->where('deleteCourse','=',0);
        //    return  view('Admin.index', compact('data','course'));

        //walletInfo
        //-----------------------------LIFE TIME----------------------------------------->
        $withdrawDetails = CompanyAmountDetail::orderByDesc('created_at')->get();

        $LifetimeAmount = 0;

        if ($withdrawDetails->count() > 0) {
            foreach ($withdrawDetails as $item) {
                $LifetimeAmount += $item->amount;
            }
        }

        //-----------------------------THIS MONTH----------------------------------------->

        $last30DaysData = CompanyAmountDetail::whereDate('created_at', '>=', now()->subDays(30))->get();
          
            $last30DayAmount = 0;

            if ($last30DaysData->count() > 0) {

                foreach ($last30DaysData as $item30) {
                    $last30DayAmount += $item30->amount;
                }
            }
        
        //-----------------------------Available Balance----------------------------------------->

        $blanceAmountData = CompanyAmountDetail::where('withdraw', '=', 0)
        ->get();
          
            $balanceAmount = 0;

            if ($blanceAmountData->count() > 0) {
                foreach ($blanceAmountData as $balItem) {
                    $balanceAmount += $balItem->amount;
                }
            }

            $cutomerData = UserPaymentDetail::join('course_details', 'user_payment_details.course_id', '=', 'course_details.id')
            ->join('users', 'user_payment_details.user_id', '=', 'users.id')
            ->orderBy('user_payment_details.created_at', 'desc')
            ->get(['user_payment_details.*', 'course_details.courseName', 'users.user_name']);
           
        
         return view('Admin.wallet.my_wallet', compact('data','LifetimeAmount', 'last30DayAmount', 'balanceAmount', 'cutomerData'));
    }

    public function courseAnalytics()
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }
        // $course = CourseDetail::all()->where('educator_id','=',$data->id)->where('deleteCourse','=',0);
        //    return  view('Admin.index', compact('data','course'));
        return view('Admin.analytics.course_analytics', compact('data'));
    }

    public function addCatagory()
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }
        // $course = CourseDetail::all()->where('educator_id','=',$data->id)->where('deleteCourse','=',0);
        //    return  view('Admin.index', compact('data','course'));
        return view('Admin.add_catagory', compact('data'));
    }


    public function studentAnalytics()
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }
        // $course = CourseDetail::all()->where('educator_id','=',$data->id)->where('deleteCourse','=',0);
        //    return  view('Admin.index', compact('data','course'));
        return view('Admin.analytics.student_analytics', compact('data'));
    }

    public function educatorAnalytics()
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }
        // $course = CourseDetail::all()->where('educator_id','=',$data->id)->where('deleteCourse','=',0);
        //    return  view('Admin.index', compact('data','course'));
        return view('Admin.analytics.educator_analytics', compact('data'));
    }

    public function newAdmin()
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }
        // $course = CourseDetail::all()->where('educator_id','=',$data->id)->where('deleteCourse','=',0);
        //    return  view('Admin.index', compact('data','course'));
        return view('Admin.manage_users.admin_manage.add_new_admin', compact('data'));
    }

    public function courseViewPending(Request $request)
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }

        // return $request->id;
        $course = CourseDetail::where('id','=',$request->id)->first();
        $topic = CourseTopic::all()->where('deleteTopic', '=', 0);
        $course_video = VideoStore::all()->where('course_id', '=', $request->id);

        return view('Admin.courses.pending_courses_view', compact('data','course','topic','course_video'));
    }
    public function courseViewRejected(Request $request)
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }

        // return $request->id;
        $course = CourseDetail::where('id','=',$request->id)->first();
        $topic = CourseTopic::all()->where('deleteTopic', '=', 0);
        $course_video = VideoStore::all()->where('course_id', '=', $request->id);

        return view('Admin.courses.rejected_courses_view', compact('data','course','topic','course_video'));
    }
    
    public function courseViewPublished(Request $request)
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }

        // return $request->id;
        $course = CourseDetail::where('id','=',$request->id)->first();
        $topic = CourseTopic::all()->where('deleteTopic', '=', 0);
        $course_video = VideoStore::all()->where('course_id', '=', $request->id);

        return view('Admin.courses.published_courses_view', compact('data','course','topic','course_video'));
    }

    public function courseViewDeleted(Request $request)
    {
        $data = array();

        if (Session::has('adminloginId')) {
            $data = Admin::where('id', '=', Session::get('adminloginId'))->first();
        }

        // return $request->id;
        $course = CourseDetail::where('id','=',$request->id)->first();
        $topic = CourseTopic::all()->where('deleteTopic', '=', 0);
        $course_video = VideoStore::all()->where('course_id', '=', $request->id);

        return view('Admin.courses.deleted_courses_view', compact('data','course','topic','course_video'));
    }

    public function forgotPassword()
    {
        return view('Admin.Auth.get_email');

    }

    public function otpCode()
    {
        if(Session::has('adminGmail')){
            $admin = Admin::where('admin_email', '=', Session::get('adminGmail'))->first();
             return view('Admin.Auth.admin_get_code', compact('admin'));
        }
    }



}