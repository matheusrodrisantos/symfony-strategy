<?php

namespace App\User\Service;

use App\Shared\Service\ServiceCrudInterface;
use App\Shared\DTO\InputDto;
use App\Shared\DTO\OutputDto;
use App\User\DTO\UserInputDTO;
use App\User\Factory\UserFactory;
use App\User\Repository\UserRepository;

class UserService implements ServiceCrudInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private UserFactory $userFactory
    ){}
    public function save(InputDto $userInput): OutputDto
    {
        if(!$userInput instanceof UserInputDTO){
            throw new \Exception('InputDTO deve ser do tipo UserInputDTO');
        }

        $user=$this->userFactory->createEntityFromDto($userInput);

        $this->userRepository->save($user);

        return $this->userFactory->createOutputDtoFromEntity($user);

    }


    public function update(int $id, InputDto $userInput): OutputDto
    {
        if(!$userInput instanceof UserInputDTO){
            throw new \Exception('InputDTO deve ser do tipo UserInputDTO');
        }

        $user=$this->userRepository->getOrFail($id);

        $this->userFactory->updateEntityFromDto($user,$userInput);

        $this->userRepository->save($user);

        return $this->userFactory->createOutputDtoFromEntity($user);
        
    }

    public function delete(int $id): void
    {
        $user= $this->userRepository->getOrFail($id);

        if($user){
            throw new \Exception('User não encontrado');
        }

        $this->userRepository->delete($user);
    }

    public function list(): array
    {
        $user=$this->userRepository->findAll();
        return $this->userFactory->createOutputDtoListFromEntities($user);
    }

    public function listById(int $id): OutputDto
    {
        $user=$this->userRepository->getOrFail($id);
        return $this->userFactory->createOutputDtoFromEntity($user);
    }
}
