<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReadNotificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->notification_id) {
            $user = auth()->user();
            if ($user) {
              $notification=$user->notifications->find($request->notification_id);
              if ( $notification) {
                $notification->markAsRead();
              }
            }
        }
        return $next($request);
    }
}
