<?php

namespace SpeckAuthnet\Api\Cim\Transaction;

class AbstractTransaction extends \SpeckAuthnet\Api\Cim\AbstractBase
{
	/**
	 * @var SpeckAuthnet\Api\Cim\Customer\Payment\Profile
	 */
	protected $_paymentProfile;

	/**
	 * @return SpeckAuthnet\Api\Cim\Customer\Payment\Profile the $_paymentProfile
	 */
	public function getPaymentProfile() {
		return $this->_paymentProfile;
	}

	/**
	 * @param \SpeckAuthnet\Api\Cim\Customer\Payment\Profile $_paymentProfile
	 */
	public function setPaymentProfile(SpeckAuthnet\Api\Cim\Customer\Payment\Profile $_paymentProfile) {
		$this->_paymentProfile = $_paymentProfile;
	}

}