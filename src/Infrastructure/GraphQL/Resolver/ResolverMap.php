<?php

namespace App\Infrastructure\GraphQL\Resolver;

use App\Infrastructure\GraphQL\Controller\CreateProductController;
use App\Infrastructure\GraphQL\Controller\ConfiguratorProductController;

use GraphQL\Executor\Promise\Promise;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Definition\ArgumentInterface;
use Overblog\GraphQLBundle\Resolver\ResolverMap as BaseResolverMap;
use Psr\Container\ContainerInterface;

class ResolverMap extends BaseResolverMap
{
    private ?ArgumentInterface $rootArguments = null;

    public function __construct(
        private ContainerInterface $serviceLocator
    ) {
    }

    protected function map(): array
    {
        return [
            'Query' => [
                'searchProduct' => fn(
                    $value,
                    ArgumentInterface $args
                ) => $this->serviceLocator->get(ConfiguratorProductController::class->SearchProductById($arg)),
                ],
            'Mutation' => [
                'createProduct' => fn(
                    $value,
                    ArgumentInterface $args
                ) => $this->serviceLocator->get(CreateProductController::class->__invoke($arg))
            ]
        ];
    }
}