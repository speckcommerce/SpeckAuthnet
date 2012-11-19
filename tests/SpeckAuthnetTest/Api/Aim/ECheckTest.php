<?php
namespace SpeckAuthnetTest\Api\Aim;

use PHPUnit_Framework_TestCase,
	SpeckAuthnet\Api\Aim\ECheck,
    SpeckAuthnet\Bootstrap,
    SpeckAuthnetTest\Api\Aim\DataProviders\Client,
    SpeckAuthnetTest\Api\Aim\DataProviders\ECheck as ECheckData;

;

class ECheckTest extends PHPUnit_Framework_TestCase
{
    public function testCanInstantiate()
    {	
    	$echeck = new ECheck();
    	$this->assertTrue($echeck instanceof ECheck);

        $echeck = Bootstrap::getServiceManager()->get('Aim\ECheck');
        $this->assertTrue($echeck instanceof ECheck);
    }

    public function testGettersSetters()
    {
        $echeck = new ECheck();
        $echeck->setAmount('20.00');
        $echeck->setBankAbaCode('160000000001');
        $echeck->setBankAcctNum('1234567890');
        $echeck->setBankAcctType('CHECKING');
        $echeck->setBankName('Bank of America');
        $echeck->setRecurringBilling('YES');

        $this->assertEquals('20.00', $echeck->getAmount());
        $this->assertEquals('160000000001', $echeck->getBankAbaCode());
        $this->assertEquals('1234567890', $echeck->getBankAcctNum());
        $this->assertEquals('CHECKING', $echeck->getBankAcctType());
        $this->assertEquals('Bank of America', $echeck->getBankName());
        $this->assertEquals('YES', $echeck->getRecurringBilling());
        $this->assertEquals('ECHECK', $echeck->getMethod());
        $this->assertEquals('WEB', $echeck->getECheckType());
        $this->assertEquals('FALSE', $echeck->getRelayResponse());

        //test setting invalid value for recurring value
        try {
            $echeck->setRecurringBilling('WRONG');
            $this->fail();
        } catch(\Exception $e) {

        }

        //test setting invalid value for echeck type
        try {
            $echeck->setECheckType('WRONG');
            $this->fail();
        } catch(\Exception $e) {

        }        
    }

    public function testConnection()
    {
        $client = Client::getTestClient(ECheckData::getRawResponse());
        $response = $client->api('Aim\ECheck')
            ->setData(ECheckData::getECheckData())
            ->send();
        $this->assertTrue($response->isSuccess());
        $this->assertEquals('2179630782', $response->getTransactionId());
        $this->assertEquals('20.00', $response->getAmount());
        $this->assertEquals('ECHECK', $response->getMethod());
        $this->assertEquals('auth_capture', $response->getTransactionType());
        $this->assertTrue($response->isApproved());
        $this->assertFalse($response->isHeld());
        $this->assertFalse($response->isDeclined());
        $this->assertEquals('XXXX7890', $response->getAccountNumber());
        $this->assertEquals('Bank Account', $response->getCardType());
    }

    public function testErrorConnection()
    {
        $data = ECheckData::getECheckData();
        unset($data['amount']);

        $client = Client::getTestClient(ECheckData::getRawErrorResponse());
        $response = $client->api('Aim\ECheck')
            ->setData($data)
            ->send();
        $this->assertFalse($response->isSuccess());
    }

    /* uncomment to do integration test
    public function testIntegration()
    {
        $client = Client::getClient();
        $response = $client->api('Aim\ECheck')
            ->setData(ECheckData::getECheckData())
            ->send();
        $this->assertTrue($response->isSuccess());
    }
    */
}
