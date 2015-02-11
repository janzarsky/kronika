<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Archive extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('archive_model');
		$this->load->model('user_model');
	}

	public function index($filter = false)
	{
		$this->user_model->check_login_with_redirect();
		
		$user_id = $this->user_model->get_id();
		
		$content_data['can_approve'] = ($this->user_model->get_permissions()['can_approve'] == 1);
		
		if ($content_data['can_approve'])
			$content_data['events'] = $this->archive_model->get_all_events($user_id, $filter);
		else
			$content_data['events'] = $this->archive_model->get_user_events($user_id, $filter);
		
		$content_data['filter'] = $filter;
		
		$data['content'] = $this->load->view('archive/index', $content_data, true);
		
		$header_data['page'] = 'archive';
		$header_data['name'] = $this->user_model->get_name();
		$header_data['permissions'] = $this->user_model->get_permissions();
		$data['header'] = $this->load->view('templates/admin_header', $header_data, true);
		
		$this->load->view('templates/admin', $data);
	}
}