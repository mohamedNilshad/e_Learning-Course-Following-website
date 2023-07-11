<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Educator\Backend\EducatorCreateController;
use App\Http\Controllers\Educator\Frontend\navigationController;
use App\Http\Controllers\Educator\Backend\updateController;
use App\Http\Controllers\Educator\Auth\EducatorAuthController;
use App\Http\Controllers\Educator\Backend\EducatoerDeleteController;
use App\Http\Controllers\Admin\Frontend\adminNavigationController;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\Backend\adminUpdateController;
use App\Http\Controllers\Admin\Backend\AdminCreateController;
use App\Http\Controllers\Common\WithdrawalController;
use App\Http\Controllers\Common\MakePDFController;







//-----------------------------------------ADMIN---------------------------------------------------------------->

//page routs Admin
Route::get('/login-admin', [adminNavigationController::class, 'login'])->middleware('isAdminAlreadyLogedIn');
Route::get('/admin', [adminNavigationController::class, 'login'])->middleware('isAdminAlreadyLogedIn');
Route::get('/admin-home', [adminNavigationController::class, 'adminHome'])->middleware('isAdminLogedIn');
Route::get('/admin-profile', [adminNavigationController::class, 'adminProfile'])->middleware('isAdminLogedIn');

Route::get('/admin-manage', [adminNavigationController::class, 'adminManage'])->middleware('isAdminLogedIn');
Route::get('/educator-manage', [adminNavigationController::class, 'educatorManage'])->middleware('isAdminLogedIn');
Route::get('/student-manage', [adminNavigationController::class, 'studentManage'])->middleware('isAdminLogedIn');

Route::get('/pending-approval', [adminNavigationController::class, 'pendingApproval'])->middleware('isAdminLogedIn');
Route::get('/rejected-approval', [adminNavigationController::class, 'rejectedApproval'])->middleware('isAdminLogedIn');
Route::get('/published-approval', [adminNavigationController::class, 'publishedApproval'])->middleware('isAdminLogedIn');
Route::get('/deleted-approval', [adminNavigationController::class, 'deletedApproval'])->middleware('isAdminLogedIn');

Route::get('/my-wallet', [adminNavigationController::class, 'myWallet'])->middleware('isAdminLogedIn');
Route::get('/addCat', [adminNavigationController::class, 'addCatagory'])->middleware('isAdminLogedIn');

Route::get('/course-analytics', [adminNavigationController::class, 'courseAnalytics'])->middleware('isAdminLogedIn');
Route::get('/student-analytics', [adminNavigationController::class, 'studentAnalytics'])->middleware('isAdminLogedIn');
Route::get('/educator-analytics', [adminNavigationController::class, 'educatorAnalytics'])->middleware('isAdminLogedIn');

Route::get('/add-new-admin', [adminNavigationController::class, 'newAdmin'])->middleware('isAdminLogedIn');

Route::get('/pending-course-view', [adminNavigationController::class, 'courseViewPending'])->middleware('isAdminLogedIn');
Route::get('/rejected-course-view', [adminNavigationController::class, 'courseViewRejected'])->middleware('isAdminLogedIn');
Route::get('/published-course-view', [adminNavigationController::class, 'courseViewPublished'])->middleware('isAdminLogedIn');
Route::get('/deleted-course-view', [adminNavigationController::class, 'courseViewDeleted'])->middleware('isAdminLogedIn');

Route::get('/forgot-admin-password', [adminNavigationController::class, 'forgotPassword'])->name('forgot-admin-password');
Route::get('/admin-otp-code', [adminNavigationController::class, 'otpCode'])->name('admin-otp-code')->middleware('isAlreadyLogedIn');



//admin auth routs
Route::post('/login-admin', [AdminAuthController::class, 'adminLogin'])->name('login-admin');
Route::get('/logout-admin', [AdminAuthController::class, 'logoutAdmin']);
Route::post('/admin-get-otp', [AdminAuthController::class, 'generateOTP'])->name('admin-get-otp');
Route::post('/admin-verify-code', [AdminAuthController::class, 'verifyCode'])->name('admin-verify-code');


// admin update routs
Route::put('/update-admin-profile', [adminUpdateController::class, 'updateAdminProfile'])->name('update-admin-profile');

Route::get('/change-status', [adminUpdateController::class, 'updateStatus'])->name('change-status');
Route::get('/change-edu-status', [adminUpdateController::class, 'updateEduStatus'])->name('change-edu-status');
Route::get('/change-stu-status', [adminUpdateController::class, 'updateStuStatus'])->name('change-stu-status');

Route::get('/publish-course', [adminUpdateController::class, 'publishCourse'])->name('publish-course')->middleware('isAdminLogedIn');
Route::get('/reject-course', [adminUpdateController::class, 'rejectCourse'])->name('reject-course')->middleware('isAdminLogedIn');
Route::get('/delete-course', [adminUpdateController::class, 'deleteCourse'])->name('delete-course')->middleware('isAdminLogedIn');

