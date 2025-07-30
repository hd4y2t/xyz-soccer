<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\PlayerService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlayerController extends Controller
{
    protected $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Team $team)
    {
        try {
            $results = $this->playerService->getAllByTeam($team);

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
    public function store(Team $team, Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => ['required', 'string', 'max:50', Rule::in(['penyerang', 'gelandang', 'bertahan', 'penjaga gawang'])],
            'shirt_number' => 'required|integer|min:1',
            'height' => 'required|integer|min:1',
            'weight' => 'required|integer|min:1',
        ]);

        try {
            $data['team_id'] = $team->id;

            $player =  $this->playerService->create($team, $data);

            return response()->json([
                'message' => 'Player created successfully.',
                'data'    => $player,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve teams.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    //MASIH ERROR SAAT UPDATE DATA, REQUEST MASIH KOSONG
    public function update(Team $team, Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'position' => ['nullable', 'string', 'max:50', Rule::in(['penyerang', 'gelandang', 'bertahan', 'penjaga gawang'])],
            'shirt_number' => 'nullable|integer|min:1',
            'height' => 'nullable|integer|min:1',
            'weight' => 'nullable|integer|min:1',
        ]);

        try {
            $player = $this->playerService->update($team, $data,$id);

            return response()->json([
                'message' => 'Player updated successfully.',
                'data' => $player,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update player.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Team $team, string $id)
    {
        try {
            $this->playerService->delete($team, $id);

            return response()->json([
                'message' => 'Player deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete player.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
