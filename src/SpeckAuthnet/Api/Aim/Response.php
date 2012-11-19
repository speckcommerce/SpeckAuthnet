<?php
namespace SpeckAuthnet\Api\Aim;

use SpeckAuthnet\Api\AbstractResponse;

class Response extends AbstractResponse
{
    protected $approved;
    protected $declined;
    protected $error;
    protected $held;
    protected $responseCode;
    protected $responseSubcode;
    protected $responseReasonCode;
    protected $responseReasonText;
    protected $authorizationCode;
    protected $avsResponse;
    protected $transactionId;
    protected $invoiceNumber;
    protected $description;
    protected $amount;
    protected $method;
    protected $transactionType;
    protected $customerId;
    protected $firstName;
    protected $lastName;
    protected $company;
    protected $address;
    protected $city;
    protected $state;
    protected $zipCode;
    protected $country;
    protected $phone;
    protected $fax;
    protected $emailAddress;
    protected $shipToFirstName;
    protected $shipToLastName;
    protected $shipToCompany;
    protected $shipToAddress;
    protected $shipToCity;
    protected $shipToState;
    protected $shipToZipCode;
    protected $shipToCountry;
    protected $tax;
    protected $duty;
    protected $freight;
    protected $taxExempt;
    protected $purchaseOrderNumber;
    protected $md5Hash;
    protected $cardCodeResponse;
    protected $cavvResponse; // cardholder_authentication_verification_response
    protected $accountNumber;
    protected $cardType;
    protected $splitTenderId;
    protected $requestedAmount;
    protected $balanceOnCard;
    protected $customFields = array();


    /**
     * get the error state
     *
     * @return boolean 
     */
    public function getError() 
    {
        return $this->error;
    }
    
    /**
     * Set the error response field
     *
     * @param Boolean $error 
     */
    public function setError($error) 
    {
        $this->error = $error;
    
        return $this;
    }

    public function isSuccess()
    {
        return !$this->error;
    }

    public function addCustomField($key, $value)
    {
        $this->customFields[$key] = $value;

        return $this;
    }

    public function getCustomFields()
    {
        return $this->customFields;
    }

    public function getCustomField($key)
    {
        $value = null;
        if(isset($this->customFields[$key])) {
            $value = $this->customFields[$key];
        }

        return $value;
    }

    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setApproved($approved)
    {
        $this->approved = $approved;
    }

    public function getApproved()
    {
        return $this->approved;
    }

    public function isApproved()
    {
        return (bool) $this->approved;
    }

    public function setAuthorizationCode($authorizationCode)
    {
        $this->authorizationCode = $authorizationCode;
    }

    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    public function setAvsResponse($avsResponse)
    {
        $this->avsResponse = $avsResponse;
    }

    public function getAvsResponse()
    {
        return $this->avsResponse;
    }

    public function setBalanceOnCard($balanceOnCard)
    {
        $this->balanceOnCard = $balanceOnCard;
    }

    public function getBalanceOnCard()
    {
        return $this->balanceOnCard;
    }

    public function setCardCodeResponse($cardCodeResponse)
    {
        $this->cardCodeResponse = $cardCodeResponse;
    }

    public function getCardCodeResponse()
    {
        return $this->cardCodeResponse;
    }

    public function setCardType($cardType)
    {
        $this->cardType = $cardType;
    }

    public function getCardType()
    {
        return $this->cardType;
    }

    public function setCavvResponse($cavvResponse)
    {
        $this->cavvResponse = $cavvResponse;
    }

