<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('max_execution_time', '0'); // for infinite time of execution 

class Main extends CI_Controller {

	public function index()
	{
		$this->load->view('main');
	}

	public function requirements()
	{
		if($this->config->item('r_DB_Required')=="1")
		{ 
			$this->session->set_userdata('install_step','2');
			$this->load->view('requirements');
		}
		else
		{
			$this->session->set_userdata('install_step','2');
			$this->load->view('requirements');
		}
		
	}
}
