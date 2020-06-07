<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('max_execution_time', '0'); // for infinite time of execution 

class Requirementsoperations extends CI_Model
{

	public function __construct()
	{
		//$this->load->database();
	}

	/** GET ALL SETTINGS DATA **/ 
	public function get_data()
	{
		$query = $this->db->get('tbl_settings');
		return $query->result_array();
	}

	public function CheckWebServer()
	{
		return $web_server=$_SERVER["SERVER_SOFTWARE"];
		/*if($this->config->item('r_webServer')==$_SERVER["SERVER_SOFTWARE"] || (strpos($this->config->item('r_webServer'), "Apache") !== false))
		{
			return $web_server;
		}
		else
		{
			return $web_server;
		}*/
		
	}

	public function CheckPHPVersion()
	{
		$php_version = phpversion();
		if($this->config->item('r_webServer')>=phpversion())
		{
			return $php_version;
		}
		else
		{
			return $php_version;
		}
		
	}

	public function CheckCurlStatus()
	{
		if(function_exists('curl_version'))
		{
			return 'true';
		}
		else
		{
			return 'false';
		}
		
	}

	public function CheckallowUrlfOpen()
	{
		if(ini_get('allow_url_fopen'))
		{
			return 'true';
		}
		else
		{
			return 'false';
		}
		
	}

	public function isEnabled($func) 
	{
		return is_callable($func) && false === stripos(ini_get('disable_functions'), $func);
	}

	function getMySQLVersion($DBINFO) 
	{ 
		return mysqli_get_server_info($DBINFO); 
	}

	function CheckPhpExecEnabled() 
	{ 
		if(function_exists('exec')) {
    		return 'ture';
		}
		else
		{
			return 'false';
		}
	}

	function CheckPHPLIbXML()
	{
		if(extension_loaded('libxml')) {
			return 'ture';
		}
		else {
			return 'false';					
		}
	}

	function CheckExtension($name)
	{
		if(extension_loaded($name)) {
			return 'ture';
		}
		else {
			return 'false';					
		}
	}

	function CheckFunctionExists($name) 
	{ 
		if(function_exists($name)) {
    		return 'ture';
		}
		else
		{
			return 'false';
		}
	}

	public function paste_file($source,$server,$username,$password,$database,$destination)
	{
		$sampleFile = file_get_contents($source);
		$sampleFile = str_replace("{{server}}",$server,$sampleFile);
		$sampleFile = str_replace("{{username}}",$username,$sampleFile);
		$sampleFile = str_replace("{{password}}",$password,$sampleFile);
		$sampleFile = str_replace("{{database}}",$database,$sampleFile);
		file_put_contents($destination,$sampleFile);
	}

	public function createConnectFile()
	{
		$error = false;		
		$server = $this->input->post('server');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$database = $this->input->post('database');
	
		$mysqli = @new mysqli($server, $username, $password, $database);
	
		if($mysqli->connect_error) {
			$error = true;
		}
		else 
		{
			$this->paste_file("assets/samples/connect.sample",$server,$username,$password,$database,"assets/db/connect.php");
			$this->paste_file("assets/samples/database.sample",$server,$username,$password,$database,"application/config/database.php");
			$error=$mysqli;
			$_SESSION['install_step'] = 3;
		}

		return $error;

	}
}

?>