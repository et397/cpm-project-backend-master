<?php

namespace Modules\Basic\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogManagerialMiddleware
{
    public function handle($request, Closure $next)
    {
        // 使用ip 授權
        if (!in_array($request->ip(), explode(',', env("LOG_AUTH_IP", '')))) {
            abort(404);
        }
        $response = $next($request);
        return $response;
    }
}
