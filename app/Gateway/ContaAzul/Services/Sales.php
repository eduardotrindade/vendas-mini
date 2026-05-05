<?php

namespace App\Gateway\ContaAzul\Services;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\RequestOptions;

final class Sales
{
    private $http;
    private $auth;

    public function __construct(Auth $auth)
    {
        $this->http = new HttpClient(['base_uri' => config('conta-azul.url_api')]);
        $this->auth = $auth;
    }

    public function create($sale)
    {
        $response = $this->http->post(
            '/v1/sales',
            [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $this->auth->getAccessToken()
                ],
                RequestOptions::JSON => $sale
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }
}
