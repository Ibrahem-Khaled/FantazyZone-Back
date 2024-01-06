<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['pivot'];


    public function users()
    {
        return $this->belongsToMany(User::class, "team_users", "user_id", "team_id");
    }
    public function league()
    {
        return $this->belongsToMany(League::class, "league_teams", "league_id", "team_id");
    }
}
