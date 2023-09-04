<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{

    protected $guarded = [];

    protected $appends = ['image_path', 'icon'];
    public function getImagePathAttribute()
    {
        return asset('uploads/ads/' . $this->image);
    } //end of image path attribute

    public function getIconPathAttribute()
    {
        return asset('uploads/ads/' . $this->icon);
    } //end of image path attribute
}
