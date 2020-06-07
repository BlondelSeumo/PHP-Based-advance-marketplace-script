<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0);

class payments extends CI_Controller {

	private static $data = array();
	public function __construct() {
		parent::__construct();
		$this->load->model('DatabaseOperationsHandler', 'database');
		$this->load->model('CommonOperationsHandler', 'common');
		$this->load->model('EmailOperationsHandler', 'email_op');	 
        $this->load->library('paymentgateway');

        self::$data['categoriesData']				=	$this->database->_count_listings_categories_wise();
		self::$data['languages']					=	$this->database->load_all_languages();
		self::$data['default_currency']				=	$this->common->getCurrency('USD','symbol');
		self::$data['userdata'] 					= 	$this->database->getUserData($this->session->userdata('user_id'));
		self::$data['selectedLanguage'] 			= 	$this->common->is_language();
		self::$data['listingCount']					= 	$this->database->_count_listings_user_wise();
		self::$data['imagesData']					=	$this->database->_get_row_data('tbl_siteimages',array('id'=>1));
		self::$data['announcements']                =   $this->database->_get_row_data('tbl_announcement',array('status'=>1));
		self::$data['payments']                     =   $this->database->_get_row_data('tbl_payment_settings',array('status'=>1));
		self::$data['settings']                     =   $this->database->_get_row_data('tbl_settings',array('id'=>1));
		self::$data['token'] 						= 	$this->security->get_csrf_hash();

		if(self::$data['settings'][0]['ssl_enable'] === '1'){
			force_ssl();
		}
    }

    /*Contract Payment Function*/
    public function pay_contract(){

    	if(!empty($this->session->userdata('user_id'))){
			if($this->input->post('txt_paytotal') > 0){
				switch ($this->input->post('paymentType')) {
					case 'PayPal_Express':
						$this->PayPal_Express_contract();
        				break;
    				case 'PayPal_Pro':    			
        				$this->PayPal_Pro();
       	 				break;
       	 			case 'Stripe':    			
        				$this->stripe();
       	 				break;
    				default:
    					return ;
				}
			}
			else
			{
				$data['errors'] = 'Your Total amount should be greater than 0';
				$data = html_escape($this->security->xss_clean($data));
				$this->load->view('main/checkout',$data);
				return;
			}

		}
		else
		{
			$data['errors'] = 'Your login session has expired. Please login to continue';
			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('main/checkout',$data);
			return;
		}

    }

    public function PayPal_Express_contract(){
    	$settings_data 	= $this->database->getSettingsData();
		$currency 		= 'USD';

		if(!empty($settings_data[0]['default_currency'])) {
			$currency = $settings_data[0]['default_currency'];
		}

		if(!empty($this->session->userdata('user_id'))){	
			$itemsArr 			= array();
			$user_data 			= $this->database->getUserData($this->session->userdata('user_id'));
			$payment_id  		= $this->_generate_paymentID();
		}

		if(!empty($this->input->post('txt_type'))){
			switch ($this->input->post('txt_type')) {
				case 'buynow':
					$sale ='direct';
        			break;
        		case 'contract':
					$sale ='contract';
        			break;
    			default:
    				return ;
			}
		}

		if(!empty($user_data)){

			$itemsArr[0] = array(
				'id' => $this->input->post('txt_id'), 
				'name' => $this->input->post('txt_description'), 
				'quantity' => 1, 
				'price' => $this->input->post('txt_paytotal'),
				'sale' => $sale
			);

			$valTransc = array(
				'user_id' => $user_data[0]['user_id'],
				'user_email' =>$user_data[0]['email'],
				'user_username' =>$user_data[0]['username'],
				'listing_id' => $this->input->post('txt_id'),
				'amount' => number_format($this->input->post('txt_paytotal'), 2,'.',''),
				'transactionId'=>$payment_id,
				'description' => 'INVOICE :'.$payment_id,
				'currency'=>$currency,
				'payment_method'=>'PAYPAL',
				'clientIp'=>$this->input->ip_address(),
				'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN,
				'cancelUrl'=> base_url().PAYMENT_CANCEL,
				'domain_list'=>json_encode($itemsArr)
			);

			try{
				$purchaseProc = new paymentgateway('PayPal_Express',true);
				$this->session->set_userdata('paypal_data', $valTransc);
				$data 	= $purchaseProc->sendPurchaseExpress($cardInput,$valTransc,$itemsArr);
				$url 	= $data;
				header( "Location: $url" ); 
			}
			catch (Exception $e){
    			$url 	= base_url().PAYMENT_FAIL;
    			$this->fail($valTransc);
			} 
		}
		else
		{
			$data['errors'] = 'Invalid User';
			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('main/checkout',$data);
			return;
		}
    }

