<?php

namespace SpeckAuthnet\Api\Aim;

class CaptureOnly extends AbstractPaymentCard
{
    const CAPTURE_ONLY          = "CAPTURE_ONLY";

    protected $authCode;

    public function __construct() 
    {
        $this->type = self::CAPTURE_ONLY; 
    }


    /**
     * Get the auth code
     *
     * @return string auth code
     */
    public function getAuthCode() 
    {
        return $this->authCode;
    }
    
    /**
     * Set the authorization code
     *
     * @param Strubg $authCode authorization code
     */
    public function setAuthCode($authCode) 
    {
        $this->authCode = $authCode;
    
        return $this;
    }
}