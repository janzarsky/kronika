<?php
class Events_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_events($limit) {
		return $this->db
			->select('*')
			->from('events')
			->limit($limit)
			->order_by('date', 'desc')
			->get()->result_array();
	}
	
	public function get_event($id) {
		return $this->db
			->select('*')
			->from('events')
			->where('id', $id)
			->get()->row_array();
	}
	
	public function get_event_by_url($url) {
		return $this->db
			->select('*')
			->from('events')
			->where('url', $url)
			->get()->row_array();
	}
	
	public function get_events_by_year($year, $limit) {
		if (checkdate(1, 1, $year))
			return $this->get_events_by_date($year . '-12-31', $limit);
		else
			throw new Exception('Not a valid date');
	}
	
	public function get_events_by_month($year, $month, $limit) {
		if (checkdate($month, 1, $year))
			return $this->get_events_by_date($year . '-' . $month . '-' . $this->get_last_day_in_month($year, $month), $limit);
		else
			throw new Exception('Not a valid date');
	}
	
	private function get_last_day_in_month($year, $month) {
		if (checkdate($month, 31, $year))
			return 31;
		else if (checkdate($month, 30, $year))
			return 30;
		else if (checkdate($month, 29, $year))
			return 29;
		else if (checkdate($month, 28, $year))
			return 28;
		else
			return 0;
	}
	
	public function get_events_by_day($year, $month, $day, $limit) {
		if (checkdate($month, $day, $year))
			return $this->get_events_by_date($year . '-' . $month . '-' . $day, $limit);
		else
			throw new Exception('Not a valid date');
	}
	
	private function get_events_by_date($date, $limit) {
		return $this->db
			->select('*')
			->from('events')
			->where('date <=', $date)
			->limit($limit)
			->order_by('date', 'desc')
			->get()->result_array();
	}
	
	public function add_headers($events) {
		$events_per_year = 0;
		
		foreach ($events as $key => $event) {
			if ($key == 0
					|| $this->get_year($events[$key-1]['date']) != $this->get_year($events[$key]['date'])
					|| $key == count($events)-1) {
				if ($key == 0 || $this->get_year($events[$key-1]['date']) != $this->get_year($events[$key]['date']))
					$events[$key]['year_header'] = $this->get_year($event['date']);
				
				if ($events_per_year >= 3) {
					for ($i = $first_event_in_year; $i < $key; $i++) {
						if ($i == $first_event_in_year || $this->get_month($events[$i-1]['date']) != $this->get_month($events[$i]['date']))
							$events[$i]['month_header'] = $this->get_month_name($this->get_month($events[$i]['date']));
					}
				}
				
				$events_per_year = 1;
				$first_event_in_year = $key;
			}
			else
				$events_per_year++;
		}
		
		return $events;
	}
	
	public function get_images($event_id) {
		return $this->db
			->select('images.*')
			->from('images')
			->join('events_images', 'events_images.image_id = images.id')
			->where('events_images.event_id', $event_id)
			->get()->result_array();
	}
	
	public function add_images($events) {
		foreach ($events as $key => $event) {
			$events[$key]['images'] = $this->get_images($event['id']);
		}
		
		return $events;
	}
	
	private function get_year($date) {
		return substr($date, 0, 4);
	}
	
	private function get_month($date) {
		return substr($date, 5, 2);
	}
	
	private function get_month_name($month) {
		switch ($month) {
			case 1:
				return "January";
			case 2:
				return "February";
			case 3:
				return "March";
			case 4:
				return "April";
			case 5:
				return "May";
			case 6:
				return "June";
			case 7:
				return "July";
			case 8:
				return "August";
			case 9:
				return "September";
			case 10:
				return "October";
			case 11:
				return "November";
			case 12:
				return "December";
		}
	}
}