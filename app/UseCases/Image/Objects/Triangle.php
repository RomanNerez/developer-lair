<?php

namespace App\UseCases\Image\Objects;

class Triangle extends AbstractObject
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

        $draw = new \ImagickDraw();

        $draw->setStrokeOpacity(1);
        $draw->setStrokeColor('none');
        // $draw->setStrokeWidth($strokeWidth);

        $draw->setFillColor($this->fill);

        $points = [
            ['x' => $this->getWidth() / 2, 'y' => 0],
            ['x' => 0, 'y' => $this->getHeight()],
            ['x' => $this->getWidth(), 'y' => $this->getHeight()],
        ];

        $draw->polygon($points);

        $this->initImagick->newImage(500, 300, 'none', 'png');
        $this->initImagick->drawImage($draw);

        return $this->initImagick;
    }
}