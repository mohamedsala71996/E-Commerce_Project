<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
        }
        // You may redirect back or to a specific URL after marking as read
        return redirect()->back();
    }
}
