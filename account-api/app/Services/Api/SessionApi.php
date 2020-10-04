<?php

namespace App\Services\Api;

use GuzzleHttp\Exception\GuzzleException;

class SessionApi extends BaseApi
{
    /**
     * SessionApi constructor.
     */
    public function __construct()
    {
        parent::__construct(env('SESSION_API_URL'));
    }

    /**
     * @param null $key
     * @param null $value
     * @return mixed
     * @throws GuzzleException
     */
    public function createSession($key = null, $value = null)
    {
        $endPoint = 'start';
        $method = 'GET';
        $params = null;
        if ($key !== null) {
            $method = 'POST';
            if ($value === null && is_array($key)) {
                $params = $key;
            } else {
                $params = [$key => $value];
            }
        }
        return json_decode(
            $this->getResponseContent(
                $this->call($method, $endPoint, $params)
            ), true
        );
    }

    /**
     * @param $sessionId
     * @param null $key
     * @return mixed|null
     */
    public function getSession($sessionId, $key = null)
    {
        $endpoint = '/get';
        $options = [
            'headers' =>
                ['token' => $sessionId]
        ];

        try {
            $response = $this->call('GET', $endpoint, null, $options);
        } catch (GuzzleException $e) {
            if (strpos($e->getMessage(), '404 Not Found')) {
                return null;
            }
        }

        $sessionObject = json_decode(
            $this->getResponseContent($response),
            true
        );
        if ($key !== null) {
            return $sessionObject[$key];
        }
        return $sessionObject;
    }

    /**
     * @param $sessionId
     * @param $key
     * @param null $value
     * @return mixed|null
     */
    public function setSessionValue($sessionId, $key, $value = null)
    {
        $endpoint = '/set';

        $options = [
            'headers' =>
                ['token' => $sessionId]
        ];

        if ($value === null && is_array($key)) {
            $params = $key;
        } else {
            $endpoint .= '/' . $key;
            $params = $value;
        }

        try {
            $response = $this->call('POST', $endpoint, $params, $options);
        } catch (GuzzleException $e) {
            if (strpos($e->getMessage(), '404 Not Found')) {
                return null;
            }
        }
        $sessionObject = json_decode(
            $this->getResponseContent($response),
            true
        );
        return $sessionObject[$key];
    }

}
