<?php

namespace SpeckAuthnet\Entity\Transaction;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use SpeckAuthnet\Api\Cim\Transaction\Response\Hydrator;
use SpeckAuthnet\Api\Cim\Exception as CimApiException;
use SpeckAuthnet\Api\Cim\Validation\Exception as ValidationException;
use SpeckAuthnet\Api\Cim\Transaction\DeclinedException;

abstract class Base implements \SpeckAuthnet\Entity\Transaction\TransactionInterface, ServiceManagerAwareInterface
{
	protected $_soapClient;

	/**
	 * The amount of the transaction
	 * @var float
	 */
	protected $_amount;

	/**
	 * The Taxes Associated with the Transaction
	 * @var \SpeckAuthnet\Entity\Transaction\Detail\Tax
	 */
	protected $_tax;

	/**
	 * The shipping associated with the transaction
	 * @var \SpeckAuthnet\Entity\Transaction\Detail\Shipping
	 */
	protected $_shipping;

	/**
	 * The duty information associated with the transaction
	 * @var \SpeckAuthnet\Entity\Transaction\Detail\Duty
	 */
	protected $_duty;

	/**
	 * An array of line items for this transaction
	 * @var array
	 */
	protected $_lineItems;

	/**
	 * The customer Profile ID
	 * @var integer
	 */
	protected $_customerProfileId;

	/**
	 * The customer payment profile ID
	 * @var integer
	 */
	protected $_customerPaymentProfileId;

	/**
	 * The customer shipping profile ID
	 * @var integer
	 */
	protected $_customerShippingAddressId;

	/**
	 * The order details
	 * @var \SpeckAuthnet\Entity\Transaction\Detail\Order
	 */
	protected $_order;

	/**
	 * Is this tax exempt?
	 * @var boolean
	 */
	protected $_taxExempt;

	/**
	 * Is this a recurring billing transaction
	 * @var boolean
	 */
	protected $_recurringBilling;

	/**
	 * The CCV security code
	 * @var integer
	 */
	protected $_cardCode;

	/**
	 * The payment gateway-assigned number for the order
	 * @var integer
	 */
	protected $_splitTenderId;

	/**
	 * An array of extra options to pass with the transaction
	 * @var array
	 */
	protected $_extraOptions;

	/**
	 * The service manager
	 * @var \Zend\ServiceManager\ServiceManager
	 */
	protected $_serviceManager;

	/**
	 * Set the srevice manager
	 * @see \Zend\ServiceManager\ServiceManagerAwareInterface::setServiceManager()
	 */
	public function setServiceManager(\Zend\ServiceManager\ServiceManager $serviceManager) {
		$this->_serviceManager = $serviceManager;
	}

	/**
	 * Get the service manager;
	 * @return \Zend\ServiceManager\ServiceManager
	 */
	public function getServiceManager()
	{
		return $this->_serviceManager;
	}

	public function setSoapClient($client)
	{
		$this->_soapClient = $client;
	}

	public function getSoapClient()
	{
		return $this->_soapClient;
	}

	/**
	 * @return the $_amount
	 */
	public function getAmount() {
		return $this->_amount;
	}

	/**
	 * @return the $_tax
	 */
	public function getTax() {
		return $this->_tax;
	}

	/**
	 * @return the $_shipping
	 */
	public function getShipping() {
		return $this->_shipping;
	}

	/**
	 * @return the $_duty
	 */
	public function getDuty() {
		return $this->_duty;
	}

	/**
	 * @return the $_lineItems
	 */
	public function getLineItems() {
		return $this->_lineItems;
	}

	/**
	 * @return the $_customerProfileId
	 */
	public function getCustomerProfileId() {
		return $this->_customerProfileId;
	}

	/**
	 * @return the $_customerPaymentProfileId
	 */
	public function getCustomerPaymentProfileId() {
		return $this->_customerPaymentProfileId;
	}

	/**
	 * @return the $_customerShippingAddressId
	 */
	public function getCustomerShippingAddressId() {
		return $this->_customerShippingAddressId;
	}

