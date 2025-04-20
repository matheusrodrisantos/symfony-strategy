<?php

namespace App\Participante\DTO;

use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Participante\Entity\Participante;


class ParticipanteInputDTO
{
    #[Assert\NotNull(message: "O nome é obrigatório.", groups:['create'])]
    #[Assert\Length(min: 2, max: 255, minMessage: "O nome deve ter pelo menos {{ limit }} caracteres.", groups:['create','update'])]
    public readonly ?string $nome;

    #[Assert\NotNull(message: "O CPF é obrigatório.", groups:['create'])]
    #[Assert\Length(exactly: 11, exactMessage: "O CPF deve ter exatamente {{ limit }} dígitos.",groups:['create','update'])]
    #[Assert\Regex(pattern: "/^\d{11}$/", message: "O CPF deve conter apenas números.")]
    public readonly ?string $cpf;

    #[Assert\NotNull(message: "A data de nascimento é obrigatória.",groups:['create'])]
    #[Assert\LessThan("today", message: "A data de nascimento deve ser anterior a hoje.",groups:['create','update'])]
    public readonly ?DateTimeInterface $dataNascimento;

    #[Assert\NotBlank]
    #[Assert\NotNull(message: "O e-mail é obrigatório.",groups:['create'])]
    #[Assert\Email(message: "O e-mail '{{ value }}' não é válido.",groups:['create','update'])]
    public readonly ?string $email;

    #[Assert\NotNull(message: "O número de telefone é obrigatório.",groups:['create'])]
    #[Assert\Length(min: 9, max: 20, minMessage: "O número deve ter no mínimo {{ limit }} caracteres.",groups:['create','update'])]
    public readonly ?string $numero;

    #[Assert\Type("bool", message: "O campo aceite LGPD deve ser verdadeiro ou falso.",groups:['create'])]
    #[Assert\IsTrue(message: "Você deve aceitar os termos da LGPD.",groups:['create'])]
    public readonly ?bool $aceiteLgpd;

    public function __construct(
        ?string $nome,
        ?string $cpf,
        ?DateTimeInterface $dataNascimento,
        ?string $email,
        ?string $numero,
        ?bool $aceiteLgpd
    ) {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->dataNascimento = $dataNascimento;
        $this->email = $email;
        $this->numero = $numero;
        $this->aceiteLgpd = $aceiteLgpd;
    }

    public function toEntity():Participante{
        
        $participante = new Participante();
        $participante->setNome($this->nome);
        $participante->setCpf($this->cpf);
        $participante->setDataNascimento($this->dataNascimento);
        $participante->setEmail($this->email);
        $participante->setNumero($this->numero);
        $participante->setAceiteLgpd($this->aceiteLgpd);

        return $participante;
    }

    public function applyToEntity(Participante $participante):Participante{

        $participante->setNome($this->nome);
        $participante->setCpf($this->cpf);
        $participante->setDataNascimento($this->dataNascimento);
        $participante->setEmail($this->email);
        $participante->setNumero($this->numero);
        $participante->setAceiteLgpd($this->aceiteLgpd);
        
        return $participante;
    }
}
