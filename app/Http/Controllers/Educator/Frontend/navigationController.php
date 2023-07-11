<?php

namespace App\Http\Controllers\Educator\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Common\EducatorAmountDetail;
use App\Models\Common\UserPaymentDetail;
use App\Models\CourseDetail;
use App\Models\CourseReview;
use App\Models\CourseTopic;
use App\Models\DocStore;
use App\Models\Educator;
use App\Models\NotifyEdu;
use App\Models\ReviewReplay;
use App\Models\User;
use App\Models\VideoStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class navigationController extends Controller
{
    //redirect login page
    public function login()
    {
        return view('Educator.Auth.login');
    }
    //redirect register page
    public function registration()
    {
        return view('Educator.Auth.registration');
    }
    public function home()
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = Educator::where('id', '=', Session::get('loginId'))->first();
        }
        $course = CourseDetail::all()->where('educator_id', '=', $data->id)->where('deleteCourse', '=', 0);
        $notification = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('delete', '=', 0);

        $notifiCount = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('isRead', '=', 0)->where('delete', '=', 0);

        return view('Educator.index', compact('data', 'course', 'notification', 'notifiCount'));
    }

    //redirect profile page
    public function profile()
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = Educator::where('id', '=', Session::get('loginId'))->first();
        }
        $notification = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('delete', '=', 0);
        $notifiCount = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('isRead', '=', 0)->where('delete', '=', 0);

        return view('Educator.profile', compact('data', 'notification', 'notifiCount'));
    }

    public function createNew()
    {
        $data = array();
        $topic = CourseTopic::all()->where('deleteTopic', '=', 0);
        if (Session::has('loginId')) {
            $data = Educator::where('id', '=', Session::get('loginId'))->first();
        }
        $notification = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('delete', '=', 0);
        $notifiCount = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('isRead', '=', 0)->where('delete', '=', 0);

        return view('Educator.create_new', compact('data', 'topic', 'notification', 'notifiCount'));
    }

    public function notifi()
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = Educator::where('id', '=', Session::get('loginId'))->first();
        }

        $notifiCount = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('isRead', '=', 0)->where('delete', '=', 0);

        $notification = NotifyEdu::join('course_details', 'notify_edus.courseId', '=', 'course_details.id')
            ->where('notify_edus.educatorId', $data->id)
            ->where('notify_edus.delete', 0)
            ->orderBy('notify_edus.created_at', 'desc')
            ->get(['notify_edus.*', 'course_details.courseName']);

        // print_r($notifications[0]->courseName) ;
        return view('Educator.notification', compact('data', 'notification', 'notifiCount'));
    }

    public function forgotPassword()
    {
        return view('Educator.Auth.reset-password');
    }

    public function otpCode()
    {
        if (Session::has('userGmail')) {
            $educator = Educator::where('educatorEmail', '=', Session::get('userGmail'))->first();

            return view('Educator.Auth.get-code', compact('educator'));
        }
    }

    public function displayCourse(Request $request)
    {
        $id = $request->id;
        $course_data = CourseDetail::where('id', '=', $id)->first();
        $course_review = CourseReview::all()->where('course_id', '=', $id);
        $course_video = VideoStore::all()->where('course_id', '=', $id);
        //  $document = DocStore::all()->where('id', '=', $course_video->id);

        $data = array();
        if (Session::has('loginId')) {
            $data = Educator::where('id', '=', Session::get('loginId'))->first();
        }
        $review_replay = ReviewReplay::all()->where('educator_id', '=', $data->id);
        $notification = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('delete', '=', 0);
        $notifiCount = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('isRead', '=', 0)->where('delete', '=', 0);

        return view('Educator.course_display', compact('data', 'course_data', 'course_review', 'review_replay', 'course_video', 'notification', 'notifiCount'));
    }

    public function editCourse(Request $request)
    {
        $cid = $request->cid;
        $data = array();
        if (Session::has('loginId')) {
            $data = Educator::where('id', '=', Session::get('loginId'))->first();
        }
        $course = CourseDetail::where('id', '=', $cid)->first();
        $course_video = VideoStore::all()->where('course_id', '=', $course->id);
        $topic = CourseTopic::all()->where('deleteTopic', '=', 0);
        $document = DocStore::all();
        $notification = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('delete', '=', 0);
        $notifiCount = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('isRead', '=', 0)->where('delete', '=', 0);

        return view('Educator.edit_course', compact('data', 'course', 'course_video', 'topic', 'document', 'notification', 'notifiCount'));
    }

    public function editVideos(Request $request)
    {
        $cid = $request->cid;
        $data = array();
        if (Session::has('loginId')) {
            $data = Educator::where('id', '=', Session::get('loginId'))->first();
        }
        $course = CourseDetail::where('id', '=', $cid)->first();
        $video = VideoStore::all()->where('course_id', '=', $course->id);
        $topic = CourseTopic::all()->where('deleteTopic', '=', 0);
        $document = DocStore::all();
        $notification = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('delete', '=', 0);
        $notifiCount = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('isRead', '=', 0)->where('delete', '=', 0);

        return view('Educator.edit_videos', compact('data', 'course', 'video', 'topic', 'document', 'notification', 'notifiCount'));
    }

    public function addVideos(Request $request)
    {
        $cid = $request->cid;
        $data = array();
        if (Session::has('loginId')) {
            $data = Educator::where('id', '=', Session::get('loginId'))->first();
        }
        $course = CourseDetail::where('id', '=', $cid)->first();
        $notification = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('delete', '=', 0);
        $notifiCount = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('isRead', '=', 0)->where('delete', '=', 0);

        return view('Educator.add_new_course_videos', compact('data', 'course', 'notification', 'notifiCount'));
    }

    public function reportView()
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = Educator::where('id', '=', Session::get('loginId'))->first();
        }
        $notification = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('delete', '=', 0);
        $notifiCount = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('isRead', '=', 0)->where('delete', '=', 0);

        return view('Educator.report', compact('data', 'notification', 'notifiCount'));
    }

    public function walletView()
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = Educator::where('id', '=', Session::get('loginId'))->first();
        }
        $notification = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('delete', '=', 0);
        $notifiCount = NotifyEdu::all()->where('educatorId', '=', $data->id)->where('isRead', '=', 0)->where('delete', '=', 0);

        $course = CourseDetail::where('educator_id', '=', $data->id)
            ->where('publishCourse', '=', 1)
            ->where('deleteCourse', '=', 0);


        //walletInfo
        //-----------------------------LIFE TIME----------------------------------------->
        $withdrawDetails = EducatorAmountDetail::where('educator_id', '=', $data->id)->orderByDesc('created_at')->get();

        $LifetimeAmount = 0;
        $numOfCourses = [];
        $totalCourseLifeTime = 0;

        if ($withdrawDetails->count() > 0) {

            foreach ($withdrawDetails as $item) {
                $LifetimeAmount += $item->amount;
                $numOfCourses[] = $item->course_id;
            }
            $totalCourseLifeTime = count(array_unique($numOfCourses));
        }

        //-----------------------------THIS MONTH----------------------------------------->

        $last30DaysData = EducatorAmountDetail::whereDate('created_at', '>=', now()->subDays(30))
        ->where('educator_id', '=', $data->id)
        ->get();
          
            $last30DayAmount = 0;
            $numOflast30DayCourses = [];
            $totalCourselast30Day = 0;

            if ($last30DaysData->count() > 0) {

                foreach ($last30DaysData as $item30) {
                    $last30DayAmount += $item30->amount;
                    $numOflast30DayCourses[] = $item30->course_id;
                }
                $totalCourselast30Day = count(array_unique($numOflast30DayCourses));
            }
        
        //-----------------------------Available Balance----------------------------------------->

        $blanceAmountData = EducatorAmountDetail::where('withdraw', '=', 0)
        ->where('educator_id', '=', $data->id)
        ->get();
          
            $balanceAmount = 0;

            if ($blanceAmountData->count() > 0) {
                foreach ($blanceAmountData as $balItem) {
                    $balanceAmount += $balItem->amount;
                }
            }


            $cutomerData = UserPaymentDetail::join('course_details', 'user_payment_details.course_id', '=', 'course_details.id')
            ->join('users', 'user_payment_details.user_id', '=', 'users.id')
            ->where('course_details.educator_id', $data->id)
            ->orderBy('user_payment_details.created_at', 'desc')
            ->get(['user_payment_details.*', 'course_details.courseName', 'users.user_name']);
           
        
        // print( $cutomerData);
        return view('Educator.wallet', compact('data', 'course', 'notification', 'notifiCount', 'LifetimeAmount', 'totalCourseLifeTime', 'totalCourselast30Day', 'last30DayAmount', 'balanceAmount', 'cutomerData'));
    }

    public function newPassword()
    {
        return view('Educator.Auth.new_password');
    }

    public function readStatus(Request $request)
    {
        $stValue = 0;
        ($request->read == 0) ? $stValue = 1 : $stValue = 0;

        $noti = NotifyEdu::where('id', $request->nid)->update([
            'isRead' => $stValue,
        ]);
        if (!$noti) {
            return back()->with('fail', 'Error in Updating Status');
        }
        return back();
    }

    //   public function replayRew(Request $request){
    //     $rId= $request->revId;
    //     return view('Educator.review_replay',compact('rId'));

    //   }


}