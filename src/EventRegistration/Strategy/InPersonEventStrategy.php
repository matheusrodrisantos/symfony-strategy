<?php
 
namespace App\EventRegistration\Strategy;

use App\Event\Entity\Event;
use App\User\Entity\User;

class InPersonEventStrategy implements EventRegistrationStrategyInterface{
    
    public function register(Event $event, User $user): void
    {}
}