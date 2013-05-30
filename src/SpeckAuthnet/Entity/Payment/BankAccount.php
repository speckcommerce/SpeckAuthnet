<?php

namespace SpeckAuthnet\Entity\Payment;

class BankAccount implements \SpeckAuthnet\Entity\Payment\PaymentInterface
{
	const ACCOUNT_TYPE_CHECKING = 'checking';
	const ACCOUNT_TYPE_SAVINGS = 'savings';
	const ACCOUNT_TYPE_BUSINESS_CHECKING = 'businessChecking';

	const ECHECK_TYPE_CCD = "CCD";
	const ECHECK_TYPE_PPD = "PPD";
	const ECHECK_TYPE_TEL = "TEL";
	const ECHECK_TYPE_WEB = "WEB";

	/**
	 * The Account Type
	 * @var string A BankAccount ACCOUNT_TYPE_* constant
	 */
	protected $accountType;

	/**
	 * The Routing number
	 * @var string
	 */
	protected $routingNumber;

	/**
	 * The account number
	 * @var string
	 */
	protected $accountNumber;

	/**
	 * The name on the account
	 * @var string
	 */
	protected $nameOnAccount;

	/**
	 * The eCheck type
	 * @var string A BankAccount ECHECK_TYPE_* constant
	 */
	protected $echeckType;

	/**
	 * The name of the bank
	 * @var string
	 */
	protected $bankName;

	/**
	 * @return the $accountType
	 */
	public function getAccountType() {
		return $this->accountType;
	}

	/**
	 * @return the $routingNumber
	 */
	public function getRoutingNumber() {
		return $this->routingNumber;
	}

	/**
	 * @return the $accountNumber
	 */
	public function getAccountNumber() {
		return $this->accountNumber;
	}

	/**
	 * @return the $nameOnAccount
	 */
	public function getNameOnAccount() {
		return $this->nameOnAccount;
	}

	/**
	 * @return the $echeckType
	 */
	public function getEcheckType() {
		return $this->echeckType;
	}

	/**
	 * @return the $bankName
	 */
	public function getBankName() {
		return $this->bankName;
	}

	/**
	 * @param string $accountType
	 */
	public function setAccountType($accountType) {
		$this->accountType = $accountType;
		return $this;
	}

	/**
	 * @param string $routingNumber
	 */
	public function setRoutingNumber($routingNumber) {
		$this->routingNumber = $routingNumber;
		return $this;
	}

	/**
	 * @param string $accountNumber
	 */
	public function setAccountNumber($accountNumber) {
		$this->accountNumber = $accountNumber;
		return $this;
	}

	/**
	 * @param string $nameOnAccount
	 */
	public function setNameOnAccount($nameOnAccount) {
		$this->nameOnAccount = $nameOnAccount;
		return $this;
	}

	/**
	 * @param string $echeckType
	 */
	public function setEcheckType($echeckType) {
		$this->echeckType = $echeckType;
		return $this;
	}

	/**
	 * @param string $bankName
	 */
	public function setBankName($bankName) {
		$this->bankName = $bankName;
		return $this;
	}

	public function toArray()
	{
		return array(
			'accountType' => $this->getAccountType(),
			'routingNumber' => $this->getRoutingNumber(),
			'accountNumber' => $this->getAccountNumber(),
			'nameOnAccount' => $this->getNameOnAccount(),
			'echeckType' => $this->getEcheckType(),
			'bankName' => $this->getBankName()
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