<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	
	public function login($email, $password) {
		$query = $this->db->get_where('uc_users', array('user_email' => $email, 'user_password' => (md5($password))));
		if($query -> num_rows() == 1) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function register($requests_param, $user_role = null)	{
		$requests = $requests_param;
		$requests['password'] = md5($requests['password']);
		$requests['date_created'] = date('Y-m-d h:i:s');
		$requests['user_role'] = 1;
		$query = $this->db->get_where('genres', array('name' => $requests['genre']));
		if($query->num_rows() > 0) {
			$requests['genre_id'] = element('id', $query->row_array());
		} else {
			$this->db->insert('genres', array('name' => $requests['genre']));
			$requests['genre_id'] = $this->db->insert_id();
		}
		if(config_item('domain_sub_directory') != '') {
			$requests['photo_link'] = substr($requests['photo_link'], strlen(config_item('domain_sub_directory')) + 1);
		}
		$request_fields = array('full_name', 'email', 'password', 'bio', 'genre_id', 'photo_link', 'facebook_link', 'twitter_link', 'date_created', 'user_role', 'country', 'zip', 'city', 'website');
		$this->db->insert('users', elements($request_fields, $requests));
		$id = $this->db->insert_id();
		return (isset($id) && $id > 0) ? $id : FALSE;
	}
	
}