<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;

class CompanyJobApplicationController extends Controller
{
    public function index(Request $request)
    {
        $applications = JobApplication::with(['jobOffer', 'profile.user'])
            ->whereHas('jobOffer', function ($q) use ($request) {
                $q->where('company_id', Auth::user()->company->id);

                if ($request->filled('search')) {
                    $q->where('title', 'LIKE', '%' . $request->search . '%');
                }
            })
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10);

        return view('company.JobApplication.index', compact('applications'));
    }
//--------------------------------------------------------------------------------------------------
    public function show($id)
    {
        $application = JobApplication::with(['jobOffer', 'profile.user'])
            ->whereHas('jobOffer', fn($q) => $q->where('company_id', Auth::user()->company->id))
            ->findOrFail($id);

        return view('company.JobApplication.show', compact('application'));
    }
//--------------------------------------------------------------------------------------------------
    public function accept($id)
    {
        $application = JobApplication::whereHas('jobOffer', fn($q) => $q->where('company_id', Auth::user()->company->id))->findOrFail($id);
        $application->update(['status' => 'accepted']);

        return redirect()->route('company.applications.show', $application->id)
            ->with('success', 'The application has been accepted.');
    }
//--------------------------------------------------------------------------------------------------
    public function reject(Request $request, $id)
    {
        $application = JobApplication::whereHas('jobOffer', fn($q) => $q->where('company_id', Auth::user()->company->id))->findOrFail($id);
        
        if ($request->has('confirm_reject')) {
            $application->update(['status' => 'rejected']);
            return redirect()->route('company.applications.show', $application->id)
                ->with('success', 'The application has been rejected.');
        }

        return back()->with('warning', 'Are you sure you want to reject this application?');
    }
//--------------------------------------------------------------------------------------------------

    public function destroy($id)
    {
        $application = JobApplication::whereHas('jobOffer', fn($q) => $q->where('company_id', Auth::user()->company->id))->findOrFail($id);
        $application->delete();

        return redirect()->route('company.applications.index')
            ->with('success', 'The employee has been removed from the job.');
    }
}

