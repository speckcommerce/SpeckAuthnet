<?php
namespace SpeckAuthnet\Api\Aim;

class PriorAuthCapture extends AbstractPaymentCard
{
    const PRIOR_AUTH_CAPTURE    = "PRIOR_AUTH_CAPTURE";

    protected $transId;
    protected $splitTenderId;

    public function __construct()
    {
    	$this->type = self::PRIOR_AUTH_CAPTURE;
    }


    /**
     * Get transaction id
     *
     * @return string the transaction id
     */
    public function getTransId() 
    {
        return $this->transId;
    }
    
    /**
     * Set the transaction id of an authorized payment
     *
     * @param String $transId The transaction id
     */
    public function setTransId($transId) 
    {
        $this->transId = $transId;
    
        return $this;
    }

    public function setTransactionId($id)
    {
        $this->setTransId($id);
        return $this;
    }

    public function getTransactionId()
    {
        return $this->getTransId();
    }

    /**
     * Get the split tender id, this would be the id passed
     * when running a payment with split_tender to true.
     *
     * @return string the split tender id
     */
    public function getSplitTenderId() 
    {
        return $this->splitTenderId;
    }
    
    /**
     * Set the split tender id.
     *
     * @param String $splitTenderId The split tender id
     */
    public function setSplitTenderId($splitTenderId) 
    {
        $this->splitTenderId = $splitTenderId;
    
        return $this;
    }
}