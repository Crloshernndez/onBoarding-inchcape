<?php

namespace App\Infrastructure\GraphQL\Controller;

use App\Core\Product\Application\CreateProductService;
use App\Core\Product\Domain\Model\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Overblog\GraphQLBundle\Definition\ArgumentInterface;

class CreateProductController
{
    public function __construct(
        private CreateProductService $createProductService
        )
    {
    }

    public function __invoke(ArgumentInterface $args)
    {
        $product = new Product(
            $args['input']['name'],
            $args['input']['price'],
            $args['input']['description'],
            $args['input']['slug']
        );
        
        $this->createProductService->registerProduct($product);


        return $product;
    }
}