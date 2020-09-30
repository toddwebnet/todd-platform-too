<?php

namespace App\Console\Commands;

use App\Services\Api\SessionApi;
use Illuminate\Console\Command;

class Test extends Command
{

    protected $signature = 'test';

    public function handle()
    {
        /** @var SessionApi $api */
        $api = app()->make(SessionApi::class);
        dump(
            $api->createSession()
        );
    }
}
