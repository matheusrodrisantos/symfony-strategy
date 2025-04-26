<?php

namespace App\EventRcc\Repository;

use App\EventRcc\Entity\EventRcc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


/**
 * @extends ServiceEntityRepository<EventRcc>
 */
class EventRccRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private EntityManagerInterface $em
    ){
        parent::__construct($registry, EventRcc::class);
    }

    public function save(EventRcc $event) : void {

        $this->em->persist($event);
        $this->em->flush();
    }

    public function update(EventRcc $event):void{
       
        $this->em->persist($event);
        $this->em->flush();
    }

    public function getOrFail(int $id){
        
        $event = $this->find($id);

        if (!$event) {
            throw new \Exception("EventRcc com ID {$id} não encontrado");
        }

        return $event;
    }

    public function delete(EventRcc $event): void{
        $this->em->remove($event);
        $this->em->flush();
    }

}
