<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	
	var $password;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('user_edit_model');
		
		$this->load->library('form_validation');
		
		$this->load->helper('form');
	}

	public function index()
	{
		$this->user_model->check_login_with_redirect();
		$this->user_model->check_permission_with_redirect('can_edit_users');
		
		$content_data['users'] = $this->user_edit_model->get_users();
		
		$data['content'] = $this->load->view('users/index', $content_data, true);
		
		$header_data['page'] = 'users';
		$header_data['name'] = $this->user_model->get_name();
		$header_data['permissions'] = $this->user_model->get_permissions();
		$data['header'] = $this->load->view('templates/admin_header', $header_data, true);
		
		$this->load->view('templates/admin', $data);
	}
	
	public function edit($user_id = 0)
	{
		$this->user_model->check_login_with_redirect();
		$this->user_model->check_permission_with_redirect('can_edit_users');
		
		$this->form_validation->set_rules('name', 'Jméno', 'trim|required|xss_clean|min_length[3]|max_length[60]|callback_special_chars');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('password', 'Heslo', 'trim|xss_clean|min_length[3]|max_length[60]|md5|callback_password');
		$this->form_validation->set_rules('password2', 'Heslo', 'trim|xss_clean|min_length[3]|max_length[60]|md5|callback_password2');
		
		if ($this->form_validation->run() == false) {
			if ($user_id == 0)
				$content_data['user'] = $this->get_empty_user();
			else
				$content_data['user'] = $this->user_edit_model->get_user($user_id);
			
			$data['content'] = $this->load->view('users/edit', $content_data, true);
			
			$header_data['page'] = 'users';
			$header_data['name'] = $this->user_model->get_name();
			$header_data['permissions'] = $this->user_model->get_permissions();
			$data['header'] = $this->load->view('templates/admin_header', $header_data, true);
			
			$this->load->view('templates/admin', $data);
		}
		else {
			if ($user_id == 0) {
				$this->user_edit_model->add_user($this->get_user_data());
				$this->session->set_flashdata('message', 'Uživatel byl přidán.');
			}
			else {
				$this->user_edit_model->update_user($user_id, $this->get_user_data());
				$this->session->set_flashdata('message', 'Uživatel je uložen.');
			}
			
			redirect('/users');
		}
	}
	
	public function delete($user_id = 0) {
		$this->user_model->check_login_with_redirect();
		$this->user_model->check_permission_with_redirect('can_edit_users');
		
		if ($user_id != 0) {
			$this->user_edit_model->delete_user($user_id);
			
			$this->session->set_flashdata('message', 'Uživatel byl odstraněn');
			
			redirect('/users');
		}
	}
	
	function password($pwd) {
		$this->password = $pwd;
		return true;
	}
	
	function password2($pwd) {
		if ($pwd === $this->password)
			return true;
		else {
			$this->form_validation->set_message('password', 'Hesla se neshodují!');
		}
	}
	
	public function profile() {
		$this->user_model->check_login_with_redirect();
		
		$this->form_validation->set_rules('password', 'Heslo',
			'trim|xss_clean|required|min_length[3]|max_length[60]|md5|callback_password');
		$this->form_validation->set_rules('password2', 'Heslo',
			'trim|xss_clean|required|min_length[3]|max_length[60]|md5|callback_password2');
		
		$user_id = $this->user_model->get_id();
		$content_data['user'] = $this->user_edit_model->get_user($user_id);
		
		if ($this->form_validation->run() == false) {
			$data['content'] = $this->load->view('users/profile', $content_data, true);
			
			$header_data['page'] = 'profile';
			$header_data['name'] = $this->user_model->get_name();
			$header_data['permissions'] = $this->user_model->get_permissions();
			$data['header'] = $this->load->view('templates/admin_header', $header_data, true);
			
			$this->load->view('templates/admin', $data);
		}
		else {
			$this->user_edit_model->update_user($user_id, $this->get_profile_data());
			$this->session->set_flashdata('message', 'Heslo bylo změněno.');
			
			redirect('/profile');
		}
	}
	
	function get_user_data() {
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			
			'can_publish' => $this->input->post('can_publish'),
			'can_approve' => $this->input->post('can_approve'),
			'can_edit_users' => $this->input->post('can_edit_users'),
			'can_edit_settings' => $this->input->post('can_edit_settings')
		);
		
		$pwd = $this->input->post('password');
		
		if ($pwd !== '')
			$data['password'] = $pwd;
		
		return $data;
	}
	
	function get_profile_data() {
		return array('password' => $this->input->post('password'));
	}
	
	function get_empty_user() {
		return array(
			'id' => 0,
			'name' => '',
			'email' => '',
			'can_publish' => 0,
			'can_approve' => 0,
			'can_edit_users' => 0,
			'can_edit_settings' => 0
		);
	}
}