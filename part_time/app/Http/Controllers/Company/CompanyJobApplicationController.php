<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;
use App\Models\JobOffer;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationReplyMail;
use Illuminate\Support\Facades\Log;

class CompanyJobApplicationController extends Controller
{
    public function index(Request $request, JobOffer $job = null)
    {
        if ($job != null) {
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

        $applications = JobApplication::with(['jobOffer', 'profile.user'])
            ->whereHas('jobOffer', function ($q) use ($request) {
                $q->where('company_id', Auth::user()->company->id);

                if ($request->filled('search')) {
                    $q->where('title', 'LIKE', '%' . $request->search . '%');
                }
            })
            ->latest()
            ->paginate(10);

        return view('company.JobApplication.applications', compact('applications', 'job'));
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

    //------------------------- download cv-------------------------------------------------------------------------

    public function downloadCv($id)
    {
        $application = JobApplication::with('profile.user')->findOrFail($id);

        if ($application->profile->cv_path) {
            $filePath = storage_path('app/public/' . $application->profile->cv_path);

            if (file_exists($filePath)) {
                return response()->download($filePath);
            }
        }

        return back()->with('error', 'CV not found.');
    }

    //--------------------------------------------------------------------------------------------------
    public function accept($id)
    {
        $application = JobApplication::whereHas('jobOffer', fn($q) => $q->where('company_id', Auth::user()->company->id))->findOrFail($id);
    
        if ($application->status === 'pending') {
            $application->update(['status' => 'accepted']);
    
            try {
                $jobTitle = $application->jobOffer->title;
                $companyName = $application->jobOffer->company->name;
    
                Mail::to($application->profile->user->email)
                    ->send(new ApplicationReplyMail(
                        'accepted',
                        null,
                        $application->profile->user->name,
                        $jobTitle,
                        $companyName
                    ));
    
                return redirect()->route('company.applications.show', $application->id)
                    ->with('success', 'The application has been accepted and email sent.');
            } catch (\Exception $e) {
                Log::error('Error sending acceptance email: ' . $e->getMessage());
                return redirect()->route('company.applications.show', $application->id)
                    ->with('error', 'There was an error sending the acceptance email.');
            }
        }
    
        return redirect()->route('company.applications.show', $application->id)
            ->with('warning', 'This application cannot be accepted at this stage.');
    }
    
    //--------------------------------------------------------------------------------------------------
    public function reject(Request $request, $id)
{
    $application = JobApplication::whereHas('jobOffer', fn($q) => $q->where('company_id', Auth::user()->company->id))->findOrFail($id);

    if ($request->has('confirm_reject')) {
        if (in_array($application->status, ['pending', 'applied'])) {
            $application->update(['status' => 'rejected']);

            return redirect()->route('company.applications.rejectEmail', $application->id)
                ->with('warning', 'You need to confirm the reason before sending the rejection email.');
        }

        return redirect()->route('company.applications.show', $application->id)
            ->with('warning', 'This application cannot be rejected at this stage.');
    }

    return back();
}

    //--------------------------------------------------------------------------------------------------
    public function setPending($id)
    {
        $application = JobApplication::whereHas('jobOffer', fn($q) => $q->where('company_id', Auth::user()->company->id))->findOrFail($id);

        if ($application->status === 'applied') {
            $application->update(['status' => 'pending']);

            try {
                Mail::to($application->profile->user->email)->send(new ApplicationReplyMail('pending', null, $application->profile->user->name));
                return redirect()->route('company.applications.show', $application->id)
                    ->with('success', 'The application status has been updated to pending and email sent.');
            } catch (\Exception $e) {
                Log::error('Error sending pending email: ' . $e->getMessage());
                return redirect()->route('company.applications.show', $application->id)
                    ->with('error', 'There was an error sending the pending email.');
            }
        }

        return redirect()->route('company.applications.show', $application->id)
            ->with('warning', 'This application is already in the interview stage or has been accepted/rejected.');
    }
    //--------------------------------------------------------------------------------------------------
    public function destroy($id)
    {
        $application = JobApplication::whereHas('jobOffer', fn($q) => $q->where('company_id', Auth::user()->company->id))->findOrFail($id);

        $jobId = $application->job_offer_id;

        $application->delete();

        return redirect()->route('company.applications.applications', ['job' => $jobId])
            ->with('success', 'The employee has been removed from the job.');
    }

    //-----------------------------------for replay email ---------------------------------------------------------------
    public function sendReply(Request $request, $applicationId)
    {
        $application = JobApplication::findOrFail($applicationId);
        $user = $application->profile->user;
    
        $status = $request->input('status');
        $reason = $request->input('reason');
    
        $jobTitle = $application->jobOffer->title;
        $companyName = $application->jobOffer->company->name;
    
        try {
            Mail::to($user->email)->send(new ApplicationReplyMail($status, $reason, $user->name, $jobTitle, $companyName));
            return redirect()->route('company.applications.show', $application->id)
                ->with('success', 'The reply email has been sent successfully.');
        } catch (\Exception $e) {
            Log::error('Error sending reply email: ' . $e->getMessage());
            return redirect()->route('company.applications.show', $application->id)
                ->with('error', 'There was an error sending the reply email.');
        }
    }
    

    //-----------------------------for showing reject email ---------------------------------------------------------------------
    public function rejectEmail($id)
    {
        $application = JobApplication::whereHas('jobOffer', fn($q) => $q->where('company_id', Auth::user()->company->id))->findOrFail($id);

        return view('company.email.reject_email', compact('application'));
    }
    //-----------------------------for sending reject email ---------------------------------------------------------------------
    public function sendRejectEmail(Request $request, $id)
    {
        $application = JobApplication::whereHas('jobOffer', fn($q) => $q->where('company_id', Auth::user()->company->id))->findOrFail($id);
    
        $jobTitle = $application->jobOffer->title;
        $companyName = $application->jobOffer->company->name;
    
        try {
            Mail::to($application->profile->user->email)
                ->send(new ApplicationReplyMail(
                    'rejected',
                    $request->input('reason'),
                    $application->profile->user->name,
                    $jobTitle,
                    $companyName
                ));
    
            return redirect()->route('company.applications.show', $application->id)
                ->with('success', 'The rejection email has been sent successfully.');
        } catch (\Exception $e) {
            Log::error('Error sending rejection email: ' . $e->getMessage());
            return redirect()->route('company.applications.show', $application->id)
                ->with('error', 'There was an error sending the rejection email.');
        }
    }
    
}
