<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationAdminController extends Controller
{
    public function index()
    {
        
        $notifications = Notification::with('company', 'user')->latest()->get();
        
        $unreadCount = Notification::where('is_read', false)->count();
    
        return view('admin.notifications.index', compact('notifications', 'unreadCount'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]);

        return redirect()->back();
    }
}
