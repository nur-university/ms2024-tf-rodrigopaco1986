<?php

namespace Src\Sales\Shared\Application\Services;

use GuzzleHttp\Client;

class HttpClient
{
    public static function client(array $extraOpt = []): Client
    {
        $token = config('app.api_token');

        $opts = [
            'curl' => [
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
            ],
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Accept' => 'application/json',
            ],
            'verify' => false,
            'defaults' => [
                'curl' => [
                    CURLOPT_SSL_VERIFYHOST => false,
                    CURLOPT_SSL_VERIFYPEER => false,
                ],
                'verify' => false,
            ],
            'timeout' => 60,
        ];

        $opts = array_merge($opts, $extraOpt);

        return new Client($opts);
    }
}
