<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use App\Services\TournamentService;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    protected $tournamentService;

    public function __construct(TournamentService $tournamentService)
    {
        $this->tournamentService = $tournamentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $results = $this->tournamentService->getAll();

            return response()->json([
                'message' => 'Get Data successfully.',
                'data' => $results,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Get Data Failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'home_team_id' => 'required|integer|max:255|exists:teams,id',
            'away_team_id' => 'required|integer|max:255|exists:teams,id',
            'tournament_date' => 'required|date_format:Y-m-d',
            'tournament_time' => 'required|date_format:H:i',
        ]);

        try {
            $tournament =  $this->tournamentService->create($data);

            return response()->json([
                'message' => 'tournament created successfully.',
                'data'    => $tournament,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve tournaments.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tournament $tournament)
    {
        try {
            return response()->json([
                'message' => 'Tournament retrieved successfully.',
                'data' => $tournament
                ->loadMissing([
                    'result',
                    'goals.player'
                ]),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve tournament.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Tournament $tournament, Request $request)
    {
        $data = $request->validate([
            'home_team_id' => 'nullable|integer|max:255|exists:teams,id',
            'away_team_id' => 'nullable|integer|max:255|exists:teams,id',
            'tournament_date' => 'nullable|date_format:Y-m-d',
            'tournament_time' => 'nullable|date_format:H:i',
        ]);

        try {
            $tournament = $this->tournamentService->update($tournament, $data);

            return response()->json([
                'message' => 'tournament updated successfully.',
                'data' => $tournament,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update tournament.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Tournament $tournament)
    {
        try {
            $this->tournamentService->delete($tournament);

            return response()->json([
                'message' => 'tournament deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete tournament.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
