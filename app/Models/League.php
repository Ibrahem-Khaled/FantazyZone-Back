<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['pivot'];

    public function team()
    {
        return $this->belongsToMany(Team::class, "league_teams", "team_id", "league_id");
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userleague()
    {
        return $this->belongsToMany(User::class, 'user_leagues', 'user_id', 'league_id');
    }
}
