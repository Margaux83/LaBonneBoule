<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Game;

class TournamentController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::paginate(50);
        return view('tournaments', ['tournaments' => $tournaments]);
    }

    public function save(Request $request)
    {
        $tournament = new Tournament;
        $tournament->name = $request->name;
        $tournament->date_start = $request->date_start;
        $tournament->date_end = $request->date_end;
        $tournament->save();

        return redirect('/tournaments')->with('status', 'Message posted');
    }

    public function tournament(Request $request)
    {
        $tournament_id = $request->tournament_id;
        $tournament = Tournament::find($tournament_id);

        $games = Game::where('tournament_id', '=', $tournament_id)->get();

        return view('tournament', [
            'tournament' => $tournament,
            'games' => $games
        ]);
    }
}