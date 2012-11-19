<?php
namespace SpeckAuthnetTest\Api\Aim\DataProviders;

class Credit
{

	public static function getRawResponse()
	{
		return "HTTP/1.1 200 OK
Connection: close
Date: Sun, 18 Nov 2012 01:00:55 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
Content-Type: text/html
Content-Length: 317
Cache-Control: private, must-revalidate, max-age=0
Expires: Tue, 01 Jan 1980 00:00:00 GMT

|1|,|1|,|1|,|(TESTMODE) This transaction has been approved.|,|000000|,|P|,|0|,||,||,|11.00|,|CC|,|credit|,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,|9132165E6609A31ACBD611307D81153C|,||,||,||,||,||,||,||,||,||,||,||,||,|XXXX1111|,|Visa|,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||";
	}

	public static function getCreditData()
	{
		return array(
			'amount' => '20.00',
			'card_num'=> '1111',
			'trans_id'=>'1234567'
		);
	}
}