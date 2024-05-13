<?php

namespace Modules\Basic\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class PaginateResource extends ResourceCollection
{
    protected $resourceClass;

    public function __construct($resource, string $resourceName)
    {
        $this->resourceClass = $resourceName;
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->resourceClass::collection($this->collection),
            'current_page' => $this->resource->currentPage(),
            'last_page' => $this->resource->lastPage(),
            'per_page' => $this->resource->perPage(),
            'total' => $this->resource->total(),
        ];

    }
}
