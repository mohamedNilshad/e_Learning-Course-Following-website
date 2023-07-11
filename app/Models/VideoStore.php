<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VideoStore extends Model
{
    use HasFactory;
    protected $fillable = [
        'video_url',
        'video_title',
        'video_thumb_url',
        'video_description',
        'video_order'
    ];
    public function courseDetail(): BelongsTo
    {
        return $this->belongsTo(CourseDetail::class);
    }
    public function docStores(): HasMany
    {
        return $this->hasMany(DocStore::class);
    }
}