<?php

namespace App\EventRegistration\Strategy;

use App\Event\Entity\Event;

class RegistrationStrategyFactory
{
    public function getStrategy(Event $event): EventRegistrationStrategyInterface
    {
        if ($event->isFree()) {
            return new FreeEventStrategy();
        }

        if ($event->isInPerson()) {
            return new InPersonEventStrategy();
        }

        if (!$event->isFree()) {
            return new PaidEventStrategy();
        }

        throw new \RuntimeException('Tipo de evento sem estratégia definida');
    }
}
