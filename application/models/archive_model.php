<?php
class Archive_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_user_events($user_id, $filter) {
		$this->db
			->select('id, title, date, date_precision, url, sent_for_approval, published')
			->from('events')
			->where('owner', $user_id)
			->where('deleted', 0);
		
		if ($filter === 'drafts')
			$this->db
				->where('sent_for_approval', 0)
				->where('published', 0);
		else if ($filter === 'sent-for-approval')
			$this->db
				->where('sent_for_approval', 1)
				->where('published', 0);
		else if ($filter === 'published')
			$this->db
				->where('sent_for_approval', 0)
				->where('published', 1);
		
		$this->db
			->order_by('date', 'DESC');
		
		$events = $this->db->get()->result_array();
		
		foreach ($events as $key => $event)
			if ($event['date_precision'] == 1)
				$events[$key]['friendly_date'] = substr($event['date'], 0, 4);
			else if ($event['date_precision'] == 2)
				$events[$key]['friendly_date'] = substr($event['date'], 5, 2) . '/' . substr($event['date'], 0, 4);
			else if ($event['date_precision'] == 3)
				$events[$key]['friendly_date'] = substr($event['date'], 8, 2) . '. ' . substr($event['date'], 5, 2)
					. '. ' . substr($event['date'], 0, 4);
		
		return $events;
	}
	
	public function get_all_events($user_id, $filter) {
		$this->db
			->select('events.id as id, title, date, date_precision, url, sent_for_approval, published, users.name as owner_name')
			->from('events')
			->join('users', 'users.id = events.owner')
			->where('events.deleted', 0);
		
		if ($filter === 'drafts')
			$this->db
				->where('sent_for_approval', 0)
				->where('published', 0);
		else if ($filter === 'sent-for-approval')
			$this->db
				->where('sent_for_approval', 1)
				->where('published', 0);
		else if ($filter === 'published')
			$this->db
				->where('sent_for_approval', 0)
				->where('published', 1);
		else if ($filter === 'user')
			$this->db
				->where('owner', $user_id);
		
		$this->db
			->order_by('date', 'DESC');
		
		$events = $this->db->get()->result_array();
		
		foreach ($events as $key => $event)
			if ($event['date_precision'] == 1)
				$events[$key]['friendly_date'] = substr($event['date'], 0, 4);
			else if ($event['date_precision'] == 2)
				$events[$key]['friendly_date'] = substr($event['date'], 5, 2) . '/' . substr($event['date'], 0, 4);
			else if ($event['date_precision'] == 3)
				$events[$key]['friendly_date'] = substr($event['date'], 8, 2) . '. ' . substr($event['date'], 5, 2)
					. '. ' . substr($event['date'], 0, 4);
		
		return $events;
	}
}