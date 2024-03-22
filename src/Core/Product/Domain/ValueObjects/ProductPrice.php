<?php

namespace App\Core\Product\Domain\ValueObjects;

class ProductPrice
{
    public function __construct(private float $value)
    {
    }

    public function getValue(): float
    {
        return $this->value;
    }
}