<?php

namespace App\Event\Repository;

use App\Event\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


/**
 * @extends ServiceEntityRepository<Event>
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private EntityManagerInterface $em
    ){
        parent::__construct($registry, Event::class);
    }

    public function save(Event $event) : void {

        $this->em->persist($event);
        $this->em->flush();
    }

    public function update(Event $event):void{
       
        $this->em->persist($event);
        $this->em->flush();
    }

    public function getOrFail(int $id){
        
        $event = $this->find($id);

        if (!$event) {
            throw new \Exception("Event com ID {$id} não encontrado");
        }

        return $event;
    }

    public function delete(Event $event): void{
        $this->em->remove($event);
        $this->em->flush();
    }

}
