<?php

namespace App\Http\Transformers\Client;

use App\Models\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{
    public function transform(Client $client): array
    {
        return [
            'id'        => $client->id,
            'code'      => $client->code,
            'name'      => $client->name,
            'city'      => $client->city
        ];
    }
}