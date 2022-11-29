<?php

namespace Unit\classes;

use core\classes\Store;
use PHPUnit\Framework\TestCase;

class TestStore extends TestCase
{
    public string $stringToEncrypt = '12345678';

    public function testLayoutSemEstrutura()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Coleção de estruturas inválida!');
        Store::layout(null, null);
    }

    public function testLayoutAdminSemEstrutura()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Coleção de estruturas inválida!');
        Store::layoutAdmin(null, null);
    }

    public function testIsClientLogged()
    {
        $logged = Store::isClientLogged();
        $this->assertFalse($logged);

        $_SESSION['client'] = true;

        $logged = Store::isClientLogged();
        $this->assertTrue($logged);
    }

    public function testIsAdminLogged()
    {
        $logged = Store::isAdminLogged();
        $this->assertFalse($logged);

        $_SESSION['admin'] = true;

        $logged = Store::isAdminLogged();
        $this->assertTrue($logged);
    }

    public function testGenerateMd5UniqId()
    {
        $hashMd5 = Store::generateMd5UniqId();
        $this->assertIsString($hashMd5);
    }

    public function testGenerateOrderCode()
    {
        $orderCode = Store::generateOrderCode();
        $this->assertIsString($orderCode);
    }

    public function testStrEncryptAndDecryptAes()
    {
        $stringEncrypted = Store::strEncryptAes($this->stringToEncrypt);
        $this->assertIsString($stringEncrypted);
        $stringDecrypted = Store::strDecryptAes($stringEncrypted);
        $this->assertEquals($this->stringToEncrypt, $stringDecrypted);
    }
}