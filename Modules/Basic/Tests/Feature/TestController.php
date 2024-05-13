<?php

namespace Modules\Basic\Tests\Feature;

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

abstract class TestController extends TestCase
{

    use DatabaseTransactions;

    abstract public function route();

    abstract public function getUser(): \Illuminate\Contracts\Auth\Authenticatable;

    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();

        // 交易序
        // 驗證
        $this->user = $this->getUser();
        $token = $this->user->createToken('API Token', [])->plainTextToken;

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ]);
        // $this->actingAs($user);
        // Sanctum::actingAs($this->getUser());
    }




    protected function tearDown() : void
    {
        DB::rollBack();
        parent::tearDown();
    }



    public function getByParam(string $url, array $params, array $headers = [])
    {
        $queryString = http_build_query($params);

        return $this->get($url . '?' . $queryString, $headers);
    }

    public function responseIsNotEmpty($response, $success = true)
    {
        $response->assertStatus(200);

        $response->assertJson(['success' => $success])
            ->assertJson(fn(AssertableJson $json) =>
                $json
                    ->where('data', fn($array) => !empty($array))
                    ->etc()
            );
    }

    protected $testArray;

    public function __destruct()
    {
        $this->testArray = null;
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
