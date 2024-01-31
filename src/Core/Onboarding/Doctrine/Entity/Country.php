<?php

namespace App\Core\Onboarding\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

/**
 * @ORM\Entity
 * @ORM\Table(name="country")
 */
class Country
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer", options={unsigned: true")
     */
    public int $id;

    /**
     * @ORM\Column(type="string", length=50 nullable=false)
     */
    public string $name;

    /**
     * @ORM\Column(type="string", length=2 nullable=false)
     */
    public string $code;
}