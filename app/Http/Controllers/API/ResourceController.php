<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResourceListCollection;
use App\Models\Resource;

class ResourceController extends Controller
{
    public function index(): ResourceListCollection
    {
        return new ResourceListCollection(Resource::all());
    }
}
