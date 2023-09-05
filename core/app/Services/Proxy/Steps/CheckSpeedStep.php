<?php

namespace App\Services\Proxy\Steps;

use App\Services\Speed\SpeedServiceInterface;
use Closure;

class CheckSpeedStep implements CheckStepInterface
{
    public function __construct(
        private readonly SpeedServiceInterface $speedService
    )
    {
    }

    public function handle(CheckData $data, Closure $next): CheckData
    {
        if (is_null($data->getProtocol())) {
            return $next($data);
        }

        try {
            $data->setSpeed($this->speedService->test1Mb());
        } finally {
            return $next($data);
        }
    }
}
