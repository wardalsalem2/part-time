<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.login');  
    }

//-------------------------------------------------------------------------------------------------
public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role_id == 2 && $user->company && !$user->company->is_active) {
            Auth::logout();
            return redirect('/login')->withErrors([
                'email' => 'Your company is inactive. Please contact support.',
            ]);
        }

        if ($user->profile && !$user->profile->is_active) {
            Auth::logout();
            return redirect('/login')->withErrors([
                'email' => 'Your account is inactive. Please contact support.',
            ]);
        }


        if ($user->role_id == 1) {
            return redirect()->route('user.home');
        } elseif ($user->role_id == 2) {
            return redirect()->route('company.dashboard');
        } elseif ($user->role_id == 3) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.home');
        }
    }
    return back()->withErrors([
        'email' => 'The provided credentials are incorrect.',
    ]);
}

}
