<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}