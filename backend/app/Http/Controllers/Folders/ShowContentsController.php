<?php

namespace App\Http\Controllers\Folders;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Http\Resources\FolderResource;
use App\Http\Resources\FileResource;

class ShowContentsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Folder $folder)
    {
        $this->authorize('view', $folder);

        $folders = $folder->children;
        $files = $folder->files;

        return response()->json([
            'folders' => FolderResource::collection($folders),
            'files' => FileResource::collection($files),
        ]);
    }
}
