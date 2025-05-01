<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckIfActive;
use App\Models\Region;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', CheckIfActive::class]);
    }

    /**
     * Show the form for editing the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = auth()->user();
        $regions = Region::all();
        $stations = Station::where('region_id', $user->region_id)->get();
        
        return view('user.profile.edit', compact('user', 'regions', 'stations'));
    }

    /**
     * Update the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'personal_number' => 'required|string|max:255|unique:users,personal_number,'.$user->id,
            'region_id' => 'required|exists:regions,id',
            'station_id' => 'required|exists:stations,id',
            'designation' => 'required|in:Observer,Senior Observer',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date',
            'description' => 'nullable|string|max:500',
        ]);
        
        $user->update($validated);
        
        return redirect()->route('user.profile.edit')
            ->with('success', 'Your profile has been updated successfully.');
    }

    /**
     * Handle profile image upload.
     */
    public function updateImage(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'profile_image' => 'required|image|max:2048',
        ]);

        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }

        $path = $request->file('profile_image')->store('profile-images', 'public');
        $user->profile_image = $path;
        $user->save();

        return redirect()->route('user.profile.edit')
            ->with('success', 'Profile image updated successfully.');
    }

    /**
     * Handle profile image removal.
     */
    public function removeImage()
    {
        $user = auth()->user();

        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
            $user->profile_image = null;
            $user->save();
        }

        return redirect()->route('user.profile.edit')
            ->with('success', 'Profile image removed successfully.');
    }
}