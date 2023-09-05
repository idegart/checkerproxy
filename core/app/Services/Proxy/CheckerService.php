<?php

namespace App\Services\Proxy;

use App\Services\Proxy\Steps\CheckData;
use Illuminate\Pipeline\Pipeline;

class CheckerService
{
    public function __construct(
        private readonly array $steps,
    )
    {
    }

    public function check(string $ipAddress): CheckData
    {
        $data = new CheckData($ipAddress);

        return (new Pipeline())->send($data)->through($this->steps)->thenReturn();
    }
}
