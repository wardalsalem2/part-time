<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobOffer;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        $jobOffers = JobOffer::with('company')->get();
        $user = Auth::user();
    
        return view('home', compact('jobOffers', 'user'));
    }

//--------------------------------------------------------------------------------------------------


public function cancelJobApplication($id)
{
    $application = JobApplication::find($id);

    if (!$application) {
        return redirect()->back()->with('error', 'Application not found');
    }

    if ($application->profile_id !== Auth::user()->profile->id) {
        return redirect()->back()->with('error', 'You do not have permission to cancel this application');
    }

    $application->delete();
    return redirect()->back()->with('success', 'Job application canceled successfully');
}




}
