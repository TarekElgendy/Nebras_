<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPortfolio extends Model
{

    use HasFactory;
    protected $guarded = [];

    protected $appends = ['image_path'];
    public function getImagePathAttribute()
    {
        return asset('uploads/users/' . $this->file);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
