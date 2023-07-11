<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPaymentDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'course_id',
        'amount'
    ];
}
