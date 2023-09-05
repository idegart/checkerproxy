<?php

namespace App\Http\Response;

interface HasAppResponseFactoryInterface
{
    public function setAppResponseFactory(AppResponseFactory $factory): void;
}
