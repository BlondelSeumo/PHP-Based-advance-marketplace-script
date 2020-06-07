<?php defined('BASEPATH') OR exit('No direct script access allowed');

include("./vendor/autoload.php"); 

use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

class Paymentgateway extends Omnipay {

	protected $gateway = null;

	public function __construct($set_gateway='PayPal_Pro',$test_mode=true){
		$CI =& get_instance();
    	$CI->load->model('DatabaseOperationsHandler');
		$PaymentData = $CI->DatabaseOperationsHandler->_get_row_data('tbl_payment_settings',array('paymentgateway_id'=>$set_gateway));
		$this->gateway = Omnipay::create($set_gateway);

		switch ($set_gateway) {
			case 'PayPal_Pro':
				$this->gateway->setUsername(trim($PaymentData[0]['username']));
				$this->gateway->setPassword(trim($PaymentData[0]['password']));
				$this->gateway->setSignature(trim($PaymentData[0]['signature']));
				$this->gateway->setTestMode($PaymentData[0]['sandbox']);
        		break;
        	case 'PayPal_Express':
				$this->gateway->setUsername(trim($PaymentData[0]['username']));
				$this->gateway->setPassword(trim($PaymentData[0]['password']));
				$this->gateway->setSignature(trim($PaymentData[0]['signature']));
				$this->gateway->setTestMode($PaymentData[0]['sandbox']);
        		break;
        	case 'Stripe':
				$this->gateway->setApiKey(trim($PaymentData[0]['signature']));
        		break;
    		default:
    			return ;
		}
	}

	
	/*Paypal Pro */
	public function sendPurchase($cardInput, $valTransaction,$itemsArr=""){
		$card = new CreditCard($cardInput);
		$payArray = array(
		'amount'=> $valTransaction['amount'],
		'transactionId' => $valTransaction['transactionId'],
		'description'=> $valTransaction['description'],
		'currency'=>$valTransaction['currency'],
		'clientIp'=>$valTransaction['clientIp'],
		'returnUrl'=> $valTransaction['returnUrl'],
		'card'=>$card
		);

		if(!empty($itemsArr))
		{
			$response = $this->gateway->purchase($payArray)->setItems($itemsArr)->send();
		}

		$response = $this->gateway->purchase($payArray)->send();
		if($response->isSuccessful()){
			$paypalResponse = $response->getData();
		}elseif($response->isRedirect()){
			$paypalResponse = $response->getRedirectData();
		}else{
			$paypalResponse = $response->getMessage();
		}
		return $paypalResponse;
	}

	/*Paypal Payment */
	public function sendPurchaseExpress($cardInput, $valTransaction,$itemsArr=""){
		$payArray = array(
		'amount'=> $valTransaction['amount'],
		'transactionId' => $valTransaction['transactionId'],
		'description'=> $valTransaction['description'],
		'currency'=>$valTransaction['currency'],
		'clientIp'=>$valTransaction['clientIp'],
		'returnUrl'=> $valTransaction['returnUrl'],
		'cancelUrl'=> $valTransaction['returnUrl']
		);

		if(!empty($itemsArr)){
			$response = $this->gateway->purchase($payArray)->setItems($itemsArr)->send();
		}

		$response = $this->gateway->purchase($payArray)->setItems($itemsArr)->send();
		if($response->isSuccessful()){
			$paypalResponse = $response->getData();
		}elseif($response->isRedirect()){
			$paypalResponse = $response->getRedirectUrl();
			return $paypalResponse;
		}else{
			return $paypalResponse = $response->getMessage();
		}
	}

	/*Paypal Payment */
	public function completePurchasePaypal($data){
		$payArray = array(
		'amount' => $data['amount'],
        'currency' => $data['currency'],
        'token' => $data['token'],
        'payerid' => $data['PayerID']
    	);

		$response = $this->gateway->completePurchase($payArray)->send();
		if($response->isSuccessful()){
			$paypalResponse = $response->getData();
		}elseif($response->isRedirect()){
			$paypalResponse = $response->getRedirectUrl();
		}else{
			$paypalResponse = $response->getMessage();
		}
		return $paypalResponse;
	}

	/*Stripe Payment */
	public function completePurchaseStripe($cardInput, $valTransaction,$itemsArr=""){
		$payArray = array(
		'amount' => $valTransaction['amount'],
        'currency' => $valTransaction['currency'],
        'description'=> $valTransaction['description'],
        'card' => $cardInput,
        'paymentMethod'=> $valTransaction['transactionId'],
     	'returnUrl'=> $valTransaction['returnUrl'],
     	'confirm'=> true,
    	);

		if(!empty($itemsArr)){
			$response = $this->gateway->authorize($payArray)->setItems($itemsArr)->send();
		}

		$response = $this->gateway->authorize($payArray)->setItems($itemsArr)->send();
		if($response->isSuccessful()){
			return $stripeResponse = $response->getData();
		}elseif($response->isRedirect()){
			$stripeResponse = $response->getRedirectUrl();
			return $stripeResponse;
		}else{
			return $stripeResponse = $response->getMessage();
		}
	}


}