<?php

namespace App\Infrastructure\GraphQL\Adapter;

use App\Core\Product\Domain\Ports\ProductGraphQLAdapterInterface;
use App\Core\Product\Application\ProductCustomizerService;
use App\Core\Product\Application\CreateProductService;
use App\Core\Product\Domain\Model\Product;

class ProductGraphQLAdapter implements ProductGraphQLAdapterInterface
{

    public function __construct(
        private ProductCustomizerService $productCustomizerService,
        private CreateProductService $createProductService
        )
    {
    }

    public function getAllProducts(): array
    {
        
        return $this->productCustomizerService->searchProducts();
    }

    public function getProductById(string $id): ?Product
    {

        return $this->productCustomizerService->searchProductById($id);
    }

    public function createProduct(array $productDetails): string
    {

        return $this->createProductService->createProduct($productDetails);
    }
}