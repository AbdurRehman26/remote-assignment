<?php

namespace App\Services\Resource;

use App\Models\Link;
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
}
