<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use App\Models\Cup;

class Tournament extends Model
{
    use HasFactory;

    public function getWinner() 
    {
        return $this->belongsTo(Team::class, 'winner', 'id');
    }
}
