<?php
namespace SpeckAuthnet\Api\Aim;

abstract class AbstractPaymentCard extends AbstractPayment
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
	protected $method = 'CC';

    /**
     * @var string
     */
	protected $cardNum;

    /**
     * @var string
     */
	protected $expDate;


    /**
     * (required)
     * 
     * Format: Between 13 and 16 digits without spaces. When x_ type=CREDIT, only the 
     * last four digits are required.
     * 
     * 
     * @param $cardNum
     */
    public function setCardNum($cardNum)
    {
        $this->cardNum = $cardNum;
        return $this;
    }

    /**
     * Acceptable Formats: 
     * MMYY, MM/YY, MM-YY, MMYYYY, MM/YYYY, MM-YYYY
     * 
     * @param $expDate
     */
    public function setExpDate($expDate)
    {
        $this->expDate = $expDate;
        return $this;        
    }

    /**
     * Format: CC or CHECK, in this class can only be CC.
     * 
     * @param $method
     */
    public function setMethod($method)
    {
        return $this;
    }

    /**
     * (required)
     * 
     * Format: AUTH_CAPTURE (default), AUTH_ONLY, CAPTURE_ ONLY, CREDIT, PRIOR_AUTH_CAPTURE, VOID
     * 
     * @param $type
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;        
    }


    // ==================================================================
    //
    // Getters
    //
    // ------------------------------------------------------------------

    /**
     * @return string
     */
    public function getCardNum()
    {
        return $this->cardNum;
    }

    /**
     * @return string
     */
    public function getExpDate()
    {
        return $this->expDate;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}