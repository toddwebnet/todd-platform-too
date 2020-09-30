<?php

namespace App\Services;

use Faker\Factory as Faker;

class SessionService
{

    public function generateNewToken()
    {
        $faker = Faker::create();
        $token = '';
        for ($x = 0; $x < 32; $x++) {
            switch ($faker->numberBetween(0, 3) % 3) {
                case 0:
                    $token .= $faker->randomLetter;
                    break;
                case 1:
                    $token .= strtoupper($faker->randomLetter);
                    break;
                default:
                    $token .= $faker->randomNumber();
            }
        }
        return $token;
    }

    public function getKey($token)
    {
        return app('redis')->get('session:' . $token);
    }

    public function setKey($token, $value)
    {
        app('redis')->set('session:' . $token, $value);
    }

    public function bumpExpire($token)
    {
        // 60 seconds * 30 minutes
        app('redis')->expire('session:' . $token, 60 * 30);
    }

    public function exists($token)
    {

        return boolval(
            app('redis')->exists('session:' . $token)
        );

    }
}
