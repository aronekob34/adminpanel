<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privacy extends CI_Controller {
	public function index()	{
		$this->be_page->generate(false, 'common/privacy');
	}
}