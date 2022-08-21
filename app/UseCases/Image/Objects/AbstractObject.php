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

    protected $angle;

    protected $boundingRect;

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
        $this->angle = $objectData['angle'];
        $this->boundingRect = $objectData['boundingRect'];
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

    public function getAngle(): int
    {
        return $this->angle;
    }

    public function getAbsoluteWidth(): int
    {
        return $this->getBoundingRect()['width'] ?? 0;
    }

    public function getAbsoluteHeight(): int
    {
        return $this->getBoundingRect()['height'] ?? 0;
    }

    public function getAbsoluteLeft(): int
    {
        return $this->getBoundingRect()['left'] ?? 0;
    }

    public function getAbsoluteTop(): int
    {
        return $this->getBoundingRect()['top'] ?? 0;
    }

    public function getBoundingRect()
    {
        return $this->boundingRect;
    }

    protected function afterChangeHandler()
    {
        $this->initImagick->rotateImage('transparent', $this->getAngle());
    }

    abstract public function build(): \Imagick;
}