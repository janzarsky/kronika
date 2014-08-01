<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('events_model');
	}

	public function index()
	{
		$content_data['events'] = $this->events_model->get_events(5);
		$data['content'] = $this->load->view('events/index', $content_data, true);
		$this->load->view('templates/main', $data);
	}
	
	public function by_id($id)
	{
		$content_data['events'] = $this->events_model->get_event($id);
		$data['content'] = $this->load->view('events/index', $content_data, true);
		$this->load->view('templates/main', $data);
	}
	
	public function by_year($year)
	{
		$content_data['events'] = $this->events_model->get_events_by_year($year, 5);
		$data['content'] = $this->load->view('events/index', $content_data, true);
		$this->load->view('templates/main', $data);
	}
	
	public function by_month($year, $month)
	{
		$content_data['events'] = $this->events_model->get_events_by_month($year, $month, 5);
		$data['content'] = $this->load->view('events/index', $content_data, true);
		$this->load->view('templates/main', $data);
	}
	
	public function by_day($year, $month, $day)
	{
		$content_data['events'] = $this->events_model->get_events_by_day($year, $month, $day, 5);
		$data['content'] = $this->load->view('events/index', $content_data, true);
		$this->load->view('templates/main', $data);
	}
}