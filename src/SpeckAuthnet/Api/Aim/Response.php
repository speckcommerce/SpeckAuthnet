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
        return $this;
    }

    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setApproved($approved)
    {
        $this->approved = $approved;
        return $this;
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
        return $this;
    }

    public function getAuthorizationCode()
    {
        return $this->authorizationCode;
    }

    public function setAvsResponse($avsResponse)
    {
        $this->avsResponse = $avsResponse;
        return $this;
    }

    public function getAvsResponse()
    {
        return $this->avsResponse;
    }

    public function setBalanceOnCard($balanceOnCard)
    {
        $this->balanceOnCard = $balanceOnCard;
        return $this;
    }

    public function getBalanceOnCard()
    {
        return $this->balanceOnCard;
    }

    public function setCardCodeResponse($cardCodeResponse)
    {
        $this->cardCodeResponse = $cardCodeResponse;
        return $this;
    }

    public function getCardCodeResponse()
    {
        return $this->cardCodeResponse;
    }

    public function setCardType($cardType)
    {
        $this->cardType = $cardType;
        return $this;
    }

    public function getCardType()
    {
        return $this->cardType;
    }

    public function setCavvResponse($cavvResponse)
    {
        $this->cavvResponse = $cavvResponse;
        return $this;
    }

    public function getCavvResponse()
    {
        return $this->cavvResponse;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCompany($company)
    {
        $this->company = $company;
        return $this;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
        return $this;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function setDeclined($declined)
    {
        $this->declined = $declined;
        return $this;
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
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDuty($duty)
    {
        $this->duty = $duty;
        return $this;
    }

    public function getDuty()
    {
        return $this->duty;
    }

    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    public function setFax($fax)
    {
        $this->fax = $fax;
        return $this;
    }

    public function getFax()
    {
        return $this->fax;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFreight($freight)
    {
        $this->freight = $freight;
        return $this;
    }

    public function getFreight()
    {
        return $this->freight;
    }

    public function setHeld($held)
    {
        $this->held = $held;
        return $this;
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
        return $this;
    }

    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setMd5Hash($md5Hash)
    {
        $this->md5Hash = $md5Hash;
        return $this;
    }

    public function getMd5Hash()
    {
        return $this->md5Hash;
    }

    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPurchaseOrderNumber($purchaseOrderNumber)
    {
        $this->purchaseOrderNumber = $purchaseOrderNumber;
        return $this;
    }

    public function getPurchaseOrderNumber()
    {
        return $this->purchaseOrderNumber;
    }

    public function setRequestedAmount($requestedAmount)
    {
        $this->requestedAmount = $requestedAmount;
        return $this;
    }

    public function getRequestedAmount()
    {
        return $this->requestedAmount;
    }

    public function setResponseCode($responseCode)
    {
        $this->responseCode = $responseCode;
        return $this;
    }

    public function getResponseCode()
    {
        return $this->responseCode;
    }

    public function setResponseReasonCode($responseReasonCode)
    {
        $this->responseReasonCode = $responseReasonCode;
        return $this;
    }

    public function getResponseReasonCode()
    {
        return $this->responseReasonCode;
    }

    public function setResponseReasonText($responseReasonText)
    {
        $this->responseReasonText = $responseReasonText;
        return $this;
    }

    public function getResponseReasonText()
    {
        return $this->responseReasonText;
    }

    public function setResponseSubcode($responseSubcode)
    {
        $this->responseSubcode = $responseSubcode;
        return $this;
    }

    public function getResponseSubcode()
    {
        return $this->responseSubcode;
    }

    public function setShipToAddress($shipToAddress)
    {
        $this->shipToAddress = $shipToAddress;
        return $this;
    }

    public function getShipToAddress()
    {
        return $this->shipToAddress;
    }

    public function setShipToCity($shipToCity)
    {
        $this->shipToCity = $shipToCity;
        return $this;
    }

    public function getShipToCity()
    {
        return $this->shipToCity;
    }

    public function setShipToCompany($shipToCompany)
    {
        $this->shipToCompany = $shipToCompany;
        return $this;
    }

    public function getShipToCompany()
    {
        return $this->shipToCompany;
    }

    public function setShipToCountry($shipToCountry)
    {
        $this->shipToCountry = $shipToCountry;
        return $this;
    }

    public function getShipToCountry()
    {
        return $this->shipToCountry;
    }

    public function setShipToFirstName($shipToFirstName)
    {
        $this->shipToFirstName = $shipToFirstName;
        return $this;
    }

    public function getShipToFirstName()
    {
        return $this->shipToFirstName;
    }

    public function setShipToLastName($shipToLastName)
    {
        $this->shipToLastName = $shipToLastName;
        return $this;
    }

    public function getShipToLastName()
    {
        return $this->shipToLastName;
    }

    public function setShipToState($shipToState)
    {
        $this->shipToState = $shipToState;
        return $this;
    }

    public function getShipToState()
    {
        return $this->shipToState;
    }

    public function setShipToZipCode($shipToZipCode)
    {
        $this->shipToZipCode = $shipToZipCode;
        return $this;
    }

    public function getShipToZipCode()
    {
        return $this->shipToZipCode;
    }

    public function setSplitTenderId($splitTenderId)
    {
        $this->splitTenderId = $splitTenderId;
        return $this;
    }

    public function getSplitTenderId()
    {
        return $this->splitTenderId;
    }

    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setTax($tax)
    {
        $this->tax = $tax;
        return $this;
    }

    public function getTax()
    {
        return $this->tax;
    }

    public function setTaxExempt($taxExempt)
    {
        $this->taxExempt = $taxExempt;
        return $this;
    }

    public function getTaxExempt()
    {
        return $this->taxExempt;
    }

    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
        return $this;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    public function setTransactionType($transactionType)
    {
        $this->transactionType = $transactionType;
        return $this;
    }

    public function getTransactionType()
    {
        return $this->transactionType;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    } // The response string from AuthorizeNet.
}
