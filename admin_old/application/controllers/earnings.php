<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Earnings extends CI_Controller {
	
	public function index($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
		
		$page_title = 'Earnings';
		$page_link = 'earnings';
		$breadcrumb = array(
				'Earnings' => $page_link
		);
		$data = array();
		$data['earnings'] = $this->be_model->get_earnings();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
}