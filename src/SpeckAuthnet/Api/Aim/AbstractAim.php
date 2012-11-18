<?php
namespace SpeckAuthnet\Api\Aim;

use SpeckAuthnet\Api\ConfigAwareInterface,
    SpeckAuthnet\Api\RequestInterface;

abstract class AbstractAim implements ConfigAwareInterface, RequestInterface
{

    const LIVE_URL      = 'https://secure.authorize.net/gateway/transact.dll';
    const SANDBOX_URL   = 'https://test.authorize.net/gateway/transact.dll';
    
    const MODE_LIVE     = "live";
    const MODE_SANDBOX  = "sandbox";

    /**
     * Login issued by Authnet
     * 
     * @var string
     */
    protected $login;

    /**
     * Transaction key issued by Authnet
     * @var string
     */
    protected $tranKey;

    /**
     * Current mode.  Possible values are:
     * 
     * live 
     * sandbox
     * 
     * @var string
     */
    protected $_mode;            


    /**
     * Holds all the x_* name/values that will be posted in the request. 
     * Default values are provided for best practice fields.
     */
    protected $version = '3.1';
    protected $delimChar = ',';
    protected $delimData = 'TRUE';
    protected $relayResponse = 'FALSE';
    protected $encapChar = '|';

    protected $testRequest;
    protected $duplicateWindow = 0;  

    protected $type;
    
    /**
     * Only used if merchant wants to send custom fields.
     */
    private $customFields = array();

    public function getEndpoint()
    {

        if(self::MODE_LIVE == $this->getMode()) {
            return self::LIVE_URL;
        }

        return self::SANDBOX_URL;
    }

    public function setMode($mode)
    {
        $this->_mode = $mode;
        return $this;
    }

    public function getMode()
    {
        if(is_null($this->_mode) || 'live' != $this->_mode) {
            $this->_mode = self::MODE_SANDBOX;
        }

        return $this->_mode;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setTranKey($tranKey)
    {
        $this->tranKey = $tranKey;
        return $this;
    }

    public function getTranKey()
    {
        return $this->tranKey;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    public function setDelimChar($delimChar)
    {
        $this->delimChar = $delimChar;

        return $this;
    }

    public function setDelimData($delimData)
    {
        $this->delimData = $delimData;

        return $this;
    }

    public function setDuplicateWindow($duplicateWindow)
    {
        $this->duplicateWindow = $duplicateWindow;

        return $this;
    }

    public function setEncapChar($encapChar)
    {
        $this->encapChar = $encapChar;

        return $this;
    }

    public function setRelayResponse($relayResponse)
    {
        $this->relayResponse = $relayResponse;

        return $this;
    }

    public function setTestRequest($testRequest)
    {
        $this->testRequest = $testRequest;

        return $this;
    }

    /**
     * Quickly set multiple custom fields.
     *
     * @param array $fields
     */
    public function setCustomFields(array $fields)
    {
        foreach ($fields as $key => $value) {
            $this->addCustomField($key, $value);
        }

        return $this;
    }

    /**
     * Set a custom field. Note: the x_ prefix will not be added to
     * your custom field if you use this method.
     *
     * @param string $name
     * @param string $value
     */
    public function addCustomField($name, $value)
    {
        $this->customFields[$name] = $value;
    }

    public function getCustomFields()
    {
        return $this->customFields;
    }

    public function getDelimChar()
    {
        return $this->delimChar;
    }

    public function getDelimData()
    {
        return $this->delimData;
    }

    public function getDuplicateWindow()
    {
        return $this->duplicateWindow;
    }

    public function getEncapChar()
    {
        return $this->encapChar;
    }

    public function getRelayResponse()
    {
        return $this->relayResponse;
    }

    public function getTestRequest()
    {
        return $this->testRequest;
    }

    public function getVersion()
    {
        return $this->version;
    }


    /**
     * Converts the x_post_fields array into a string suitable for posting.
     */
    public function __toString()
    {
        $transform = function($letters) {
            $letter = array_shift($letters);
            return '_' . strtolower($letter);
        };

        $body = "";
        foreach($this as $key => $value) {
            if(empty($value) || 0 === strpos($key, "_")) {
                continue;
            }

            switch($key) {

                case "lineItems":
                    if(!property_exists($this, 'lineItems') || !is_array($this->lineItems)) {                    
                        break;
                    }

                    foreach($this->lineItems as $lineItem) {
                        if(!($lineItem instanceof \SpeckAuthnet\Api\Aim\Element\LineItem)) {
                            continue;
                        }
                        $body .= "x_line_item={$lineItem}&";
                    }
                    break;
                case "customFields":
                    if(!is_array($this->customFields)) {
                        break;
                    }
                    $body .= http_build_query($this->customFields) . "&";
                    break;
                default:
                    $keyName = "x_". preg_replace_callback('/([A-Z])/', $transform, $key);
                    $body .= $keyName ."=". urlencode($value) . "&";
                    break;
            }

        }

        return rtrim($body, "&");
    }
}