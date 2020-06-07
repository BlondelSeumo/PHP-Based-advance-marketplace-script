<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verifyclass
{
/* 1 */
		private $r_Webserver_On;
		private $r_PHPversion_On;
		private $r_Curl_On;
		private $r_webServer;
		private $r_phpVersion;
		private $r_Url_Fopen_on;
		private $r_MySQL_on;
		private $r_MySQL_Version;
		private $r_DB_Required;
		private $r_Server_Url;
		private $r_Item_ID;
		private $r_Php_Exec_on;
		private $r_Php_Lib_XML;

		
/* 2 */
		public function Write($r_Webserver_On,$r_PHPversion_On,$r_Curl_On,$r_webServer,$r_phpVersion,$r_Url_Fopen_on,$r_MySQL_on,$r_MySQL_Version,$r_DB_Required,$r_Server_Url,$r_Item_ID,$r_Php_Exec_on,$r_Php_Lib_XML)
		{
			$this->r_Webserver_On=$r_Webserver_On;
			$this->r_PHPversion_On=$r_PHPversion_On;
			$this->r_Curl_On=$r_Curl_On;
			$this->r_webServer=$r_webServer;
			$this->r_phpVersion=$r_phpVersion;
			$this->r_Url_Fopen_on=$r_Url_Fopen_on;
			$this->r_MySQL_on=$r_MySQL_on;
			$this->r_MySQL_Version=$r_MySQL_Version;
			$this->r_DB_Required=$r_DB_Required;
			$this->r_Server_Url=$r_Server_Url;
			$this->r_Item_ID=$r_Item_ID;
			$this->r_Php_Exec_on=$r_Php_Exec_on;
			$this->r_Php_Lib_XML=$r_Php_Lib_XML;
			
/* 3 */
			if(!empty($_POST['r_Webserver_On'])){
			$this->r_Webserver_On=$_POST['r_Webserver_On'];
			}
			if(!empty($_POST['r_PHPversion_On'])){
			$this->r_PHPversion_On=$_POST['r_PHPversion_On'];
			}
			if(!empty($_POST['r_Curl_On'])){
			$this->r_Curl_On=$_POST['r_Curl_On'];
			}
			if(!empty($_POST['r_webServer'])){
			$this->r_webServer=$_POST['r_webServer'];
			}
			if(!empty($_POST['r_phpVersion'])){
			$this->r_phpVersion=$_POST['r_phpVersion'];
			}	
			if(!empty($_POST['r_Url_Fopen_on'])){
			$this->r_Url_Fopen_on=$_POST['r_Url_Fopen_on'];
			}
			if(!empty($_POST['r_MySQL_on'])){
			$this->r_MySQL_on=$_POST['r_MySQL_on'];
			}
			if(!empty($_POST['r_MySQL_Version'])){
			$this->r_MySQL_Version=$_POST['r_MySQL_Version'];
			}
			if(!empty($_POST['r_DB_Required'])){
			$this->r_DB_Required=$_POST['r_DB_Required'];
			}
			if(!empty($_POST['r_Server_Url'])){
			$this->r_Server_Url=$_POST['r_Server_Url'];
			}
			if(!empty($_POST['r_Item_ID'])){
			$this->r_Item_ID=$_POST['r_Item_ID'];
			}
			if(!empty($_POST['r_Php_Exec_on'])){
			$this->r_Php_Exec_on=$_POST['r_Php_Exec_on'];
			}
			if(!empty($_POST['r_Php_Lib_XML'])){
			$this->r_Php_Lib_XML=$_POST['r_Php_Lib_XML'];
			}
			
/* 4 */
			$data = '<?php defined("'.'BASEPATH'.'") OR exit("'.'No direct script access allowed'.'");
			$config["'.'r_Webserver_On'.'"]="'.$this->r_Webserver_On.'"; 
			$config["'.'r_PHPversion_On'.'"]="'.$this->r_PHPversion_On.'"; 
			$config["'.'r_Curl_On'.'"]="'.$this->r_Curl_On.'"; 
			$config["'.'r_webServer'.'"]="'.$this->r_webServer.'"; 
			$config["'.'r_phpVersion'.'"]="'.$this->r_phpVersion.'"; 
			$config["'.'r_Url_Fopen_on'.'"]="'.$this->r_Url_Fopen_on.'";
			$config["'.'r_MySQL_on'.'"]="'.$this->r_MySQL_on.'";
			$config["'.'r_MySQL_Version'.'"]="'.$this->r_MySQL_Version.'";
			$config["'.'r_DB_Required'.'"]="'.$this->r_DB_Required.'";
			$config["'.'r_Server_Url'.'"]="'.$this->r_Server_Url.'";
			$config["'.'r_Item_ID'.'"]="'.$this->r_Item_ID.'";
			$config["'.'r_Php_Exec_on'.'"]="'.$this->r_Php_Exec_on.'";
			$config["'.'r_Php_Lib_XML'.'"]="'.$this->r_Php_Lib_XML.'";
			?>';

			//file_put_contents('config.php', $data);
			if(! write_file('application/config/config_system.php',$data))
			{
				//echo 'Unable to Generate the system file';
			}
			else
			{
				//echo 'File generated';
			}


		}

		public function ReadSystem()
		{
			return read_file('application/config/config_system.php');
		}

		public function getFullDetails($LICENSE_CODE,$CLIENT_EMAIL,$ROOT_URL,$SERVER_IP,$ITEM_ID,$SERVER_URL)
		{
			$curl_handle = curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$SERVER_URL);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_POST, 1);
			curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
			'purchase_code' => $LICENSE_CODE,
			'CLIENT_EMAIL' => $CLIENT_EMAIL,
			'ROOT_URL' => $ROOT_URL,
			'SERVER_IP' => $SERVER_IP,
			'ITEM_ID' => $ITEM_ID));
			$buffer = curl_exec($curl_handle);
			curl_close($curl_handle);
			$object = json_decode($buffer);
			if(isset($object))
			{
				return $object->purchase_status;
			}	
		}

}

	if(isset($_POST['update'])){

	if (is_writable('config.php')) {

			$object=new OverWrite;
			$object->Write($r_Webserver_On,$r_PHPversion_On,$r_webServer,$r_phpVersion,$r_Curl);
			header("Location:index.php?updated");

			} else {
				header('Location:index.php?file-error');
			}
	}


?>