<?php

namespace SpeckAuthnet;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\Mvc\ModuleRouteListener,
    Zend\Http\Client,
    Zend\ServiceManager;

class Module implements AutoloaderProviderInterface
{
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'SpeckAuthnet\Client' => function($sm) {
                    $httpClient = new \Zend\Http\Client;
                    $httpClient->setAdapter(new \Zend\Http\Client\Adapter\Curl);

                    $client = new \SpeckAuthnet\Client;
                    $client->setHttpClient($httpClient);

                    return $client;
                },
                'Aim\Hydrator' => function($sm) {
                    $hydrator = new \Zend\StdLib\Hydrator\ClassMethods;
                    $strategy = $sm->get('Aim\Element\LineItemStrategy');
                    $strategy->setHydrator($hydrator);
                    $hydrator->addStrategy('lineItems', $strategy);

                    return $hydrator;
                }
            ),
            'invokables' => array(
                'Aim\ResponseHydrator' => 'SpeckAuthnet\Api\Aim\ResponseHydrator',
                'Aim\Element\LineItemStrategy' => 'SpeckAuthnet\Api\Aim\Element\LineItemStrategy',
                'Aim\LineItem' => '\SpeckAuthnet\Api\Aim\LineItem',
                'Aim\CreditCard' => "SpeckAuthnet\Api\Aim\CreditCard",
                'Aim\ECheck' => 'SpeckAuthnet\Api\Aim\ECheck',
                'Aim\Void' => 'SpeckAuthnet\Api\Aim\Void',
                'Aim\CaptureOnly' => 'SpeckAuthnet\Api\Aim\CaptureOnly',
                'Aim\PriorAuthCapture' => 'SpeckAuthnet\Api\Aim\PriorAuthCapture',
                'Aim\Credit' => 'SpeckAuthnet\Api\Aim\Credit'
            ),
            'shared' => array(
                'Aim\Credit' => false,
                'Aim\CreditCard' => false,
                'Aim\LineItem' => false,
                'Aim\Void' => false,
                'Aim\PriorAuthCapture' => false,
                'Aim\ECheck'    => false,
                'Aim\CaptureOnly' => false
            ),
            'initializers' => array(
                function($instance, $sm) {
                    if($instance instanceof \SpeckAuthnet\Api\ConfigAwareInterface) {
                        $config = $sm->get('application')->getConfig();
                        $apiConfig = isset($config['speck-authnet-api']) ? $config['speck-authnet-api'] : array('login'=>'','tran_key'=>'','mode'=>'sandbox');
                        $instance->setMode($apiConfig['mode']);
                        $instance->setTranKey($apiConfig['tran_key']);
                        $instance->setLogin($apiConfig['login']);
                    }
                }
            )
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__)
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
