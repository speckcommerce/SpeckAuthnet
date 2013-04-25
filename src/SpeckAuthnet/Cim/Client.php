<?php
namespace SpeckAuthnet\Cim;

use Zend\ServiceManager\ServiceManagerAwareInterface,
	Zend\ServiceManager\ServiceManager,
	SpeckAuthnet\Api\DefaultResponse;

class Client implements ServiceManagerAwareInterface
{
	/*
	 * @var \Zend\Soap\Client
	 */
	protected $soapClient;

	/**
	 * @var Zend\ServiceManager\ServiceManager
	 */
	protected $sm;

	/**
	 * @var object
	 */
	protected $api;

	/**
	 *
	 * @var string
	 */
	protected $apiNamespace;

	public function setSoapClient(\Zend\Soap\Client $soapClient)
	{
		$this->soapClient = $soapClient;
	}

	public function setServiceManager(ServiceManager $serviceManager)
	{
		$this->sm = $serviceManager;
	}

	public function getSoapClient()
	{
		if(!$this->soapClient instanceof \Zend\Soap\Client) {
			if(!$this->api) {
				throw new \Exception("No API selected");
			}

			$this->soapClient = new \SpeckAuthnet\Soap\Client(array(
				'login' => $this->api->getLogin(),
				'transactionKey' => $this->api->getTranKey(),
				'wsdl' => $this->api->getMode() == 'sandbox' ? \SpeckAuthnet\Soap\Client::WSDL_TEST : \SpeckAuthnet\Soap\Client::WSDL
			));
		}

		return $this->soapClient;
	}

	public function api($apiName)
	{
		if(!$this->sm->has($apiName)) {
			throw new \Exception('API does not exist.');
		}

		$this->api = $this->sm->get($apiName);
		$this->api->setSoapClient($this->getSoapClient());
		$this->api->setServiceManager($this->sm);
		$this->apiNamespace = substr($apiName, 0, strpos($apiName, "\\"));

		return $this;
	}

	public function getApi()
	{
		return $this->api;
	}

	public function getApiNamespace()
	{
		return $this->apiNamespace;
	}

	/**
	 * Proxy to API
	 *
	 * @param  [type] $method [description]
	 * @param  [type] $params [description]
	 * @return [type]		 [description]
	 */
	public function __call($method, $params)
	{
		if(is_null($this->api)) {
			throw new \Exception('No api is set.');
		}

		if(!method_exists($this->api, $method)) {
			throw new \Exception("Invalid method {$method}.");
		}

		return call_user_func_array(array($this->api, $method), $params);
	}

	/**
	 * Utility for unit testing
	 *
	 */
	public function resetApi()
	{
		$this->api		  = null;
		$this->apiNamespace = null;
	}
}