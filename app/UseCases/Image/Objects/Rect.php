<?php

namespace App\UseCases\Image\Objects;

class Rect extends AbstractObject
{
    private $fill;

    public function __construct($objectData)
    {
        parent::__construct($objectData);

        $this->fill = $objectData['fill'];
    }

    public function build(): \Imagick
    {
        $color = new \ImagickPixel( $this->fill );

        $this->initImagick->newImage($this->getWidth(), $this->getHeight(), $color, 'png');

        return $this->initImagick;
    }
}