<?php

namespace App\Services;

class ResponseService
{
    public static function response($data, $code, $headers = [])
    {
        return response($data, $code, $headers);
    }
}
