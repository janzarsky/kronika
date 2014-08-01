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
			->get()->result_array();
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
}