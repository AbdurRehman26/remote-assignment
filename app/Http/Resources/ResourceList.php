<?php

namespace App\Http\Resources;

use App\Models\Resource;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceList extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'resourceable' => $this->resourceable,
            'resourceable_type' => Resource::ResourceableTypes[$this->resourceable_type]
        ];
    }
}
