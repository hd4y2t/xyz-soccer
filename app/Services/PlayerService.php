<?php

namespace App\Services;

use App\Models\Player;
use App\Models\Team;

class PlayerService
{
    /**
     * Get all players by team ID.
     */
    public function getAllByTeam(Team $team)
    {
        return $team->players()->get();
    }

    /**
     * Create a new player.
     */
    public function create(Team $team, array $data)
    {
        $exists = $team->players()
            ->where('shirt_number', $data['shirt_number'])
            ->exists();

        if ($exists) {
            throw new \Exception('Player with this shirt number already exists in the team.');
        }

        return $team->players()->create($data);
    }

    public function findById($id)
    {
        return Player::findOrFail($id);
    }


    public function update(Team $team, array $data, string $id)
    {
        $player = $team->players()->findOrFail($id);

        // Cek jika nomor baju sudah ada di tim yang sama
        if (
            isset($data['shirt_number']) && $team->players()->where('id', '!=', $id)
            ->where('shirt_number', $data['shirt_number'])
            ->exists()
        ) {
            throw new \Exception('Player with this shirt number already exists in the team.');
        }

        $player->update($data);

        return $player;
    }

    public function delete(Team $team, string $id)
    {
        $player = $team->players()->findOrFail($id);

        if ($player) {
            $player->delete();
            return true;
        }

        return false;
    }
}
