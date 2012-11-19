<?php
namespace SpeckAuthnetTest;
use PHPUnit_Framework_TestCase,
	SpeckAuthnet\Bootstrap,
	SpeckAuthnetTest\Api\Aim\DataProviders\Client as ClientData,
    SpeckAuthnetTest\Api\Aim\DataProviders\CreditCard,
    SpeckAuthnet\Client,
    Zend\Http\Client\Adapter\Test as TestAdapter;

Class ClientTest extends PHPUnit_Framework_TestCase
{
	protected $sm;
	protected $client;

	public function setup()
	{
		$this->sm = Bootstrap::getServiceManager();
		$this->client = ClientData::getClient();
	}

	public function tearDown()
	{
		$this->client->resetApi();
	}

    public function testCanInstantiate()
    {
    	$client = $this->client;
    	$this->assertTrue($client instanceof \SpeckAuthnet\Client);
    }

 	public function testApi()
 	{
 		$client = $this->client;
 		$client->api('Aim\CreditCard')->setData(CreditCard::getCreditCardData());

 		//test proxy
 		$this->assertEquals('20.00', $client->getAmount());
 		$client->setAmount('30.00');
 		$this->assertEquals('30.00', $client->getAmount());
 		$this->assertTrue($client->getApi() instanceof \SpeckAuthnet\Api\Aim\CreditCard); 		
 		$this->assertEquals('Aim', $client->getApiNamespace());
		try {
			$client->setApi('Aim\Invalid');
			$this->fail();
		} catch(\Exception $e) {
			//ignore
		}	
 	}

 	public function testSendErrors()
 	{
 		//test failure with no client
 		$client = new Client();
 		$client->setServiceManager($this->sm);
 		try {
 			$client->api('Aim\Credit')->send();
 			$this->fail();
 		} catch(\Exception $e) {
 			//ignore
 		}

 		//test failure with no api
 		try {
 			$this->client->send();
 			$this->fail();
 		} catch(\Exception $e) {
 			//ignore
 		}
 	}

 	public function testSetDataNoApi()
 	{
	   	$client = $this->client;
	   	try {
	   		$client->setMethod('CC');
	   		$this->fail();
	   	} catch(\Exception $e) {
	   		//ignore
	   	}
 	}

 	public function testSetDataNoMethodOnApi()
 	{
	   	$client = $this->client;
	   	try {
	   		$client->setWeirdness('CC');
	   		$this->fail();
	   	} catch(\Exception $e) {
	   		//ignore
	   	}
 	} 	

 	/**
 	 * Integration test
 	 */
 	public function testSuccessConnection()
 	{
 		$client = $this->client;
 		
 		//set test adapter
 		$httpClient = $client->getHttpClient();
 		$adapter = new TestAdapter();
 		$adapter->setResponse(CreditCard::getCreditCardRawResponse());
 		$httpClient->setAdapter($adapter);

 		$response = $client->api('Aim\CreditCard')
 			->setData(CreditCard::getCreditCardData())
 			->send();
 		$this->assertTrue($response instanceof \SpeckAuthnet\Api\Aim\Response);
 		$this->assertTrue($response->isSuccess());
 	}

 	public function testNoHttpClient()
 	{
 		try {
 			$client = $this->client;
 			$client->setHttpClient(null);
 			$client->api('Aim\CreditCard')->send();
 			$this->fail();
 		} catch(\Exception $e) {
 			//ignore
 		}
 	}
}