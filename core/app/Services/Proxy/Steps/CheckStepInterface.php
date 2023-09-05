<?php

namespace App\Services\Proxy\Steps;

use Closure;

interface CheckStepInterface
{
    public function handle(CheckData $data, Closure $next): CheckData;
}
