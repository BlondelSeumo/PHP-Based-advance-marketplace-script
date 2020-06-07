<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'third_party/Google/autoload.php');

class analytics extends CI_Controller {

    private static $GoogleAnalyticsURL     =  "https://www.googleapis.com/analytics/v3/data/ga?ids=ga:";
    private static $key_file_location ;
    private static $data = array();

    function __construct() {
      parent::__construct();
      $this->load->helper(array('helperssl'));
      $settings = $this->DatabaseOperationsHandler->getSettingsData();
      self::$data['token'] =   $this->security->get_csrf_hash();
      if(!empty($settings[0]['json_key_file'])){
        static::$key_file_location = APPPATH . 'third_party/Google/'.$settings[0]['json_key_file'];
      }
    }

    public function index($domain="",$reverse="",$backtype=""){
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }

        if(!empty($reverse)){
          $this->session->set_userdata('reverse',$reverse);
        }

        if(!empty($backtype)){
          $this->session->set_userdata('backtype',$backtype);
        }

        if(!empty($this->input->post('domain_id'))){
          $this->session->set_userdata('domain',$this->input->post('domain_id'));
          $domain = $this->input->post('domain_id');
        }
        else
        {
          if(empty($domain)){
            exit('Unauthorized access');
          }
          else
          {
            $this->session->set_userdata('domain',$domain);
          }
        }

        $client = new Google_Client();
        $client->setAuthConfig(self::$key_file_location);
        $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $datachk= array(
           'id' =>$domain,
           'status' =>1
        );

        if(!$this->DatabaseOperationsHandler->CheckAlreadyExists('tbl_domains',$datachk,array($this->session->userdata('user_id')))){
            exit('Unauthorized access');
        }

        $access_token = $this->DatabaseOperationsHandler->_get_single_data('tbl_domains',array('id'=>$domain),'google_token');
      
        if(!empty($access_token)){
          $access_token = json_decode($access_token, true);
          $client->setAccessToken($access_token);
        }

        $this->setFormSubmit();

