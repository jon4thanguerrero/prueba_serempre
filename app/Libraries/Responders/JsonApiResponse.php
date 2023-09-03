<?php

namespace App\Libraries\Responders;

use App\Libraries\Responders\Contracts\JsonApiResponseInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\MessageBag;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;
use League\Fractal\TransformerAbstract;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class JsonApiResponse implements JsonApiResponseInterface
{
    private Manager $fractal;

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
        $this->fractal->setSerializer(new JsonApiSerializer());
    }

    public function respondFormError(MessageBag $messageBag, int $status, array $headers = []): JsonResponse
    {
        $errors = [];

        foreach ($messageBag->getMessages() as $field => $messages) {
            foreach ($messages as $message) {
                $error = [];
                $error['status'] = (string)$status;
                $error['title'] = 'Error in Field';
                $error['detail'] = $message;
                $error['code'] = 'FORM_ERROR';
                $error['source']['parameter'] = $field;
                $errors[] = $error;
            }
        }


        return $this->respondError($errors, $status, $headers);
    }

    public function respondError(array $errors, int $status, array $headers = []): JsonResponse
    {
        $keyErrors['errors'] = $errors;

        return response()->json($keyErrors, $status, $headers);
    }

    public function responseWithItem(
        HttpObject $httpObject,
        TransformerAbstract $callback,
        string $resource,
        array $includes = []
    ): JsonResponse {
        $item = $httpObject->getItem();

        $resource = new Item($item, $callback, $resource);

        if (! empty($includes)) {
            $this->fractal->parseIncludes($includes);
        }

        $rootScope = $this->fractal->createData($resource);
        $httpObject->setBody($rootScope->toArray());

        return $this->respond($httpObject);
    }

    public function respond(HttpObject $httpObject): JsonResponse
    {
        return response()->json($httpObject->getBody(), $httpObject->getStatus(), $httpObject->getHeaders());
    }

    public function respondWithCollection(
        HttpObject $httpObject,
        TransformerAbstract $callback,
        string $resource,
        array $includes = []
    ): JsonResponse {
        $collection = $httpObject->getCollection();
        
        if (is_array($collection) || $collection instanceof \Illuminate\Support\Collection) {
            $totalItems = count($collection);
            $collection = new LengthAwarePaginator($httpObject->getCollection(), $totalItems, $totalItems ?: 50);
        }
        
        $resource = new Collection($collection, $callback, $resource);
        
        if (! empty($httpObject->getMetadata())) {
            $resource->setMeta($httpObject->getMetadata());
        }
        
        $resource->setPaginator(new IlluminatePaginatorAdapter($collection));

        if (! empty($includes)) {
            $this->fractal->parseIncludes($includes);
        }

        $rootScope = $this->fractal->createData($resource);
        $httpObject->setBody($rootScope->toArray());

        return $this->respond($httpObject);
    }

    public function responseErrorException(Throwable $th): JsonResponse
    {
        $errorStatus = Response::HTTP_INTERNAL_SERVER_ERROR;;

        $error = [];
        $error['status'] = (string) $errorStatus;
        $error['title'] = 'Error in Field';
        $error['detail'] = $th->getMessage();
        $error['code'] = 'SERVER_ERROR';

        $errors[] = $error;

        return $this->respondError($errors, $errorStatus);
    }
}
