<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Archive extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('archive_model');
		$this->load->model('user_model');
	}

	public function index()
	{
		$this->user_model->check_login_with_redirect();
		
		$user_id = $this->user_model->get_id();
		
		$content_data['events'] = $this->archive_model->get_events($user_id);
		$data['content'] = $this->load->view('archive/index', $content_data, true);
		
		$header_data['page'] = 'archive';
		$header_data['name'] = $this->user_model->get_name();
		$header_data['permissions'] = $this->user_model->get_permissions();
		$data['header'] = $this->load->view('templates/admin_header', $header_data, true);
		
		$this->load->view('templates/admin', $data);
	}
}