<?php
 
namespace App\EventRegistration\Strategy;

use App\Event\Entity\Event;
use App\User\Entity\User;

class InPersonEventStrategy implements EventRegistrationStrategyInterface{
    
    public function canRegister(Event $event, User $user): bool
    {
        return $event->getEventRegistrations()->count()<100;
    }
}