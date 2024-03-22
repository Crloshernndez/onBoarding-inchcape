<?php

namespace App\Core\Onboarding\Doctrine\Entity;

use App\Core\Onboarding\Domain\Model\Rmb;
use Doctrine\ORM\Mapping as ORM;


trait RmbAwareEntityTrait
{
    /**
     * @ORM\Column(type="string")
     */
    private string $region;

    /**
     * @ORM\ManyToOne(targetEntity="Country"),
     * @ORM\JoinColumn(referencedColumnName="id", nullable=false)
     */
    private Country $country_id;

    /**
     * @ORM\Column(type="string")
     */
    private string $brand;

    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @return $this
     */
    public function setRegion(string $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getCountry_id(): Country
    {
        return $this->country_id;
    }

    /**
     * @return $this
     */
    public function setCountry_id(Country $country_id): static
    {
        $this->country_id = $country_id;

        return $this;
    }
    
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @return $this
     */
    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getRmb(): Rmb
    {
        return new Rmb($this->region, $this->country_id, $this->brand);
    }

    /**
     * @return $this
     */
    public function setRmb(Rmb $rmb): static
    {
        $this->region = $rmb->getRegion();
        $this->country_id = $rmb->getCountry_id();
        $this->brand = $rmb->getBrand();

        return $this;
    }
}