<?php

namespace App\Http\Controllers\Folders;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateFolderRequest;
use App\Models\Folder;
use App\Http\Resources\FolderResource;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateFolderRequest $request, Folder $folder)
    {
        $this->authorize('update', $folder);

        $folder->update($request->validated());

        return new FolderResource($folder);
    }
}
