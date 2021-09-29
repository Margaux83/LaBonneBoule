<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;

class Teamgame extends Model
{
    use HasFactory;

    public function getTeam()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
        
    }
}
