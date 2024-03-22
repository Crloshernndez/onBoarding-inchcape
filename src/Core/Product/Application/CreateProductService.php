<?php

namespace App\Core\Product\Application;

use App\Core\Product\Domain\Model\Product;
use App\Core\Product\Domain\ValueObjects\ProductId;
use App\Core\Product\Domain\ValueObjects\ProductName;
use App\Core\Product\Domain\ValueObjects\ProductSlug;
use App\Core\Product\Domain\ValueObjects\ProductPrice;
use App\Core\Product\Domain\ValueObjects\ProductDescription;

use App\Core\Product\Doctrine\Repository\ProductRepository;

class CreateProductService
{
    public function __construct(
        private ProductRepository $productRepository
        )
    {
    }

    public function createProduct(array $productDetails): string
    {
        $productId = new ProductId('');
        $name = new ProductName($productDetails['name']);
        $slug = new ProductSlug($productDetails['slug']);
        $price = new ProductPrice($productDetails['price']);
        $description = new ProductDescription($productDetails['description']);

        $product = new Product($productId, $name, $slug, $price, $description);

        $productName = $this->productRepository->create($product);
        return "Product created with ID: $productName";
    }
}