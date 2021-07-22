<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Teamgame;

class TournamentController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::paginate(20);
        return view('tournaments', ['tournaments' => $tournaments]);
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:5|max:255',
            'date_start' => 'required' ,
            'date_end' => 'required' 
        ]);

        $tournament = new Tournament;
        $tournament->name = $request->name;
        $tournament->date_start = $request->date_start;
        $tournament->date_end = $request->date_end;
        $tournament->save();

        return redirect('/tournaments')->with('status', 'Message posted');
    }

    public function tournament(Request $request) {
        $tournament_id = $request->tournament_id;
        return $this->tournamentFromId($tournament_id);
    }

    public function tournamentFromId($tournament_id)
    {
        $tournament = Tournament::find($tournament_id);

        $games = Game::where('tournament_id', '=', $tournament_id)->get();

        $tournamentMaxRound = 1;
        foreach ($games as $key => $game) {
            if ($game->tournament_round > $tournamentMaxRound) {
                $tournamentMaxRound = $game->tournament_round;
            }
        }

        return view('tournament', [
            'tournament' => $tournament,
            'tournamentMaxRound' => $tournamentMaxRound,
            'games' => $games
        ]);
    }

    public function messages()
    {
        return [
            'name.required' => 'Un nom est nécessaire',
            'name.min' => 'Le nom doit faire au moins 5 caractères',
            'name.max' => 'Le nom doit faire au maximum 255 caractères',
            'date_start.required' => 'Une date est nécessaire',
            'date_end.required' => 'Une date est nécessaire',
        ];
    }
}