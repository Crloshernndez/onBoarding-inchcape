<?php

namespace App\Core\Product\Domain\Ports;

use App\Core\Product\Domain\Model\Product;

interface ProductRepositoryInterface
{

    public function create(Product $productDetails): string;


    public function findAll(): array;

 
    public function findOneById(string $id): ?Product;

    // public function findOneById(string $id): ?Product;


    // public function deleteProduct(string $query, array $params): ?Product;


    // public function updateProduct(string $query, array $params): ?Product;
}