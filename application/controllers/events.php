<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('events_model');
	}

	public function index()
	{
		$content_data['events'] = $this->events_model->get_events(10);
		$content_data['events'] = $this->events_model->add_headers($content_data['events']);
		$data['content'] = $this->load->view('events/index', $content_data, true);
		
		$nav_data['active_year'] = substr($content_data['events'][0]['date'], 0, 4);
		$data['header'] = $this->load->view('templates/nav', $nav_data, true);
		
		$this->load->view('templates/main', $data);
	}
	
	public function by_id($id)
	{
		$content_data['event'] = $this->events_model->get_event($id);
		$data['content'] = $this->load->view('events/detail', $content_data, true);
		
		$nav_data['active_year'] = substr($content_data['events'][0]['date'], 0, 4);
		$data['header'] = $this->load->view('templates/nav', $nav_data, true);
		
		$this->load->view('templates/main', $data);
	}
	
	public function by_year($year)
	{
		$content_data['events'] = $this->events_model->get_events_by_year($year, 10);
		$content_data['events'] = $this->events_model->add_headers($content_data['events']);
		$data['content'] = $this->load->view('events/index', $content_data, true);
		
		$nav_data['active_year'] = substr($content_data['events'][0]['date'], 0, 4);
		$data['header'] = $this->load->view('templates/nav', $nav_data, true);
		
		$this->load->view('templates/main', $data);
	}
	
	public function by_month($year, $month)
	{
		$content_data['events'] = $this->events_model->get_events_by_month($year, $month, 10);
		$content_data['events'] = $this->events_model->add_headers($content_data['events']);
		$data['content'] = $this->load->view('events/index', $content_data, true);
		
		$nav_data['active_year'] = substr($content_data['events'][0]['date'], 0, 4);
		$data['header'] = $this->load->view('templates/nav', $nav_data, true);
		
		$this->load->view('templates/main', $data);
	}
	
	public function by_day($year, $month, $day)
	{
		$content_data['events'] = $this->events_model->get_events_by_day($year, $month, $day, 10);
		$content_data['events'] = $this->events_model->add_headers($content_data['events']);
		$data['content'] = $this->load->view('events/index', $content_data, true);
		
		$nav_data['active_year'] = substr($content_data['events'][0]['date'], 0, 4);
		$data['header'] = $this->load->view('templates/nav', $nav_data, true);
		
		$this->load->view('templates/main', $data);
	}
}