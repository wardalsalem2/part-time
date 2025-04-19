<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $company = Auth::user()->company;
        $notifications = Notification::where('company_id', $company->id)
            ->latest()
            ->get();

        $unreadCount = Notification::where('company_id', $company->id)
            ->where('is_read', false)
            ->count();

        return view('company.notifications.index', compact('notifications', 'unreadCount'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]);

        return redirect()->back();
    }
}
