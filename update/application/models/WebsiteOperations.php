<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('max_execution_time', '0'); // for infinite time of execution 

class WebsiteOperations extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function SplitSQL($file,$mysqli,$delimiter = ';') {
	$templine = "";
	$lines = file($file);
	foreach ($lines as $line) {
		if (substr($line, 0, 2) == '--' || $line == '') {
			continue;
		}
		$templine .= $line;
		if(substr(trim($line), -1, 1) == ';')	{		
			$mysqli->query($templine) or die($mysqli->error);
			$templine = '';
		}
	}
	}

	public function validEmail($email) {
		return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? true : false;	
	}

	public function isAlphaNum($val) {
		return (bool) preg_match("/^([a-zA-Z0-9])+$/i", $val);
	}

	public function getDomain($url) {
	if(preg_match("#https?://#", $url) === 0) {
		$url = 'http://' . $url;
	}
		return strtolower(str_ireplace('www.', '', parse_url($url, PHP_URL_HOST)));
	}
	public function protocol()
	{
    	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
   
    	return $protocol;
	}

	public function DB($server,$dbusername,$dbpassword,$database)
	{
		/**/
		$error=false;
    	$mysqli = @new mysqli($server,$dbusername,$dbpassword,$database);
	
		if($mysqli->connect_error) {
			$error = true;
		}
		else {
			$this->SplitSQL('assets/db/update.sql',$mysqli);
		}
		/**/
		return $error;
	}

	public function finalProcess()
	{
		$error = false;
		$basePath = $this->input->post('basePath');
		//$basePath = base_url();
		$www = (isset($_POST['www']) && $_POST['www'] == "on" ? 1 : 0);
		$https = (isset($_POST['https']) && $_POST['https'] == "on" ? 1 : 0);
		if(empty($basePath)) {
			$error = true;
			$basePathError = "Should not be empty";
		}
		else {
			$directoryName = preg_replace('{/$}', '', dirname($_SERVER['SCRIPT_NAME']))."/";
			$basePathValue=  $this->protocol() . (isset($basePath) ? $basePath : $this->getDomain($_SERVER['SERVER_NAME']) . 		 str_replace("/update","",dirname($_SERVER['SCRIPT_NAME'])));

		}
		
		if(!$error) {
	    	$error=$this->DB($this->db->hostname,$this->db->username,$this->db->password,$this->db->database);
	    	$sampleFile = file_get_contents("assets/samples/database.sample");
			$sampleFile = str_replace("{{server}}",$this->db->hostname,$sampleFile);
			$sampleFile = str_replace("{{database}}",$this->db->database,$sampleFile);
			$sampleFile = str_replace("{{username}}",$this->db->username,$sampleFile);
			$sampleFile = str_replace("{{password}}",$this->db->password,$sampleFile);
			$sampleFile = str_replace("{{base_url}}",preg_replace("(^https?://)","",$basePathValue),$sampleFile);
			file_put_contents("../application/config/database.php",$sampleFile);
			$_SESSION['install_step'] = 8;
			echo'Success';
		}
		else
		{
			echo'fail';
		}
	}

	private function getUserIpAddr()
	{
    	if(!empty($_SERVER['HTTP_CLIENT_IP']))
    	{
        	$ip = $_SERVER['HTTP_CLIENT_IP'];
    	}
    	elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    	{
        	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    	}
    	else
    	{
        	$ip = $_SERVER['REMOTE_ADDR'];
    	}
    	return $ip;
	}

}

?>

