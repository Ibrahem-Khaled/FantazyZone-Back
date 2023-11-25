<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\League;
use App\Models\league_team;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index($id)
    {
        $data = Team::find($id);
        $data->users;
        return response()->json($data);
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $league = League::find($id);
        $count = $league->team->count();
        $teamNumber = $league->max_team_number;

        if ($count <= (int)$teamNumber) {
            $team =  Team::create([
                'name' => $request->name,
            ]);
            league_team::create([
                'league_id' => $id,
                'team_id' => $team->id,
            ]);

            $user = User::find($request->user_id);
            $user->update([
                'team_leader' => $team->id
            ]);

            return response()->json('created successfully');
        }
        return response()->json('UNsuccessfully');
    }


    public function userTeam($id)
    {
        $data = User::find($id);
        $data->userleader;
        return response()->json($data);
    }


    public function update(Request $request, $id)
    {
        $team = Team::find($id);
        $input = $request->all();
        $team->update($input);
        return response()->json('updated successfully');
    }
    public function delete($id)
    {
        $team = Team::find($id);
        $team->delete();
        return response()->json('delete successfully');
    }
    public function getUser($id)
    {
        $user = User::where('fn_id', $id)->get();
        return response()->json($user);
    }
    public function addUserinTeam($id, $user)
    {
        $user = User::find($user);
        $user->update([
            'team_id' => $id
        ]);
        return response('done!');
    }
}
