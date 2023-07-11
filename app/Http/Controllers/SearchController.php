<?php

namespace App\Http\Controllers;

use App\Models\CourseDetail;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function sendDataResponse($token, $result, $code = 200)
    {
        $response = [
            'success' => true,
            'data' =>  $result,
            'token' => $token,
        ];
        return response($response, $code);
    }

    public function sendResponse($token, $result, $publicPath='', $code = 200)
    {
        $response = [
            'success' => true,
            'data' =>  $result,
            'publicPath'=> $publicPath,
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


    public function search($value){

        $items = CourseDetail::where(function ($query) use ($value) {
            $query->where('courseName', 'like', '%'.$value.'%')
                //   ->orWhere('courseDescription', 'like', '%'.$value.'%')
                    ->orWhere('courseDescription', 'like', '%'.$value.'%');
        })->where('publishCourse','=',1)->get();

        if($items){
            return $this->sendDataResponse(null,$items);
        }else{
            return $this->sendError(null, "Courses not found!", 404);
        }
       
    }

    public function getRelatedCourse($value){
        $items = CourseDetail::where(function ($query) use ($value) {
            $query->where('courseName', 'like', '%'.$value.'%')
                //   ->orWhere('courseDescription', 'like', '%'.$value.'%')
                    ->orWhere('courseDescription', 'like', '%'.$value.'%');
        })->where('publishCourse','=',1)->get();

        if($items){
            $pubPath =  asset('');
            return $this->sendResponse(null,$items,$pubPath);
        }else{
            return $this->sendError(null, "Courses not found!", 404);
        }
        
    }


    public function getCourse($id){
        $course = CourseDetail::where('publishCourse','=',1)->where('topic_id','=',$id)->get();
        // $token = $user->createToken('courseMate')->plainTextToken;

        if($course){
            $pubPath =  asset('');
            return $this->sendResponse(null,$course,$pubPath);
        }else{
            return $this->sendError(null, "Courses not found!", 404);
        }
        
    }
}
