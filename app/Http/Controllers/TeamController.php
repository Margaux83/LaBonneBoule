<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::where('is_deleted', '=', false)->paginate(10);
        return view('teams', ['teams' => $teams]);
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:5|max:255'
        ]);

        $team = new Team;
        $team->name = $request->name;
        $team->creator = auth()->user()->id;
        $team->is_deleted = false;
        $team->wins = 0;
        $team->loses = 0;
        $team->save();

        $user = auth()->user();
        $user->team_id = $team->id;
        $user->team_accepted = true;
        $user->save();

        return redirect('/teams')->with('status', 'Message posted');
    }

    public function team(Request $request)
    {
        $team_id = $request->team_id;
        $team = Team::find($team_id);
        $members = User::where('team_id', '=', $team_id)->get();
        return view('team', [
            'team' => $team,
            'members' => $members
        ]);
    }

    public function leaveTeam(Request $request)
    {
        $user = auth()->user();
        $team_id = $user->team_id;

        $user->team_id = null;
        $user->team_accepted = false;
        $user->save();

        $team = Team::find($team_id);
        $members = User::where('team_id', '=', $team_id)->get();
        $membersAccepted = User::where('team_id', '=', $team_id)->where('team_accepted', '=', true)->get();

        if (count($membersAccepted)) {
            return redirect('/team/' . $team_id);
        }

        $team->is_deleted = true;
        $team->save();
        return redirect('/teams');
    }

    public function joinTeam(Request $request)
    {
        $user = auth()->user();
        $team_id = $request->team_id;
        $user->team_id = $team_id;
        $user->team_accepted = false;
        $user->save();

        return redirect('/team/' . $team_id);
    }

    public function acceptMember(Request $request)
    {
        $team_id = auth()->user()->team_id;

        $user = User::find($request->user_id);
        $user->team_id = $team_id;
        $user->team_accepted = true;
        $user->save();
        
        return redirect('/team/' . $team_id);
    }

    public function fireMember(Request $request)
    {
        $team_id = auth()->user()->team_id;

        $user = User::find($request->user_id);
        $user->team_id = null;
        $user->team_accepted = null;
        $user->save();
        
        return redirect('/team/' . $team_id);
    }
}