<?php
class Media_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_medias($event_id) {
		return $this->db
			->select('*')
			->from('media')
			->where('event_id', $event_id)
			->get()->result_array();
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
	
	public function delete_media($ids) {
		if (count($ids) > 0) {
			foreach ($ids as $id)
				$this->db->or_where('id', $id);
			
			$this->db->delete('media');
		}
	}
	
	public function update_main_image($id, $event_id) {
		$current_main = $this->db
			->select('id')
			->from('media')
			->where('event_id', $event_id)
			->where('main', 1)
			->get()->row_array()['id'];
		
		$this->db->update('media', array('main' => 1), array('id' => $id));
		$this->db->update('media', array('main' => 0), array('id' => $current_main));
	}
}