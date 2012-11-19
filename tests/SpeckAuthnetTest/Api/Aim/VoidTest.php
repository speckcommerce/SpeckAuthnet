<?php
namespace SpeckAuthnetTest\Api\Aim;

use PHPUnit_Framework_TestCase,
	SpeckAuthnet\Api\Aim\Void,
	SpeckAuthnet\Bootstrap,
	SpeckAuthnetTest\Api\Aim\DataProviders\CreditCard,
	SpeckAuthnetTest\Api\Aim\DataProviders\Void as VoidData,
	SpeckAuthnetTest\Api\Aim\DataProviders\Client;

class VoidTest extends PHPUnit_Framework_TestCase
{
	protected $sm;
	protected $client;
	public function setup()
	{
		$this->sm = Bootstrap::getServiceManager();
		$this->client = Client::getClient();
	}
	public function testCanInstantiate()
	{
		$void = new Void();
		$this->assertTrue($void instanceof Void);

		$void = Bootstrap::getServiceManager()->get('Aim\Void');
		$this->assertTrue($void instanceof Void);
	}

	public function testGettersSetters()
	{
		$void = new Void();
		$void->setTransId('12345');
		$this->assertEquals('12345', $void->getTransId());
		$this->assertEquals(Void::VOID, $void->getType());

		$void->setTransactionId('67890');
		$this->assertEquals('67890', $void->getTransactionId());
	}

	public function testConnection()
	{
		$client = Client::getTestClient(VoidData::getRawResponse());
		$response = $client->api('Aim\Void')
			->setTransactionId('1234')
			->send();
		$this->assertTrue($response->isSuccess());
	}

	/*	uncomment to perform an integration test
	public function testIntegration()
	{
		$client = $this->client;
		$response = $client->api('Aim\CreditCard')
			->setData(CreditCard::getCreditCardData())
			->setType('AUTH_CAPTURE')
			->send();
		$this->assertTrue($response->isSuccess());
		
		//void transaction
		$client->api('Aim\Void')
			->setTransactionId($response->getTransactionId())
			->send();
		$this->assertTrue($response->isSuccess());
	}
	*/
}