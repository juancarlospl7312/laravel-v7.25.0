<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class ApiPassword
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
        if($request->input('password')){
            if($request->input('password') != null){
                if($request->input('password') == $request->input('password_confirmation')){
                    $request['password'] = bcrypt($request->input('password'));
                    unset($request['password_confirmation']);
                }
                else{
                    $json['success'] = false;
                    return JsonResponse::create($json);
                }
            }
        }

        return $next($request);
    }
}