	/**
	 * @return the $_order
	 */
	public function getOrder() {
		return $this->_order;
	}

	/**
	 * @return the $_taxExempt
	 */
	public function getTaxExempt() {
		return $this->_taxExempt;
	}

	/**
	 * @return the $_recurringBilling
	 */
	public function getRecurringBilling() {
		return $this->_recurringBilling;
	}

	/**
	 * @return the $_cardCode
	 */
	public function getCardCode() {
		return $this->_cardCode;
	}

	/**
	 * @return the $_splitTenderId
	 */
	public function getSplitTenderId() {
		return $this->_splitTenderId;
	}

	/**
	 * @return the $_extraOptions
	 */
	public function getExtraOptions() {
		return $this->_extraOptions;
	}

	/**
	 *
	 * @param float $_amount
	 * @return \SpeckAuthnet\Entity\Transaction\Base
	 */
	public function setAmount($_amount) {
		$this->_amount = (float)$_amount;
		return $this;
	}

	/**
	 * @param \SpeckAuthnet\Entity\Transaction\Detail\Tax $_tax
	 * @return \SpeckAuthnet\Entity\Transaction\Base
	 */
	public function setTax(\SpeckAuthnet\Entity\Transaction\Detail\Tax $_tax) {
		$this->_tax = $_tax;
		return $this;
	}

	/**
	 * @param \SpeckAuthnet\Entity\Transaction\Detail\Shipping $_shipping
	 * @return \SpeckAuthnet\Entity\Transaction\Base
	 */
	public function setShipping(\SpeckAuthnet\Entity\Transaction\Detail\Shipping $_shipping) {
		$this->_shipping = $_shipping;
		return $this;
	}

	/**
	 * @param \SpeckAuthnet\Entity\Transaction\Detail\Duty $_duty
	 * @return \SpeckAuthnet\Entity\Transaction\Base
	 */
	public function setDuty(\SpeckAuthnet\Entity\Transaction\Detail\Duty $_duty) {
		$this->_duty = $_duty;
		return $this;
	}

	/**
	 * @param array $_lineItems
	 * @return \SpeckAuthnet\Entity\Transaction\Base
	 */
	public function setLineItems(array $_lineItems) {
		$this->_lineItems = $_lineItems;
		return $this;
	}

	/**
	 * @param number $_customerProfileId
	 * @return \SpeckAuthnet\Entity\Transaction\Base
	 */
	public function setCustomerProfileId($_customerProfileId) {
		$this->_customerProfileId = $_customerProfileId;
		return $this;
	}

	/**
	 * @param number $_customerPaymentProfileId
	 * @return \SpeckAuthnet\Entity\Transaction\Base
	 */
	public function setCustomerPaymentProfileId($_customerPaymentProfileId) {
		$this->_customerPaymentProfileId = $_customerPaymentProfileId;
		return $this;
	}

	/**
	 * @param number $_customerShippingAddressId
	 * @return \SpeckAuthnet\Entity\Transaction\Base
	 */
	public function setCustomerShippingAddressId($_customerShippingAddressId) {
		$this->_customerShippingAddressId = $_customerShippingAddressId;
		return $this;
	}

	/**
	 * @param \SpeckAuthnet\Entity\Transaction\Detail\Order $_order
	 * @return \SpeckAuthnet\Entity\Transaction\Base
	 */
	public function setOrder(\SpeckAuthnet\Entity\Transaction\Detail\Order $_order) {
		$this->_order = $_order;
		return $this;
	}

	/**
	 * @param boolean $_taxExempt
	 * @return \SpeckAuthnet\Entity\Transaction\Base
	 */
	public function setTaxExempt($_taxExempt) {
		$this->_taxExempt = (bool)$_taxExempt;
		return $this;
	}

	/**
	 * @param boolean $_recurringBilling
	 * @return \SpeckAuthnet\Entity\Transaction\Base
	 */
	public function setRecurringBilling($_recurringBilling) {
		$this->_recurringBilling = (bool)$_recurringBilling;
		return $this;
	}

