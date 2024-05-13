<?php

namespace Modules\Basic\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class DBTransactionMiddleware
{
    public function handle($request, Closure $next)
    {
        DB::beginTransaction();

        try {
            $response = $next($request);
            DB::commit();
            return $response;
        } catch (\Exception $e) {
            // 注意: error handler會接走大部份的錯誤
            DB::rollback();
            throw $e;
        }
    }
}
