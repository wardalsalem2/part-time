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
    $jobOffers = JobOffer::query()
        ->when($request->title, function ($query, $title) {
            return $query->where('title', 'like', "%{$title}%");
        })
        ->when($request->location, function ($query, $location) {
            return $query->where('location', 'like', "%{$location}%");
        })
        ->when($request->work_hours, function ($query, $work_hours) {
            return $query->where('work_hours', '=', $work_hours);
        })
        ->when($request->salary, function ($query, $salary) {
            return $query->where('salary', '>=', $salary);
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
