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
		return $this->session->userdata('user_id');
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
	
	public function check_rights_with_redirect($event_id) {
		$event_owner = $this->db->select('owner')->from('events')->where('id', $event_id)->get()->row_array()['owner'];
		
		if ($event_owner != $this->get_id())
			if ($this->get_permissions()['can_approve'] == false) {
				$this->session->set_flashdata('message_type', 'danger');
				$this->session->set_flashdata('message', 'Nemáte oprávnění editovat tuto událost.');
				redirect('/archive');
			}
	}
	
	public function check_permission_with_redirect($permission) {
		if ($this->get_permissions()[$permission] == false) {
			redirect('/admin');
		}
	}
}