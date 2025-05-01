<?php

namespace App\Event\DTO;

use Symfony\Component\Validator\Constraints as Assert;
use App\Shared\DTO\InputDto;

class EventInputDTO implements InputDto
{
    #[Assert\NotBlank(message: "O nome é obrigatório.", groups: ['create'])]
    #[Assert\Length(min: 2, max: 255, minMessage: "O nome deve ter pelo menos {{ limit }} caracteres.", groups: ['create', 'update'])]
    public readonly ?string $name;

    #[Assert\NotBlank(message: "O type é obrigatório.", groups: ['create'])]
    public readonly ?string $type;

    #[Assert\NotNull(message: "O campo 'free' é obrigatório.", groups: ['create'])]
    public readonly ?bool $free;

    #[Assert\NotNull(message: "O value é obrigatório.", groups: ['create'])]
    #[Assert\Type(type: 'float', message: "O value deve ser um número decimal.", groups: ['create', 'update'])]
    public readonly ?float $value;

    #[Assert\NotNull(message: "A data de início é obrigatória.", groups: ['create'])]
    #[Assert\Type(type: \DateTimeImmutable::class, message: "A data de início deve ser uma data válida.", groups: ['create', 'update'])]
    public readonly ?\DateTimeImmutable $startDate;

    #[Assert\NotNull(message: "A data de fim é obrigatória.", groups: ['create'])]
    #[Assert\Type(type: \DateTimeImmutable::class, message: "A data de fim deve ser uma data válida.", groups: ['create', 'update'])]
    public readonly ?\DateTimeImmutable $endDate;

    #[Assert\NotNull(message: "O campo 'online' é obrigatório.", groups: ['create'])]
    #[Assert\Type(type: 'bool', message: "O campo 'online' deve ser verdadeiro ou falso.", groups: ['create', 'update'])]
    public readonly ?bool $online;

    #[Assert\NotNull(message: "O campo 'inPerson' é obrigatório.", groups: ['create'])]
    #[Assert\Type(type: 'bool', message: "O campo 'inPerson' deve ser verdadeiro ou falso.", groups: ['create', 'update'])]
    public readonly ?bool $inPerson;

    public function __construct(
        ?string $name,
        ?string $type,
        ?bool $free,
        ?float $value,
        ?\DateTimeImmutable $startDate,
        ?\DateTimeImmutable $endDate,
        ?bool $online,
        ?bool $inPerson
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->free = $free;
        $this->value = $value;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->online = $online;
        $this->inPerson = $inPerson;
    }
}
