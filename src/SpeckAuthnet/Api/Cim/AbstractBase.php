<?php

namespace SpeckAuthnet\Api\Cim;

abstract class AbstractBase implements \SpeckAuthnet\Api\RequestInterface, \Zend\ServiceManager\ServiceManagerAwareInterface, \SpeckAuthnet\Api\Cim\ConfigAwareInterface
{
    const LIVE_URL      = 'https://api.authorize.net/soap/v1/Service.asmx';
    const SANDBOX_URL   = 'https://apitest.authorize.net/soap/v1/Service.asmx';

    const MODE_LIVE     = "live";
    const MODE_SANDBOX  = "sandbox";

    /**
     * Login issued by Authnet
     *
     * @var string
     */
    protected $login;

    /**
     * @var Zend\ServiceManager\ServiceManager
     */
    protected $sm;

    /**
     * Transaction key issued by Authnet
     * @var string
     */
    protected $tranKey;

    /**
     * The validation mode to use for CIM
     * @var string
     */
    protected $validationMode;

    /**
     * Current mode.  Possible values are:
     *
     * live
     * sandbox
     *
     * @var string
     */
    protected $_mode;

	/**
	 * @var Zend\Soap\Client
	 */
	protected $soapClient;

	public function setValidationMode($mode)
	{
		$this->validationMode = $mode;
	}

	public function getValidationMode()
	{
		return $this->validationMode;
	}

    public function setMode($mode)
    {
        $this->_mode = $mode;
        return $this;
    }

    public function getMode()
    {
        if(is_null($this->_mode) || 'live' != $this->_mode) {
            $this->_mode = self::MODE_SANDBOX;
        }

        return $this->_mode;
    }

    public function setTranKey($tranKey)
    {
    	$this->tranKey = $tranKey;
    	return $this;
    }

    public function getTranKey()
    {
    	return $this->tranKey;
    }

    public function getLogin()
    {
    	return $this->login;
    }

    public function setLogin($login)
    {
    	$this->login = $login;
    	return $this;
    }

	public function getEndpoint()
	{
		if(self::MODE_LIVE == $this->getMode()) {
			return self::LIVE_URL;
		}

		return self::SANDBOX_URL;
	}

	public function setSoapClient($client)
	{
		$this->soapClient = $client;
	}

	public function getSoapClient()
	{
		return $this->soapClient;
	}

	public function setServiceManager(\Zend\ServiceManager\ServiceManager $serviceManager)
	{
		$this->sm = $serviceManager;
	}
}