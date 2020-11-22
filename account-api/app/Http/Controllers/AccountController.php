<?php

namespace App\Http\Controllers;

use App\Services\AccountService;
use App\Services\ResponseService;
use App\Services\SessionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    public function authenticate(Request $request)
    {

        /** @var AccountService $accountService */
        $accountService = app()->make(AccountService::class);

        /** @var SessionService $sessionService */
        $sessionService = app()->make(SessionService::class);

        $userData = $accountService->getUserSessionVariables(
            $request->post('email'),
            $request->post('password')
        );

        if ($userData === null) {
            return ResponseService::response(['message' => 'Invalid Credentials'], Response::HTTP_FORBIDDEN);
        }

        $token = $sessionService->startNewSession('admin', $userData);
//        setCookie('tpt-token', $token, [
//            'domain' => 'tpt.com'
//        ]);

        return ResponseService::response(
            [
                'token' => $token,
                'message' => 'Login Succeeded'
            ],
            Response::HTTP_OK
        );

    }

    public function test()
    {

        $email = 'admin@tpt.com';
        $password = 'password';

    }

}
