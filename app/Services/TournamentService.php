<?php

namespace App\Services;

use App\Models\Tournament;
use Illuminate\Database\Eloquent\Collection;

class TournamentService
{
    public function getAll(): Collection
    {
        return Tournament::query()
            ->with([
                'homeTeam',
                'awayTeam',
                'result',
            ])->get();
    }

    public function create(array $data): Tournament
    {
        if ($data['home_team_id'] === $data['away_team_id']) {
            throw new \InvalidArgumentException('Home team and away team cannot be the same.');
        }

        $existingTournament = Tournament::where('tournament_date', $data['tournament_date'])
            ->where('tournament_time', $data['tournament_time'])
            ->exists();

        if ($existingTournament) {
            throw new \InvalidArgumentException('A tournament already exists at this date and time.');
        }

        // // cek team tersebut wajib memiliki minimal 11 pemain
        // $homeTeam = App::TeamService()->findById($data['home_team_id']);
        // $awayTeam = App::TeamService()->findById($data['away_team_id']);

        // if ($homeTeam->players()->count() < 11) {
        //     throw new \InvalidArgumentException('Home team must have at least eleven players.');
        // }

        // if ($awayTeam->players()->count() < 11) {
        //     throw new \InvalidArgumentException('Away team must have at least eleven players.');
        // }

        $data['status'] = 'scheduled';

        return Tournament::create($data);
    }

    public function findById($id)
    {
        return Tournament::query()
            ->with([
                'homeTeam',
                'awayTeam',
                'result',
                'goals.player'
            ])
            ->findOrFail($id);
    }


    public function update(Tournament $tournament, array $data): Tournament
    {
        //tim tidak boleh sama
        if ($data['home_team_id'] === $data['away_team_id']) {
            throw new \InvalidArgumentException('Home team and away team cannot be the same.');
        }

        if (
            $tournament->tournament_date === now()->format('Y-m-d') &&
            $tournament->tournament_time === now()->format('H:i')
        ) {
            throw new \InvalidArgumentException('Cannot update a tournament that is currently ongoing.');
        }

        if ($tournament->result) {
            throw new \InvalidArgumentException('Cannot update a tournament that has already been played.');
        }

        $existingTournament = Tournament::where('tournament_date', $data['tournament_date'])
            ->where('tournament_time', $data['tournament_time'])
            ->where('id', '!=', $tournament->id)
            ->exists();

        if ($existingTournament) {
            throw new \InvalidArgumentException('A tournament already exists at this date and time.');
        }
        $tournament->update($data);
        return $tournament;
    }

    public function delete(Tournament $tournament): void
    {
        if (
            $tournament->tournament_date === now()->format('Y-m-d') &&
            $tournament->tournament_time === now()->format('H:i')
        ) {
            throw new \InvalidArgumentException('Cannot delete a tournament that is currently ongoing.');
        }

        if ($tournament->result) {
            throw new \InvalidArgumentException('Cannot delete a tournament that has already been completed.');
        }

        $tournament->delete();
    }
}
