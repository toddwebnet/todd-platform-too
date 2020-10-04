<?php

namespace App\Services;

use App\Services\Api\SessionApi;

class SessionService
{
    /** @var SessionApi|mixed  */
    private $sessionApi;

    /**
     * SessionService constructor.
     * @param SessionApi|null $sessionApi
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(?SessionApi $sessionApi = null)
    {
        $this->sessionApi = ($sessionApi === null) ?
            app()->make(SessionApi::class) :
            $sessionApi;
    }

    /**
     * @param $key
     * @param $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function startNewSession($key, $data)
    {
        $results = $this->sessionApi->createSession([$key => $data]);
        return $results['token'];
    }

    /**
     * @param $token
     * @param $key
     * @param $data
     * @return mixed|null
     */
    public function updateSessionKey($token, $key, $data)
    {
        return $this->sessionApi->setSessionValue($token, $key, $data);
    }

    /**
     * @param $token
     * @param $key
     * @return mixed|null
     */
    public function getSessionKey($token, $key){
        return $this->sessionApi->getSession($token, $key);
    }
}
