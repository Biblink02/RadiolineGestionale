<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $available = array_keys(config('custom.lang.available'));

        $fallback = config('custom.lang.fallback');

        // Read {locale} parameter from route
        $locale = $request->route('locale');

        if (!in_array($locale, $available)) {
            $locale = $fallback;
        }

        App::setLocale($locale);

        return $next($request);
    }
}
