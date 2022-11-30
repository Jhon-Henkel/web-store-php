<?php

namespace Unit\controllers;

use core\controllers\Cart;
use PHPUnit\Framework\TestCase;

class CartUnitTest extends TestCase
{
    protected function tearDown(): void
    {
        \Mockery::close();
    }

    public function testAddToCart()
    {
        $_GET['id_pdt'] = 654;

        $productModelMock = \Mockery::mock('overload:core\models\Product')->makePartial();
        $productModelMock->shouldReceive('validateStockProduct')->once()->withAnyArgs()->andReturn([]);

        $_SESSION['cart'] = '654';

        $cart = new Cart();
        $test = $cart->addToCart();
        $this->assertNull($test);
    }

    public function testCleanCart()
    {
        $mockStore = \Mockery::mock('alias:core\classes\Store')->makePartial();
        $mockStore->shouldReceive('redirect')->once()->andReturnTrue();

        $_SESSION['cart'] = 123;
        $cart = new Cart();
        $cart->cleanCart();
        $this->assertArrayNotHasKey('cart', $_SESSION);
    }

    public function testRemoveProduct()
    {
        $_GET['idPdt'] = '132';
        $_SESSION['cart'] = ['132' => [], '654' => []];

        $mockStore = \Mockery::mock('alias:core\classes\Store')->makePartial();
        $mockStore->shouldReceive('redirect')->once()->andReturnTrue();

        $cart = new Cart();
        $cart->removeProduct();

        $this->assertArrayNotHasKey('132', $_SESSION['cart']);
        $this->assertArrayHasKey('654', $_SESSION['cart']);
    }

    public function testFinishOrder()
    {
        $mockStore = \Mockery::mock('alias:core\classes\Store')->makePartial();
        $mockStore->shouldReceive('isClientLogged')->once()->andReturnTrue();
        $mockStore->shouldReceive('redirect')->once()->andReturnTrue();

        $cart = new Cart();
        $test = $cart->finishOrder();
        $this->assertNull($test);
    }
}