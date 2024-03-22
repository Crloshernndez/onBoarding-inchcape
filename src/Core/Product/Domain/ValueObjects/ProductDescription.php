<?php

namespace App\Core\Product\Domain\ValueObjects;

class ProductDescription
{
    public function __construct(private string $value)
    {
    }

    public function getValue(): string
    {
        return $this->value;
    }
}