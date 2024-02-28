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


        if ($league->status == 'kass') {
            $league = League::find($id);
            $teams = $league->team()->pluck('teams.id')->toArray();
            $teamCount = count($teams);

            while ($teamCount > 1) {
                $team1Key = array_rand($teams);
                $team1 = $teams[$team1Key];
                unset($teams[$team1Key]);
                shuffle($teams);
                $team2 = reset($teams);
                DB::table('matchteams')->insert([
                    'team1_id' => $team1,
                    'team2_id' => $team2,
                    'league_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $teamCount--;
                if ($teamCount > 1) {
                    unset($teams[array_search($team2, $teams)]);
                    $teamCount--;
                }
            }
            return response()->json('success match kass created');
        } else if ($league->status == 'league') {
            $teams = $league->team()->pluck('teams.id')->toArray();
            shuffle($teams); // Shuffle the team IDs randomly

            $rounds = [];
            $numTeams = count($teams);
            $currentRound = 1;

            // Generate rounds of matches
            for ($round = 1; $round < $numTeams; $round++) {
                $matches = [];
                for ($i = 0; $i < $numTeams / 2; $i++) {
                    $matches[] = [
                        'team1_id' => $teams[$i],
                        'team2_id' => $teams[$numTeams - 1 - $i],
                        'league_id' => $id,
                        'round_number' => $currentRound, // Add round number
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                $rounds[$currentRound] = $matches;
                $currentRound++;

                // Rotate the team IDs for the next round
                $lastTeam = array_pop($teams);
                array_splice($teams, 1, 0, $lastTeam);
            }

            // Insert matches into the database for each round
            foreach ($rounds as $roundNumber => $roundMatches) {
                foreach ($roundMatches as $match) {
                    DB::table('matchteams')->insert($match);
                }
            }

            return response()->json('Success! Random matches divided into rounds created.');

        } else {
            return response()->json('success match league created');
        }
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
