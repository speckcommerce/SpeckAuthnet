SpeckPayAuthnet
===========

A generic module for adding Authorize.net Payments support to a ZF2 application.

Introduction
------------

SpeckAuthnet is a module that can be utilized outside of Speck Commerce to accept payments via the Authorize.net payment gateway.
This module currently supports PayPal Payments Pro and Express Checkout API Operations.

To get started visit the [Authorize.net Development Center](http://developer.authorize.net/)

To integrate with this module you will want to sign up for an account on Authorize.net. See the developer website for instructions.

This module currently supports the following AIM calls with API version 3.1:
* AUTH_CAPTURE and AUTH_ONLY
* CREDIT
* VOID
* ECHECK
* PRIOR_AUTH_CAPTURE
* CAPTURE_ONLY

Requirements
------------

The dependencies for SpeckCommerce are set up as Git submodules so you should not hav

* PHP 5.3.3+
* [Zend Framework 2](https://github.com/zendframework/zf2) (latest master)


Contributors
------------

* [Steve Rhoades] (https://github.com/SteveRhoades) (aka srhoades)


Community
---------

Join us on the Freenode IRC network: #speckcommerce. Our numbers are few right
now, but we're a dedicated small group working on this project full time.


Getting Started
---------------
Move the module.config.php.dist to module.config.php and replace the following values with your own.

* tran_key - The transaction key provided by Authorize.net
* login - The login is provided by Authorize.net
* mode - Possible values are `sandbox` or `live`

Example Usage
-------------
### The Client
SpeckAuth API Name: 'SpeckAuthnet\Client'

The SpeckAuthnet module works off a single Client.  You will utilize this client to access the API's and make your calls to the Authnet endpoints.  The Client provides a fluent interface allowing you to chain method calls.
<pre>
//start by getting an instance of the client, in this example I will be leveraging the ServiceManager.
$client = $sm->get('SpeckAuthnet\Client');
</pre>

There are 3 ways to interact with the APIs via the client.
* use setData to set a preconfigured array of key/value pairs on the API.  The keys are the same as the fields in the Authorize.net AIM documentation minus the `x_`
* proxy calls to the API via the client
* act on the API itself calling `Client::getApi()`

### Credit Card
SpeckAuthnet API Name: `Aim\CreditCard`

By default the authorization type of the CreditCard API is AUTH_ONLY, this can also be configured to be an AUTH_CAPTURE call to Authorize.net.  The SpeckAuthnet module contains support for all available fields, for a complete list you can look at the unit tests included with the module or consult the documentation available on the Authorize.net developer website.

<pre>
$paymentInfo = array(
    'amount' => '20.00',
    'card_num' => '4111111111111111',
    'exp_date' => '122012',
    'address' => '2065 nestall rd',
    'city' => 'laguna beach',
    'state' => 'california',
    'zip' => '92656',
    'country' => 'US',
    'first_name' => 'steve',
    'last_name' => 'rizzo'    
);

//Authorize Only
$response = $client->api('Aim\CreditCard')
	->setData($paymentInfo)
	->send();

//Authorize Capture
$response = $client->api('Aim\CreditCard')
	->setData($paymentInfo)
	->setType('AUTH_CAPTURE')
	->send();

echo $response->isApproved();
</pre>

### Void
SpeckAuthnet API Name: `Aim\Void`

In order to void a transaction you will need the transaction id returned from the original authorization.

<pre>
//
$response = $client->api('Aim\Void')
	->setTransactionid($transactionId)
	->send();
echo $response->isSuccess();
</pre>

### Credit
SpeckAuthnet API Name: `Aim\Credit`

Credits cannot be applied to Authorization-Only transactions.  You can use the full card number, a masked last 4 digit number or simply a last 4 digit number (4111111111111111, XXXX4111, 4111). 

NOTE: A credit can only be applied to a settled transaction unless you are doing an unlinked credit.
NOTE: The default credit method is CC, this will automatically change to ECHECK if bankAbaCode or bankAcctNum is set, likewise you can change the method by calling `setMethod($method);`
NOTE: Unlinked Credits must exclude the transaction id and provide a full credit card number and expiration date.
<pre>
$response = $client->api('Aim\Credit')
	->setCardNum($accountNum)
	->transactionId($transactionId)
	->send();
echo $response->isSuccess();
</pre>

TODO
----
* improve integration tests
* refactor to relevant exception classes
* add support for CIM