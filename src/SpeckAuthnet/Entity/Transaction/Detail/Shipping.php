<?php

namespace SpeckAuthnet\Entity\Transaction\Detail;

class Shipping
{
	/**
	 * The amount associated with shipping
	 * @var float
	 */
	protected $_amount;

	/**
	 * The name of the shipping item
	 * @var string
	 */
	protected $_name;

	/**
	 * The description of the shipping Item
	 * @var string
	 */
	protected $_description;

	/**
	 * Return an array of this object's properties
	 * @return array
	 */
	public function toArray()
	{
		$vars = get_object_vars($this);

		$retval = array();
		foreach($vars as $key => $val) {
			$retval[str_replace("_", "", $key)] = $val;
		}

		return $retval;
	}

	/**
	 * @return the $_amount
	 */
	public function getAmount() {
		return $this->_amount;
	}

	/**
	 * @return the $_name
	 */
	public function getName() {
		return $this->_name;
	}

	/**
	 * @return the $_description
	 */
	public function getDescription() {
		return $this->_description;
	}

	/**
	 * @param number $_amount
	 */
	public function setAmount($_amount) {
		$this->_amount = $_amount;
	}

	/**
	 * @param string $_name
	 */
	public function setName($_name) {
		$this->_name = $_name;
	}

	/**
	 * @param string $_description
	 */
	public function setDescription($_description) {
		$this->_description = $_description;
	}

}