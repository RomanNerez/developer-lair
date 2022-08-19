<?php

namespace App\UseCases\Image\Objects;

abstract class AbstractObject
{
    protected $initImagick;

    protected $type;

    protected $width;

    protected $height;

    protected $left;

    protected $top;

    protected $scaleX;

    protected $scaleY;

    protected $backgroundColor;

    public function __construct($objectData)
    {
        $this->initImagick = new \Imagick();

        $this->type = $objectData['type'];
        $this->width = $objectData['width'];
        $this->height = $objectData['height'];
        $this->left = $objectData['left'];
        $this->top = $objectData['top'];
        $this->scaleX = $objectData['scaleX'];
        $this->scaleY = $objectData['scaleY'];
        $this->backgroundColor = $objectData['backgroundColor'];
    }

    public function getWidth(): int
    {
        return $this->width * $this->scaleX;
    }

    public function getHeight(): int
    {
        return $this->height * $this->scaleY;
    }

    public function getLeft(): int
    {
        return $this->left;
    }

    public function getTop(): int
    {
        return $this->top;
    }

    abstract public function build(): \Imagick;
}