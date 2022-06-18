<?php

namespace App\Services\Resource;

use App\Models\Resource;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateResourceService
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
    public function update(Resource $resource, array $data): Resource
    {
        try {

            DB::beginTransaction();

            $resource = resolve($this->resourceTypes[
                Resource::ResourceableTypes[$resource->resourceable_type]
            ])->update($resource, $data);

            DB::commit();

            return $resource;

        } catch (Exception $e) {
            Log::error($e->getMessage());

            throw $e;
        }
    }
}
