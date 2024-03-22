<?php

namespace App\Infrastructure\Symplify\EasyHydrator\src;

use App\Infrastructure\Symplify\EasyHydrator\src\TypeCastersCollector;
use App\Infrastructure\Symplify\EasyHydrator\src\ParameterValueResolver;

use ReflectionMethod;
use ReflectionClass;


class ClassConstructorValuesResolver
{
    public function __construct(
        private TypeCastersCollector $typeCastersCollector,
        private ParameterValueResolver $parameterValueResolver
    )
    {
    }

    /**
     * @return array<int, mixed>
     */
    public function resolve(string $class, mixed $data): array
    {
        $arguments = [];

        $constructorReflectionMethod = $this->getConstructorMethodReflection($class);
        $parameterReflections = $constructorReflectionMethod->getParameters();

        foreach ($parameterReflections as $parameterReflection)
        {
            $value = $this->parameterValueResolver->getValue($parameterReflection, $data);
            
            $arguments[] = $this->typeCastersCollector->retype($value, $parameterReflection, $this);
            
        }

        return $arguments;
    }

    public function getConstructorMethodReflection(string $class): ReflectionMethod
    {
        $reflectionClass = new ReflectionClass($class);
        
        $constructorReflectionMethod = $reflectionClass->getConstructor();

        if(!$constructorReflectionMethod instanceof ReflectionMethod){
            sprintf('Hydrated class "%s" is missing constructor.', $class);
        }

        return $constructorReflectionMethod;
    }
}