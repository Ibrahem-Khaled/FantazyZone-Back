<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function Getdata()
    {
        $users = User::get();
        $client = new Client();

        foreach ($users as $user) {
            $response = $client->get("https://fantasy.premierleague.com/api/entry/$user->fn_id");
            $data = json_decode($response->getBody());

            $user = User::find($user->id);
            $user->update([
                'name' => $data->player_first_name,
                'points' => $user->captin == 1 ? $data->summary_event_points * 2 : $data->summary_event_points,
            ]);
        }
        return response()->json('Done!');
    }

    public function user($id)
    {
        $users = User::find($id);
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $user = User::create($input);
        return response()->json([
            'data' => $user
        ]);
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $user = User::find($id);
        $user->update($input);
        return response()->json([
            'data' => $user
        ]);
    }
    public function delete(Request $request, $id)
    {
        $input = $request->all();
        $user = User::find($id);
        $user->delete($input);
        return response()->json('delete successfully');
    }

    public function whereUser($fnid)
    {
        $user = User::where('fn_id', $fnid)->get();
        return response()->json($user);
    }

    public function isCaptine(Request $request, $teamId, $userId)
    {
        $user = User::find($userId);
        if ($user->deka == 0) {
            $team = Team::findOrFail($teamId);
            $team->users()->update([
                'captin' => 0,
            ]);
            $user->update([
                'captin' => 1,
                'points' => $user->points * 2,
            ]);
            return response()->json('done');
        }
        return response()->json('لا يمكن جعل دكة كابتن');
    }
    public function isDeka(Request $request, $teamId, $userId)
    {
        $user = User::find($userId);
        if ($user->captin == 0) {
            $team = Team::findOrFail($teamId);
            $team->users()->update([
                'deka' => 0,
            ]);
            $user->update([
                'deka' => 1 ,
            ]);
            return response()->json('done');
        }
        return response()->json('لا يمكن جعل الكابتن دكة');
    }
}
