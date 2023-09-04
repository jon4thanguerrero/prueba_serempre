<?php

namespace App\Http\Controllers\User;

use App\Http\Transformers\User\UserTransformer;
use App\Libraries\Responders\Contracts\JsonApiResponseInterface;
use App\Libraries\Responders\HttpObject;
use App\UseCases\Contracts\User\UserUseCaseInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class UserController
{
    public function __construct(
        private UserUseCaseInterface $userUseCase,
        private HttpObject $httpObject,
        private JsonApiResponseInterface $jsonApiResponse
    ) {        
    }

    public function getInfo(): JsonResponse
    {
        try {
            $user = auth()->user();

            $this->httpObject->setItem($user);

            return $this->jsonApiResponse->responseWithItem($this->httpObject, new UserTransformer(), 'user');
        } catch (Throwable $th) {
            Log::error($th->getMessage(), $th->getTrace());

            return $this->jsonApiResponse->responseErrorException($th);
        }
    }

    public function updateInfo(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if($validator->fails()) {
            return $this->jsonApiResponse->respondFormError($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            app('db')->beginTransaction();

            $name = $request->input('name');
        
            $user = auth()->user();
            $user = $this->userUseCase->updateInfo($user, $name);

            app('db')->commit();

            $this->httpObject->setItem($user);

            return $this->jsonApiResponse->responseWithItem($this->httpObject, new UserTransformer(), 'user');
        } catch (Throwable $th) {
            app('db')->rollback();
            Log::error($th->getMessage(), $th->getTrace());

            return $this->jsonApiResponse->responseErrorException($th);
        }
    }
}