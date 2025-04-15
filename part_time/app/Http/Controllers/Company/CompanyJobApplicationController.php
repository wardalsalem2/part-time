<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;
use App\Models\JobOffer;

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

            ->when($request->status, function ($q) use ($request) {
                if ($request->status == 'applied') {
                    $q->where('status', 'applied');
                } elseif ($request->status == 'pending') {
                    $q->where('status', 'pending');
                } elseif ($request->status == 'accepted') {
                    $q->where('status', 'accepted');
                } elseif ($request->status == 'rejected') {
                    $q->where('status', 'rejected');
                }
            })
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

        if ($application->status === 'applied' || $application->status === 'pending') {
            $application->update(['status' => 'accepted']);
            return redirect()->route('company.applications.show', $application->id)
                ->with('success', 'The application has been accepted.');
        }

        return redirect()->route('company.applications.show', $application->id)
            ->with('warning', 'This application cannot be accepted at this stage.');
    }

    //--------------------------------------------------------------------------------------------------

    public function reject(Request $request, $id)
    {
        $application = JobApplication::whereHas('jobOffer', fn($q) => $q->where('company_id', Auth::user()->company->id))->findOrFail($id);

        if ($request->has('confirm_reject')) {
            if ($application->status === 'applied' || $application->status === 'pending') {
                $application->update(['status' => 'rejected']);
                return redirect()->route('company.applications.show', $application->id)
                    ->with('success', 'The application has been rejected.');
            }

            return redirect()->route('company.applications.show', $application->id)
                ->with('warning', 'This application cannot be rejected at this stage.');
        }

        return back()->with('warning', 'Are you sure you want to reject this application?');
    }

    //--------------------------------------------------------------------------------------------------

    public function setPending($id)
    {
        $application = JobApplication::whereHas('jobOffer', fn($q) => $q->where('company_id', Auth::user()->company->id))->findOrFail($id);

        if ($application->status === 'applied') {
            $application->update(['status' => 'pending']);
            return redirect()->route('company.applications.show', $application->id)
                ->with('success', 'The application status has been updated to pending.');
        }

        return redirect()->route('company.applications.show', $application->id)
            ->with('warning', 'This application is already in the interview stage or has been accepted/rejected.');
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

