<?php

namespace App\Services\Geo;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;

class LocationIPService implements LocationServiceInterface
{
    public function __construct(
        private readonly ClientInterface $client
    )
    {
    }

    public function getLocationWithProxy(string $proxy): ResponseData
    {
        return $this->getLocation([
            RequestOptions::PROXY => $proxy,
        ]);
    }

    public function getLocation(array $options): ResponseData
    {
        $response = $this->client->get('/', $options);

        return ResponseData::fromJson($response->getBody()->getContents());
    }
}
