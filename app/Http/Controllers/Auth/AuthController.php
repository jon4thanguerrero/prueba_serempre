<?php

namespace App\Http\Controllers\Auth;

use App\Http\Transformers\Auth\AuthUserTransformer;
use App\Libraries\Responders\Contracts\JsonApiResponseInterface;
use App\Libraries\Responders\HttpObject;
use App\UseCases\Contracts\Auth\AuthUserUseCaseInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AuthController
{
    public function __construct(
        private AuthUserUseCaseInterface $authUserUseCase,
        private HttpObject $httpObject,
        private JsonApiResponseInterface $jsonApiResponse
    ) {
    }

    public function login(Request $request): JsonResponse
    {
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validatedData->fails()) {
            return $this->jsonApiResponse->respondFormError($validatedData->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $user = $this->authUserUseCase->handle($email, $password);

            $this->httpObject->setItem($user);

            return $this->jsonApiResponse->responseWithItem($this->httpObject, new AuthUserTransformer(), 'userToken');
        } catch (Throwable $th) {
            Log::error($th->getMessage(), $th->getTrace());

            return $this->jsonApiResponse->responseErrorException($th);
        }        
    }
}