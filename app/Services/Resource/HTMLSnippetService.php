<?php

namespace App\Services\Resource;

use App\Models\HtmlSnippet;
use App\Models\Resource;
use App\Services\Resource\Contracts\ResourceInterface;

class HTMLSnippetService implements ResourceInterface
{
    public function create(array $data): HtmlSnippet
    {
        $htmlResource = new HtmlSnippet();
        $htmlResource->title = $data['title'];
        $htmlResource->description = $data['description'];
        $htmlResource->snippet = $data['snippet'];
        $htmlResource->save();
        return $htmlResource;
    }

    public function attachToResource(HtmlSnippet $htmlSnippet): Resource
    {
        $htmlSnippet->resource()->save(new Resource());
        $htmlSnippet->refresh();
        return $htmlSnippet->resource;
    }
}
