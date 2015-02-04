<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	
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
	
	public function edit($user_id)
	{
		$this->user_model->check_login_with_redirect();
		$this->user_model->check_permission_with_redirect('can_edit_users');
		
		$content_data['user'] = $this->user_edit_model->get_user($user_id);
		
		$data['content'] = $this->load->view('users/edit', $content_data, true);
		
		$header_data['page'] = 'users';
		$header_data['name'] = $this->user_model->get_name();
		$header_data['permissions'] = $this->user_model->get_permissions();
		$data['header'] = $this->load->view('templates/admin_header', $header_data, true);
		
		$this->load->view('templates/admin', $data);
	}
}