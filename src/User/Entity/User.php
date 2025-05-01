<?php

namespace App\User\Entity;

use App\EventRegistration\Entity\EventRegistration;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\User\Repository\UserRepository;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
class User
{
    public function __construct()
    {    
        $this->eventRegistrations = new ArrayCollection();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 14)]
    private ?string $cpf = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeInterface $dateOfBirth = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phoneNumber = null;

    #[ORM\Column]
    private ?bool $lgpdAcceptance = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;


    #[ORM\OneToMany(mappedBy: "user", targetEntity: EventRegistration::class, cascade: ["persist", "remove"])]
    private Collection $eventRegistrations;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): static
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): static
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function isLgpdAcceptance(): ?bool
    {
        return $this->lgpdAcceptance;
    }

    public function setLgpdAcceptance(bool $lgpdAcceptance): static
    {
        $this->lgpdAcceptance = $lgpdAcceptance;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getEventRegistrations(): Collection
    {
        return $this->eventRegistrations;
    }

    public function addEventRegistration(EventRegistration $eventRegistration): static
    {
        if (!$this->eventRegistrations->contains($eventRegistration)) {
            $this->eventRegistrations[] = $eventRegistration;
            $eventRegistration->setUser($this);
        }

        return $this;
    }

    public function removeEventRegistration(EventRegistration $eventRegistration): static
    {
        if ($this->eventRegistrations->removeElement($eventRegistration)) {
            // desfaz a ligação do lado do EventRegistration
            if ($eventRegistration->getUser() === $this) {
                $eventRegistration->setUser(null);
            }
        }

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function setUpdateAtValue(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }
}

