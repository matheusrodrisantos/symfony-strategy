<?php

namespace App\EventRegistration\Strategy;

use App\Event\Entity\Event;
use App\User\Entity\User;

interface EventRegistrationStrategyInterface
{
    public function register(Event $event, User $user): void;

    //public function unregister(Event $event, User $user): void;

    //public function isRegistered(Event $event, User $user): bool;
}