<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = 'users';
    public function username()
    {
        return 'user_email';
    }

    // Override the default column name for password
    public function getAuthPassword()
    {
        return $this->user_password;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'user_email',
        'user_password',
        'profileImage',
        'block_user',
        'resetCode',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'user_password' => 'string',
    ];

    public function paymentDetails(): HasMany
    {
        return $this->hasMany(PaymentDetail::class);
    }
    public function courseReviews(): HasMany
    {
        return $this->hasMany(CourseReview::class);
    }

    public function courses(){
        return $this->belongsToMany(CourseDetail::class);
    }

    public function admins(){
        return $this->belongsToMany(Admin::class);
    }
}
