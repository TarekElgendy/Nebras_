<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['image_path' ,'file_path'];
    public function getImagePathAttribute()
    {
        return asset('uploads/orders/' . $this->image);
    }

    public function scopeotherUserId($query)
    {
        return $this->where('user_id','!=',authUser()->id);
    }

    public function scopestatusReciveOffers($query)
    {
        return $this->where('status','=','receiveOffers');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function timelines()
    {
        return $this->hasMany(Timeline::class);
    }
    public function files()
    {
        return $this->hasMany(OrderFile::class);
    }
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

}
