<?php

namespace App\Repositories\Contracts\Client;

interface ClientRepositoryInterface
{
    public function saveFromImport(array $clients): bool;
}
