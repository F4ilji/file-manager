<?php

namespace App\Http\Controllers\Folders;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Actions\Folders\DeleteFolderAction;
use Illuminate\Http\JsonResponse;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Folder $folder, DeleteFolderAction $deleteFolderAction): JsonResponse
    {
        $this->authorize('delete', $folder);

        $deleteFolderAction->execute($folder);

        return response()->json(null, 204);
    }
}
