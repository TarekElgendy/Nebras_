<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements TranslatableContract
{
    use Translatable;

    protected $guarded = [];

    public $translatedAttributes = [
        'title', 'short_description', 'description', 'seo_key', 'seo_des',

    ];

    protected $appends = ['image_path', 'image_path2'];

    public function getImagePathAttribute()
    {
        return asset('uploads/pages/'.$this->image);
    }

 //end of image path attribute
    public function getImagePath2Attribute()
    {
        return asset('uploads/pages/'.$this->image2);
    } //end of image path attribute

    public function scopeActive($query)
    {
        return $query->where('status','active');
    } //end  of scopeActive






}
