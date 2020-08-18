<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

class ApiSlug
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
        if($request->input('title')){
            $slug = str_slug($request->input('title'), '-');
        }
        elseif($request->input('title_'.App::getLocale())){
            $slug = '';
        }
        else{
            $json['success'] = false;
            return JsonResponse::create($json);
        }
        $request['slug'] = $slug;

        return $next($request);
    }
}
