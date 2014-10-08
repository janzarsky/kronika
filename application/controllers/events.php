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
		$data['content'] = $this->load->view('events/index', $content_data, true);
		
		$this->load->view('templates/main', $data);
	}
	
	public function by_id($id)
	{
		$content_data['event'] = $this->events_model->get_event_with_main_image($id);
		$content_data['event']['media'] = $this->events_model->get_media($id);
		$data['content'] = $this->load->view('events/detail', $content_data, true);
		
		$header_data['active_year'] = $this->getYear(array($content_data['event']), date('Y'));
		$data['header'] = $this->load->view('templates/header', $header_data, true);
		
		$this->load->view('templates/main', $data);
	}
	
	public function by_url($url)
	{
		$content_data['event'] = $this->events_model->get_event_by_url_with_main_image($url);
		$content_data['event']['media'] = $this->events_model->get_media($content_data['event']['id']);
		$data['content'] = $this->load->view('events/detail', $content_data, true);
		
		$header_data['active_year'] = $this->getYear(array($content_data['event']), date('Y'));
		$data['header'] = $this->load->view('templates/header', $header_data, true);
		
		$this->load->view('templates/main', $data);
	}
	
	public function by_date($year, $month, $day)
	{
		$content_data['events'] = $this->events_model->get_events_by_date_with_main_images($year, $month, $day);
		$data['content'] = $this->load->view('events/index', $content_data, true);
		
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
}