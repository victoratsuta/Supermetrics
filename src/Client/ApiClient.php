<?php


namespace App\Client;


use App\Contract\ApiClientInterface;
use GuzzleHttp\Client;

class ApiClient implements ApiClientInterface
{
    const BASE_URL = "https://api.supermetrics.com/assignment";

    /**
     * @var Client
     */
    private $client;

    /**
     * ApiClient constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @return string
     */
    public function generateToken(): string
    {
        $response = $this->client->post(self::BASE_URL . '/register', [
            'content-type' => 'application/json',
            'json' => [
                "client_id" => getenv("API_CLIENT_ID"),
                "email" => getenv("API_EMAIL"),
                "name" => getenv("API_NAME")
            ]
        ]);

        $jsonResponse = $response->getBody()->getContents();
        $arrayResponse = json_decode($jsonResponse, true);

        return $arrayResponse['data']['sl_token'];
    }

    /**
     * @param int    $page
     * @param string $token
     *
     * @return array
     */
    public function getData(int $page, string $token): array
    {
        $response = $this->client->request('GET', self::BASE_URL . '/posts',
            [
                'query' => [
                    "sl_token" => $token,
                    "page" => $page
                ]
            ]);

        $jsonResponse = $response->getBody()->getContents();
        return json_decode($jsonResponse, true);
    }
}
