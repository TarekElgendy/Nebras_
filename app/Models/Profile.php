<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['logo_path', 'image_path', 'compLogo_path'];
    public function getcompLogoPathAttribute()
    {
        return asset('uploads/users/' . $this->compLogo);
    }
    public function getLogoPathAttribute()
    {
        return asset('uploads/users/' . $this->logo);
    }
    public function getImagePathAttribute()
    {
        return asset('uploads/users/' . $this->image);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
