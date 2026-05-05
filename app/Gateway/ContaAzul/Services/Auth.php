<?php

namespace App\Gateway\ContaAzul\Services;

use DateTime;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Storage;

final class Auth
{
    private $http;
    private $urlApi;
    private $clientId;
    private $clientSecret;
    private $state;
    private $redirectUri;

    public function __construct()
    {
        $this->urlApi = config('conta-azul.url_api');
        $this->clientId = config('conta-azul.client_id');
        $this->clientSecret = config('conta-azul.client_secret');
        $this->state = config('conta-azul.state');
        $this->redirectUri = route('contaAzulToken');

        $this->http = new HttpClient(['base_uri' => $this->urlApi]);
    }

    private function setToken($json)
    {
        $data = json_decode($json, true);
        $data['expires_in'] = (new DateTime())->modify("+ {$data['expires_in']} seconds")->format('Y-m-d H:i:s');

        Storage::put('conta-azul.json', json_encode($data));
    }

    public function getAccessToken()
    {
        $contaAzul = json_decode(Storage::get('conta-azul.json'), true);
        $dateExpires = new DateTime($contaAzul['expires_in']);

        $dateNow = new DateTime();
        if ($dateNow > $dateExpires) {
            return $this->refreshToken();
        }

        return $contaAzul['access_token'];
    }

    private function getRefreshToken()
    {
        $contaAzul = json_decode(Storage::get('conta-azul.json'), true);

        return $contaAzul['refresh_token'];
    }

    public function authorize()
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

    public function token($code)
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

        $this->setToken($response->getBody()->getContents());
    }

    private function refreshToken()
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

        return $this->getAccessToken();
    }
}
