<?php
namespace SpeckAuthnetTest\Api\Aim\DataProviders;

class ECheck
{
	public static function getRawResponse()
	{
		return "HTTP/1.1 200 OK
Connection: close
Date: Sat, 17 Nov 2012 16:58:26 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
Content-Type: text/html
Content-Length: 333
Cache-Control: private, must-revalidate, max-age=0
Expires: Tue, 01 Jan 1980 00:00:00 GMT

|1|,|1|,|1|,|This transaction has been approved.|,||,|P|,|2179630782|,||,||,|20.00|,|ECHECK|,|auth_capture|,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,|75DBD36762AEB5C3EC50BA57E54588F1|,||,||,||,||,||,||,||,||,||,||,||,||,|XXXX7890|,|Bank Account|,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,|WEB|";		
	}

	public static function getRawErrorResponse()
	{
		return "HTTP/1.1 200 OK
Connection: close
Date: Sat, 17 Nov 2012 16:57:16 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
Content-Type: text/html
Content-Length: 315
Cache-Control: private, must-revalidate, max-age=0
Expires: Tue, 01 Jan 1980 00:00:00 GMT

|3|,|1|,|5|,|A valid amount is required.|,||,|P|,|0|,||,||,|0.00|,|ECHECK|,|auth_capture|,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,|EC86846C19509DBC4CFE9D95197665C1|,||,||,||,||,||,||,||,||,||,||,||,||,|XXXX7890|,|Bank Account|,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,|WEB|";		
	}

	public static function getECheckData()
	{
		return array(
			'amount'				=> '20.00',
			'bank_aba_code'			=> '122000661', //a real aba number 
			'bank_acct_num'			=> '1234567890', //a fake account number
			'bank_acct_type'		=> 'CHECKING',
			'bank_name'				=> 'Bank of America',
			'bank_acct_name'		=> 'Steve Rizzo',
			'bank_check_number'		=> '1',
			'recurring_billing'		=> 'NO',
		);
	}
}