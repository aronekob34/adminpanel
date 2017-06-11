<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Controller {
	public function index() {
	}
	public function add() {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag'])) {
			$request_fields = array('title' => true, 'description' => true, 'content' => true);
			$request_form_success = true;
			foreach($request_fields as $request_field => $required) {
				if(!isset($requests[$request_field])) {
					$request_form_success = false;
					break;
				} else {
					if($required && ($requests[$request_field] == '')) {
						$request_form_success = false;
						break;
					}
				}
			}
			if(!$request_form_success) {
				$response['result'] = 0;
				$response['report']['status'] = 0;
				$response['report']['msg'] = 'Please fill the form correctly';
			} else {
				$result = $this->api_model->add_service($requests);
				if ($result['state'] == 1) {
					$response['result'] = 1;
				} else if ($result['state'] == 2) {
					$response['result'] = 0;
					$response['report']['status'] = 2;
					$response['report']['msg'] = 'Same data already exists in the table.';
				} else if ($result['state'] == 3) {
					$response['result'] = 0;
					$response['report']['status'] = 2;
					$response['report']['msg'] = $result['msg'];
				} else {
					$response['result'] = 0;
					$response['report']['status'] = 3;
				}
			}
		}
		$page_title = 'Add Service';
		$page_link = 'services/add';
		$breadcrumb = array(
			'Services' => '',
			'Manage Services' => '',
			'Add Service' => $page_link
		);
		$data = array();
		$data['services'] = $this->be_model->get_services();
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
	public function edit($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag']) && isset($edit_id)) {
			$request_fields = array('title' => true, 'description' => true, 'content' => true, 'image' => true);
			$request_form_success = true;
			foreach($request_fields as $request_field => $required) {
				if(!isset($requests[$request_field])) {
					$request_form_success = false;
					break;
				} else {
					if($required && $requests[$request_field] == '') {
						$request_form_success = false;
						break;
					}
				}
			}

			if(!$request_form_success) {
				$response['result'] = 0;
				$response['report']['status'] = 0;
				$response['report']['msg'] = 'Please fill the form correctly';
			} else {
				$result = $this->api_model->edit_service($requests, $edit_id);
				if ($result['state'] == 1) {
					$response['result'] = 1;
				} else if ($result['state'] == 0) {
					$response['result'] = 0;
					$response['report']['status'] = 2;
					$response['report']['msg'] = 'Please upload new image file.';
				} else if ($result['state'] == 2) {
					$response['result'] = 0;
					$response['report']['status'] = 2;
					$response['report']['msg'] = 'Same data already exists in the table.';
				} else if ($result['state'] == 3) {
					$response['result'] = 0;
					$response['report']['status'] = 2;
					$response['report']['msg'] = $result['msg'];
				} else {
					$response['result'] = 0;
					$response['report']['status'] = 3;
				}
			}
		} else if(isset($requests['tag']) && isset($requests['remove_id'])) {
			$this->api_model->remove_service($requests['remove_id']);
			$response['result'] = 1;
		}
		$page_title = 'Edit Services';
		$page_link = 'services/edit';
		$breadcrumb = array(
				'Services' => '',
				'Manage Services' => '',
				'Edit Service' => $page_link
		);
		$data = array();
		$data['services'] = $this->be_model->get_services();
		
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
}