<?php

namespace App\Core\Common\Service;

use App\Infrastructure\Symplify\EasyHydrator\src\ArrayToValueObjectHydrator;

class NullableArrayToObjectHydrator
{
    public function __construct(private ArrayToValueObjectHydrator $hydrator)
    {
    }

    public function hydrateArray(array $data, string $class): object
    {
        return $this->hydrator->hydrateArray($data, $class);
    }
}