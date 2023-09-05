<?php

namespace App\Services\Speed;

use GuzzleHttp\ClientInterface;
use Illuminate\Support\Benchmark;

class SpeedService implements SpeedServiceInterface
{
    public function __construct(
        private readonly ClientInterface $client,
    )
    {
    }

    public function test1Mb(): float
    {
        return Benchmark::measure(function () {
            $this->client->get('files/test1Mb.db');
        });
    }
}
