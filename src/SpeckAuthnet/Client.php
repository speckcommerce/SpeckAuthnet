<?php
namespace SpeckAuthnet;

use Zend\ServiceManager\ServiceManagerAwareInterface,
    Zend\ServiceManager\ServiceManager,
    SpeckAuthnet\Api\DefaultResponse;

class Client implements ServiceManagerAwareInterface
{
    /*
     * @var \Zend\Http\Client
     */
    protected $httpClient;

    /**
     * @var Zend\ServiceManager\ServiceManager
     */
    protected $sm;

    /**
     * @var object
     */
    protected $api;

    /**
     * 
     * @var string
     */
    protected $apiNamespace;

    /**
     * Make the paypal request and return a Response object
     *
     * @param AbstractRequest $model
     * @return Response
     * @throws Exception
     */
    public function send()
    {
        try {
            $api    = $this->api;
            $client = $this->httpClient;

            if(false == ($api instanceof \SpeckAuthnet\Api\RequestInterface)) {
                throw new \Exception('Invalid API set on Client');
            }

            if(is_null($client)) {
                throw new \Exception('Zend\Http\Client must be set and must be valid.');
            }

            $client->setMethod('POST');
            $client->setUri(new \Zend\Uri\Http($api->getEndpoint()));
            $client->setRawBody("$api");

            $httpResponse = $client->send();

            /**
             * @todo when CIM is added, refactor to AbstractFactory
             */
            if(!($this->sm->has($this->apiNamespace ."\ResponseHydrator"))) {
                throw new \Exception("Missing response hydrator for {$this->apiNamespace}");
            }
            $hydrator = $this->sm->get($this->apiNamespace ."\ResponseHydrator");

            $response = $hydrator->hydrate($api, $httpResponse->getBody());

        } catch(\Exception $e) {
            $response = new DefaultResponse();
            $response->addErrorMessage($e->getMessage());
        }

        return $response;
    }

    public function setHttpClient(\Zend\Http\Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->sm = $serviceManager;
    }

    public function getHttpClient()
    {
        return $this->httpClient;
    }

    public function api($apiName)
    {
        if(!$this->sm->has($apiName)) {
            throw new \Exception('API does not exist.');
        }

        $this->api = $this->sm->get($apiName);
        $this->apiNamespace = substr($apiName, 0, strpos($apiName, "\\"));

        return $this;
    }

    public function getApi()
    {
        return $this->api;
    }

    public function getApiNamespace()
    {
        return $this->apiNamespace;
    }

    public function setData(array $data)
    {
        $hydratorKey = $this->apiNamespace ."/Hydrator";
        if(!$this->sm->has($hydratorKey)) {
            throw new \Exception("No hydrator found for {$hydratorKey}");
        }
        
        $hydrator = $this->sm->get($hydratorKey);
        $hydrator->hydrate($data, $this->api);

        return $this;
    }

    /**
     * Proxy to API
     * 
     * @param  [type] $method [description]
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    public function __call($method, $params)
    {
        if(is_null($this->api)) {
            throw new \Exception('No api is set.');
        }

        if(!method_exists($this->api, $method)) {
            throw new \Exception("Invalid method {$method}.");
        }

        if(0 === strpos($method, "set")) {            
            $this->api->$method($params[0]);
            return $this;
        }
        
        return $this->api->$method();
    }

    /**
     * Utility for unit testing
     * 
     */
    public function resetApi()
    {
        $this->api          = null;
        $this->apiNamespace = null;
    }
}