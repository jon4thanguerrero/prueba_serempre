<?php

namespace App\Repositories\Contracts\Client;

use Illuminate\Database\Eloquent\Collection;

interface ClientRepositoryInterface
{
    public function saveFromImport(array $clients): bool;

    public function findByCityName(string $cityName): Collection;

    public function getAll(): Collection;
}
