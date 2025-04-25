<?php

namespace App\Participant\Repository;

use App\Participant\Entity\Participant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Participant>
 */
class ParticipantRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private EntityManagerInterface $em,
    )
    {
        parent::__construct($registry, Participant::class);
    }

    public function save(Participant $participant):void{
       
        $this->em->persist($participant);
        $this->em->flush();
    }

    public function update(Participant $participant):void{
       
        $this->em->persist($participant);
        $this->em->flush();
    }

    public function getOrFail(int $id){
        
        $participant = $this->find($id);

        if (!$participant) {
            throw new \Exception("Participant com ID {$id} não encontrado");
        }

        return $participant;
    }

    public function delete(Participant $participant): void{
        $this->em->remove($participant);
        $this->em->flush();
    }
    
}
