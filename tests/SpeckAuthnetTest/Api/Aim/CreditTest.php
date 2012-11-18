<?php
namespace SpeckAuthnetTest\Api\Aim;

use PHPUnit_Framework_TestCase,
	SpeckAuthnet\Bootstrap,
	SpeckAuthnetTest\Api\Aim\DataProviders\Client,
	SpeckAuthnetTest\Api\Aim\DataProviders\CreditCard,
	SpeckAuthnetTest\Api\Aim\DataProviders\Credit as CreditData,
	SpeckAuthnet\Api\Aim\Credit;

class CreditTest extends PHPUnit_Framework_TestCase
{
    public function testCanInstatiate()
    {
    	$credit = new Credit();
    	$this->assertTrue($credit instanceof Credit);

    	$credit = Bootstrap::getServiceManager()->get('Aim\Credit');
		$this->assertTrue($credit instanceof Credit);    	
    }

    public function testGetterSetters()
    {
    	$credit = new Credit();
    	$credit->setTransId('1234567');
    	$credit->setAmount('20.00');
    	$credit->setCardNum('1111'); //last 4 digits only (can also enter full number)

    	$this->assertEquals('1234567', $credit->getTransId());
    	$this->assertEquals('20.00', $credit->getAmount());
    	$this->assertEquals('1111', $credit->getCardNum());
    }
   
    public function testConnection()
    {
    	$client = Client::getTestClient(CreditCard::getCreditCardRawResponse());
    	$response = $client->api('Aim\CreditCard')
    		->setData(CreditCard::getCreditCardData())
    		->setType('AUTH_CAPTURE')
    		->send();
    	$this->assertTrue($response->isSuccess());

		$client = Client::getTestClient(CreditData::getRawResponse());
    	$credit = $client->api('Aim\Credit')
    		->setCardNum('4111111111111111')
    		->setAmount('10.00')
    		->setTransId($response->getTransactionId())
    		->send();
    	$this->assertTrue($response->isSuccess());
    }
    

    /* uncomment to test integration 
    public function testIntegration()
    {
    	$client = Client::getClient();
    	$response = $client->api('Aim\CreditCard')
    		->setData(CreditCard::getCreditCardData())
    		->setType('AUTH_CAPTURE')
    		->send();
    	$this->assertTrue($response->isSuccess());

    	$credit = $client->api('Aim\Credit')
    		->setCardNum('XXXX1111')
    		->setAmount('11.00')
    		->setTransId($response->getTransactionId())
    		->setTestRequest('TRUE')
    		->send();
    	$this->assertTrue($response->isSuccess());
    } */
    
    
}
