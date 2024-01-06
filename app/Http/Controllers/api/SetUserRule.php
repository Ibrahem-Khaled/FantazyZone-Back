<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User_league;
use Illuminate\Http\Request;

class SetUserRule extends Controller
{
    public function setUserLeagueTeamLeader(Request $request)
    {
        $data = User_league::create([
            'league_id' => $request->league_id,
            'user_id' => $request->user_id,
        ]);
        return response()->json($data);
    }
}
