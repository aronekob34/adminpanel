<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	public function index() {
		
	}

	public function system_managers($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();

		if($requests['submitted'] == "Cancel") {
			$response['result'] = 0;
		} else {
			if(isset($requests['tag']) && isset($requests['remove_id'])) {
				$this->api_model->remove_system_manager($requests['remove_id']);
				$response['result'] = 1;
			} else if(isset($requests['tag']) && isset($requests['edit_id'])) {
				$request_fields = array('full_name', 'email', 'phone_number', 'gender', 'password');
				$request_form_success = true;
				foreach ($request_fields as $request_field) {
					if(!(isset($requests[$request_field]) && $requests[$request_field] != '')) {
						$request_form_success = false;
						break;
					}
				}
				if (!$request_form_success) {
					$response['result'] = 2;
				} else {
					$this->api_model->edit_system_manager($requests);
					$response['result'] = 1;
				}				
			}
		}

		$page_title = 'System Managers';
		$page_link = 'users/system_managers';
		$breadcrumb = array('System Managers' => $page_link);
		$data = array();
		$data['system_managers'] = $this->be_model->get_system_managers();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}

	public function business_managers($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();

		if($requests['submitted'] == "Cancel") {
			$response['result'] = 0;
		} else {
			if(isset($requests['tag']) && isset($requests['remove_id'])) {
				$this->api_model->remove_business_manager($requests['remove_id']);
				$response['result'] = 1;
			} else if(isset($requests['tag']) && isset($requests['edit_id'])) {
				$request_fields = array('full_name', 'email', 'phone_number', 'gender', 'password');
				$request_form_success = true;
				foreach ($request_fields as $request_field) {
					if(!(isset($requests[$request_field]) && $requests[$request_field] != '')) {
						$request_form_success = false;
						break;
					}
				}
				if (!$request_form_success) {
					$response['result'] = 2;
				} else {
					$this->api_model->edit_business_manager($requests);
					$response['result'] = 1;
				}				
			}
		}

		$page_title = 'Business Managers';
		$page_link = 'users/business_managers';
		$breadcrumb = array('Business Managers' => $page_link);
		$data = array();
		$data['business_managers'] = $this->be_model->get_business_managers();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}

	public function general_users($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();

		if($requests['submitted'] == "Cancel") {
			$response['result'] = 0;
		} else {
			if(isset($requests['tag']) && isset($requests['remove_id'])) {
				$this->api_model->remove_business_manager($requests['remove_id']);
				$response['result'] = 1;
			} else if(isset($requests['tag']) && isset($requests['edit_id'])) {
				$request_fields = array('full_name', 'email', 'phone_number', 'gender', 'password');
				$request_form_success = true;
				foreach ($request_fields as $request_field) {
					if(!(isset($requests[$request_field]) && $requests[$request_field] != '')) {
						$request_form_success = false;
						break;
					}
				}
				if (!$request_form_success) {
					$response['result'] = 2;
				} else {
					$this->api_model->edit_business_manager($requests);
					$response['result'] = 1;
				}				
			}
		}

		$page_title = 'Users';
		$page_link = 'users/general_users';
		$breadcrumb = array('Users' => $page_link);
		$data = array();
		$data['users'] = $this->be_model->get_users();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}



	
	public function users_edit($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag']) && isset($requests['remove_id'])) {
			$this->api_model->remove_user($requests['remove_id']);
			$response['result'] = 1;
		} else if(isset($requests['tag']) && isset($requests['suspend_id'])) {
			$this->api_model->suspend_user($requests['suspend_id'], 1);
			$response['result'] = 1;
		}
		$page_title = 'Wagz Pet Owners';
		$page_link = 'users/users_edit';
		$breadcrumb = array(
				'Pet Owners' => '',
				'Users' => $page_link
		);
		$data = array();
		$data['users'] = $this->be_model->get_users();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
	
	public function approve($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag']) && isset($requests['remove_id'])) {
			$this->api_model->remove_user($requests['remove_id']);
			$response['result'] = 1;
		} else if(isset($requests['tag']) && isset($requests['approve_id'])) {
			$this->api_model->approve_user($requests['approve_id'], 1);
			$response['result'] = 1;
		}
		$page_title = 'Approve Registration';
		$page_link = 'users/approve';
		$breadcrumb = array(
				'Registered Users' => '',
				'Approve Registration' => $page_link
		);
		$data = array();
		$data['users'] = $this->be_model->get_users('approve');
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
	
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
	
	public function suspended_users($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag']) && isset($requests['remove_id'])) {
			$this->api_model->remove_user($requests['remove_id']);
			$response['result'] = 1;
		} else if(isset($requests['tag']) && isset($requests['suspend_id'])) {
			$this->api_model->suspend_user($requests['suspend_id'], 0);
			$response['result'] = 1;
		}
		$page_title = 'Suspended Users';
		$page_link = 'users/suspended_users';
		$breadcrumb = array(
				'Pet Owners' => '',
				'Suspended Users' => $page_link
		);
		$data = array();
		$data['users'] = $this->be_model->get_users('suspended');
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
	
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
	
}