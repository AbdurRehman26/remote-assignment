<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use App\Http\Resources\ResourceItem;
use App\Http\Resources\ResourceItemCollection;
use App\Models\Resource;
use App\Services\Resource\StoreResourceService;
use App\Services\Resource\UpdateResourceService;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResourceController extends Controller
{
    private StoreResourceService $storeResourceService;
    private UpdateResourceService $updateResourceService;

    public function __construct(StoreResourceService $storeResourceService, UpdateResourceService $updateResourceService)
    {
        $this->storeResourceService = $storeResourceService;
        $this->updateResourceService = $updateResourceService;
    }

    public function index(): ResourceItemCollection
    {
        return new ResourceItemCollection(Resource::all());
    }

    /**
     * @throws Exception
     */
    public function store(StoreResourceRequest $request): JsonResponse | ResourceItem
    {
        try{

            return new ResourceItem($this->storeResourceService->create($request->validated()));

        }catch (Exception $e){

            return response()->json([
                'code' => $e->getCode(),
                'error' => true,
                'message' => $e->getMessage()
            ]);

        }

    }

    public function show(Resource $resource): JsonResponse | ResourceItem
    {
        try {

            return new ResourceItem($resource);

        }catch (Exception $e){

            return response()->json([
                'code' => $e->getCode(),
                'error' => true,
                'message' => $e->getMessage()
            ]);

        }
    }

    public function update(UpdateResourceRequest $request, Resource $resource): JsonResponse | ResourceItem
    {
        try {

            return new ResourceItem($this->updateResourceService->update($resource, $request->validated()));

        }catch (Exception $e){

            return response()->json([
                'code' => $e->getCode(),
                'error' => true,
                'message' => $e->getMessage()
            ]);

        }

    }

    public function destroy(Resource $resource): JsonResponse
    {
        try {

            $resource->resourceable()->delete();
            $resource->delete();

            return response()->json([
                'success' => true,
                'code' => Response::HTTP_OK
            ]);

        }catch (Exception $e){

            return response()->json([
                'code' => $e->getCode(),
                'error' => true,
                'message' => $e->getMessage()
            ]);

        }
    }
}
