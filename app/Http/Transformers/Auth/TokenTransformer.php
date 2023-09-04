<?php

namespace App\Http\Transformers\Auth;

use App\Models\User;
use League\Fractal\TransformerAbstract;
use Tymon\JWTAuth\Facades\JWTAuth;

class TokenTransformer extends TransformerAbstract
{
    /**
     * @var User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'value' => JWTAuth::fromUser($user),
        ];
    }
}