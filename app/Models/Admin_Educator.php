<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_Educator extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'educator_id'
    ];
}
