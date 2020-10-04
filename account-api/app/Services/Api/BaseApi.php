<?php

namespace App\Services\Api;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;

class BaseApi
{

    /** @var string */
    protected $baseUrl;
    /** @var array  */
    protected $auth = [];
    /** @var array  */
    protected $lastCallLog = [];

    /**
     * BaseApi constructor.
     * @param string $baseUrl
     */
    public function __construct(string $baseUrl = '')
    {
        $this->setBaseUrl(rtrim($baseUrl, '/'));
        $this->auth = [];

    }

    /**
     * @param string $baseUrl
     */
    protected function setBaseUrl(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return Client
     */
    private function setClient()
    {
        $options = [
            'base_uri' => $this->baseUrl,
        ];
        return new Client($options);
    }

    /**
     * call the api
     *
     * @param string $method
     * @param string $path
     * @param null $params
     * @param array $options
     * @return \Psr\Http\Message\ResponseInterface
     * @throws GuzzleException
     */
    protected function call(string $method, string $path, $params = null, array $options = [])
    {

        $this->lastCallLog = [];
        //Set base options
        if (!array_key_exists('headers', $options)) {
            $options['headers'] = [];
        }

        $options['headers']['Accept'] = 'application/json';
        //Build request params
        $this->buildParams($method, $params, $options);

        // log home api call request
        $this->lastCallLog[] = [
            'timestamp' => Carbon::now()->toDateTimeString(),
            'type' => 'info',
            'msg' => "API - Request:\n" . json_encode([
                    $this->baseUrl,
                    $method,
                    $path,
                    $options
                ])
        ];
        //Perform the request
        $client = $this->setClient();
        $response = $client->request($method, $path, $options);

        $this->lastCallLog[] = [
            'timestamp' => Carbon::now()->toDateTimeString(),
            'type' => 'info',
            'msg' => "API - Response:\n" . $this->getResponseContent($response)
        ];

        return $response;
    }//!End function, call

    /**
     * get the log from the last call function
     * @return array
     */
    public function getLastCallLog()
    {
        return $this->lastCallLog;
    }

    /**
     * @param string $method
     * @param $params
     * @param array $options
     */
    protected function buildParams(string $method, $params, array &$options)
    {
        //If $params is a string, assume the call needs to post directly to the body
        if ($params !== null) {
            if (is_string($params)) {
                $options['body'] = $params;
            } else {
                switch (strtoupper($method)) {
                    case 'GET':
                        if (is_array($params)) {
                            $options['query'] = $params;
                        }
                        break;
                    case 'POST':
                    case 'PUT':
                    case 'PATCH':
                    case 'DELETE':
                    default:
                        if (is_object($params) && is_a($params, \stdClass::class)) {
                            //stdClass, assume it's a JSON object
                            $options['json'] = $params;
                        } else {
                            if (is_array($params)) {
                                $options['body'] = preg_replace(
                                    '/%5B[0-9]+%5D/simU',
                                    '%5B%5D',
                                    http_build_query($params));
                                $options['headers']['Content-Type'] = 'application/x-www-form-urlencoded';
                                $options['headers']['Accept'] = 'application/json';
                            }
                        }
                        break;
                    case 'HEAD':
                    case 'OPTIONS':
                    case 'CONNECT':
                        //Do nothing
                        break;
                }//!End switch
            }//!End if/else, string
        }//!End if, null
    }

    /**
     * convert response to string
     *
     * @param Response $response
     * @return false|string
     */
    public function getResponseContent(Response $response)
    {
        $body = $response->getBody();
        $body->rewind();
        return $body->read($body->getSize());
    }

}
