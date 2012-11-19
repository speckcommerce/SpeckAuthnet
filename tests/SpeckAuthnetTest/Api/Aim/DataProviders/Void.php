<?php
namespace SpeckAuthnetTest\Api\Aim\DataProviders;

class Void
{
	public static function getRawResponse()
	{
		return "HTTP/1.1 200 OK
Connection: close
Date: Sat, 17 Nov 2012 05:54:49 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
Content-Type: text/html
Content-Length: 322
Cache-Control: private, must-revalidate, max-age=0
Expires: Tue, 01 Jan 1980 00:00:00 GMT

|1|,|1|,|1|,|This transaction has been approved.|,|JQJJCM|,|P|,|2179613218|,|1234|,||,|0.00|,|CC|,|void|,|1|,||,||,||,||,||,||,|92656|,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,|09285F848EED8F1BC8AD3FDF41B7C5D1|,||,||,||,||,||,||,||,||,||,||,||,||,|XXXX1111|,|Visa|,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||,||";
	}
}