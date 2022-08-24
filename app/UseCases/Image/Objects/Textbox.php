<?php

namespace App\UseCases\Image\Objects;

use App\Utils\Helpers\FontFamily;

class Textbox extends AbstractObject
{
    private $fontSize;

    private $textAlign;

    private $lineHeight;

    private $text;

    private $fill;

    private $lineHeights;

    private $offsetX = 0;

    /**
     * @var FontFamily
     */
    private $fontFamily;

    public function __construct($imageData)
    {
        parent::__construct($imageData);

        $this->fontSize = $imageData['fontSize'];
        $this->lineHeights = $imageData['lineHeights'];
        $this->text = $imageData['text'];
        $this->fill = $imageData['fill'];
        $this->lineHeight = $imageData['lineHeight'];
        $this->fontFamily = new FontFamily($imageData['fontFamily']);
        $this->__initTextAlignAndOffsetX($imageData['textAlign']);
    }

    public function getTextAlignmentForImagick(string $textAlign): int
    {
        $alignments = [
            'left' => \Imagick::ALIGN_LEFT,
            'center' => \Imagick::ALIGN_CENTER,
            'right' => \Imagick::ALIGN_RIGHT,
        ];

        return $alignments[$textAlign] ?? \Imagick::ALIGN_LEFT;
    }

    private function __initTextAlignAndOffsetX(string $textAlign)
    {
        $this->textAlign = $textAlign;

        if ($textAlign === 'center') $this->offsetX = $this->getWidth() / 2;
        if ($textAlign === 'right') $this->offsetX = $this->getWidth();
    }

    public function getFontSize(): int
    {
        return $this->fontSize * $this->scaleX;
    }

    public function getLineHeightVyIndex(int $index): float
    {
        return $this->lineHeights[$index] * $this->scaleX;
    }

    public function getLineSpacing(): int
    {
        return $this->getFontSize() * ($this->lineHeight - 1);
    }

    public function getMultiText()
    {
        return explode("\n", $this->text);
    }

    private function getLineHeightForFirstLineText()
    {
        $lineHeight = $this->getLineHeightVyIndex(0);
        $lineHeight = $this->getFontSize() - (($lineHeight - $this->getFontSize() * $this->lineHeight) / $this->lineHeight);
        return  $lineHeight ?: $this->getFontSize();
    }

    private function getHeightText(): float
    {
        $lineHeights = [...$this->lineHeights];
        array_shift($lineHeights);
        return $this->getLineHeightForFirstLineText() + array_sum($lineHeights);
    }

    public function build(): \Imagick
    {
        $pixel = new \ImagickPixel( $this->backgroundColor );
        $this->initImagick->newImage($this->getWidth(), $this->getHeight(), $pixel);

        $textTop = $this->getLineHeightForFirstLineText();

        foreach ($this->getMultiText() as $index => $text) {
            $draw = new \ImagickDraw();
            $draw->setFont($this->fontFamily->getPathToFile());
            $draw->setFontSize($this->getFontSize());
            $draw->setFillColor(new \ImagickPixel( $this->fill ));
            $draw->setTextAlignment($this->getTextAlignmentForImagick($this->textAlign));

            $draw->annotation($this->offsetX, $textTop, $text);
            $this->initImagick->drawImage($draw);

            $textTop += $this->getLineHeightVyIndex($index);
        }

        $this->initImagick->scaleImage($this->getWidth(), $this->getHeight());

        $this->afterChangeHandler();

        return $this->initImagick;
    }
}