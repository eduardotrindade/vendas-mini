<?php

namespace App\Gateway\ContaAzul\Services;

use DateTime;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Storage;

final class Auth
{
    private HttpClient $http;
    private string $urlApi;
    private string $clientId;
    private string $clientSecret;
    private string $state;
    private string $redirectUri;

    public function __construct()
    {
        $this->urlApi = config('conta-azul.url_api');
        $this->clientId = config('conta-azul.client_id');
        $this->clientSecret = config('conta-azul.client_secret');
        $this->state = config('conta-azul.state');
        $this->redirectUri = route('contaAzulToken');

        $this->http = new HttpClient(['base_uri' => $this->urlApi]);
    }

    private function setToken(string $json): void
    {
        $data = json_decode($json, true);
        $data['expires_in'] = (new DateTime())->modify("+ {$data['expires_in']} seconds")->format('Y-m-d H:i:s');

        Storage::put('conta-azul.json', json_encode($data));
    }

    public function getAccessToken(): string
    {
        $contaAzul = json_decode(Storage::get('conta-azul.json'), true);
        $dateExpires = new DateTime($contaAzul['expires_in']);

        $dateNow = new DateTime();
        if ($dateNow > $dateExpires) {
            return $this->refreshToken();
        }

        return $contaAzul['access_token'];
    }

    private function getRefreshToken(): string
    {
        $contaAzul = json_decode(Storage::get('conta-azul.json'), true);

        return $contaAzul['refresh_token'];
    }

    public function authorize(): string
    {
        $resource = '/auth/authorize?';

        $params = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUri,
            'scope' => 'sales',
            'state' => $this->state
        ];

        return $this->urlApi . $resource . http_build_query($params);
    }

    public function token(string $code): void
    {
        $params = [
            'grant_type' => 'authorization_code',
            'redirect_uri' => 'https://felipemjesus.com/vendas-minisitio/api/conta-azul/token',//$this->redirectUri,
            'code' => $code
        ];

        $response = $this->http->post(
            '/oauth2/token',
            [
                RequestOptions::AUTH => [$this->clientId, $this->clientSecret],
                RequestOptions::FORM_PARAMS => $params
            ]
        );

        $this->setToken($response->getBody()->getContents());
    }

    private function refreshToken(): string
    {
        $params = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $this->getRefreshToken()
        ];

        $response = $this->http->post(
            '/oauth2/token',
            [
                RequestOptions::AUTH => [$this->clientId, $this->clientSecret],
                RequestOptions::FORM_PARAMS => $params
            ]
        );

        $this->setToken($response->getBody()->getContents());

        return $this->getToken();
    }
}
