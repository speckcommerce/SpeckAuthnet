<?php

namespace SpeckAuthnet\Entity\Customer;

class Address
{
	/**
	 * The first name
	 * @var string
	 */
	protected $firstName;

	/**
	 * The last name
	 * @var string
	 */
	protected $lastName;

	/**
	 * The Company Name
	 * @var string
	 */
	protected $company;

	/**
	 * The Address Line
	 * @var string
	 */
	protected $address;

	/**
	 * The City
	 * @var string
	 */
	protected $city;

	/**
	 * The State
	 * @var string
	 */
	protected $state;

	/**
	 * The Zipcode
	 * @var string
	 */
	protected $zip;

	/**
	 * The Country
	 * @var string
	 */
	protected $country;

	/**
	 * The Phone number (just digits)
	 * @var string
	 */
	protected $phoneNumber;

	/**
	 * The Fax number (just digits)
	 * @var string
	 */
	protected $faxNumber;

	public function setData(array $data) {
		foreach($data as $key => $val) {
			if(isset($this->$key)) {
				$this->$key = $val;
			}
		}
	}

	/**
	 * @return the $firstName
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * @return the $lastName
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * @return the $company
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * @return the $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @return the $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * @return the $state
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * @return the $zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * @return the $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * @return the $phoneNumber
	 */
	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	/**
	 * @return the $faxNumber
	 */
	public function getFaxNumber() {
		return $this->faxNumber;
	}

	/**
	 * @param string $firstName
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
		return $this;
	}

	/**
	 * @param string $lastName
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
		return $this;
	}

	/**
	 * @param string $company
	 */
	public function setCompany($company) {
		$this->company = $company;
		return $this;
	}

	/**
	 * @param string $address
	 */
	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}

	/**
	 * @param string $city
	 */
	public function setCity($city) {
		$this->city = $city;
		return $this;
	}

	/**
	 * @param string $state
	 */
	public function setState($state) {
		$this->state = $state;
		return $this;
	}

	/**
	 * @param string $zip
	 */
	public function setZip($zip) {
		$this->zip = $zip;
		return $this;
	}

	/**
	 * @param string $country
	 */
	public function setCountry($country) {
		$this->country = $country;
		return $this;
	}

	/**
	 * @param string $phoneNumber
	 */
	public function setPhoneNumber($phoneNumber) {
		$this->phoneNumber = $phoneNumber;
		return $this;
	}

	/**
	 * @param string $faxNumber
	 */
	public function setFaxNumber($faxNumber) {
		$this->faxNumber = $faxNumber;
		return $this;
	}

	public function toArray()
	{
		return array(
			'firstName' => $this->getFirstName(),
			'lastName' => $this->getLastName(),
			'company' => $this->getCompany(),
			'address' => $this->getAddress(),
			'city' => $this->getCity(),
			'state' => $this->getState(),
			'zip' => $this->getZip(),
			'country' => $this->getCountry(),
			'phoneNumber' => $this->getPhoneNumber(),
			'faxNumber' => $this->getFaxNumber()
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