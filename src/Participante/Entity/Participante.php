<?php

namespace App\Participante\Entity;

use App\Participante\Repository\ParticipanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Evento\Entity\Evento;

#[ORM\Entity(repositoryClass: ParticipanteRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Participante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

    #[ORM\Column(length: 14)]
    private ?string $cpf = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dataNascimento = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $numero = null;

    #[ORM\Column]
    private ?bool $aceiteLgpd = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, Evento>
     */
    #[ORM\ManyToMany(targetEntity: Evento::class, inversedBy: 'participantes')]
    private Collection $eventos;

    public function __construct()
    {
        $this->eventos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): static
    {
        $this->nome = $nome;

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

    public function getDataNascimento(): ?\DateTimeInterface
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(\DateTimeInterface $dataNascimento): static
    {
        $this->dataNascimento = $dataNascimento;

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

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function isAceiteLgpd(): ?bool
    {
        return $this->aceiteLgpd;
    }

    public function setAceiteLgpd(bool $aceiteLgpd): static
    {
        $this->aceiteLgpd = $aceiteLgpd;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }


    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function setUpadteAtValue(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }


    /**
     * @return Collection<int, Evento>
     */
    public function getEventos(): Collection
    {
        return $this->eventos;
    }

    public function addEvento(Evento $evento): static
    {
        if (!$this->eventos->contains($evento)) {
            $this->eventos->add($evento);
        }

        return $this;
    }

    public function removeEvento(Evento $evento): static
    {
        $this->eventos->removeElement($evento);

        return $this;
    }
}
