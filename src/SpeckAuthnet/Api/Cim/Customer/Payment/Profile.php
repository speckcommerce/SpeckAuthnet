<?php

namespace SpeckAuthnet\Api\Cim\Customer\Payment;

use SpeckAuthnet\Entity\Customer\Address;

use SpeckAuthnet\Api\Cim\Exception as CimApiException;
use SpeckAuthnet\Api\Cim\Validation\Exception as ValidationException;
use SpeckAuthnet\Entity\Customer\Payment\Profile as ProfileEntity;

class Profile extends \SpeckAuthnet\Api\Cim\AbstractBase
{
	/**
	 * The customer Profile ID
	 * @var integer
	 */
	protected $customerProfileId;

	/**
	 * The Payment Profile
	 * @var \SpeckAuthnet\Entity\Customer\Payment\Profile
	 */
	protected $paymentProfile;

	/**
	 * The Validation Mode
	 * @var string
	 */
	protected $validationMode;

	public function load($customerProfileId = null, $paymentProfileId = null)
	{
		$client = $this->getSoapClient();

		if(empty($this->customerProfileId) && is_null($customerProfileId)) {
			throw new CimApiException("You must provide a customer profile ID to use this API call");
		}

		if((empty($this->paymentProfile) || ($this->getCustomerPaymentProfile()->getPaymentProfileId() == "")) && is_null($paymentProfileId)) {
			throw new CimApiException("You must provide a customer payment profile ID to use this API call");
		}

		$response = $client->getCustomerPaymentProfile(array(
			'customerProfileId' => is_null($customerProfileId) ? $this->getCustomerProfileId() : $customerProfileId,
			'customerPaymentProfileId' => is_null($paymentProfileId) ? $this->getCustomerPaymentProfile()->getPaymentProfileId() : $paymentProfileId
		));

		if($response->GetCustomerPaymentProfileResult->resultCode != "Ok") {
			throw new CimApiException("Failed to retrieve customer payment profile: {$response->GetCustomerPaymentProfileResult->messages->MessagesTypeMessage->text}");
		}

		$paymentProfile = (array)$response->GetCustomerPaymentProfileResult->paymentProfile;
		$paymentProfile['billTo'] = (array)$paymentProfile['billTo'];
		$paymentProfile['payment'] = (array)$paymentProfile['payment'];

		$retval = new ProfileEntity();
		$retval->setFromArray($paymentProfile);

		return $retval;
	}

	public function save()
	{
		$client = $this->getSoapClient();

		if(empty($this->customerProfileId)) {
			throw new CimApiException("You must provide a customer profile ID to use this API call");
		}

		$payment = $this->getCustomerPaymentProfile();

		if(!$payment || !$payment instanceof \SpeckAuthnet\Entity\Customer\Payment\Profile) {
			throw new \InvalidArgumentException("You must provide a Payment Profile");
		}

		$request = array(
			'validationMode' => 'none',
			'customerProfileId' => $this->getCustomerProfileId(),
			'paymentProfile' => $payment->toArray()
		);

		if(!$payment->getPaymentProfileId()) {

			unset($request['paymentProfile']['paymentProfileId']);

			$response = $client->createCustomerPaymentProfile($request);

			if($response->CreateCustomerPaymentProfileResult->resultCode != "Ok") {

				if($response->CreateCustomerPaymentProfileResult->messages->MessagesTypeMessage->code == "E00013") {
					throw new ValidationException($response->CreateCustomerPaymentProfileResult->messages->MessagesTypeMessage->text);
				}

				throw new CimApiException("Failed to create customer payment profile: {$response->CreateCustomerPaymentProfileResult->messages->MessagesTypeMessage->text}");
			}

			$payment->setPaymentProfileId($response->CreateCustomerPaymentProfileResult->customerPaymentProfileId);

		} else {
			$response = $client->updateCustomerProfile($request);

			if($response->UpdateCustomerPaymentProfileResult->resultCode != "Ok") {
				throw new CimApiException("Failed to update customer payment profile: {$response->UpdateCustomerPaymentProfileResult->messages->MessagesTypeMessage->text}");
			}
		}

		return $this;
	}

	public function getCustomerProfileId() {
		return $this->customerProfileId;
	}

	public function setCustomerProfileId($id) {
		$this->customerProfileId = $id;
	}

	public function setCustomerPaymentProfile(\SpeckAuthnet\Entity\Customer\Payment\Profile $profile) {
		$this->paymentProfile = $profile;
	}

	/**
	 * Return the Payment Profile
	 * @return \SpeckAuthnet\Entity\Customer\Payment\Profile
	 */
	public function getCustomerPaymentProfile()
	{
		return $this->paymentProfile;
	}

}