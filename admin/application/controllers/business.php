<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Business extends CI_Controller {
	public function index() {
		
	}

	public function new_business() {
		$page_title = 'Registration';
		$page_link = 'business/new_business';
		$breadcrumb = array('Businesses' => '', 'Registration' => $page_link);
		
		$data = array();
		$data['categories'] = $this->be_model->get_categories();

		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param);
	}
	
	public function business_list($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag']) && isset($requests['remove_id'])) {
			$this->api_model->remove_group($requests['remove_id']);
			$response['result'] = 1;
		}
		$page_title = 'Active Businesses';
		$page_link = 'business/business_list';
		$breadcrumb = array(
				'Businesses' => '',
				'Active Businesses' => $page_link
		);
		$data = array();
		$data['businesses'] = $this->be_model->get_businesses();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
}