<?php

namespace App\Entity;

use App\Entity\Trait\CreatedUpdatedAtTrait;
use App\Entity\Trait\EnabledTrait;
use App\Entity\Trait\IdTrait;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class), ORM\HasLifecycleCallbacks]
#[ORM\Index(fields: ['enabled', 'dateAdd'])]
class Post
{
    use IdTrait, EnabledTrait, CreatedUpdatedAtTrait;

    #[ORM\OneToMany(targetEntity: PostTranslation::class, mappedBy: 'post', orphanRemoval: true, cascade: ["all"])]
    private Collection $translations;

    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function setTranslations(Collection $translations): self
    {
        $this->translations = $translations;

        return $this;
    }
}
