<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|in:1,2',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
        ]);

        if ($validated['role_id'] == 2) {
            $request->validate([
                'company_name' => 'required|string|max:255',
                'company_website' => 'required|url',
                'company_phone' => 'required|string|max:20',
                'company_email' => 'required|email|unique:companies,email',
                'company_address' => 'required|string',
                'company_city' => 'required|string',
                'company_description' => 'required|string',
                'company_industry' => 'nullable|string',
                'company_num_employees' => 'nullable|integer',
            ]);
            $company = Company::create([
                'user_id' => $user->id,
                'name' => $request->company_name,
                'website' => $request->company_website,
                'email' => $request->company_email,
                'phone' => $request->company_phone,
                'address' => $request->company_address,
                'city' => $request->company_city,
                'description' => $request->company_description,
                'industry' => $request->company_industry,
                'num_employees' => $request->company_num_employees,
                'is_active' => 0,
            ]);

            $notification = Notification::create([
                'message' => 'New company "' . $company->name . '" has been registered and is pending approval.',
                'company_id' => $company->id,
                'user_id' => $user->id,
                'is_read' => false,
            ]);

            
        }

        return redirect()->route('login')->with('message', 'User registered successfully. Please log in.');
    }
}
