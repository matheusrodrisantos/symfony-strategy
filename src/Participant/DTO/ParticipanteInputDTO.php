<?php

namespace App\Participant\DTO;

use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Shared\DTO\InputDto;

class ParticipantInputDTO implements InputDto
{
    #[Assert\NotNull(message: "O name é obrigatório.", groups:['create'])]
    #[Assert\Length(min: 2, max: 255, minMessage: "O name deve ter pelo menos {{ limit }} caracteres.", groups:['create','update'])]
    public readonly ?string $name;

    #[Assert\NotNull(message: "O CPF é obrigatório.", groups:['create'])]
    #[Assert\Length(exactly: 11, exactMessage: "O CPF deve ter exatamente {{ limit }} dígitos.",groups:['create','update'])]
    #[Assert\Regex(pattern: "/^\d{11}$/", message: "O CPF deve conter apenas números.")]
    public readonly ?string $cpf;

    #[Assert\NotNull(message: "A data de nascimento é obrigatória.",groups:['create'])]
    #[Assert\LessThan("today", message: "A data de nascimento deve ser anterior a hoje.",groups:['create','update'])]
    public readonly ?DateTimeInterface $dateOfBirth;

    #[Assert\NotBlank]
    #[Assert\NotNull(message: "O e-mail é obrigatório.",groups:['create'])]

    #[Assert\Email(message: "O e-mail '{{ value }}' não é válido.",groups:['create','update'])]
    public readonly ?string $email;

    #[Assert\NotNull(message: "O número de telefone é obrigatório.",groups:['create'])]
    #[Assert\Length(min: 9, max: 20, minMessage: "O número deve ter no mínimo {{ limit }} caracteres.",groups:['create','update'])]
    public readonly ?string $phoneNumber;

    #[Assert\Type("bool", message: "O campo aceite LGPD deve ser verdadeiro ou falso.",groups:['create'])]
    #[Assert\IsTrue(message: "Você deve aceitar os termos da LGPD.",groups:['create'])]
    public readonly ?bool $lgpdAcceptance;

    public function __construct(
        ?string $name,
        ?string $cpf,
        ?DateTimeInterface $dateOfBirth,
        ?string $email,
        ?string $phoneNumber,
        ?bool $lgpdAcceptance
    ) {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->dateOfBirth = $dateOfBirth;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->lgpdAcceptance = $lgpdAcceptance;
    }

}
