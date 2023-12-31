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
        return $this->belongsToMany(Team::class, "league_teams", "league_id", "team_id");
    }
    public function teamAdmin()
    {
        return $this->belongsToMany(User::class, 'user_leagues', 'league_id', 'user_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
    public function match()
    {
        return $this->hasMany(Matchteam::class, 'league_id', 'id');
    }
}
