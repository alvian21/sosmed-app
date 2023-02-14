<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    public function userFollower()
    {
        return $this->belongsTo(User::class);
    }

    public function userFollowing()
    {
        return $this->belongsTo(User::class,'follow_user_id','id');
    }
}
