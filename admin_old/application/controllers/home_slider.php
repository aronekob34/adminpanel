<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_slider extends CI_Controller {
	public function index() {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag'])) {
			$request_fields = array('bg1', 'bg2', 'bg3', 's1_delay', 's2_delay', 's3_delay', 's1_p1', 's1_p2', 's2_p1', 's2_p2',
					's1_t1', 's1_t2', 's1_t3', 's2_t1', 's2_t2', 's3_t1', 's3_t2', 's3_t3');
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
				$result = $this->api_model->edit_home_slider($requests);
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
		$page_title = 'Edit Home Page Slider Contents';
		$page_link = 'home_slider';
		$breadcrumb = array(
				'Home Page Slider' => $page_link
		);
		$data = array();
		$data['home_slider'] = $this->be_model->get_home_slider();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array_merge(array('page_title' => $page_title, 'breadcrumb' => $breadcrumb), $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
		
	}
}