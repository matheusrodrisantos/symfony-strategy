<?php

namespace App\EventRegistration\Entity;


use App\EventRegistration\Repository\EventRegistrationRepository;

use App\User\Entity\User;
use App\Event\Entity\Event;
use App\EventRegistration\Entity\Money;
use App\EventRegistration\Entity\Status;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Embedded;

#[ORM\Entity(repositoryClass: EventRegistrationRepository::class)]
#[ORM\HasLifecycleCallbacks]
class EventRegistration
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "eventRegistrations")]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Event::class, inversedBy: "eventRegistrations")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Event $event = null;

    #[Embedded(class:Money::class, columnPrefix:false)]
    private ?Money $money = null;

    #[Embedded(class:Status::class, columnPrefix:false)]
    private ?Status $status;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct(
        Status $status, 
        Money $money
    ){  
        $this->money=$money;
        $this->status=$status;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;
        return $this;
    }

    public function getValue():?float 
    {
        return $this->money->getValue();
    }

    public function getValuePaid():?float 
    {
        return $this->money->getValuePaid();
    }
    
    public function getStatus():? Status {
        return $this->status;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): static
    {
        $this->event = $event;
        return $this;
    }


    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
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
}
