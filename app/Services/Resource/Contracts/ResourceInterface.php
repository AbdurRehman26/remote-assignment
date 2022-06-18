<?php

namespace App\Services\Resource\Contracts;

use App\Models\Resource;

interface ResourceInterface
{
    public function create(array $data);

    public function update(Resource $resource, array $data): Resource;
}
