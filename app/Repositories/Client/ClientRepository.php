<?php

namespace App\Repositories\Client;

use App\Models\Client;
use App\Repositories\Contracts\Client\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    public function saveFromImport(array $clients): bool
    {
        return Client::insert($clients);
    }
}
