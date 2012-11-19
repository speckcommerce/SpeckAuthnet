<?php
namespace SpeckAuthnetTest\Api\Aim;

use PHPUnit_Framework_TestCase,
	SpeckAuthnet\Api\Aim\CaptureOnly,
    SpeckAuthnet\Bootstrap,
	SpeckAuthnetTest\Api\Aim\DataProviders\Client,
	SpeckAuthnetTest\Api\Aim\DataProviders\CaptureOnly as CaptureOnlyData;

class CaptureOnlyTest extends PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {
    	$capture = new CaptureOnly();
    	$this->assertTrue($capture instanceof CaptureOnly);

        $capture = Bootstrap::getServiceManager()->get('Aim\CaptureOnly');
        $this->assertTrue($capture instanceof CaptureOnly);           
    }

    public function testGetterSetter()
    {
    	$capture = new CaptureOnly();
		$capture->setAuthCode('someauthcode');
		$capture->setAmount('20.00');
		$capture->setExpDate('122012');
		$capture->setCardNum('4111111111111111');

		$this->assertEquals('4111111111111111', $capture->getCardNum());
		$this->assertEquals('122012', $capture->getExpDate());
		$this->assertEquals('someauthcode', $capture->getAuthCode());
		$this->assertEquals('20.00', $capture->getAmount());
    }

    /**
     * @todo determine how to test this against Authnet.  Currently requires valid auth code
     */

    /* uncomment to test integration
    public function testIntegration()
    {
    	$client = Client::getClient();
    	$response = $client->api('Aim\CaptureOnly')
    		->setData(CaptureOnlyData::getCaptureOnlyData())
    		->send();
    	//test will currently fail with response text of need valid auth code
    	$this->assertTrue($response->isSuccess());
    }
    */
}
