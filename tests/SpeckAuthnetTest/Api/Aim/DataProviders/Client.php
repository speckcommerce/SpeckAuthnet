<?php
namespace SpeckAuthnetTest\Api\Aim\DataProviders;

use SpeckAuthnet\Bootstrap,
	Zend\Http\Client\Adapter\Test;

class Client
{
	public static function getClient()
	{
		$sm = Bootstrap::getServiceManager();
		$client = $sm->get('SpeckAuthnet\Client');

		return clone $client;
	}

	public static function getTestClient($mockResponse)
	{
		$client = self::getClient();

 		//set test adapter
 		$httpClient = $client->getHttpClient();
 		$adapter = new Test();
 		$adapter->setResponse($mockResponse);
 		$httpClient->setAdapter($adapter);		

 		return $client;
	}
}