<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Be_model extends CI_Model {
	
	public function logged_in() {
		if($this->session->userdata('logged_in')) {
			return $this->session->userdata('logged_in');
		} else {
			return false;
		}
	}
	
	public function is_valid_email($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	
	public function set_hidden_tags($requests = array()) {
		if(count($requests) > 0) {
			foreach($requests as $request_field => $request_value) {
				echo '<input type="hidden" name="' . $request_field . '" value="' . $request_value . '">';
			}
		}
	}
	public function get_site_info() {
		$site_info = array();
		$query = $this->db->get('site_info');
		foreach($query->result_array() as $row) {
			$site_info[$row['name']] = $row['value'];
		}
		return $site_info;
	}
	public function get_form_validation_rule($item) {
		$rule = 'xss_clean';
		if(isset($item['minlength'])) $rule .= '|min_length['.$item['minlength'].']';
		if(isset($item['maxlength'])) $rule .= '|max_length['.$item['maxlength'].']';
		if(isset($item['required'])) $rule .= '|required';
		if(isset($item['valid_email'])) $rule .= '|valid_email';
		if(isset($item['password_confirm'])) $rule .= '|matches[password_confirm]';
		if(isset($item['numeric'])) $rule .= '|numeric';
		if(isset($item['exact_length'])) $rule .= '|exact_length['.$item['exact_length'].']';
		if(isset($item['is_unique'])) $rule .= '|is_unique['.$item['is_unique'].']';
		return $rule;
	}
	
	public function get_users() {
		$query = $this->db->select('id, email, user_role, full_name, photo_link, genre_ids, bio, facebook_link, twitter_link', 'country', 'zip', 'city', 'website')
			->get_where('users', array('user_role' => 1));
		return $query->result_array();
	}
	
	public function convert_array_to_string($arr) {
		return implode(',', $arr);
	}
}