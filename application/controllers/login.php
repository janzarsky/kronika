<?php

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		
		$this->load->model('login_model');
		
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function index() {
		if ($this->session->userdata('logged_in'))
			redirect('/admin/edit');
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('password', 'Heslo', 'trim|required|xss_clean|md5');
		
		if ($this->form_validation->run() == false) {
			$data['header'] = $this->load->view('templates/admin_header', null, true);
			
			$data['content'] = $this->load->view('login/index', null, true);
			
			$this->load->view('templates/admin', $data);
		}
		else {
			if ($this->login_model->is_password_right($this->input->post('password'), $this->input->post('email'))) {
				$this->session->set_userdata('logged_in', '1');
				$this->session->set_userdata('user_id', $this->login_model->get_id_from_email($this->input->post('email')));
				
				redirect('/admin');
			}
			else {
				$this->session->set_flashdata('message', 'Špatné heslo nebo emailová adresa');
				$this->session->set_flashdata('message_type', 'danger');
				
				redirect('/login');
			}
		}
	}
	
	public function logout() {
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_id');
		$this->session->sess_destroy();
		redirect('/admin');
	}
}