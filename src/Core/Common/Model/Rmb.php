<?php

namespace App\Core\Common\Model;

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

    public function toDimension(string $language): Dimensions
    {
        return new Dimensions($this->region, $this->country, $language, $this->brand);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return \implode(' ', [$this->region, $this->country, $this->brand]);
    }
    
}