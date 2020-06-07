<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include("assets/db/connect.php");

ini_set('max_execution_time', '0'); // for infinite time of execution 

class Licenceoperations extends CI_Model
{
	public $error_detected=0;
	public $error_details=null;

	public function getDomain($url) 
	{
		if(preg_match("#https?://#", $url) === 0) 
		{
			$url = 'http://' . $url;
		}
		return strtolower(str_ireplace('www.', '', parse_url($url, PHP_URL_HOST)));
	}

	public function protocol()
	{
    	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
   
    	return $protocol;
	}

	public function getFullUrl()
	{
		$basePathValue=  $this->protocol() . (isset($basePath) ? $basePath : $this->getDomain($_SERVER['SERVER_NAME']) . str_replace(		"/install","",dirname($_SERVER['SCRIPT_NAME'])));	
		return $basePathValue;
	}

	public function SubmitLicenceData()
	{
		$error_detected=0;
		$this->load->library('Verifyclass', 'verifyclass');
		if (!filter_var($this->input->post('CLIENT_EMAIL'), FILTER_VALIDATE_EMAIL) && empty($this->input->post('LICENSE_CODE')))
        {
        	$error_detected=1;
        	$error_details="Your email address and/or license code doesn't seem to be valid.";
        }

        //Validate URL
    	if (!filter_var($this->input->post('ROOT_URL'), FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED) || !ctype_alnum(substr($this->input->post('ROOT_URL'), -1)))
        {
        	$error_detected=1;
        	$error_details="Your URL doesn't seem to be valid.";
        }

        if ($error_detected==1)
        {
        	return "Oops... Something went wrong... Change some things up and try again. More details on error below:<br><br>$error_details";
        }
        else
        {
        	if ($this->verifyclass->getFullDetails($this->input->post('LICENSE_CODE'),$this->input->post('CLIENT_EMAIL'),$this->input->post('ROOT_URL').'/',$_SERVER['SERVER_ADDR'],$this->config->item('r_Item_ID'),$this->config->item('r_Server_Url'))	==	'valid')
			{
				$returnobj	=	$this->verifyclass->getFullDetails($LICENSE_CODE,$CLIENT_EMAIL,$ROOT_URL.'/',$_SERVER['SERVER_ADDR'],$this->config->item('r_Item_ID'),$this->config->item('r_Server_Url'));
				//$_SESSION['install_step'] = 5;
				return "Congratulations, License is Verified and ready to use!";
        		$demo_page_class="alert alert-success";
			}
			else
			{
				$error_details="Licence Verification is failed !! Please contact author !!";
        		return "Unfortunately, installation failed because of this reason:<br><br>$error_details ";
    	    }
		}
	}
}
?>