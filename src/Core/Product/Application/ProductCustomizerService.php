<?php

namespace App\Core\Product\Application;

use App\Core\Product\Domain\Model\Product;
use App\Core\Product\Domain\Ports\ProductRepositoryInterface;

class ProductCustomizerService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
        )
    {
    }

    public function searchProducts(): array
    {
        $products = $this->productRepository->findAll();

        return $products;
    }

    public function searchProductById(string $id): ?Product
    {  
        return $this->productRepository->findOneById($id);
    }

    // public function updateProduct(string $id, array $data): Product
    // {
    //     $fieldsToUpdate = [];
    //     $params = ['id' => $id];
    
    //     foreach ($data as $key => $value) {
    //         $fieldsToUpdate[] = "$key = :$key";
    //         $params[$key] = $value;
    //     }
    
    //     if (empty($fieldsToUpdate)) {
    //         dd('No se proporcionaron datos para actualizar');
    //     }
    
    //     $query = sprintf("UPDATE product SET %s WHERE id = :id", implode(', ', $fieldsToUpdate));
    //     $updatedProduct = $this->productRepository->updateProduct($query, $params);
    
    //     if (null === $updatedProduct) {
    //         dd('No se pudo actualizar el producto');
    //     }
    
    //     return $updatedProduct;
    // }

    // public function deleteProduct(string $id): Product
    // {
    //     $query = "DELETE FROM product WHERE id = :id";
    //     $params = ['id' => $id];

    //     $productDeleted = $this->productRepository->deleteProduct($query, $params);

    //     if (null === $productDeleted) {
    //         dd('No se pudo eliminar el producto');
    //     }

    //     return $productDeleted;
    // }
}