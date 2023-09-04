<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract
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
    protected $appends = ['image_path', 'image_path2', 'icon'];
    public function getImagePathAttribute()
    {
        return asset('uploads/categories/' . $this->image);
    } //end of image path attribute
    public function getImagePath2Attribute()
    {
        return asset('uploads/categories/' . $this->image2);
    } //end of image path attribute
    public function getIconPathAttribute()
    {
        return asset('uploads/categories/' . $this->icon);
    } //end of image path attribute


    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_products');
    }
}
