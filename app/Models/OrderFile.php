<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFile extends Model
{
    protected $guarded = [];
    protected $appends = [ 'file_path'];
    public function getFilePathAttribute()
    {
        return asset('uploads/orders/' . $this->file);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

