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
		$data['content'] = '';
		
		$header_data['name'] = $this->user_model->get_name();
		$header_data['permissions'] = $this->user_model->get_permissions();
		$data['header'] = $this->load->view('templates/admin_header', $header_data, true);
		
		$this->load->view('templates/main', $data);
	}
}