    /*Insert Purchases*/
    public function InsertDomainPurchaseData($user_id,$Arr){
    	$datas = self::$data;
        if(!empty($Arr['domain_list'])){
            foreach (json_decode($Arr['domain_list'],true) as $domain) {
            $domain_id  =   $this->database->_get_single_data('tbl_listings',array('id'=>$domain['id']),'domain_id');
            if($domain['sale'] === 'direct'){

                $data= array(
                	'user_id' =>$user_id,
                	'domain_id' =>$domain_id,
                	'listing_id' =>$domain['id'],
                	'amount' =>$domain['price'],
                	'invoice_id' =>$Arr['transactionId'],
                );

                $contract_id = $this->common->open_direct_contract($data['listing_id']);

                $Arr['contract_id'] = $contract_id;

                $contractArr= array(
                	'user_id' =>$user_id,
                	'domain_id' =>$domain_id,
                	'contract_id' =>$contract_id,
                	'listing_id' =>$domain['id'],
                	'amount' =>$domain['price'],
               	 	'invoice_id' =>$Arr['transactionId'],
                );

                if($this->database->_update_to_DB('tbl_listings',array('sold_status' => 1),$data['listing_id'])){
                    if(!empty($contract_id)){
                    	$this->database->_insert_to_table('tbl_domain_purchases',$data);
                        if($this->database->_insert_to_table('tbl_contracts',$contractArr)){
                            $this->common->change_contract_status($contract_id,1);
                            $this->common->change_delivery_date($contract_id,1);
                            $this->common->create_invoice($contractArr);
                            /*email notification*/
                            if($datas['settings'][0]['email_notifications'] === '1'){
        						$this->email_op->_send_invoice_email('payment',$Arr,'direct');
        					}
        					/**/   
                        }
                    }
                }
            }
            else
            {
                $data= array(
                'user_id' =>$user_id,
                'domain_id' =>$domain_id,
                'contract_id' =>$domain['sale'],
                'listing_id' =>$domain['id'],
                'amount' =>$domain['price'],
               	'invoice_id' =>$Arr['transactionId'],
                );

                $Arr['contract_id'] = $data['contract_id'];

                if($this->database->_update_to_DB('tbl_listings',array('sold_status'=>1),$data['listing_id'])){
                	if($this->database->_insert_to_table('tbl_contracts',$data)){
                		$this->common->change_contract_status($domain['sale'],1);
                        $this->common->change_delivery_date($domain['sale'],1);
                        $this->common->create_invoice($data);
                        /*email notification*/
                        if($datas['settings'][0]['email_notifications'] === '1'){
        					$this->email_op->_send_invoice_email('payment',$Arr,'contract');
        				}
        				/**/   
                    }
                }
            }
        	}
        }
    }

    
    /*PayPal Pro */
	public function PayPal_Pro(){
		$settings_data 	= $this->database->getSettingsData();
		$currency 		= 'USD';

		if(!empty($settings_data[0]['default_currency'])) {
			$currency = $settings_data[0]['default_currency'];
		}

		if(!empty($this->session->userdata('user_id'))){	
			$itemsArr 			= array();
			$user_data 			= $this->database->getUserData($this->session->userdata('user_id'));
			$payment_id  		= $this->_generate_paymentID();
		}

		if(!empty($this->input->post('txt_type'))){
			switch ($this->input->post('txt_type')) {
				case 'buynow':
					$sale =	'direct';
        			break;
        		case 'contract':
					$sale =	$this->input->post('txt_contract');
        			break;
    			default:
    				return ;
			}
		}

		if(!empty($user_data)){

			$itemsArr[0] = array(
				'id' => $this->input->post('txt_id'), 
				'name' => $this->input->post('txt_description'), 
				'quantity' => 1, 
				'price' => $this->input->post('txt_paytotal'),
				'sale' => $sale
			);

			$cardInput = array(
				'firstName'=>$this->input->post('name'),
				'lastName'=>'',
				'number'=>$this->input->post('number'),
				'cvv'=>$this->input->post('security-code'),
				'expiryMonth'=>$this->input->post('txt_month'),
				'expiryYear'=>$this->input->post('txt_year'),
				'email'=> $this->input->post('txt_useremail')
			);

			$valTransc = array(
				'user_id' => $this->session->userdata('user_id'),
				'user_email' =>$user_data[0]['email'],
				'user_username' =>$user_data[0]['username'],
				'listing_id' => $this->input->post('txt_id'),
				'amount' => number_format($this->input->post('txt_paytotal'), 2,'.',''),
				'transactionId'=>$payment_id,
				'description' => 'INVOICE :'.$payment_id,
				'currency'=>$currency,
				'payment_method'=>'PAYPAL',
				'clientIp'=>$this->input->ip_address(),
				'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN,
				'cancelUrl'=> base_url().PAYMENT_CANCEL,
				'domain_list'=>json_encode($itemsArr)
			);

			try{

				try{
					$purchaseProc = new paymentgateway('PayPal_Pro',true);
					$this->session->set_userdata('paypal_data', $valTransc);
					$data 	= $purchaseProc->sendPurchase($cardInput,$valTransc,$itemsArr);
					if(isset($data['ACK']) && $data['ACK'] == 'Success'){
						$this->session->set_userdata('paypal_data', $valTransc);
						$this->direct_payments($data,$valTransc,'outside','PayPal Pro');
						$url 	= base_url().PAYMENT_SUCCESS;
						$this->success($valTransc,$data);
					}
					else
					{
						$url 	= base_url().PAYMENT_FAIL;
    					$this->fail($valTransc,$data);
					}
				}
				catch (Exception $e){
    				$url 	= base_url().PAYMENT_FAIL;
    				$this->fail($valTransc);
				} 
			}
			catch (Exception $e)
			{
				if(!empty($this->session->userdata('user_id'))){
					$data = self::$data;
					$data['errors'] = 	$e->getMessage();
					$this->session->set_userdata('errors',$data['errors']);
					redirect('checkout/'.$this->input->post('txt_type').'/'.$this->input->post('txt_id'));
					return;
				}
				redirect('login');
			}
		}	   
	}

