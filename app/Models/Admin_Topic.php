<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_Topic extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'topic_id',
    ];
}
