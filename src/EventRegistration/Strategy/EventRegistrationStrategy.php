<?php

namespace App\EventRegistration\Strategy;

use App\Event\Entity\Event;
use App\User\Entity\User;

interface EventRegistrationStrategyInterface
{
    public function canRegister(Event $event, User $user): bool;

}