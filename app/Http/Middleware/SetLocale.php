<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Cookie;
// use Symfony\Component\HttpFoundation\Response;

// class SetLocale
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */
//     public function handle(Request $request, Closure $next): Response
//     {

//         $locale = $request->input('locale') ?? Cookie::get('locale') ?? config('app.locale');
//         Cookie::queue('locale', $locale, 30 * 24 * 60);
//         app()->setLocale($locale);

//         return $next($request);
//     }
// }
