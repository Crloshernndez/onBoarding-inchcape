<?php

namespace App\Core\Onboarding\Domain\Model;

class Country
{
    public function __construct(
        private string $name,
        private string $code
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}