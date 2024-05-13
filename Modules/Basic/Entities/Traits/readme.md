# RecursiveHelper 遞迴查詢

```
use Modules\Basic\Models\Traits\RecursiveHelper

class UserRepository extends Repository 
{
    use RecursiveHelper;
}

```

# CompositeKeyHelper 複合索引設定
注意：使用pkey必須掛入本功能，否則save時會出錯。

```
use Modules\Basic\Models\Traits\CompositeKeyHelper;

class Branch extends Model 
{
    use CompositeKeyHelper;
    //設定pkey
    protected $primaryKey = ['branch_id'];
    //關閉自動產生id
    public $incrementing = false;
}
```
