<?php

namespace App\Core\Onboarding\Doctrine\Entity;

use App\Core\Onboarding\Doctrine\Entity\RmbAwareEntityTrait;
use App\Core\Onboarding\Doctrine\Entity\SoftDeletableEntityTrait;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

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
     * @ORM\Column(type="integer", options={unsigned: true")
     */
    public int $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    public string $firstName;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    public string $lastName;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    public bool $newsletter;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public string $language;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public string $source;
    
    /**
     * @ORM\Column(type="json", options={"jsonb"="true}, nullable=false)
     * 
     * @var string[];
     */
    public array $data;

    /**
     * @ORM\Column(type="json", options={"jsonb"="true}, nullable=false)
     * 
     * @var string[];
     */
    public array $address;

    /**
     * @ORM\Column(type="datetimez")
     * 
     * @Gedmo\Timestampable(on="create");
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetimez")
     * 
     * @Gedmo\Timestampable(on="update");
     */
    private \DateTimeInterface $updatedAt;
}