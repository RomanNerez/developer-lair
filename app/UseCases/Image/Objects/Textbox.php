<?php

namespace App\UseCases\Image\Objects;

class Textbox extends AbstractObject
{
    private $fontSize;

    private $textAlign;

    private $lineHeight;

    private $text;

    public function __construct($imageData)
    {
        parent::__construct($imageData);

        $this->fontSize = $imageData['fontSize'];
        $this->textAlign = $imageData['textAlign'];
        $this->lineHeight = $imageData['lineHeight'];
        $this->text = $imageData['text'];
    }

    public function getFontSize(): int
    {
        return $this->fontSize * $this->scaleX;
    }

    public function build(): \Imagick
    {
        $draw = new \ImagickDraw();
        $pixel = new \ImagickPixel( 'grey' );


        $this->initImagick->newImage($this->getWidth(), $this->getHeight(), $pixel);

        $draw->setTextAlignment(\Imagick::ALIGN_CENTER);
        $draw->setFontStyle(\Imagick::STYLE_NORMAL);
        $draw->setFontWeight(400);


        $draw->setFillColor(new \ImagickPixel( 'black' ));
        $draw->setFont(public_path('fonts/Roboto/Roboto-Regular.ttf'));
        $draw->setFontSize($this->getFontSize());
        // $draw->scale($object['scaleX'], $object['scaleY']);

        $metrics = $this->initImagick->queryFontMetrics($draw, $this->text);

        $draw->annotation(
            0,
            $metrics["textHeight"],
            $this->text
        );
        $this->initImagick->drawImage($draw);

        return $this->initImagick;
    }
}