<?php

namespace App\Services\Proxy\Steps;

class CheckData
{
    private ?string $protocol;
    private ?string $country;
    private ?string $speed;

    public function __construct(
        public  readonly string $ipAddress,
        ?string $protocol = null,
        ?string $country = null,
        ?string $speed = null,
    )
    {
        $this->protocol = $protocol;
        $this->country = $country;
        $this->speed = $speed;
    }

    public function getProtocol(): ?string
    {
        return $this->protocol;
    }

    public function setProtocol(?string $protocol): void
    {
        $this->protocol = $protocol;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    public function getSpeed(): ?string
    {
        return $this->speed;
    }

    public function setSpeed(?string $speed): void
    {
        $this->speed = $speed;
    }
}
