<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TournamentResultController extends Controller
{
    public function __invoke(Tournament $tournament, Request $request)
    {
        $data = $request->validate([
            'goals' => 'required|array|min:1',
            'goals.*.player_id' => 'required|exists:players,id',
            'goals.*.goal_time' => 'required|date_format:i:s',
        ]);

        try {
            DB::beginTransaction();
            $result = App::make('App\Services\TournamentResultService')
                ->recordGoal($tournament, $data);

            DB::commit();

            return response()->json([
                'message' => 'Tournament result successfully recorded.',
                'data' => $result
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to record tournament result.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
