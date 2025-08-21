<?php

namespace App\Http\Controllers\Folders;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Http\Resources\FolderResource;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Folder $folder)
    {
        $this->authorize('view', $folder);

        return new FolderResource($folder);
    }
}
