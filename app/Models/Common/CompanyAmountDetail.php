<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAmountDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'educator_id',
        'course_id',
        'amount',
        'withdraw'
    ];
}
