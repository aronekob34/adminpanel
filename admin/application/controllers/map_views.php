<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map_views extends CI_Controller {
	public function index() {
		
	}
	
	public function customers($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();

		$page_title = 'Location of Customers';
		$page_link = 'map_views/customers';
		$breadcrumb = array(
				'Map View' => '',
				'Customers' => $page_link
		);
		$data = array();
		$data['users'] = $this->be_model->get_users('customer');
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
	
	public function muvers($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag']) && isset($requests['remove_id'])) {
			$this->api_model->remove_user($requests['remove_id']);
			$response['result'] = 1;
		}
		$page_title = 'Location of Müvers';
		$page_link = 'map_views/muvers';
		$breadcrumb = array(
				'Map View' => '',
				'Müvers' => $page_link
		);
		$data = array();
		$data['users'] = $this->be_model->get_users('muver');
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
	
}