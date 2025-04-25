<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class CompanyAdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $company = $user->company;

        if (!$company) {
            return redirect()->back()->with('error', 'There is no company associated with this account.');
        }
        $latestApplications = JobApplication::whereIn('job_offer_id', $company->jobOffers->pluck('id'))
            ->latest()
            ->take(5)
            ->with(['user', 'jobOffer'])
            ->get();
        
        $jobOffersCount = $company->jobOffers()->count();

        $jobApplicationsCount = JobApplication::whereIn('job_offer_id', $company->jobOffers->pluck('id'))->count();

        $appliedApplications = JobApplication::whereIn('job_offer_id', $company->jobOffers->pluck('id'))->where('status', 'applied')->count();
        $pendingApplications = JobApplication::whereIn('job_offer_id', $company->jobOffers->pluck('id'))->where('status', 'pending')->count();
        $acceptedApplications = JobApplication::whereIn('job_offer_id', $company->jobOffers->pluck('id'))->where('status', 'accepted')->count();
        $rejectedApplications = JobApplication::whereIn('job_offer_id', $company->jobOffers->pluck('id'))->where('status', 'rejected')->count();

        // بيانات الأرباح الشهرية (استبدلها بالبيانات الحقيقية)
        $monthlyEarnings = [40000, 45000, 50000, 55000, 60000, 65000, 70000];

        // بيانات مصادر الإيرادات (استبدلها بالبيانات الحقيقية)
        $revenueSources = [
            $appliedApplications,
            $acceptedApplications,
            $pendingApplications,
            $rejectedApplications,
        ];


        return view('company.dashboard', [
            'company' => $company,
            'latestApplications' => $latestApplications,
            'jobOffersCount' => $jobOffersCount,
            'jobApplicationsCount' => $jobApplicationsCount,
            'appliedApplications' => $appliedApplications,
            'pendingApplications' => $pendingApplications,
            'acceptedApplications' => $acceptedApplications,
            'rejectedApplications' => $rejectedApplications,
            'monthlyEarnings' => $monthlyEarnings,
            'revenueSources' => $revenueSources,
        ]);
    }

    //--------------------------------------------------------------------------------------------------------------------------------

    public function profile()
    {
        $company = Auth::user()->company;
        if (!$company) {
            return redirect()->back()->with('error', 'No company associated with this account.');
        }
        return view('company.profile.profileAdmin', compact('company'));
    }

    //------------------------------------------------------------------------------------------------------------------

    public function editprofile()
    {
        $company = Auth::user()->company;

        if (!$company) {
            return redirect()->back()->with('error', 'No company associated with this account.');
        }
        return view('company.profile.editProfile', compact('company'));
    }

    //-------------------------------------------------------------------------------------------------------------------

    public function updateprofile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'industry' => 'nullable|string|max:255',
            'website' => 'nullable|url',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'num_employees' => 'nullable|integer',
        ]);

        $company = Auth::user()->company;

        $company->update($request->all());
        return redirect()->route('company.profile')->with('success', 'Profile updated successfully.');
    }

}
