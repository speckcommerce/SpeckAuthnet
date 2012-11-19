<?php

namespace SpeckAuthnetTest\Api\Aim;

use PHPUnit_Framework_TestCase,
	SpeckAuthnet\Api\Aim\PriorAuthCapture,
    SpeckAuthnet\Bootstrap,
	SpeckAuthnetTest\Api\Aim\DataProviders\CreditCard,
	SpeckAuthnetTest\Api\Aim\DataProviders\Client;

class PriorAuthCaptureTest extends PHPUnit_Framework_TestCase
{
    public function canInstantiate()
    {
    	$capture = new PriorAuthCapture();
    	$this->assertTrue($capture instanceof PriorAuthCapture);

        $capture = Bootstrap::getServiceManager()->get('Aim\PriorAuthCapture');
        $this->assertTrue($capture instanceof PriorAuthCapture);
    }

    public function testGettersSetters()
    {
    	$capture = new PriorAuthCapture();
    	$capture->setTransId('12345');
    	$capture->setSplitTenderId('123456');
    	$capture->setAmount('10.00');

    	$this->assertEquals('12345', $capture->getTransId());
    	$this->assertEquals('123456', $capture->getSplitTenderId());
    	$this->assertEquals('10.00', $capture->getAmount());
    }

    /* uncomment to integration test
    public function testIntegration()
    {
		$client = Client::getClient();
		$response = $client->api('Aim\CreditCard')
			->setData(CreditCard::getCreditCardData())
			->send();
		$this->assertTrue($response->isSuccess());
		
		//void transaction
		$client->api('Aim\PriorAuthCapture')
			->setTransactionId($response->getTransactionId())
			->setAmount('20.00')
			->send();
		$this->assertTrue($response->isSuccess());    	
    }
    */
}
