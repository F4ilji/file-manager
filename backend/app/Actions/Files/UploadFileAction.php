<?php

namespace App\Actions\Files;

use App\Models\File;
use App\Models\Folder;
use App\Models\User;
use Illuminate\Http\UploadedFile as HttpUploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Tasks\Storage\GenerateUniquePathTask;

class UploadFileAction
{
    public function __construct(protected GenerateUniquePathTask $generateUniquePathTask)
    {
    }

    public function execute(User $user, HttpUploadedFile $uploadedFile, ?int $folderId = null)
    {
        $folder = null;
        if ($folderId) {
            $folder = Folder::where('user_id', $user->id)
                ->where('id', $folderId)
                ->firstOrFail();
        }

        $fileName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $uploadedFile->getClientOriginalExtension();
        $mimeType = $uploadedFile->getMimeType();
        $fileSize = $uploadedFile->getSize();

        $parentPath = $folder ? $folder->path : '';

        $path = $this->generateUniquePathTask->execute(
            $fileName . '.' . $extension,
            $parentPath,
            function ($newPath) {
                return Storage::exists($newPath);
            }
        );

        Storage::put($path, file_get_contents($uploadedFile->getRealPath()));

        return File::create([
            'user_id' => $user->id,
            'folder_id' => $folder ? $folder->id : null,
            'name' => $uploadedFile->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $mimeType,
            'size' => $fileSize,
        ]);
    }
}
