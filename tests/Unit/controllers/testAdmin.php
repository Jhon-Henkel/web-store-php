<?php

namespace Unit\controllers;

use core\controllers\Admin;
use PHPUnit\Framework\TestCase;

class testAdmin extends TestCase
{
    protected function tearDown(): void
    {
        \Mockery::close();
    }

    public function testLogout()
    {
        $mockStore = \Mockery::mock('alias:core\classes\Store')->makePartial();
        $mockStore->shouldReceive('redirect')->andReturnTrue();

        $_SESSION['admin'] = true;
        $_SESSION['user'] = true;

        $admin = new Admin();
        $admin->logout();
        $this->assertArrayNotHasKey('admin', $_SESSION);
        $this->assertArrayNotHasKey('user', $_SESSION);
    }

    public function testIndex()
    {
        $this->getDefaultStoreMock();

        $adminModelMock = \Mockery::mock('overload:core\models\AdminModel')->makePartial();
        $adminModelMock->shouldReceive('countPendingOrders')->once()->withAnyArgs()->andReturnTrue();
        $adminModelMock->shouldReceive('countPaidOrders')->once()->withAnyArgs()->andReturnTrue();

        $admin = new Admin();
        $test = $admin->index();
        $this->assertNull($test);
    }

    public function testAdminLoginWithAdminHasLogged()
    {
        $mockStore = \Mockery::mock('alias:core\classes\Store')->makePartial();
        $mockStore->shouldReceive('isAdminLogged')->once()->andReturnTrue();
        $mockStore->shouldReceive('redirect')->once()->andReturnTrue();

        $admin = new Admin();
        $test = $admin->adminLogin();
        $this->assertNull($test);
    }

    public function testAdminLoginWithAdminNotLogger()
    {
        $mockStore = \Mockery::mock('alias:core\classes\Store')->makePartial();
        $mockStore->shouldReceive('isAdminLogged')->once()->andReturnFalse();
        $mockStore->shouldReceive('layoutAdmin')->once()->andReturnTrue();

        $admin = new Admin();
        $test = $admin->adminLogin();
        $this->assertNull($test);
    }

    public function testAdminLoginSubmit()
    {
        $mockStore = \Mockery::mock('alias:core\classes\Store')->makePartial();
        $mockStore->shouldReceive('isAdminLogged')->once()->andReturnFalse();
        $mockStore->shouldReceive('redirect')->once()->andReturnFalse();

        $adminModelMock = \Mockery::mock('overload:core\models\AdminModel')->makePartial();
        $adminModelMock->shouldReceive('validateLoginAdmin')->once()->withAnyArgs()->andReturn((object)['id_admin' => '123', 'usuario_admin' => 'abc']);

        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['adminLogin'] = 'def';
        $_POST['adminPass'] = 'ghi';

        $admin = new Admin();
        $test = $admin->adminLoginSubmit();
        $this->assertNull($test);
        $this->assertEquals('123', $_SESSION['admin']);
        $this->assertEquals('abc', $_SESSION['user']);
    }

    public function testOrdersList()
    {
        $this->getDefaultStoreMock();

        $_GET['status'] = 'cancelado';

        $adminModelMock = \Mockery::mock('overload:core\models\AdminModel')->makePartial();
        $adminModelMock->shouldReceive('listOrders')->once()->withAnyArgs()->andReturnTrue();

        $admin = new Admin();
        $test = $admin->ordersList();
        $this->assertNull($test);
    }

    public function testClientsList()
    {
        $this->getDefaultStoreMock();

        $adminModelMock = \Mockery::mock('overload:core\models\AdminModel')->makePartial();
        $adminModelMock->shouldReceive('listAllClients')->once()->withAnyArgs()->andReturn([]);

        $admin = new Admin();
        $test = $admin->clientsList();
        $this->assertNull($test);
    }

