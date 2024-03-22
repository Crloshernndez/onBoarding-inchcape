<?php

namespace App\Infrastructure\Symplify\EasyHydrator\src;

use App\Infrastructure\Symplify\EasyHydrator\src\Contract\TypeCasterInterface;

use ReflectionParameter;

class TypeCastersCollector
{
    /**
     * @var TypeCasterInterface[]
     */
    private array $typeCasters = [];

    /**
     * @param TypeCasterInterface[] $typeCasters
     */
    public function __construct(array $typeCasters)
    {
        $this->typeCasters = $this->sortCastersByPriority($typeCasters);
    }

    public function retype(
        mixed $value,
        ReflectionParameter $reflectionParameter,
        ClassConstructorValuesResolver $classConstructorValueResolver
    ): mixed
    {
        foreach ($this->typeCasters as $typeCaster)
        {
            if($typeCaster->isSupported($reflectionParameter)) {
                return $typeCaster->retype($value, $reflectionParameter, $classConstructorValueResolver);
            }
        }

        return $value;
    }

    /**
     * @param TypeCasterInterface[] $typeCasters
     * @return TypeCasterInterface[]
     */
    public function sortCastersByPriority(array $typeCasters): array
    {

        \usort(
            $typeCasters,
            static function (TypeCasterInterface $firstTypeCaster, TypeCasterInterface $secondTypeCaster): int {
                return $firstTypeCaster->getPriority() <=> $secondTypeCaster->getPriority();
            }
        );

        return $typeCasters;
    }
}