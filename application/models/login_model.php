<?php

class Login_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function is_password_right($password, $email) {
		$q = $this->db
			->select('password')
			->from('users')
			->where('email', $email)
			->get();
		
		if ($q->num_rows() != 1)
			return false;
		else
			return ($password == $q->row_array()['password']);
	}
}