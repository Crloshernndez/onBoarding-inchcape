<?php

namespace App\Core\Product\Doctrine\Entity;

use App\Core\Product\Doctrine\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 *  
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column
     */
    public ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public ?string $name;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    public ?float $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public ?string $description = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public ?string $slug = null;
}