<?php

namespace SpeckAuthnet\Entity\Transaction\Detail;

class Order
{
	/**
	 * The invoice number for this transaction
	 * @var string
	 */
	protected $_invoiceNumber;

	/**
	 * The description of the order
	 * @var string
	 */
	protected $_description;

	/**
	 * The purchase Order number
	 * @var string
	 */
	protected $_purchaseOrderNumber;

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
	 * @return the $_invoiceNumber
	 */
	public function getInvoiceNumber() {
		return $this->_invoiceNumber;
	}

	/**
	 * @return the $_description
	 */
	public function getDescription() {
		return $this->_description;
	}

	/**
	 * @return the $_purchaseOrderNumber
	 */
	public function getPurchaseOrderNumber() {
		return $this->_purchaseOrderNumber;
	}

	/**
	 * @param string $_invoiceNumber
	 */
	public function setInvoiceNumber($_invoiceNumber) {
		$this->_invoiceNumber = $_invoiceNumber;
	}

	/**
	 * @param string $_description
	 */
	public function setDescription($_description) {
		$this->_description = $_description;
	}

	/**
	 * @param string $_purchaseOrderNumber
	 */
	public function setPurchaseOrderNumber($_purchaseOrderNumber) {
		$this->_purchaseOrderNumber = $_purchaseOrderNumber;
	}

}