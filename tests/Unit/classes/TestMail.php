<?php

namespace Unit\classes;

use core\classes\Mail;
use PHPUnit\Framework\TestCase;

class TestMail extends TestCase
{
    public string $clientMail = 'test@mail.com';
    public string $orderId = '12345';

    protected function tearDown(): void
    {
        \Mockery::close();
    }

    public function testSendEmailRegisterConfirm()
    {
        $mockSendMail = $this->getMockSendEmail();
        $sendMail = $mockSendMail->sendEmailRegisterConfirm($this->clientMail, uniqid());
        $this->assertTrue($sendMail);
    }

    public function testSendEmailOrderConfirmed()
    {
        $mockSendMail = $this->getMockSendEmail();
        $sendMail = $mockSendMail->sendEmailOrderConfirmed($this->clientMail, $this->getOrderDataFake());
        $this->assertTrue($sendMail);
    }

    public function testSendEmailOrderPending()
    {
        $mockSendMail = $this->getMockSendEmail();
        $sendMail = $mockSendMail->sendEmailOrderPending($this->clientMail, $this->orderId);
        $this->assertTrue($sendMail);
    }

    public function testSendEmailOrderPaid()
    {
        $mockSendMail = $this->getMockSendEmail();
        $sendMail = $mockSendMail->sendEmailOrderPaid($this->clientMail, $this->orderId);
        $this->assertTrue($sendMail);
    }

    public function testSendEmailOrderBilled()
    {
        $mockSendMail = $this->getMockSendEmail();
        $sendMail = $mockSendMail->sendEmailOrderBilled($this->clientMail, $this->orderId);
        $this->assertTrue($sendMail);
    }

    public function testSendEmailOrderSend()
    {
        $mockSendMail = $this->getMockSendEmail();
        $sendMail = $mockSendMail->sendEmailOrderSend($this->clientMail, $this->orderId);
        $this->assertTrue($sendMail);
    }

    public function testSendEmailOrderFinish()
    {
        $mockSendMail = $this->getMockSendEmail();
        $sendMail = $mockSendMail->sendEmailOrderFinish($this->clientMail, $this->orderId);
        $this->assertTrue($sendMail);
    }

    public function testSendEmailOrderCanceled()
    {
        $mockSendMail = $this->getMockSendEmail();
        $sendMail = $mockSendMail->sendEmailOrderCanceled($this->clientMail, $this->orderId);
        $this->assertTrue($sendMail);
    }

    public function getMockSendEmail()
    {
        $mockSendMail = \Mockery::mock(Mail::class)->makePartial();
        $mockSendMail->shouldReceive('sendEmail')->withAnyArgs()->once()->andReturnTrue();
        return $mockSendMail;
    }

    public function getOrderDataFake()
    {
        return array(
            'pagamento' => [
                'orderCode' => $this->orderId,
                'pix' => '1234567899'
            ],
            'produtos' => ['teste123'],
            'total' => '456.789'
        );
    }
}