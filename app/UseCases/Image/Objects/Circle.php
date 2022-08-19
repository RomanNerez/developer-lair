<?php

namespace App\UseCases\Image\Objects;

class Circle extends AbstractObject
{
    private $fill;

    public function __construct($objectData)
    {
        parent::__construct($objectData);

        $this->fill = $objectData['fill'];
    }

    public function build(): \Imagick
    {
        // $strokeWidth = $object['strokeWidth'];

        $this->initImagick->newImage($this->getWidth(), $this->getHeight(), 'none', 'png');
        $draw = new \ImagickDraw();
        $draw->setfillcolor($this->fill);
        // $draw->setStrokeWidth($strokeWidth);
        $draw->circle($this->getWidth() / 2, $this->getHeight() / 2, $this->getWidth() / 2, $this->getWidth());
        $this->initImagick->drawimage($draw);

        return $this->initImagick;
    }
}