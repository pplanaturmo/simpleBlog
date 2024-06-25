<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // $locale = $request->cookie("locale",app()->getLocale());
        // app()->setLocale($locale);
        // return $next($request);

        $allowedLocales = ['pt', 'es', 'en'];
        $locale = $request->cookie('locale', 'es');

        if (!in_array($locale, $allowedLocales)) {
            $locale = 'es';
        }

        app()->setLocale($locale);
        return $next($request);
    }
}
