<?php

namespace App\Core\Onboarding\Application;

use App\Core\Onboarding\Doctrine\Repository\ClientRepository;
use App\Core\Onboarding\Domain\Model\Client;
use App\Core\Onboarding\Domain\Model\ClientsList;
use App\Core\Common\Model\Dimentions;

class ClientSearchService
{
    public function __construct(
        private ClientRepository $clientRepository
    )
    {
    }

    public function getClients(Dimentions $dimensions): ClientsList
    {
        $query = "SELECT * FROM client
                WHERE deleted_at IS NULL
                AND brand = :brand
                AND region = :region
                AND country = :country
                AND language = :language
                ";
        $params = [
            'brand' => $dimensions->getBrand(),
            'region' => $dimensions->getRegion(),
            'country' => $dimensions->getCountry(),
            'language' => $dimensions->getLanguage()
        ];
        $result = $this->clientRepository->getClients($query, $params);

        return new ClientsList($result);
    }

    public function getClientById($id): Client
    {
        $query = "SELECT * FROM client WHERE id = :id";
        $params = ['id' => $id];
        
        $result = $this->clientRepository->getClient($query, $params);

        return new Client($result);
    }

}