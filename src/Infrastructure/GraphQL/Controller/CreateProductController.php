<?php

namespace App\Infrastructure\GraphQL\Controller;

use App\Core\Product\Application\CreateProductService;
use App\Core\Product\Domain\Model\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateProductController
{
    public function __construct(
        private CreateProductService $createProductService
        )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $product = new Product(
            $data['name'],
            $data['price'],
            $data['description'],
            $data['slug']
        );

        $this->createProductService->registerProduct($product);

        return new JsonResponse(['product' => [
            'name'=>$product->getName(),
            'price'=>$product->getprice(),
            'description'=>$product->getdescription(),
            'slug'=>$product->getslug()
            ]
        ]
        , JsonResponse::HTTP_CREATED);
    }
}