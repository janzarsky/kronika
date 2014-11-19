<?php
class Edit_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_event($event_id) {
		return $this->db
			->select('*')
			->from('events')
			->where('id', $event_id)
			->get()->row_array();
	}
	
	public function update_event($event_id, $data) {
		$this->db->update('events', $data, array('id' => $event_id));
	}
	
	public function add_event($data) {
		$this->db->insert('events', $data);
		
		return $this->db->insert_id();
	}
	
	public function delete_event($event_id) {
		$this->db->update('events', array('deleted' => 1), array('id' => $event_id));
	}
	
	public function restore_event($event_id) {
		$this->db->update('events', array('deleted' => 0), array('id' => $event_id));
	}
}