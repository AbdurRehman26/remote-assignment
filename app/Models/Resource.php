<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Resource extends Model
{
    use HasFactory;

    const ResourceableTypes = [
      'App\Models\Link' => 'link',
      'App\Models\Pdf' => 'pdf',
      'App\Models\HtmlSnippet' => 'html_snippet'
    ];

    public function resourceable(): MorphTo
    {
        return $this->morphTo();
    }
}
