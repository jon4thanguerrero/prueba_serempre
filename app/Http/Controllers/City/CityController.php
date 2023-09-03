<?php

namespace App\Http\Controllers\City;

use App\Http\Transformers\City\CityTransformer;
use App\Libraries\Responders\Contracts\JsonApiResponseInterface;
use App\Libraries\Responders\HttpObject;
use App\Repositories\Contracts\City\CityRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class CityController
{
    public function __construct(
        private CityRepositoryInterface $cityRepository,
        private HttpObject $httpObject,
        private JsonApiResponseInterface $jsonApiResponse
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $page = $request->input('page', 1);
            $perPage = $request->input('per_page', 5);

            $cities = $this->cityRepository->getByPage($perPage, $page);

            $this->httpObject->setCollection($cities);

            return $this->jsonApiResponse->respondWithCollection(
                $this->httpObject,
                new CityTransformer(),
                'cities'
            );
        } catch (Throwable $th) {
            Log::error($th->getMessage(), $th->getTrace());

            return $this->jsonApiResponse->responseErrorException($th);
        }
    }
}
