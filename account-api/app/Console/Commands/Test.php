<?php

namespace App\Console\Commands;

use App\Services\Api\SessionApi;
use Illuminate\Console\Command;

class Test extends Command
{

    protected $signature = 'test';

    public function handle()
    {
        $sessionApi = new SessionApi();
        $results = $sessionApi->createSession(['admin'=>['key1' => 'goober']]);
        $token = $results['token'];
        $adminSession = $sessionApi->getSession($token, 'admin');

        $adminSession['newKey'] = 'what';
        dump(
          $sessionApi->setSessionValue($token, 'admin', $adminSession)
        );

    }
}
