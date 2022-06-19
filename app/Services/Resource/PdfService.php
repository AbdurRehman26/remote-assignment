<?php

namespace App\Services\Resource;

use App\Models\Pdf;
use App\Models\Resource;
use App\Services\Resource\Contracts\ResourceInterface;

class PdfService implements ResourceInterface
{

    public function create(array $data): Pdf
    {
        $pdf = new Pdf();
        $pdf->title = $data['title'];
        $pdf->name = $data['file'];
        $pdf->save();
        return $pdf;
    }

    public function update(Resource $resource, array $data): Resource
    {
        $resource->resourceable()->update([
            'title' => $data['title'],
            'name' => $data['file'],
        ]);

        return $resource->refresh();
    }
}
