<?php

namespace App\Infrastructure\GraphQL\Controller;

use App\Core\Product\Domain\Model\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Overblog\GraphQLBundle\Definition\ArgumentInterface;
use App\Core\Product\Domain\Ports\ProductGraphQLAdapterInterface;

class CreateProductController
{
    public function __construct(private ProductGraphQLAdapterInterface $productGraphQLAdapter)
    {
    }

    public function createProduct(ArgumentInterface $args)
    {
        $confirmation = $this->productGraphQLAdapter->createProduct($args['input']);

        return $confirmation;
    }
}