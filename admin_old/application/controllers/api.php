<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
	var $data;
	public function __construct() {
		parent::__construct();
		if(isset($_POST['tag']) && $_POST['tag'] != '') {
			$this->data = $_POST;
		} else {
			$this->data = array();
		}
		$this->load->model('Api_model');
	}
	public function contact() {
		if(isset($_POST['name'])) {
			$this->load->library('email');
			$site_info = $this->be_model->get_site_info();
			$this->email->from($site_info['from_email'], $_POST['name']);
			$this->email->to($site_info['owner_email']);
			if(isset($_POST['copy']) && $_POST['copy'] == 'on') {
				$this->email->cc($_POST['email']);
			}
			$this->email->subject($_POST['subject']);
			$this->email->message($_POST['message'] . "\n\n" . 'Regards, ' . $_POST['name'] . '.' . "\n\n" . $site_info['site_name'] . ' Contact Support');
			$this->email->reply_to($_POST['email'], $_POST['name']);
			if (!$this->email->send()) {
				echo $this->email->print_debugger();
			} else {
				echo 'success';
			}
		} else {
			echo 'Incorrect Request';
		}
	}
	public function quote() {
		// product_id, info, firstname, lastname, email, phone, company, city, country, question, subscription
		if(isset($_POST['email']) && isset($_POST['terms'])) {
			$this->load->library('email');
			$site_info = $this->be_model->get_site_info();
			$full_name = $_POST['firstname'] . (isset($_POST['lastname']) && $_POST['lastname'] != '' ? ' ' . $_POST['lastname'] : '');
			
			$message = 'Quote Order Request Arrived from ' . $full_name . '
			
Here are the information of request:

Selected Product Link : ' . base_url() . 'products/item/' . $_POST['product_id'] . '
Additional Information : ' . $_POST['info'] . '
Name : ' . $full_name . '
Email : ' . $_POST['email'] . '
Phone : ' . $_POST['phone'] . '
Company : ' . $_POST['company'] . '
City : ' . $_POST['city'] . '
Country : ' . $_POST['country'] . '
Question : ' . element($_POST['question'], config_item('quote_form_question')) . '
			';
			
			$this->email->from($site_info['from_email'], $full_name);
			$this->email->to($site_info['owner_email']);
			if(isset($_POST['subscription']) && $_POST['subscription'] == 'on') {
				$message .= 'This customer subscribed to our newsletter system.
			';
			}
			$this->email->subject($site_info['site_name'] . ' - Quote Order Request Arrived');
			$this->email->message($message . "\n\n" . 'Please contact the customer quickly for this request.' . "\n\n" . $site_info['site_name'] . ' Contact Support');
			$this->email->reply_to($_POST['email'], $full_name);
			echo 'success';
			return;
			if (!$this->email->send()) {
				echo $this->email->print_debugger();
			} else {
				echo 'success';
			}
		} else {
			echo 'Incorrect Request';
		}
	}
}