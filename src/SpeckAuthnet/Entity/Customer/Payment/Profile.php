<?php

namespace SpeckAuthnet\Entity\Customer\Payment;

use SpeckAuthnet\Entity\Payment\BankAccount;
use SpeckAuthnet\Entity\Payment\CreditCard;
use SpeckAuthnet\Entity\Customer\Address;
use SpeckAuthnet\Cim\Exception as CimException;

class Profile
{
	const CUSTOMER_TYPE_INDIVIDUAL = "individual";
	const CUSTOMER_TYPE_BUSINESS = "business";

	/**
	 * The Type of customer
	 * @var string
	 */
	protected $customerType;

	/**
	 * The billing address details
	 * @var \SpeckAuthnet\Entity\Customer\Address
	 */
	protected $billTo;

	/**
	 * The Payment Details
	 * @var \SpeckAuthnet\Entity\Payment\PaymentInterface
	 */
	protected $payment;

	/**
	 * The Payment profile ID
	 * @var unknown_type
	 */
	protected $customerPaymentProfileId;

	/**
	 * Get the payment profile ID
	 * @return int
	 */
	public function getPaymentProfileId()
	{
		return $this->customerPaymentProfileId;
	}

	/**
	 * Set the payment profile ID
	 * @param int $id
	 */
	public function setPaymentProfileId($id)
	{
		$this->customerPaymentProfileId = $id;
		return $this;
	}

	/**
	 * @return the $customerType
	 */
	public function getCustomerType() {
		return $this->customerType;
	}

	/**
	 * @return \SpeckAuthnet\Entity\Customer\Address the address
	 */
	public function getBillTo() {
		return $this->billTo;
	}

	/**
	 * @return \SpeckAuthnet\Entity\Payment\PaymentInterface the $payment
	 */
	public function getPayment() {
		return $this->payment;
	}

	/**
	 * @param string $customerType
	 */
	public function setCustomerType($customerType) {
		$this->customerType = $customerType;
		return $this;
	}

	/**
	 * @param \SpeckAuthnet\Entity\Customer\Address $billTo
	 */
	public function setBillTo(\SpeckAuthnet\Entity\Customer\Address $billTo) {
		$this->billTo = $billTo;
		return $this;
	}

	/**
	 * @param \SpeckAuthnet\Entity\Payment\PaymentInterface $payment
	 */
	public function setPayment(\SpeckAuthnet\Entity\Payment\PaymentInterface $payment) {
		$this->payment = $payment;
		return $this;
	}

	public function toArray()
	{
		$retval = array(
			'customerType' => $this->getCustomerType(),
			'billTo' => $this->getBillTo()->toArray(),
		);

		$payment = $this->getPayment();

		$retval['payment'] = array();

		switch(true) {
			case $payment instanceof \SpeckAuthnet\Entity\Payment\CreditCard:
				$retval['payment']['creditCard'] = $payment->toArray();
				break;
			case $payment instanceof \SpeckAuthnet\Entity\Payment\BankAccount:
				$retval['payment']['bankAccount'] = $payment->toArray();
				break;
			default:
				throw new \Exception("Unknown Payment class type");
		}

		return $retval;
	}

	public function setFromArray(array $data) {
		foreach($data as $key => $val) {
			if(property_exists($this, $key)) {
				switch($key) {
					case 'billTo':
						$this->billTo = new Address();
						$this->billTo->setFromArray($val);
						break;
					case 'payment':
						if(isset($val['creditCard'])) {
							$this->payment = new CreditCard();
							$this->payment->setFromArray((array)$val['creditCard']);
						} elseif(isset($val['bankAccount'])) {
							$this->payment = new BankAccount();
							$this->payment->setFromArray((array)$val['bankAccount']);
						} else {
							throw new CimException("Unknown Payment type");
						}
						break;
					default:
						$this->$key = $val;
						break;
				}
			}
		}

		return $this;
	}
}