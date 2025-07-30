<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goal extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'player_id',
        'tournament_id',
        'goal_time',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}
