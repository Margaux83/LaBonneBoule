<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Teamgame;
use App\Models\Tournament;
use App\Models\User;
use App\Models\Team;
use App\Models\Inventory;
use App\Models\Cup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::paginate(10);
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
            'tournament_round' => 'required|numeric|min:1',
            'team1' => 'required',
            'team2' => 'required'
        ]);

        $game = new Game;
        $game->tournament_id = $request->tournament_id;
        $game->tournament_round = $request->tournament_round;
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

    public function gameSetWinner(Request $request)
    {
        $game_id = $request->game_id;
        $winner_id = $request->team_id;

        $game = Game::find($game_id);
        $game->winner = $winner_id;
        $game->save();

        $teamgames = Teamgame::where('game_id', '=', $game_id)->get();

        foreach ($teamgames as $key => $teamgame) {
            $team = Team::find($teamgame->team_id);
            if ($teamgame->team_id === $winner_id) {
                $team->wins = $team->wins ++;
            }else {
                $team->loses = $team->loses ++;
            }
            $team->save();
        }


        if ($game->tournament_id) {
            $tournamentGames = Game::where('tournament_id', '=', $game->tournament_id)->get();

            $allFinished = true;
            foreach ($tournamentGames as $key => $tournamentGame) {
                if ($tournamentGame->winner === null) {
                    $allFinished = false;
                }
            }

            if ($allFinished) {
                $this->createNextRound($game->tournament_round, $game->tournament_id);
            }
        }
        return view('game', [
            'game' => $game,
            'teamgames' => $teamgames
        ]);
    }

    public function createNextRound($finishedRound, $tournament_id)
    {
        $games = Game::where('tournament_id', '=', $tournament_id)->where('tournament_round', '=', $finishedRound)->get();

        $gameWinners = [];
        foreach ($games as $key => $game) {
            array_push($gameWinners, $game->winner);
        }

        if (count($gameWinners) === 1) {
            $tournament = Tournament::find($tournament_id);
            $tournament->winner = $gameWinners[0];
            $tournament->save();
            
            $cups = Cup::where('tournament_id', '=', $tournament_id)->get();

            foreach ($cups as $key => $cup) {
                $cup->team_id = $gameWinners[0];
                $cup->save();
            }

            $users = User::where('team_id', '=', $gameWinners[0])->where('team_accepted', '=', true)->get();

            foreach ($users as $key => $user) {
                $inventoryCup = new Inventory;
                $inventoryCup->user_id = $user->id;
                $inventoryCup->cup_id = $cup->id;
                $inventoryCup->save();
            }
        }else {
            for ($i = 0; $i < count($gameWinners); $i += 2) {
                if (($i + 1) <= count($gameWinners)) {
                    $game = new Game;
                    $game->tournament_round = ($finishedRound + 1);
                    $game->tournament_id = $tournament_id;
                    $game->save();
                    
                    $teamGame1 = new Teamgame;
                    $teamGame1->game_id = $game->id;
                    $teamGame1->team_id = $gameWinners[$i];
                    $teamGame1->save();

                    $teamGame2 = new Teamgame;
                    $teamGame2->game_id = $game->id;
                    $teamGame2->team_id = $gameWinners[$i + 1];
                    $teamGame2->save();
                }
            }
        }
    }
}