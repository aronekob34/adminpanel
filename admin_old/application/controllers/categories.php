<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {
	public function index() {
		
	}

	public function new() {
		$page_title = 'Registration';
		$page_link = 'businesses/business_new';
		$breadcrumb = array(
				'Businesses' => '',
				'Registration' => $page_link
		);
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb);
		$this->be_page->generate(true, $page_link, $data_param);
	}
	
	public function categories($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag']) && isset($requests['remove_id'])) {
			$this->api_model->remove_group($requests['remove_id']);
			$response['result'] = 1;
		}
		$page_title = 'Business Categories';
		$page_link = 'businesses/business_categories';
		$breadcrumb = array(
				'Businesses' => '',
				'Business Categories' => $page_link
		);
		$data = array();
		$data['categories'] = $this->be_model->get_categories();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}	
}