<?php
namespace SpeckAuthnetTest\Api\Aim;

use PHPUnit_Framework_TestCase,
	SpeckAuthnet\Api\Aim\ResponseHydrator,
	SpeckAuthnet\Api\Aim\Response,
	SpeckAuthnet\Bootstrap,
    SpeckAuthnetTest\Api\Aim\DataProviders\CreditCard;

class ResponseHydratorTest extends PHPUnit_Framework_TestCase
{
	protected $sm;

    public function setUp()
    {
        $this->sm = Bootstrap::getServiceManager();
    }

    public function testInstantiation()
    {
    	$hydrator = new ResponseHydrator();
    	$this->assertTrue($hydrator instanceof ResponseHydrator);

    	$hydrator = $this->sm->get('Aim\ResponseHydrator');
    	$this->assertTrue($hydrator instanceof ResponseHydrator);
    }

    public function testCanHydrateResponse()
    {
    	$hydrator = $this->sm->get('Aim\ResponseHydrator');
    	$request  = CreditCard::getCreditCard();
    	$response = $hydrator->hydrate($request, CreditCard::getCreditCardResponse());
    	
    	$this->assertTrue($response instanceof Response);
    	$this->assertTrue($response->isSuccess());
   		
   		//test all fields of response
        $this->assertEquals('1', $response->getResponseCode());
        $this->assertEquals('1', $response->getResponseSubcode());
        $this->assertEquals('1', $response->getResponseReasonCode());
        $this->assertEquals('(TESTMODE) This transaction has been approved.', $response->getResponseReasonText());
        $this->assertEquals('000000', $response->getAuthorizationCode());
        $this->assertEquals('P', $response->getAvsResponse());
        $this->assertEquals('0', $response->getTransactionId());
        $this->assertEquals('1234', $response->getInvoiceNumber());
        $this->assertEquals('description', $response->getDescription());
        $this->assertEquals('20.00', $response->getAmount());
        $this->assertEquals('CC', $response->getMethod());
        $this->assertEquals('auth_only', $response->getTransactionType());
        $this->assertEquals('1', $response->getCustomerId());
        $this->assertEquals('steve', $response->getFirstName());
        $this->assertEquals('rizzo', $response->getLastName());
        $this->assertEquals('', $response->getCompany());
        $this->assertEquals('2065 nestall rd', $response->getAddress());
        $this->assertEquals('laguna beach', $response->getCity());
        $this->assertEquals('california', $response->getState());
        $this->assertEquals('92656', $response->getZipCode());
        $this->assertEquals('US', $response->getCountry());
        $this->assertEquals('555-555-5555', $response->getPhone());
        $this->assertEquals('555-555-5555', $response->getFax());
        $this->assertEquals('test@test.com', $response->getEmailAddress());
        $this->assertEquals('steve', $response->getShipToFirstName());
        $this->assertEquals('rizzo', $response->getShipToLastName());
        $this->assertEquals('', $response->getShipToCompany());
        $this->assertEquals('28 some street', $response->getShipToAddress());
        $this->assertEquals('somecity', $response->getShipToCity());
        $this->assertEquals('California', $response->getShipToState());
        $this->assertEquals('92677', $response->getShipToZipCode());
        $this->assertEquals('', $response->getShipToCountry());
        $this->assertEquals('0.00', $response->getTax());
        $this->assertEquals('0.00', $response->getDuty());
        $this->assertEquals('', $response->getFreight());
        $this->assertEquals('TRUE', $response->getTaxExempt());
        $this->assertEquals('1', $response->getPurchaseOrderNumber());
        $this->assertEquals('0A96713749BD09F1C7D7C0D7760D5B93', $response->getMd5Hash());
        $this->assertEquals('', $response->getCardCodeResponse());
        $this->assertEquals('', $response->getCavvResponse());
        $this->assertEquals('XXXX1111', $response->getAccountNumber());
        $this->assertEquals('Visa', $response->getCardType());
        $this->assertEquals('', $response->getSplitTenderId());
        $this->assertEquals('', $response->getRequestedAmount());
        $this->assertEquals('', $response->getBalanceOnCard());
        $this->assertEquals(true, $response->getApproved());
        $this->assertEquals(false, $response->getDeclined());
        $this->assertEquals(false, $response->getError());
        $this->assertEquals(false, $response->getHeld());
        $this->assertEmpty($response->getErrorMessages());
        $customFields = $response->getCustomFields();
        $this->assertTrue(count($customFields) == 2);
        $this->assertTrue(array_key_exists('custom1', $customFields) && array_key_exists('custom2', $customFields));
        $this->assertEquals('value1', $response->getCustomField('custom1'));
        $this->assertEquals('value2', $response->getCustomField('custom2'));
    	$this->assertEquals(CreditCard::getCreditCardResponse(), $response->getRawResponse());
    }
    
    public function TestHydrateResponseFailureWithData()
    {
    	$hydrator = $this->sm->get('Aim\ResponseHydrator');
    	$request  = CreditCard::getCreditCard();
    	$content = "|weird|,|failure|,|string|";
    	$response = $hydrator->hydrate($request, $content);
    	$this->assertFalse($response->isSuccess());
    	$errorMsg = current($response->getErrorMessages());
    	$this->assertEquals("Unrecognized response from AuthorizeNet: $content", $errorMsg);

    }

    public function testHydrateResponseFailureNoData()
    {
    	$hydrator = $this->sm->get('Aim\ResponseHydrator');
    	$request  = CreditCard::getCreditCard();
    	$content = "";
    	$response = $hydrator->hydrate($request, $content);
    	$this->assertFalse($response->isSuccess());
    	$errorMsg = current($response->getErrorMessages());
    	$this->assertEquals("Error connecting to AuthorizeNet", $errorMsg);

    }

    public function testHydrateResponseError()
    {
    	$hydrator = $this->sm->get('Aim\ResponseHydrator');
    	$request  = CreditCard::getCreditCard();
    	$content = CreditCard::getCreditCardResponseError();
    	$response = $hydrator->hydrate($request, $content);
    	$this->assertFalse($response->isSuccess());
    	$errorMsg = current($response->getErrorMessages());
    	$this->assertContains("AuthorizeNet Error:", $errorMsg);

    }
}
