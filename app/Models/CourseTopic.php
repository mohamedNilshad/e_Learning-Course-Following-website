<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseTopic extends Model
{
    use HasFactory;
    protected $fillable = [
        'topic',
        'deleteTopic'
    ];

    public function courseDetails(): HasMany
    {
        return $this->hasMany(CourseDetail::class,'topic_id');
    }

    public function admins(){
        return $this->belongsToMany(Admin::class);
    }
}