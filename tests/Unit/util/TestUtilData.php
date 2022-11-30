<?php

namespace Unit\util;

use core\util\UtilData;
use PHPUnit\Framework\TestCase;

class TestUtilData extends TestCase
{
    public function testDataFormat()
    {
        $dateUS = '2022-10-02 00:00:00';
        $utilDate = new UtilData();
        $this->assertEquals('02/10/2022', $utilDate->formatDateUsToBr($dateUS));
    }
}