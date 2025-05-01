<?php

namespace App\EventRegistration\DTO;

use App\Shared\DTO\InputDto;
use Symfony\Component\Validator\Constraints as Assert;

class EventRegistrationInputDTO implements InputDto
{
    #[Assert\NotBlank]
    #[Assert\Type("integer")]
    public readonly int $user;

    #[Assert\NotBlank]
    #[Assert\Type("integer")]
    public readonly int $event;

    public function __construct(
        int $user,
        int $event,
    ) {
        $this->user = $user;
        $this->event = $event;
    }
}
