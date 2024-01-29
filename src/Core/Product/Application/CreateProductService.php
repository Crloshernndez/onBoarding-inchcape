<?php

namespace App\Core\Product\Application;

use App\Core\Product\Domain\Model\Product;
use App\Core\Product\Doctrine\Repository\ProductRepository;

class CreateProductService
{
    public function __construct(
        private ProductRepository $productRepository
        )
    {
    }

    public function registerProduct(Product $product): Product
    {
        return $this->productRepository->create($product);
    }
}