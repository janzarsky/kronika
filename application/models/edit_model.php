<?php
class Edit_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_event($event_id) {
		$event = $this->db
			->select('*')
			->from('events')
			->where('id', $event_id)
			->get()->row_array();
		
		if ($event['date_precision'] == 1)
			$event['friendly_date'] = substr($event['date'], 0, 4);
		else if ($event['date_precision'] == 2)
			$event['friendly_date'] = substr($event['date'], 5, 2) . '/' . substr($event['date'], 0, 4);
		else if ($event['date_precision'] == 3)
			$event['friendly_date'] = substr($event['date'], 8, 2) . '. ' . substr($event['date'], 5, 2) . '. ' . substr($event['date'], 0, 4);
		
		return $event;
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
	
	public function approve_event($event_id) {
		$this->db->update('events', array('sent_for_approval' => 0, 'published' => 1), array('id' => $event_id));
	}
	
	public function reject_event($event_id) {
		$this->db->update('events', array('sent_for_approval' => 0, 'published' => 0), array('id' => $event_id));
	}
	
	public function get_media_count($event_id) {
		return $this->db
			->select('id')
			->from('media')
			->where('event_id', $event_id)
			->get()->num_rows();
	}
	
	public function is_url_unique($url, $id) {
		return ($this->db
			->select('id')
			->from('events')
			->where('url', $url)
			->where('id !=', $id)
			->get()->num_rows() == 0);
	}
}