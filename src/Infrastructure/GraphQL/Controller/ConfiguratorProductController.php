<?php

namespace App\Infrastructure\GraphQL\Controller;

use App\Core\Product\Application\ProductCustomizerService;
use App\Core\Product\Domain\Model\Product;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Overblog\GraphQLBundle\Definition\ArgumentInterface;

class ConfiguratorProductController
{
    public function __construct(
        private ProductCustomizerService $productCustomizerService
        )
    {
    }

    public function SearchAllProducts(): array
    {
        // $data = json_decode($request->getContent(), true); 

        $products = $this->productCustomizerService->searchProducts();

        return $products;
    }

    public function SearchProductById(ArgumentInterface $args)
    {
        $id = $args->offsetGet('id');
        // $data = json_decode($request->getContent(), true);
        $product = $this->productCustomizerService->searchProduct($id);

        return $product;
    }

    public function UpdateProduct(Request $request, string $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $updatedProduct = $this->productCustomizerService->updateProduct($id, $data);

        return new JsonResponse(['updated_product' => [
            'name'=>$updatedProduct->getName(),
            'price'=>$updatedProduct->getprice(),
            'description'=>$updatedProduct->getdescription(),
            'slug'=>$updatedProduct->getslug()]], 
            JsonResponse::HTTP_OK);
    }

    public function DeleteProduct(Request $request, string $id): JsonResponse
    {
        $deletedProduct = $this->productCustomizerService->deleteProduct($id);

        return new JsonResponse(['updated_product' => [
            'name'=>$deletedProduct->getName(),
            'price'=>$deletedProduct->getprice(),
            'description'=>$deletedProduct->getdescription(),
            'slug'=>$deletedProduct->getslug()]], 
            JsonResponse::HTTP_OK);
    }
}