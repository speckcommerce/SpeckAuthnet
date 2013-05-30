<?php

namespace SpeckAuthnet\Entity\Transaction\Detail;

class LineItem
{
	/**
	 * The ID of the item
	 * @var string
	 */
	protected $_itemId;

	/**
	 * The name of the item
	 * @var string
	 */
	protected $_name;

	/**
	 * The description of the item
	 * @var string
	 */
	protected $_description;

	/**
	 * The quantity of the item
	 * @var integer
	 */
	protected $_quantity;

	/**
	 * The unit price of the item
	 * @var float
	 */
	protected $_unitPrice;

	/**
	 * Is this item taxable?
	 * @var boolean
	 */
	protected $_taxable;

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
	 * @return the $_itemId
	 */
	public function getItemId() {
		return $this->_itemId;
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
	 * @return the $_quantity
	 */
	public function getQuantity() {
		return $this->_quantity;
	}

	/**
	 * @return the $_unitPrice
	 */
	public function getUnitPrice() {
		return $this->_unitPrice;
	}

	/**
	 * @return the $_taxable
	 */
	public function getTaxable() {
		return $this->_taxable;
	}

	/**
	 * @param string $_itemId
	 */
	public function setItemId($_itemId) {
		$this->_itemId = $_itemId;
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

	/**
	 * @param number $_quantity
	 */
	public function setQuantity($_quantity) {
		$this->_quantity = $_quantity;
	}

	/**
	 * @param number $_unitPrice
	 */
	public function setUnitPrice($_unitPrice) {
		$this->_unitPrice = $_unitPrice;
	}

	/**
	 * @param boolean $_taxable
	 */
	public function setTaxable($_taxable) {
		$this->_taxable = $_taxable;
	}

}