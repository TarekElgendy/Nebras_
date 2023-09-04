<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model implements TranslatableContract
{

    use Translatable;
    use HasFactory;

    protected $guarded = [];
    public $translatedAttributes = [
        'title',
        'short_description',
        'description',
        'address',
        'seo_key',
        'seo_des',
    ];
    protected $appends = ['image_path', 'image_path2', 'icon'];
    public function getImageFooterAttribute()
    {
        return asset('uploads/setting/' . $this->footer_logo);
    } //end of image path attribute
    public function getImageLogoAttribute()
    {
        return asset('uploads/setting/' . $this->logo);
    } //end of image path attribute
    public function getImageIconAttribute()
    {
        return asset('uploads/setting/' . $this->icon);
    } //end of image path attribute


}
