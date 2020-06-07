<?php defined('BASEPATH') OR exit('No direct script access allowed');

class NotificationOperationsHandler extends MY_Model
{
	public $_table = 'tbl_notifications';

	public function unread($user_id,$limit=4){
		$messages  =  $this->db->where('user_id', $user_id)
							  ->where('view_status', '0')
							  ->order_by('date', 'asc')
							  ->get('tbl_notifications',$limit);

		return $messages->result();
	}

	public function mark_read(){
		$id = $this->input->post('id');
		$this->db->where('id', $id)->update('tbl_notifications', array('view_status'=>'1'));
	}


}