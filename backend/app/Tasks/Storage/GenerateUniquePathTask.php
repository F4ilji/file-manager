<?php

namespace App\Tasks\Storage;

use Illuminate\Support\Str;

class GenerateUniquePathTask
{
    public function execute(string $name, ?string $parentPath = null, callable $pathExistsChecker)
    {
        $basePath = $parentPath ? rtrim($parentPath, '/') . '/' : '';
        $counter = 0;
        $path = '';

        do {
            $newPath = $basePath . Str::slug($name) . ($counter > 0 ? '-' . $counter : '');
            if ($pathExistsChecker($newPath)) {
                $counter++;
            } else {
                $path = $newPath;
            }
        } while (!$path);

        return $path;
    }
}
