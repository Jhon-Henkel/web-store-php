<?php

namespace core\classes;

use core\util\UtilData;
use core\util\UtilString;
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
    private string $fontSize;
    private string $fontWeight;
    private string $textAlign;

    public function __construct()
    {
        $this->setPdf(new Dompdf());
        $this->getPdf()->setPaper('A4');
        $this->setColor('black');
        $this->setBackgroundColor('white');
        $this->setTextAlign('left');

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
        $pdf->stream('imprimir.pdf', ["Attachment" => false]);

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

    public function generatePdfOrderPaid($order, $client, $products)
    {
        $utilDate = new UtilData();
        $utilString = new UtilString();

        $this->setFontFamily('Arial');
        $this->setFontSize('20px');
        $this->setFontWeight('bold');

        $this->positionAndDimension(450, 10, 400, 30);
        $this->pdfContent('Data do pedido: ' . $utilDate->formatDateUsToBr($order->data_pedido));

        $this->positionAndDimension(20, 10, 200, 30);
        $this->pdfContent('Pedido: ' . $order->codido_pedido);

        $this->positionAndDimension(20, 40, 1000, 30);
        $this->pdfContent('Cliente: ' . $client->nome_cliente);

        $this->positionAndDimension(00, 80, 700, 2);
        $this->pdfContent('<hr>');

        $this->positionAndDimension(20, 100, 10, 2);
        $this->pdfContent('Entrega');

        $this->setFontSize('15px');
        $this->setFontWeight('normal');

        $this->positionAndDimension(20, 140, 1000, 10);
        $this->pdfContent('Endereço: ' . $order->endereco_entrega . ' - ' . $order->cidade_entrega);

        $this->positionAndDimension(20, 160, 1000, 10);
        $this->pdfContent('Transportadora: ');

        $this->positionAndDimension(20, 180, 1000, 10);
        $this->pdfContent('Observações: ');

        $this->setFontSize('20px');
        $this->setFontWeight('bold');

        $this->positionAndDimension(00, 260, 700, 2);
        $this->pdfContent('<hr>');

        $this->setTextAlign('center');

        $this->positionAndDimension(20, 290, 700, 2);
        $this->pdfContent('Produtos');

        $this->setFontSize('15px');
        $this->setFontWeight('normal');

        $y = 320;
        $total = 0;
        foreach ($products as $product) {
            $this->setTextAlign('left');
            $this->positionAndDimension(20, $y, 480, 22);
            $this->pdfContent($product->quantidade . ' X ' . $product->nome_produto);

            $this->setTextAlign('right');
            $this->positionAndDimension(500, $y, 160, 22);
            $price = $product->quantidade * $product->valor_unitario;
            $total += $price;
            $this->pdfContent($utilString->formatPrice($price));

            $y += 26;
        }

        $this->setFontSize('20px');
        $this->setFontWeight('bold');

        $this->positionAndDimension(00, $y, 700, 2);
        $this->pdfContent('<hr>');

        $y += 26;

        $this->positionAndDimension(180, $y, 480, 22);
        $this->pdfContent('Total: ' . $utilString->formatPrice($total));

    }
}