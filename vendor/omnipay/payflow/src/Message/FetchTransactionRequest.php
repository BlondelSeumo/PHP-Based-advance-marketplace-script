<?php

namespace Omnipay\Payflow\Message;

/**
 * Payflow Fetch Transaction Request
 *
 * ### Example
 *
 * <code>
 * // Create a gateway for the Payflow pro Gateway
 * // (routes to GatewayFactory::create)
 * $gateway = Omnipay::create('Payflow_Pro');
 *
 * // Initialise the gateway
 * $gateway->initialize(array(
 *     'username'       => $myusername,
 *     'password'       => $mypassword,
 *     'vendor'         => $mymerchantid,
 *     'partner'        => $PayPalPartner,
 *     'testMode'       => true, // Or false for live transactions.
 * ));
 *
 * // Create a credit card object
 * // This card can be used for testing.
 * $card = new CreditCard(array(
 *             'firstName'    => 'Example',
 *             'lastName'     => 'Customer',
 *             'number'       => '4111111111111111',
 *             'expiryMonth'  => '01',
 *             'expiryYear'   => '2020',
 *             'cvv'          => '123',
 * ));
 *
 * // Do a purchase transaction on the gateway
 * $transaction = $gateway->purchase(array(
 *     'amount'                   => '10.00',
 *     'currency'                 => 'AUD',
 *     'card'                     => $card,
 * ));
 * $response = $transaction->send();
 * if ($response->isSuccessful()) {
 *     echo "Purchase transaction was successful!\n";
 *     $sale_id = $response->getTransactionReference();
 *     echo "Transaction reference = " . $sale_id . "\n";
 * }
 *
 * // Fetch the purchase
 * $transaction = $gateway->fetchTransaction(array(
 *     'transactionReference'     => $sale_id,
 * ));
 * $response = $transaction->send();
 * if ($response->isSuccessful()) {
 *     echo "Fetch transaction was successful!\n";
 *     $data = $response->getData();
 *     echo "Transaction Data =\n" . print_r($data, true) . "\n";
 * }
 * </code>
 */
class FetchTransactionRequest extends AuthorizeRequest
{
    protected $action = 'I';

    public function getData()
    {
        $data = $this->getBaseData();

        $data['TENDER'] = 'C';
        $data['VERBOSITY'] = 'HIGH';
        $data['ORIGID'] = $this->getTransactionReference();

        return $data;
    }
}
