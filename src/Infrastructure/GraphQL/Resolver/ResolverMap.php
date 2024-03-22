<?php

namespace App\Infrastructure\GraphQL\Resolver;

use App\Infrastructure\GraphQL\Controller\CreateProductController;
use App\Infrastructure\GraphQL\Controller\ConfiguratorProductController;
use App\Infrastructure\GraphQL\Controller\ClientController;
use App\Infrastructure\Model\RequestContext;

use GraphQL\Executor\Promise\Promise;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Definition\ArgumentInterface;
use Overblog\GraphQLBundle\Resolver\ResolverMap as BaseResolverMap;
use Psr\Container\ContainerInterface;

/**
 * @SuppressWarnings(PHPMD.ExcessiveClassLength)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ResolverMap extends BaseResolverMap
{
    private ?ArgumentInterface $rootArguments = null;

    public function __construct(
        private ContainerInterface $serviceLocator
    ) {
    }

    /**
     * @SuppressWarnings(PHPMD)
     * @return array<string, mixed>
     */
    protected function map(): array
    {
        return [
            'Query' => [
                'searchProducts' => function (
                    $value,
                    ArgumentInterface $args,
                    $context,
                    ResolveInfo $info
                ) {
                    return $this->serviceLocator
                        ->get(ConfiguratorProductController::class)
                        ->SearchAllProducts($args, $context);
                },
                'searchProduct' => function (
                    $value,
                    ArgumentInterface $args
                ) {
                    return $this->serviceLocator
                        ->get(ConfiguratorProductController::class)
                        ->SearchProductById($args);
                },
                'searchClients' => function (
                    $value,
                    ArgumentInterface $args,
                    $context,
                    ResolveInfo $info
                ) {
                    return $this->serviceLocator
                        ->get(ClientController::class)
                        ->getClients($args, $context);
                },
                'searchClient' => function (
                    $value,
                    ArgumentInterface $args
                ) {
                    $client = $this->serviceLocator
                        ->get(ClientController::class)
                        ->searchClient($args);

                    return $client;
                }
                ],
            'Mutation' => [
                'createProduct' => fn(
                    $value,
                    ArgumentInterface $args
                ) => $this->serviceLocator->get(CreateProductController::class)->createProduct($args)
            ]
        ];
    }
}