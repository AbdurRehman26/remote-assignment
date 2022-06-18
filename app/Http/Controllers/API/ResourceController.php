<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use App\Http\Resources\ResourceList;
use App\Http\Resources\ResourceListCollection;
use App\Models\Resource;
use App\Services\Resource\StoreResourceService;
use App\Services\Resource\UpdateResourceService;

class ResourceController extends Controller
{
    private StoreResourceService $storeResourceService;
    private UpdateResourceService $updateResourceService;

    public function __construct(StoreResourceService $storeResourceService, UpdateResourceService $updateResourceService)
    {
        $this->storeResourceService = $storeResourceService;
        $this->updateResourceService = $updateResourceService;
    }

    public function index(): ResourceListCollection
    {
        return new ResourceListCollection(Resource::all());
    }

    public function store(StoreResourceRequest $request): ResourceList
    {
        return new ResourceList($this->storeResourceService->create($request->validated()));
    }

    public function show(Resource $resource): ResourceList
    {
        return new ResourceList($resource);
    }

    public function update(UpdateResourceRequest $request, Resource $resource): ResourceList
    {
        return new ResourceList($this->updateResourceService->update($resource, $request->validated()));
    }
}
