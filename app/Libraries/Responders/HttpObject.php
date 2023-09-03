<?php

namespace App\Libraries\Responders;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\Resource\Item;
use stdClass;

class HttpObject
{
    private array $body = [];

    private Item|array|Model $item;

    private array $headers = [];

    private int $status = 200;

    private array $metadata = [];

    /**
     * @var array|\Illuminate\Support\Collection|Collection $collection
     */
    private $collection;

    public function getItem(): Model|array|Item
    {
        return $this->item;
    }

    /**
     * @param object|array|Item|Model|StdClass $item
     * @return HttpObject
     */
    public function setItem($item): HttpObject
    {
        $this->item = $item;
        return $this;
    }

    public function setBody(array $body): HttpObject
    {
        $this->body = $body;
        return $this;
    }

    public function getBody(): array
    {
        return $this->body;
    }


    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): HttpObject
    {
        $this->status = $status;
        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }


    public function setHeaders(array $headers): HttpObject
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @param array|\Illuminate\Support\Collection|Collection|\Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Contracts\Pagination\LengthAwarePaginator $collection
     * @return HttpObject
     */
    public function setCollection($collection): HttpObject
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * @return array|\Illuminate\Support\Collection|Collection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }

    public function setMetadata(array $metadata): HttpObject
    {
        $this->metadata = $metadata;
        return $this;
    }
}
