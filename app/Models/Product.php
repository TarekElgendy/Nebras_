<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements TranslatableContract
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
        return asset('uploads/products/' . $this->image);
    } //end of image path attribute
    public function getIconPathAttribute()
    {
        return asset('uploads/products/' . $this->icon);
    } //end of image path attribute
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products');
    } //end of categories
    public function items()
    {
        return $this->hasMany(Productitem::class);
    } //end of items

    public function files()
    {
        return $this->hasMany(ProductFile::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function comparisons()
    {
        return $this->hasMany(Comparison::class);
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }



    public function rates()
    {
        return $this->hasMany(Rate::class);
    } //end of rates

    public function getActualPriceAttribute()
    {
        //price old_price
        $old_price=$this->old_price;
        if($this->old_price>0){
            $price=$this->price;
        }else{

            $price=$this->price;
        }
        return  $price;
    }//end of actual_price



}
