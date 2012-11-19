<?php
namespace SpeckAuthnet\Api\Aim;

use SpeckAuthnet\Api\Aim\Element\LineItem;

abstract class AbstractPayment extends AbstractAim
{

    /**
     * @var string
     */
    protected $amount;    
	protected $allowPartialAuth;

	// ==================================================================
	//
	// User Information
	//
	// ------------------------------------------------------------------
	
	protected $custId;
	protected $firstName;
	protected $lastName;
	protected $phone;	
	protected $fax;		
	protected $address;
	protected $city;
	protected $state;
	protected $zip;
	protected $country;

	// ==================================================================
	//
	// Order Information
	//
	// ------------------------------------------------------------------	

	protected $invoiceNum;
	protected $description;
	protected $shipToFirstName;
	protected $shipToLastName;
	protected $shipToCompany;	
	protected $shipToEmail;
	protected $shipToPhone;			
	protected $shipToAddress;
	protected $shipToCity;
	protected $shipToState;
	protected $shipToZip;

	// ==================================================================
	//
	// Required if using itemized order information, this information is
	// only displayed in the merchant interface.
	//
	// ------------------------------------------------------------------		
	
	protected $lineItems = array();
	protected $freight;
	protected $tax;
	protected $taxExempt;
	protected $duty;	
	protected $poNum;

	// ==================================================================
	//
	// Email Receipt
	//
	// ------------------------------------------------------------------
	 
	protected $email;
	protected $emailCustomer;
	protected $emailMerchant;
	protected $headerEmailReceipt;
	protected $footerEmailReceipt;

    // ==================================================================
    //
    // Setters
    //
    // ------------------------------------------------------------------

    /**
     * (required) 
     * 
     * Up to 15 digits with a decimal point (no dollar symbol). For example, 8.95
     * 
     * @param $amount
     */
    public function setAmount($amount)
    {
        if(false !== strpos($amount, "$")) {
            $amount = str_replace("$","",$amount);
        }

        $this->amount = $amount;
        return $this;
    }

    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    public function setAllowPartialAuth($allowPartialAuth)
    {
        $this->allowPartialAuth = $allowPartialAuth;

        return $this;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function setCustId($custId)
    {
        $this->custId = $custId;

        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function setDuty($duty)
    {
        $this->duty = $duty;

        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function setEmailCustomer($emailCustomer)
    {
        $this->emailCustomer = $emailCustomer;

        return $this;
    }

    public function setEmailMerchant($emailMerchant)
    {
        $this->emailMerchant = $emailMerchant;

        return $this;
    }

    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function setFooterEmailReceipt($footerEmailReceipt)
    {
        $this->footerEmailReceipt = $footerEmailReceipt;

        return $this;
    }

    public function setFreight($freight)
    {
        $this->freight = $freight;

        return $this;
    }

    public function setHeaderEmailReceipt($headerEmailReceipt)
    {
        $this->headerEmailReceipt = $headerEmailReceipt;

        return $this;
    }

    public function setInvoiceNum($invoiceNum)
    {
        $this->invoiceNum = $invoiceNum;

        return $this;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function setPoNum($poNum)
    {
        $this->poNum = $poNum;

        return $this;
    }

    public function setShipToAddress($shipToAddress)
    {
        $this->shipToAddress = $shipToAddress;

        return $this;
    }

    public function setShipToCity($shipToCity)
    {
        $this->shipToCity = $shipToCity;

        return $this;
    }

    public function setShipToCompany($shipToCompany)
    {
        $this->shipToCompany = $shipToCompany;

        return $this;
    }

    public function setShipToEmail($shipToEmail)
    {
        $this->shipToEmail = $shipToEmail;

        return $this;
    }

    public function setShipToFirstName($shipToFirstName)
    {
        $this->shipToFirstName = $shipToFirstName;

        return $this;
    }

    public function setShipToLastName($shipToLastName)
    {
        $this->shipToLastName = $shipToLastName;

        return $this;
    }

    public function setShipToPhone($shipToPhone)
    {
        $this->shipToPhone = $shipToPhone;

        return $this;
    }

    public function setShipToState($shipToState)
    {
        $this->shipToState = $shipToState;

        return $this;
    }

    public function setShipToZip($shipToZip)
    {
        $this->shipToZip = $shipToZip;

        return $this;
    }

    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    public function setTax($tax)
    {
        $this->tax = $tax;

        return $this;
    }

    public function setTaxExempt($taxExempt)
    {
        $this->taxExempt = $taxExempt;

        return $this;
    }

    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    // ==================================================================
    //
    // Setters
    //
    // ------------------------------------------------------------------


    public function setLineItems(array $items)
    {
    	$this->lineItems = $items;
    	return $this;
    }

    /**
     * Array should include the following keys
     * 
     * string id
     * string name
     * string description
     * string quantity
     * string unit_price
     * string taxable
     *
     * @param array $item
     */
    public function addLineItem(LineItem $item)
    {
        $this->lineItems[] = $item;

        return $this;
    }

    // ==================================================================
    //
    // Getters
    //
    // ------------------------------------------------------------------

    public function getAddress()
    {
        return $this->address;
    }

    public function getAllowPartialAuth()
    {
        return $this->allowPartialAuth;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getCustId()
    {
        return $this->custId;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDuty()
    {
        return $this->duty;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getEmailCustomer()
    {
        return $this->emailCustomer;
    }

    public function getEmailMerchant()
    {
        return $this->emailMerchant;
    }

    public function getFax()
    {
        return $this->fax;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getFooterEmailReceipt()
    {
        return $this->footerEmailReceipt;
    }

    public function getFreight()
    {
        return $this->freight;
    }

    public function getHeaderEmailReceipt()
    {
        return $this->headerEmailReceipt;
    }

    public function getInvoiceNum()
    {
        return $this->invoiceNum;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getLineItems()
    {
        return $this->lineItems;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getPoNum()
    {
        return $this->poNum;
    }

    public function getShipToAddress()
    {
        return $this->shipToAddress;
    }

    public function getShipToCity()
    {
        return $this->shipToCity;
    }

    public function getShipToCompany()
    {
        return $this->shipToCompany;
    }

    public function getShipToEmail()
    {
        return $this->shipToEmail;
    }

    public function getShipToFirstName()
    {
        return $this->shipToFirstName;
    }

    public function getShipToLastName()
    {
        return $this->shipToLastName;
    }

    public function getShipToPhone()
    {
        return $this->shipToPhone;
    }

    public function getShipToState()
    {
        return $this->shipToState;
    }

    public function getShipToZip()
    {
        return $this->shipToZip;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getTax()
    {
        return $this->tax;
    }

    public function getTaxExempt()
    {
        return $this->taxExempt;
    }

    public function getZip()
    {
        return $this->zip;
    }
    
    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }
}