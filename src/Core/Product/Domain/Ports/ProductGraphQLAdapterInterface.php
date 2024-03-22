<?php

namespace App\Core\Product\Domain\Ports;

use App\Core\Product\Domain\Model\Product;

interface ProductGraphQLAdapterInterface
{
    public function getAllProducts(): array;

    public function getProductById(string $id): ?Product;

    public function createProduct(array $productDetails): string;
}