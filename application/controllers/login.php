<?php

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('login_model');
	}

	public function index() {
		if ($this->session->userdata('logged_in'))
			redirect('/admin/edit');
		
		$data['content'] = $this->load->view('login/index', null, true);
		
		$this->load->view('templates/admin', $data);
	}
	
	public function submit() {
		if ($this->login_model->is_password_right($this->input->post('password'), $this->input->post('email'))) {
			$this->session->set_userdata('logged_in', '1');
			
			redirect('/admin/edit');
		}
		else {
			$this->session->set_flashdata('message', 'Špatné heslo nebo emailová adresa');
			$this->session->set_flashdata('message_type', 'error');
			
			redirect('login');
		}
	}
	
	public function logout() {
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect('/admin/edit');
	}
}