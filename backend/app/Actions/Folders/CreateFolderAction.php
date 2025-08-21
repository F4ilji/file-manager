<?php

namespace App\Actions\Folders;

use App\Models\Folder;
use App\Models\User;
use App\Tasks\Storage\GenerateUniquePathTask;
use Illuminate\Support\Facades\Storage;

class CreateFolderAction
{
    public function __construct(protected GenerateUniquePathTask $generateUniquePathTask)
    {
    }

    public function execute(User $user, array $data)
    {
        $parentFolder = null;
        if (isset($data['parent_id'])) {
            $parentFolder = Folder::where('user_id', $user->id)
                ->where('id', $data['parent_id'])
                ->firstOrFail();
        }

        $folderName = $data['name'];
        $parentPath = $parentFolder ? $parentFolder->path : '';

        $path = $this->generateUniquePathTask->execute(
            $folderName,
            $parentPath,
            function ($newPath) use ($user, $parentFolder) {
                return Folder::where('user_id', $user->id)
                    ->where('path', $newPath)
                    ->exists();
            }
        );

        $folder = Folder::create([
            'user_id' => $user->id,
            'parent_id' => $parentFolder ? $parentFolder->id : null,
            'name' => $folderName,
            'path' => $path,
        ]);

        Storage::makeDirectory($path);

        return $folder;
    }
}
