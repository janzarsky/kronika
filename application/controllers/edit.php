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
		
		if ($this->form_validation->run() == FALSE) {
			$content_data['can_publish'] = $this->user_model->get_permissions()['can_publish'];
			$content_data['event'] = $this->edit_model->get_event($event_id);
			$data['content'] = $this->load->view('edit/edit', $content_data, true);
			
			$header_data['name'] = $this->user_model->get_name();
			$header_data['permissions'] = $this->user_model->get_permissions();
			$data['header'] = $this->load->view('templates/admin_header', $header_data, true);
			
			$this->load->view('templates/admin', $data);
		}
		else {
			echo "success" . $this->input->post('date') . ' ' . $this->date_precision;
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
		
		$all_words = explode(' ', $str);
		
		foreach ($all_words as $word)
			if ($this->form_validation->integer($word))
				$legit_words[] = array('value' => $word, 'type' => 'int', 'date_type' => '');
			else {
				$month = $this->get_month_from_string($word);
				
				if ($month != false)
					$legit_words[] = array('value' => $month, 'date_type' => 'month');
			}
		
		foreach ($legit_words as $key => $word)
			if ($word['date_type'] == '' && $word['type'] == 'int') {
				if ($word['value'] >= 2200) {
					$this->form_validation->set_message('date', 'Špatný formát data');
					return false;
				}
				else if ($word['value'] >= 1900) {
					$legit_words[$key]['date_type'] = 'year';
				}
				else if ($word['value'] > 31) {
					$this->form_validation->set_message('date', 'Špatný formát data');
					return false;
				}
				else if ($word['value'] <= 0) {
					$this->form_validation->set_message('date', 'Špatný formát data');
					return false;
				}
				else {
					$legit_words[$key]['date_type'] = 'day_or_month';
				}
			}
		
		$count = count($legit_words);
		
		if ($count == 0) {
			$this->form_validation->set_message('date', 'Špatný formát data');
			return false;
		}
		else if ($count == 1) {
			if ($legit_words[0]['date_type'] == 'year') {
				$this->date_precision = 1;
				return $legit_words[0]['value'] . '-12-31';
			}
		}
		else if ($count == 2) {
			if ($legit_words[0]['date_type'] == 'year' && $legit_words[1]['date_type'] == 'day_or_month') {
				$temp = $legit_words[0];
				$legit_words[0] = $legit_words[1];
				$legit_words[1] = $temp;
			}
			
			if ($legit_words[0]['date_type'] == 'month_or_day' && $legit_words[1]['date_type'] == 'year') {
				$this->date_precision = 2;
				return $legit_words[1]['value'] . '-' . $legit_words[0]['value'] . '-'
					. get_last_day_in_month($legit_words[1]['value'], $legit_words[0]['value']);
			}
		}
		else
			return false;
	}
	
	function get_month_from_string($str) {
		$months = array(
			'leden' => 1, 'ledna' => 1,
			'únor' => 2, 'února' => 2,
			'březen' => 3, 'března' => 3,
			'duben' => 4, 'dubna' => 4,
			'květen' => 5, 'května' => 5,
			'červen' => 6, 'června' => 6,
			'červenec' => 7, 'července' => 7,
			'srpen' => 8, 'srpna' => 8,
			'září' => 9, 'září' => 9,
			'říjen' => 10, 'října' => 10,
			'listopad' => 11, 'listopadu' => 11,
			'prosinec' => 12, 'prosince' => 12
		);
		
		if (key_exists($str, $months))
			return $months[$str];
		else
			return false;
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
}