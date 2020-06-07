<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	private static $data = array();

	function __construct() {
		parent::__construct();
		self::$data['token'] 	= 	$this->security->get_csrf_hash();
	}

	public function notifications_settings_page(){
		$UserSettingsSave['UserAccountData']=$this->EnvatoOperationsHandler->user_account();
		$this->load->view('settings/notifications',$UserSettingsSave);
	}

	public function get_data(){
		$output['token'] 		= $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']   	= $this->CronOperationsHandler->get_data();
        exit(json_encode($output));
	}

	public function save_job(){
		$output['token'] 		= $this->security->get_csrf_hash();
        header('Content-Type: application/json');
		$output['response']   	= $this->CronOperationsHandler->arrangeJobData();
		exit(json_encode($output));
	}

	public function deletecronDatafromDb($cronjob_tasks){
		$output['token'] 		= $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        $output['response']   	= $this->CronOperationsHandler->deletecronDatafromDb($cronjob_tasks);
        exit(json_encode($output));
	}

}