<?php

namespace App\UseCases\Contracts\Auth;

use App\Models\User;

interface AuthUserUseCaseInterface
{
    public function handle(string $email, string $password): User;
}
