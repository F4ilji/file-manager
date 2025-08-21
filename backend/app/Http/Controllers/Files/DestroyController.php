<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Actions\Files\DeleteFileAction;
use Illuminate\Http\JsonResponse;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(File $file, DeleteFileAction $deleteFileAction): JsonResponse
    {
        $this->authorize('delete', $file);

        $deleteFileAction->execute($file);

        return response()->json(null, 204);
    }
}
