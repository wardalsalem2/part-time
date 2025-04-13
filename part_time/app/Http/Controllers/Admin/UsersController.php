<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        $query = User::with(['profile', 'role']);
        
        // Apply filters based on user input
        if ($request->has('name') && $request->input('name') !== '') {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        
        if ($request->has('status') && $request->input('status') !== '') {
            $query->whereHas('profile', function ($q) use ($request) {
                $q->where('is_active', $request->input('status'));
            });
        }
    
        if ($request->filled('role') && $request->input('role') !== '') {
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('id', $request->input('role'));
            });
        }
    
        // Get the users with pagination
        $users = $query->paginate(10);
    
        // Check if there are no results
        $noResults = $users->isEmpty();
    
        // Get all roles for the filter
        $roles = Role::all();
        
        // Return the view with the filtered users, roles, and noResults flag
        return view('admin.users.index', compact('users', 'roles', 'noResults'));
    }
    

    //------------------------------------------------------------------------------------------------
    public function show(string $id)
    {
        $user = User::with(['profile', 'role'])->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    //-------------------------------------------------------------------------------------------------

    public function edit(string $id)
    {
        $user = User::with('profile')->findOrFail($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    //-------------------------------------------------------------------------------------------------
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',

            //------- ---------profile----------------------------
            'job_title' => 'nullable|string',
            'hourly_rate' => 'nullable|numeric',
            'available_hours' => 'nullable|integer',
            'skills' => 'nullable|string',
            'experience' => 'nullable|string',
            'city' => 'nullable|string',
            'country' => 'nullable|string',
            'phone' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'cv_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'],
        ]);

        $cvPath = null;
        $imagePath = null;

        if ($request->hasFile('cv_path')) {
            $cvPath = $request->file('cv_path')->store('cvs', 'public');
        }

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
        }

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'job_title' => $validated['job_title'] ?? null,
                'hourly_rate' => $validated['hourly_rate'] ?? null,
                'available_hours' => $validated['available_hours'] ?? null,
                'skills' => $validated['skills'] ?? null,
                'experience' => $validated['experience'] ?? null,
                'city' => $validated['city'] ?? null,
                'country' => $validated['country'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'is_active' => $validated['is_active'] ?? true,
                'cv_path' => $cvPath ?? $user->profile->cv_path ?? null,
                'image_path' => $imagePath ?? $user->profile->image_path ?? null,
            ]
        );

        return redirect()->route('admin.users.index')->with('success', 'The user has been updated successfully.');
    }


    //-----------------------------------------------------------------------------------------

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }


//-------------------------- for activite status ----------------------------------------------

public function activate($id)
{
    $user = User::findOrFail($id);

    if ($user->profile) {
        $user->profile->update(['is_active' => 1]);
    } else {
        $user->profile()->create(['is_active' => 1]);
    }

    return back()->with('success', 'Account has been activated.');
}

//----------------------------------------------------------------------------

public function deactivate($id)
{
    $user = User::findOrFail($id);

    if ($user->profile) {
        $user->profile->update(['is_active' => 0]);
    } else {
        $user->profile()->create(['is_active' => 0]);
    }

    return back()->with('success', 'Account has been deactivated.');
}


}