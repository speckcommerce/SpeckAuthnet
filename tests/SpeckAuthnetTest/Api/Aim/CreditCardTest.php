<?php
namespace SpeckAuthnetTest\Api\Aim;

use SpeckAuthnet\Api\Aim\CreditCard,
    PHPUnit_Framework_TestCase,
    SpeckAuthnet\Bootstrap,
    SpeckAuthnet\Api\Aim\Element\LineItem,
    SpeckAuthnetTest\Api\Aim\DataProviders\CreditCard as CreditCardData,
    SpeckAuthnetTest\Api\Aim\DataProviders\Client;

class CreditCardTest extends PHPUnit_Framework_TestCase
{
    protected $sm;

    public function setUp()
    {
        $this->sm = Bootstrap::getServiceManager();
    }

	public function testCanInstantiate()
	{
        $payment = new CreditCard();
        $this->assertTrue($payment instanceof CreditCard);  

		$payment = $this->sm->get('Aim\CreditCard');
		$this->assertTrue($payment instanceof CreditCard);	
        
	}

	public function testGettersAndSetters()
	{
		$payment = new CreditCard();
		
        //test AbstractAim functions
        $payment->setTranKey('thisisatrankey');
        $payment->setLogin('myapilogin');
        $payment->setDelimChar(',');
        $payment->setDelimData('TRUE');
        $payment->setRelayResponse('FALSE');
        $payment->setEncapChar('|');
        $payment->setTestRequest('TRUE');
        $payment->setDuplicateWindow(0);

		$payment->setAuthenticationIndicator('test');
		$payment->setCardholderAuthenticationValue('test');

        //payment information
        $payment->setAmount('20.00');
        $payment->setCardNum('4111111111111111');
        $payment->setExpDate('122012');
        $payment->setAddress('3065 nestall rd');
        $payment->setCity('Laguna Beach');
        $payment->setState('California');
        $payment->setZip('92651');
        $payment->setCountry('US');

        //user information
        $payment->setCustomerIp('172.168.1.1');
        $payment->setCustId('1');
        $payment->setFirstName('steve');
        $payment->setLastName('rizzo');
        $payment->setFax('555-555-5555');
        $payment->setPhone('555-555-5555');

        //order information
        $payment->setInvoiceNum('1234');
        $payment->setDescription('description');
        $payment->setShipToFirstName('steve');
        $payment->setShipToLastName('rizzo');
        $payment->setShipToCity('somewhere');
        $payment->setShipToCompany('somecity');
        $payment->setShipToAddress('28 some street');
        $payment->setShipToState('California');
        $payment->setShipToZip('92677');
        $payment->setShipToEmail('some@email.com');

        $hydrator = $this->sm->get('Aim\Hydrator');
        $lineItem = array(
            'id' => '1',
            'name' => 'test item 1',
            'description' => 'test description 1',
            'quantity' => '1',
            'unit_price' => '9.95',
            'taxable' => 'false'
        );
        $item = new LineItem();
        $hydrator->hydrate($lineItem, $item);
        $payment->addLineItem($item);

        $payment->setDuty('0.00');
        $payment->setFreight(array()); //@todo add freight info
        $payment->setTax('0.00');
        $payment->setTaxExempt(true);
        $payment->setPoNum('1');

        //email information
        $payment->setEmail('test@test.com');
        $payment->setEmailCustomer(true);
        $payment->setHeaderEmailReceipt('Thank you.');
        $payment->setFooterEmailReceipt('Come again');
        $payment->setEmailMerchant('merchant@test.com');

        $payment->setAllowPartialAuth(false);

        /*
         * ASSERTIONS
         */
        $this->assertEquals($payment->getTranKey(), 'thisisatrankey');
        $this->assertEquals($payment->getLogin(), 'myapilogin');
        $this->assertEquals($payment->getVersion(), '3.1');
        $this->assertEquals($payment->getDelimChar(), ',');
        $this->assertEquals($payment->getDelimData(), 'TRUE');
        $this->assertEquals($payment->getRelayResponse(), 'FALSE');
        $this->assertEquals($payment->getEncapChar(), '|');
        $this->assertEquals($payment->getTestRequest(), 'TRUE');
        $this->assertEquals($payment->getDuplicateWindow(), 0);        


        $this->assertEquals('172.168.1.1', $payment->getCustomerIp());
        $this->assertEquals('test', $payment->getAuthenticationIndicator());
        $this->assertEquals('test', $payment->getCardholderAuthenticationValue());

        //payment information
        $this->assertEquals('20.00', $payment->getAmount());
        $this->assertEquals('4111111111111111', $payment->getCardNum());
        $this->assertEquals('122012', $payment->getExpDate());
        $this->assertEquals('3065 nestall rd', $payment->getAddress());
        $this->assertEquals('Laguna Beach', $payment->getCity());
        $this->assertEquals('California', $payment->getState());
        $this->assertEquals('92651', $payment->getZip());
        $this->assertEquals('US', $payment->getCountry());

        //user information
        $this->assertEquals($payment->getCustomerIp(), '172.168.1.1');
        $this->assertEquals($payment->getCustId(), '1');
        $this->assertEquals($payment->getFirstName(), 'steve');
        $this->assertEquals($payment->getLastName(), 'rizzo');
        $this->assertEquals($payment->getFax(), '555-555-5555');
        $this->assertEquals($payment->getPhone(), '555-555-5555');

        //order information
        $this->assertEquals($payment->getInvoiceNum(), '1234');
        $this->assertEquals($payment->getDescription(), 'description');
        $this->assertEquals($payment->getShipToFirstName(), 'steve');
        $this->assertEquals($payment->getShipToLastName(), 'rizzo');
        $this->assertEquals($payment->getShipToCity(), 'somewhere');
        $this->assertEquals($payment->getShipToCompany(), 'somecity');
        $this->assertEquals($payment->getShipToAddress(), '28 some street');
        $this->assertEquals($payment->getShipToState(), 'California');
        $this->assertEquals($payment->getShipToZip(), '92677');
        $this->assertEquals($payment->getShipToEmail(), 'some@email.com');

        $this->assertEquals($payment->getDuty(), '0.00');
        //$this->assertEquals($payment->getFreight(), array()); //@todo add freight info
        $this->assertEquals($payment->getTax(), '0.00');
        $this->assertEquals($payment->getTaxExempt(), true);
        $this->assertEquals($payment->getPoNum(), '1'); 
        
        //email information 
        $this->assertEquals($payment->getEmail(), 'test@test.com');
        $this->assertEquals($payment->getEmailCustomer(), true);
        $this->assertEquals($payment->getHeaderEmailReceipt(), 'Thank you.');
        $this->assertEquals($payment->getFooterEmailReceipt(), 'Come again');
        $this->assertEquals($payment->getEmailMerchant(), 'merchant@test.com');  
        $this->assertEquals($payment->getAllowPartialAuth(), false);      	

        $items = $payment->getLineItems();
        $this->assertTrue(is_array($items));
        $item = current($items);
        $this->assertEquals('1', $item->getId());
        $this->assertEquals('test item 1', $item->getName());
        $this->assertEquals('test description 1', $item->getDescription());
        $this->assertEquals('1', $item->getQuantity());
        $this->assertEquals('9.95', $item->getUnitPrice());
        $this->assertEquals('false', $item->getTaxable());

        //test cannot overwrite method
        $payment->setMethod('CHECK');
        $this->assertEquals('CC', $payment->getMethod());

        //test get Type, a default of AUTH_ONLY is set.
        $payment->getType('AUTH_ONLY', $payment->getType());

        $payment->setType(CreditCard::AUTH_CAPTURE);
        $this->assertEquals('AUTH_CAPTURE', $payment->getType());
    
    }

