<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();
    if ($user->role_id != $role) {
        abort(403);
    }

    return $next($request);
}}