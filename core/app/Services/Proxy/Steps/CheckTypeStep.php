<?php

namespace App\Services\Proxy\Steps;

use Closure;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Promise\Utils;
use GuzzleHttp\RequestOptions;

class CheckTypeStep implements CheckStepInterface
{
    public const AVAILABLE_PROTOCOLS = [
        'http',
        'socks5',
    ];

    public function __construct(
        private readonly ClientInterface $client,
    )
    {
    }

    public function handle(CheckData $data, Closure $next): CheckData
    {
        $requestPromises = [];

        foreach (self::AVAILABLE_PROTOCOLS as $protocol) {
            $requestPromises[$protocol] = $this->client->getAsync('', [
                RequestOptions::PROXY => $protocol . '://' . $data->ipAddress,
            ]);
        }

        $responses = Utils::settle($requestPromises)->wait();

        foreach ($responses as $protocol => $response) {
            if ($response['state'] !== PromiseInterface::FULFILLED) {
                continue;
            }

            $data->setProtocol($protocol);

            return $next($data);
        }

        return $next($data);
    }
}
