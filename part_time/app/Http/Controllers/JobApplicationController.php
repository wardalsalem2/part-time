<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\JobOffer;
use App\Models\Notification; 
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function create($id)
    {
        $jobOffer = JobOffer::findOrFail($id);
        return view('user.apply', compact('jobOffer'));
    }

    //-----------------------------------------------------------------------------------------------------------
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_offer_id' => 'required|exists:job_offers,id',
            'cover_letter' => 'required|string',
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        } else {
            return back()->with('error', 'Resume file is required.');
        }

        if (!Auth::user()->profile) {
            return back()->with('error', 'Profile not found. Please complete your profile.');
        }

        $application = JobApplication::create([
            'profile_id' => Auth::user()->profile->id,
            'job_offer_id' => $request->job_offer_id,
            'cover_letter' => $request->cover_letter,
            'resume' => $resumePath,
            'status' => 'applied',
        ]);

        //------------- Notification -------------------
        $jobOffer = JobOffer::find($request->job_offer_id); 
        Notification::create([
            'company_id' => $jobOffer->company_id,
            'job_offer_id' => $jobOffer->id,
            'user_id' => Auth::id(),
            'message' => Auth::user()->name . ' applay to ' . $jobOffer->title,
        ]);


        return $application
            ? redirect()->route('profile.show')->with('success', 'Application submitted successfully! Please wait for an email from the company.')
            : back()->with('error', 'Failed to submit application.');
    }
}
