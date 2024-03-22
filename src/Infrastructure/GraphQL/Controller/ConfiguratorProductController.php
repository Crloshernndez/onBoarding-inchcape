<?php

namespace App\Infrastructure\GraphQL\Controller;

use App\Core\Product\Application\ProductCustomizerService;
use App\Core\Product\Domain\Model\Product;
use App\Core\Product\Domain\Model\ProductsList;

use App\Core\Product\Domain\Ports\ProductGraphQLAdapterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Overblog\GraphQLBundle\Definition\ArgumentInterface;

class ConfiguratorProductController
{
    public function __construct(
        private ProductGraphQLAdapterInterface $productGraphQLAdapter
        )
    {
    }

    public function SearchAllProducts(): array
    {
        $products = $this->productGraphQLAdapter->getAllProducts();

        return $products;

    }

    public function SearchProductById(ArgumentInterface $args)
    {
        $id = $args->offsetGet('id');
        $product = $this->productGraphQLAdapter->getProductById($id);

        return $product;
    }

    // public function UpdateProduct(Request $request, string $id): JsonResponse
    // {
    //     $data = json_decode($request->getContent(), true);

    //     $updatedProduct = $this->productCustomizerService->updateProduct($id, $data);

    //     return new JsonResponse(['updated_product' => [
    //         'name'=>$updatedProduct->getName(),
    //         'price'=>$updatedProduct->getprice(),
    //         'description'=>$updatedProduct->getdescription(),
    //         'slug'=>$updatedProduct->getslug()]], 
    //         JsonResponse::HTTP_OK);
    // }

    // public function DeleteProduct(Request $request, string $id): JsonResponse
    // {
    //     $deletedProduct = $this->productCustomizerService->deleteProduct($id);

    //     return new JsonResponse(['updated_product' => [
    //         'name'=>$deletedProduct->getName(),
    //         'price'=>$deletedProduct->getprice(),
    //         'description'=>$deletedProduct->getdescription(),
    //         'slug'=>$deletedProduct->getslug()]], 
    //         JsonResponse::HTTP_OK);
    // }
}