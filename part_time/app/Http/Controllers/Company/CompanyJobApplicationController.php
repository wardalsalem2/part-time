<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;
use App\Models\JobOffer;

class CompanyJobApplicationController extends Controller
{
    public function index(Request $request, JobOffer $job = null)
    {

    if ($job != null) {
        // إذا تم تمرير job، نعرض فقط الطلبات الخاصة فيه
        $applications = $job->jobApplications()
            ->with(['user', 'profile'])
            ->when($request->status, function ($query) use ($request) {
                if (in_array($request->status, ['applied', 'pending', 'accepted', 'rejected'])) {
                    $query->where('status', $request->status);
                }
            })
            ->latest()
            ->get();

        return view('company.JobApplication.applications', compact('job', 'applications'));
    }

    // عرض كل الطلبات التابعة للشركة
    $applications = JobApplication::with(['jobOffer', 'profile.user'])
        ->whereHas('jobOffer', function ($q) use ($request) {
            $q->where('company_id', Auth::user()->company->id);

            if ($request->filled('search')) {
                $q->where('title', 'LIKE', '%' . $request->search . '%');
            }
        })
        ->latest()
        ->paginate(10);

    // return view('company.JobApplication.applications', compact('applications', 'job'));
}

    //--------------------------------------------------------------------------------------------------
    public function show($id)
    {
        $application = JobApplication::with(['jobOffer', 'profile.user'])
            ->whereHas('jobOffer', fn($q) => $q->where('company_id', Auth::user()->company->id))
            ->findOrFail($id);
        $job = $application->jobOffer;
        return view('company.JobApplication.show', compact(['application', 'job']));
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
//------------------ function for showing the users who applied for the job offer in the company dashboard ------------------//

    // public function applications(JobOffer $job)
    // {
    //     $applications = $job->jobApplications()->with(['user', 'profile'])->latest()->get();
    //     return view('company.JobApplication.applications', compact('job', 'applications'));
    // }

    //--------------------------------------------------------------------------------------------------

    public function destroy($id)
{
    $application = JobApplication::whereHas('jobOffer', fn($q) => 
        $q->where('company_id', Auth::user()->company->id)
    )->findOrFail($id);

    $jobId = $application->job_offer_id; // assuming this is the foreign key

    $application->delete();

    return redirect()->route('company.applications.applications', ['job' => $jobId])
        ->with('success', 'The employee has been removed from the job.');
}






}

