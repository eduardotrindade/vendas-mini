<?php

namespace App\Gateway\ContaAzul\Services;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\RequestOptions;

final class Customers
{
    private $http;
    private $auth;

    public function __construct(Auth $auth)
    {
        $this->http = new HttpClient(['base_uri' => config('conta-azul.url_api')]);
        $this->auth = $auth;
    }

    public function create($customer)
    {
        $response = $this->http->post(
            '/v1/customers',
            [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $this->auth->getAccessToken()
                ],
                RequestOptions::JSON => $customer
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }
}
