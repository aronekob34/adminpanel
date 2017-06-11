<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Api_model');
	}
	public function manage() {
		$user_data = $this->be_model->logged_in();

		if(!$user_data) {
			redirect('/');
			return false;
		} else {
			$data = $this->be_model->get_dashboard_info();

			print_r($data);

			echo $user_data['user_role_name'];

			$this->be_page->generate(true, 'dashboard/'.$user_data['user_role_name'], $data);
		}
	}
}