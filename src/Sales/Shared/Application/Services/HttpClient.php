<?php

namespace Src\Sales\Shared\Application\Services;

use GuzzleHttp\Client;

class HttpClient
{
    public static function client(array $extraOpt = []): Client
    {
        $opts = [
            'curl' => [
                CURLOPT_SSL_VERIFYHOST => false,
                CURLOPT_SSL_VERIFYPEER => false,
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
