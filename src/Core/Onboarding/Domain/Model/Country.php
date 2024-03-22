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
}