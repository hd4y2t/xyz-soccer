<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\TeamService;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    protected $teamService;

    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $results = $this->teamService->getAll();

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
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'founded_year' => 'required|integer|digits:4',
            'home_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        try {
            $team = $this->teamService->create($data, $request->file('logo'));

            return response()->json([
                'message' => 'team retrieved successfully.',
                'data'    => $team,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve teams.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        try {
            return response()->json([
                'message' => 'Team retrieved successfully.',
                'data' => $team->loadMissing('players'),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve team.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Team $team)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'founded_year' => 'nullable|integer|digits:4',
            'home_address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        try {
            $team = $this->teamService->update($team, $data, $request->file('logo'));

            return response()->json([
                'message' => 'Team updated successfully.',
                'data' => $team,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update team.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        try {
            $this->teamService->delete($team);

            return response()->json([
                'message' => 'Team deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete team.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
