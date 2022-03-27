<?php
declare(strict_types=1);

namespace App\Entity\Trait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Mapping as ORM;

trait CreatedUpdatedAtTrait
{
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeInterface $dateAdd;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateEdit;

    #[ORM\PreUpdate]
    public function setDateEditValue(PreUpdateEventArgs $args): void
    {
        $this->dateEdit = new \DateTime();
    }

    #[ORM\PrePersist]
    public function setDateAddValue(): void
    {
        $this->dateAdd = new \DateTimeImmutable();
    }

    public function getDateAdd(): \DateTimeInterface
    {
        return $this->dateAdd;
    }

    public function getDateEdit(): ?\DateTimeInterface
    {
        return $this->dateEdit;
    }
}
