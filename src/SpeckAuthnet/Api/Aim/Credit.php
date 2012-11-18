<?php

namespace SpeckAuthnet\Api\Aim;

class Credit extends AbstractPaymentCard
{
    const CREDIT = "CREDIT";

    protected $transId;

    // ==================================================================
    //
    // The below are needed if it's an ECHECK credit
    //
    // ------------------------------------------------------------------    
    protected $bankAbaCode;
    protected $bankAcctNum;    

    public function __construct() {
        $this->type = self::CREDIT;
    }

    /**
     * Format: CC or CHECK
     * 
     * @param $method
     */
    public function setMethod($method)
    {
        $method = strtoupper($method);
        $allowed = array('CC', 'ECHECK');
        if(!in_array($method, $allowed)) {
            throw new \Exception('Invalid method: $method passed.');
        }
        $this->method = $method;

        return $this;
    }    

    /**
     * Get the transaction id
     *
     * @return string tranasaction id
     */
    public function getTransId() 
    {
        return $this->transId;
    }
    
    /**
     * Set the transaction id of the payment to creditz
     *
     * @param String $transId Tranasaction id
     */
    public function setTransId($transId) 
    {
        $this->transId = $transId;
    
        return $this;
    }


    /**
     * Get the Bank ABA Code
     *
     * @return string 
     */
    public function getBankAbaCode() 
    {
        return $this->bankAbaCode;
    }
    
    /**
     * Set the bank aba code
     *
     * @param String $bankAbaCode 
     */
    public function setBankAbaCode($bankAbaCode) 
    {
        $this->bankAbaCode = $bankAbaCode;
        $this->setMethod('ECHECK');
        return $this;
    }


    /**
     * Get the bank account number
     *
     * @return string 
     */
    public function getBankAcctNum() 
    {
        return $this->bankAcctNum;
    }
    
    /**
     * Set the bank account number
     *
     * @param String $bankAcctNum 
     */
    public function setBankAcctNum($bankAcctNum) 
    {
        $this->bankAcctNum = $bankAcctNum;
        $this->setMethod('ECHECK');
        return $this;
    }
}