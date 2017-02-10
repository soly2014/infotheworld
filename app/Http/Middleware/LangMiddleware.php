<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;
use Closure;
use Illuminate\Support\Facades\Session;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url_array = explode('.', parse_url($request->url(), PHP_URL_HOST));
        $subdomain = $url_array[0];
        $languages = ['ar', 'de', 'en', 'es', 'fr', 'hi', 'ja', 'pt', 'ru', 'tr', 'zh'];
        if (in_array($subdomain, $languages)) {
            Session::set('locale', $subdomain);
        } else {
            Session::set('locale', 'en');
        }

//        dd($request->segment(1));

        return $next($request);
    }
}
