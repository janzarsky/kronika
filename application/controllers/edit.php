<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('edit_model');
	}

	public function index()
	{
		
	}
}