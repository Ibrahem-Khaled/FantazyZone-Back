<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\League;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;

class LeaguesController extends Controller
{
    public function index($pageid)
    {
        $league = Page::find($pageid);
        $league->league;
        return response()->json($league, 200);
    }
    public function leagueTeam($id)
    {
        $league = League::find($id);
        $league->team;
        $teamsAdmins = $league->teamAdmin;
        return response()->json([
            'league' => $league,
            'adminsTeam' => $teamsAdmins,
        ]);
    }
    public function store(Request $request)
    {
        $league = League::create($request->all());
        return response()->json($league, 200);
    }

    public function getUserLeague($id)
    {
        $league = User::find($id);
        $league->league;
        return response()->json($league);
    }

    public function update(Request $request, $id)
    {
        $league = League::find($id);
        $league->update($request->all());
        return response()->json($league, 200);
    }
    public function delete(Request $request, $id)
    {
        $league = League::find($id);
        $league->delete();
        return response()->json('deleted', 200);
    }
}
