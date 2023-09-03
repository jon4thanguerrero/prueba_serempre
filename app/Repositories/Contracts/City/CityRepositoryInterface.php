<?php

namespace App\Repositories\Contracts\City;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CityRepositoryInterface
{
    public function get(): Collection;

    public function getByPage(int $perPage, int $page): LengthAwarePaginator;
}