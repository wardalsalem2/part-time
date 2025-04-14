<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\JobOffer;

class JobOffersController extends Controller
{
    public function index(Request $request)
    {
        $query = JobOffer::with('company');
            Log::info('Request Parameters:', $request->all());
    
        if ($request->has('status') && $request->status !== null && $request->status !== '') {
            // Convert status to a boolean (1 -> true, 0 -> false)
            $status = ($request->status === '1') ? true : false;
            $query->where('is_active', $status);
            Log::info('Filtering by status:', ['status' => $status]);
        }
    
        if ($request->has('company') && $request->company !== null && $request->company !== '') {
            $query->where('company_id', $request->company);
            Log::info('Filtering by company:', ['company_id' => $request->company]);
        }
    
        if ($request->has('name') && $request->name !== '') {
            $query->where('name', 'like', '%' . $request->name . '%');
            Log::info('Filtering by name:', ['name' => $request->name]);
        }
    
        $jobOffers = $query->paginate(10)->appends($request->all());
    
        Log::info('Generated SQL Query:', ['query' => $query->toSql()]);
        Log::info('Query Bindings:', ['bindings' => $query->getBindings()]);
        
        Log::info('Job Offers Count:', ['count' => $jobOffers->count()]);
    
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