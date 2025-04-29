<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile;

        if (!$profile) {
            $profile = $user->profile()->create([]);
        }
        if ($user->role->id == 1) {

            $jobApplications = $profile->jobApplications;
            return view('user.profile', compact('profile', 'jobApplications'));
        } elseif ($user->role->id == 3) {

            return view('admin.profile.profile', compact('profile')); 
        } else {
            abort(403, 'Unauthorized');
        }
    }
//----------------------------------------------------------------------------------------------------------------------------------------------
    public function edit()
    {
        $user = Auth::user();

        if (!$user->profile) {
            $user->profile()->create([]);
        }
        if ($user->role->id == 1) {

            return view('user.editProfile', ['profile' => $user->profile]);
        } elseif ($user->role->id == 3) {

            return view('admin.profile.editProfile', ['profile' => $user->profile]); 
        } else {

            abort(403, 'Unauthorized');
        }
    }

    //----------------------------------------------------------------------------------------------------------------
    public function update(Request $request)
    {
        $request->validate([
            'job_title' => 'required|string|max:255',
            'hourly_rate' => 'nullable|numeric',
            'available_hours' => 'nullable|numeric',
            'skills' => 'nullable|string',
            'experience' => 'nullable|string',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'cv' => 'nullable|mimes:pdf|max:5120',
        ]);
    
        $profile = auth()->user()->profile;
    
        if (!$profile) {
            $profile = auth()->user()->profile()->create([]);
        }
    
        // Only process image if a new one is uploaded
        if ($request->hasFile('image')) {
            if ($profile->image_path && Storage::disk('public')->exists($profile->image_path)) {
                Storage::disk('public')->delete($profile->image_path);
            }
    
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $profile->image_path = $imagePath;
        }
    
        // Only process CV if a new one is uploaded
        // if ($request->hasFile('cv')) {
        //     if ($profile->cv_path && Storage::disk('public')->exists($profile->cv_path)) {
        //         Storage::disk('public')->delete($profile->cv_path);
        //     }
    
        //     $cvPath = $request->file('cv')->store('cv_files', 'public');
        //     $profile->cv_path = $cvPath;
        // }
    
        // Update other fields
        $profile->job_title = $request->job_title;
        $profile->hourly_rate = $request->hourly_rate;
        $profile->available_hours = $request->available_hours;
        $profile->skills = $request->skills;
        $profile->experience = $request->experience;
        $profile->city = $request->city;
        $profile->country = $request->country;
        $profile->phone = $request->phone;
    
        if ($profile->save()) {
            return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->route('profile.edit')->with('error', 'There was an issue updating your profile.');
        }
    }
}



