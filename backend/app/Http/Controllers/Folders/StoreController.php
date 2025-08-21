<?php

namespace App\Http\Controllers\Folders;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFolderRequest;
use App\Actions\Folders\CreateFolderAction;
use App\Models\Folder;
use App\Http\Resources\FolderResource;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreFolderRequest $request, CreateFolderAction $createFolderAction)
    {
        $this->authorize('create', Folder::class);

        $folder = $createFolderAction->execute(
            $request->user(),
            $request->validated()
        );

        return new FolderResource($folder);
    }
}
