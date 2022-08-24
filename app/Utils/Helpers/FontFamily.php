<?php

namespace App\Utils\Helpers;

use App\Utils\Helpers\Exceptions\FontFamilyException;

class FontFamily
{
    private $fontFamily;

    private $listFoldersOfFontFamilies;

    public function __construct(string $fontFamily)
    {
        $this->fontFamily = $fontFamily;
        $this->listFoldersOfFontFamilies = config('fonts');
    }

    public function getPathToFile()
    {
        foreach ($this->listFoldersOfFontFamilies as $folder => $data) {
            foreach ($data['files'] as $name => $file) {
                if ($name === $this->fontFamily) {
                    return public_path("fonts/{$folder}/$file");
                }
            }
        }

        throw new FontFamilyException("Font Family [{$this->fontFamily}] is not found.");
    }
}