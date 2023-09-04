<?php

namespace App\Http\Transformers\City;

use App\Models\City;
use League\Fractal\TransformerAbstract;

class CityTransformer extends TransformerAbstract
{
    public function transform(City $city): array
    {
        return [
            'id'        => $city->id,
            'code'      => $city->code,
            'name'      => $city->name,
        ];
    }
}