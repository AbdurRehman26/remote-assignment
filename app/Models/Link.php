<?php

namespace App\Models;

use App\Models\Contracts\ResourceTypeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Link extends Model implements ResourceTypeInterface
{
    use HasFactory;

    public function resource(): MorphOne
    {
        return $this->morphOne(Resource::class, 'resourceable');
    }

}
