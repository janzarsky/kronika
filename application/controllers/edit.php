<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends CI_Controller {
	
	private $date_precision = false;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('edit_model');
		$this->load->model('user_model');
		
		$this->load->library('form_validation');
		
		$this->load->helper('form');
		$this->load->helper('language');
	}

	public function index($event_id = 0)
	{
		$this->user_model->check_login_with_redirect();
		
		$this->form_validation->set_rules('title', 'Titulek', 'trim|required|xss_clean|min_length[3]|max_length[60]|callback_special_chars');
		$this->form_validation->set_rules('date', 'Datum', 'trim|required|xss_clean|callback_date');
		$this->form_validation->set_rules('url', 'URL', 'trim|required|xss_clean|callback_url');
		$this->form_validation->set_rules('text', 'Text', 'trim|xss_clean|max_length[700]|callback_special_chars');
		$this->form_validation->set_rules('importance', 'Důležitost', 'required');
		$this->form_validation->set_rules('publish', '', '');
		$this->form_validation->set_rules('send_for_approval', '', '');
		
		if ($this->form_validation->run() == false) {
			$content_data['can_publish'] = $this->user_model->get_permissions()['can_publish'];
			
			if ($event_id == 0)
				$content_data['event'] = $this->get_empty_event();
			else
				$content_data['event'] = $this->edit_model->get_event($event_id);
			
			$data['content'] = $this->load->view('edit/edit', $content_data, true);
			
			$header_data['page'] = 'archive';
			$header_data['name'] = $this->user_model->get_name();
			$header_data['permissions'] = $this->user_model->get_permissions();
			$data['header'] = $this->load->view('templates/admin_header', $header_data, true);
			
			$this->load->view('templates/admin', $data);
		}
		else {
			$data = $this->get_event_data();
			
			if ($event_id == 0) {
				$event_id = $this->edit_model->add_event($data);
			}
			else
				$this->edit_model->update_event($event_id, $data);
			
			$this->session->set_flashdata('message', 'Událost je uložená. <a href="' . base_url('/d/' . $event_id) .
																		'" target="_blank">Zobrazit událost</a>');
			
			redirect('/edit/' . $event_id);
		}
	}
	
	public function delete($event_id = 0) {
		$this->user_model->check_login_with_redirect();
		
		if ($event_id != 0) {
			$this->edit_model->delete_event($event_id);
			
			$this->session->set_flashdata('message', 'Událost byla smazána. <a href="' . base_url('/edit/restore/' . $event_id) .
																		'">Vrátit zpět</a>');
			
			redirect('/archive');
		}
	}
	
	public function restore($event_id = 0) {
		$this->user_model->check_login_with_redirect();
		
		if ($event_id != 0) {
			$this->edit_model->restore_event($event_id);
			
			$this->session->set_flashdata('message', 'Událost byla obnovena. <a href="' . base_url('/edit/' . $event_id) .
																		'">Upravit událost</a>');
			
			redirect('/archive');
		}
	}
	
	function url($str) {
    $str = strtolower(convert_to_ascii($str));
    $str = preg_replace('/[^a-zA-Z0-9]+/u', '-', $str);
    $str = str_replace('--', '-', $str);
    $str = trim($str, '-');
		
		$str = strtolower($str);
		
		if (strlen($str) == 0) {
			$this->form_validation->set_message('url', 'Pole %s nesmí být prázdné');
			return false;
		}
		
		return $str;
	}
	
	function date($str) {
		$str = str_replace(array('-', '_', '/', '.', ','), ' ', $str);
		$str = preg_replace('/\s+/', ' ', $str);
		
		$words = explode(' ', $str);
		$count = count($words);
		
		if ($count > 3 || $count <= 0) {
			$this->form_validation->set_message('date', 'Špatný formát data');
			return false;
		}
		else if ($count == 1) {
			if ($words[0] < 2200 && $words[0] >= 1900) {
				$this->date_precision = 1;
				return $words[0] . '-12-31';
			}
			else {
				$this->form_validation->set_message('date', 'Špatný formát data');
				return false;
			}
		}
		else if ($count == 2) {
			if ($words[0] > $words[1]) {
				$temp = $words[0];
				$words[0] = $words[1];
				$words[1] = $temp;
			}
			
			if (checkdate($words[0], 1, $words[1]) && $words[1] < 2200 && $words[1] >= 1900) {
				$this->date_precision = 2;
				return $words[1] . '-' . $words[0] . '-' . get_last_day_in_month($words[1], $words[0]);
			}
			else {
				$this->form_validation->set_message('date', 'Špatný formát data');
				return false;
			}
		}
		else if ($count == 3) {
			if ($words[0] > $words[2]) {
				$temp = $words[0];
				$words[0] = $words[2];
				$words[2] = $temp;
			}
			
			if (checkdate($words[1], $words[0], $words[2]) && $words[2] < 2200 && $words[2] >= 1900) {
				$this->date_precision = 3;
				return $words[2] . '-' . $words[1] . '-' . $words[0];
			}
			else {
				$this->form_validation->set_message('date', 'Špatný formát data');
				return false;
			}
		}
	}
	
	function special_chars($str) {
		$html_chars = array("&#0;", "&#1;", "&#2;", "&#3;", "&#4;", "&#5;", "&#6;", "&#7;",
												"&#8;", "&#9;", "&#10;", "&#11;", "&#12;", "&#13;", "&#14;", "&#15;",
												"&#16;", "&#17;", "&#18;", "&#19;", "&#20;", "&#21;", "&#22;", "&#23;",
												"&#24;", "&#25;", "&#26;", "&#27;", "&#28;", "&#29;", "&#30;", "&#31;");
		
		$html = implode(',', $html_chars);
		
		$output = preg_replace_callback("/(&#[0-9]+;)/", function($m) { return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES"); }, $html); 
		
		$utf8_chars = explode(',', $output);
		
		$final =  str_replace($utf8_chars, '', $str);
		
		return $final;
	}
	
	function get_event_data() {
		$data = array(
			'title' => $this->input->post('title'),
			'text' => $this->input->post('text'),
			'url' => $this->input->post('url'),
			'date' => $this->input->post('date'),
			'date_precision' => $this->date_precision,
			'importance' => $this->input->post('importance'),
			'owner' => $this->user_model->get_id()
		);
		
		$permissions = $this->user_model->get_permissions();
		
		if ($permissions['can_publish'] && $this->input->post('publish')) {
			$data['published'] = true;
			$data['sent_for_approval'] = false;
		}
		else if ($permissions['can_publish'] == false && $this->input->post('send_for_approval')) {
			$data['sent_for_approval'] = true;
			$data['published'] = false;
		}
		else {
			$data['sent_for_approval'] = false;
			$data['published'] = false;
		}
		
		return $data;
	}
	
	function get_empty_event() {
		return array(
			'id' => 0,
			'title' => '',
			'text' => '',
			'date' => date('Y-m-d'),
			'date_precision' => 3,
			'importance' => 2,
			'url' => '',
			'sent_for_approval' => 0,
			'published' => 0
		);
	}
}