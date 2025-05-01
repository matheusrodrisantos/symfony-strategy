<?php

namespace App\EventRegistration\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\EventRegistration\Entity\EventRegistration;

class EventRegistrationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventRegistration::class);
    }

    public function save(EventRegistration $eventRegistration) : void {

        $this->em->persist($eventRegistration);
        $this->em->flush();
    }

    public function update(EventRegistration $eventRegistration):void{
       
        $this->em->persist($eventRegistration);
        $this->em->flush();
    }

    public function getOrFail(int $id){
        
        $eventRegistration = $this->find($id);

        if (!$eventRegistration) {
            throw new \Exception("EventRegistration com ID {$id} não encontrado");
        }

        return $eventRegistration;
    }

    public function delete(EventRegistration $eventRegistration): void{
        $this->em->remove($eventRegistration);
        $this->em->flush();
    }

}
