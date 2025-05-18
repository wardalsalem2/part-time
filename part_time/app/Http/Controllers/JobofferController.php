<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    public function showhome()
    {
        $jobOffers = JobOffer::with('company')->latest()->take(3)->get();   // for showing the jop in home page
        return view('home', compact('jobOffers'));
    }
//------------------------------------------------------------------------------------------------------------------------------
public function index(Request $request)
{
    $jobOffers = JobOffer::where('is_active', true) // only show active job offers
        ->when($request->title, function ($query, $title) {
            return $query->where('title', 'like', "%{$title}%");
        })
        ->when($request->location, function ($query, $location) {
            return $query->where('location', 'like', "%{$location}%");
        })
        ->when($request->work_hours, function ($query, $work_hours) {
            // Treat work_hours as numeric range if needed
            return $query->whereBetween('work_hours', [$work_hours - 5, $work_hours + 5]);
        })
        ->when($request->salary, function ($query, $salary) {
            return $query->whereBetween('salary', [$salary - 200, $salary + 200]);
        })
        ->when($request->category, function ($query, $category) {
            return $query->where('category', $category);
        })
        ->paginate(9);

    return view('user.jobs', compact('jobOffers'));
}



//----------------------------------------------------------------------------------------------------------------------
    public function show(JobOffer $jobOffer)
    {
        return view('user.details', compact('jobOffer'));   // for  details  job 
    }
//-----------------------------------------------------------------------------------------------------------------------

}
