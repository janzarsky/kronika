<?php
class Events_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_event_with_main_image($id) {
		$events = $this->db
			->select('events.*, media.id as main_image_id')
			->from('events')
			->join('media', 'media.event_id = events.id AND media.main = 1 AND media.type = 0', 'left')
			->where('events.id', $id)
			->where('events.published', 1)
			->get()->result_array();
		
		if (count($events) > 0) {
			$events = $this->add_friendly_date($events);
			return $events[0];
		}
		else
			return false;
	}
	
	public function get_event_by_url_with_main_image($url) {
		$events = $this->db
			->select('events.*, media.id as main_image_id')
			->from('events')
			->join('media', 'media.event_id = events.id AND media.main = 1 AND media.type = 0', 'left')
			->where('events.url', $url)
			->where('events.published', 1)
			->get()->result_array();
		
		if (count($events) > 0) {
			$events = $this->add_friendly_date($events);
			return $events[0];
		}
		else
			return false;
	}
	
	public function get_events_with_main_images() {
		$events = $this->db
			->select('events.*, media.id as main_image_id')
			->from('events')
			->join('media', 'media.event_id = events.id AND media.main = 1 AND media.type = 0', 'left')
			->where('events.published', 1)
			->limit($this->config->item('posts_per_page'))
			->order_by('events.date', 'desc')
			->get()->result_array();
		
		if (count($events) > 0) {
			$events = array_merge($events, $this->get_prev_events_with_same_date($events[count($events) - 1]));
			
			$events = $this->add_friendly_date($events);
			
			return $events;
		}
		else
			return false;
	}
	
	public function get_events_by_date_with_main_images($year, $month, $day) {
		$date = $this->get_date_string($year, $month, $day);
		
		$events = $this->db
			->select('events.*, media.id as main_image_id')
			->from('events')
			->join('media', 'media.event_id = events.id AND media.main = 1 AND media.type = 0', 'left')
			->where('events.published', 1)
			->where('date <=', $date)
			->limit($this->config->item('posts_per_page'))
			->order_by('date', 'desc')
			->get()->result_array();
		
		if (count($events) > 0) {
			$events = array_merge($events, $this->get_prev_events_with_same_date($events[count($events) - 1]));
			
			$events = $this->add_friendly_date($events);
			
			return $events;
		}
		else
			return false;
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
	
	private function get_year($date) {
		return substr($date, 0, 4);
	}
	
	private function get_month($date) {
		return substr($date, 5, 2);
	}
	
	private function get_day($date) {
		return substr($date, 8, 2);
	}
	
	private function get_month_name_in_genitive($month) {
		$arr = array(1 => 'ledna', "února", "března", "dubna", "května", "června",
								 "července", "srpna", "září", "října", "listopadu", "prosince");
		return $arr[intval($month)];
	}
	
	private function get_month_name_in_nominative($month) {
		$arr = array(1 => "leden", "únor", "březen", "duben", "květen", "červen",
								 "červenec", "srpen", "září", "říjen", "listopad", "prosinec");
		return $arr[intval($month)];
	}
	
	private function get_prev_events_with_same_date($event) {
		return $this->db
			->select('*')
			->from('events')
			->where('date', $event['date'])
			->where('events.published', 1)
			->where('id >', $event['id'])
			->get()->result_array();
	}
	
	public function get_main_image($event_id) {
		$media = $this->db
			->select('*')
			->from('media')
			->where('event_id', $event_id)
			->where('main', '1')
			->where('type', '0')
			->get()->row_array();
		
		if (count($media) > 0)
			return $media;
		else
			return false;
	}
	
	public function get_media($event_id) {
		$media = $this->db
			->select('*')
			->from('media')
			->where('event_id', $event_id)
			->get()->result_array();
		
		if (count($media) > 0)
			return $media;
		else
			return false;
	}
	
	public function get_events_by_date_reverse($date) {
		$events = $this->db
			->select('id, date')
			->from('events')
			->where('date >', $date)
			->where('events.published', 1)
			->order_by('date', 'asc')
			->limit($this->config->item('posts_per_page'))
			->get()->result_array();
		
		if (count($events) > 0)
			return $events;
		else
			return false;
	}
	
	public function is_event_the_first($event) {
		return $this->db
			->select('id')
			->from('events')
			->where('date >=', $event['date'])
			->where('id <', $event['id'])
			->get()->num_rows() == 0;
	}
	
	public function is_event_the_last($event) {
		return $this->db
			->select('id')
			->from('events')
			->where('date <=', $event['date'])
			->where('id >', $event['id'])
			->get()->num_rows() == 0;
	}
}