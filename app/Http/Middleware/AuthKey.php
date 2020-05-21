<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AuthKey
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $appKey = $request->header('APP_KEY');
        if(is_null($appKey) || $appKey != config("app.key")){
            return response()->json(['error'=>'App key not found'],401);
        }
        return $next($request);
    }
}
