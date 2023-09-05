<?php

namespace App\Services\Geo;

interface LocationServiceInterface
{
    public function getLocationWithProxy(string $proxy): ResponseData;

    public function getLocation(array $options): ResponseData;
}
