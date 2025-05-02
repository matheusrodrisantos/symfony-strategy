<?php

namespace App\EventRegistration\Strategy;
use App\Event\Entity\Event;
use App\User\Entity\User;

class FreeEventStrategy implements EventRegistrationStrategyInterface
{
    public function canRegister(Event $event, User $user): bool
    {
        return true;
    }
}