<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReviewReplay extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'review_id',
        'educator_id',
        'replay',
        'likes',
    ];

    public function courseReview(): BelongsTo
    {
        return $this->belongsTo(CourseReview::class,'review_id');
    }

    public function educatorReplay(): BelongsTo
    {
        return $this->belongsTo(Educator::class,'educator_id');
    }
}
