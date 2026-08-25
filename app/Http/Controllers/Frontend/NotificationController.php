<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Show notifications
     */
    public function index()
    {
        $notifications = Auth::user()
            ->notifications()
            ->latest()
            ->paginate(10);

        return view('frontend.notifications.index', compact('notifications'));
    }

    /**
     * Mark one notification as read
     */
    public function read($id)
    {
        $notification = Auth::user()
            ->notifications()
            ->where('id', $id)
            ->firstOrFail();

        $notification->markAsRead();

        return redirect(
            $notification->data['url'] ?? route('frontend.notifications')
        );
    }

    /**
     * Mark all notifications as read
     */
    public function readAll()
    {
        Auth::user()
            ->unreadNotifications
            ->markAsRead();

        return back();
    }
}