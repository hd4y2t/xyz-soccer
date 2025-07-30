<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'logo',
        'founded_year',
        'home_address',
        'city',
    ];

    protected $appends = ['logo_url'];

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset(Storage::url('teams/' . $this->logo));
        }

        return null;
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function homeTournaments()
    {
        return $this->hasMany(Tournament::class, 'home_team_id');
    }

    public function awayTournaments()
    {
        return $this->hasMany(Tournament::class, 'away_team_id');
    }
}
