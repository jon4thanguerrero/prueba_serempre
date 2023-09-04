<?php

namespace App\UseCases\Contracts\User;

use App\DataTransferObject\UserDTO;
use App\Models\User;

/**
 * @author Jonathan Guerrero <jonathan.guerrero.olivera@gmail.com>
 */
interface UserUseCaseInterface
{
    public function register(UserDTO $userDTO): User;

    public function delete(int $userID): bool;

    public function getRegister(int $userID): User;

    public function update(UserDTO $userDTO): User;

    public function UpdateInfo(User $user, string $name): User;
}
