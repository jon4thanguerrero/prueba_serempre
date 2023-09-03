<?php

namespace App\Repositories\User;

use App\DataTransferObject\UserDTO;
use App\Models\User;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function save(UserDTO $userDTO): bool
    {
        $user = new User();
        $user->name = $userDTO->getName();
        $user->email = $userDTO->getEmail();
        $user->password =  Hash::make($userDTO->getPassword());

        return $user->save();;
    }

    public function getByEmail(string $email): User
    {
        return User::where('email', $email)->first();
    }

    public function update(User $user): bool
    {
        return $user->save();
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }

    public function findByID(int $userID): User|null
    {
        return User::where('id', $userID)->first();
    }
}
