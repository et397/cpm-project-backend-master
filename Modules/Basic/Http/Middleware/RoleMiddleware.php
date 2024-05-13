<?php

namespace Modules\Basic\Http\Middleware;

use Modules\Basic\Http\Auth\AuthorizerInterface;
use Closure;
use Illuminate\Support\Facades\Log;

/**
 * 角色授權Middleware設定
 */
class RoleMiddleware
{

    private $authorizer;

    public function __construct()
    {
        $this->authorizer = app(AuthorizerInterface::class);
    }

    public function handle($request, Closure $next, ...$roles)
    {
        Log::info(auth()->check());
        if (auth()->check()) {
            $hasPermission = $this->authorizer->hasPermission($roles);
            if($hasPermission){
                return $next($request);
            }
        }

        return response('Forbidden.', 403);
    }
}
