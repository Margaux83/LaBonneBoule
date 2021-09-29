<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ball;
use App\Models\Cup;


class Inventory extends Model
{
    use HasFactory;

    public function getBall()
    {
        return $this->belongsTo(Ball::class, 'ball_id', 'id');
    }

    public function getCup()
    {
        return $this->belongsTo(Cup::class, 'cup_id', 'id');
    }
}
