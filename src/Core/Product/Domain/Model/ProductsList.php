<?php

namespace App\Core\Product\Domain\Model;

class ProductsList
{
    private int $count;

    /**
     * @param array<Product|null>
     */
    public function __construct(
        private array $products
    )
    {
        $this->count = count($this->products);
    }

    public function getCount(): intdiv
    {
        return $this->count;
    }

    public function getNodes() : array
    {
        return $this->products;
    }
}