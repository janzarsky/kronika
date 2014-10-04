<?php
class Events_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_event($id) {
		$events = $this->db
			->select('*')
			->from('events')
			->where('events.id', $id)
			->get()->result_array();
		
		$events = $this->add_friendly_date($events);
		
		return $event[0];
	}
	
	public function get_event_with_main_image($id) {
		$events = $this->db
			->select('events.*, media.id as main_image_id')
			->from('events')
			->join('media', 'media.event_id = events.id AND media.main = 1 AND media.type = 0', 'left')
			->where('events.id', $id)
			->get()->result_array();
		
		$events = $this->add_friendly_date($events);
		
		return $events[0];
	}
	
	public function get_event_by_url($url) {
		$events = $this->db
			->select('*')
			->from('events')
			->where('events.url', $url)
			->get()->result_array();
		
		$events = $this->add_friendly_date($events);
		
		return $events[0];
	}
	
	public function get_event_by_url_with_main_image($url) {
		$events = $this->db
			->select('events.*, media.id as main_image_id')
			->from('events')
			->join('media', 'media.event_id = events.id AND media.main = 1 AND media.type = 0', 'left')
			->where('events.url', $url)
			->get()->result_array();
		
		$events = $this->add_friendly_date($events);
		
		return $events[0];
	}
	
	public function get_events() {
		return $this->db
			->select('*')
			->from('events')
			->limit(10)
			->order_by('date', 'desc')
			->get()->result_array();
	}
	
	public function get_events_with_main_images() {
		$events = $this->db
			->select('events.*, media.id as main_image_id')
			->from('events')
			->join('media', 'media.event_id = events.id AND media.main = 1 AND media.type = 0', 'left')
			->limit(10)
			->order_by('events.date', 'desc')
			->get()->result_array();
		
		$events = $this->add_friendly_date($events);
		
		return $events;
	}
	
	public function get_events_by_date_with_main_images($year, $month, $day) {
		$date = $this->get_date_string($year, $month, $day);
		
		$events = $this->db
			->select('events.*, media.id as main_image_id')
			->from('events')
			->join('media', 'media.event_id = events.id AND media.main = 1 AND media.type = 0', 'left')
			->where('date <=', $date)
			->limit($limit)
			->order_by('date', 'desc')
			->get()->result_array();
		
		$events = $this->add_friendly_date($events);
		
		return $events;
	}
	
	private function get_date_string($year, $month, $day) {
		if ($day == 0 && $month == 0 && $year == 0) {
			throw new Exception('Not a valid date');
		}
		else if ($day == 0 && $month == 0) {
			if (checkdate(1, 1, $year))
				return $year . '-12-31';
			else
				throw new Exception('Not a valid date');
		}
		else if ($day == 0) {
			if (checkdate($month, 1, $year))
				return $year . '-' . $month . '-' . $this->get_last_day_in_month($year, $month);
			else
				throw new Exception('Not a valid date');
		}
		else {
			if (checkdate($month, $day, $year))
				return $year . '-' . $month . '-' . $day;
			else
				throw new Exception('Not a valid date');
		}
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
	
	public function add_friendly_date($events) {
		$events_per_year = 0;
		
		foreach ($events as $key => $event) {
			$date = '';
			
			if ($event['date_precision'] >= 3)
				$date .= $this->get_day($event['date']) . '. ';
			
			if ($event['date_precision'] == 3)
				$date .= $this->get_month_name_in_genitive($this->get_month($event['date'])) . ' ';
			else if ($event['date_precision'] == 2)
				$date .= $this->get_month_name_in_nominative($this->get_month($event['date'])) . ' ';
			
			if ($event['date_precision'] >= 2)
				$date .= $this->get_year($event['date']);
			else if ($event['date_precision'] == 1)
				$date .= 'r. ' . $this->get_year($event['date']);
			
			$events[$key]['friendly_date'] = $date;
		}
		
		return $events;
	}
	
	public function get_images($event_id) {
		return $this->db
			->select('*')
			->from('media')
			->where('event_id', $event_id)
			->where('type', '0')
			->get()->result_array();
	}
	
	public function get_main_image($event_id) {
		return $this->db
			->select('*')
			->from('media')
			->where('event_id', $event_id)
			->where('main', '1')
			->where('type', '0')
			->get()->row_array();
	}
	
	public function get_media($event_id) {
		return $this->db
			->select('*')
			->from('media')
			->where('event_id', $event_id)
			->get()->result_array();
	}
	
	private function get_year($date) {
		return substr($date, 0, 4);
	}
	
	private function get_month($date) {
		return substr($date, 5, 2);
	}
	
	private function get_month_name_in_genitive($month) {
		switch ($month) {
			case 1:
				return "ledna";
			case 2:
				return "února";
			case 3:
				return "března";
			case 4:
				return "dubna";
			case 5:
				return "května";
			case 6:
				return "června";
			case 7:
				return "července";
			case 8:
				return "srpna";
			case 9:
				return "září";
			case 10:
				return "října";
			case 11:
				return "listopadu";
			case 12:
				return "prosince";
		}
	}
	
	private function get_month_name_in_nominative($month) {
		switch ($month) {
			case 1:
				return "leden";
			case 2:
				return "únor";
			case 3:
				return "březen";
			case 4:
				return "duben";
			case 5:
				return "květen";
			case 6:
				return "červen";
			case 7:
				return "červenec";
			case 8:
				return "srpen";
			case 9:
				return "září";
			case 10:
				return "říjen";
			case 11:
				return "listopad";
			case 12:
				return "prosinec";
		}
	}
	
	private function get_day($date) {
		return substr($date, 8, 2);
	}
}