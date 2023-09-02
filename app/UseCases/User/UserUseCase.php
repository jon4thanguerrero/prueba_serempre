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
}
