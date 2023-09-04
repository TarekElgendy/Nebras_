<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Section extends Model implements TranslatableContract
{

    use Translatable, HasFactory;

    protected $guarded = [];
    public $translatedAttributes = [
        'title',
        'short_description',
        'description',
        'seo_key',
        'seo_des',
    ];
    protected $appends = ['image_path', 'image_path2', 'icon'];
    public function getImagePathAttribute()
    {
        return asset('uploads/sections/' . $this->image);
    } //end of image path attribute
    public function getImagePath2Attribute()
    {
        return asset('uploads/sections/' . $this->image2);
    } //end of image path attribute

    public function getIconPathAttribute()
    {
        return asset('uploads/sections/' . $this->icon);
    } //end of image path attribute

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
