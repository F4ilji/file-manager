<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(File $file): StreamedResponse
    {
        $this->authorize('view', $file);

        return Storage::download($file->path, $file->name);
    }
}
