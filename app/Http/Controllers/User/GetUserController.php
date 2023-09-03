<?php

namespace App\Http\Controllers\User;

use App\Http\Transformers\User\UserTransformer;
use App\Libraries\Responders\Contracts\JsonApiResponseInterface;
use App\Libraries\Responders\HttpObject;
use App\UseCases\Contracts\User\UserUseCaseInterface;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

class GetUserController
{
    public function __construct(
        private UserUseCaseInterface $userUseCase,
        private HttpObject $httpObject,
        private JsonApiResponseInterface $jsonApiResponse
    ) {
    }

    public function __invoke(int $userID): JsonResponse
    {
        try {
            $user = $this->userUseCase->getRegister($userID);

            $this->httpObject->setItem($user);

            return $this->jsonApiResponse->responseWithItem(
                $this->httpObject,
                new UserTransformer(),
                'user'
            );
        }catch (Throwable $th) {
            Log::error($th->getMessage(), $th->getTrace());

            return $this->jsonApiResponse->responseErrorException($th);
        }
    }
}
