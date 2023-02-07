<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    public function getId($id)
    {
        $response = $this->client->request(
            'GET',
            "https://dummyjson.com/products/$id"
        );
        $productId = $response->toArray($id);


        return  new JsonResponse($productId);
    }
}
