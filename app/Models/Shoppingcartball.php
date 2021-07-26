<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ball;

class Shoppingcartball extends Model
{
    use HasFactory;

    public function getBall()
    {
        return $this->belongsTo(Ball::class, 'ball_id', 'id');
    }
}
