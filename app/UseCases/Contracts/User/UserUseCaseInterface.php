<?php

namespace App\UseCases\Contracts\User;

use App\DataTransferObject\UserDTO;
use App\Models\User;

/**
 * @author Jonathan Guerrero <jonathan.guerrero.olivera@gmail.com>
 */
interface UserUseCaseInterface
{
    public function handle(UserDTO $userDTO): User;
}
