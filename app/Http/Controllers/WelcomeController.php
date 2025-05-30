<?php

namespace App\Http\Controllers;

use App\Models\WeatherObservation;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Show the welcome page with latest approved weather observations.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get latest approved weather observations (limit to 6 for display)
        $latestReports = WeatherObservation::where('status', 'approved')
            ->latest('updated_at')
            ->limit(6)
            ->get();

        return view('welcome', compact('latestReports'));
    }

    /**
     * Get weather observation details for modal.
     *
     * @param  \App\Models\WeatherObservation  $observation
     * @return \Illuminate\Http\JsonResponse
     */
    public function getObservationDetails(WeatherObservation $observation)
    {
        // Only show approved observations
        if ($observation->status !== 'approved') {
            abort(404);
        }

        return response()->json([
            'success' => true,
            'observation' => $observation
        ]);
    }
} 