<?php

namespace SpeckAuthnet\Entity\Payment;

class CreditCard implements \SpeckAuthnet\Entity\Payment\PaymentInterface
{
	/**
	 * The Credit Card Number
	 * @var string
	 */
	protected $cardNumber;

	/**
	 * The expiration date in YYYY-MM format
	 * @var string
	 */
	protected $expirationDate;

	/**
	 * The CCV code
	 * @var integer
	 */
	protected $cardCode;

	/**
	 * @return the $cardNumber
	 */
	public function getCardNumber() {
		return $this->cardNumber;
	}

	/**
	 * @return the $expirationDate
	 */
	public function getExpirationDate() {
		return $this->expirationDate;
	}

	/**
	 * @return the $cardCode
	 */
	public function getCardCode() {
		return $this->cardCode;
	}

	/**
	 * @param string $cardNumber
	 */
	public function setCardNumber($cardNumber) {
		$this->cardNumber = $cardNumber;
		return $this;
	}

	/**
	 * @param string $expirationDate
	 */
	public function setExpirationDate($expirationDate) {
		$this->expirationDate = $expirationDate;
		return $this;
	}

	/**
	 * @param number $cardCode
	 */
	public function setCardCode($cardCode) {
		$this->cardCode = $cardCode;
		return $this;
	}

	public function toArray()
	{
		return array(
			'cardNumber' => $this->getCardNumber(),
			'expirationDate' => $this->getExpirationDate(),
			'cardCode' => $this->getCardCode()
		);
	}

	public function setFromArray(array $data) {
		foreach($data as $key => $val) {
			if(property_exists($this, $key)) {
				$this->$key = $val;
			}
		}

		return $this;
	}
}