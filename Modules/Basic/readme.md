# Basic
用於放入核心底層物件，方便來日搬移

# Exceptions 例外處理
|class|說明|
|-----|----|
|BaseHandler| 提供制式錯誤回傳處理 |


# Http 相關
## Response 工具
ApiResponse.php 提供與前台溝通的基本模式 

## Middleware
|class|說明|
|-----|----|
|DbTransactionMiddleware| 交易緒處理 |
|LogRequestsMiddleware| 記錄request相關資訊 |
|RoleMiddleware| 提供畫面角色權限授權 |

## Request
|class|說明|
|-----|----|
|IdRequest|判斷是否id有輸入|
|KeyRequest|判斷是否Key有輸入|

## Resources
|class|說明|
|-----|----|
|PaginateResource|提供分頁用基本欄位|

# Model 資料庫相關
## Repositories 
|class|說明|
|-----|----|
|KeyRepository|提供單key或複數key資料操作功能|
|Repository|提供idKey資料操作功能|

## Traits
|class|說明|
|-----|----|
|CompositeKeyHelper|提供使用Key Model必要覆寫|
|RecursiveHelper(尚未測試)|提供遞迴查詢功能|

## Entity (實驗中)
提供Model基本處理的實作，預計包含Rule、ApiDocsInfo

## IEntity
提供給Model實作用，用於規定Model內要放入Rule(檢核規則供使用)

# Services
|class|說明|
|-----|----|
|KeyService|提供單key或複數key基本crud操作功能|
|Service|提供idKey基本crud操作功能|
|EntityService|結合Entity使用，提供idKey基本crud操作功能|
|EntityKeyService|結合Entity使用，提供單key或複數key基本crud操作功能|


# Tests 基本測試相關
|class|說明|
|-----|----|
|TestController|提供Http crud測試相關功能|
|TestKeyService|提供實作KeyService的測試|
|TestService|提供實作Service的測試|
|TestKeyRepository|提供實作TestKeyRepository的測試|
|TestRepository|提供實作TestRepository的測試|

# Validators
|class|說明|
|-----|----|
|UniqueByPkeyValidator|Id Table與Key table用unique檢核，支授unique key複數|

