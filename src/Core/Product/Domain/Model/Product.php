<?php

namespace App\Core\Product\Domain\Model;

use App\Core\Product\Domain\ValueObjects\ProductId;
use App\Core\Product\Domain\ValueObjects\ProductName;
use App\Core\Product\Domain\ValueObjects\ProductSlug;
use App\Core\Product\Domain\ValueObjects\ProductPrice;
use App\Core\Product\Domain\ValueObjects\ProductDescription;

// use App\Core\Product\Doctrine\Repository\ProductRepository;
// use Doctrine\ORM\Mapping as ORM;

// #[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{

    public function __construct(
        private ProductId $id,
        private ProductName $name, 
        private ProductSlug $slug,
        private ProductPrice $price, 
        private ProductDescription $description
        )
    {

    }

    public function getId(): ?string
    {
        return $this->id->getValue();
    }

    public function getName(): ?string
    {
        return $this->name->getValue();
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price->getValue();
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description->getValue();
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug->getValue();
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
