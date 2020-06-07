<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'third_party/Google/autoload.php');

class AnalyticsOperationsHandler extends CI_Model
{
    private static $GoogleAnalyticsURL   ="https://www.googleapis.com/analytics/v3/data/ga?ids=ga:";
    private static $key_file_location;

    function __construct(){
        parent::__construct();
        $this->load->database();
        $settings = $this->DatabaseOperationsHandler->getSettingsData();
        if(!empty($settings[0]['json_key_file'])){
            static::$key_file_location = APPPATH . 'third_party/Google/'.$settings[0]['json_key_file'];
        }   
    }

    /*Retreive Google Analytics Users and Page Views*/
    public function getUsersAndPageViews($id){
        $domain       = $this->DatabaseOperationsHandler->_get_row_data('tbl_listings',array('id'=>$id))[0]['domain_id'];
        $domainData   = $this->DatabaseOperationsHandler->_get_row_data('tbl_domains',array('id'=>$domain));

        if(!empty($domainData)){
            if(isset(json_decode($domainData[0]['google_token'],true)['error'])){
                return;
            }
            $acc_id   = $domainData[0]['acc_id'];
            $prop_id  = $domainData[0]['prop_id'];
            $view_id  = $domainData[0]['view_id'];
            $from     = date('Y-m-d', strtotime('-6 month')); 
            $to       = date('Y-m-d', time()-24*60*60); 

            $command = self::$GoogleAnalyticsURL.$view_id.'&start-date='.$from.'&end-date=yesterday&metrics=ga%3Ausers%2Cga%3Apageviews';
            $data = $this->ExecuteTheCommand($domain,$command);

            if(!empty($data)){
                return $data;
            }
            return;
        }
        return;
    }

    /*Retrive Google Analytics Data according to domain listings*/
    public function getSiteAnalyticsdata($id,$type='users'){
        $domain       = $this->DatabaseOperationsHandler->_get_row_data('tbl_listings',array('id'=>$id))[0]['domain_id'];
        $domainData   = $this->DatabaseOperationsHandler->_get_row_data('tbl_domains',array('id'=>$domain));

        if(!empty($domainData)){
            $acc_id   = $domainData[0]['acc_id'];
            $prop_id  = $domainData[0]['prop_id'];
            $view_id  = $domainData[0]['view_id'];
            $from     = date('Y-m-d', strtotime('-6 month')); 
            $to       = date('Y-m-d', time()-24*60*60); 

            if($type === 'sessions'){
                $command = self::$GoogleAnalyticsURL.$view_id.'&start-date='.$from.'&end-date=yesterday&metrics=ga%3Asessions%2Cga%3Apageviews&dimensions=ga%3Ayear,ga%3Amonth';
            }
            else if($type === 'users'){
                $command = self::$GoogleAnalyticsURL.$view_id.'&start-date='.$from.'&end-date=yesterday&metrics=ga%3Ausers%2Cga%3Apageviews&dimensions=ga%3Ayear,ga%3Amonth';
            }

            $data = $this->ExecuteTheCommand($domain,$command);
            if(!empty($data)){
                $i = 0;
                foreach ($data as $key) {
                    $data[$i][1] = $this->getMonth($key[1]);
                    $i++;
                }
                return $data;
            }
            return false;
        }
        return false;
    }

    /*Retrive Google Analytics Data according to domain listings*/
    public function ExecuteTheCommand($domain,$command){
        $client = new Google_Client();
        $client->setAuthConfig(self::$key_file_location);
        $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);
        $client->setAccessType('offline');

        $access_token = $this->DatabaseOperationsHandler->_get_single_data('tbl_domains',array('id'=>$domain),'google_token');

        if(!empty($access_token)){
            $access_token = $access_token;
            $jac   = json_decode($access_token,true);
            if(!isset($jac['error'])){
                $client->setAccessToken($access_token);
            }
            else
            {
                return;
            }
        }

        if (isset($access_token) && $access_token) {
        
            $client->setAccessToken($access_token);
            if ($client->isAccessTokenExpired()) {
                if ($client->getRefreshToken()) {
                    $this->DatabaseOperationsHandler->_update_to_table('tbl_domains',array('google_token'=>json_encode($client->fetchAccessTokenWithRefreshToken($client->getRefreshToken()))),array('id'=>$domain,'status'=>1));
                    $access_token = $this->DatabaseOperationsHandler->_get_single_data('tbl_domains',array('id'=>$domain),'google_token');
                }
            }

            $access_token = json_decode($access_token, true);
            $reportArr = $this->ExecuteCURLToken($command,$access_token['access_token'])['rows'];

            return $reportArr;
        }
        return;
    }

    /*Execute URL token*/
    private function ExecuteCURLToken($command,$token){
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

            if(!empty($ch_data) && !isset($json_data['error'])){
                return $json_data;
            }
        }
        
    }

    /*Get Month in Words*/
    public function getMonth($month){
        $dateObj   = DateTime::createFromFormat('!m', $month);
        return $dateObj->format('F'); 
    }

}

