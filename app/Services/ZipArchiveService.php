<?php

namespace App\Services;

use Illuminate\Support\Str;

class ZipArchiveService
{
    const DEFAULT_PATH_ZIP = 'upload';

    /**
     * @param array $resources
     * @param array $option
     * @return string
     */
    public function createZip(array $resources, array $option = []): string
    {
        $zip = new \ZipArchive();
        $fileNameZip = ($option['zipName'] ?? Str::uuid()).'.zip';
        $pathToZip = trim(($option['zipPath'] ?? self::DEFAULT_PATH_ZIP), '/').'/'.$fileNameZip;
        $fullPathToZip = public_path($pathToZip);

        if ($zip->open($fullPathToZip, \ZipArchive::CREATE)) {
            foreach ($resources as $resource) {
                $zip->addFromString($resource['fileName'], $resource['resource']);
            }
        }
        $zip->close();

        return $pathToZip;
    }
}