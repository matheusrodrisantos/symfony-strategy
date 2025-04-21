<?php

namespace App\Participante\Repository;

use App\Participante\Entity\Participante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Participante>
 */
class ParticipanteRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        private EntityManagerInterface $em,
    )
    {
        parent::__construct($registry, Participante::class);
    }

    public function save(Participante $participante):void{
       
        $this->em->persist($participante);
        $this->em->flush();
    }

    public function update(Participante $participante):void{
       
        $this->em->persist($participante);
        $this->em->flush();
    }

    public function getOrFail(int $id){
        
        $participante = $this->find($id);

        if (!$participante) {
            throw new \Exception("Participante com ID {$id} não encontrado");
        }

        return $participante;
    }
    
}
