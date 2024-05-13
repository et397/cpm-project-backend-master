<?php
namespace Modules\Basic\Exceptions;

use Exception;
use Modules\Basic\Http\Controllers\Traits\ApiResponse;
use Modules\Basic\Http\Middleware\DBTransactionMiddleware;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * 通用錯誤處理器
 */
class BaseHandler extends ExceptionHandler
{
    use ApiResponse;


    public function handlerQuery(Request $request, Throwable $exception): Response|null
    {
        if ($exception instanceof \Illuminate\Database\QueryException) {
            $exception->getTrace();
            $data = [];
            if (env('APP_DEBUG')) {
                $data = ['msg' => $exception->getMessage(), 'sql' => $exception->getSql(), 'value' => $exception->getBindings()];
            }
            \Log::error($data);
            // return $msg('資料庫錯誤', $data);
            return $this->error('資料庫錯誤' , 500);
        }
        return null;
    }

    public function handler405(Request $request, Throwable $exception): Response|null
    {
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException) {
            Log::error($exception->getMessage());
            return $this->error($exception->getMessage(), 404);
        }
        return null;
    }

    public function handler404(Request $request, Throwable $exception): Response|null
    {
        if($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException){
            Log::error($exception->getMessage());
            return $this->error($exception->getMessage(), 404);
        }
        return null;
    }

    public function handler400(Request $request, Throwable $exception): Response|null
    {
        if ($exception instanceof \InvalidArgumentException) {
            Log::error($exception->getMessage());
            return $this->error($exception->getMessage(), 400);
        }
        return null;
    }

    public function handler401(Request $request, Throwable $exception): Response|null
    {
        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            // return $this->error($exception->getMessage(), 401);
            Log::warning($exception->getMessage());

            return response('Unauthorized.', 401);
        }
        return null;
    }

    public function handlerModelNotFound(Request $request, Throwable $exception)
    {
        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException)
        {
            return $this->invalidData("查無資料",  []);
        }
    }

    public function handlerCustomize(Request $request, Throwable $exception)
    {
        if ($exception instanceof \Modules\Basic\Exceptions\CustomizeException)
        {
            Log::warning($exception->getMessage());
            if ($request->is('api/pos/*')) {
                return $this->invalidData($exception->getMessage());
            } else {
                return $this->invalidData($exception->getMessage(),  $exception->getMessage());
            }
        }
    }

    public function handlerOther(Request $request, Throwable $exception)
    {
        Log::error($exception->getMessage());

        // if(env("APP_DEBUG") !== true){
        //     return $this->error("系統異常", 500);
        // }

        return null;
    }


    public function handlerValidation(Request $request, Throwable $exception): Response|null
    {
        if ($exception instanceof \Illuminate\Validation\ValidationException || $exception instanceof \League\Config\Exception\ValidationException) {

            if($request->is('api/pos/*')){
                $errorMessageData = $exception->validator->getMessageBag();
                // 規則用陣列 'faileRules' => $originFailRule,
                Log::warning($errorMessageData->getMessages());
                return $this->invalidData($errorMessageData->first());
            } else {
                $errorMessageData = $exception->validator->getMessageBag();
                // 規則用陣列 'faileRules' => $originFailRule,
                Log::warning($errorMessageData->getMessages());
                return $this->invalidData("欄位錯誤", $errorMessageData->getMessages());
            }
        }
        return null;
    }

    /**
     * 因handler後，不再丟exception至middleware，需在此判斷該request需控制transation時，搶先在middleware commit前 rollback資料
     * @param mixed $request
     * @return void
     */
    public function transactionControl($request){
        // 取得url
        $url = $request->path();
        try{
            $middleware = $request->route()->computedMiddleware;
        }
        catch(Exception $e)
        {
            Log::error("路由設定異常:" . $url, [
                'ip' => $request->ip(),
                'params' => $request->all(),
                'bowerser' => $request->header('User-Agent'),
            ]);
            return $this->error(null, 404);
        }

        foreach($middleware as $middlewareName){
            if(strpos($middlewareName, DBTransactionMiddleware::class) !== false){
                DB::rollback();
            }
        }
    }


    public function render($request, Throwable $exception): Response
    {

        $this->transactionControl($request);

        if ($request->is('api/*')) {

            $authenticationExceptionResponse = $this->handler401($request, $exception);
            if(!is_null($authenticationExceptionResponse)) return $authenticationExceptionResponse;

            $validateExceptionResponse = $this->handlerValidation($request, $exception);
            if(!is_null($validateExceptionResponse)) return $validateExceptionResponse;

            $modelNotFountExceptionResponse = $this->handlerModelNotFound($request, $exception);
            if(!is_null($modelNotFountExceptionResponse)) return $modelNotFountExceptionResponse;

            $customizeExceptionResponse = $this->handlerCustomize($request, $exception);
            if(!is_null($customizeExceptionResponse)) return $customizeExceptionResponse;



            if(env("APP_DEBUG") !== true){
                $queryExceptionResponse = $this->handlerQuery($request, $exception);
                if(!is_null($queryExceptionResponse)) return $queryExceptionResponse;

                $methodNotAllowedExceptionResponse = $this->handler405($request, $exception);
                if(!is_null($methodNotAllowedExceptionResponse)) return $methodNotAllowedExceptionResponse;

                $notFoundExceptionResponse = $this->handler404($request, $exception);
                if(!is_null($notFoundExceptionResponse)) return $notFoundExceptionResponse;

                $InvalidArgumentExceptionResponse = $this->handler400($request, $exception);
                if(!is_null($InvalidArgumentExceptionResponse)) return $InvalidArgumentExceptionResponse;
            }

            // $OtherExceptionResponse = $this->handlerOther($request, $exception);
            // if(!is_null($OtherExceptionResponse)) return $OtherExceptionResponse;

            // return $msg('');
        }
        Log::error($exception->getMessage());

        return parent::render($request, $exception);
    }
}
