<?php

namespace App\Services\File;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function upload(UploadedFile $uploadedFile): string
    {
        $filename = time().$uploadedFile->getClientOriginalName();

        Storage::disk('public')->putFileAs(
            '',
            $uploadedFile,
            $filename
        );

        return $filename;
    }
}
