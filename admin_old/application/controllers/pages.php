<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
	private $page;
	public function __construct() {
		parent::__construct();
		$this->page = $this->uri->segment(2) ? $this->uri->segment(2) : '';
	}
	public function _remap($method)	{
		$static_pages = config_item('static_pages');
		if(empty($this->page) || (!empty($this->page) && !isset($static_pages[$this->page]))) {
			redirect('/');
		} else {
			$breadcrumb = array(
					'mode' => 1,
					'value' => array($static_pages[$this->page]['page_title'] => 'pages/' . $this->page)
				);
			$this->be_page->generate($static_pages[$this->page]['login_needed'], 'pages/' . $this->page, array_merge($static_pages[$this->page], array('breadcrumb' => $breadcrumb)));
		}
	}
}