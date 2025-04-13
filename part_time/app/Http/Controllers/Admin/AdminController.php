<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\JobOffer;
use App\Models\JobApplication;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $companyCount = Company::count();
        $jobOfferCount = JobOffer::count();
        $jobApplicationCount = JobApplication::count();

        // Users signed up today
        $todayUsersCount = User::whereDate('created_at', Carbon::today())->count();

        // Companies that are inactive
        $inactiveCompaniesCount = Company::where('is_active', false)->count();

        // Most applied jobs
        $mostAppliedJobs = JobOffer::withCount('jobApplications')
            ->orderBy('job_applications_count', 'desc')
            ->take(5)
            ->get();

        // Job applications by status
        $pendingJobApplications = JobApplication::where('status', 'pending')->count();
        $acceptedJobApplications = JobApplication::where('status', 'accepted')->count();

        // Company status breakdown
        $activeCompanies = Company::where('is_active', 1)->count();
        $inactiveCompanies = Company::where('is_active', 0)->count();

        // Companies added monthly for chart
        $monthlyCompanies = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('Y-m');

            // البحث عن عدد الشركات في الشهر الحالي
            $count = Company::whereYear('created_at', Carbon::now()->subMonths($i)->year)
                ->whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                ->count();


            $monthlyCompanies[$month] = $count > 0 ? $count : 0;
        }


        return view('admin.dashboard', [
            'userCount' => $userCount,
            'companyCount' => $companyCount,
            'jobOfferCount' => $jobOfferCount,
            'jobApplicationCount' => $jobApplicationCount,
            'todayUsersCount' => $todayUsersCount,
            'inactiveCompaniesCount' => $inactiveCompaniesCount,
            'mostAppliedJobs' => $mostAppliedJobs,
            'pendingJobApplications' => $pendingJobApplications,
            'acceptedJobApplications' => $acceptedJobApplications,
            'activeCompanies' => $activeCompanies,
            'inactiveCompanies' => $inactiveCompanies,
            'monthlyCompanies' => $monthlyCompanies
        ]);
    }
}
