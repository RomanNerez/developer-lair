<?php

namespace App\Services\Image;

use App\UseCases\Image\ImageConstructor;
use App\Utils\Image\DTO\ImageParametersDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImageConstructorService
{
    public function build(ImageParametersDTO $imageDTO): \Imagick
    {
        $imageConstructor = new ImageConstructor(
            $imageDTO->getWidth(),
            $imageDTO->getHeight(),
            $imageDTO->getFabricData()
        );

        return $imageConstructor->build();

        $generalFilename = Str::uuid().'.png';
        $generalPath = public_path('upload/'.$generalFilename);

        $generalImage = new \Imagick();
        $generalImage->newImage($generalWidth, $generalHeight, 'none', 'png');

        foreach ($fabricData['objects'] as $object) {
            if ($object['type'] === 'image') {
                $filename = Str::after($object['src'], 'upload/');
                $path = public_path('upload/'.$filename);
                $image = new \Imagick($path);

                $localImageWidth = $object['width'] * $object['scaleX'];
                $localImageHeight = $object['height'] * $object['scaleY'];

                $image->scaleImage($localImageWidth, $localImageHeight);

                $generalImage->compositeImage($image, \imagick::COMPOSITE_DEFAULT, $object['left'], $object['top']);
            }

            if ($object['type'] === 'textbox') {
                $image = new \Imagick();
                $draw = new \ImagickDraw();
                $pixel = new \ImagickPixel( 'transparent' );

                $localImageWidth = $object['width'] * $object['scaleX'] + 5;
                $localImageHeight = $object['height'] * $object['scaleY'] + 3;
                $localFontSize = $object['fontSize'] * $object['scaleX'];

                $image->newImage($localImageWidth, $localImageHeight, $pixel);

                $draw->setTextAlignment(\Imagick::ALIGN_CENTER);
                $draw->setFontStyle(\Imagick::STYLE_NORMAL);
                $draw->setFontWeight(400);


                $draw->setFillColor(new \ImagickPixel( 'black' ));
                $draw->setFont(public_path('fonts/Roboto/Roboto-Regular.ttf'));
                $draw->setFontSize($localFontSize);
                $draw->scale($object['scaleX'], $object['scaleY']);


                $metrics = $image->queryFontMetrics($draw, $object['text']);

                $image->annotateImage($draw, $localImageWidth / 2, $metrics['ascender'], 0, $object['text']);
                $generalImage->compositeImage($image, \imagick::COMPOSITE_DEFAULT, $object['left'], $object['top']);
            }

            if ($object['type'] === 'rect') {
                $strokeWidth = $object['strokeWidth'];
                $width =  $object['width'] * $object['scaleX'];
                $height = $object['height'] * $object['scaleY'];

                $image = new \Imagick();
                $color = new \ImagickPixel( $object['fill'] );

                $image->newImage($width, $height, $color, 'png');
                $generalImage->compositeImage($image, \imagick::COMPOSITE_DEFAULT, $object['left'], $object['top']);
            }

            if ($object['type'] === 'circle') {
                $strokeWidth = $object['strokeWidth'];
                $width =  $object['width'] * $object['scaleX'];
                $height = $object['height'] * $object['scaleY'];

                $circle = new \Imagick();
                $circle->newImage($width, $height, 'none', 'png');
                $draw = new \ImagickDraw();
                $draw->setfillcolor($object['fill']);
                $draw->setStrokeWidth($strokeWidth);
                $draw->circle($width / 2, $height / 2, $width / 2, $width);
                $circle->drawimage($draw);

                $generalImage->compositeImage($circle, \imagick::COMPOSITE_DEFAULT, $object['left'], $object['top']);
            }

            if ($object['type'] === 'triangle') {
                $strokeWidth = $object['strokeWidth'];
                $width =  $object['width'] * $object['scaleX'];
                $height = $object['height'] * $object['scaleY'];

                $draw = new \ImagickDraw();

                $draw->setStrokeOpacity(1);
                $draw->setStrokeColor('none');
                $draw->setStrokeWidth($strokeWidth);

                $draw->setFillColor($object['fill']);

                $points = [
                    ['x' => $width / 2, 'y' => 0],
                    ['x' => 0, 'y' => $height],
                    ['x' => $width, 'y' => $height],
                ];

                $draw->polygon($points);

                $image = new \Imagick();
                $image->newImage(500, 300, 'none', 'png');
                $image->drawImage($draw);

                $generalImage->compositeImage($image, \imagick::COMPOSITE_DEFAULT, $object['left'], $object['top']);

            }
        }

        return $generalImage;
    }

    private function initImageGenerating()
    {

    }
}