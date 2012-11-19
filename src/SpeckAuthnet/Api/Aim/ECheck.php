<?php

namespace SpeckAuthnet\Api\Aim;

class ECheck extends AbstractPayment
{

    protected $method = 'ECHECK';
    protected $bankAbaCode;
    protected $bankAcctNum;
    protected $bankAcctType;
    protected $bankName;
    protected $bankAcctName;
    protected $bankCheckNumber;
    protected $recurringBilling = 'NO';
    protected $relayResponse = 'FALSE';
    protected $eCheckType = 'WEB';



    /**
     * Get the recurring billing value
     *
     * @return string
     */
    public function getRecurringBilling() 
    {
        return $this->recurringBilling;
    }
    
    /**
     * Set the recurring billing value
     *
     * Indicates whether the transaction is a recurring billing transaction.
     * Format:TRUE, FALSE, T, F, YES, NO, Y, N, 1, 0
     *
     * @param String $recurringBilling 
     */
    public function setRecurringBilling($recurringBilling) 
    {
        $recurringBilling = strtoupper($recurringBilling);
        $allowed = array('TRUE', 'FALSE', 'T', 'F', 'YES', 'NO', '1', '0');
        if(!in_array($recurringBilling, $allowed)) {
            throw new \Exception('Invalid Recurring Billing value.  Value must be one of '. join(',', $allowed));
        }

        $this->recurringBilling = $recurringBilling;
    
        return $this;
    }

    /**
     * get the relay response value
     *
     * @return string 
     */
    public function getRelayResponse() 
    {
        return $this->relayResponse;
    }
    
    /**
     * read-only
     *
     * Relay response is only used for SIM transactions. Set this value to 
     * false when using AIM.
     *
     * @param String $relayResponse 
     */
    public function setRelayResponse($relayResponse) 
    {   
        return $this;
    }

    /**
     * Get the current method
     *
     * @return string current method
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     * read-only
     * 
     * @param ECheck $method
     */
    public function setMethod($method)
    {
        return $this;
    }

    /**
     * get the current bank aba code
     *
     * @return string bank aba code
     */
    public function getBankAbaCode() 
    {
        return $this->bankAbaCode;
    }
    
    /**
     * Set the bank aba code
     *
     * @param String $bankAbaCode  bank aba code
     */
    public function setBankAbaCode($bankAbaCode) 
    {
        $this->bankAbaCode = $bankAbaCode;
    
        return $this;
    }


    /**
     * Get the bank aba number
     *
     * @return string bank aba number
     */
    public function getBankAbaNum() 
    {
        return $this->bankAbaNum;
    }
    
    /**
     * Set the bank aba number
     *
     * @param String $bankAbaNum Bank aba number
     */
    public function setBankAbaNum($bankAbaNum) 
    {
        $this->bankAbaNum = $bankAbaNum;
    
        return $this;
    }


    /**
     * Get the bank account type
     *
     * @return string bank account type
     */
    public function getBankAcctType() 
    {
        return $this->bankAcctType;
    }
    
    /**
     * Set the bank account type
     *
     * @param String $bankAcctType Bank account type
     */
    public function setBankAcctType($bankAcctType) 
    {
        $this->bankAcctType = strtoupper($bankAcctType);
    
        return $this;
    }


    /**
     * Get the bank name 
     *
     * @return string bank name
     */
    public function getBankName() 
    {
        return $this->bankName;
    }
    
    /**
     * Set the bank name
     *
     * @param String $bankName Bank name
     */
    public function setBankName($bankName) 
    {
        $this->bankName = $bankName;
    
        return $this;
    }


    /**
     * Get the bank account name
     *
     * @return string bank account name
     */
    public function getBankAcctName() 
    {
        return $this->bankAcctName;
    }
    
    /**
     * Set the bank account name
     *
     * @param String $bankAcctName Bank account name
     */
    public function setBankAcctName($bankAcctName) 
    {
        $this->bankAcctName = $bankAcctName;
    
        return $this;
    }


    /**
     * get the bank account number
     *
     * @return string 
     */
    public function getBankAcctNum() 
    {
        return $this->bankAcctNum;
    }
    
    /**
     * set the bank account number
     *
     * @param String $bankAcctNum 
     */
    public function setBankAcctNum($bankAcctNum) 
    {
        $this->bankAcctNum = $bankAcctNum;
    
        return $this;
    }


    /**
     * Get the echeck type
     *
     * @return string echeck type
     */
    public function getECheckType() 
    {
        return $this->eCheckType;
    }
    
    /**
     * Set the echeck type
     * Allowed values are ARC, BOC, CCD, PPD, TEL, WEB
     *
     * @param String $eCheckType Echeck type
     */
    public function setECheckType($eCheckType) 
    {
        $allowed = array('ARC', 'BOC', 'CCD', 'PPD', 'TEL', "WEB");
        if(!in_array($eCheckType, $allowed)) {
            throw new \Exception("Invalid ECheck Type {$eCheckType}");
        }
        $this->eCheckType = $eCheckType;
    
        return $this;
    }
}