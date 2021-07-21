<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::paginate(20);
        return view('teams', ['teams' => $teams]);
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:5|max:255'
        ]);

        $team = new Team;
        $team->name = $request->name;
        $team->wins = 0;
        $team->loses = 0;
        $team->save();

        return redirect('/teams')->with('status', 'Message posted');
    }

    public function team(Request $request)
    {
        $team_id = $request->team_id;
        $team = Team::find($team_id);
        return view('team', ['team' => $team]);
    }
}