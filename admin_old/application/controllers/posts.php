<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {
	public function index() {
	}
	public function edit($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag']) && isset($requests['remove_id'])) {
			$this->api_model->remove_post($requests['remove_id']);
			$response['result'] = 1;
		}
		$page_title = 'Posted Workouts';
		$page_link = 'posts/edit';
		$breadcrumb = array(
				'Posted Workouts' => $page_link
		);
		$data = array();
		$data['posts'] = $this->be_model->get_posts();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
}