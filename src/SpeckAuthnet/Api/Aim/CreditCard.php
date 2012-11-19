<?php

namespace SpeckAuthnet\Api\Aim;

class CreditCard extends AbstractPaymentCard
{
	const AUTH_ONLY 	= "AUTH_ONLY";
	const AUTH_CAPTURE 	= "AUTH_CAPTURE";

	protected $customerIp;

	// ==================================================================
	//
	// Cardholder Authentication Fields
	// The payment gateway supports the transmission of authentication 
	// fields for the following cardholder authentication programs:
	// 
	// - Verified by Visa 
	// - MasterCard® SecureCodeT
	//
	// ------------------------------------------------------------------	
	protected $authenticationIndicator;
	protected $cardholderAuthenticationValue;

	/**
	 * By default AUTH_ONLY is utilized
	 */
	public function __construct()
	{
		$this->type = self::AUTH_ONLY;
	}

	public function setType($type)
	{
		$type = strtoupper($type);
		$allowed = array(self::AUTH_ONLY, self::AUTH_CAPTURE);
		if(!in_array($type, $allowed)) {
			throw new \Exception("Type must be AUTH_CAPTURE or AUTH_ONLY. {$type} passed.");
		}
		$this->type = $type;
		return $this;
	}

	/**
	 * Get the card holder authentication value
	 *
	 * @return string 
	 */
	public function getCardholderAuthenticationValue() 
	{
	    return $this->cardholderAuthenticationValue;
	}
	
	/**
	 * Set the card holder authentication value
	 *
	 * @param String $cardholderAuthenticationValue 
	 */
	public function setCardholderAuthenticationValue($cardholderAuthenticationValue) 
	{
	    $this->cardholderAuthenticationValue = $cardholderAuthenticationValue;
	
	    return $this;
	}

	/**
	 * Get the authentication indicator
	 *
	 * @return string authentication indicator
	 */
	public function getAuthenticationIndicator() 
	{
	    return $this->authenticationIndicator;
	}
	
	/**
	 * Set the authentication indicator
	 *
	 * @param String $authenticationIndicator Authentication indicator
	 */
	public function setAuthenticationIndicator($authenticationIndicator) 
	{
	    $this->authenticationIndicator = $authenticationIndicator;
	
	    return $this;
	}

	/**
	 * Get the IP of the customer
	 *
	 * @return string ip address
	 */
	public function getCustomerIp() 
	{
	    return $this->customerIp;
	}
	
	/**
	 * Set the IP address of the customer
	 *
	 * @param string $customerIp 
	 */
	public function setCustomerIp($customerIp) 
	{
	    $this->customerIp = $customerIp;
	
	    return $this;
	}
}