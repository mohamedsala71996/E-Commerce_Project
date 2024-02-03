<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $api_token=config('app.api_token');
        if($request->header('x-api-key')!=$api_token){
            return response()->json(['message' => 'Invalid api'], 400);
        }
        return $next($request);
    }
}
