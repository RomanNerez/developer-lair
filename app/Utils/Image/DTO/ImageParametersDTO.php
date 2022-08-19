<?php

namespace App\Utils\Image\DTO;

class ImageParametersDTO
{
    private $width;

    private $height;

    private $fabricData;

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getFabricData(): array
    {
        return $this->fabricData;
    }

    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function setFabricData(array $fabricData): void
    {
        $this->fabricData = $fabricData;
    }
}