<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ResourceListCollection extends ResourceCollection
{
    /**
     * @param $request
     * @return array|Arrayable
     */
    public function toArray($request): array| Arrayable
    {
        return parent::toArray($request);
    }
}
