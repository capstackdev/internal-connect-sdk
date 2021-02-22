<?php

namespace EprodigyConnect;

use EprodigyConnect\Request\BaseRequest as Request;
use GuzzleHttp\Client as Guzzle;

class Client
{
    public function __construct (string $baseUrl, string $token, int $uid)
    {
        $this->baseUrl = $baseUrl;
        $this->token   = $token;
        $this->uid     = $uid;

        $this->client = new Guzzle();
    }

    public function send(Request $request)
    {
        $response = $this->client->request(
            $request->method,
            "{$this->baseUrl}internal-api/{$request->getEndpoint()}",
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'auth-token'   => $this->token,
                    'auth-user'    => $this->uid,
                ],
                'json' => $request->build(),
            ]
        );

        $body = $response->getBody();

        $response = json_decode($body);
        
        if ($response->error === false) {
            return $request->parseResponse($response->data);
        }

        return false;
    }
}
