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
		
		$event['media'] = $this->db
			->select('*')
			->from('media')
			->where('event_id', $event_id)
			->get()->result_array();
		
		return $event;
	}
	
	public function update_event($event_id, $data) {
		$this->db->update('events', $data, array('id' => $event_id));
	}
	
	public function add_media($event_id) {
		$main_images_count = $this->db
			->select('id')
			->from('media')
			->where('event_id', $event_id)
			->where('main', 1)
			->get()->num_rows();
		
		$data = array(
			'event_id' => $event_id,
			'type' => 0,
			'main' => 0
		);
		
		if ($main_images_count == 0)
			$data['main'] = 1;
		
		$this->db->insert('media', $data);
		
		return $this->db->insert_id();
	}
}