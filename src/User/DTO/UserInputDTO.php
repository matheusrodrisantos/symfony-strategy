<?php

namespace App\User\DTO;

use App\Shared\DTO\InputDto;
use Symfony\Component\Validator\Constraints as Assert;

class UserInputDTO implements InputDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Type("string")]
        public readonly string $name,

        #[Assert\NotBlank]
        #[Assert\Length(min: 11, max: 14)]
        public readonly string $cpf,

        #[Assert\NotBlank]
        #[Assert\Date]
        public readonly string $dateOfBirth,

        #[Assert\NotBlank]
        #[Assert\Email]
        public readonly string $email,

        #[Assert\NotBlank]
        #[Assert\Length(max: 20)]
        public readonly ?string $phoneNumber,

        #[Assert\NotNull]
        #[Assert\Type("bool")]
        public readonly bool $lgpdAcceptance
    ) {}
}
