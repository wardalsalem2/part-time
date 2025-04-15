<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\JobOffer;
use App\Models\JobApplication;

class JobApplicationsController extends Controller
{



    public function index(Request $request)
    {
        $status = $request->status;
        $jobOfferId = $request->job_offer_id;
        $companyId = $request->company_id;

        $applications = JobApplication::with(['profile.user', 'jobOffer.company'])
            ->when($status, fn($q) => $q->where('status', $status))
            ->when($jobOfferId, fn($q) => $q->where('job_offer_id', $jobOfferId))
            ->when($companyId, fn($q) => $q->whereHas('jobOffer', fn($q2) => $q2->where('company_id', $companyId)))
            ->latest()
            ->paginate(5);

        $jobOffers = JobOffer::all();  // Get all job offers for the filter
        $companies = Company::all();   // Get all companies for the filter

        return view('admin.job_applications.index', compact('applications', 'jobOffers', 'companies'));
    }

    //-------------------------------------------------------------------------------------------------------------------------------------------------
    public function show($id)
    {
        $application = JobApplication::with(['profile.user', 'jobOffer.company'])->findOrFail($id);
        return view('admin.job_applications.show', compact('application'));
    }
    //-------------------------------------------------------------------------------------------------------------------------------------------------
    public function toggleStatus($id)
    {
        $application = JobApplication::findOrFail($id);
    
        if ($application->status == 'pending') {
            $application->update(['status' => 'accepted']);
            return back()->with('success', 'Application accepted.');
        }
    
        if ($application->status == 'accepted') {
            $application->update(['status' => 'pending']);
            return back()->with('success', 'Application status updated to pending.');
        }
    
        if ($application->status == 'rejected') {
            $application->update(['status' => 'pending']);
            return back()->with('success', 'Application status updated to pending.');
        }
    
        return back()->with('error', 'Unable to toggle status.');
    }
    
    //-------------------------------------------------------------------------------------------------------------------------------------------------

    public function destroy($id)
    {
        $application = JobApplication::findOrFail($id);
        $application->delete();

        return redirect()->route('admin.job_applications.index')->with('success', 'Job application has been deleted.');
    }

}