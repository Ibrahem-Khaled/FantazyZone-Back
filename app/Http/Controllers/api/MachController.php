<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\League;
use App\Models\Matchteam;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MachController extends Controller
{
    public function handle($id)
    {
        $league = League::find($id);
        $teams = $league->team->pluck('id');
        $teamCount = count($teams);

        // Randomly distribute the matches
        for ($i = 0; $i < $teamCount - 1; $i++) {
            for ($j = $i + 1; $j < $teamCount; $j++) {
                DB::table('matchteams')->insert([
                    'team1_id' => $teams[$i],
                    'team2_id' => $teams[$j],
                    'league_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('matchteams')->insert([
                    'team1_id' => $teams[$j],
                    'team2_id' => $teams[$i],
                    'league_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        return response()->json('succc');
    }
    public function goOnly($id)
    {
        $league = League::find($id);
        $teams = $league->teams()->pluck('id')->toArray();
        $teamCount = count($teams);
    
        // Generate matches until only one team remains active
        while ($teamCount > 1) {
            // Randomly select two teams from active teams
            $team1Key = array_rand($teams);
            $team1 = $teams[$team1Key];
            unset($teams[$team1Key]);
    
            $team2Key = array_rand($teams);
            $team2 = $teams[$team2Key];
            unset($teams[$team2Key]);
    
            // Insert match into the database
            DB::table('matchteams')->insert([
                'team1_id' => $team1,
                'team2_id' => $team2,
                'league_id' => $id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            $teamCount -= 2; // Two teams participated in this match
        }
    
        return response()->json('success');
    }
    

    public function teamsMatch($id)
    {
        $teams = League::find($id)->match;
        $result = [];
        foreach ($teams as $team) {
            $Team_A = Team::find($team->team1_id);
            $Team_B = Team::find($team->team2_id);
            $result[] = [
                'team1' => $Team_A,
                'team2' => $Team_B,
            ];
        }
        return response()->json($result);
    }
}
