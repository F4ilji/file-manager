<?php

namespace App\Actions\Folders;

use App\Models\Folder;
use App\Models\File;
use App\Tasks\Storage\DeleteFileFromStorageTask;
use Illuminate\Support\Facades\Storage;

class DeleteFolderAction
{
    public function __construct(protected DeleteFileFromStorageTask $deleteFileFromStorageTask)
    {
    }

    public function execute(Folder $folder)
    {
        // Delete all files within this folder
        $folder->files->each(function (File $file) {
            $this->deleteFileFromStorageTask->execute($file->path);
            $file->delete();
        });

        // Recursively delete child folders
        $folder->children->each(function (Folder $childFolder) {
            $this->execute($childFolder);
        });

        // Finally, delete the folder itself
        $folder->delete();

        // Delete the physical directory
        if (Storage::exists($folder->path)) {
            Storage::deleteDirectory($folder->path);
        }
    }
}
