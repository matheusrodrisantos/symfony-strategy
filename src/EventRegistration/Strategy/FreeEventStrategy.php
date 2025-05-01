<?php

namespace App\EventRegistration\Strategy;
use App\Event\Entity\Event;
use App\User\Entity\User;

class FreeEventStrategy implements EventRegistrationStrategyInterface
{
    public function register(Event $event, User $user): void
    {
        // Implement the logic for registering a user for a free event
        // For example, you might want to create an EventRegistration entity
        // and persist it to the database.
        
        // Example:
        // $eventRegistration = new EventRegistration();
        // $eventRegistration->setEvent($event);
        // $eventRegistration->setUser($user);
        // $entityManager->persist($eventRegistration);
        // $entityManager->flush();
    }
}