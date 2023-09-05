<?php

namespace App\Http\Response;

trait AwareAppResponseFactory
{
    private readonly AppResponseFactory $appResponseFactory;

    public function setAppResponseFactory(AppResponseFactory $factory): void
    {
        $this->appResponseFactory = $factory;
    }
}
