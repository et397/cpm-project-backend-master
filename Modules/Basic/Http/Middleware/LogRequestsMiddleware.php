<?php

namespace Modules\Basic\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogRequestsMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        Log::info('Request', [
            'method' => $request->method(),
            'url' => $request->url(),
            'params' => $request->all(),
            'status_code' => $response->getStatusCode(),
            // 'response' => $response->content()
        ]);

        return $response;
    }
}
