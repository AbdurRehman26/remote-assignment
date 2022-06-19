<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\File\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    public function __construct(
        private FileUploadService $fileUploadService
    ) {
    }

    public function upload(Request $request): string
    {
        return $this->fileUploadService->upload($request->file('file'));
    }

    public function download(string $fileName): StreamedResponse
    {
        return Storage::disk('public')->download($fileName);
    }
}
