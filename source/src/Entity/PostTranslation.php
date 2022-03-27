<?php

namespace App\Entity;

use App\Entity\Trait\IdTrait;
use App\Enum\PostLanguageEnum;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class PostTranslation
{
    use IdTrait;

    #[ORM\ManyToOne(targetEntity: Post::class, inversedBy: 'translations')]
    private Post $post;

    #[ORM\Column(type: Types::STRING, length: 2)]
    private string $language;

    #[ORM\Column(type: Types::STRING, length: 250)]
    private string $title;

    #[ORM\Column(type: Types::TEXT)]
    private string $text;

    public function getPost(): Post
    {
        return $this->post;
    }

    public function setPost(Post $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getLanguage(): PostLanguageEnum
    {
        return PostLanguageEnum::from($this->language);
    }

    public function setLanguage(PostLanguageEnum $language): self
    {
        $this->language = $language->value;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
