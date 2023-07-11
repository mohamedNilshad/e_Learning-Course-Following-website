<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotifyEdu extends Model
{
    use HasFactory;

    protected $fillable = [
        'educatorName',
        'courseId',
        'adminId',
        'educatorId',
        'adminId',
        'message',
        'isRead',
        'delete'
    ]; 

    public function educatorNotify(): BelongsTo
    {
        return $this->belongsTo(Educator::class);
    }

    public function courseNotifyEdu(): BelongsTo
    {
        return $this->belongsTo(CourseDetail::class);
    }
}
