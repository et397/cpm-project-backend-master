<?php

namespace Modules\Basic\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Exception;

/**
 * Summary of TestService
 */
abstract class TestClass extends TestCase
{

    use DatabaseTransactions;


    public function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
    }

    public function tearDown(): void
    {
        // 測試結束後自動還原資料庫
        DB::rollBack();
        parent::tearDown();
    }

    public static function tearDownAfterClass(): void
    {
        // 執行一些全局清理工作，例如關閉數據庫連接等等
        // DB::rollBack();
        parent::tearDownAfterClass();
    }


    public function writeToFile($content)
    {
        $fileName = storage_path('test_case/output.txt');
        $content = json_encode($content, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $file = fopen($fileName, "w");
        fwrite($file, $content);
        fclose($file);
    }

}


