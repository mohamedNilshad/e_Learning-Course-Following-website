<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'holderName',
        'cardNumber',
        'expDate',
        'cvv',
        'blockCard'
    ];
}
