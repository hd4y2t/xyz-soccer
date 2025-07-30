<?php

namespace App\Services;

use App\Models\Goal;
use App\Models\Tournament;
use Illuminate\Support\Facades\DB;

class ReportService
{

    public function getAllReports(Tournament $tournament)
    {
        $topScorer = Goal::select('player_id', DB::raw('count(*) as total_goals'))
            ->groupBy('player_id')
            ->orderByDesc('total_goals')
            ->with('player')
            ->first();

        return [
            'tournament' => $tournament,
            'skor_akhir' => $tournament->result->home_score . " - " . $tournament->result->away_score,
            'status_pertandingan' => $tournament->result->status,
            'top_scorer' => $topScorer ? [
                'nama' => $topScorer->player->name ?? '-',
                'jumlah_gol' => $topScorer->total_goals
            ] : null,
            'akumulasi_kemenangan' => [
                'tim_home' => $tournament->result->home_score,
                'tim_away' => $tournament->result->away_score,
            ]
        ];
    }
}