	/**
	 * @param number $_cardCode
	 * @return \SpeckAuthnet\Entity\Transaction\Base
	 */
	public function setCardCode($_cardCode) {
		$this->_cardCode = $_cardCode;
		return $this;
	}

	/**
	 * @param number $_splitTenderId
	 * @return \SpeckAuthnet\Entity\Transaction\Base
	 */
	public function setSplitTenderId($_splitTenderId) {
		$this->_splitTenderId = $_splitTenderId;
		return $this;
	}

	/**
	 * @param array $_extraOptions
	 * @return \SpeckAuthnet\Entity\Transaction\Base
	 */
	public function setExtraOptions(array $_extraOptions) {
		$this->_extraOptions = $_extraOptions;
		return $this;
	}

	protected function buildRequest()
	{
		$self = $this;

		$fields = array(
			'amount' => function() use($self) {
				return $self->getAmount();
			},
			'tax' => function() use($self) {
				$tax = $self->getTax();
				if($tax) {
					return $tax->toArray();
				}
			},
			'shipping' => function() use($self) {
				$shipping = $self->getShipping();
				if($shipping) {
					return $shipping->toArray();
				}
			},
			'duty' => function() use ($self) {
				$duty = $self->getDuty();
				if($duty) {
					return $duty->toArray();
				}
			},
			'lineItems' => function() use ($self) {
				$lineItems = $self->getLineItems();

				$retval = null;
				if(is_array($lineItems) && !empty($lineItems)) {
					$retval = array();
					foreach($lineItems as $item) {
						$retval[] = $item->toArray();
					}
				}

				return $retval;
			},
			'customerProfileId' => function() use ($self) {
				return $self->getCustomerProfileId();
			},
			'customerPaymentProfileId' => function() use ($self) {
				return $self->getCustomerPaymentProfileId();
			},
			'customerShippingAddressId' => function() use ($self) {
				return $self->getCustomerShippingAddressId();
			},
			'order' => function() use ($self) {
				$order = $self->getOrder();
				if($order) {
					return $order->toArray();
				}
			},
			'taxExempt' => function() use ($self) {
				return $self->getTaxExempt() ? "true" : "false";
			},
			'recurringBilling'  => function() use ($self) {
				return $self->getRecurringBilling() ? "true" : "false";
			},
			'cardCode' => function() use ($self) {
				return $self->getCardCode();
			},
			'splitTenderId' => function() use ($self) {
				return $self->getSplitTenderId();
			}
		);

		$retval = array();

		foreach($fields as $fieldName => $transform) {
			$result = $transform();

			if(!is_null($result)) {
				$retval[$fieldName] = $result;
			}
		}

		return $retval;
	}

	/**
	 * @see \SpeckAuthnet\Entity\Transaction\TransactionInterface::execute()
	 * @return \SpeckAuthnet\Api\Aim\Response
	 */
	public function execute()
	{
		$client = $this->getSoapClient();

		$data = $this->buildRequest();

		$data = array(
			'transaction' => array(
				$this->_getTransactionKey() => $this->_transformData($data)
			)
		);

		$response = $client->createCustomerProfileTransaction($data);

		if($response->CreateCustomerProfileTransactionResult->resultCode != "Ok") {

			switch($response->CreateCustomerProfileTransactionResult->messages->MessagesTypeMessage->code) {
				case "E00040":
					throw new ValidationException($response->CreateCustomerProfileTransactionResult->messages->MessagesTypeMessage->text);
				case "E00027":
					// Transaction wasn't approved, let things go on as they were and let the upper levels deal with it.
					break;
				default:
					throw new CimApiException("Error: {$response->CreateCustomerProfileTransactionResult->messages->MessagesTypeMessage->text}");
			}

		}

		$hydrator = new Hydrator();

		$result = $hydrator->hydrate($response->CreateCustomerProfileTransactionResult->directResponse);

		return $result;
	}
}