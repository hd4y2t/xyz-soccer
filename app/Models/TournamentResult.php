<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TournamentResult extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tournament_id',
        'home_score',
        'away_score',
        'status',
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}
