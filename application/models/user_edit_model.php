<?php
class User_edit_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_users() {
		return $this->db
			->select('id, name, email, can_publish, can_approve, can_edit_users, can_edit_settings')
			->from('users')
			->where('deleted', 0)
			->order_by('name')
			->get()->result_array();
	}
	
	public function get_user($user_id) {
		return $this->db
			->select('id, name, email, can_publish, can_approve, can_edit_users, can_edit_settings')
			->from('users')
			->where('id', $user_id)
			->where('deleted', 0)
			->get()->row_array();
	}
	
	public function update_user($user_id, $data) {
		$this->db->update('users', $data, array('id' => $user_id));
	}
	
	public function add_user($data) {
		$this->db->insert('users', $data);
	}
	
	public function delete_user($user_id) {
		$this->db->update('users', array('deleted' => 1), array('id' => $user_id));
	}
}