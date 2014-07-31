<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('events_model');
	}

	public function index()
	{
		$data['events'] = $this->events_model->get_events(5);
		$this->load->view('events/index', $data);
	}
	
	public function by_id($id)
	{
		$data['events'] = $this->events_model->get_event($id);
		$this->load->view('events/index', $data);
	}
}