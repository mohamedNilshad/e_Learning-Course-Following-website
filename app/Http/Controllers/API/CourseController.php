<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiBaseController;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;

class CourseController extends ApiBaseController
{
    private $courseRepository;
    public function __construct(CourseRepository $courseRepo){
        $this->courseRepository = $courseRepo;
    }

    public function getAllCategories()
    {
        try {
            $result = $this->courseRepository->getAllCategory();
          
            return $this->sendResponse($result, 'All categories were fetched successfully.');

        } catch (\Throwable $th) {
            return $this->sendError($th, 'Error in fetching all categories !');
        }
    }

    public function sortByCategory($id)
    {
        try {
            if($id == null){
                return $this->sendError('Category Id Required');
            }

            $result = $this->courseRepository->getSortByCategory($id);
    
            return $this->sendResponse($result, 'Courses were fetched successfully.');

        } catch (\Throwable $th) {
            return $this->sendError($th, 'Error in fetching courses !');
        }
    }

    public function getUserCourse($uid)
    {
        try {
            $result = $this->courseRepository->getUserCourse($uid) ?? 'Future Implementation';
            return $this->sendResponse($result, 'Courses were fetched successfully.');

        } catch (\Throwable $th) {
            return $this->sendError($th, 'Error in fetching courses !');
        }
    }

    public function getAllCourses()
    {
        try {
            $result = $this->courseRepository->getAllCourses();
        
            $result->publicPath = asset('');
            return $this->sendResponse($result, 'Courses were fetched successfully.');

        } catch (\Throwable $th) {
            return $this->sendError($th, 'Error in fetching courses !');
        }
    }

    public function getCourse($courseId)
    {
        try {
            $result = $this->courseRepository->getCourse($courseId);
            return $this->sendResponse($result, 'Course was fetched successfully.');

        } catch (\Throwable $th) {
            return $this->sendError($th, 'Error in fetching courses !');
        }
    }

    public function getCourseContentDraft($courseId)
    {
        try {
            $result = $this->courseRepository->getCourseContentDraft($courseId);
            return $this->sendResponse($result, 'Course Contents ware fetched successfully.');

        } catch (\Throwable $th) {
            return $this->sendError($th, 'Error in fetching course contents !');
        }
    }

    public function getCourseContent($courseId)
    {
        try {
            $result = $this->courseRepository->getCourseContent($courseId);
            return $this->sendResponse($result, 'Course was fetched successfully.');

        } catch (\Throwable $th) {
            return $this->sendError($th, 'Error in fetching courses !');
        }
    }

    public function setFavourite(Request $request)
    {
        try {
            $result = $this->courseRepository->setFavourite($request->courseId, $request->userId, $request->status);
            if($result){
                $value = false;
                if($result->like == 1){
                    $value = true;
                }
                return $this->sendResponse($value, 'Favourite was fetched successfully.');
            }
            return $this->sendError($result, 'Error in updating favourite !');
            
        } catch (\Throwable $th) {
            return $this->sendError($th, 'Error in updating favourite !');
        }
    }

    public function getFavourite(Request $request)
    {
        try {
            $result = $this->courseRepository->getFavourite($request->courseId, $request->userId);

            return $this->sendResponse($result, 'Favourite was fetched successfully.');
            
        } catch (\Throwable $th) {
            return $this->sendError($th, 'Error in fatching favourite !');
        }
    }



}
