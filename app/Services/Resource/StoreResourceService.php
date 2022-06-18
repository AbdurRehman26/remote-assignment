<?php

namespace App\Services\Resource;

use App\Models\Resource;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class StoreResourceService
{
    protected array $data;

    /**
     * Payment Providers available for the application
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

            $resourceTypeService = resolve($this->resourceTypes[
            $data['type']
            ]);
            return $resourceTypeService->attachToResource($resourceTypeService->create($data));

        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            throw $e;
        }
    }

}
