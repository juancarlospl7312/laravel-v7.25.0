<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class ApiLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $path_info = explode('/', $request->getPathInfo());
        $locale = $path_info[1];

        if(count($path_info) == 2 && $locale == ''){
            App::setLocale(config('app.fallback_locale'));
            return redirect('/'.App::getLocale());
        }
        elseif(in_array($locale, config('app.available_locales'))){
            App::setLocale($locale);
        }
        else{
            abort(404);
        }

        return $next($request);
    }
}
