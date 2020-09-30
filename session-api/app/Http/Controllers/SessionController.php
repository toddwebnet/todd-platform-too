<?php

namespace App\Http\Controllers;

use App\Services\SessionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SessionController extends Controller
{
    private $sessionService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
    }

    public function start(Request $request)
    {
        $dataSet = $request->post();
        $token = $this->sessionService->generateNewToken();
        $this->sessionService->setKey($token, json_encode($dataSet));
        $this->sessionService->bumpExpire($token);
        return Response(
            [
                'token' => $token,
                'value' => json_decode($this->sessionService->getKey($token))
            ],
            Response::HTTP_OK
        );
    }

    private function checkTokenThenDo($request, $closure)
    {
        $token = ($request->header('token'));
        if ($token !== null && $this->sessionService->exists($token)) {
            return $closure($token);
        } else {
            return Response('', Response::HTTP_NOT_FOUND);
        }

    }

    public function get(Request $request)
    {
        return $this->checkTokenThenDo($request, function ($token) {
            return Response(
                $this->sessionService->getKey($token),
                Response::HTTP_OK
            );
        });
    }

    public function setKey(Request $request, $key)
    {
        return $this->checkTokenThenDo($request, function ($token) use ($request, $key) {
            $dataSet = json_decode($this->sessionService->getKey($token));
            $dataSet->{$key} = $request->post('value');
            $this->sessionService->setKey($token, json_encode($dataSet));
            $this->sessionService->bumpExpire($token);
            return Response(
                $this->sessionService->getKey($token),
                Response::HTTP_OK
            );
        });

    }

    public function setSet(Request $request)
    {
        return $this->checkTokenThenDo($request, function ($token) use ($request) {
            $dataSet = $request->post();
            $this->sessionService->setKey($token, json_encode($dataSet));
            $this->sessionService->bumpExpire($token);
            return Response(
                $this->sessionService->getKey($token),
                Response::HTTP_OK
            );
        });

    }

}
