<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\JobOffer;

class JobOffersController extends Controller
{
public function index(Request $request)
{
    $query = JobOffer::with('company');

    if ($request->has('status') && $request->status !== '') {
        $query->where('is_active', $request->status);
    }

    if ($request->has('company') && $request->company !== '') {
        $query->where('company_id', $request->company);
    }

    $jobOffers = $query->paginate(10);
    $companies = Company::all();

    return view('admin.job_offers.index', compact('jobOffers', 'companies'));
}

//--------------------------------------------------------------------------------------------------------------------

public function show($id)
{
    $job = JobOffer::with('company')->findOrFail($id);
    return view('admin.job_offers.show', compact('job'));
}

// ----------------------------------------------------------------------------------------------------


public function destroy($id)
{
    $job = JobOffer::findOrFail($id);
    $job->delete();

    return redirect()->route('admin.job_offers.index')->with('success', 'Job offer deleted successfully.');
}






public function toggleStatus($id)
{
    $jobOffer = JobOffer::findOrFail($id);

    $jobOffer->is_active = !$jobOffer->is_active; // يقلب القيمة
    $jobOffer->save();

    $status = $jobOffer->is_active ? 'activated' : 'deactivated';

    return back()->with('success', "Job offer has been {$status}.");
}




}