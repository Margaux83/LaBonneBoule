<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tournament;
use App\Models\Team;

class Game extends Model
{
    use HasFactory;

    public function getTournament() 
    {
        return $this->belongsTo(Tournament::class, 'tournament_id', 'id');
    }

    public function getWinner() 
    {
        return $this->belongsTo(Team::class, 'winner', 'id');
    }
}
