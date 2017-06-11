<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requests extends CI_Controller {
	public function index() {
		
	}
	
	public function all($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();

		$page_title = 'Requests';
		$page_link = 'requests/all';
		$breadcrumb = array(
				'Requests' => '',
				'All' => $page_link
		);
		$data = array();
		$data['requests'] = $this->be_model->get_requests('all');
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
	
	public function pending($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
	
		$page_title = 'Pending Requests';
		$page_link = 'requests/pending';
		$breadcrumb = array(
				'Requests' => '',
				'Pending' => $page_link
		);
		$data = array();
		$data['requests'] = $this->be_model->get_requests('pending');
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
	
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
	
	public function ongoing($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
	
		$page_title = 'Accepted Requests';
		$page_link = 'requests/ongoing';
		$breadcrumb = array(
				'Requests' => '',
				'Accepted' => $page_link
		);
		$data = array();
		$data['requests'] = $this->be_model->get_requests('ongoing');
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
	
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
	
	public function finished($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
	
		$page_title = 'Finished Requests';
		$page_link = 'requests/finished';
		$breadcrumb = array(
				'Requests' => '',
				'Finished' => $page_link
		);
		$data = array();
		$data['requests'] = $this->be_model->get_requests('finished');
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
	
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
	
	public function cancelled($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
	
		$page_title = 'Rejected Requests';
		$page_link = 'requests/cancelled';
		$breadcrumb = array(
				'Rejected' => '',
				'Cancelled' => $page_link
		);
		$data = array();
		$data['requests'] = $this->be_model->get_requests('cancelled');
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
	
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
	
	
}