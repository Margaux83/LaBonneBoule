<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tournament;
use App\Models\Team;

class Cup extends Model
{
    use HasFactory;

    public function getTournament() 
    {
        return $this->belongsTo(Tournament::class, 'tournament_id', 'id');
    }

    public function getTeam() 
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }
}
