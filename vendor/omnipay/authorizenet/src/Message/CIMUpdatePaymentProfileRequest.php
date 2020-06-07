<?php

namespace Omnipay\AuthorizeNet\Message;

use Omnipay\Common\CreditCard;

/**
 * Request to create customer payment profile for existing customer.
 */
class CIMUpdatePaymentProfileRequest extends CIMCreatePaymentProfileRequest
{
    protected $requestType = 'updateCustomerPaymentProfileRequest';

    public function getData()
    {
        $this->validate('card', 'customerProfileId', 'customerPaymentProfileId');

        /** @var CreditCard $card */
        $card = $this->getCard();
        $card->validate();

        $data = $this->getBaseData();
        $data->customerProfileId = $this->getCustomerProfileId();
        $this->addPaymentProfileData($data);
        $this->addTransactionSettings($data);

        return $data;
    }

    /**
     * Adds payment profile to the specified xml element
     *
     * @param \SimpleXMLElement $data
     */
    protected function addPaymentProfileData(\SimpleXMLElement $data)
    {
        // This order is important. Payment profiles should come in this order only
        $req = $data->addChild('paymentProfile');
        $this->addBillingData($req);
        $req->customerPaymentProfileId = $this->getCustomerPaymentProfileId();
    }

    public function sendData($data)
    {
        $headers = array('Content-Type' => 'text/xml; charset=utf-8');
        $data = $data->saveXml();
        $httpResponse = $this->httpClient->post($this->getEndpoint(), $headers, $data)->send();

        return $this->response = new CIMUpdatePaymentProfileResponse($this, $httpResponse->getBody());
    }
}
