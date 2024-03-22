<?php

namespace App\Core\Onboarding\Doctrine\Entity;

use App\Core\Onboarding\Doctrine\Entity\RmbAwareEntityTrait;
use App\Core\Onboarding\Doctrine\Entity\SoftDeletableEntityTrait;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="client")
 */
class Client
{
    use RmbAwareEntityTrait;
    use SoftDeletableEntityTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private string $lastName;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private bool $newsletter;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private string $language;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private string $source;
    
    /**
     * @ORM\Column(type="json", options={"jsonb"=true}, nullable=false)
     * 
     * @var string[];
     */
    private array $data;

    /**
     * @ORM\Column(type="json", options={"jsonb"=true}, nullable=false)
     * 
     * @var string[];
     */
    private array $address;

    /**
     * @ORM\Column(type="datetimetz")
     * 
     * @Gedmo\Timestampable(on="create");
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetimetz")
     * 
     * @Gedmo\Timestampable(on="update");
     */
    private \DateTimeInterface $updatedAt; 

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return $this
     */
    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return $this
     */
    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getNewsletter(): bool
    {
        return $this->newsletter;
    }

    /**
     * @return $this
     */
    public function setNewsletter(string $newsletter): static
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return $this
     */
    public function setSource(string $source): static
    {
        $this->source = $source;

        return $this;
    }


    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @return $this
     */
    public function setLanguage(string $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array<string, scalar> $data
     * @return $this
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function getAddress(): array
    {
        return $this->address;
    }

    /**
     * @param array<string, scalar> $address
     * @return $this
     */
    public function setAddress(array $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @return $this
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}