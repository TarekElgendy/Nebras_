<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }//end of user

    public function scopeSameUserId($query)
    {
        return $this->where('sender_id', authUser()->id);
    }
    public function scopeActive($query)
    {
        return $this->where('status', '=','active');
    }

}
