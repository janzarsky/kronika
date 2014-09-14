<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('events_model');
	}

	public function index()
	{
		$content_data['events'] = $this->addHeadersAndImages($this->events_model->get_events());
		$data['content'] = $this->load->view('events/index', $content_data, true);
		
		$nav_data['active_year'] = $this->getYear($content_data['events'], date('Y'));
		$data['nav'] = $this->load->view('templates/nav', $nav_data, true);
		
		$this->load->view('templates/main', $data);
	}
	
	public function by_id($id)
	{
		$content_data['event'] = $this->events_model->get_event($id);
		$content_data['event']['main_image'] = $this->events_model->get_main_image($id);
		$data['content'] = $this->load->view('events/detail', $content_data, true);
		
		$nav_data['active_year'] = $this->getYear(array($content_data['event']), date('Y'));
		$data['nav'] = $this->load->view('templates/nav', $nav_data, true);
		
		$this->load->view('templates/main', $data);
	}
	
	public function by_url($url)
	{
		$content_data['event'] = $this->events_model->get_event_by_url($url);
		$content_data['event']['main_image'] = $this->events_model->get_main_image($content_data['event']['id']);
		$data['content'] = $this->load->view('events/detail', $content_data, true);
		
		$nav_data['active_year'] = $this->getYear(array($content_data['event']), date('Y'));
		$data['nav'] = $this->load->view('templates/nav', $nav_data, true);
		
		$this->load->view('templates/main', $data);
	}
	
	public function by_date($year, $month, $day)
	{
		$content_data['events'] = $this->addHeadersAndImages($this->events_model->get_events_by_date($year, $month, $day));
		$data['content'] = $this->load->view('events/index', $content_data, true);
		
		$nav_data['active_year'] = $this->getYear($content_data['events'], $year);
		$data['nav'] = $this->load->view('templates/nav', $nav_data, true);
		
		$this->load->view('templates/main', $data);
	}
	
	private function addHeadersAndImages($events) {
		$events = $this->events_model->add_headers($events);
		$events = $this->events_model->add_main_images($events);
		
		return $events;
	}
	
	private function getYear($events, $selected_year) {
		if (count($events) == 0)
			return $selected_year;
		else
			return substr($events[0]['date'], 0, 4);
	}
}