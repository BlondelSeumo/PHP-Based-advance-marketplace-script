<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('max_execution_time', '0'); // for infinite time of execution 

class Requirements extends CI_Controller {

	/*public function index()
	{
		$this->verifyclass->write('1','1','1','Apache','5.6','1','1','5.6.35');
		$serverInfo=$this->RequirementsCheck();
		$this->load->view('requirements',$serverInfo);
	}*/
	
	public function RequirementsCheck($DBINFO)
	{
		if($this->session->userdata('install_step')>=3)
		{
			if(!empty($DBINFO))
			{
				$this->session->set_userdata('DBDATA',$DBINFO);
			}

			$serverInfo["web_server_on"]=$this->config->item('r_Webserver_On');
			$serverInfo["PhpVersion_on"]=$this->config->item('r_PHPversion_On');
			$serverInfo["r_Curl_On"]=$this->config->item('r_Curl_On');
			$serverInfo["r_Url_Fopen_on"]=$this->config->item('r_Url_Fopen_on');
			$serverInfo["web_server_recom"]=$this->config->item('r_webServer');
			$serverInfo["PhpVersion_recom"]=$this->config->item('r_phpVersion');
			$serverInfo["web_server"]=$this->Requirementsoperations->CheckWebServer();
			$serverInfo["PhpVersion"]=$this->Requirementsoperations->CheckPHPVersion();
			$serverInfo["r_Curl"]=$this->Requirementsoperations->CheckCurlStatus();
			$serverInfo["r_UrlFopen"]=$this->Requirementsoperations->CheckallowUrlfOpen();
			$serverInfo["r_MySQL_on"]=$this->config->item('r_MySQL_on');
			$serverInfo["r_MySQL_Version"]=$this->config->item('r_MySQL_Version');
			$serverInfo["r_Php_Exec_on"]=$this->config->item('r_Php_Exec_on');
			$serverInfo["r_Php_Exec_Status"]=$this->Requirementsoperations->CheckPhpExecEnabled();
			$serverInfo["r_Php_Lib_XML"]=$this->config->item('r_Php_Lib_XML');
			$serverInfo["r_Php_Lib_XML_Status"]=$this->Requirementsoperations->CheckPHPLIbXML();
			$serverInfo["r_Php_Ioncube"]=$this->config->item('r_Php_Lib_XML');
			$serverInfo["r_Php_Ioncube_Status"]=$this->Requirementsoperations->CheckExtension("IonCube Loader");
			$serverInfo["r_Php_Mysqli"]=$this->config->item('r_Php_Mysqli');
			$serverInfo["r_Php_Mysqli_Status"]=$this->Requirementsoperations->CheckFunctionExists("mysqli_connect");
			//$this->session->set_userdata('DBDATA',$serverInfo["mysql_version"]);
			$serverInfo["mysql_version"]=$this->Requirementsoperations->getMySQLVersion($this->session->userdata('DBDATA'));
			$this->session->set_userdata('install_step','5');
			$this->load->view('requirements',$serverInfo);
		}
		else
		{
			$this->DatabaseOperations_view();
		}
	}

	public function RequirementsCheckNoDatabase()
	{
		if($this->session->userdata('install_step')>=3)
		{
			$serverInfo["web_server_on"]=$this->config->item('r_Webserver_On');
			$serverInfo["PhpVersion_on"]=$this->config->item('r_PHPversion_On');
			$serverInfo["r_Curl_On"]=$this->config->item('r_Curl_On');
			$serverInfo["r_Url_Fopen_on"]=$this->config->item('r_Url_Fopen_on');
			$serverInfo["web_server_recom"]=$this->config->item('r_webServer');
			$serverInfo["PhpVersion_recom"]=$this->config->item('r_phpVersion');
			$serverInfo["web_server"]=$this->Requirementsoperations->CheckWebServer();
			$serverInfo["PhpVersion"]=$this->Requirementsoperations->CheckPHPVersion();
			$serverInfo["r_Curl"]=$this->Requirementsoperations->CheckCurlStatus();
			$serverInfo["r_UrlFopen"]=$this->Requirementsoperations->CheckallowUrlfOpen();
			$serverInfo["r_MySQL_on"]=$this->config->item('r_MySQL_on');
			$serverInfo["r_MySQL_Version"]=$this->config->item('r_MySQL_Version');
			$serverInfo["mysql_version"]="";
			$serverInfo["r_Php_Exec_on"]=$this->config->item('r_Php_Exec_on');
			$serverInfo["r_Php_Exec_Status"]=$this->Requirementsoperations->CheckPhpExecEnabled();
			$serverInfo["r_Php_Lib_XML"]=$this->config->item('r_Php_Lib_XML');
			$serverInfo["r_Php_Lib_XML_Status"]=$this->Requirementsoperations->CheckPHPLIbXML();
			$this->session->set_userdata('DBDATA',$serverInfo["mysql_version"]);
			$this->session->set_userdata('install_step','5');
			$this->load->view('requirements',$serverInfo);
		}
		else
		{
			$this->DatabaseOperations_view();
		}
	}

