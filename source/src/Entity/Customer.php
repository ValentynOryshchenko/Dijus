<?php

namespace App\Entity;

use App\Entity\Trait\CreatedUpdatedAtTrait;
use App\Entity\Trait\EnabledTrait;
use App\Entity\Trait\IdTrait;
use App\Repository\CustomerRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: CustomerRepository::class), ORM\HasLifecycleCallbacks]
class Customer implements UserInterface
{
    use IdTrait, EnabledTrait, CreatedUpdatedAtTrait;

    #[ORM\Column(type: Types::STRING, length: 250)]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 100, unique: true)]
    private string $email;

    #[ORM\Column(type: Types::STRING, length: 100, unique: true)]
    private string $phone;

    #[ORM\Column(type: Types::STRING, length: 50)]
    private string $password;

    #[ORM\Column(type: Types::STRING, length: 10)]
    private string $roles;

    #[ORM\Column(type: Types::STRING, length: 2, nullable: true)]
    private string $country;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateLastLogin;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        return explode('|', $this->roles);
    }

    public function setRoles(string $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDateLastLogin(): ?\DateTimeInterface
    {
        return $this->dateLastLogin;
    }

    public function setDateLastLogin(?\DateTimeInterface $dateLastLogin): self
    {
        $this->dateLastLogin = $dateLastLogin;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->id;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }


}
