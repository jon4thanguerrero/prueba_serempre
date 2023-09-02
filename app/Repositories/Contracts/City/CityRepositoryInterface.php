<?php

namespace App\Repositories\Contracts\City;

use Illuminate\Database\Eloquent\Collection;

interface CityRepositoryInterface
{
    public function get(): Collection;
}