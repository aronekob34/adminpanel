<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Restaurants extends CI_Controller {
	public function index() {
		
	}
	
	public function view($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();

		$page_title = 'Restaurants List';
		$page_link = 'restaurants/view';
		$breadcrumb = array(
				'Restaurants' => '',
				'List' => $page_link
		);
		$data = array();
		$data['restaurants'] = $this->be_model->get_restaurants();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
	
}