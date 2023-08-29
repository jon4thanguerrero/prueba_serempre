<?php

namespace App\Repositories\User;

use App\DataTransferObject\UserDTO;
use App\Models\User;
use App\Repositories\Contracts\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function save(UserDTO $userDTO): bool
    {
        $user = new User();
        $user->name = $userDTO->getName();
        $user->email = $userDTO->getEmail();
        $user->password = $userDTO->getPassword();

        return $user->save();;
    }

    public function getByEmail(string $email): User
    {
        $user = User::where('email', $email)->first();

        return $user;
    }

    public function update(User $user): bool
    {
        return $user->save();
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
