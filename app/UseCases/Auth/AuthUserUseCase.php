<?php

namespace App\UseCases\Auth;

use App\Models\User;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use App\UseCases\Contracts\Auth\AuthUserUseCaseInterface;
use Exception;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthUserUseCase implements AuthUserUseCaseInterface
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {        
    }

    public function handle(string $email, string $password): User
    {
        $user = $this->userRepository->getByEmail($email);

        $validatePassword = Hash::check($password, $user->password);

        if (!$validatePassword) {
            throw new Exception('email o contraseña no son validos', Response::HTTP_UNAUTHORIZED);
        }

        return $user;
    }
}
