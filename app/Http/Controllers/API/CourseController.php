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
            return $this->sendResponse($result, 'Courses were fetched successfully.');

        } catch (\Throwable $th) {
            return $this->sendError($th, 'Error in fetching courses !');
        }

        if ($course) {
            $pubPath = asset(''); //public_path();
            return $this->sendResponse(null, $course, $pubPath);
        } else {
            return $this->sendError(null, "Courses not found!", 404);
        }

    }

}
