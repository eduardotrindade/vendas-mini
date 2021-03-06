<?php

namespace App\Gateway\ContaAzul\Services;

use DateTime;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\RequestOptions;

final class Auth
{
    private HttpClient $http;
    private string $redirectUri;
    private string $clientId;
    private string $clientSecret;
    private string $state;

    public function __construct()
    {
        $urlApi = config('conta-azul.url_api');
        $this->clientId = config('conta-azul.client_id');
        $this->clientSecret = config('conta-azul.client_secret');
        $this->state = config('conta-azul.state');

        $this->setRedirectUri($urlApi);

        $this->http = new HttpClient(['base_uri' => $urlApi]);
    }

    private function setRedirectUri(string $urlApi): void
    {
        $resource = '/auth/authorize?';

        $params = [
            'client_id' => $this->clientId,
            'redirect_uri' => route('contaAzulToken'),
            'scope' => 'sales',
            'state' => $this->state
        ];

        $this->redirectUri = $urlApi . $resource . http_build_query($params);
    }

    public function getToken(): string
    {
        $contaAzul = session('CONTA_AZUL');
        $dateExpires = $contaAzul['expires_in'];

        $dateNow = new DateTime();
        if ($dateNow > $dateExpires) {
            return $this->refreshToken();
        }

        return $contaAzul['access_token'];
    }

    private function setToken(array $data): void
    {
        $data['expires_in'] = (new DateTime())->modify("+ {$data['expires_in']} seconds");

        session('CONTA_AZUL', $data);
    }

    public function authorize(): string
    {
        return $this->redirectUri;
    }

    public function token(string $code): void
    {
        $params = [
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->redirectUri,
            'code' => $code
        ];

        $response = $this->http->post(
            '/oauth2/token',
            [
                RequestOptions::AUTH => [$this->clientId, $this->clientSecret],
                RequestOptions::FORM_PARAMS => $params
            ]
        );

        $data = json_decode($response->getBody()->getContents(), true);

        $this->setAccessToken($data);
    }

    public function refreshToken(): string
    {
        $params = [
            'grant_type' => 'refresh_token',
            'refresh_token' => session('CONTA_AZUL')['refresh_token']
        ];

        $response = $this->http->post(
            '/oauth2/token',
            [
                RequestOptions::AUTH => [$this->clientId, $this->clientSecret],
                RequestOptions::FORM_PARAMS => $params
            ]
        );

        $data = json_decode($response->getBody()->getContents(), true);

        $this->setAccessToken($data);

        return $data['access_token'];
    }
}
