<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('events_model');
	}

	public function index()
	{
		$content_data['events'] = $this->events_model->get_events_with_main_images();
		
		if ($content_data['events']) {
			$content_data['prev_url'] = $this->get_prev_url($content_data['events']);
			$data['content'] = $this->load->view('events/index', $content_data, true);
		}
		else
			$data['content'] = $this->load->view('events/no-events', null, true);
		
		$this->load->view('templates/main', $data);
	}
	
	public function by_id($id)
	{
		$content_data['event'] = $this->events_model->get_event_with_main_image($id);
		
		if ($content_data['event']) {
			$content_data['event']['media'] = $this->events_model->get_media($id);
			$data['content'] = $this->load->view('events/detail', $content_data, true);
			
			$header_data['active_year'] = $this->getYear(array($content_data['event']), date('Y'));
			$data['header'] = $this->load->view('templates/header', $header_data, true);
		}
		else {
			$data['content'] = $this->load->view('events/no-events', null, true);
			
			$data['header'] = $this->load->view('templates/header', null, true);
		}
		
		$this->load->view('templates/main', $data);
	}
	
	public function by_url($url)
	{
		$content_data['event'] = $this->events_model->get_event_by_url_with_main_image($url);
		
		if ($content_data['event']) {
			$content_data['event']['media'] = $this->events_model->get_media($content_data['event']['id']);
			$data['content'] = $this->load->view('events/detail', $content_data, true);
			
			$header_data['active_year'] = $this->getYear(array($content_data['event']), date('Y'));
			$data['header'] = $this->load->view('templates/header', $header_data, true);
		}
		else {
			$data['content'] = $this->load->view('events/no-events', null, true);
			
			$data['header'] = $this->load->view('templates/header', null, true);
		}
		
		$this->load->view('templates/main', $data);
	}
	
	public function by_date($year, $month, $day)
	{
		$content_data['events'] = $this->events_model->get_events_by_date_with_main_images($year, $month, $day);
		
		if ($content_data['events']) {
			if ($this->events_model->is_event_the_last($content_data['events'][count($content_data['events']) - 1]) == false)
				$content_data['prev_url'] = $this->get_prev_url($content_data['events']);
			
			if ($this->events_model->is_event_the_first($content_data['events'][0]) == false)
				$content_data['next_url'] = $this->get_next_url($content_data['events']);
			
			$data['content'] = $this->load->view('events/index', $content_data, true);
		}
		else
			$data['content'] = $this->load->view('events/no-events', null, true);
		
		$header_data['active_year'] = $year;
		$data['header'] = $this->load->view('templates/header', $header_data, true);
		
		$this->load->view('templates/main', $data);
	}

	
	private function getYear($events, $selected_year) {
		if (count($events) == 0)
			return $selected_year;
		else
			return substr($events[0]['date'], 0, 4);
	}
	
	private function get_prev_url($events) {
		$last_date = $events[count($events) - 1]['date'];
		
		$prev_date = new DateTime($last_date);
		$prev_date->sub(new DateInterval('P1D'));
		
		return $prev_date->format('Y/m/d');
	}
	
	private function get_next_url($events) {
		$next_events = $this->events_model->get_events_by_date_reverse($events[0]['date']);
		
		$next_date = new DateTime($next_events[count($next_events) - 1]['date']);
		
		return $next_date->format('Y/m/d');
	}
}