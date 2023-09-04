<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['image_path'];
    public function getImagePathAttribute()
    {
        return asset('uploads/users/' . $this->image);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function portfolios()
    {
        return $this->hasMany(UserPortfolio::class);
    }
    public function attachments()
    {
        return $this->hasMany(UserAttachment::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function userMajors()
    {
        return $this->hasMany(UserMajor::class);
    }
    public function rates()
    {
        return $this->hasMany(Review::class);
    }

    public function comparisons()
    {
        return $this->hasMany(Comparison::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->format('M . d, Y ');
    }
}
