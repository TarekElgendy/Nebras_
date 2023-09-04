<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Brand extends Model implements TranslatableContract
{

    use Translatable;

    protected $guarded = [];
    public $translatedAttributes = [
        'title',
        'short_description',
        'description',
        'seo_key',
        'seo_des',
    ];
    protected $appends = ['image_path', 'icon'];
    public function getImagePathAttribute()
    {
        return asset('uploads/brands/' . $this->image);
    } //end of image path attribute

    public function getIconPathAttribute()
    {
        return asset('uploads/brands/' . $this->icon);
    } //end of image path attribute
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