    public function testToString()
    {
        $payment = new CreditCard();
           
        //payment information
        $payment->setAmount('20.00');
        $payment->setCardNum('4111111111111111');
        $payment->setExpDate('122012');
        $payment->setAddress('3065 nestall rd');
        $payment->setCity('Laguna Beach');
        $payment->setState('California');
        $payment->setZip('92651');
        $payment->setCountry('US');
   }

   public function testCanHydrate()
   {
        $payment = new CreditCard();
        $hydrator = $this->sm->get('Aim\Hydrator');
        $hydrator->hydrate(CreditCardData::getCreditCardData(), $payment);

        //check a few values
        $this->assertEquals('20.00', $payment->getAmount());
   } 

    /* uncomment for integration test
   public function testIntegrationAuthCapture()
   {
        $client = Client::getClient();
        $response = $client->api('Aim\CreditCard')
            ->setData(CreditCardData::getCreditCardData())
            ->setType('AUTH_CAPTURE')
            ->setAmount('15.95')
            ->send();
        $this->assertTrue($response->isSuccess());
   }   

   public function testIntegrationAuthOnly()
   {
        $client = Client::getClient();
        $response = $client->api('Aim\CreditCard')
            ->setData(CreditCardData::getCreditCardData())
            ->send();
        $this->assertTrue($response->isSuccess());
   }   
   */
} 