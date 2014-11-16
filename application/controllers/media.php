<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('media_model');
		$this->load->model('user_model');
		
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('image_lib');
		
		$this->load->helper('form');
		$this->load->helper('language');
	}

	public function index($event_id = 0)
	{
		$this->user_model->check_login_with_redirect();
		
		$this->form_validation->set_rules('delete', 'Odstranit', '');
		
		if ($this->form_validation->run() == false) {
			$content_data['event_id'] = $event_id;
			$content_data['medias'] = $this->media_model->get_medias($event_id);
			$data['content'] = $this->load->view('media/edit', $content_data, true);
			
			$header_data['name'] = $this->user_model->get_name();
			$header_data['permissions'] = $this->user_model->get_permissions();
			$data['header'] = $this->load->view('templates/admin_header', $header_data, true);
			
			$this->load->view('templates/admin', $data);
		}
		else {
			$this->media_model->update_main_image($this->input->post('main'), $event_id);
			$this->delete_media();
			
			$this->session->set_flashdata('message', 'Obrázky jsou uloženy. <a href="' . base_url('/d/' . $event_id) .
																		'" target="_blank">Zobrazit událost</a>');
			
			redirect('/media/' . $event_id);
		}
	}
	
	public function upload($event_id) {
		$this->user_model->check_login_with_redirect();
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg';
		$this->upload->initialize($config);
		
		if ($this->upload->do_upload() == false) {
			$this->session->set_flashdata('message_type', 'danger');
			$this->session->set_flashdata('message', $this->upload->display_errors());
			
			redirect('/media/' . $event_id);
		}
		else {
			$this->process_image($this->upload->data(), $event_id);
			
			$this->session->set_flashdata('message', 'Obrázek je nahrán');
			
			redirect('/media/' . $event_id);
		}
	}
	
	function process_image($upload_data, $event_id) {
		$id = $this->media_model->add_media($event_id);
		
		$images_path = FCPATH . 'public/media/images/';
		
		$heights = array(1080, 768, 420, 210);
		
		$config['quality']	= 75;
		$config['maintain_ratio'] = TRUE;
		
		foreach ($heights as $height) {
			copy($upload_data['full_path'], $images_path . 'h' . $height . 'px/' . $id . '.jpg');
			
			if ($upload_data['image_height'] >= $height) {
				$config['source_image']	= $images_path . 'h' . $height . 'px/' . $id . '.jpg';
				$config['height']	= $height;
				
				$this->image_lib->initialize($config);
				
				$this->image_lib->resize();
			}
		}
		
		copy($upload_data['full_path'], $images_path . 'thumb/' . $id . '.jpg');
			
		$config['source_image']	= $images_path . 'thumb/' . $id . '.jpg';
		$config['quality']	= 30;
		$config['height']	= 100;
		$config['width']	= 100;
		
		$this->image_lib->initialize($config);
		
		$this->image_lib->resize();
		
		unlink($upload_data['full_path']);
	}
	
	function delete_media() {
		$ids = $this->input->post('delete');
		
		if ($ids == null)
			$ids = array();
		
		$this->media_model->delete_media($ids);
		
		$heights = array(1080, 768, 420, 210);
		$images_path = FCPATH . 'public/media/images/';
		
		foreach ($ids as $id) {
			foreach ($heights as $height) {
				unlink($images_path . 'h' . $height . 'px/' . $id . '.jpg');
			}
			
			unlink($images_path . 'thumb/' . $id . '.jpg');
		}
	}
}