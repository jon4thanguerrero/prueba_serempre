<?php

namespace App\Repositories\Contracts\User;

use App\DataTransferObject\UserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    public function save(UserDTO $userDTO): bool;

    public function getByEmail(string $email): User;

    public function update(User $user): bool;

    public function delete(User $user): bool;

    public function findByID(int $userID): User|null;
}
