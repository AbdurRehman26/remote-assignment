<?php

namespace App\Services\Resource;

use App\Models\Link;
use App\Models\Resource;
use App\Services\Resource\Contracts\ResourceInterface;

class LinkService implements ResourceInterface
{

    public function create(array $data): Link
    {
        $link = new Link();
        $link->title = $data['title'];
        $link->link = $data['link'];
        $link->new_tab = $data['new_tab'];
        $link->save();
        return $link;
    }

    public function update(Resource $resource, array $data): Resource
    {
        $resource->resourceable()->update([
            'title' => $data['title'],
            'link' => $data['link'],
            'new_tab' => $data['new_tab']
        ]);

        return $resource->refresh();
    }
}
