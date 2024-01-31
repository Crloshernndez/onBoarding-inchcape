<?php

namespace App\Core\Onboarding\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

trait SoftDeletableEntityTrait
{
    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    protected ?\DateTimeInterface $deletedAt = null;

    public function getDeleteAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }

    /**
     * @return $this
     */
    public function setDeleteAt(?\DateTimeInterface $deletedAt): static
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}
