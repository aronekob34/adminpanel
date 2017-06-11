<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terms extends CI_Controller {
	public function index()	{
		$this->be_page->generate(false, 'common/terms');
	}
}