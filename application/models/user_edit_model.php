<?php
class User_edit_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_users() {
		return $this->db
			->select('*')
			->from('users')
			->order_by('name')
			->get()->result_array();
	}
}