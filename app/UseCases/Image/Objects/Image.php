<?php

namespace App\UseCases\Image\Objects;

use Illuminate\Support\Str;

class Image extends AbstractObject
{
    private $fileName;

    private $path;

    protected $initImagick;

    public function __construct($imageData)
    {
        parent::__construct($imageData);

        $this->fileName = Str::after($imageData['src'], 'upload/');
        $this->path = public_path('upload/'.$this->fileName);
        $this->initImagick = new \Imagick($this->path);
    }

    public function build(): \Imagick
    {
        $this->initImagick->scaleImage($this->getWidth(), $this->getHeight());

        return $this->initImagick;
    }
}