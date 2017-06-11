<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Be_model extends CI_Model {
	
	public function get_site_info() {
		$site_info = array();
		$query = $this->db->get('site_info');
		foreach($query->result_array() as $row) {
			$site_info[$row['name']] = $row['value'];
		}
		$site_info['front_url'] = substr(base_url(), 0, strlen(base_url()) - 6);
		return $site_info;
	}
	
	
	public function logged_in() {
		if($this->session->userdata('admin_logged_in')) {
			return $this->session->userdata('admin_logged_in');
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
	
	public function get_ids_str_trimmed($str) {
		if(strlen($str) < 3) {
			return '';
		} else {
			return substr($str, 1, strlen($str) - 2);
		}
	}
	
	public function be_character_limiter($str, $n = 15) {
		if(strlen($str) <= $n) {
			return $str;
		} else {
			return substr($str, 0, $n) . '...';
		}
	}
	
	public function get_breadcrumb($param) {
		$str = '
		<ol class="breadcrumb">
			<li><a href="' . base_url() . '"><i class="fa fa-dashboard"></i> Home</a></li>';
		foreach($param as $title => $link) {
			if($link != '') {
				$str .= '<li><a href="' . base_url() . $link . '">' . $title . '</a></li>';
			} else {
				$str .= '<li class="active">' . $title . '</li>';
			}
		}
		$str .= '
		</ol>
		';
		return $str;
	}
	
	public function get_menu_active($page, $menu) {
		$is_active = false;
		switch($menu) {
			case 'home':
				if($page == 'main') $is_active = true;
				break;
			case 'products':
				if($page == 'functional/products') $is_active = true;
				break;
			case 'services':
				if($page == 'functional/services') $is_active = true;
				break;
			case 'downloads':
				if($page == 'functional/downloads') $is_active = true;
				break;
			case 'newsroom':
				if($page == 'functional/newsroom') $is_active = true;
				break;
			case 'company':
				if($page == 'pages/company') $is_active = true;
				break;
			case 'contact':
				if($page == 'pages/contact') $is_active = true;
				break;
			default:
				$is_active = false;
				break;
		}
		return $is_active ? ' class="active"' : '';
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
	
	
	// Dashboard
	public function get_dashboard_info() {
		$result = array();

		$query_groups = $this->db->get_where('uc_users', array('user_role' => 100));
		$result['count_super_admins'] = $query_groups->num_rows();

		$query_groups = $this->db->get_where('uc_users', array('user_role' => 50));
		$result['count_biz_admins'] = $query_groups->num_rows();

		$query_groups = $this->db->get_where('uc_products');
		$result['count_products'] = $query_groups->num_rows();

		// $query_users = $this->db->select(array('biz_id'))->get_where('sq_businesses', array());
		// $result['count_businesses'] = $query_users->num_rows();

		// $query_pets = $this->db->select(array('category_id'))->get_where('sq_categories');
		// $result['count_categories'] = $query_pets->num_rows();

		return $result;
	}
	
	// Users
	public function get_system_managers() {
		$result = array();
		$query = $this->db->get_where('users', array('user_role' => 100));
		$result = $query->result_array();
		return $result;
	}

	public function get_system_manager($id = 0) {
		$result = array();
		$query = $this->db->get_where('users', array('user_role' => 100, 'id' => $id));
		$result = $query->row_array();
		return $result;
	}

	public function get_business_managers() {
		$result = array();
		$query = $this->db->get_where('users', array('user_role' => 50));
		$result = $query->result_array();
		return $result;
	}

	public function get_business_manager($id = 0) {
		$result = array();
		$query = $this->db->get_where('users', array('user_role' => 50, 'id' => $id));
		$result = $query->row_array();
		return $result;
	}

	public function get_users($param_user_type = '') {
		$result = array();
		$query = $this->db->get_where('sq_users');
		$result = $query->row_array();
		return $result1;
	}
	
	public function get_user($user_id = 0) {
		$current_user = array();
		if($user_id) {
	        
	        $query = $this->db->get_where('tt_users', array('user_id' => $user_id));
	        $fetched_user = $query->row_array();
	
	        $current_user = $fetched_user;
	        $query_pets = $this->db->get_where('tt_pets', array('pet_user_id' => $user_id));
	        $current_user['user_pets'] = $query_pets->result_array();
	        
	        $query_groups = $this->db->get_where('tt_groups', array('group_owner_user_id' => $user_id, 'group_closed' => 0));
	        $current_user['user_groups'] = $query_groups->result_array();
	        
	        $query_requests = $this->db->get_where('tt_requests', array('request_user_id' => $user_id));
	        $current_user['user_requests'] = $query_requests->result_array();
	        
	        $requests_total_count = 0;
	        $requests_pending_count = 0;
	        $requests_ongoing_count = 0;
	        //$requests_finished_count = 0;
	        $requests_cancelled_count = 0;
	        foreach($current_user['user_requests'] as $request) {
	        	$requests_total_count++;
	        	if($request['request_status'] == 0) {
	        		$requests_pending_count++;
	        	} else if($request['request_status'] == 1) {
	        		$requests_ongoing_count++;
	        	/*
	        	} else if($request['request_status'] == 10) {
	        		$requests_finished_count++;
	        	*/
	        	} else if($request['request_status'] == 2) {
	        		$requests_cancelled_count++;
	        	}
	        }
	        $current_user['user_requests_total_count'] = $requests_total_count;
	        $current_user['user_requests_pending_count'] = $requests_pending_count;
	        $current_user['user_requests_ongoing_count'] = $requests_ongoing_count;
	        //$current_user['user_requests_finished_count'] = $requests_finished_count;
	        $current_user['user_requests_cancelled_count'] = $requests_cancelled_count;
		}
		return $current_user;
	}
	
	// Groups
	public function get_businesses($param = '') {
		$query = $this->db
			->order_by('biz_id', 'asc')
			->join('users', 'users.id = sq_businesses.biz_owner_user_id')
			->join('sq_categories', 'sq_categories.category_id = sq_businesses.biz_category_id')
			->get_where('sq_businesses', array('biz_status' => ($param == 'closed' ? 0 : 1)));
		$result = $query->result_array();
		
		return $result;
	}
	
	public function get_business($biz_id = 0) {
		$biz = array();
    	$query_biz = $this->db
    		->join('users', 'users.id = sq_businesses.biz_owner_user_id')
			->join('sq_categories', 'sq_categories.category_id = sq_businesses.biz_category_id')
    		->get_where('sq_businesses', array('biz_id' => $biz_id));
    	$biz = $query_biz->row_array();
    	
		return $biz;
	}

	public function get_categories($param = '') {
		$query = $this->db->get_where('sq_categories');
		$result = $query->result_array();		
		return $result;
	}
	
	// Requests
	public function get_requests($param_request_type = '') {
		$result = array();
		
		$request_types = array();
		if($param_request_type == '' || $param_request_type == 'all') {
			$request_types = array(0, 1, 2);
		} else if($param_request_type == 'pending') {
			$request_types = array(0);
		} else if($param_request_type == 'ongoing') {
			$request_types = array(1);
		} else if($param_request_type == 'finished') {
			$request_types = array(10);
		} else if($param_request_type == 'cancelled') {
			$request_types = array(2);
		}
		
		$query = $this->db->where_in('request_status', $request_types)->order_by('request_created_date', 'desc')->get('tt_requests');
		foreach($query->result_array() as $request) {
			
			$query_user = $this->db->get_where('tt_users', array('user_id' => $request['request_user_id']));
			$request['request_user'] = $query_user->row_array();

			$result[] = $request;
		}
		
		return $result;
	}
	
	public function get_request($item_id = 0) {
		$result = array();
		
		if($item_id) {
			$query = $this->db
				->get_where('tt_requests', array('request_id' => $item_id));
			$request = $query->row_array();
			
			$query_customer = $this->db->get_where('tt_users', array('user_id' => $request['request_user_id']));
			$request['request_user'] = $query_customer->row_array();
			
			$result = $request;
		}
		
		return $result;
	}
	
	// Others
	public function get_social_links() {
		$query = $this->db->get('social_icons');
		$arr = array();
		foreach($query->result_array() as $row) {
			$arr[$row['type']] = $row;
		}
		return $arr;
	}
	
}