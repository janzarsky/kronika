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
		
		if ($event_id == 0)
			redirect('/archive');
		
		$this->user_model->check_rights_with_redirect($event_id);
		
		$this->form_validation->set_rules('delete', 'Odstranit', '');
		$this->form_validation->set_rules('text', 'Text', 'xss_clean');
		
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

			$this->media_model->update_texts($this->input->post('text'));
			
			$this->session->set_flashdata('message', 'Obrázky jsou uloženy. <a href="' . base_url('/d/' . $event_id) .
																		'" target="_blank">Zobrazit událost</a>');
			
			redirect('/media/' . $event_id);
		}
	}
	
	public function upload($event_id) {
		$this->user_model->check_login_with_redirect();
		
		if ($event_id == 0)
			redirect('/archive');
		
		$this->user_model->check_rights_with_redirect($event_id);
		
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg';
		$this->upload->initialize($config);
		
		if ($this->upload->do_multi_upload('files') == false) {
			$this->session->set_flashdata('message_type', 'danger');
			$this->session->set_flashdata('message', $this->upload->display_errors());
			
			redirect('/media/' . $event_id);
		}
		else {
			foreach ($this->upload->get_multi_upload_data() as $data)
				$this->process_image($data, $event_id);
			
			$this->session->set_flashdata('message', 'Obrázek je nahrán');
			
			redirect('/media/' . $event_id);
		}
	}
	
	function process_image($upload_data, $event_id) {
		$id = $this->media_model->add_media($event_id);
		
		$images_path = FCPATH . 'public/media/images/';
		
		$widths = array(1600, 1200, 960, 640, 320);
		
		$config['quality']	= 85;
		$config['maintain_ratio'] = TRUE;
		$config['height'] = 1;
		$config['master_dim'] = 'width';
		
		foreach ($widths as $width) {
			copy($upload_data['full_path'], $images_path . 'w' . $width . 'px/' . $id . '.jpg');
			
			if ($upload_data['image_width'] >= $width) {
				$config['source_image']	= $images_path . 'w' . $width . 'px/' . $id . '.jpg';
				$config['width']	= $width;
				
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