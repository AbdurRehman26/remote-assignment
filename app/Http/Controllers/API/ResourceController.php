<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResourceRequest;
use App\Http\Resources\ResourceList;
use App\Http\Resources\ResourceListCollection;
use App\Models\Resource;
use App\Services\Resource\StoreResourceService;

class ResourceController extends Controller
{
    private StoreResourceService $storeResourceService;

    public function __construct(StoreResourceService $storeResourceService)
    {
        $this->storeResourceService = $storeResourceService;
    }

    public function index(): ResourceListCollection
    {
        return new ResourceListCollection(Resource::all());
    }

    public function store(StoreResourceRequest $request): ResourceList
    {
        return new ResourceList($this->storeResourceService->create($request->validated()));
    }
}
