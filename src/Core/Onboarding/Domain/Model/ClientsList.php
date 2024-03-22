<?php

namespace App\Core\Onboarding\Domain\Model;

class ClientsList
{
    private int $count;

    /**
     * @param array<Client|null> $clients
     */
    public function __construct(
        private array $clients
    )
    {
        $this->count = count($this->clients);
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getNodes() : array
    {
        return $this->clients;
    }
}