Route::put('/admin-update-new-password', [adminUpdateController::class, 'updatePassword'])->name('admin-update-new-password');


// admin create routs
Route::post('/new-admin', [AdminCreateController::class, 'newAdmin'])->name('new-admin');
Route::post('/new-category', [AdminCreateController::class, 'newCat'])->name('new-category');




//-----------------------------------------EDUCATOR---------------------------------------------------------------->

Route::get('/', function () {
    return view('Educator/Auth/login');
});

//page routs Educator
Route::get('/login', [navigationController::class, 'login'])->middleware('isAlreadyLogedIn');
Route::get('/registration', [navigationController::class, 'registration'])->middleware('isAlreadyLogedIn');
Route::get('/otp-code', [navigationController::class, 'otpCode'])->middleware('isAlreadyLogedIn');
Route::get('/forgotPassword', [navigationController::class, 'forgotPassword'])->name('forgot-password');
Route::get('/new-password', [navigationController::class, 'newPassword'])->name('new-password');

Route::get('/home', [navigationController::class, 'home'])->middleware('isLogedIn');
Route::get('/profile', [navigationController::class, 'profile'])->middleware('isLogedIn');
Route::get('/create_new', [navigationController::class, 'createNew'])->middleware('isLogedIn');
Route::get('/notification', [navigationController::class, 'notifi'])->middleware('isLogedIn');

Route::get('/course-view', [navigationController::class, 'displayCourse'])->name('course-view')->middleware('isLogedIn');
Route::get('/report', [navigationController::class, 'reportView'])->name('report')->middleware('isLogedIn');
Route::get('/wallet', [navigationController::class, 'walletView'])->name('wallet')->middleware('isLogedIn');
Route::get('/edit-course', [navigationController::class, 'editCourse'])->name('edit-course')->middleware('isLogedIn');
Route::get('/edit-videos', [navigationController::class, 'editVideos'])->name('edit-videos')->middleware('isLogedIn');
Route::get('/add-videos', [navigationController::class, 'addVideos'])->name('add-videos')->middleware('isLogedIn');
Route::get('/educator-read-status', [navigationController::class, 'readStatus'])->name('educator-read-status');


// Route::get('/course-view', [navigationController::class, 'displayCourses'])->name('course-view');

//educator auth routs
Route::get('/logout', [EducatorAuthController::class, 'logout']);
Route::post('/register-educator', [EducatorAuthController::class, 'educatorRegister'])->name('register-educator');
Route::post('/login-educator', [EducatorAuthController::class, 'educatorLogin'])->name('login-educator');
Route::post('/verify-code', [EducatorAuthController::class, 'verifyCode'])->name('verify-code');
Route::post('/generate-code', [EducatorAuthController::class, 'generateCode'])->name('get-code');

// educator update routs
Route::put('/profile-update', [updateController::class, 'updateProfile'])->name('update-profile');
Route::put('/update-new', [updateController::class, 'updateCourse'])->name('update-new');
Route::put('/update-video', [updateController::class, 'updateVideo'])->name('update-video');
Route::put('/update-new-password', [updateController::class, 'updatePassword'])->name('update-new-password');

// educator create routs
Route::post('/create-new', [EducatorCreateController::class, 'createNew'])->name('create-new');
Route::post('/review-replay', [EducatorCreateController::class, 'replayReview'])->name('review-replay')->middleware('isLogedIn');
Route::post('/add-new-video', [EducatorCreateController::class, 'addVideo'])->name('add-new-video')->middleware('isLogedIn');

// educator delete routs
Route::get('/delete-review/{id}', [EducatoerDeleteController::class, 'deleteReview'])->name('delete-review/{id}');
Route::get('/delete-replay/{id}', [EducatoerDeleteController::class, 'deleteReplay'])->name('delete-replay/{id}');
Route::get('/delete-video/{id}', [EducatoerDeleteController::class, 'deleteVideo'])->name('delete-video/{id}');
Route::get('/delete-doc/{id}', [EducatoerDeleteController::class, 'deleteDocument'])->name('delete-doc/{id}');



//-----------------------------------------COMMON---------------------------------------------------------------->

Route::get('/EduWithdraw', [WithdrawalController::class, 'WithdrawEducator']);
Route::get('/CompWithdraw', [WithdrawalController::class, 'WithdrawCompany']);
Route::get('/genarate_pdf_educator', [MakePDFController::class, 'MakePDFEducator'])->name('genarate_pdf_educator');
Route::get('/genarate_pdf_admin', [MakePDFController::class, 'MakePDFAdmin'])->name('genarate_pdf_admin');

Route::get('/educator_payment_invoice', [MakePDFController::class, 'EducatorPayment'])->name('educator_payment_invoice');




// display routs
// Route::get('/course-page', [navigationController::class, 'displayCourse'])->name('course-page');

// Route::get('/child', [EducatorAuthController::class, 'child'])->middleware('isLogedIn');
//Route::get('/EducatorHome', [EducatorAuthController::class,'registration']);
