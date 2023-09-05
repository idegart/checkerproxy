<?php

namespace App\Services\Proxy\Steps;

use Closure;

class CheckSpeedStep implements CheckStepInterface
{
    public function handle(CheckData $data, Closure $next): CheckData
    {
        if (is_null($data->getProtocol())) {
            return $next($data);
        }

        return $next($data);
    }
}
