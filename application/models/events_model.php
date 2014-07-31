<?php
class Events_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_events($limit) {
		return $this->db
			->select('*')
			->from('events')
			->limit($limit)
			->order_by('date', 'desc')
			->get()->result_array();
	}
	
	public function get_event($id) {
		return $this->db
			->select('*')
			->from('events')
			->where('id', $id)
			->get()->result_array();
	}
}