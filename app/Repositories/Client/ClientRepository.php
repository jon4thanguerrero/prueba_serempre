<?php

namespace App\Repositories\Client;

use App\Models\Client;
use App\Repositories\Contracts\Client\ClientRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ClientRepository implements ClientRepositoryInterface
{
    public function saveFromImport(array $clients): bool
    {
        return Client::insert($clients);
    }

    public function findByCityName(string $cityName): Collection
    {
        $clients = Client::join('cities', 'clients.city_id', '=', 'cities.id')
            ->select('clients.id', 'clients.code', 'clients.name', 'cities.name as city')
            ->where('cities.name', $cityName)
            ->get();

        return $clients;
    }
}
