<?php
class User_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function is_logged_in() {
		return $this->session->userdata('logged_in') == 1;
	}
}