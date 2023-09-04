<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title',
        'short_description',
        'description',
        'address',
        'seo_key',
        'seo_des',
    ];
}
