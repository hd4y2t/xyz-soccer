<?php

namespace App\Services;

use App\Models\Goal;
use App\Models\Tournament;

class TournamentResultService
{
    public function recordGoal(Tournament $tournament, array $data)
    {
        try {
            if ($tournament->result) {
                throw new \InvalidArgumentException('This tournament already has a result.');
            }

            $tournament->status = 'completed';
            $tournament->save();

            foreach ($data['goals'] as $goal) {
                Goal::create([
                    'tournament_id' => $tournament->id,
                    'player_id' => $goal['player_id'],
                    'goal_time' => $goal['goal_time'],
                ]);
            }

            $homeScore = $tournament->goals()
                ->whereHas('player.team', fn($query) => $query->where('id', $tournament->home_team_id))
                ->count();

            $awayScore = $tournament->goals()
                ->whereHas('player.team', fn($query) => $query->where('id', $tournament->away_team_id))
                ->count();

            if ($homeScore === $awayScore) {
                $resultMessage = 'Draw';
            } elseif ($homeScore > $awayScore) {
                $resultMessage = 'Tim Home Menang.';
            } else {
                $resultMessage = 'Tim Away Menang.';
            }

            $tournament->result()->create(
                [
                    'home_score' => $homeScore,
                    'away_score' => $awayScore,
                    'status' => $resultMessage,
                ]
            );

            return [
                'status' => $resultMessage,
                'home_score' => $homeScore,
                'away_score' => $awayScore,
            ];
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to record goal.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
