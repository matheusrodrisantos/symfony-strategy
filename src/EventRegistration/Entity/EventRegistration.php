<?php

namespace App\EventRegistration\Entity;


use App\EventRegistration\Repository\EventRegistrationRepository;

use App\User\Entity\User;
use App\Event\Entity\Event;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: EventRegistrationRepository::class)]
#[ORM\HasLifecycleCallbacks]
class EventRegistration
{
    public const STATUS_PENDING = 'PENDING';
    public const STATUS_PAID = 'PAID';
    public const STATUS_CANCELED = 'CANCELED';

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

    #[ORM\Column(nullable:false)]
    private ?float $value = null;

    #[ORM\Column(nullable:true)]
    private ?float $valuePaid = null;

    #[ORM\Column(nullable: false)]
    private ?string $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->status=self::STATUS_PENDING;
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
        return $this->value;
    }

    public function setValue(?float $value): ?static
    {
        $this->value=$value;
        return $this;
    }

    public function getValuePaid() : ?float {
        return $this->valuePaid;
    }

    public function setValuePaid( ? float $valuePaid) : ?static{
        $this->valuePaid=$valuePaid;
        return $this;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus(?string $status): ?static {

        $this->status = match($status){
            null => throw new \InvalidArgumentException("Status não pode ser nulo"),
            self::STATUS_CANCELED,
            self::STATUS_PAID,
            self::STATUS_PENDING =>$status,
            default => throw new \InvalidArgumentException("Status inválido: $status"),
        };
        
        return $this;
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
