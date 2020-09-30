<?php

namespace App\Services\Api;

use App\Services\Api;

class SessionApi extends BaseApi
{
    public function __construct()
    {
        parent::__construct(env('SESSION_API_URL'));
    }

    public function createSession()
    {
        $endPoint = 'start';
        return json_decode(
            $this->getResponseContent(
                $this->call('GET', $endPoint)
            )
        );
    }

    public function getSession($sessionId)
    {
    }

    public function setSessionValue($sessionId, $key, $value = null)
    {
        if ($value === null && is_array($key)) {

        } else {

        }
    }

}
