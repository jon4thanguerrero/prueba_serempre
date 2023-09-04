<?php

namespace App\Http\Transformers\Auth;

use App\Models\User;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class AuthUserTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = ['token'];

    /**
     * @var User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'     => $user->id,
            'name'   => $user->name,
            'email'  => $user->email,
        ];
    }

    /**
     * @var User $user
     * @return Item
     */
    public function includeToken(User $user)
    {
        return $this->item($user, new TokenTransformer(), 'token');
    }
}