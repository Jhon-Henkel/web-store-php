<?php

namespace core\classes;

use Dompdf\Dompdf;;

class Pdf
{
    private $pdf;
    private string $html;

    private int $positionX;
    private int $positionY;
    private int $width;
    private int $height;
    private string $color;
    private string $backgroundColor;
    private string $fontFamily;
    private int $fontSize;
    private int $fontWeight;
    private string $textAlign;

    public function __construct()
    {
        $this->setPdf(new Dompdf());
        $this->getPdf()->setPaper('A4');

        $this->resetHtml();
    }

    public function getPdf()
    {
        return $this->pdf;
    }

    public function setPdf($pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * @return string
     */
    public function getHtml(): string
    {
        return $this->html;
    }

    /**
     * @param string $html
     */
    public function setHtml(string $html): void
    {
        $this->html = $html;
    }

    /**
     * @return int
     */
    public function getPositionX(): int
    {
        return $this->positionX;
    }

    /**
     * @param int $positionX
     */
    public function setPositionX(int $positionX): void
    {
        $this->positionX = $positionX;
    }

    /**
     * @return int
     */
    public function getPositionY(): int
    {
        return $this->positionY;
    }

    /**
     * @param int $positionY
     */
    public function setPositionY(int $positionY): void
    {
        $this->positionY = $positionY;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }

    /**
     * @param string $backgroundColor
     */
    public function setBackgroundColor(string $backgroundColor): void
    {
        $this->backgroundColor = $backgroundColor;
    }

    /**
     * @return string
     */
    public function getFontFamily(): string
    {
        return $this->fontFamily;
    }

    /**
     * @param string $fontFamily
     */
    public function setFontFamily(string $fontFamily): void
    {
        $fontsAllow = array(
            'Courier New',
            'Arial',
            'Franklin Gothic Medium',
            'Lucida Sans',
            'Times New Roman'
        );

        if (in_array($fontFamily, $fontsAllow)) {
            $this->fontFamily = $fontFamily;
        } else {
            $this->fontFamily = 'Arial';
        }
    }

    /**
     * @return string
     */
    public function getFontSize(): string
    {
        return $this->fontSize;
    }

    /**
     * @param string $fontSize
     */
    public function setFontSize(string $fontSize): void
    {
        $this->fontSize = $fontSize;
    }

    /**
     * @return string
     */
    public function getFontWeight(): string
    {
        return $this->fontWeight;
    }

    /**
     * @param string $fontWeight
     */
    public function setFontWeight(string $fontWeight): void
    {
        $this->fontWeight = $fontWeight;
    }

    /**
     * @return string
     */
    public function getTextAlign(): string
    {
        return $this->textAlign;
    }

    /**
     * @param string $textAlign
     */
    public function setTextAlign(string $textAlign): void
    {
        $this->textAlign = $textAlign;
    }

    public function showPdf()
    {
        $pdf = $this->getPdf();
        $pdf->loadHtml($this->getHtml());
        $pdf->render();
        $pdf->stream('1', ["Attachment" => false]);

    }

    public function resetHtml()
    {
        $this->setHtml('');
    }

    public function newPage()
    {
        $this->setHtml($this->getHtml() . '<pagebreack>');
    }

    public function setPosition($x, $y)
    {
        $this->setPositionX($x);
        $this->setPositionY($y);
    }

    public function setDimension($width, $height)
    {
        $this->setWidth($width);
        $this->setHeight($height);
    }

    public function positionAndDimension($x, $y, $width, $height)
    {
        $this->setPosition($x, $y);
        $this->setDimension($width, $height);
    }

    public function setTemplate($template)
    {
        //usar o caminho de onde está o template (função getcwb() do php é util)
        $this->pdf->SetDocTemplate($template);
    }

    public function pdfContent($content)
    {
        $this->setHtml($this->getHtml() . '<div style="');

        $this->setHtml($this->getHtml() . 'position: absolute;');
        $this->setHtml($this->getHtml() . 'left: ' . $this->getPositionX() . 'px;');
        $this->setHtml($this->getHtml() . 'top: ' . $this->getPositionY() . 'px;');
        $this->setHtml($this->getHtml() . 'width: ' . $this->getWidth() . 'px;');
        $this->setHtml($this->getHtml() . 'height: ' . $this->getHeight() . 'px;');

        $this->setHtml($this->getHtml() . 'color: ' . $this->getColor() . ';');
        $this->setHtml($this->getHtml() . 'background-color: ' . $this->getBackgroundColor() . ';');

        $this->setHtml($this->getHtml() . 'font-family: ' . $this->getFontFamily() . ';');
        $this->setHtml($this->getHtml() . 'font-size: ' . $this->getFontSize() . ';');
        $this->setHtml($this->getHtml() . 'font-weight: ' . $this->getFontWeight() . ';');
        $this->setHtml($this->getHtml() . 'text-align: ' . $this->getTextAlign() . ';');

        $this->setHtml($this->getHtml() . '">' . $content . '</div>');
    }
}