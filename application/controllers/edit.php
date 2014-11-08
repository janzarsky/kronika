<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('edit_model');
		$this->load->model('user_model');
		
		$this->load->library('form_validation');
		$this->load->helper('form');
	}

	public function index($event_id = 0)
	{
		$this->user_model->check_login_with_redirect();
		
		$this->form_validation->set_rules('title', 'Titulek', 'trim|required|xss_clean');
		$this->form_validation->set_rules('date', 'Datum', 'trim|required|xss_clean');
		$this->form_validation->set_rules('url', 'URL', 'trim|required|xss_clean');
		$this->form_validation->set_rules('text', 'Text', 'trim|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			$content_data['can_publish'] = $this->user_model->get_permissions()['can_publish'];
			$content_data['event'] = $this->edit_model->get_event($event_id);
			$data['content'] = $this->load->view('edit/edit', $content_data, true);
			
			$header_data['name'] = $this->user_model->get_name();
			$header_data['permissions'] = $this->user_model->get_permissions();
			$data['header'] = $this->load->view('templates/admin_header', $header_data, true);
			
			$this->load->view('templates/admin', $data);
		}
		else {
			echo "success";
		}
	}
}