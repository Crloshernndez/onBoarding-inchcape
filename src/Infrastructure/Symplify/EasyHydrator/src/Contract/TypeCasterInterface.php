<?php

namespace App\Infrastructure\Symplify\EasyHydrator\src\Contract;

use App\Infrastructure\Symplify\EasyHydrator\src\ClassConstructorValuesResolver;
use ReflectionParameter;

interface TypeCasterInterface
{
    public function getPriority(): int;

    public function isSupported(ReflectionParameter $reflectionParameter): bool;

    public function retype(
        mixed $value,
        ReflectionParameter $reflectionParameter,
        ClassConstructorValuesResolver $classConstructorValuesResolver
    ): mixed;
}