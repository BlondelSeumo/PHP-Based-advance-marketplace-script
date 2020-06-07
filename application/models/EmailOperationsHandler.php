<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailOperationsHandler extends CI_Model
{
	private static $data = array();

  function __construct() {
    $this->load->database();
    parent::__construct();
    $this->load->helper(array('helperssl'));
    $this->load->model('chat/ChatOperationsHandler', 'chat');
    $this->load->model('DatabaseOperationsHandler', 'database');
    $this->load->model('CommonOperationsHandler', 'common');

    /*Load Defaults*/
    self::$data['settings']               =   $this->database->getSettingsData();
    self::$data['languages']              =   $this->database->load_all_languages();
    self::$data['default_currency']       =   $this->common->getCurrency('USD','symbol');
    self::$data['selectedLanguage']       =   $this->common->is_language();
    self::$data['imagesData']             =   $this->database->_get_row_data('tbl_siteimages',array('id'=>1));
    self::$data['email']                  =   $this->database->_get_row_data('tbl_email_settings',array('id'=>1));


    /*email configuration*/
    $this->load->library('email');
    $config = array();
    $config['protocol']   = self::$data['email'][0]['mail_sending_option']; 
    $config['smtp_host']  = self::$data['email'][0]['mail_smtp_server'];
    $config['smtp_user']  = self::$data['email'][0]['mail_smtp_user'];  
    $config['smtp_pass']  = self::$data['email'][0]['mail_smtp_password']; 
    $config['smtp_port']  = self::$data['email'][0]['mail_smtp_port'];   
    $config['mailtype']   = 'html';   
    $config['charset']    = 'iso-8859-1';
    $this->email->initialize($config);
  }

	public function getEmailTemplate($email,$token,$templates){
      $data = array();
    	$template             = $this->load->view($templates, $data, TRUE);
      $settingsData         = $this->DatabaseOperationsHandler->getSettingsData();
      $imageData            = $this->DatabaseOperationsHandler->_get_row_data('tbl_siteimages',array('id'=>1));
    	$data['template']     = $template;

      $data['sitename']       = $settingsData[0]['title'];

      $data['facebook']       = $settingsData[0]['user_facebook'];
      $data['instagram']      = $settingsData[0]['user_twitter'];
      $data['twitter']        = $settingsData[0]['user_Instagram'];
      $data['gihub']          = $settingsData[0]['user_github'];

      if(isset($imageData['sitelogo']) && !empty($imageData['sitelogo'])){
        $data['logo']         = base_url().'assets/img/'.$imageData['sitelogo'];
      }
      else
      {
        $data['logo']         = "n/a";
      }

      if($templates === 'templates/confirmation_email.tpl'){
        $data['activation_link'] = base_url().'activate/'.$token;
      }
      else
      {
        $data['activation_link'] = base_url().'reset/'.$token;
      }

    	$emptyCheck  = trim($data['template']);

    	if(isset($data['template']) && !empty($emptyCheck))
    	{
        	foreach($data as $key => $value)
        	{
            	$template = str_replace('{{ '.$key.' }}', $value, $template);
        	}

        	return $template;
    	}
    	else
    	{
        	return 'false';
    	}

    	return $template;
  	}

    public function buildPurchaseEmailTemplate($email,$data,$template){
      $settingsData   = $this->DatabaseOperationsHandler->getSettingsData();
      $imageData      = $this->DatabaseOperationsHandler->_get_row_data('tbl_siteimages',array('id'=>1));
      $template       = $this->load->view($template, $data, TRUE);

      $data['template']       = $template;
      $data['date']           = date('Y-m-d');
      $data['expireDate']     = date("Y-m-d" , strtotime(date("Y-m-d",strtotime(date('Y-m-d H:i:s')))."+ ".$data['period']."day"));
      $data['plan']           = $membershipData[0]['membership_name'] .'- ('.$membershipData[0]['membership_price'].' '.$data['currency'] .' )' ;
      $data['pmethod']        = $data['payment_method'];
      $data['sitename']       = $settingsData[0]['title'];

      $data['facebook']       = $settingsData[0]['user_facebook'];
      $data['instagram']      = $settingsData[0]['user_twitter'];
      $data['twitter']        = $settingsData[0]['user_Instagram'];
      $data['gihub']          = $settingsData[0]['user_github'];

      if(isset($imageData['sitelogo']) && !empty($imageData['sitelogo'])){
        $data['logo']         = base_url().'assets/img/'.$imageData['sitelogo'];
      }
      else
      {
        $data['logo']         = "n/a";
      }

      $emptyCheck=trim($data['template']);

      if(isset($data['template']) && !empty($emptyCheck))
      {
          foreach($data as $key => $value)
          {
              $template = str_replace('{{ '.$key.' }}', $value, $template);
          }

          return $template;
      }
      else
      {
          return 'false';
      }

      return $template;
    }

   	public function sendUserActivationmail($email,$token){
      $datas  = self::$data;
      $emailBody = $this->getEmailTemplate($email,$token,'templates/confirmation_email.tpl');

      $this->email->to($email);
      if(isset($datas['settings'][0]['admin_email_copy'])){
        $this->email->bcc($datas['settings'][0]['admin_email_copy']);
      }
      
      $this->email->from($datas['email'][0]['site_email_name'].' - '.$datas['email'][0]['site_email']);
      $this->email->subject('Account Activation (Required)');
      $this->email->message($emailBody);

      if($this->email->send())
      {
        $this->email->print_debugger();
      }
      else
      {
        $this->email->print_debugger();
      }
    }

    public function sendPasswordResetEmail($email,$token){
      $datas  = self::$data;
      $emailBody = $this->getEmailTemplate($email,$token,'templates/reset_email.tpl');

      $this->email->to($email);
      if(isset($datas['settings'][0]['admin_email_copy']))
      {
        $this->email->bcc($datas['settings'][0]['admin_email_copy']);
      }
      $this->email->from($datas['email'][0]['site_email_name'].' - '.$datas['email'][0]['site_email']);
      $this->email->subject('Password Reset');
      $this->email->message($emailBody);

      if($this->email->send())
      {
        $this->email->print_debugger();
      }
      else
      {
        $this->email->print_debugger();
      }
    }

    public function _send_invoice_email($type,$tempdata,$meth=''){
      $datas  = self::$data;

      $data['siteurl']        = base_url();
      $data['contact_us']     = base_url().'contact';
      $data['date']           = date('Y-m-d');
      $data['sitename']       = $this->lang->line('site_name');
      $data['logo']           = base_url().ADMIN_IMAGES.$datas['imagesData'][0]['sitelogo'];
      $data['facebook']       = $datas['settings'][0]['user_facebook'];
      $data['twitter']        = $datas['settings'][0]['user_Instagram'];
      $data['office_add1']    = $datas['settings'][0]['office_add1'];
      $data['office_add2']    = $datas['settings'][0]['office_add2'];
      $data['office_tel']     = $datas['settings'][0]['office_tel'];
      $data['office_email']   = $datas['settings'][0]['office_email'];
      $data['currency']       = $datas['default_currency'];

      switch ($type) {
          case 'payment':
          if(!empty($tempdata)){
            $emailtemp              = 'templates/invoice_email.tpl'; 
            $customer               = $this->database->getUserData($tempdata['user_id']);   
            $listing                = $this->database->_get_row_data('tbl_listings',array('id'=>$tempdata['listing_id']),true);
            $data['customer_name']  = $customer[0]['username'];
            $recipient              = $customer[0]['email'];
            $data['invoice']        = $tempdata['transactionId'];
            $data['subject']        = 'We have received your payment';
            $data['detail']         = 'Amount '.$data['currency'].$tempdata['amount'].' has been charged for the following invoice '.$tempdata['transactionId'];
            $data['template']       = $this->load->view('templates/invoice_email.tpl', $data, TRUE);
            $template               = $data['template']; 
            $data['header_domain']  = 'Domain/Website';
            $data['domain']         = $listing[0]['website_BusinessName'];
            $data['header_qty']     = 'TYPE';
            $data['type']           = $listing[0]['listing_type'];
            $data['amount']         = $data['currency'].$tempdata['amount'];
            $this->_email_creator($data,$template,$recipient,$data['subject']);
            
            if($meth === 'direct'){
              $this->_user_email_notification('direct-purchase',$tempdata);
              $this->_user_email_notification('notify-owner',$tempdata);
            }
            else
            {
              $this->_user_email_notification('notify-owner',$tempdata);
            }
          }
          break;
          case 'listing':
          if(!empty($tempdata)){
            $emailtemp              = 'templates/invoice_email.tpl'; 
            $customer               = $this->database->getUserData($tempdata['user_id']);   
            $listing                = $this->database->_get_row_data('tbl_listing_header',array('listing_id'=>$tempdata['plan_header']),true);
            $data['customer_name']  = $customer[0]['username'];
            $recipient              = $customer[0]['email'];
            $data['invoice']        = $tempdata['invoice_id'];
            $data['subject']        = 'We have activated your listing';
            $data['detail']         = 'Amount '.$data['currency'].$listing[0]['listing_price'].' has been charged for the following invoice '.$tempdata['invoice_id'];
            $data['template']       = $this->load->view('templates/invoice_email.tpl', $data, TRUE);
            $template               = $data['template']; 
            $data['header_domain']  = 'LISTING TYPE';
            $data['domain']         = $listing[0]['listing_name'];
            $data['header_qty']     = 'VALIDITY PERIOD';
            $data['type']           = date('F d Y',strtotime($tempdata['purchase_date'])) .' - '.date('F d Y',strtotime($tempdata['expire_date']));
            $data['amount']         = $data['currency'].$listing[0]['listing_price'];
            $this->_email_creator($data,$template,$recipient,$data['subject']);
          }
          break;
      }
    }

    /*Send contact email*/
    public function _send_contact_email(){
      $data  = self::$data;
      $this->email->to($data['settings'][0]['office_email']);
      if(isset($data['settings'][0]['admin_email'])){
        $this->email->bcc($data['settings'][0]['admin_email']);
      }
      
      $this->email->from($this->input->post('contact_email'));
      $this->email->subject($this->lang->line('site_name').' Contact Form -'.$this->input->post('contact_subject'));
      $this->email->message($this->input->post('contact_msg'));

      if($this->email->send()){
        return true;
      }
      else
      {
        return $this->email->print_debugger();
      }
    }

    /*Admin Email Notifications*/
    public function _admin_email_notification($notification,$tempdata){
      $datas  = self::$data;

      $data['siteurl']        = base_url();
      $data['date']           = date('Y-m-d');
      $data['sitename']       = $this->lang->line('site_name');
      $data['logo']           = base_url().ADMIN_IMAGES.$datas['imagesData'][0]['sitelogo'];
      $data['facebook']       = $datas['settings'][0]['user_facebook'];
      $data['twitter']        = $datas['settings'][0]['user_Instagram'];
      $data['office_add1']    = $datas['settings'][0]['office_add1'];
      $data['office_add2']    = $datas['settings'][0]['office_add2'];
      $data['office_tel']     = $datas['settings'][0]['office_tel'];
      $data['office_email']   = $datas['settings'][0]['office_email'];
      $data['currency']       = $datas['default_currency'];

      if(!empty($notification)){
        switch ($notification) {
          case 'withdraw-request':
            $emailtemp          = 'templates/notification_email.tpl'; 
            $customer           = $this->database->getUserData($tempdata['user_id']);
            $data['subject']    = 'You have received a new withdrawal request!';
            $data['detail']     = 'You have received a withdrawal request from '.$customer[0]['username'].' withdrawal amount after fee deduction of <b> '.$data['currency'].$tempdata['fee'].'</b> is as follows ';
            $data['amount']     = $tempdata['final_amount'];
            $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE); 
            $template           = $data['currency'].$data['template'];
            $recipient          = $data['office_email'];
            break;
          }
      }

      $emptyCheck  = trim($data['template']);
      if(!empty($data['template']) && !empty($emptyCheck)){
        foreach($data as $key => $value){
          $template = str_replace('{{ '.$key.' }}', $value, $template);
        }
        return $this->_send_email($recipient,$data['subject'],$template);
      }
        return;
    }

    /*User Email Notifications*/
    public function _user_email_notification($notification,$tempdata){
      $datas  = self::$data;

      $data['siteurl']        = base_url();
      $data['date']           = date('Y-m-d');
      $data['sitename']       = $this->lang->line('site_name');
      $data['logo']           = base_url().ADMIN_IMAGES.$datas['imagesData'][0]['sitelogo'];
      $data['facebook']       = $datas['settings'][0]['user_facebook'];
      $data['twitter']        = $datas['settings'][0]['user_Instagram'];
      $data['office_add1']    = $datas['settings'][0]['office_add1'];
      $data['office_add2']    = $datas['settings'][0]['office_add2'];
      $data['office_tel']     = $datas['settings'][0]['office_tel'];
      $data['office_email']   = $datas['settings'][0]['office_email'];
      $data['currency']       = $datas['default_currency'];

      if(!empty($notification)){
        switch ($notification) {
          case 'place-bid':
            $emailtemp          = 'templates/notification_email.tpl'; 
            $customer           = $this->database->getUserData($tempdata['bidder_id']);
            $owner              = $this->database->getUserData($tempdata['owner_id']);
            $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$tempdata['listing_id']),true);
            $data['subject']    = 'You have received a new Bid!';
            $data['detail']     = 'Congratulations !! You have received a new bid from '.$customer[0]['username'].' for your '.$listing[0]['listing_type'].' listing <b>'.$listing[0]['website_BusinessName'].'</b>';
            $data['amount']     = $tempdata['bid_amount'];
            $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE); 
            $template           = $data['template'];
            $recipient          = $owner[0]['email'];
            
            if($this->database->_check_user_has_pending_bids($tempdata['listing_id'],$tempdata['bidder_id'],'1') > 0){
              $previousbidders    = $this->database->_get_lower_bidders($tempdata['listing_id'],$tempdata['bid_amount'],$tempdata['bidder_id']);
              if(!empty($previousbidders) && count($previousbidders) > 0){
                  $this->_user_bulk_emails($previousbidders,$tempdata['bid_amount'],$tempdata['listing_id']);
              }
            }
            break;
          case 'place-offer':
            $emailtemp          = 'templates/notification_email.tpl';
            $customer           = $this->database->getUserData($tempdata['customer_id']);
            $owner              = $this->database->getUserData($tempdata['owner_id']);
            $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$tempdata['listing_id']),true);
            $data['subject']    = 'You have received a new Offer!';
            $data['detail']     = 'Congratulations !! You have received a new Offer from '.$customer[0]['username'].' for your '.$listing[0]['listing_type'].' listing <b>'.$listing[0]['website_BusinessName'].'</b>';
            $data['amount']     = $tempdata['offer_amount'];
            $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $owner[0]['email'];
            break;
          case 'accept-bidder':
            $emailtemp          = 'templates/notification_email.tpl';
            $bid_info           = $this->database->_get_row_data('tbl_bids',array('id'=>$tempdata['id']),true);
            $customer           = $this->database->getUserData($bid_info[0]['bidder_id']);
            $owner              = $this->database->getUserData($bid_info[0]['owner_id']);
            $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$bid_info[0]['listing_id']),true);
            $data['subject']    = 'Your Bids for '.$listing[0]['website_BusinessName'].' has been approved!';
            $data['detail']     = 'Congratulations !! Your Bids for '.$listing[0]['listing_type'].' listing '.$listing[0]['website_BusinessName'].' has been Approved by the Owner '.$owner[0]['username'].' stay in touch';
            $data['amount']     = $bid_info[0]['bid_amount'];
            $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $customer[0]['email']; 

            if($this->database->_check_user_has_pending_bids($bid_info[0]['listing_id'],$bid_info[0]['bidder_id'],'0') > 0){
              $previousbidders    = $this->database->_get_lower_bidders($bid_info[0]['listing_id'],$bid_info[0]['bid_amount'],$bid_info[0]['bidder_id']);
              if(!empty($previousbidders) && count($previousbidders) > 0){
                  $this->_user_bulk_emails($previousbidders,$bid_info[0]['bid_amount'],$bid_info[0]['listing_id']);
              }
            }
            break;
          case 'reject-bid':
            $emailtemp          = 'templates/notification_email.tpl';
            $bid_info           = $this->database->_get_row_data('tbl_bids',array('id'=>$tempdata['id']),true);
            $customer           = $this->database->getUserData($bid_info[0]['bidder_id']);
            $owner              = $this->database->getUserData($bid_info[0]['owner_id']);
            $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$bid_info[0]['listing_id']),true);
            $data['subject']    = 'Your Bid for '.$listing[0]['website_BusinessName'].' has been rejected!';
            $data['detail']     = 'Oopz Sorry !! Your Bid for '.$listing[0]['listing_type'].' listing '.$listing[0]['website_BusinessName'].' has been Rejected by the Owner '.$owner[0]['username'];
            $data['amount']     = $bid_info[0]['bid_amount'];
            $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $customer[0]['email']; 
            break;
          case 'reject-offer':
            $emailtemp          = 'templates/notification_email.tpl';
            $offer_info         = $this->database->_get_row_data('tbl_offers',array('id'=>$tempdata['id']),true);
            $customer           = $this->database->getUserData($offer_info[0]['customer_id']);
            $owner              = $this->database->getUserData($offer_info[0]['owner_id']);
            $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$offer_info[0]['listing_id']),true);
            $data['subject']    = 'Your Offer for '.$listing[0]['website_BusinessName'].' has been rejected!';
            $data['detail']     = 'Oopz Sorry !! Your Offer for '.$listing[0]['listing_type'].' listing '.$listing[0]['website_BusinessName'].' has been Rejected by the Owner '.$owner[0]['username'];
            $data['amount']     = $offer_info[0]['offer_amount'];
            $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $customer[0]['email']; 
            break;
          case 'accept-offer':
            $emailtemp          = 'templates/notification_email.tpl';
            $offer_info         = $this->database->_get_row_data('tbl_offers',array('id'=>$tempdata['bid_id']),true);
            $customer           = $this->database->getUserData($offer_info[0]['customer_id']);
            $owner              = $this->database->getUserData($offer_info[0]['owner_id']);
            $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$offer_info[0]['listing_id']),true);
            $data['subject']    = 'Your Offer for '.$listing[0]['website_BusinessName'].' has been approved!';
            $data['detail']     = 'Congratulations !! Your Offer for '.$listing[0]['listing_type'].' listing <b>'.$listing[0]['website_BusinessName'].'</b> has been Approved by the Owner '.$owner[0]['username'].' Owner has Opened a new contract with you. Please make the payment to start the contract <b> contract id : #'.$tempdata['contract_id'].'</b>';
            $data['amount']     = $offer_info[0]['offer_amount'];
            $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $customer[0]['email']; 
            break;
          case 'won-bid':
            $emailtemp          = 'templates/notification_email.tpl';
            $bid_info           = $this->database->_get_row_data('tbl_bids',array('id'=>$tempdata['bid_id']),true);
            $customer           = $this->database->getUserData($bid_info[0]['bidder_id']);
            $owner              = $this->database->getUserData($bid_info[0]['owner_id']);
            $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$bid_info[0]['listing_id']),true);
            $data['subject']    = 'Your Bid for '.$listing[0]['website_BusinessName'].' has won!';
            $data['detail']     = 'Congratulations !! Your Bid for '.$listing[0]['listing_type'].' listing <b>'.$listing[0]['website_BusinessName'].'</b> has Won the auction '.$owner[0]['username'].' Owner has Opened a contract with you. Please make the payment to start the contract <b> contract id : #'.$tempdata['contract_id'].'</b>';
            $data['amount']     = $bid_info[0]['bid_amount'];
            $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $customer[0]['email']; 
            break;
          case 'direct-purchase':
            $emailtemp          = 'templates/notification_email.tpl';
            $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$tempdata['listing_id']),true);
            $customer           = $this->database->getUserData($tempdata['user_id']);
            $owner              = $this->database->getUserData($listing[0]['user_id']);
            $contract_id        = $this->database->_get_single_data('tbl_opens',array('id'=>$tempdata['contract_id']),'contract_id');
            $data['subject']    = 'You have purchased '.$listing[0]['website_BusinessName'].'!';
            $data['detail']     = 'Congratulations !! You have succesfully purchased the '.$listing[0]['listing_type'].' <b>'.$listing[0]['website_BusinessName'].'</b> from '.$owner[0]['username'].' Owner has Opened a contract with you for your purchase. <b> contract id : #'.$contract_id.'</b>';
            $data['amount']     = $tempdata['amount'];
            $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $customer[0]['email']; 
            break;
          case 'notify-owner':
            $emailtemp          = 'templates/notification_email.tpl';
            $listing            = $this->database->_get_row_data('tbl_listings',array('id'=>$tempdata['listing_id']),true);
            $customer           = $this->database->getUserData($tempdata['user_id']);
            $owner              = $this->database->getUserData($listing[0]['user_id']);
            $contract_id        = $this->database->_get_single_data('tbl_opens',array('id'=>$tempdata['contract_id']),'contract_id');
            $data['subject']    = $customer[0]['username'].' has purchased '.$listing[0]['website_BusinessName'].'!';
            $data['detail']     = 'Congratulations !! '.$customer[0]['username'].' has succesfully made the payment for '.$listing[0]['listing_type'].' <b>'.$listing[0]['website_BusinessName'].'</b> So make nessacery steps to fulfill the order on or before <b>'.date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " + ".$listing[0]['deliver_in']." day")).'</b> to avoid any cancellations. Please visit contract page for more details. <b> contract id : #'.$contract_id.'</b>';
            $data['amount']     = $tempdata['amount'];
            $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $owner[0]['email']; 
            break;
          case 'mark-delivered':
            $emailtemp          = 'templates/notifications_email.tpl';
            $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
            $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
            $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
            $data['subject']    = $owner[0]['username'].' Marked contract #'.$contract_info[0]['contract_id'].' as delivered!';
            $data['detail']     = $owner[0]['username'].' Marked contract <b>#'.$contract_info[0]['contract_id'].'</b> as delivered! Please review and accept delivery within '.$datas['settings'][0]['mark_as_completed'].' days if not this contract will be marked as completed after '.$datas['settings'][0]['mark_as_completed'].' days.';
            $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $customer[0]['email']; 
            break;
          case 'mark-revision':
            $emailtemp          = 'templates/notifications_email.tpl';
            $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
            $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
            $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
            $data['subject']    = $customer[0]['username'].' has requested a revision!';
            $data['detail']     = $customer[0]['username'].' has requested a revision! So your countdown has begun again. Please complete the <b>#'.$contract_info[0]['contract_id'].'</b> before the deadline';
            $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $owner[0]['email']; 
            break;
          case 'mark-accepted':
            $emailtemp          = 'templates/notifications_email.tpl';
            $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
            $invoice_id         = $this->database->_get_single_data('tbl_contracts',array('contract_id'=>$tempdata),'invoice_id');
            $invoice            = $this->database->_get_row_data('tbl_invoices',array('invoice_id'=>$invoice_id),true);
            $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
            $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
            $data['subject']    = $customer[0]['username'].' accepted your delivery!';
            $data['detail']     = 'Congratulations !! '.$customer[0]['username'].' Marked contract #'.$contract_info[0]['contract_id'].' as completed! <b> contract id : #'.$tempdata['contract_id'].'</b> . Please note that following amount has been now cleared to your account';
            $data['amount']     = $invoice[0]['withdraw_amount'];
            $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $owner[0]['email']; 
            break;
          case 'cancel-contract':
            $emailtemp          = 'templates/notifications_email.tpl';
            $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
            $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
            $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
            $data['subject']    = $customer[0]['username'].' has canceled the contract!';
            $data['detail']     = $customer[0]['username'].' has canceled the contract <b>#'.$contract_info[0]['contract_id'].'</b> You may accept this cancel request and refund or else  reject. However if customer has an issue with your feedback he/she can raise a dispute.';
            $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $owner[0]['email']; 
            break;
          case 'accept-cancel':
            $emailtemp          = 'templates/notifications_email.tpl';
            $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
            $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
            $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
            $data['subject']    = $customer[0]['username'].' has accepted the contract cancel request!';
            $data['detail']     = $customer[0]['username'].' has accepted the contract cancel request <b>#'.$contract_info[0]['contract_id'].'</b> , Funds will be credited back to your account.';
            $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $customer[0]['email']; 
            break;
          case 'reject-cancel':
            $emailtemp          = 'templates/notifications_email.tpl';
            $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
            $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
            $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
            $data['subject']    = $customer[0]['username'].' has rejected the contract cancel request!';
            $data['detail']     = $customer[0]['username'].' has rejected the contract cancel request <b>#'.$contract_info[0]['contract_id'].'</b> , You may raised a dispute. However Admins decision will be the final.';
            $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $customer[0]['email']; 
            break;
          case 'admin-cancel':
            $emailtemp          = 'templates/notifications_email.tpl';
            $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
            $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
            $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
            $data['subject']    = 'Admin has rejected the contract cancel request!';
            $data['detail']     = 'Admin has rejected the contract cancel request <b>#'.$contract_info[0]['contract_id'].'</b> , this contract will be marked as completed.';
            $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $customer[0]['email']; 
          case 'raised-dispute':
            $emailtemp          = 'templates/notifications_email.tpl';
            $contract_info      = $this->database->_get_row_data('tbl_opens',array('id'=>$tempdata),true);
            $customer           = $this->database->getUserData($contract_info[0]['customer_id']);
            $owner              = $this->database->getUserData($contract_info[0]['owner_id']);
            $data['subject']    = $customer[0]['username'].' has raised a dispute';
            $data['detail']     = $customer[0]['username'].' has raised a dispute <b>#'.$contract_info[0]['contract_id'].'</b> , '.$data['sitename'].' will make the final descision';
            $data['template']   = $this->load->view('templates/notifications_email.tpl', $data, TRUE);  
            $template           = $data['template'];
            $recipient          = $owner[0]['email'];
            break;
          case 'withdraw-change':
            $emailtemp          = 'templates/notification_email.tpl';
            $withdraw_info      = $this->database->_get_row_data('tbl_withdrawals',array('id'=>$tempdata['id']),true);
            $withdraw_method    = $this->database->_get_row_data('tbl_withdrawal_methods',array('id'=>$withdraw_info[0]['method']),true);
            $customer           = $this->database->getUserData($withdraw_info[0]['user_id']);
            
            if($tempdata['status'] === '2'){
              $status           =' Approved & Processed';
              $data['detail']   ='Your Withdrawal Request <b>#'.$withdraw_info[0]['withdrawal_id'].'</b> has been '.$status.' & funds have been proccesed via following method  <b>'.$withdraw_method[0]['method'].'</b> . | <b> FEE :'.$data['currency'].$withdraw_info[0]['fee'].'</b> | Withdrawn amount as follows';
            }
            else if($tempdata['status'] === '3'){
              $status           = ' Rejected';
              $data['detail']   = 'Your Withdrawal Request <b>#'.$withdraw_info[0]['withdrawal_id'].'</b> has been '.$status.'. Please contact support for addtional information';
            }

            $data['subject']    = 'Your Withdrawal Request has been'.$status;
            $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE);
            $data['amount']     = $withdraw_info[0]['final_amount'];  
            $template           = $data['template'];
            $recipient          = $customer[0]['email'];
            break;
          default:
            return ;
        }

        $emptyCheck  = trim($data['template']);
        if(!empty($data['template']) && !empty($emptyCheck)){
          foreach($data as $key => $value){
              $template = str_replace('{{ '.$key.' }}', $value, $template);
          }
          $this->_send_email($recipient,$data['subject'],$template);
        }
        return;
      }
    }

    /* Email Creator*/
    public function _email_creator($data,$template,$recipient,$subject){
      $emptyCheck  = trim($template);
      if(!empty($template) && !empty($emptyCheck)){
        foreach($data as $key => $value){
          $template = str_replace('{{ '.$key.' }}', $value, $template);
        }
        $this->_send_email($recipient,$subject,$template);
      }
    }

    /*send email*/
    public function _send_email($recipient,$subject,$template){
      $data  = self::$data;
      $this->email->to($recipient);
      $this->email->from($data['email'][0]['site_email_name'].' - '.$data['email'][0]['site_email']);
      $this->email->subject($subject);
      $this->email->message($template);

      if($this->email->send()){
        $this->email->print_debugger();
        return;
      }
      else
      {
        return $this->email->print_debugger();
      }
    }

    /*Send Bulk Emails*/
    public function _user_bulk_emails($bidders,$highestbid,$listing_id){
      $datas  = self::$data;

      $data['siteurl']        = base_url();
      $data['date']           = date('Y-m-d');
      $data['sitename']       = $this->lang->line('site_name');
      $data['logo']           = base_url().ADMIN_IMAGES.$datas['imagesData'][0]['sitelogo'];
      $data['facebook']       = $datas['settings'][0]['user_facebook'];
      $data['twitter']        = $datas['settings'][0]['user_Instagram'];
      $data['office_add1']    = $datas['settings'][0]['office_add1'];
      $data['office_add2']    = $datas['settings'][0]['office_add2'];
      $data['office_tel']     = $datas['settings'][0]['office_tel'];
      $data['office_email']   = $datas['settings'][0]['office_email'];
      $data['currency']       = $datas['default_currency'];
      $listing                = $this->database->_get_row_data('tbl_listings',array('id'=>$listing_id),true);

      foreach ($bidders as $bidder) {
        $emailtemp          = 'templates/notification_email.tpl'; 
        $customer           = $this->database->getUserData($bidder['bidder_id']);
        $data['subject']    = 'Someone Placed a Higher Bid!';
        $data['detail']     = 'Someone Placed a Higher Bid of '.$data['currency'].' '.$highestbid.' for '.$listing[0]['listing_type'].' listing '.$listing[0]['website_BusinessName'].' Please Place a higher bid above '.$data['currency'].' '.$highestbid.' to stay in the Auction Your current bid as follows';
        $data['amount']     = $bidder['bid_amount'];
        $data['template']   = $this->load->view('templates/notification_email.tpl', $data, TRUE); 
        $template           = $data['template'];
        $recipient          = $customer[0]['email'];

        $emptyCheck  = trim($data['template']);
        if(!empty($data['template']) && !empty($emptyCheck)){
          foreach($data as $key => $value){
              $template = str_replace('{{ '.$key.' }}', $value, $template);
          }
          $this->_send_email($recipient,$data['subject'],$template);
        }
      }
    }
}