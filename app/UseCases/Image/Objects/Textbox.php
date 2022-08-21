<?php

namespace App\UseCases\Image\Objects;

class Textbox extends AbstractObject
{
    private $fontSize;

    private $textAlign;

    private $lineHeight;

    private $text;

    private $fill;

    public function __construct($imageData)
    {
        parent::__construct($imageData);

        $this->fontSize = $imageData['fontSize'];
        $this->textAlign = $imageData['textAlign'];
        $this->lineHeight = $imageData['lineHeight'];
        $this->text = $imageData['text'];
        $this->fill = $imageData['fill'];
    }

    public function getFontSize(): int
    {
        return $this->fontSize * $this->scaleX;
    }

    public function getLineSpacing(): int
    {
        return $this->getFontSize() * ($this->lineHeight - 1);
    }

    public function build(): \Imagick
    {
        $draw = new \ImagickDraw();
        $pixel = new \ImagickPixel( $this->backgroundColor );

        $draw->setGravity(\Imagick::GRAVITY_CENTER);
        $draw->setFontStyle(\Imagick::STYLE_NORMAL);


        $draw->setFillColor(new \ImagickPixel( $this->fill ));
        $draw->setTextInterLineSpacing($this->getLineSpacing());
        $draw->setFont(public_path('fonts/Roboto/Roboto-Regular.ttf'));
        $draw->setFontSize($this->getFontSize());

        $metrics = $this->initImagick->queryFontMetrics($draw, $this->text, true);
        $this->initImagick->newImage($this->getWidth(), $metrics['textHeight'], $pixel);

        $draw->annotation(0, 0, $this->text);
        $this->initImagick->drawImage($draw);
        $this->initImagick->scaleImage($this->getWidth(), $this->getHeight());

        $this->afterChangeHandler();

        return $this->initImagick;
    }
}