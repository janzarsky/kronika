<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('edit_model');
		$this->load->model('user_model');
	}

	public function index($event_id)
	{
		$this->user_model->check_login_with_redirect();
		
		$content_data['can_publish'] = $this->user_model->get_permissions()['can_publish'];
		$content_data['event'] = $this->edit_model->get_event($event_id);
		$data['content'] = $this->load->view('edit/edit', $content_data, true);
		
		$header_data['name'] = $this->user_model->get_name();
		$header_data['permissions'] = $this->user_model->get_permissions();
		$data['header'] = $this->load->view('templates/admin_header', $header_data, true);
		
		$this->load->view('templates/admin', $data);
	}
}