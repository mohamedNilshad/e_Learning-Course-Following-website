<?php

namespace App\Models;

use App\Models\CourseDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Educator extends Model
{
    use HasFactory;
    protected $fillable = [
        'educatorName',
        'educatorEmail',
        'educatorPassword',
        'educatorBio',
        'educatorProfileImage',
        'educatorCoverImage',
        'blockEducator',
        'resetCode',
    ];
    public function courseDetails(): HasMany
    {
        return $this->hasMany(CourseDetail::class);
    }
    public function admins(){
        return $this->belongsToMany(Admin::class);
    }

    public function replayReviews(): HasMany
    {
        return $this->hasMany(ReviewReplay::class,'educator_id');
    }

    public function notifyEdu(): HasMany
    {
        return $this->hasMany(NotifyEdu::class,'educatorId');
    }

   

}