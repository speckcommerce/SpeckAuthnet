<?php
namespace SpeckAuthnet\Api;

abstract class AbstractResponse
{
    protected $_rawResponse;
    protected $_success;
    protected $_errors = array();
    protected $_response;

    /**
     * Return the raw response
     *
     * @return string
     */
    public function getRawResponse()
    {
        return $this->_rawResponse;
    }

    public function setRawResponse($response)
    {
        $this->_rawResponse = $response;

        return $this;
    }

    /**
     * Contains error messages if call is not successful
     *
     * @return array
     */
    public function getErrorMessages()
    {
        return $this->_errors;
    }

    /**
     * Add an error message to the response
     *
     * @param $errorMessage
     * @return AbstractResponse
     */
    public function addErrorMessage($errorMessage)
    {
        array_push($this->_errors, $errorMessage);

        return $this;
    }

    /**
     * @return bool
     */
    abstract public function isSuccess();
}