	/*direct_payments*/
	public function direct_payments($data,$paypal_data,$type='outside',$method){

		if(!empty($paypal_data)){
			$data= array(
        		'PAYMENT_ID' =>$paypal_data['transactionId'],
        		'AMOUNT' =>$paypal_data['amount'],
        		'METHOD' =>$method,
        		'ACK'=>$data['ACK'],
        		'USER_ID'=>$paypal_data['user_id'],
        		'PLAN_ID'=>$paypal_data['listing_id'],
        		'TOKEN'=>'',
        		'PAYMENTINFO_0_TRANSACTIONID'=>$data['TRANSACTIONID'],
        		'CORRELATIONID'=>$data['CORRELATIONID'],
        		'PAYER_ID'=>$data['CORRELATIONID'],
        		'PAYMENTINFO_0_TRANSACTIONTYPE'=>'',
        		'PAYMENTINFO_0_FEEAMT'=>'',
        		'PAYMENTINFO_0_PAYMENTTYPE'=>'',
        		'PAYMENTINFO_0_TAXAMT'=>''
        	);
        	$this->database->_insert_to_DB('tbl_payments', $data);  

			if($type === 'outside'){
				$this->InsertDomainPurchaseData($paypal_data['user_id'],$paypal_data);  
			}
			else
			{
				if(!empty( $this->session->userdata('listing_data'))){
					$listing_data = $this->session->userdata('listing_data');
				}

				foreach ($listing_data as $key) {
					$this->InsertPurchaseData($key['user_id'],array('user_membership_id'=>$key['listing_id'],'user_membership_timestamp'=>date('Y-m-d H:i:s'),'listing_type'=>$key['listing_type'],'user_membership_timestamp_expiry'=> date("Y-m-d" , strtotime(date("Y-m-d",strtotime(date('Y-m-d H:i:s')))."+ ".$key['period']."day")),'plan_header'=>$key['plan_header']));
				}
			}
			return;
		}
	}


	/*Stripe */
	public function stripe(){
		$settings_data 	= $this->database->getSettingsData();
		$currency 		= "USD";

		if(!empty($settings_data[0]['default_currency'])) {
			$currency = $settings_data[0]['default_currency'];
		}

		if(!empty($this->session->userdata('user_id'))){	
			$itemsArr 			= array();
			$user_data 			= $this->database->getUserData($this->session->userdata('user_id'));
			$payment_id  		= $this->_generate_paymentID();
		}

		if(!empty($this->input->post('txt_type'))){
			switch ($this->input->post('txt_type')) {
				case 'buynow':
					$sale =	'direct';
        			break;
        		case 'contract':
					$sale =	$this->input->post('txt_contract');
        			break;
    			default:
    				return ;
			}
		}

		if(!empty($user_data)){

			$itemsArr[0] = array(
				'id' => $this->input->post('txt_id'), 
				'name' => $this->input->post('txt_description'), 
				'quantity' => 1, 
				'price' => $this->input->post('txt_paytotal'),
				'sale' => $sale
			);

			$cardInput = array(
				'firstName'=>$this->input->post('name'),
				'lastName'=>'',
				'number'=>$this->input->post('number'),
				'cvv'=>$this->input->post('security-code'),
				'expiryMonth'=>$this->input->post('txt_month'),
				'expiryYear'=>$this->input->post('txt_year'),
				'email'=> $this->input->post('txt_useremail')
			);

			$valTransc = array(
				'user_id' => $this->session->userdata('user_id'),
				'user_email' =>$user_data[0]['email'],
				'user_username' =>$user_data[0]['username'],
				'listing_id' => $this->input->post('txt_id'),
				'amount' => number_format($this->input->post('txt_paytotal'), 2,'.',''),
				'transactionId'=>$payment_id,
				'description' => 'INVOICE :'.$payment_id,
				'currency'=>$currency,
				'payment_method'=>'STRIPE',
				'clientIp'=>$this->input->ip_address(),
				'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN,
				'cancelUrl'=> base_url().PAYMENT_CANCEL,
				'domain_list'=>json_encode($itemsArr)
			);

			try{

				try{
					$purchaseProc = new paymentgateway('Stripe',true);
					$this->session->set_userdata('paypal_data', $valTransc);
					$tempdata 	= $purchaseProc->completePurchaseStripe($cardInput,$valTransc,$itemsArr);

					if(isset($tempdata['status']) && $tempdata['status'] == 'succeeded'){
					
						$data = array(
							'TRANSACTIONID'=>$tempdata['id'],
							'ACK'=>$tempdata['status'],
							'CORRELATIONID'=>$tempdata['source']['fingerprint'],
        					'PAYER_ID'=>$tempdata['source']['last4']
						);

						$this->session->set_userdata('paypal_data', $valTransc);
						$this->direct_payments($data,$valTransc,'outside','Stripe');
						$url 	= base_url().PAYMENT_SUCCESS;
						$this->success($valTransc,$data);
					}
					else
					{
						$url 	= base_url().PAYMENT_FAIL;
    					$this->fail($valTransc,$tempdata);
					}
				}
				catch (Exception $e){
    				$url 	= base_url().PAYMENT_FAIL;
    				$this->fail($valTransc);
				} 
			}
			catch (Exception $e)
			{
				if(!empty($this->session->userdata('user_id'))){
					$data = self::$data;
					$data['errors'] = 	$e->getMessage();
					$this->session->set_userdata('errors',$data['errors']);
					redirect('checkout/'.$this->input->post('txt_type').'/'.$this->input->post('txt_id'));
					return;
				}
				redirect('login');
			}
		}	   
	}


