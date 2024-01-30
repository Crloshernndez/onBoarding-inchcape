<?php

namespace App\Core\Product\Doctrine\Entity;

use App\Core\Product\Doctrine\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\Column(length: 255)]
    public ?string $name = null;

    #[ORM\Column]
    public ?float $price = null;

    #[ORM\Column(type: Types::TEXT)]
    public ?string $description = null;

    #[ORM\Column(length: 255)]
    public ?string $slug = null;
}