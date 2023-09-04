<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Productitem extends Model implements TranslatableContract
{

    use Translatable;
    use HasFactory;


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
        return asset('uploads/products/' . $this->image);
    } //end of image path attribute
    public function getImagePath2Attribute()
    {
        return asset('uploads/products/' . $this->image2);
    } //end of image path attribute
    public function product()
    {
        return $this->belongsTo(Product::class);
    } //end of product
}
