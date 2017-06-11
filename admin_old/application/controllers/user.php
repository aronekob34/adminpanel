<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('User_model');
	}
	public function index() {
		
	}
	function login() {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag'])) {
			if($requests['tag'] == 'login') {
				$request_fields = array('email', 'password');
				$input_total_data = array(
					array('name' => 'email', 'label' => 'Email', 'maxlength' => 100, 'required' => true, 'type' => 'email', 'valid_email' => true),
					array('name' => 'password', 'label' => 'Password', 'maxlength' => 60, 'required' => true, 'type' => 'password'),
				);
				// validate form input
				foreach($input_total_data as $item) {
					$this->form_validation->set_rules($item['name'], $item['label'], $this->be_model->get_form_validation_rule($item));
				}
				if($this->form_validation->run() == true) {
					if(!$this->login_check($requests['email'], $requests['password'])) {
						$response['result'] = 0;
						$response['report']['status'] = 2;
						$response['report']['msg'] = 'Invalid Email or Password';
					} else {
						redirect('/dashboard/manage');
					}
				} else {
					$response['result'] = 0;
					$response['report']['status'] = 0;
					$response['report']['msg'] = validation_errors();
				}
				//$data_param['requests'] = elements($request_fields, $requests);
			} else {
				$response['result'] = 0;
				$response['report']['status'] = 0;
				$response['report']['msg'] = 'Invalid Request';
			}
		}
		$this->be_page->generate(false, null, null, $response);
		return;
	}
	
	function login_check($email, $password) {
		$result = $this->User_model->login($email, $password);
		if($result == false) {
			return false;
		} else {
			$result['user_role_name'] = element('name', element($result['user_role'], config_item('user_role')));
			$result['full_name'] = $result['first_name'] . ' ' . $result['last_name'];
			$this->session->set_userdata('admin_logged_in', $result);
			return true;
		}
	}
 	public function logout() {
 		$this->session->unset_userdata('admin_logged_in');
  		redirect('/', 'refresh');
 	}
	public function signup_success() {
		$this->be_page->generate(false, 'user/signup_success', array('page_style' => 3));
	}
	public function signup() {
		$requests = $this->input->post();
		$page_param = '';
		$response = array();
		$data_param = array('page_style' => 1);
		if(!isset($requests['tag'])) {
			redirect('/');
		} else if($requests['tag'] == 'signup1') {
			$request_fields = array('full_name', 'email', 'password', 'password_confirm');
			$input_total_data = array(
					array('name' => 'full_name', 'label' => 'First Name', 'maxlength' => 100, 'required' => true),
					array('name' => 'email', 'label' => 'Email', 'maxlength' => 100, 'required' => true, 'type' => 'email', 'valid_email' => true, 'is_unique' => 'users.email'),
					array('name' => 'password', 'label' => 'Password', 'minlength' => 5,  'maxlength' => 60, 'type' => 'password', 'required' => true, 'password_confirm' => true),
					array('name' => 'password_confirm', 'label' => 'Password Confirm','minlength' => 5,  'maxlength' => 60, 'type' => 'password', 'form_only' => true, 'required' => true)
				);
			// validate form input
			foreach($input_total_data as $item) {
				$this->form_validation->set_rules($item['name'], $item['label'], $this->be_model->get_form_validation_rule($item));
			}
			if($this->form_validation->run() == true) {
				$page_param = 'user/signup1';
				$data_param['page_style'] = 3;
			} else {
				$response['result'] = 0;
				$response['report']['status'] = 0;
				$response['report']['msg'] = validation_errors();
			}
			$data_param['requests'] = elements($request_fields, $requests);
		} else if($requests['tag'] == 'signup2') {
			$request_fields = array('full_name', 'email', 'password', 'password_confirm');
			$input_total_data = array(
					array('name' => 'bio', 'label' => 'Bio', 'maxlength' => 200, 'required' => true),
					array('name' => 'genre', 'label' => 'Genre', 'maxlength' => 100, 'required' => true),
					array('name' => 'country', 'label' => 'Country', 'maxlength' => 100, 'required' => true),
					array('name' => 'zip', 'label' => 'Zip', 'minlength' => 3, 'maxlength' => 6, 'required' => true, 'numeric' => true),
					array('name' => 'city', 'label' => 'City', 'maxlength' => 100, 'required' => true)
				);
			// validate form input
			foreach($input_total_data as $item) {
				$this->form_validation->set_rules($item['name'], $item['label'], $this->be_model->get_form_validation_rule($item));
			}
			if($this->form_validation->run() == true) {
				$page_param = 'user/signup2';
				$data_param['page_style'] = 3;
				$request_fields = array_merge($request_fields, array('bio', 'genre', 'country', 'zip', 'city'));
			} else {
				$response['result'] = 0;
				$response['report']['status'] = 0;
				$response['report']['msg'] = validation_errors();
				$page_param = 'user/signup1';
				$data_param['page_style'] = 3;
			}
			$data_param['requests'] = elements($request_fields, $requests);
		} else if($requests['tag'] == 'signup3') {
			$request_fields = array('full_name', 'email', 'password', 'password_confirm', 'bio', 'genre', 'country', 'zip', 'city');
			$input_total_data = array(
					array('name' => 'photo_link', 'label' => 'Photo', 'required' => true)
				);
			// validate form input
			foreach($input_total_data as $item) {
				$this->form_validation->set_rules($item['name'], $item['label'], $this->be_model->get_form_validation_rule($item));
			}
			$this->form_validation->set_message('photo_link', 'You should upload your profile photo.');
			if($this->form_validation->run() == true) {
				$page_param = 'user/signup3';
				$data_param['page_style'] = 3;
				$request_fields = array_merge($request_fields, array('photo_link'));
			} else {
				$response['result'] = 0;
				$response['report']['status'] = 0;
				$response['report']['msg'] = validation_errors();
				$page_param = 'user/signup2';
				$data_param['page_style'] = 3;
			}
			$data_param['requests'] = elements($request_fields, $requests);
		} else if($requests['tag'] == 'signup4') {
			$request_fields = array('full_name', 'email', 'password', 'password_confirm', 'bio', 'genre', 'photo_link');
			$input_total_data = array(
					array('name' => 'website', 'label' => 'Website Link'),
					array('name' => 'facebook_link', 'label' => 'Facebook Link'),
					array('name' => 'twitter_link', 'label' => 'Twitter Link')
				);
			// validate form input
			foreach($input_total_data as $item) {
				$this->form_validation->set_rules($item['name'], $item['label'], $this->be_model->get_form_validation_rule($item));
			}
			if($this->form_validation->run() == true) {
				$result = $this->User_model->register($requests);
				if ($result == false) {
					$response['result'] = 0;
					$response['report']['status'] = 2;
					$response['report']['msg'] = 'Signup action failed.';
					$page_param = 'user/signup3';
					$data_param['page_style'] = 3;
				} else {
					redirect('/user/signup_success');
				}
			} else {
				$response['result'] = 0;
				$response['report']['status'] = 0;
				$response['report']['msg'] = validation_errors();
				$page_param = 'user/signup3';
				$data_param['page_style'] = 3;
			}
			if($result !== false) $data_param['requests'] = elements($request_fields, $requests);
		} else {
			$response['result'] = 0;
			$response['report']['status'] = 0;
			$response['report']['msg'] = 'Invalid Request';
		}
		$this->be_page->generate(false, $page_param, $data_param, $response);
		return;
	}
}
?>