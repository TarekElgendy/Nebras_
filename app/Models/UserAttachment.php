<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAttachment extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['image_path' ,'file_path'];
    public function getFilePathAttribute()
    {
        return asset('uploads/users/files/' . $this->file);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
