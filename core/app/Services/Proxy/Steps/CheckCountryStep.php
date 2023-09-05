<?php

namespace App\Services\Proxy\Steps;

use App\Services\Geo\LocationServiceInterface;
use Closure;

class CheckCountryStep implements CheckStepInterface
{
    public function __construct(
        private readonly LocationServiceInterface $locationService,
    )
    {
    }

    public function handle(CheckData $data, Closure $next): CheckData
    {
        if (is_null($data->getProtocol())) {
            return $next($data);
        }

        try {
            $result = $this->locationService->getLocationWithProxy($data->getProtocol() . '://' . $data->ipAddress);

            $data->setCountry($result->country);
        } finally {
            return $next($data);
        }
    }
}
