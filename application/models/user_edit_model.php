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
			->order_by('name')
			->get()->result_array();
	}
	
	public function get_user($user_id) {
		return $this->db
			->select('id, name, email, can_publish, can_approve, can_edit_users, can_edit_settings')
			->from('users')
			->where('id', $user_id)
			->get()->row_array();
	}
}