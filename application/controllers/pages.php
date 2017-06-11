<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
	private $page;
	public function __construct() {
		parent::__construct();
		$this->page = $this->uri->segment(2) ? $this->uri->segment(2) : '';
	}
	public function _remap($method)	{
		if(empty($this->page) || (!empty($this->page) && !array_key_exists($this->page, config_item('static_pages')))) {
			redirect('/');
		} else {
			$this->be_page->generate(element('login_needed', element($this->page, config_item('static_pages'))), 'pages/' . $this->page, element($this->page, config_item('static_pages')));
		}
	}
}