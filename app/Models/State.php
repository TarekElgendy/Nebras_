<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class State extends Model implements TranslatableContract
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
}
