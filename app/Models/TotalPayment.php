<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TotalPayment extends Model
{
    use HasFactory;

    public function courses()
    {
        return $this->belongsTo(CourseDetail::class,'course_id');
    }
}
