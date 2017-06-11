<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_info extends CI_Controller {
	public function index() {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag'])) {
			$request_fields = array('site_title' => true, 'site_name' => true, 'meta_keywords' => false, 'meta_description' => false, 'owner_phone' => false, 'owner_fax' => false, 'owner_email' => true, 'owner_address' => false, 'owner_visit_address' => false, 'owner_site' => true, 'site_url_name' => true, 'from_email' => true);
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
				$result = $this->api_model->edit_site_info($requests);
				if ($result['state'] == 1) {
					$response['result'] = 1;
					//redirect('/product_categories/edit');
				} else {
					$response['result'] = 0;
					$response['report']['status'] = 2;
				}
			}
		}
		$page_title = 'Edit General Information';
		$page_link = 'site_info';
		$breadcrumb = array(
				'General Information' => $page_link
		);
		$data = array();
		//$data['site_info'] = $this->be_model->get_site_info();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array_merge(array('page_title' => $page_title, 'breadcrumb' => $breadcrumb), $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
}