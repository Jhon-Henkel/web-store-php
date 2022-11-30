<?php

namespace Unit\util;

use core\util\UtilString;
use PHPUnit\Framework\TestCase;

class UtilStringUnitTest extends TestCase
{
    public function testPriceBrFormat()
    {
        $price = '12.000';
        $utilString = new UtilString();
        $this->assertEquals('R$ 12,00', $utilString->formatPrice($price));
        $price = '12345';
        $this->assertEquals('R$ 12.345,00', $utilString->formatPrice($price));
        $price = '2';
        $this->assertEquals('R$ 2,00', $utilString->formatPrice($price));
    }

    public function testStatusString()
    {
        $utilString = new UtilString();

        $statusCode = 0;
        $this->assertEquals('Pendente', $utilString->getStatusString($statusCode));
        $statusCode = 1;
        $this->assertEquals('Pago', $utilString->getStatusString($statusCode));
        $statusCode = 2;
        $this->assertEquals('Faturado', $utilString->getStatusString($statusCode));
        $statusCode = 3;
        $this->assertEquals('Enviado', $utilString->getStatusString($statusCode));
        $statusCode = 4;
        $this->assertEquals('Entregue', $utilString->getStatusString($statusCode));
        $statusCode = 5;
        $this->assertEquals('Cancelado', $utilString->getStatusString($statusCode));
        $statusCode = 15;
        $this->assertEquals('Status não definido', $utilString->getStatusString($statusCode));
        $statusCode = '';
        $this->assertEquals('Status não definido', $utilString->getStatusString($statusCode));


    }
}