    public function getCavvResponse()
    {
        return $this->cavvResponse;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCompany($company)
    {
        $this->company = $company;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function setDeclined($declined)
    {
        $this->declined = $declined;
    }

    public function getDeclined()
    {
        return $this->declined;
    }

    public function isDeclined()
    {
        return (bool) $this->declined;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDuty($duty)
    {
        $this->duty = $duty;
    }

    public function getDuty()
    {
        return $this->duty;
    }

    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    public function getFax()
    {
        return $this->fax;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFreight($freight)
    {
        $this->freight = $freight;
    }

    public function getFreight()
    {
        return $this->freight;
    }

    public function setHeld($held)
    {
        $this->held = $held;
    }

    public function getHeld()
    {
        return $this->held;
    }

    public function isHeld()
    {
        return (bool) $this->held;
    }

    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setMd5Hash($md5Hash)
    {
        $this->md5Hash = $md5Hash;
    }

    public function getMd5Hash()
    {
        return $this->md5Hash;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPurchaseOrderNumber($purchaseOrderNumber)
    {
        $this->purchaseOrderNumber = $purchaseOrderNumber;
    }

    public function getPurchaseOrderNumber()
    {
        return $this->purchaseOrderNumber;
    }

    public function setRequestedAmount($requestedAmount)
    {
        $this->requestedAmount = $requestedAmount;
    }

    public function getRequestedAmount()
    {
        return $this->requestedAmount;
    }

    public function setResponseCode($responseCode)
    {
        $this->responseCode = $responseCode;
    }

    public function getResponseCode()
    {
        return $this->responseCode;
    }

    public function setResponseReasonCode($responseReasonCode)
    {
        $this->responseReasonCode = $responseReasonCode;
    }

    public function getResponseReasonCode()
    {
        return $this->responseReasonCode;
    }

    public function setResponseReasonText($responseReasonText)
    {
        $this->responseReasonText = $responseReasonText;
    }

    public function getResponseReasonText()
    {
        return $this->responseReasonText;
    }

    public function setResponseSubcode($responseSubcode)
    {
        $this->responseSubcode = $responseSubcode;
    }

    public function getResponseSubcode()
    {
        return $this->responseSubcode;
    }

    public function setShipToAddress($shipToAddress)
    {
        $this->shipToAddress = $shipToAddress;
    }

    public function getShipToAddress()
    {
        return $this->shipToAddress;
    }

    public function setShipToCity($shipToCity)
    {
        $this->shipToCity = $shipToCity;
    }

    public function getShipToCity()
    {
        return $this->shipToCity;
    }

    public function setShipToCompany($shipToCompany)
    {
        $this->shipToCompany = $shipToCompany;
    }

    public function getShipToCompany()
    {
        return $this->shipToCompany;
    }

    public function setShipToCountry($shipToCountry)
    {
        $this->shipToCountry = $shipToCountry;
    }

    public function getShipToCountry()
    {
        return $this->shipToCountry;
    }

    public function setShipToFirstName($shipToFirstName)
    {
        $this->shipToFirstName = $shipToFirstName;
    }

    public function getShipToFirstName()
    {
        return $this->shipToFirstName;
    }

    public function setShipToLastName($shipToLastName)
    {
        $this->shipToLastName = $shipToLastName;
    }

    public function getShipToLastName()
    {
        return $this->shipToLastName;
    }

    public function setShipToState($shipToState)
    {
        $this->shipToState = $shipToState;
    }

    public function getShipToState()
    {
        return $this->shipToState;
    }

    public function setShipToZipCode($shipToZipCode)
    {
        $this->shipToZipCode = $shipToZipCode;
    }

    public function getShipToZipCode()
    {
        return $this->shipToZipCode;
    }

    public function setSplitTenderId($splitTenderId)
    {
        $this->splitTenderId = $splitTenderId;
    }

    public function getSplitTenderId()
    {
        return $this->splitTenderId;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setTax($tax)
    {
        $this->tax = $tax;
    }

    public function getTax()
    {
        return $this->tax;
    }

    public function setTaxExempt($taxExempt)
    {
        $this->taxExempt = $taxExempt;
    }

    public function getTaxExempt()
    {
        return $this->taxExempt;
    }

    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    public function setTransactionType($transactionType)
    {
        $this->transactionType = $transactionType;
    }

    public function getTransactionType()
    {
        return $this->transactionType;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    } // The response string from AuthorizeNet.
}
