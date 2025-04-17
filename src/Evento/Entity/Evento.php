<?php

namespace App\Evento\Entity;

use App\Evento\Repository\EventoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Participante\Entity\Participante;

#[ORM\Entity(repositoryClass: EventoRepository::class)]
class Evento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $tipo = null;

    #[ORM\Column(length: 255)]
    private ?string $aberto = null;

    #[ORM\Column]
    private ?float $valor = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dataInicio = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dataFim = null;

    #[ORM\Column]
    private ?bool $online = null;

    #[ORM\Column]
    private ?bool $presencial = null;

    /**
     * @var Collection<int, Participante>
     */
    #[ORM\ManyToMany(targetEntity: Participante::class, mappedBy: 'eventos')]
    private Collection $participantes;

    public function __construct()
    {
        $this->participantes = new ArrayCollection();
    }

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

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getAberto(): ?string
    {
        return $this->aberto;
    }

    public function setAberto(string $aberto): static
    {
        $this->aberto = $aberto;

        return $this;
    }

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): static
    {
        $this->valor = $valor;

        return $this;
    }

    public function getDataInicio(): ?\DateTimeInterface
    {
        return $this->dataInicio;
    }

    public function setDataInicio(\DateTimeInterface $dataInicio): static
    {
        $this->dataInicio = $dataInicio;

        return $this;
    }

    public function getDataFim(): ?\DateTimeInterface
    {
        return $this->dataFim;
    }

    public function setDataFim(\DateTimeInterface $dataFim): static
    {
        $this->dataFim = $dataFim;

        return $this;
    }

    public function isOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(bool $online): static
    {
        $this->online = $online;

        return $this;
    }

    public function isPresencial(): ?bool
    {
        return $this->presencial;
    }

    public function setPresencial(bool $presencial): static
    {
        $this->presencial = $presencial;

        return $this;
    }

    /**
     * @return Collection<int, Participante>
     */
    public function getParticipantes(): Collection
    {
        return $this->participantes;
    }

    public function addParticipante(Participante $participante): static
    {
        if (!$this->participantes->contains($participante)) {
            $this->participantes->add($participante);
            $participante->addEvento($this);
        }

        return $this;
    }

    public function removeParticipante(Participante $participante): static
    {
        if ($this->participantes->removeElement($participante)) {
            $participante->removeEvento($this);
        }

        return $this;
    }
}
