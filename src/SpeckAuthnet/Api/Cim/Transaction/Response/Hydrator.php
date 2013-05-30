<?php

namespace SpeckAuthnet\Api\Cim\Transaction\Response;

use SpeckAuthnet\Api\Aim\Response;

class Hydrator
{
    const APPROVED = 1;
    const DECLINED = 2;
    const ERROR = 3;
    const HELD = 4;

    public function hydrate($rawResponse, array $options = array())
    {
    	$defaults = array(
    		'version' => '3.1',
    		'delimChar' => ',',
    		'delimData' => 'TRUE',
    		'relayResponse' => 'FALSE',
    		'encapChar' => '|'
    	);

    	$options += $defaults;

        $response = new Response();
        if ($rawResponse) {
            $response->setRawResponse($rawResponse);

            $responseData = array();

            $responseData = explode("{$options['delimChar']}", $rawResponse);

            /**
             * If AuthorizeNet doesn't return a delimited response.
             */
            if (count($responseData) < 10) {
                $response->setApproved(false);
                $response->setError(true);
                $response->addErrorMessage("Unrecognized response from AuthorizeNet: $rawResponse");

                return $response;
            }

            // Set all fields
            $response->setResponseCode($responseData[0]);
            $response->setResponseSubcode($responseData[1]);
            $response->setResponseReasonCode($responseData[2]);
            $response->setResponseReasonText($responseData[3]);
            $response->setAuthorizationCode($responseData[4]);
            $response->setAvsResponse($responseData[5]);
            $response->setTransactionId($responseData[6]);
            $response->setInvoiceNumber($responseData[7]);
            $response->setDescription($responseData[8]);
            $response->setAmount($responseData[9]);
            $response->setMethod($responseData[10]);
            $response->setTransactionType($responseData[11]);
            $response->setCustomerId($responseData[12]);
            $response->setFirstName($responseData[13]);
            $response->setLastName($responseData[14]);
            $response->setCompany($responseData[15]);
            $response->setAddress($responseData[16]);
            $response->setCity($responseData[17]);
            $response->setState($responseData[18]);
            $response->setZipCode($responseData[19]);
            $response->setCountry($responseData[20]);
            $response->setPhone($responseData[21]);
            $response->setFax($responseData[22]);
            $response->setEmailAddress($responseData[23]);
            $response->setShipToFirstName($responseData[24]);
            $response->setShipToLastName($responseData[25]);
            $response->setShipToCompany($responseData[26]);
            $response->setShipToAddress($responseData[27]);
            $response->setShipToCity($responseData[28]);
            $response->setShipToState($responseData[29]);
            $response->setShipToZipCode($responseData[30]);
            $response->setShipToCountry($responseData[31]);
            $response->setTax($responseData[32]);
            $response->setDuty($responseData[33]);
            $response->setFreight($responseData[34]);
            $response->setTaxExempt($responseData[35]);
            $response->setPurchaseOrderNumber($responseData[36]);
            $response->setMd5Hash($responseData[37]);
            $response->setCardCodeResponse($responseData[38]);
            $response->setCavvResponse($responseData[39]);
            $response->setAccountNumber($responseData[50]);
            $response->setCardType($responseData[51]);
            $response->setSplitTenderId($responseData[52]);
            $response->setRequestedAmount($responseData[53]);
            $response->setBalanceOnCard($responseData[54]);

            $response->setApproved(($response->getResponseCode() == self::APPROVED));
            $response->setDeclined(($response->getResponseCode() == self::DECLINED));
            $response->setError($response->getResponseCode() == self::ERROR);
            $response->setHeld(($response->getResponseCode() == self::HELD));

            /*
            // Set custom fields
            $customFields = $request->getCustomFields();
            if ($count = count($customFields)) {
                $customFieldsResponse = array_slice($responseData, -$count, $count);
                $i = 0;
                foreach ($customFields as $key => $value) {
                    $response->addCustomField($key, $customFieldsResponse[$i]);
                    $i++;
                }
            }
            */

            if ($response->getError()) {
                $response->addErrorMessage("AuthorizeNet Error:
                    Response Code: ". $response->getResponseCode() ."
                    Response Subcode: ". $response->getResponseSubcode() ."
                    Response Reason Code: ". $response->getResponseReasonCode() ."
                    Response Reason Text: ". $response->getResponseReasonText()
                );
            }
        } else {
            $response->setApproved(false);
            $response->setError(true);
            $response->addErrorMessage("Error connecting to AuthorizeNet");
        }

        return $response;
    }
}