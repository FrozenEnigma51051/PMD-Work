<?php

namespace App\Http\Controllers;

use App\Models\WeatherObservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WeatherObservationController extends Controller
{
    public function create()
    {
        return view('weather-observations.weather-observation-form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'location_city' => 'required|string',
            'location_state' => 'required|string',
            'time_zone' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'weather_types' => 'required|array',
            'damages' => 'nullable|array',
            'event_description' => 'nullable|string',
            'media_files' => 'nullable|array',
            'media_files.*' => 'file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240'
        ]);

        // Handle file uploads
        $mediaFiles = [];
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                $path = $file->store('weather-observations/' . Auth::id(), 'public');
                $mediaFiles[] = $path;
            }
        }

        // Create the observation
        $observation = WeatherObservation::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->username,
            'personal_number' => Auth::user()->personal_number,
            'designation' => Auth::user()->designation,
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'location_city' => $validated['location_city'],
            'location_state' => $validated['location_state'],
            'time_zone' => $validated['time_zone'],
            'event_date' => $validated['event_date'],
            'event_time' => $validated['event_time'],
            'weather_types' => $validated['weather_types'],
            'damages' => $validated['damages'] ?? [],
            'event_description' => $validated['event_description'],
            'media_files' => $mediaFiles
        ]);

        return redirect()->route('weather.observations')
            ->with('success', 'Weather observation submitted successfully!');
    }

    public function index()
    {
        $observations = Auth::user()->weatherObservations()->latest()->get();
        return view('weather-observations.index', compact('observations'));
    }
} 