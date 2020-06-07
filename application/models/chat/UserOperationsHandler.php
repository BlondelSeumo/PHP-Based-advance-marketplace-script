<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserOperationsHandler extends MY_Model
{
	public $_table = 'tbl_users';
	
	/*add message*/
	public function add_message($data){
		if($this->db->insert('tbl_message',$data)) {
			return $this->db->insert_id();
		}
	}

	/*get message*/
	public function get_message($msg_id){
		return $this->db->where('id', $msg_id)->get('tbl_message')->result();
	}

	/*get user*/
	public function get_user($user_id){
		return $this->db->where('user_id', $user_id)->get('tbl_users')->result();
	}

	/*get contacted users*/
	public function get_contacted_users($user_id){
		$usersArr 			= 	$this->db->where('sender_id', $user_id)->or_where('recipient_id',$user_id)->get('tbl_message')->result_array();
		$sender_users		=	array_column($usersArr, 'sender_id');
		$recipient_users	=	array_column($usersArr, 'recipient_id');
		return array_values(array_unique(array_merge($sender_users,$recipient_users)));
	}

}