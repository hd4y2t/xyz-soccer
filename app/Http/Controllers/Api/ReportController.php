<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tournament;
use Illuminate\Support\Facades\App;

class ReportController extends Controller
{
    public function __invoke(Tournament $tournament)
    {
        try {
            $data = App::make('App\Services\ReportService')
                ->getAllReports($tournament);

            return response()->json([
                'message' => 'Laporan hasil pertandingan berhasil diambil.',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Get Data Failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
