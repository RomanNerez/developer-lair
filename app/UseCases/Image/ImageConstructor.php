<?php

namespace App\UseCases\Image;

use App\UseCases\Image\Objects\Background;
use Illuminate\Support\Str;

class ImageConstructor
{
    private $initImagick;

    private $width;

    private $height;

    private $initObjects = [];

    private $initBackground;

    public function __construct(int $width, int $height, $fabricData)
    {
        $this->initImagick = new \Imagick();
        $this->width = $width;
        $this->height = $height;

        $this->_initBackground($fabricData);
        $this->_initFabricData($fabricData);
    }

    private function _initFabricData($fabricData)
    {
        foreach ($fabricData['objects'] as $object) {
            $class = 'App\\UseCases\\Image\\Objects\\'.Str::ucfirst($object['type']);
            $this->initObjects[] = new $class($object);
        }
    }

    private function _initBackground($fabricData)
    {
        // $this->initBackground = new Background($fabricData['background']);
    }

    public function build(): \Imagick
    {
        $this->initImagick->newImage($this->width, $this->height, 'none', 'png');

        foreach ($this->initObjects as $object) {
            $this->initImagick->compositeImage(
                $object->build(),
                \imagick::COMPOSITE_DEFAULT,
                $object->getAbsoluteLeft(),
                $object->getAbsoluteTop()
            );
        }

        return $this->initImagick;
    }
}