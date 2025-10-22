<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');
        
        if ($locale && in_array($locale, ['id', 'en'])) {
            app()->setLocale($locale);
            session(['locale' => $locale]);
        } else {
            $locale = session('locale', 'id');
            app()->setLocale($locale);
        }
        
        return $next($request);
    }
}