    /*All Formats Return Page*/
	public function return($type='outside'){
		
		if(!empty($this->session->userdata('paypal_data'))){
			$paypal_data = $this->session->userdata('paypal_data');

			if(!empty( $this->session->userdata('listing_data'))){
				$listing_data = $this->session->userdata('listing_data');
			}

			if(isset($_GET['token']) && isset($_GET['PayerID'])){
				$data = array(
				'token' 	=> $_GET['token'],
				'PayerID' 	=> $_GET['PayerID'],
				'currency' 	=> $paypal_data['currency'],
				'amount' 	=> $paypal_data['amount']
				);

				$purchaseProc = new paymentgateway('PayPal_Express',true);
				$returnedData = $purchaseProc->completePurchasePaypal($data);
			}
			else
			{
				if($type !== 'free'){

					$data = array(
					'token' 	=> $_GET['token'],
					'PayerID' 	=> '',
					'currency' 	=> $paypal_data['currency'],
					'amount' 	=> $paypal_data['amount']
					);

					$returnedData['ACK'] = 'FAILED';
				}
				else
				{
					foreach ($listing_data as $key) {
						$this->InsertPurchaseData($key['user_id'],array('user_membership_id'=>$key['listing_id'],'user_membership_timestamp'=>date('Y-m-d H:i:s'),'listing_type'=>$key['listing_type'],'user_membership_timestamp_expiry'=> date("Y-m-d" , strtotime(date("Y-m-d",strtotime(date('Y-m-d H:i:s')))."+ ".$key['period']."day")),'plan_header'=>$key['plan_header']));
					}

					$url 	= base_url().PAYMENT_SUCCESS;
					$this->success($paypal_data,'');
					return;
				}
			}

			if($returnedData['ACK'] ==='Success'){
				$this->AddPaymentData($returnedData,$paypal_data);
				if($type === 'outside'){
					$this->InsertDomainPurchaseData($paypal_data['user_id'],$paypal_data);
				}
				else
				{
					foreach ($listing_data as $key) {
						$this->InsertPurchaseData($key['user_id'],array('user_membership_id'=>$key['listing_id'],'user_membership_timestamp'=>date('Y-m-d H:i:s'),'listing_type'=>$key['listing_type'],'user_membership_timestamp_expiry'=> date("Y-m-d" , strtotime(date("Y-m-d",strtotime(date('Y-m-d H:i:s')))."+ ".$key['period']."day")),'plan_header'=>$key['plan_header']));
					}
				}
				$url 	= base_url().PAYMENT_SUCCESS;
				$this->success($paypal_data,$returnedData);
			}
			else if($returnedData['ACK'] ==='SuccessWithWarning'){
				$this->AddPaymentData($returnedData,$paypal_data);
				if($type === 'outside'){
					$this->InsertDomainPurchaseData($paypal_data['user_id'],$paypal_data);  
				}
				else
				{
					foreach ($listing_data as $key) {
						$this->InsertPurchaseData($key['user_id'],array('user_membership_id'=>$key['listing_id'],'user_membership_timestamp'=>date('Y-m-d H:i:s'),'listing_type'=>$key['listing_type'],'user_membership_timestamp_expiry'=> date("Y-m-d" , strtotime(date("Y-m-d",strtotime(date('Y-m-d H:i:s')))."+ ".$key['period']."day")),'plan_header'=>$key['plan_header']));
					}
				}
				$url 	= base_url().PAYMENT_SUCCESS;
				$this->success($paypal_data,$returnedData);
			}
			else
			{
				$url 	= base_url().PAYMENT_FAIL;
				$this->fail($paypal_data,$returnedData);
			}
		}

	} 

