<?php

namespace App\User\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;


class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry
    ,private EntityManagerInterface $em
    )
    {
        parent::__construct($registry, User::class);
    }

    public function save(User $user) : void {

        $this->em->persist($user);
        $this->em->flush();
    }

    public function update(User $user):void{
       
        $this->em->persist($user);
        $this->em->flush();
    }

    public function getOrFail(int $id){
        
        $user = $this->find($id);

        if (!$user) {
            throw new \Exception("User com ID {$id} não encontrado");
        }

        return $user;
    }

    public function delete(User $user): void{
        $this->em->remove($user);
        $this->em->flush();
    }

}
