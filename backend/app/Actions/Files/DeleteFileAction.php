<?php

namespace App\Actions\Files;

use App\Models\File;
use App\Tasks\Storage\DeleteFileFromStorageTask;

class DeleteFileAction
{
    public function __construct(protected DeleteFileFromStorageTask $deleteFileFromStorageTask)
    {
    }

    public function execute(File $file)
    {
        $this->deleteFileFromStorageTask->execute($file->path);
        $file->delete();
    }
}
