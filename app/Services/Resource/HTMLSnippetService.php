<?php

namespace App\Services\Resource;

use App\Models\Contracts\ResourceTypeInterface;
use App\Models\HtmlSnippet;
use App\Models\Resource;
use App\Services\Resource\Contracts\ResourceInterface;
use Illuminate\Database\Eloquent\Model;

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

    public function update(Resource $resource, array $data): Resource
    {
        $resource->resourceable()->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'snippet' => $data['snippet']
        ]);

        return $resource->refresh();
    }
}
