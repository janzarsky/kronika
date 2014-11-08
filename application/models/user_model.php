<?php
class User_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function is_logged_in() {
		return $this->session->userdata('logged_in') == 1;
	}
	
	public function get_permissions() {
		$this->check_login();
		
		return $this->db
			->select('can_publish, can_approve, can_edit_users, can_edit_settings')
			->from('users')
			->where('id', $this->session->userdata('user_id'))
			->get()->row_array();
	}
	
	public function get_id() {
		return $this->session->userdata('user_id') == 1;
	}
	
	public function get_name() {
		return $this->db
			->select('name')
			->from('users')
			->where('id', $this->session->userdata('user_id'))
			->get()->row_array()['name'];
	}
	
	public function check_login_with_redirect() {
		if ($this->session->userdata('logged_in') == false)
			redirect('/login');
	}
	
	function check_login() {
		if ($this->session->userdata('logged_in') == false)
			throw new Exception('Not logged in');
	}
}