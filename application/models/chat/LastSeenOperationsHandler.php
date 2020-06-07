<?php defined('BASEPATH') OR exit('No direct script access allowed');

class LastSeenOperationsHandler extends MY_Model
{
	public $_table = 'tbl_lastseen';

	public $belongs_to = array( 'user' => array('model'=>'UserOperationsHandler'));

	public function update_lastSeen($user=0)
	{
		$last_msg = $this->db->where('recipient_id', $user)->order_by('timestamp', 'desc')->get('tbl_message', 1)->row();
		$msg = !empty($last_msg) ? $last_msg->id : 0;

		$record 	= $this->get_by('user_id', $user);
		$details 	= array('user_id' => $user,'message_id' => $msg);

		if(empty($record))
		{
			$this->insert($details);
		}else{
			$this->update($record->id, $details);
		}
	}
}