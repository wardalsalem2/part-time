<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobOffer;
use Illuminate\Support\Facades\Auth;

class CompanyJobOfferController extends Controller
{
    public function index(Request $request)
    {
        $query = JobOffer::where('company_id', Auth::user()->company->id);

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }


        $jobOffers = $query->withCount('jobApplications')->paginate(10)->appends($request->query());

        return view('company.jobOffer.index', compact('jobOffers'));
    }




    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function show($id)
    {
        $jobOffer = JobOffer::where('company_id', Auth::user()->company->id)
            ->withCount('jobApplications')
            ->findOrFail($id);

        return view('company.jobOffer.show', compact('jobOffer'))
            ->with('success', session('success'));
    }

    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function create()
    {
        return view('company.jobOffer.create');
    }
    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'location' => 'required',
            'work_hours' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'requirements' => 'required|string',
            'deadline' => 'required|date',
        ]);

        JobOffer::create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'work_hours' => $request->work_hours,
            'salary' => $request->salary,
            'requirements' => $request->requirements,
            'deadline' => $request->deadline,
            'is_active' => true,
            'company_id' => Auth::user()->company->id,
        ]);

        return redirect()->route('company.job-offers.index')->with('success', 'Job offer created.');
    }

    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function edit($id)
    {
        $jobOffer = JobOffer::where('company_id', Auth::user()->company->id)->findOrFail($id);
        return view('company.jobOffer.edit', compact('jobOffer'));
    }
    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function update(Request $request, $id)
    {
        $jobOffer = JobOffer::where('company_id', Auth::user()->company->id)->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'work_hours' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'requirements' => 'nullable|string',
            'deadline' => 'nullable|date|after_or_equal:today',
        ]);

        $jobOffer->update($request->only([
            'title',
            'description',
            'location',
            'work_hours',
            'salary',
            'requirements',
            'deadline',
        ]));

        // Redirect to the show page of the job offer with success message
        return redirect()->route('company.job-offers.show', $jobOffer->id)
            ->with('success', 'Job offer updated successfully.');
    }


    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy($id)
    {
        $jobOffer = JobOffer::where('company_id', Auth::user()->company->id)->findOrFail($id);
        $jobOffer->delete();

        return redirect()->route('company.job-offers.index')->with('success', 'Job offer deleted.');
    }
    //----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function toggleStatus($id)
    {
        $jobOffer = JobOffer::where('company_id', Auth::user()->company->id)->findOrFail($id);
        $jobOffer->is_active = !$jobOffer->is_active;
        $jobOffer->save();
        $message = $jobOffer->is_active ? 'Job offer is active.' : 'Job offer is inactive.';

        return back()->with('success', $message);
    }

}
