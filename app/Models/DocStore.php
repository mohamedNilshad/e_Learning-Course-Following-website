<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocStore extends Model
{
    use HasFactory;
    protected $fillable = [
        'doc_url'
    ];
    public function videoStore(): BelongsTo{
        return $this->belongsTo(VideoStore::class);
    }

    public function Course(): BelongsTo{
        return $this->belongsTo(CourseDetail::class);
    }

}
