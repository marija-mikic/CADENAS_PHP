<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiClient
{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getProduct(): array
    {
        $response = $this->client->request(
            'GET',
            "https://dummyjson.com/products"
        );

        $result = $response->toArray();

        return $result;
    }
}
