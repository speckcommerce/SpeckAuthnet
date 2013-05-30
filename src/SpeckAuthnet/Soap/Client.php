<?php

namespace SpeckAuthnet\Soap;

class Client extends \SoapClient {

	private $authnetLogin;
	private $authnetTransactionKey;

	const WSDL = "https://api.authorize.net/soap/v1/Service.asmx?WSDL";
	const WSDL_TEST = "https://apitest.authorize.net/soap/v1/Service.asmx?WSDL";

	function __construct($options = array()) {
		$defaults = array(
			'wsdl' => self::WSDL,
			'login' => null,
			'transactionKey' => null
		);

		$options += $defaults;

		$this->setCredentials($options['login'], $options['transactionKey']);

		parent::__construct($options['wsdl'], $options);
	}

	public function setCredentials($login, $transKey) {
		$this->authnetLogin = $login;
		$this->authnetTransactionKey = $transKey;

		return $this;
	}

	/**
	 * Perform the SOAP Request against Authorize.net Servers. We override this callback method
	 * and inject a few variables into the request and clean up the XML a bit so it works properly
	 * with the Authorize.net API.
	 *
	 * @see SoapClient::__doRequest()
	 */
	public function __doRequest($request, $location, $action, $version, $one_way = null) {

		$dom = new \DOMDocument('1.0', 'UTF-8');

		$dom->preserveWhiteSpace = false;
		$dom->loadXml($request);

		$merchAuthEle = $dom->createElementNS("https://api.authorize.net/soap/v1/", "merchantAuthentication");
		$nameEle = $dom->createElement("name", $this->authnetLogin);
		$transKeyEle = $dom->createElement("transactionKey", $this->authnetTransactionKey);

		$merchAuthEle->appendChild($nameEle);
		$merchAuthEle->appendChild($transKeyEle);

		$node = $dom->getElementsByTagName("Body")->item(0);

		$node->firstChild->appendChild($merchAuthEle);

		$request = $dom->saveXML();

		$namespace = "https://api.authorize.net/soap/v1/";
		$request = preg_replace('/<ns1:(\w+)/', '<$1 xmlns="'.$namespace.'"', $request, 1);
		$request = preg_replace('/<ns1:(\w+)/', '<$1', $request);
		$request = str_replace(array('/ns1:', 'xmlns:ns1="'.$namespace.'"'), array('/', ''), $request);
		$result =  parent::__doRequest($request, $location, $action, $version, $one_way);
		return $result;
	}
}