<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $guarded = [];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }//end of order
    public function scopeotherUserId($query)
    {
        return $this->where('user_id','!=',authUser()->id);
    }
    public function scopeSameUserId($query)
    {
        return  $query->where('user_id', authUser()->id);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }




    public function user()
    {
        return $this->belongsTo(User::class);
    }//end of order
    public function getFilePathAttribute()
    {
        return asset('uploads/orders/' . $this->file);
    }

}