	public function DatabaseOperations_view()
	{
		//if($this->session->userdata('install_step')>='4')
		{
			if($this->config->item('r_DB_Required')=="1")
			{
				$this->session->set_userdata('install_step','3');
				$this->load->view('database_details');
			}
			else
			{
				$DBINFO=null;
				$this->RequirementsCheckNoDatabase();
			}
		}
		/*else
		{
			$this->session->set_userdata('install_step','3');
			$this->RequirementsCheck($this->session->userdata('DBDATA'));
		}*/
	}

	public function DatabaseOperations_form_submit()
	{
		$databaseInfo['error']=$this->Requirementsoperations->createConnectFile();
		if(is_object($databaseInfo['error']))
		{
			$this->RequirementsCheck($databaseInfo['error']);
		}
		else
		{
			$this->load->view('database_details',$databaseInfo);
		}
	}

	public function success($text) 
	{
		echo '<div class="alert alert-success" role="alert">
			<i class="fa fa-smile-o fa-lg"></i><?php echo $text; ?>
		</div>';
	}

	public function LicenceCheck()
	{
		if($this->session->userdata('install_step')==2)
		{
			$this->load->model('Licenceoperations');
			$licenceInfo['demo_page_message']="Enter licensed email address (for personal license) or license code (for anonymous license) and click the 'Submit' button. If license can be verified, installation will succeed. Otherwise, installation will be aborted to prevent an unauthorized usage of";
			$licenceInfo['demo_page_class']="alert alert-info";
			$licenceInfo["ROOT_URL"]=$this->Licenceoperations->getFullUrl();
			$licenceInfo["error_details"]="";
			$this->load->view('licence_settings',$licenceInfo);
		}
		else
		{
			$this->session->set_userdata('install_step','3');
			redirect(base_url()."requirements");
		}
	}

	public function LicenceCheckSubmit()
	{
		$this->load->model('Licenceoperations');
		$licenceInfo['demo_page_message']=$this->Licenceoperations->SubmitLicenceData();
		$licenceInfo['demo_page_class']="alert alert-danger";
		$licenceInfo["ROOT_URL"]=$this->Licenceoperations->getFullUrl();

		if(isset($licenceInfo['demo_page_message']))
		{
			if($licenceInfo['demo_page_message']=='Congratulations, License is Verified and ready to use!')
			{
				$this->session->set_userdata('install_step','6');
				redirect(base_url()."websitesettings");
			}
			else
			{
				$this->load->view('licence_settings',$licenceInfo);
			}
		}
	}


	public function websiteSettings()
	{
		if($this->session->userdata('install_step')=='6')
		{
			$this->load->model('WebsiteOperations');
			$websiteInfo["domain"]=$this->WebsiteOperations->getDomain($_SERVER['SERVER_NAME']);
			$websiteInfo["error"]="";
			$websiteInfo["error_details"]="";
			$this->session->set_userdata('install_step','7');
			$this->load->view('website_settings',$websiteInfo);
		}
		else
		{
			$this->session->set_userdata('install_step','4');
			redirect(base_url()."licence");
		}
	}

	public function websiteSettings_submit()
	{
		if($this->session->userdata('install_step')=='7')
		{
			$this->load->model('WebsiteOperations');
			return $this->WebsiteOperations->finalProcess();
		}
		else
		{
			$this->session->set_userdata('install_step','4');
			redirect(base_url()."licence");
		}
	}

	public function finish_setup()
	{
		if($this->session->userdata('install_step')=='8')
		{
			$websiteInfo["error"]="";
			$this->session->set_userdata('install_step','4');
			$this->load->view('finish',$websiteInfo);
		}
		else
		{
			$this->session->set_userdata('install_step','4');
			redirect(base_url()."licence");
		}
	}

}
