# DBTransactionMiddleware 執行緒處理
建議：區部
```
Route::controller(PositionController::class)->group(function () {
    Route::get('/position/{id}', 'find');
    Route::get('/position', 'get');
    //add transation
    Route::group(['middleware' => DBTransactionMiddleware::class], function () {
        // Your routes here
        Route::post('/position', 'new');
        Route::put('/position', 'edit');
        Route::delete('/position', 'delete');
    });
});
```
方法二: Http/Kernel.php註冊
```
    protected $routeMiddleware = [
        ...
        'db.transaction' => \Modules\Basic\Http\Middleware\DBTransactionMiddleware::class
    ]
```

# LogRequestsMiddleware  記錄請求
建議：全域
```
// from App/Http/Kernel.php
protected $middleware = [
    ....
    // 全域加入log
    \App\Http\Middleware\LogRequestsMiddleware::class,
];

```

# RoleMiddleware 角色授權
建議：區部  
### 1. 使用前置
step1: 實作Basic/Http/Auth/AuthorizerInterface
```
namespace App\Http\Auth;
use Modules\Basic\Http\Auth\AuthorizerInterface;
use App\Models\Repositories\PermissionRepository;

class RoleAuthorizer implements AuthorizerInterface
{

    private $permissionRepository;
    /**
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

	/**
	 * @param array $roles
	 * @return bool
	 */
	public function hasPermission(array $roles): bool
    {
        $user = auth()->user();
        return $this->permissionRepository->hasPermission($user->id, $user->getBranchId(), $roles);
	}
}
```
step2: 在AppServiceProvider 註冊AuthorizerInterface
```
    // 註冊角色驗證方法
    $this->app->bind(AuthorizerInterface::class, function (Application $app) {
        return new RoleAuthorizer($app->make(PermissionRepository::class));
    });
```

### 開始使用
step 1: Http/Kernel.php註冊
```
    protected $routeMiddleware = [
        ...
        'role' => \Modules\Basic\Http\Middleware\RoleMiddleware::class
    ]
    
```
step 2: route加上middleware進行設定
```
Route::get('/admin', 'AdminController@index')->middleware('role:admin');
```
