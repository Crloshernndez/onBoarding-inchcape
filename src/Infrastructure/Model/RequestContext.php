<?php

namespace App\Infrastructure\Model;

use App\Core\Common\Model\Dimentions;

/**
 * @extends \ArrayObject<string, mixed>
 */
class RequestContext extends \ArrayObject
{
    private mixed $session = null;

    /**
     * @param \ArrayObject<string, mixed> $context
     */
    public function __construct(
        \ArrayObject $context,
        private Dimentions $dimentions,
    ) {
        /**
         * @var class-string $class 
         */
        $className = $context->getIteratorClass();

        parent::__construct($context->getArrayCopy(), $context->getFlags(), $className);
    }

    /**
     * @param \ArrayObject<string, mixed> $context
     */
    public static function CreateFromExistingContext(
        \ArrayObject $context,
        Dimentions $dimentions
    ) : self {
        $defaultValue = null;
        return new self($context, $dimentions, $defaultValue);
    }

    public function getDimentions(): Dimentions
    {
        return $this->dimentions;
    }
}