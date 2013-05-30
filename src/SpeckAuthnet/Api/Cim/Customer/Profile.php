<?php

namespace SpeckAuthnet\Api\Cim\Customer;

use SpeckAuthnet\Api\Cim\Exception as CimApiException;
use SpeckAuthnet\Api\Cim\Validation\Exception as ValidationException;

class Profile extends \SpeckAuthnet\Api\Cim\AbstractBase
{
	protected $merchantCustomerId;
	protected $description;
	protected $email;
	protected $customerProfileId;

	public function save()
	{
		$client = $this->getSoapClient();

		if(empty($this->customerProfileId)) {
			$response = $client->createCustomerProfile(array(
				'profile' => array(
					'email' => $this->getEmail(),
					'description' => $this->getDescription(),
					'merchantCustomerId' => $this->getMerchantCustomerId()
				),
				'validationMode' => 'none'
			));

			if($response->CreateCustomerProfileResult->resultCode != "Ok") {
				if($response->CreateCustomerPaymentProfileResult->messages->MessagesTypeMessage->code == "E00013") {
					throw new ValidationException($response->CreateCustomerPaymentProfileResult->messages->MessagesTypeMessage->text);
				}
				throw new CimApiException("Failed to create customer profile: {$response->CreateCustomerProfileResult->messages->MessagesTypeMessage->text}");
			}

			$this->setCustomerProfileId($response->CreateCustomerProfileResult->customerProfileId);

		} else {
			$response = $client->updateCustomerProfile(array(
				'profile' => array(
					'merchantCustomerId' => $this->getMerchantCustomerId(),
					'description' => $this->getDescription(),
					'email' => $this->getEmail(),
					'customerProfileId' => $this->getCustomerProfileId()
				)
			));

			if($response->UpdateCustomerProfileResult->resultCode != "Ok") {
				if($response->CreateCustomerPaymentProfileResult->messages->MessagesTypeMessage->code == "E00013") {
					throw new ValidationException($response->CreateCustomerPaymentProfileResult->messages->MessagesTypeMessage->text);
				}
				throw new CimApiException("Failed to update customer profile: {$response->UpdateCustomerProfileResult->messages->MessagesTypeMessage->text}");
			}
		}

		return $this;
	}

	public function getCustomerProfileId() {
		return $this->customerProfileId;
	}

	public function setCustomerProfileId($id) {
		$this->customerProfileId = $id;
		return $this;
	}

	public function setMerchantCustomerId($id)
	{
		$this->merchantCustomerId = $id;
		return $this;
	}

	public function getMerchantCustomerId()
	{
		return $this->merchantCustomerId;
	}

	public function setDescription($desc) {
		$this->description = $desc;
		return $this;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}

	public function getEmail() {
		return $this->email;
	}


}