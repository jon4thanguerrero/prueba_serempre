<?php

namespace App\Libraries\Responders\Contracts;

use App\Libraries\Responders\HttpObject;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\MessageBag;
use League\Fractal\TransformerAbstract;
use Throwable;

interface JsonApiResponseInterface
{
    public function respondFormError(MessageBag $messageBag, int $status, array $headers = []): JsonResponse;

    public function respondError(array $errors, int $status, array $headers = []): JsonResponse;

    public function responseWithItem(
        HttpObject $httpObject,
        TransformerAbstract $callback,
        string $resource,
        array $includes = []
    ): JsonResponse;

    public function respond(HttpObject $httpObject): JsonResponse;

    public function responseErrorException(Throwable $th): JsonResponse;

    public function respondWithCollection(
        HttpObject $httpObject,
        TransformerAbstract $callback,
        string $resource,
        array $includes = []
    ): JsonResponse;
}
