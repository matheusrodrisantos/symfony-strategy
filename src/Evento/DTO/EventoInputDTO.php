<?php

namespace App\Evento\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class EventoInputDTO
{
    #[Assert\NotBlank(message: "O nome é obrigatório.", groups: ['create'])]
    #[Assert\Length(min: 2, max: 255, minMessage: "O nome deve ter pelo menos {{ limit }} caracteres.", groups: ['create', 'update'])]
    public readonly ?string $name;

    #[Assert\NotBlank(message: "O tipo é obrigatório.", groups: ['create'])]
    public readonly ?string $tipo;

    #[Assert\NotBlank(message: "O campo 'aberto' é obrigatório.", groups: ['create'])]
    public readonly ?string $aberto;

    #[Assert\NotNull(message: "O valor é obrigatório.", groups: ['create'])]
    #[Assert\Type(type: 'float', message: "O valor deve ser um número decimal.", groups: ['create', 'update'])]
    public readonly ?float $valor;

    #[Assert\NotNull(message: "A data de início é obrigatória.", groups: ['create'])]
    #[Assert\Type(type: \DateTimeImmutable::class, message: "A data de início deve ser uma data válida.", groups: ['create', 'update'])]
    public readonly ?\DateTimeImmutable $dataInicio;

    #[Assert\NotNull(message: "A data de fim é obrigatória.", groups: ['create'])]
    #[Assert\Type(type: \DateTimeImmutable::class, message: "A data de fim deve ser uma data válida.", groups: ['create', 'update'])]
    public readonly ?\DateTimeImmutable $dataFim;

    #[Assert\NotNull(message: "O campo 'online' é obrigatório.", groups: ['create'])]
    #[Assert\Type(type: 'bool', message: "O campo 'online' deve ser verdadeiro ou falso.", groups: ['create', 'update'])]
    public readonly ?bool $online;

    #[Assert\NotNull(message: "O campo 'presencial' é obrigatório.", groups: ['create'])]
    #[Assert\Type(type: 'bool', message: "O campo 'presencial' deve ser verdadeiro ou falso.", groups: ['create', 'update'])]
    public readonly ?bool $presencial;

    public function __construct(
        ?string $name,
        ?string $tipo,
        ?string $aberto,
        ?float $valor,
        ?\DateTimeImmutable $dataInicio,
        ?\DateTimeImmutable $dataFim,
        ?bool $online,
        ?bool $presencial
    ) {
        $this->name = $name;
        $this->tipo = $tipo;
        $this->aberto = $aberto;
        $this->valor = $valor;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->online = $online;
        $this->presencial = $presencial;
    }
}
