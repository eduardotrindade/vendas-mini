<?php

namespace App\Gateway\ContaAzul\Services;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\RequestOptions;

final class Products
{
    private HttpClient $http;
    private Auth $auth;

    public function __construct(Auth $auth)
    {
        $this->http = new HttpClient(['base_uri' => config('conta-azul.url_api')]);
        $this->auth = $auth;
    }

    /**
     * @param array $product
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $product): array
    {
        $response = $this->http->post(
            '/v1/products',
            [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $this->auth->getToken()
                ],
                RequestOptions::JSON => $product
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }
}
