<?php

namespace App\Services\Resource;

use App\Models\Contracts\ResourceTypeInterface;
use App\Models\Resource;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StoreResourceService
{
    protected array $data;

    /**
     * Resource Types available for the application
     **/
    protected array $resourceTypes = [
        'link' => LinkService::class,
        'html_snippet' => HTMLSnippetService::class,
        'pdf' => PdfService::class,
    ];

    /**
     * @throws Exception
     */
    public function create(array $data): Resource
    {
        try {

            DB::beginTransaction();

            $resource = $this->attachToResource(resolve($this->resourceTypes[
            $data['type']
            ])->create($data));

            DB::commit();

            return $resource;

        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            throw $e;
        }
    }

    private function attachToResource(ResourceTypeInterface $resourceType): Resource
    {
        $resourceType->resource()->save(new Resource());
        return $resourceType->resource;
    }

}
