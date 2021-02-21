<?php

namespace App\Gateway\ContaAzul\Services;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\RequestOptions;

final class Sales
{
    private HttpClient $http;
    private string $clientId;
    private string $clientSecret;

    public function __construct(Auth $auth)
    {
        $this->http = new HttpClient(['base_uri' => config('conta-azul.url_api')]);

        $this->clientId = config('conta-azul.client_id');
        $this->clientSecret = config('conta-azul.client_secret');

        $auth->refreshToken();
    }

    public function create(array $sale): array
    {
        $response = $this->http->post(
            '/v1/sales',
            [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . config('conta-azul.access_token')
                ],
                RequestOptions::JSON => $sale
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }
}
