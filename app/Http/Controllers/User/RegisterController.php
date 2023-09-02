<?php

namespace App\Http\Controllers\User;

use App\DataTransferObject\UserDTO;
use App\Http\Transformers\User\UserTransformer;
use App\Libraries\Responders\Contracts\JsonApiResponseInterface;
use App\Libraries\Responders\HttpObject;
use App\UseCases\Contracts\User\UserUseCaseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * @author Jonathan Guerrero <jonathan.guerrero.olivera@gmail.com>
 */
class RegisterController
{
    public function __construct(
        private UserUseCaseInterface $userUseCase,
        private HttpObject $httpObject,
        private JsonApiResponseInterface $jsonApiResponse
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|string',
        ]);

        if($validator->fails()) {
            return $this->jsonApiResponse->respondFormError($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            app('db')->beginTransaction();
            $userDTO = $this->generateUserDTO($request->all());

            $user = $this->userUseCase->register($userDTO);

            $this->httpObject->setItem($user);

            app('db')->commit();

            return $this->jsonApiResponse->responseWithItem(
                $this->httpObject,
                new UserTransformer(),
                'user'
            );

        } catch (Throwable $th) {
            app('db')->rollback();

            Log::error($th->getMessage(), $th->getTrace());
            
            return $this->jsonApiResponse->responseErrorException($th);
        }
    }

    private function generateUserDTO(array $request): UserDTO
    {
        $userDTO = new UserDTO();
        $userDTO->setName($request['name']);
        $userDTO->setEmail($request['email']);
        $userDTO->setPassword($request['password']);

        return $userDTO;
    }
}