    public function testClientDetails()
    {
        $this->getDefaultStoreMock();

        $_GET['id'] = 12;

        $adminModelMock = \Mockery::mock('overload:core\models\AdminModel')->makePartial();
        $adminModelMock->shouldReceive('getClientById')->once()->withAnyArgs()->andReturn([['aaa' => 'bbb']]);
        $adminModelMock->shouldReceive('countOrdersByClientId')->once()->withAnyArgs()->andReturnTrue();

        $admin = new Admin();
        $test = $admin->clientDetails();
        $this->assertNull($test);
    }

    public function testClientOrderHistory()
    {
        $this->getDefaultStoreMock();

        $_GET['id'] = 123;

        $adminModelMock = \Mockery::mock('overload:core\models\AdminModel')->makePartial();
        $adminModelMock->shouldReceive('getClientById')->once()->withAnyArgs()->andReturn([['aaa' => 'bbb']]);
        $adminModelMock->shouldReceive('getOrdersByClientId')->once()->withAnyArgs()->andReturnTrue();

        $admin = new Admin();
        $test = $admin->clientOrderHistory();
        $this->assertNull($test);
    }

    public function testOrderDetails()
    {
        $this->getDefaultStoreMock();

        $_GET['id'] = 123;

        $adminModelMock = \Mockery::mock('overload:core\models\AdminModel')->makePartial();
        $adminModelMock->shouldReceive('getClientById')->once()->withAnyArgs()->andReturn([['ccc' => 'ddd']]);
        $adminModelMock->shouldReceive('getOrdersByOrderId')->once()->withAnyArgs()->andReturn([(object)['id_cliente' => 'aaa']]);
        $adminModelMock->shouldReceive('getProductsInOrderByOrderId')->once()->withAnyArgs()->andReturnTrue();

        $admin = new Admin();
        $test = $admin->orderDetails();
        $this->assertNull($test);
    }

    public function testSetStatus()
    {
        $mockStore = \Mockery::mock('alias:core\classes\Store')->makePartial();
        $mockStore->shouldReceive('isAdminLogged')->once()->andReturnTrue();
        $mockStore->shouldReceive('redirect')->once()->andReturnTrue();

        $_GET['orderId'] = 123;
        $_GET['status'] = 'Pendente';

        $adminModelMock = \Mockery::mock('overload:core\models\AdminModel')->makePartial();
        $adminModelMock->shouldReceive('setOrderStatus')->once()->withAnyArgs()->andReturnTrue();
        $adminModelMock->shouldReceive('sendEmail')->once()->withAnyArgs()->andReturnTrue();

        $admin = new Admin();
        $test = $admin->setStatus();
        $this->assertNull($test);
    }

    public function testPrintPdf()
    {
        $mockStore = \Mockery::mock('alias:core\classes\Store')->makePartial();
        $mockStore->shouldReceive('isAdminLogged')->once()->andReturnTrue();

        $_GET['orderId'] = 789;

        $adminModelMock = \Mockery::mock('overload:core\models\AdminModel')->makePartial();
        $adminModelMock->shouldReceive('getClientById')->once()->withAnyArgs()->andReturn([['ccc' => 'ddd']]);
        $adminModelMock->shouldReceive('getOrdersByOrderId')->once()->withAnyArgs()->andReturn([(object)['id_cliente' => 'aaa']]);
        $adminModelMock->shouldReceive('getProductsInOrderByOrderId')->once()->withAnyArgs()->andReturnTrue();

        $pdfMock = \Mockery::mock('overload:core\classes\Pdf')->makePartial();
        $pdfMock->shouldReceive('generatePdfOrderPaid')->once()->withAnyArgs()->andReturnTrue();
        $pdfMock->shouldReceive('showPdf')->once()->andReturnTrue();

        $admin = new Admin();
        $test = $admin->printPdf();
        $this->assertNull($test);
    }





    public function getDefaultStoreMock()
    {
        $mockStore = \Mockery::mock('alias:core\classes\Store')->makePartial();
        $mockStore->shouldReceive('isAdminLogged')->once()->andReturnTrue();
        $mockStore->shouldReceive('layoutAdmin')->once()->andReturnTrue();
        return $mockStore;
    }
}