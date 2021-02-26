<?php

namespace App\Gateway\ContaAzul\Services;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\RequestOptions;

final class Sales
{
    private HttpClient $http;
    private Auth $auth;

    public function __construct(Auth $auth)
    {
        $this->http = new HttpClient(['base_uri' => config('conta-azul.url_api')]);
        $this->auth = $auth;
    }

    /**
     * @param array $sale
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $sale): array
    {
        $response = $this->http->post(
            '/v1/sales',
            [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $this->auth->refreshToken()
                ],
                RequestOptions::JSON => $sale
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }
}
