<?php

namespace App\Services\Geo;

class ResponseData
{
    public function __construct(
        public readonly string $ip,
        public readonly string $country,
    )
    {
    }

    public static function fromJson(string $json): self
    {
        $data = json_decode($json, true);

        return new self(
            ip: $data['ip'],
            country: $data['country'],
        );
    }
}
