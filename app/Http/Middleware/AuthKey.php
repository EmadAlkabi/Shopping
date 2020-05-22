<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\JsonResponse;

class AuthKey
{
    /**
     * Handle an incoming request.
     *
     *
     * @param $request
     * @param Closure $next
     * @return JsonResponse|mixed|void
     */
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('x-api-key');
        if(is_null($apiKey) || $apiKey != config("app.key")){
            return response()->json(['error'=>'api key not found'],401);
        }
        return $next($request);
    }
}
