<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Common\UserPaymentDetail;
use App\Models\CourseDetail;
use App\Models\CourseTopic;
use App\Models\DocStore;
use App\Models\FavoriteCourse;
use App\Models\VideoStore;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class DisplayAllController extends Controller
{
    //if Response Success
    //    public function sendResponse($token, $result, $code = 200)
    //    {
    //        $response = [
    //            'success' => true,
    //            'data' => $result,
    //            'token' => $token,
    //        ];
    //        return response($response, $code);
    //    }

    public function sendContentResponse($token, $videoResult, $docResult = '', $publicPath = '', $code = 200)
    {
        $response = [
            'success' => true,
            'videoData' => $videoResult,
            'docData' => $docResult,
            'publicPath' => $publicPath,
            'token' => $token,
        ];
        return response($response, $code);
    }

    public function sendResponse($token, $result, $publicPath = '', $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'publicPath' => $publicPath,
            'token' => $token,
        ];
        return response($response, $code);
    }

    public function sendRes($result, $publicPath = '', $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
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

    public function getCourse($id)
    {

        $course = CourseDetail::where('course_details.id', $id)
            ->join('educators', 'course_details.educator_id', '=', 'educators.id')
            ->get(['course_details.*', 'educators.educatorName']);

        if ($course) {
            $pubPath = asset('');
            return $this->sendResponse(null, $course, $pubPath);
        } else {
            return $this->sendError(null, "Course not found!", 404);
        }
    }

    public function getContents($id)
    {
        // $videos = VideoStore::all()->where('course_id','=',$id);
        // $docs = DocStore::all()->where('course_id','=',$id);

        $videos = VideoStore::where('course_id', '=', $id)->get(['id', 'course_id', 'video_url', 'video_title', 'video_thumb_url', 'video_description', 'video_order']);
        $docs = DocStore::where('course_id', '=', $id)->get(['id', 'course_id', 'video_id', 'doc_url']);


        // return response('working');
        if ($videos && $docs) {

            $data = [
                'video' => $videos,
                'docs' => $docs,
            ];
            $pubPath = asset(''); //public_path();
            return $this->sendRes($data);
        } else {
            return $this->sendError(null, "Course not found!", 404);
        }

    }
    public function getMyCourse($id)
    {

        $course = UserPaymentDetail::join('course_details', 'user_payment_details.course_id', '=', 'course_details.id')
            ->where('user_payment_details.user_id', '=', $id)
            ->where('course_details.deleteCourse', '=', 0)
            ->where('course_details.publishCourse', '=', 1)
            ->orderBy('user_payment_details.created_at', 'desc')
            ->distinct('user_payment_details.course_id')
            ->get(['course_details.*']);



        if ($course) {
            $pubPath = asset(''); //public_path();
            return $this->sendResponse(null, $course, $pubPath);
        } else {
            return $this->sendError(null, "Course not found!", 404);
        }

    }

    public function showUserData($id)
    {
        $userData = User::where('id', '=', $id)->first();
        // $token = $user->createToken('courseMate')->plainTextToken;

        if ($userData) {
            $pubPath = asset(''); //public_path();
            $data = [
                'userData' => $userData,
                'publicPath' => $pubPath
            ];
            return $this->sendResponse(null, $data);
        } else {
            return $this->sendError(null, "User Data not found!", 404);
        }

    }
    public function getUserCourse(Request $request)
    {
        $course = UserPaymentDetail::join('course_details', 'user_payment_details.course_id', '=', 'course_details.id')
            ->where('user_payment_details.user_id', '=', $request->id)
            ->orderBy('user_payment_details.created_at', 'desc')
            ->distinct('user_payment_details.course_id')
            ->get(['course_details.*']);

        return ($course[2]->id);

    }

    public function myFavoriteValue(Request $request)
    {
        $result = FavoriteCourse::where('userId', '=', $request->uid)
            ->where('courseId', '=', $request->course_id)
            ->first();

        if ($result) {
            return $this->sendResponse(null, $result);
        } else {
            return $this->sendError(null, "Not found", 404);
        }
    }
    public function myFavoriteCourse(Request $request)
    {
        $course = FavoriteCourse::join('course_details', 'favorite_courses.courseId', '=', 'course_details.id')
            ->where('favorite_courses.userId', '=', $request->id)
            ->where('favorite_courses.like', '=', 1)
            ->orderBy('favorite_courses.created_at', 'desc')
            ->distinct('favorite_courses.courseId')
            ->get(['course_details.*']);


        if ($course) {
            $pubPath = asset('');
            return $this->sendResponse(null, $course, $pubPath);
        } else {
            return $this->sendError(null, "Not found", 404);
        }
    }

    public function populerCourse(Request $request)
    {
        $course = CourseDetail::join('course_topics', 'course_details.topic_id', '=', 'course_topics.id')
            ->inRandomOrder()
            ->take(4)
            ->get(['course_details.*', 'course_topics.']);


        if ($course) {
            $pubPath = asset('');
            return $this->sendResponse(null, $course, $pubPath);
        } else {
            return $this->sendError(null, "Not found", 404);
        }
    }



}

/*
GetContents(
    [
        Video(
            1, 
            video/course/17282189640.mp4, 
            intro, 
            https://storage.googleapis.com/course-mate-64355.appspot.com/video_thumbnail/17288147410.png, 
            intro
        ), 
        Video(
            2, 
            video/course/17282189641.mp4, 
            Variables, 
            https://storage.googleapis.com/course-mate-64355.appspot.com/video_thumbnail/17288147462.png, 
            Variables
        )
    ], 
    []
)