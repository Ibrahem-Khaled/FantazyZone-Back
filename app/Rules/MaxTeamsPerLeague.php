<?php

namespace App\Rules;

use App\Models\League;
use App\Models\Team;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxTeamsPerLeague implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $leagueId = request()->input('league_id');
        $maxTeamsLimit = League::find($leagueId)->max_team_number;
        $currentTeamsCount = League::find($leagueId)->team->count();
        return $currentTeamsCount < $maxTeamsLimit;

    }
    public function message()
    {
        return 'Adding this team would exceed the maximum number of teams allowed for the league.';
    }
}
