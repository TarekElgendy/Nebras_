<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'title',
        'short_description',
        'description',
        'seo_key',
        'seo_des',
    ];
}
