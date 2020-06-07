<?php

namespace Omnipay\Payflow;

use Omnipay\Common\CreditCard;
use Omnipay\Tests\GatewayTestCase;

class ProGatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new ProGateway($this->getHttpClient(), $this->getHttpRequest());

        $this->options = array(
            'amount' => '10.00',
            'card' => new CreditCard(array(
                'firstName' => 'Example',
                'lastName' => 'User',
                'number' => '4111111111111111',
                'expiryMonth' => '12',
                'expiryYear' => '2020',
                'cvv' => '123',
            )),
        );
    }

    public function testAuthorizeSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $response = $this->gateway->authorize($this->options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('A10A6AE7042E', $response->getTransactionReference());
    }

    public function testAuthorizeError()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');

        $response = $this->gateway->authorize($this->options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('User authentication failed', $response->getMessage());
    }

    public function testCapture()
    {
        $options = array(
            'amount' => '10.00',
            'transactionReference' => 'abc123',
        );

        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $response = $this->gateway->capture($options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('A10A6AE7042E', $response->getTransactionReference());
    }

    public function testPurchaseSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $response = $this->gateway->purchase($this->options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('A10A6AE7042E', $response->getTransactionReference());
    }

    public function testReferencePurchaseSuccess()
    {
        $options = array(
            'amount' => '10.00',
            'cardReference' => 'abc123',
        );

        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $response = $this->gateway->purchase($options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('A10A6AE7042E', $response->getTransactionReference());
    }

    public function testReferencePurchaseWithCvvSuccess()
    {
        $options = array(
            'amount' => '10.00',
            'cardReference' => 'abc123',
            'card' => new CreditCard(array(
                'cvv' => '123',
            )),
        );

        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $request = $this->gateway->purchase($options);
        $response = $request->send();

        $this->assertArrayHasKey('CVV2', $request->getData());
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('A10A6AE7042E', $response->getTransactionReference());
    }

    public function testPurchaseError()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');

        $response = $this->gateway->purchase($this->options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertSame('User authentication failed', $response->getMessage());
    }

    public function testRefund()
    {
        $options = array(
            'amount' => '10.00',
            'transactionReference' => 'abc123',
        );

        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $response = $this->gateway->refund($options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('A10A6AE7042E', $response->getTransactionReference());
    }

    public function testVoid()
    {
        $options = array(
            'transactionReference' => 'abc123',
        );

        $this->setMockHttpResponse('PurchaseSuccess.txt');

        $response = $this->gateway->void($options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('A10A6AE7042E', $response->getTransactionReference());
    }
}
