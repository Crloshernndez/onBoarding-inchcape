<?php

namespace App\Core\Onboarding\Domain\Model;

class Rmb implements \Stringable
{
    public function __construct(
        private string $region,
        private string $country,
        private string $brand
    )
    {
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    
}