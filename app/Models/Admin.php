<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_name',
        'admin_email',
        'admin_password',
        'adminProfileImage',
        'block_admin',
        'resetCode'
    ];

    public function educators(){
        return $this->belongsToMany(Educator::class);
    }
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function courses(){
        return $this->belongsToMany(CourseDetail::class);
    }
    public function topics(){
        return $this->belongsToMany(CourseTopic::class);
    }
}