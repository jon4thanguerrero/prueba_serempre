<?php

namespace App\Http\Controllers\User;

use App\UseCases\Contracts\User\UserUseCaseInterface;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class DeleteUserController
{
    public function __construct(private UserUseCaseInterface $userUseCase)
    {
    }

    public function __invoke(int $userID): JsonResponse
    {        
        try {
            app('db')->beginTransaction();

            $this->userUseCase->delete($userID);

            app('db')->commit();

            return response()->json([
                'data' => [
                    'message' => 'Registro eliminado con éxito.',
                ],
            ], Response::HTTP_OK);
        } catch (Throwable $th) {
            app('db')->rollback();

            Log::error($th->getMessage(), $th->getTrace());

            return response()->json([
                'data' => [
                    'message' => 'Error al eliminar el registro.',
                ],
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
