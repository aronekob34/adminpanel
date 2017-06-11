<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_videos extends CI_Controller {
	public function index() {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag'])) {
			$request_fields = array();
			for($i = 1; $i <= config_item('home_videos_count'); $i++) {
				$request_fields[] = 'video' . $i;
			}
			$request_form_success = true;
			foreach($request_fields as $request_field) {
				if(!isset($requests[$request_field]) || (isset($requests[$request_field]) && $requests[$request_field] == '')) {
					$request_form_success = false;
					break;
				}
			}
			if(!$request_form_success) {
				$response['result'] = 0;
				$response['report']['status'] = 0;
				$response['report']['msg'] = 'Please fill the form correctly';
			} else {
				$result = $this->api_model->edit_home_videos($requests);
				if ($result['state'] == 1) {
					$response['result'] = 1;
					//redirect('/product_categories/edit');
				} else {
					$response['result'] = 0;
					$response['report']['status'] = 2;
					$response['report']['msg'] = $result['msg'];
				}
			}
		}
		$page_title = 'Edit Home Page Videos';
		$page_link = 'home_videos';
		$breadcrumb = array(
				'Home Page - Video Tutorial' => $page_link
		);
		$data = array();
		$data['home_page_settings'] = $this->be_model->get_home_page_settings();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array_merge(array('page_title' => $page_title, 'breadcrumb' => $breadcrumb), $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
		
	}
}