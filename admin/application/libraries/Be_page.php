<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Be_page {
    public function generate($login_needed = true, $page_param = null, $data_param = null, $response = null) {
    	$CI = & get_instance();

    	// Data Integration
    	$data = (isset($data_param) ? $data_param : array());
    	// Login Check Module
    	if($CI->session->userdata('admin_logged_in')) {
			$data['user'] = $CI->session->userdata('admin_logged_in');
			$data['admin_logged_in'] = true;
			$page = ((isset($page_param) && !empty($page_param)) ? $page_param : 'main');
			if($page == 'main') redirect('/dashboard/manage');
    	} else {
    		$data['admin_logged_in'] = false;
    		if($login_needed)
    			redirect('/');
    		else
    			$page = ((isset($page_param) && !empty($page_param)) ? $page_param : 'main');
    	}
    	
    	$data['page'] = $page;
    	$data['site_info'] = $CI->be_model->get_site_info();
    	
    	if($page == 'main' || substr($page, 0, '9') == 'dashboard') $data['is_home'] = true;
    	
    	if(!isset($data_param['page_title'])) {
    		$data['site_title'] = $data['site_info']['site_name'];
    		$data['page_title'] = $data['site_title'];
    	} else {
    		$data['site_title'] = $data_param['page_title'] . ' - ' . $data['site_info']['site_name'];
    	}
    	
    	if(isset($response) && count($response) > 0) {
    		$data['response'] = $response;
    	}
    	
    	$data['breadcrumb'] = $CI->be_model->get_breadcrumb(isset($data_param['breadcrumb']) ? $data_param['breadcrumb'] : array());
    	
    	// Load Pages
    	$CI->load->view('general/head_includes', $data);
    	if($page != 'main') {
    		$CI->load->view('general/header', $data);

			if ($data['user']['user_role'] == 100) {
				$CI->load->view('general/left_superadmin', $data);
			} else {
				$CI->load->view('general/left', $data);
			}

    		
    	}
    	$CI->load->view($page, $data);
    	$CI->load->view('general/footer', $data);
    }
}