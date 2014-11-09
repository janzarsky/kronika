<?php
class Archive_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_events($user_id) {
		return $this->db
			->select('id, title, date, date_precision, url, sent_for_approval, published')
			->from('events')
			->where('owner', $user_id)
			->order_by('date', 'DESC')
			->get()->result_array();
	}
}