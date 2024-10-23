<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class CourseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'courseName',
        'courseDescription',
        'coursePrice',
        'courseThumbnile',
        'courseViews',
        'publishCourse',
        'uploadDate',
        'deleteCourse'
    ];
    public function educator(): BelongsTo
    {
        return $this->belongsTo(Educator::class);
    }
    public function course_topic(): BelongsTo
    {
        return $this->belongsTo(CourseTopic::class);
    }
    public function videoStores(): HasMany
    {
        return $this->hasMany(VideoStore::class);
    }
    public function docStores(): HasMany
    {
        return $this->hasMany(DocStore::class);
    }

    public function courseReviews(): HasMany
    {
        return $this->hasMany(CourseReview::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function admins()
    {
        return $this->belongsToMany(Admin::class);
    }

    public function total_payment()
    {
        return $this->hasOne(TotalPayment::class, 'course_id');
    }

    public function paymentDetails(): HasMany
    {
        return $this->hasMany(PaymentDetail::class, 'course_id');
    }

    // public function notifyCourses(): HasMany
    // {
    //     return $this->hasMany(NotifyEdu::class,'courseId');
    // }

    public function notifyEduCourses(): HasMany
    {
        return $this->hasMany(NotifyEdu::class, 'courseId');
    }


    public function getAllCateories()
    {
        return CourseTopic::where('deleteTopic', '=', 0)
            ->select('id', 'topic')
            ->get();
    }

    public function getSortByCategory($id)
    {
        return CourseDetail::with(['educator:id,educatorName,educatorEmail,educatorBio,educatorProfileImage,educatorCoverImage,created_at'])
            ->where('topic_id', '=', $id)
            ->where('publishCourse', '=', 1)
            ->where('deleteCourse', '=', 0)
            ->get();
    }

    public function getUserCourse($uid)
    {
        return 'Future Implementation';
        //     $course = UserPaymentDetail::join('course_details', 'user_payment_details.course_id', '=', 'course_details.id')
        //     ->where('user_payment_details.user_id', '=', $request->id)
        //     ->orderBy('user_payment_details.created_at', 'desc')
        //     ->distinct('user_payment_details.course_id')
        //     ->get(['course_details.*']);

        // return ($course[2]->id);
    }

    public function getAllCourses()
    {
        return CourseDetail::with(['educator:id,educatorName,educatorEmail,educatorBio,educatorProfileImage,educatorCoverImage,created_at'])
            ->where('publishCourse', '=', 1)
            ->where('deleteCourse', '=', 0)
            ->get();
    }

    public function getCourse($courseId)
    {
        return CourseDetail::with(['educator:id,educatorName,educatorEmail,educatorBio,educatorProfileImage,educatorCoverImage,created_at'])
            ->where('id', '=', $courseId)
            ->first();
    }

    public function getCourseContent($courseId)
    {
        $course = CourseDetail::with(['educator' => function($query) {
                $query->select('id', 'educatorName', 'educatorProfileImage');
            }])
        ->where('id', $courseId)
        ->select('id', 'courseName', 'courseDescription', 'coursePrice', 'courseThumbnile', 'courseViews', 'uploadDate', 'educator_id') // Don't forget the foreign key 'educator_id'
        ->first();

        $course->video_list = VideoStore::where('course_id', '=', $courseId)
        ->orderBy('video_order', 'asc')
        ->get(['id', 'video_url', 'video_title', 'video_thumb_url', 'video_description', 'video_order', 'created_at', 'updated_at']);

        return $course;
    }

    public function getCourseContentDraft($courseId)
    {
        return VideoStore::where('course_id', '=', $courseId)
            ->orderBy('video_order', 'asc')
            ->get(['id', 'video_title', 'video_thumb_url', 'video_description', 'video_order', 'created_at', 'updated_at']);
    }

    public function setFavourite($courseId, $userId, $status)
    {
        return FavoriteCourse::updateOrCreate(['userId' => $userId,'courseId' => $courseId,], ['like' => $status]);
    }
    public function getFavourite($courseId, $userId)
    {
        return FavoriteCourse::where('userId', $userId)
        ->where('courseId', $courseId)
        ->where('like', 1)
        ->exists();
    }
}