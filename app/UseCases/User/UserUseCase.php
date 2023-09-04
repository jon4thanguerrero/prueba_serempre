<?php

namespace App\UseCases\User;

use App\DataTransferObject\UserDTO;
use App\Jobs\SendEmailUserRegisteredJob;
use App\Models\User;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use App\UseCases\Contracts\User\UserUseCaseInterface;
use Exception;

/**
 * @author Jonathan Guerrero <jonathan.guerrero.olivera@gmail.com>
 */
class UserUseCase implements UserUseCaseInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function register(UserDTO $userDTO): User
    {
        $userRegistered = $this->userRepository->save($userDTO);

        if(!$userRegistered) {
            throw new Exception('Error al almacenar el usuario.');
        }

        $user = $this->userRepository->getByEmail($userDTO->getEmail());

        return $user;
    }

    public function delete(int $userID): bool
    {
        $user = $this->getUser($userID);

        $deleted = $this->userRepository->delete($user);

        if(!$deleted) {
            throw new Exception(sprintf('No se elimino el registro con el ID %s', $userID));
        }

        return $deleted;
    }

    public function getRegister(int $userID): User
    {
        return $this->getUser($userID);
    }

    public function update(UserDTO $userDTO): User
    {
        $user = $this->getUser($userDTO->getID());

        $user->name = $userDTO->getName();
        $user->password = $userDTO->getPassword();
        $user->email = $userDTO->getEmail();

        $updated = $this->userRepository->update($user);

        if(!$updated) {
            throw new Exception(sprintf('No se actualizo el registro con el ID %s', $userDTO->getID()));
        }

        return $user;
    }

    private function getUser(int $userID): User
    {
        $user = $this->userRepository->findByID($userID);

        if(empty($user)) {
            throw new Exception(sprintf('No se encontro el usuario con el ID %s', $userID));
        }

        return $user;
    }

    public function UpdateInfo(User $user, string $name): User
    {
        $user->name = $name;

        $updated = $this->userRepository->update($user);

        if(!$updated) {
            throw new Exception(sprintf('No se actualizo el registro con el ID %s', $user->id()));
        }

        return $user;
    }
}
