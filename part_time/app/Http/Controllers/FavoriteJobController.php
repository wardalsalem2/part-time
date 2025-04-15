<?php
namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;

class FavoriteJobController extends Controller
{
    /**
     * Add a job to the user's favorites.
     */

    public function index()
    {
        $favorites = auth()->user()->favoriteJobs()->with('company')->paginate(10);

        return view('user.favorites', compact('favorites'));
    }


    public function store(JobOffer $jobOffer)
    {
        auth()->user()->favoriteJobs()->syncWithoutDetaching([$jobOffer->id]);

        return back()->with('success', 'Job added to favorites.');
    }

    /**
     * Remove a job from the user's favorites.
     */
    public function destroy(JobOffer $jobOffer)
    {
        auth()->user()->favoriteJobs()->detach($jobOffer->id);

        return back()->with('success', 'Job removed from favorites.');
    }

    /**
     * Show all favorited jobs.
     */

}
