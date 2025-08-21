<?php

namespace App\Tasks\Storage;

use Illuminate\Support\Facades\Storage;

class DeleteFileFromStorageTask
{
    public function execute(string $filePath)
    {
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
            return true;
        }
        return false;
    }
}
