<?php
namespace SpeckAuthnetTest\Api\Aim\DataProviders;

use SpeckAuthnet\Bootstrap;


class CreditCard
{
	public static function getCreditCard()
	{
		$sm = Bootstrap::getServiceManager();
		$hydrator = $sm->get('Aim\Hydrator');
		$request = $sm->get('Aim\CreditCard');
		$hydrator->hydrate(self::getCreditCardData(), $request);

		return $request;
	}

    public static function getCreditCardRawResponse()
    {
        return "HTTP/1.1 200 OK
Connection: close
Date: Sat, 17 Nov 2012 00:36:01 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
Content-Type: text/html
Content-Length: 522
Cache-Control: private, must-revalidate, max-age=0
Expires: Tue, 01 Jan 1980 00:00:00 GMT

|1|,|1|,|1|,|(TESTMODE) This transaction has been approved.|,|000000|,|P|,|0|,|1234|,|description|,|20.00|,|CC|,|auth_only|,|1|,|steve|,|rizzo|,||,|2065 nestall rd|,|laguna beach|,|california|,|92656|,|US|,|555-555-5555|,|555-555-5555|,|test@test.com|,|steve|,|rizzo|,||,|28 some street|,|somecity|,|California|,|92677|,||,|0.00|,|0.00|,||,|TRUE|,|1|,|0A96713749BD09F1C7D7C0D7760D5B93|,||,||,||,||,||,||,||,||,||,||,||,||,|XXXX1111|,|Visa|,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,|some@email.com|,|value1|,|value2|";
    }

	public static function getCreditCardResponse()
	{
		return "|1|,|1|,|1|,|(TESTMODE) This transaction has been approved.|,|000000|,|P|,|0|,|1234|,|description|,|20.00|,|CC|,|auth_only|,|1|,|steve|,|rizzo|,||,|2065 nestall rd|,|laguna beach|,|california|,|92656|,|US|,|555-555-5555|,|555-555-5555|,|test@test.com|,|steve|,|rizzo|,||,|28 some street|,|somecity|,|California|,|92677|,||,|0.00|,|0.00|,||,|TRUE|,|1|,|0A96713749BD09F1C7D7C0D7760D5B93|,||,||,||,||,||,||,||,||,||,||,||,||,|XXXX1111|,|Visa|,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,|some@email.com|,|value1|,|value2|";
	}

    public static function getCreditCardResponseError()
    {
        return "|3|,|3|,|3|,|Not Approved.|,|000000|,|P|,|0|,|1234|,|description|,|20.00|,|CC|,|auth_only|,|1|,|steve|,|rizzo|,||,|2065 nestall rd|,|laguna beach|,|california|,|92656|,|US|,|555-555-5555|,|555-555-5555|,|test@test.com|,|steve|,|rizzo|,||,|28 some street|,|somecity|,|California|,|92677|,||,|0.00|,|0.00|,||,|TRUE|,|1|,|0A96713749BD09F1C7D7C0D7760D5B93|,||,||,||,||,||,||,||,||,||,||,||,||,|XXXX1111|,|Visa|,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,|some@email.com|,|value1|,|value2|";
    }

	public static function getCreditCardData()
	{
       return array(
            'amount' => '20.00',
            'card_num' => '4111111111111111',
            'exp_date' => '122012',
            'address' => '2065 nestall rd',
            'city' => 'laguna beach',
            'state' => 'california',
            'zip' => '92656',
            'country' => 'US',
            'customer_ip' => '172.168.1.1',
            'cust_id' => '1',
            'first_name' => 'steve',
            'last_name' => 'rizzo',
            'fax' => '555-555-5555',
            'phone' => '555-555-5555',
            'invoice_num' => '1234',
            'description' => 'description',
            'ship_to_first_name' => 'steve',
            'ship_to_last_name' => 'rizzo',
            'ship_to_address' => '28 some street',
            'ship_to_city' => 'somecity',
            'ship_to_state' => 'California',
            'ship_to_zip' => '92677',
            'ship_to_email' => 'some@email.com',
            'duty' => '0.00',
            'tax' => '0.00',
            'tax_exempt' => 'true',
            'po_num' => '1',
            'email' => 'test@test.com',
            'email_customer' => 'true',
            'header_email_receipt' => 'Thank you',
            'footer_email_receipt' => 'Come again',
            'email_merchant' => 'merchant@email.com',
            'allow_partial_auth' => 'false',
            'line_items' => array(
                array(
                    'id' => '1',
                    'name' => 'test item 1',
                    'description' => 'test description 1',
                    'quantity' => '1',
                    'unit_price' => '9.95',
                    'taxable' => 'false'
                ),
                array(
                    'id' => '2',
                    'name' => 'test item 2',
                    'description' => 'test description 2',
                    'quantity' => '1',
                    'unit_price' => '10.95',
                    'taxable' => 'false'
                ),                
            ),
            'custom_fields' => array(
                'custom1' => 'value1',
                'custom2' => 'value2'
            )
       );		
	}
}