<?php

namespace SpeckAuthnet\Api\Aim;

class Void extends AbstractAim
{
	const VOID = "VOID";

	protected $transId;

	public function __construct()
	{
		$this->type = self::VOID;
	}


	/**
	 * Get the transaction id 
	 *
	 * @return string transaction id
	 */
	public function getTransId() 
	{
	    return $this->transId;
	}
	
	/**
	 * Set the transaction id of the payment to void
	 *
	 * @param String $transId Transaction id
	 */
	public function setTransId($transId) 
	{
	    $this->transId = $transId;
	
	    return $this;
	}

	public function setTransactionId($id)
	{
		$this->setTransId($id);
		return $this;
	}

	public function getTransactionId()
	{
		return $this->getTransId();
	}
}