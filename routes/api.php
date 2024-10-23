<?php

use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\Learner\DisplayAllController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Common\PaymentController;
use App\Http\Controllers\Learner\UserUpdateController;


//New API
Route::post('registration', [AuthenticationController::class, 'registration']);
Route::post('login', [AuthenticationController::class, 'login']);
Route::post('verify_email', [AuthenticationController::class, 'verifyEmail']);
Route::post('verify_code', [AuthenticationController::class, 'verifyCode']);
Route::post('set_new_password', [AuthenticationController::class, 'setNewPassword']);

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('logout', [AuthenticationController::class, 'logout']);
    
    ///category, course
    Route::get('get_category', [CourseController::class, 'getAllCategories']);
    Route::get('sort_by_category/{id}', [CourseController::class, 'sortByCategory']);
    Route::get('get_user_courses/{id}', [CourseController::class, 'getUserCourse']);
    Route::get('get_all_courses', [CourseController::class, 'getAllCourses']);
    Route::get('get_course/{id}', [CourseController::class, 'getCourse']);
    Route::get('get_course_content_draft/{id}', [CourseController::class, 'getCourseContentDraft']);

    Route::get('get_course_content/{id}', [CourseController::class, 'getCourseContent']);
    // Route::get('getCourse/{id}', [DisplayAllController::class, 'getCourse']);
    Route::get('getAllContents/{id}', [DisplayAllController::class, 'getContents']);

    Route::post('set_favorite', [CourseController::class, 'setFavourite']);
    Route::get('get_favorite', [CourseController::class, 'getFavourite']);
    
});




//Old API----------------------------------------------------------------------------------------->
//Public Routes
// Route::post('register', [AuthenticationController::class, 'register']);
// Route::post('login', [AuthenticationController::class, 'login']);


//Forgot password User
// Route::post('verify_email', [UserForgotPasswordController::class, 'verifyEmail']);
// Route::post('verify_code', [UserForgotPasswordController::class, 'verifyCode']);
// Route::post('set_new_password', [UserForgotPasswordController::class, 'setNewPassword']);


//Protactod Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::get('getCategory', [DisplayAllController::class, 'showCategory']);
    // Route::get('getUserCourses/{id}', [DisplayAllController::class, 'getUserCourse']);

    // Route::get('sortCategory/{id}', [DisplayAllController::class, 'sortCategory']);
    // Route::get('allCourses', [DisplayAllController::class, 'showCourses']);


    // Route::get('getAllContents/{id}', [DisplayAllController::class, 'getContents']);
    Route::get('getMyCourse/{id}', [DisplayAllController::class, 'getMyCourse']);
    Route::get('getUserData/{id}', [DisplayAllController::class, 'showUserData']);
    //Route::get('getCourse/{id}', [DisplayAllController::class, 'getCourse']);


    Route::get('search/{item}', [SearchController::class, 'search']);
    Route::get('getAllCourse/{id}', [SearchController::class, 'getCourse']);
    Route::get('getRelCourse/{value}', [SearchController::class, 'getRelatedCourse']);

    Route::post('updateUserProfile', [UserUpdateController::class, 'userUpdateProfile']);
    Route::post('/profilePic', [UserUpdateController::class, 'addProfileImage']);

    //payment
    Route::post('/deposit', [PaymentController::class, 'newPayment']);

    //favorite course
    // Route::post('/favorite', [UserUpdateController::class, 'myFavorites']);
    // Route::post('/favoriteValue', [DisplayAllController::class, 'myFavoriteValue']);
    Route::get('/getFavoriteCourse/{id}', [DisplayAllController::class, 'myFavoriteCourse']);
    Route::get('/getPopulerCourses', [DisplayAllController::class, 'populerCourse']);

});