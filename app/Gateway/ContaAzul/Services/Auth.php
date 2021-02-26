<?php

namespace App\Gateway\ContaAzul\Services;

use DateTime;
use DotenvEditor;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Artisan;

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

    private function setAccessToken(array $data): void
    {
        DotenvEditor::setKey('CONTA_AZUL_ACCESS_TOKEN', $data['access_token']);
        DotenvEditor::setKey('CONTA_AZUL_REFRESH_TOKEN', $data['refresh_token']);

        $dateExpires = (new DateTime())->modify("+ {$data['expires_in']} seconds");
        DotenvEditor::setKey('CONTA_AZUL_EXPIRES_IN', $dateExpires->format('Y-m-d H:i:s'));

        DotenvEditor::save();

        Artisan::call('config:clear');
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
        $dateNow = new DateTime();
        $dateExpires = new DateTime(config('conta-azul.expires_in'));
        $diff = $dateExpires->diff($dateNow);
        if ($diff->invert) {
            return config('conta-azul.access_token');
        }

        $params = [
            'grant_type' => 'refresh_token',
            'refresh_token' => config('conta-azul.refresh_token')
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
