<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ChatOperationsHandler extends MY_Model
{
	public $_table = 'tbl_message';
	
	/*Load Messages*/
    public function load_messages($user,$recipient,$limit= 5){
        $this->db->where('sender_id',$user);
        $this->db->where('recipient_id',$recipient);
        $this->db->or_where('sender_id',$recipient);
        $this->db->where('recipient_id',$user);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('tbl_message',$limit);

        $this->db->where('recipient_id', $recipient)->where('sender_id',$user)->update('tbl_message', array('view_status'=>'1'));
        return $query->result();
    }

	public function thread_len($user, $recipient){
        $this->db->where('sender_id', $recipient);
        $this->db->where('recipient_id', $user);
        $this->db->or_where('sender_id', $user);
        $this->db->where('recipient_id', $recipient);
        $this->db->order_by('id', 'desc');
        $messages = $this->db->count_all_results('tbl_message');
        return $messages;
	}

	public function latest_message($recipient, $last_seen){
		$message  =  $this->db->where('recipient_id', $recipient)
							  ->where('id  > ', $last_seen)
							  ->order_by('timestamp', 'desc')
							  ->get('tbl_message', 1);

		if($message->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	public function new_messages($recipient, $last_seen){
		$messages  =  $this->db->where('recipient_id', $recipient)
							  ->where('id  > ', $last_seen)
							  ->order_by('timestamp', 'asc')
							  ->get('tbl_message');

		return $messages->result();
	}

	public function unread($recipient){
		$messages  =  $this->db->where('recipient_id', $recipient)
							  ->where('view_status', '0')
							  ->order_by('timestamp', 'asc')
							  ->get('tbl_message');

		return $messages->result();
	}

	public function mark_read(){
		$id = $this->input->post('id');
		$this->db->where('id', $id)->update('tbl_message', array('view_status'=>'1'));
	}

	public function unread_per_user($recipient, $sender){
		$count  =  $this->db->where('recipient_id', $recipient)
							->where('sender_id', $sender)
							->where('view_status', '0')
							->count_all_results('tbl_message');
		return $count;
	}

	public function get_last_msg($recipient, $sender){
		$messages  =  $this->db->where('recipient_id', $recipient)
							->where('sender_id', $sender)
							->order_by('timestamp', 'desc')
							->get('tbl_message',1);

		return $messages->result();
	}

	/*get last seen message*/
	public function get_last_seen_msg($recipient, $sender){
		$messages  =  $this->db->where('recipient_id', $recipient)
							->where('sender_id', $sender)
							->where('view_status', '1')
							->order_by('timestamp', 'desc')
							->get('tbl_message',1);

		return $messages->result();
	}

	/*get last seen message*/
	public function get_unviewed_msg($recipient){
		$count  =  $this->db->where('recipient_id', $recipient)
							->where('view_status', '0')
							->count_all_results('tbl_message');

		return $count;
	}

}