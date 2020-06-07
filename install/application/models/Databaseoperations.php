<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('max_execution_time', '0'); // for infinite time of execution 

class Databaseoperations extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	/** GET ALL SETTINGS DATA **/ 
	public function get_data()
	{
		$query = $this->db->get('tbl_settings');
		return $query->result_array();
	}

	public function SplitSQL($file,$mysqli,$delimiter = ';') 
	{
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