        if (isset($access_token) && $access_token) {
          $client->setAccessToken($access_token);

          if ($client->isAccessTokenExpired()) {
              if ($client->getRefreshToken()) {
                  $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
              }
          }

          $analytics = new Google_Service_AnalyticsReporting($client);
          $analytics2 = new Google_Service_Analytics($client);

          $AccountsList = $this->ListAccounts($analytics2);
        
          $data['settingsData'] =   $this->DatabaseOperationsHandler->getSettingsData();
          $data['imagesData']   =   $this->DatabaseOperationsHandler->_get_row_data('tbl_siteimages',array('id'=>1));
          $data['AccountsList'] =   $AccountsList;
          $data['domainId']     =   $domain;

          $this->load->view('analytics/authentication',$data);
      } 
      else 
      {
          $redirect_uri = base_url() . 'analytics/oauth2callback';
          header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
      }
    }

    /*Store Submitted Values in a session*/
    private function setFormSubmit(){
        $data = array(
          'type_selection' =>$this->input->post('branch_1_group_1'),
          'siteURL' =>$this->input->post('siteURL'),
          'website_BusinessName' =>$this->input->post('website_BusinessName'),
          'domain_id' =>$this->input->post('domain_id'),
          'website_age' =>$this->input->post('website_age'),
          'business_registeredCountry' =>$this->input->post('business_registeredCountry'),
          'website_industry' =>$this->input->post('website_industry'),
          'monetization_methods' =>json_encode($this->input->post('monetization_methods')),
          'last12_monthsrevenue' =>$this->input->post('last12_monthsrevenue'),
          'last12_monthsexpenses' =>$this->input->post('last12_monthsexpenses'),
          'annual_profit' =>$this->input->post('annual_profit'),
          'last12_monthsrevenue' =>$this->input->post('last12_monthsrevenue'),
          'Google_Analytics_Status' =>$this->DatabaseOperationsHandler->_get_single_data('tbl_domains',array('id'=>$this->input->post('domain_id'),'status'=>1),'google_anastatus')
        );

      if(!empty($this->input->post('siteURL'))){
         $this->session->set_userdata('form_submit',$data);
      }
    }

    /*Google Authentication*/
    public function oauth2callback()
    {
      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }

      $client = new Google_Client();
      $client->setAuthConfig(self::$key_file_location);
      $client->setRedirectUri(base_url() . 'analytics/oauth2callback');
      $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);
      $client->setAccessType('offline');
      $client->setPrompt('select_account consent');

      if (! isset($_GET['code'])) {
          $auth_url = $client->createAuthUrl();
          header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
      } 
      else 
      {
          $client->authenticate($_GET['code']);
          $access_token = $client->getAccessToken();
        
          if($this->DatabaseOperationsHandler->_update_to_table('tbl_domains',array('google_token'=>json_encode($client->getAccessToken())),array('id'=>$this->session->userdata('domain'),'status'=>1))){
            $redirect_uri = base_url() . 'analytics/verify/'.$this->session->userdata('domain');
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
          }

          exit('Fail !! Please try again');
      }
    }

    /*Google Revoke Access Token*/
	  public function unlink($domain,$reverse=""){
		    $client = new Google_Client();
		    $client->setAuthConfig(self::$key_file_location);
		    $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);
		    $client->setAccessType('offline');
		    $client->setPrompt('select_account consent');
		
		    $access_token = $this->DatabaseOperationsHandler->_get_single_data('tbl_domains',array('id'=>$domain),'google_token');
    	
    	   if(!empty($access_token)){
    		    $access_token = json_decode($access_token, true);
            if(!isset($access_token['error'])){
                $client->setAccessToken($access_token);
            }
    	   }

		    $client->revokeToken();

		    $data= array(
        'acc_id' =>"",
        'prop_id' =>"",
        'view_id' =>"",
        'google_token' =>"",
        'google_anastatus' =>0
        );

        $this->DatabaseOperationsHandler->_update_to_table('tbl_domains',$data,array('id'=>$domain,'status'=>1));
        if(!empty($reverse)){
          if($this->DatabaseOperationsHandler->_update_to_table('tbl_listings',array('google_verified'=>0),array('id'=>$reverse))){
            redirect(site_url('user/edit_listings/website').'/'.$reverse);
            return;
          }
        }
        redirect(site_url('main/adpost'));
	  }

    public function getMonthlyWiseViews($domain){
      $client = new Google_Client();
      $client->setAuthConfig(self::$key_file_location);
      $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);
      $client->setAccessType('offline');
      $client->setPrompt('select_account consent');

      $access_token = $this->DatabaseOperationsHandler->_get_single_data('tbl_domains',array('id'=>$domain),'google_token');

      if(!empty($access_token)){
          $access_token = $access_token;
          $client->setAccessToken($access_token);
      }

      if (isset($access_token) && $access_token) {
        
        $client->setAccessToken($access_token);

        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            }
        }

        $domainData   = $this->DatabaseOperationsHandler->_get_row_data('tbl_domains',array('id'=>$domain,'status'=>1));

        $acc_id   = $domainData[0]['acc_id'];
        $prop_id  = $domainData[0]['prop_id'];
        $view_id  = $domainData[0]['view_id'];
      
        $access_token = json_decode($access_token, true);

        $from = date('Y-m-d', strtotime('-1 year')); // 7 days ago
        $to   = date('Y-m-d', time()-24*60*60); // 1 days ago

        $command = self::$GoogleAnalyticsURL.$view_id.'&start-date='.$from.'&end-date=yesterday&metrics=ga%3Asessions%2Cga%3Apageviews&dimensions=ga%3Ayear,ga%3Amonth';

        $data['categoriesData']           = $this->DatabaseOperationsHandler->_get_row_data('tbl_categories','');
        $data['languages']                = $this->DatabaseOperationsHandler->load_all_languages();
        $data['metaData']                 = $this->DatabaseOperationsHandler->getSettingsData();
        $data['default_currency']         = $this->CommonOperationsHandler->getCurrency('USD','symbol');
        $data['userdata']                 = $this->DatabaseOperationsHandler->getUserData($this->session->userdata('user_id'));
        $data['selectedLanguage']         = $this->is_language();
        $data['reportData']               = $this->ExecuteCURLToken($command,$access_token['access_token']);
        $data['FormValues']               = $this->session->userdata('form_submit');
        $data['verifiedGA']               = $this->DatabaseOperationsHandler->_get_single_data('tbl_domains',array('id'=>$domain,'status'=>1),'google_anastatus');


        if($this->session->userdata('reverse')){
          if($this->DatabaseOperationsHandler->_update_to_table('tbl_listings',array('google_verified'=>1),array('id'=>$this->session->userdata('reverse')))){
              $domain_id =  $this->session->userdata('reverse');
              $this->session->unset_userdata('reverse');
              if($this->session->userdata('backtype')){
                redirect(site_url('user/create_listings/website').'/'.$domain_id);
                return;
              }
              redirect(site_url('user/edit_listings/website').'/'.$domain_id);
              return;
          }
        }

        if(!empty($data['FormValues']['siteURL'])){
          $this->load->view('main/adpost',$data);
        }
        else
        {
          redirect(site_url('main/adpost'));
        }
      }
      else
      {
        $redirect_uri = base_url() . 'analytics/oauth2callback';
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
      }
    }

    private function ExecuteCURLToken($command,$token)
    {
        if(!empty($token)){
        
            $ch = curl_init();
            $header = array();
            $header[] = 'Authorization: Bearer '.$token;
            $header[] = 'Accept: application/json';
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $command.'&access_token='.$token);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $ch_data = curl_exec($ch);
            curl_close($ch);
            $json_data = json_decode($ch_data, true);

            if(!empty($ch_data) && !isset($json_data['error']))
            {
                return $json_data;
            }
        }
        
    }

    /*List all Accounts for the given account*/
    private function ListAccounts($analytics) {

      $fullaccounts = $analytics->management_accounts->listManagementAccounts();
      if (count($fullaccounts->getItems()) > 0) {
        foreach ($fullaccounts['items'] as $account) {
          $accounts[] = [ 'id' => $account['id'], 'name' => $account['name'] ];
        }

        return $accounts;
      }
    }

    /*List all Properties for the given account*/
    public function ListProperties($accounts,$domain) {
      $output['token']       = $this->security->get_csrf_hash();
      header('Content-Type: application/json');
      try {
        $account_id = $accounts;
        $client = new Google_Client();
        $client->setAuthConfig(self::$key_file_location);
        $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

        $access_token = $this->DatabaseOperationsHandler->_get_single_data('tbl_domains',array('id'=>$domain),'google_token');
      
        if(!empty($access_token)){
            $access_token = json_decode($access_token, true);
            $client->setAccessToken($access_token);

            $service = new Google_Service_Analytics($client);

            $fullproperties = $service->management_webproperties->listManagementWebproperties($accounts);
            $output['response']  = $fullproperties['items'];
            exit(json_encode($output));
        }
        else
        {
          $redirect_uri = base_url() . 'analytics/oauth2callback';
          header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
        }
      }
      catch (Google_ServiceException $e) {
      return Response::json([
      'status'  => 0,
      'code'    => 3,
      'message' => $e->getMessage()
      ]);
      }
  }

  /*List all Views for the given account & propety */
  public function ListViews($accid,$propid,$domain) {
    $client = new Google_Client();
    $client->setAuthConfig(self::$key_file_location);
    $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);
    $output['token']       = $this->security->get_csrf_hash();
    header('Content-Type: application/json');

    try {
      $access_token = $this->DatabaseOperationsHandler->_get_single_data('tbl_domains',array('id'=>$domain),'google_token');
      
      if(!empty($access_token)){
          $access_token = json_decode($access_token, true);
          $client->setAccessToken($access_token);
          $service = new Google_Service_Analytics($client);
          $man_views = $service->management_profiles->listManagementProfiles( $accid, $propid );
          $output['response']  = $man_views['items'];
          exit(json_encode($output));          
      }
      else
      {
        $redirect_uri = base_url() . 'analytics/oauth2callback';
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
      }
    } 
    catch (Google_ServiceException $e) {
      return Response::json([
      'status'  => 0,
      'code'    => 3,
      'message' => $e->getMessage()
      ]);
    }

  }

  /*Retreive Google Analytics Users and Page Views*/
  public function getUsersAndPageViews($id){
    $output['token']       = $this->security->get_csrf_hash();
    header('Content-Type: application/json');
    $analytics = $this->AnalyticsOperationsHandler->getUsersAndPageViews($id);
    if($analytics){
        $output['response']         = $analytics;
        exit(json_encode($output));
    }

    $output['response']             = false;
    exit(json_encode($output));
  }

  /*Retrive Google Analytics Data according to domain listings*/
  public function getSiteAnalyticsdata($id){
    $output['token']       = $this->security->get_csrf_hash();
    header('Content-Type: application/json');
    $analytics = $this->AnalyticsOperationsHandler->getSiteAnalyticsdata($id);
    if($analytics){
        $output['response']         = $analytics;
        exit(json_encode($output));
    }

    $output['response']             = false;
    exit(json_encode($output));
  }

 
  /*site language*/
  public function is_language()
  {
    if(!empty($this->session->userdata('site_lang'))){
      return $this->session->userdata('site_lang');
    }
    else{
      return $this->DatabaseOperationsHandler->GetDefaultLanguage()[0]['language'];
    }
  }

  /*ssl check*/
  public function is_ssl()
  {
    $data['settingsData']         =   $this->DatabaseOperationsHandler->getSettingsData();

    if(isset($data['settingsData'][0]['ssl_enable']) && $data['settingsData'][0]['ssl_enable']==1){
      force_ssl();
    }
  }

  /*login check*/
  public function is_logged($ignore='')
  {
    if(!empty($this->session->userdata('user_id')) && $this->session->userdata('user_level') == 1)
    {
      return $this->session->userdata('user_id');
    }

    if(empty($ignore))
    {
      redirect(base_url().'login');
    }
    
    return;
  }


  /*Final Google Analytics Validation Process*/
  public function getReport($viewid,$domain,$acc_id,$prop_id) 
  {
    $client = new Google_Client();
    $client->setAuthConfig(self::$key_file_location);
    $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

    $VIEW_ID = $viewid;

    if(empty($domain)){
      exit('Unauthorized access');
    }

    $access_token = $this->DatabaseOperationsHandler->_get_single_data('tbl_domains',array('id'=>$domain),'google_token');
      
    if(!empty($access_token)){
        $access_token = json_decode($access_token, true);
          $client->setAccessToken($access_token);

        $analytics = new Google_Service_AnalyticsReporting($client);

        $data= array(
        'acc_id' =>$acc_id,
        'prop_id'=>$prop_id,
        'view_id'=>$viewid,
        'google_anastatus' =>1
        );

        $this->DatabaseOperationsHandler->_update_to_table('tbl_domains',$data,array('id'=>$domain,'status'=>1));

        // Create the DateRange object.
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate("7daysAgo");
        $dateRange->setEndDate("today");

        // Create the Metrics object.
        $sessions = new Google_Service_AnalyticsReporting_Metric();
        $sessions->setExpression("ga:sessions");
        $sessions->setAlias("sessions");

        // Create the ReportRequest object.
        $request = new Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($VIEW_ID);
        $request->setDateRanges($dateRange);
        $request->setMetrics(array($sessions));

        $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests( array( $request) );
        
        $redirect_uri = base_url().'analytics/getMonthlyWiseViews/'.$domain;
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }
    else
    {
      $redirect_uri = base_url() . 'analytics/oauth2callback';
      header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }
  }

}