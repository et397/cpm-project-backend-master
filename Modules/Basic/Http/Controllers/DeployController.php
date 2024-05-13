<?php

namespace Modules\Basic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * @group Deploy 自動部署
 * @hideFromAPIDocumentation
 */
class DeployController extends \App\Http\Controllers\Controller

{
    public function __invoke(Request $request)
    {
        $githubPayload = $request->gitContent();
        // 由 GitHub 伺服器使用你在設定 Webhook 時提供的密鑰，對傳送的資料進行 HMAC SHA256 加密後的結果。
        $githubHash = $request->header('X-Hub-Signature-256');
        $localToken = config('app.deploy_secret');
        $localHash = 'sha256=' . hash_hmac('sha256', $githubPayload, $localToken, false);

        if (!isset($githubHash) || !isset($localToken) || !hash_equals($githubHash, $localHash)) {
            throw new \InvalidArgumentException('錯誤呼叫');
        }
        $contents = json_decode($githubPayload);

        if (isset($contents->ref) && config('apply.deploy_branch') && $contents->ref === 'refs/heads/' . config('app.deploy_branch')) {
            Log::info('Deploying branch ' . config('app.deploy_branch', 'none') . ' started by ' . $contents->pusher->name);
            var_dump(shell_exec('bash ' . base_path('deploy.sh')));
            return $this->success();
        } else {
            return $this->success("非部署分支：" . config('app.deploy_branch', 'none'));
        }
    }
}
