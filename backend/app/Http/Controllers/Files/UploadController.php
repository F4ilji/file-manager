<?php

namespace App\Http\Controllers\Files;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadFileRequest;
use App\Actions\Files\UploadFileAction;
use App\Models\File;
use App\Http\Resources\FileResource;

class UploadController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UploadFileRequest $request, UploadFileAction $uploadFileAction)
    {
        $this->authorize('create', File::class);

        $file = $uploadFileAction->execute(
            $request->user(),
            $request->file('file'),
            $request->input('folder_id')
        );

        return new FileResource($file);
    }
}
