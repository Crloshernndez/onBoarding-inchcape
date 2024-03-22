<?php

namespace App\Infrastructure\Symplify\EasyHydrator\src;

use Symfony\Contracts\Cache\CacheInterface;

use Symfony\Component\Cache\Adapter\ArrayAdapter;

class ArrayToValueObjectHydrator
{
    public function __construct(
        private CacheInterface $cache,
        private ClassConstructorValuesResolver $classConstructorValuesResolver
    )
    {
    }

    public function hydrateArray(mixed $data, string $class): object
    {
        $serializedData = \serialize($data);
        $arrayHash = \md5($serializedData . $class);
        
        $result = $this->cache->get($arrayHash, function () use ($class, $data) {
            $resolverClassConstructorValues = $this->classConstructorValuesResolver->resolve($class, $data);

            return new $class(...$resolverClassConstructorValues);
        });

        return $result;

    }

}