	/*Open Direct Contract*/
    public function open_direct_contract($listing_id){
        if(!empty($listing_id)){
        	$this->database->_update_to_table('tbl_opens',array('status'=>7),array('listing_id'=>$listing_id,'status'=>0));
            $listing    =  $this->database->_get_row_data('tbl_listings',array('id'=>$listing_id));
            $data = array(
            	'contract_id' =>$this->database->_unique_id('tbl_opens','alnum','contract_id'),
            	'listing_id' => $listing_id,
            	'bid_id' => 'direct',
            	'type' => 'direct',
            	'customer_id' => $this->session->userdata('user_id'),
            	'owner_id' => $listing[0]['user_id'],
            	'delivery_time' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " + ".$listing[0]['deliver_in']." day")),
            	'delivery' =>$listing[0]['deliver_in'],
            	'status' => 1,
            	'date' => date('Y-m-d H:i:s')
            );
            return $this->database->_insert_to_DB('tbl_opens',$data);
        }
        return;
    }

    /*Insert Listing Purchase Data*/
    public function InsertPurchaseData($user_id,$Arr){
    	$datas = self::$data;
        $data= array(
        	'invoice_id'=>$this->_generate_paymentID('tbl_purchases','invoice_id'),
        	'user_id' =>$user_id,
        	'plan_id' =>$Arr['user_membership_id'],
        	'plan_header' =>$Arr['plan_header'],
        	'listing_type' =>$Arr['listing_type'],
        	'purchase_date'=>$Arr['user_membership_timestamp'],
        	'expire_date'=>$Arr['user_membership_timestamp_expiry']
        );

        /*email notification*/
        if($datas['settings'][0]['email_notifications'] === '1'){
        	$this->email_op->_send_invoice_email('listing',$data,'admin');
        }
        /**/   

        if($this->database->_update_to_DB('tbl_listings',array('status'=>1),$Arr['user_membership_id'])){
            return $this->database->_insert_to_DB('tbl_purchases',$data);
        }
    }


    /*Listing Payment*/
    public function proceedtoPayment(){
	 	if(!empty($this->session->userdata('user_id'))){
			switch ($this->input->post('branch_1_pay_1')) {
				case 'payvia_card':
					$this->PayPal_Pro_int();
        			break;
    			case 'payvia_paypal':    			
        			$this->PayPal_Express_int();
       	 			break;
       	 		case 'payvia_stripe':    			
        			$this->Stripe_int();
       	 			break;
       	 		case 'free_checkout':    			
        			$this->free_checkout();
       	 			break;
    			default:
    				return ;
			}
		}
		else
		{
			$data['errors'] = 'Your login session has expired. Please login to continue';
			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('main/checkout',$data);
			return;
		}
	}


	/*Free Checkout*/
	public function free_checkout(){
		$ListingDataArr = array();
		if(!empty($this->session->userdata('user_id'))){	
			$ListingDataHeader 	= $this->database->_get_row_data('tbl_listing_header',array('listing_id'=>$this->input->post('txt_payid')));
			$ListingData 		= $this->database->_get_row_data('tbl_listings',array('id'=>$this->input->post('txt_listingid')));
			$userdata 			= $this->database->getUserData($this->session->userdata('user_id'));
			$payment_id  		= $this->_generate_paymentID();
			$totalAmount		= 0;

			$listing_type      	= $ListingDataHeader[0]['listing_type'];
			$totalAmount		= $ListingDataHeader[0]['listing_price'];	

			if(!empty($this->input->post('txt_sponsored_id'))){
				$sponsoredArr 			= $this->database->_get_row_data('tbl_listing_header',array('listing_id'=>$this->input->post('txt_sponsored_id')));
				if(isset($sponsoredArr[0]['listing_price'])){
					$sponsored 			= $sponsoredArr[0]['listing_price'];
					$totalAmount 		= floatval($sponsored)+floatval($ListingDataHeader[0]['listing_price']);
					$listing_type      	= $ListingDataHeader[0]['listing_type'].' & '.$sponsoredArr[0]['listing_type'];					
				}

				$ListingDataArr[0] = array(
				'user_id' => $userdata[0]['user_id'],
				'user_email' =>$userdata[0]['email'],
				'user_username' =>$userdata[0]['username'],
				'listing_id' => $ListingData[0]['id'],
				'plan_header' => $sponsoredArr[0]['listing_id'],
				'listing_type' => $sponsoredArr[0]['listing_type'],
				'amount' => number_format($totalAmount, 2,'.',''),
				'period' =>$sponsoredArr[0]['listing_duration'],
				'transactionId'=>$payment_id,
				'description' => 'Listing :'.$listing_type,
				'currency'=>'USD',
				'payment_method'=>'FREE',
				'clientIp'=>$this->input->ip_address(),
				'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN.'/free',
				'cancelUrl'=> base_url().PAYMENT_CANCEL
				);
			}

			$valTransc[0] = array(
			'user_id' => $userdata[0]['user_id'],
			'user_email' =>$userdata[0]['email'],
			'user_username' =>$userdata[0]['username'],
			'listing_id' => $ListingData[0]['id'],
			'plan_header' => $ListingDataHeader[0]['listing_id'],
			'listing_type' => $ListingDataHeader[0]['listing_type'],
			'amount' => number_format($totalAmount, 2,'.',''),
			'period' =>$ListingDataHeader[0]['listing_duration'],
			'transactionId'=>$payment_id,
			'description' => 'Listing :'.$listing_type,
			'currency'=>'USD',
			'payment_method'=>'FREE',
			'clientIp'=>$this->input->ip_address(),
			'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN.'/free',
			'cancelUrl'=> base_url().PAYMENT_CANCEL
			);

			$cardInput = array(
			'firstName'=>'',
			'lastName'=>'',
			'number'=>'',
			'cvv'=>'',
			'expiryMonth'=>'',
			'expiryYear'=>'',
			'email'=>''
			);

			try
			{
				$this->session->set_userdata('paypal_data', $valTransc[0]);
				$this->session->set_userdata('listing_data', array_merge($ListingDataArr,$valTransc));
				header( "Location: ".base_url().PAYMENT_PAYPAL_RETURN.'/free' ); 
			}
			catch (Exception $e)
			{
    			$url 	= base_url().PAYMENT_FAIL;
    			$this->fail($valTransc);
			} 
		}
	}

	/*Paypal Express Listings*/
	public function PayPal_Express_int(){	
		$ListingDataArr = array();
		if(!empty($this->session->userdata('user_id'))){	
			$ListingDataHeader 	= $this->database->_get_row_data('tbl_listing_header',array('listing_id'=>$this->input->post('txt_payid')));
			$ListingData 		= $this->database->_get_row_data('tbl_listings',array('id'=>$this->input->post('txt_listingid')));
			$userdata 			= $this->database->getUserData($this->session->userdata('user_id'));
			$payment_id  		= $this->_generate_paymentID();
			$totalAmount		= 0;

			$listing_type      	= $ListingDataHeader[0]['listing_type'];
			$totalAmount		= $ListingDataHeader[0]['listing_price'];	

			if(!empty($this->input->post('txt_sponsored_id'))){
				$sponsoredArr 			= $this->database->_get_row_data('tbl_listing_header',array('listing_id'=>$this->input->post('txt_sponsored_id')));
				if(isset($sponsoredArr[0]['listing_price'])){
					$sponsored 			= $sponsoredArr[0]['listing_price'];
					$totalAmount 		= floatval($sponsored)+floatval($ListingDataHeader[0]['listing_price']);
					$listing_type      	= $ListingDataHeader[0]['listing_type'].' & '.$sponsoredArr[0]['listing_type'];					
				}

				$ListingDataArr[0] = array(
				'user_id' => $userdata[0]['user_id'],
				'user_email' =>$userdata[0]['email'],
				'user_username' =>$userdata[0]['username'],
				'listing_id' => $ListingData[0]['id'],
				'plan_header' => $sponsoredArr[0]['listing_id'],
				'listing_type' => $sponsoredArr[0]['listing_type'],
				'amount' => number_format($totalAmount, 2,'.',''),
				'period' =>$sponsoredArr[0]['listing_duration'],
				'transactionId'=>$payment_id,
				'description' => 'Listing :'.$listing_type,
				'currency'=>'USD',
				'payment_method'=>'PAYPAL',
				'clientIp'=>$this->input->ip_address(),
				'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN.'/sponsored',
				'cancelUrl'=> base_url().PAYMENT_CANCEL
				);
			}

			$valTransc[0] = array(
			'user_id' => $userdata[0]['user_id'],
			'user_email' =>$userdata[0]['email'],
			'user_username' =>$userdata[0]['username'],
			'listing_id' => $ListingData[0]['id'],
			'plan_header' => $ListingDataHeader[0]['listing_id'],
			'listing_type' => $ListingDataHeader[0]['listing_type'],
			'amount' => number_format($totalAmount, 2,'.',''),
			'period' =>$ListingDataHeader[0]['listing_duration'],
			'transactionId'=>$payment_id,
			'description' => 'Listing :'.$listing_type,
			'currency'=>'USD',
			'payment_method'=>'PAYPAL',
			'clientIp'=>$this->input->ip_address(),
			'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN.'/sponsored',
			'cancelUrl'=> base_url().PAYMENT_CANCEL
			);

			$cardInput = array(
			'firstName'=>'',
			'lastName'=>'',
			'number'=>'',
			'cvv'=>'',
			'expiryMonth'=>'',
			'expiryYear'=>'',
			'email'=>''
			);

			try
			{
				$purchaseProc = new paymentgateway('PayPal_Express',true);
				$this->session->set_userdata('paypal_data', $valTransc[0]);
				$this->session->set_userdata('listing_data', array_merge($ListingDataArr,$valTransc));
				$data 	= $purchaseProc->sendPurchaseExpress($cardInput,$valTransc[0]);
				$url 	= $data;
				header( "Location: $url" ); 
			}
			catch (Exception $e)
			{
    			$url 	= base_url().PAYMENT_FAIL;
    			$this->fail($valTransc);
			} 
		}
	}

    /*Paypal Pro Listings*/
	public function PayPal_Pro_int(){
		$settings_data 	= $this->database->getSettingsData();
		$currency 		= 'USD';
		$ListingDataArr = array();
		if(!empty($settings_data[0]['default_currency'])) {
			$currency = $settings_data[0]['default_currency'];
		}

		if(!empty($this->session->userdata('user_id'))){	
			$itemsArr 			= array();
			$payment_id  		= $this->_generate_paymentID();
			$ListingDataHeader 	= $this->database->_get_row_data('tbl_listing_header',array('listing_id'=>$this->input->post('txt_payid')));
			$ListingData 		= $this->database->_get_row_data('tbl_listings',array('id'=>$this->input->post('txt_listingid')));
			$userdata 			= $this->database->getUserData($this->session->userdata('user_id'));
			$totalAmount		= 0;

			$listing_type      	= $ListingDataHeader[0]['listing_type'];
			$totalAmount		= $ListingDataHeader[0]['listing_price'];
		}

		if(!empty($this->input->post('txt_listingid')) && !empty($ListingData)){
			$redirectURL = base_url().'user/create_listings/'.$ListingData[0]['listing_type'].'/'.$ListingData[0]['id'];
			$this->session->set_userdata('url',$redirectURL);
		}

		if(!empty($userdata)){

			if(!empty($this->input->post('txt_sponsored_id'))){
				$sponsoredArr 			= $this->database->_get_row_data('tbl_listing_header',array('listing_id'=>$this->input->post('txt_sponsored_id')));
				if(isset($sponsoredArr[0]['listing_price'])){
					$sponsored 			= $sponsoredArr[0]['listing_price'];
					$totalAmount 		= floatval($sponsored)+floatval($ListingDataHeader[0]['listing_price']);
					$listing_type      	= $ListingDataHeader[0]['listing_type'].' & '.$sponsoredArr[0]['listing_type'];					
				}

				$ListingDataArr[0] = array(
				'user_id' => $userdata[0]['user_id'],
				'user_email' =>$userdata[0]['email'],
				'user_username' =>$userdata[0]['username'],
				'listing_id' => $ListingData[0]['id'],
				'plan_header' => $sponsoredArr[0]['listing_id'],
				'listing_type' => $sponsoredArr[0]['listing_type'],
				'amount' => number_format($totalAmount, 2,'.',''),
				'period' =>$sponsoredArr[0]['listing_duration'],
				'transactionId'=>$payment_id,
				'description' => 'Listing :'.$listing_type,
				'currency'=>'USD',
				'payment_method'=>'PAYPAL',
				'clientIp'=>$this->input->ip_address(),
				'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN.'/sponsored',
				'cancelUrl'=> base_url().PAYMENT_CANCEL
				);
			}

			$valTransc[0] = array(
				'user_id' => $userdata[0]['user_id'],
				'user_email' =>$userdata[0]['email'],
				'user_username' =>$userdata[0]['username'],
				'listing_id' => $ListingData[0]['id'],
				'plan_header' => $ListingDataHeader[0]['listing_id'],
				'listing_type' => $ListingDataHeader[0]['listing_type'],
				'amount' => number_format($totalAmount, 2,'.',''),
				'period' =>$ListingDataHeader[0]['listing_duration'],
				'transactionId'=>$payment_id,
				'description' => 'Listing :'.$listing_type,
				'currency'=>'USD',
				'payment_method'=>'PAYPAL',
				'clientIp'=>$this->input->ip_address(),
				'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN.'/sponsored',
				'cancelUrl'=> base_url().PAYMENT_CANCEL
			);

			$cardInput = array(
				'firstName'=>$this->input->post('name'),
				'lastName'=>'',
				'number'=>$this->input->post('number'),
				'cvv'=>$this->input->post('security-code'),
				'expiryMonth'=>$this->input->post('txt_month'),
				'expiryYear'=>$this->input->post('txt_year'),
				'email'=> $this->input->post('txt_useremail')
			);

			try{

				try{
					$purchaseProc = new paymentgateway('PayPal_Pro',true);
					$this->session->set_userdata('paypal_data', $valTransc[0]);
					$this->session->set_userdata('listing_data', array_merge($ListingDataArr,$valTransc));
					$data 	= $purchaseProc->sendPurchase($cardInput,$valTransc[0]);
					if(isset($data['ACK']) && $data['ACK'] == 'Success'){
						$this->session->set_userdata('paypal_data', $valTransc[0]);
						$this->direct_payments($data,$valTransc[0],'internal','PayPal Pro');
						$url 	= base_url().PAYMENT_SUCCESS;
						$this->session->unset_userdata('listing_data');
						$this->success($valTransc[0],$data);
					}
					else
					{
						$url 	= base_url().PAYMENT_FAIL;
    					$this->fail($valTransc[0],$data);
					}
				}
				catch (Exception $e){
    				$url 	= base_url().PAYMENT_FAIL;
    				$this->fail($valTransc[0]);
				} 
			}
			catch (Exception $e)
			{
				if(!empty($this->session->userdata('user_id'))){
					$data = self::$data;
					$data['errors'] = 	$e->getMessage();
					$this->session->set_userdata('errors',$data['errors']);
					redirect($this->session->set_userdata('url'));
					return;
				}
				redirect('login');
			}
		}	   
	}

	 /*Paypal Pro Listings*/
	public function Stripe_int(){
		$settings_data 	= $this->database->getSettingsData();
		$currency 		= 'USD';
		$ListingDataArr = array();
		if(!empty($settings_data[0]['default_currency'])) {
			$currency = $settings_data[0]['default_currency'];
		}

		if(!empty($this->session->userdata('user_id'))){	
			$itemsArr 			= array();
			$payment_id  		= $this->_generate_paymentID();
			$ListingDataHeader 	= $this->database->_get_row_data('tbl_listing_header',array('listing_id'=>$this->input->post('txt_payid')));
			$ListingData 		= $this->database->_get_row_data('tbl_listings',array('id'=>$this->input->post('txt_listingid')));
			$userdata 			= $this->database->getUserData($this->session->userdata('user_id'));
			$totalAmount		= 0;

			$listing_type      	= $ListingDataHeader[0]['listing_type'];
			$totalAmount		= $ListingDataHeader[0]['listing_price'];
		}

		if(!empty($this->input->post('txt_listingid')) && !empty($ListingData)){
			$redirectURL = base_url().'user/create_listings/'.$ListingData[0]['listing_type'].'/'.$ListingData[0]['id'];
			$this->session->set_userdata('url',$redirectURL);
		}

		if(!empty($userdata)){

			if(!empty($this->input->post('txt_sponsored_id'))){
				$sponsoredArr 			= $this->database->_get_row_data('tbl_listing_header',array('listing_id'=>$this->input->post('txt_sponsored_id')));
				if(isset($sponsoredArr[0]['listing_price'])){
					$sponsored 			= $sponsoredArr[0]['listing_price'];
					$totalAmount 		= floatval($sponsored)+floatval($ListingDataHeader[0]['listing_price']);
					$listing_type      	= $ListingDataHeader[0]['listing_type'].' & '.$sponsoredArr[0]['listing_type'];					
				}

				$ListingDataArr[0] = array(
				'user_id' => $userdata[0]['user_id'],
				'user_email' =>$userdata[0]['email'],
				'user_username' =>$userdata[0]['username'],
				'listing_id' => $ListingData[0]['id'],
				'plan_header' => $sponsoredArr[0]['listing_id'],
				'listing_type' => $sponsoredArr[0]['listing_type'],
				'amount' => number_format($totalAmount, 2,'.',''),
				'period' =>$sponsoredArr[0]['listing_duration'],
				'transactionId'=>$payment_id,
				'description' => 'Listing :'.$listing_type,
				'currency'=>'USD',
				'payment_method'=>'PAYPAL',
				'clientIp'=>$this->input->ip_address(),
				'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN.'/sponsored',
				'cancelUrl'=> base_url().PAYMENT_CANCEL
				);
			}

			$valTransc[0] = array(
				'user_id' => $userdata[0]['user_id'],
				'user_email' =>$userdata[0]['email'],
				'user_username' =>$userdata[0]['username'],
				'listing_id' => $ListingData[0]['id'],
				'plan_header' => $ListingDataHeader[0]['listing_id'],
				'listing_type' => $ListingDataHeader[0]['listing_type'],
				'amount' => number_format($totalAmount, 2,'.',''),
				'period' =>$ListingDataHeader[0]['listing_duration'],
				'transactionId'=>$payment_id,
				'description' => 'Listing :'.$listing_type,
				'currency'=>'USD',
				'payment_method'=>'PAYPAL',
				'clientIp'=>$this->input->ip_address(),
				'returnUrl'=> base_url().PAYMENT_PAYPAL_RETURN.'/sponsored',
				'cancelUrl'=> base_url().PAYMENT_CANCEL
			);

			$cardInput = array(
				'firstName'=>$this->input->post('name'),
				'lastName'=>'',
				'number'=>$this->input->post('number'),
				'cvv'=>$this->input->post('security-code'),
				'expiryMonth'=>$this->input->post('txt_month'),
				'expiryYear'=>$this->input->post('txt_year'),
				'email'=> $this->input->post('txt_useremail')
			);

			try{

				try{
					$purchaseProc = new paymentgateway('Stripe',true);
					$this->session->set_userdata('paypal_data', $valTransc[0]);
					$this->session->set_userdata('listing_data', array_merge($ListingDataArr,$valTransc));
					$tempdata 	= $purchaseProc->completePurchaseStripe($cardInput,$valTransc[0]);
					if(isset($tempdata['status']) && $tempdata['status'] == 'succeeded'){

						$data = array(
							'TRANSACTIONID'=>$tempdata['id'],
							'ACK'=>$tempdata['status'],
							'CORRELATIONID'=>$tempdata['source']['fingerprint'],
        					'PAYER_ID'=>$tempdata['source']['last4']
						);
						
						$this->session->set_userdata('paypal_data', $valTransc[0]);
						$this->direct_payments($data,$valTransc[0],'internal','Stripe');
						$url 	= base_url().PAYMENT_SUCCESS;
						$this->session->unset_userdata('listing_data');
						$this->success($valTransc[0],$data);
					}
					else
					{
						$url 	= base_url().PAYMENT_FAIL;
    					$this->fail($valTransc[0],$tempdata);
					}
				}
				catch (Exception $e){
    				$url 	= base_url().PAYMENT_FAIL;
    				$this->fail($valTransc[0]);
				} 
			}
			catch (Exception $e)
			{
				if(!empty($this->session->userdata('user_id'))){
					$data = self::$data;
					$data['errors'] = 	$e->getMessage();
					$this->session->set_userdata('errors',$data['errors']);
					redirect($this->session->set_userdata('url'));
					return;
				}
				redirect('login');
			}
		}	   
	}

	/*Unique Payment ID Generation*/
	private function _generate_paymentID($table='tbl_payments',$column='id'){
        do{
            $salt = base_convert(bin2hex($this->security->get_random_bytes(64)), 16, 36);
            if ($salt === FALSE){
                $salt = hash('sha256', time() . mt_rand());
            }
            $new_key = substr($salt, 0, 10);
        }
        while ($this->database->_results_count($table,array($column=>$new_key)));
        return $new_key;
    }

    /*Success Return*/
    public function success($data,$returned){
		$DATA['PAYMENT'] 	= $data;
		$DATA['RETURNED']	= $returned;
		$DATA = html_escape($this->security->xss_clean($DATA));
		$this->load->view('payments/success',$DATA);
	}

	/*Fail Return*/
	public function fail($data,$reason=''){
		$DATA['PAYMENT'] 	= $data;
		$DATA['REASON'] 	= $reason;
		$DATA = html_escape($this->security->xss_clean($DATA));
		$this->load->view('payments/fail',$DATA);
	}

	/*Cancel Return*/
	public function cancel(){
		$this->load->view('payments/cancel');
	}

	/*Add Payments Data*/
    public function AddPaymentData($data,$sessiondata){
        $data= array(
        'PAYMENT_ID' =>$sessiondata['transactionId'],
        'AMOUNT' =>$data['PAYMENTINFO_0_AMT'],
        'METHOD' =>$data['PAYMENTINFO_0_TRANSACTIONTYPE'],
        'ACK'=>$data['ACK'],
        'USER_ID'=>$sessiondata['user_id'],
        'PLAN_ID'=>$sessiondata['listing_id'],
        'TOKEN'=>$data['TOKEN'],
        'PAYMENTINFO_0_TRANSACTIONID'=>$data['PAYMENTINFO_0_TRANSACTIONID'],
        'CORRELATIONID'=>$data['CORRELATIONID'],
        'PAYER_ID'=>$data['CORRELATIONID'],
        'PAYMENTINFO_0_TRANSACTIONTYPE'=>$data['PAYMENTINFO_0_TRANSACTIONTYPE'],
        'PAYMENTINFO_0_FEEAMT'=>$data['PAYMENTINFO_0_FEEAMT'],
        'PAYMENTINFO_0_PAYMENTTYPE'=>$data['PAYMENTINFO_0_PAYMENTTYPE'],
        'PAYMENTINFO_0_TAXAMT'=>$data['PAYMENTINFO_0_TAXAMT']
        );
        $this->database->_insert_to_DB('tbl_payments', $data);    
    }

}
