<?php

namespace App\Repositories\City;

use App\Models\City;
use App\Repositories\Contracts\City\CityRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CityRepository implements CityRepositoryInterface
{
    public function get(): Collection
    {
        return City::all();
    }

    public function getByPage(int $perPage, int $page): LengthAwarePaginator
    {
        return City::paginate($perPage, ['*'], 'page', $page);
    }
}
