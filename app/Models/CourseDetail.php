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

    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function admins(){
        return $this->belongsToMany(Admin::class);
    }

    public function total_payment(){
        return $this->hasOne(TotalPayment::class,'course_id');
    }

    public function paymentDetails(): HasMany
    {
        return $this->hasMany(PaymentDetail::class,'course_id');
    }

    // public function notifyCourses(): HasMany
    // {
    //     return $this->hasMany(NotifyEdu::class,'courseId');
    // }

    public function notifyEduCourses(): HasMany
    {
        return $this->hasMany(NotifyEdu::class,'courseId');
    }
    

    
}