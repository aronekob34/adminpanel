<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Be_page {
    public function generate($login_needed = true, $page_param = null, $data_param = null) {
    	$CI = & get_instance();

    	// Data Integration
    	$data = (isset($data_param) ? $data_param : array());

    	// Login Check Module
    	if($CI->session->userdata('logged_in')) {
			$data['user'] = $CI->session->userdata('logged_in');
			$data['logged_in'] = true;
			$page = (isset($page_param) ? $page_param : 'main');
    	} else {
    		$data['logged_in'] = false;
    		if($login_needed)
    			redirect('/');
    		else
    			$page = (isset($page_param) ? $page_param : 'main');
    	}
    	if($page == 'main') $data['is_home'] = true;
    	
    	// Load Pages
    	$CI->load->view('general/head_includes', $data);
    	$CI->load->view('general/header', $data);
    	$CI->load->view($page, $data);
    	$CI->load->view('general/footer', $data);
    }
}