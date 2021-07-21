<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Teamgame;
use App\Models\Tournament;
use App\Models\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::paginate(20);
        return view('games', ['games' => $games]);
    }

    public function addgame() 
    {
        $teams = Team::pluck('name', 'id');
        $tournaments = Tournament::pluck('name', 'id');

        return view('addgame', [
            'teams' => $teams,
            'tournaments' => $tournaments
        ]);
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'tournament_id' => 'required',
            'team1' => 'required',
            'team2' => 'required'
        ]);


        $game = new Game;
        $game->tournament_id = $request->tournament_id;
        $game->save();

        if ($request->team1 === $request->team2) {
            return redirect('/addgame')->with('status', 'Can\'t be the same team');
        }

        $teamgame1 = new Teamgame;
        $teamgame1->game_id = $game->id;
        $teamgame1->team_id = $request->team1;
        $teamgame1->save();
        $teamgame2 = new Teamgame;
        $teamgame2->game_id = $game->id;
        $teamgame2->team_id = $request->team2;
        $teamgame2->save();

        return redirect('/games')->with('status', 'Game posted');
    }

    public function game(Request $request)
    {
        $game_id = $request->game_id;
        $game = Game::find($game_id);

        $teamgames = Teamgame::where('game_id', '=', $game_id)->get();

        return view('game', [
            'game' => $game,
            'teamgames' => $teamgames
        ]);
    }
}