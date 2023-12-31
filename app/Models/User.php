<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function team()
    {
        return $this->hasMany(Team::class, 'user_id');
    }
    public function teams()
    {
        return $this->belongsToMany(Team::class, "team_users", "team_id", "user_id");
    }

    public function league()
    {
        return $this->hasMany(League::class, 'user_id');
    }
    public function teamAdmin()
    {
        return $this->belongsToMany(League::class, 'user_leagues', 'league_id', 'user_id');
    }
}
