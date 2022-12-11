<?php

namespace App\Services\Image;

class ImageService
{
    const DEFAULT_BACKGROUND_IMAGE = 'white';

    /**
     * @param string $filePath
     * @param int $angle
     * @param array $option
     * @return string
     * @throws \ImagickException
     */
    public function rotate(string $filePath, int $angle, array $option = []): string
    {
        $imagick = new \Imagick($filePath);
        $imagick->rotateImage(
            $option['background'] ?? self::DEFAULT_BACKGROUND_IMAGE,
            $angle
        );

        return $imagick->getImageBlob();
    }

    /**
     * @param string $filePath
     * @param int $width
     * @param int $height
     * @param int $x
     * @param int $y
     * @return string
     * @throws \ImagickException
     */
    public function crop(string $filePath, int $width, int $height, int $x, int $y): string
    {
        $imagick = new \Imagick($filePath);
        $imagick->cropImage(
            $width,
            $height,
            $x,
            $y
        );

        return $imagick->getImageBlob();
    }
}