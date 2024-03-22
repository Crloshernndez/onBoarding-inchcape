<?php

namespace App\Infrastructure\Symplify\EasyHydrator\src;

use App\Infrastructure\Symplify\PackageBuilder\src\Strings\StringFormatConverter;
use ReflectionParameter;

class ParameterValueResolver
{
    public function __construct(private StringFormatConverter $stringFormatConverter)
    {
    }

    /**
     * @param mixed[] $data
     */
    public function getValue(ReflectionParameter $reflectionParameter, mixed $data)
    {
        $parameterName = $reflectionParameter->name;

        $underscoreParameterName = $this->stringFormatConverter->camelCaseToUnderscore($parameterName);
        
        if(\array_key_exists($parameterName, $data)) {
            return $data[$parameterName];
        }

        if(\array_key_exists($underscoreParameterName, $data)) {
            return $data[$underscoreParameterName];
        }

        if($reflectionParameter->isDefaultValueAvailable()) {
            return $reflectionParameter->getDefaultValue();
        }

        $declaringReflectionClass = $reflectionParameter->getDeclaringClass();

        sprintf('Missing data of "$%s" parameter for hydrated class "%s" __construct method.',
        $parameterName,
        null !== $declaringReflectionClass ? $declaringReflectionClass->getName() : '');
    }
}