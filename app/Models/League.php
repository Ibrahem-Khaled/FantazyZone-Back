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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
