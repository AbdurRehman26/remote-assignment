<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class HtmlSnippet extends Model
{
    use HasFactory;

    public function resource(): MorphOne
    {
        return $this->morphOne(Resource::class, 'resourceable');
    }
}
