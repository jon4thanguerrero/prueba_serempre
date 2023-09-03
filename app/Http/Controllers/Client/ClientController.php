<?php

namespace App\Http\Controllers\Client;

use App\Http\Transformers\Client\ClientTransformer;
use App\Libraries\Responders\Contracts\JsonApiResponseInterface;
use App\Libraries\Responders\HttpObject;
use App\Repositories\Contracts\Client\ClientRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ClientController
{
    public function __construct(
        private ClientRepositoryInterface $clientRepository,
        private HttpObject $httpObject,
        private JsonApiResponseInterface $jsonApiResponse
    ) {
        
    }

    public function __invoke(Request $request): JsonResponse
    {
        $cityName = $request->input('city');

        try {
            $clients = $this->clientRepository->findByCityName($cityName);

            $this->httpObject->setCollection($clients);

            return $this->jsonApiResponse->respondWithCollection(
                $this->httpObject,
                new ClientTransformer(),
                'clients'
            );
        } catch (Throwable $th) {
            Log::error($th->getMessage(), $th->getTrace());

            return $this->jsonApiResponse->responseErrorException($th);
        }
    }
}
