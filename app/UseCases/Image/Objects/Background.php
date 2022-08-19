<?php

namespace App\UseCases\Image\Objects;

use Illuminate\Support\Str;

class Background
{
    const HELPER_BACKGROUND = 'bg.png';

    private $source;

    private $path;

    public function __construct($backgroundData)
    {
        $this->source = Str::after($backgroundData['source'], 'images/');
        $this->path = public_path('upload/'.$this->source);
    }

    public function initBackground(\Imagick $imagick)
    {
        if ($this->source !== self::HELPER_BACKGROUND) {
            $imagick->setFilename($this->path);
        }


    }
}