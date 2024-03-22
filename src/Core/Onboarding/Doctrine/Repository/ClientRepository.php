<?php

namespace App\Core\Onboarding\Doctrine\Repository;

use App\Core\Onboarding\Doctrine\Entity\Client;
use App\Core\Onboarding\Domain\Model\Client as DomainClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Core\Common\Service\NullableArrayToObjectHydrator;
use Doctrine\Persistence\ManagerRegistry;

class ClientRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private NullableArrayToObjectHydrator $hydrator
        )
    {
        parent::__construct($registry, Client::class);
    }

    public function getClients(string $query, array $params) : array
    {
        $data = $this->getEntityManager()
        ->getConnection()
        ->executeQuery($query, $params)
        ->fetchAllAssociative();
  
        return $this->hydrateClientsFromArray($data);
    }

    public function getClient(string $query, array $params): Client
    {

        $data = $this->getEntityManager()
            ->getConnection()
            ->executeQuery($query, $params)
            ->fetchAll();

        return $this->hydrateClientsFromArray($data);
    }

    private function hydrateClientFromArray(array $data): DomainClient
    {
        $data['data'] = \json_decode($data['data'], true);
        $data['address'] = \json_decode($data['address'], true);

        /**
         * @var DomainClient
         */
        return $this->hydrator->hydrateArray($data, DomainClient::class);
    }

    private function hydrateClientsFromArray(array $data) : array
    {
        $hydrateData = [];

        foreach ($data as $clientData) {
            $hydrateData[] = $this->hydrateClientFromArray($clientData);
        }

        return $hydrateData;
    }

}