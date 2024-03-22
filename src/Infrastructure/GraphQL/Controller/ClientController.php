<?php

namespace App\Infrastructure\GraphQL\Controller;

use App\Core\Onboarding\Domain\Model\Client;
use App\Core\Onboarding\Domain\Model\ClientsList;
use App\Core\Common\Model\Dimentions;
use App\Core\Onboarding\Application\ClientSearchService;
use App\Infrastructure\Model\RequestContext;

use Overblog\GraphQLBundle\Definition\ArgumentInterface;

class ClientController
{
    public function __construct(
        private ClientSearchService $clientSearchService
        )
    {
    }

    public function createRequestContext($context)
    {
        $contextArray = $context['request']->server->all();
        
        $dimentions = new Dimentions(
            $contextArray['HTTP_REGION'],
            $contextArray['HTTP_COUNTRY'],
            $contextArray['HTTP_LANGUAGE'],
            $contextArray['HTTP_BRAND'],
        );
        
        return new RequestContext(new \ArrayObject($context['request']), $dimentions);
    }

    public function searchClient(ArgumentInterface $args) : Client
    {
        $id = $this->getClientId($args);

        return $this->clientSearchService->getClientById($id);
    }

    public function getClients(ArgumentInterface $args, $context): ClientsList
    {
        $requestContext = $this->createRequestContext($context);

        return $this->clientSearchService->getClients($requestContext->getDimentions());
    }

    public function getClientId(ArgumentInterface $args) : string
    {
        return $args->offsetGet('id');
    }
}