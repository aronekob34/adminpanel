<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model {
	
	// General Information
	public function edit_site_info($params) {
		$request_fields = array('site_title', 'site_name', 'meta_keywords', 'meta_description', 'owner_phone', 'owner_fax', 'owner_email', 'owner_address', 'owner_visit_address', 'owner_site', 'site_url_name', 'from_email');
		foreach($request_fields as $request_field) {
			$this->db->update('site_info', array('value' => $params[$request_field]), array('name' => $request_field));
		}
		$state = 1;
		return array('state' => $state);
	}
	
	// Users
	public function remove_system_manager($remove_id) {
		$this->db->delete('users', array('id' => $remove_id));		
		return;
	}

	public function remove_business_manager($remove_id) {
		$this->db->delete('users', array('id' => $remove_id));		
		return;
	}

	public function edit_system_manager($params) {
		$data = array(
			'full_name' => $params['full_name'],
			'email' => $params['email'],
			'phone_number' => $params['phone_number'],
			'gender' => $params['gender'],
			'password' => $this->get_user_auth_salt($params['password'])
		);
		$this->db->update('users', $data, array('id' => $params['edit_id']));
		return;
	}

	public function edit_business_manager($params) {
		$data = array(
			'full_name' => $params['full_name'],
			'email' => $params['email'],
			'phone_number' => $params['phone_number'],
			'gender' => $params['gender'],
			'password' => $this->get_user_auth_salt($params['password'])
		);
		$this->db->update('users', $data, array('id' => $params['edit_id']));
		return;
	}

	public function get_user_auth_salt($password) {
    	return md5($password);
    }

	public function remove_user($remove_id) {

		$query_user = $this->db->get_where('tt_users', array('user_id' => $remove_id));
		$current_user = $query_user->row_array();

		$this->db->delete('tt_requests', array('request_user_id' => $remove_id));
		$this->db->delete('tt_groups', array('group_owner_user_id' => $remove_id));
		$this->db->delete('tt_pets', array('pet_user_id' => $remove_id));
		
		$user_media = '../' . config_item('path_media_users') . $this->get_user_prefix_removed_media_name($current_user['user_photo_url']);
		if(file_exists($user_media)) unlink($user_media);
		
		$this->db->delete('tt_users', array('user_id' => $remove_id));
		
		return;
	}
	
	public function suspend_user($user_id, $suspend_option = 0) {
	
		$this->db->update('tt_users', array('user_is_suspended' => $suspend_option), array('user_id' => $user_id));
	
		return;
	}
	
	public function approve_user($user_id, $approve_option = 1) {
	
		$this->db->update('tt_users', array('user_is_approved' => $approve_option), array('user_id' => $user_id));
	
		return;
	}
	
	// Posts
	public function remove_post($remove_id) {
	
		$query_post = $this->db->get_where('tt_posts', array('post_id' => $remove_id));
		$post = $query_post->row_array();
		
		$post_media = '../' . config_item('path_media_posts') . $this->get_post_prefix_removed_media_name($post['post_video_url']);
		if(file_exists($post_media)) unlink($post_media);
		
		$post_thumb_media = '../' . config_item('path_media_post_thumbs') . $this->get_post_thumb_prefix_removed_media_name($post['post_thumb_url']);
		if(file_exists($post_thumb_media)) unlink($post_thumb_media);
		
		$this->db->delete('tt_posts', array('post_id' => $remove_id));
		$this->db->delete('tt_comments', array('comment_post_id' => $post['post_id']));
			
		return;
	}
	
	// Newsroom
	public function add_news($params) {
		$msg = '';
		$state = 0;
	
		$request_fields = array('title', 'content');
	
		$query_check = $this->db->get_where('news', elements($request_fields, $params));
		if($query_check->num_rows() > 0) {
			$state = 2;
		} else {
			$config['upload_path'] = '../' . config_item('path_newsroom');
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '10000';
			$config['max_width']  = '1920';
			$config['max_height']  = '1080';
				
			$this->load->library('upload', $config);
				
			if(!$this->upload->do_upload('image_file')) {
				$state = 3;
				$msg = $this->upload->display_errors();
			} else {
				$upload_data = $this->upload->data();
				$params_new = elements($request_fields, $params);
				$params_new['image'] = $upload_data['file_name'];
				
				$params_new['date_created'] = date('Y-m-d h:i:s');
				$this->db->insert('news', $params_new);
				$id = $this->db->insert_id();
				if($id > 0) $state = 1;
			}
				
		}
		return array('state' => $state, 'msg' => $msg);
	}
	public function edit_news($params, $edit_id) {
		$state = 0;
		$msg = '';
		$request_fields = array('title', 'content', 'image');
	
		$query_check = $this->db->get_where('news', array_merge(elements($request_fields, $params), array('id !=' => $edit_id)));
		if($query_check->num_rows() > 0) {
			$state = 2;
		} else {
			$params_new = $params;
			if(isset($params['image_check']) && $params['image_check'] == 'on') {
				$config['upload_path'] = '../' . config_item('path_newsroom');
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '10000';
				$config['max_width']  = '1920';
				$config['max_height']  = '1080';
					
				$this->load->library('upload', $config);
					
				if(!$this->upload->do_upload('image_file')) {
					$state = 3;
					$msg = $this->upload->display_errors();
				} else {
					$upload_data = $this->upload->data();
					$params_new['image'] = $upload_data['file_name'];
				}
			}
			if($state != 3) {
				$params_new['date_created'] = date('Y-m-d h:i:s');
				$this->db->update('news', elements($request_fields, $params_new), array('id' => $edit_id));
				$state = 1;
			}
		}
		return array('state' => $state, 'msg' => $msg);
	}
	public function remove_news($remove_id) {
		$images_upload_url = '../' . config_item('path_newsroom');
		$query = $this->db->get_where('news', array('id' => $remove_id));
		$row = $query->row_array();
		if(file_exists($images_upload_url . $row['image'])) unlink($images_upload_url . $row['image']);
	
		$this->db->delete('news', array('id' => $remove_id));
		return;
	}
	
	// Products
	public function add_product_category($params) {
		$state = 0;
		$request_fields = array('title');
		$query_check = $this->db->get_where('pd_category', elements($request_fields, $params));
		if($query_check->num_rows() > 0) {
			$state = 2;
		} else {
			$this->db->insert('pd_category', elements($request_fields, $params));
			$id = $this->db->insert_id();
			if($id > 0) $state = 1;
		}
		return array('state' => $state);
	}
	public function edit_product_category($params, $edit_id) {
		$state = 0;
		$request_fields = array('title');
		$query_check = $this->db->get_where('pd_category', array_merge(elements($request_fields, $params), array('id !=' => $edit_id)));
		if($query_check->num_rows() > 0) {
			$state = 2;
		} else {
			$this->db->update('pd_category', elements($request_fields, $params), array('id' => $edit_id));
			$state = 1;
		}
		return array('state' => $state);
	}
	public function remove_product_category($remove_id) {
		$query = $this->db->select('id')->get_where('pd', array('category_id' => $remove_id));
		foreach($query->result_array as $row) {
			$this->db->delete('pd_award', array('pid' => $row['id']));
			$this->db->delete('pd_images', array('pid' => $row['id']));
			$this->db->delete('files', array('pid' => $row['id']));
		}
		$this->db->delete('pd', array('category_id' => $remove_id));
		$this->db->delete('pd_category', array('id' => $remove_id));
		return;
	}
	public function add_product($params) {
		$state = 0;
		$request_fields = array('title', 'category_id', 'content');
		foreach(config_item('product_details') as $key => $val) {
			$request_fields[] = $key;
		}
		$query_check = $this->db->get_where('pd', elements($request_fields, $params));
		if($query_check->num_rows() > 0) {
			$state = 2;
		} else {
			
			
			$path_upload_temp = config_item('path_uploads_temp');
			
			$upload_success = true;
			$image_names = explode(config_item('file_upload_imagename_separator'), $params['be_file_upload_name']);
			$uploaded_file_names = array(); 
			
			foreach($image_names as $file_upload_name) {
				if($file_upload_name != '') {
					$be_file_upload_name_temp = explode('_', $file_upload_name);
					$uploaded_file_name = substr($file_upload_name, strlen($be_file_upload_name_temp[0] . '_'));
					//echo $path_upload_temp . $uploaded_file_name . '<br>';
					
					$new_file_name = time() . '_' . $uploaded_file_name;
					if(!file_exists($path_upload_temp . $uploaded_file_name) ||
							(file_exists($path_upload_temp . $uploaded_file_name) && !rename($path_upload_temp . $uploaded_file_name, '../' . config_item('path_products') . $new_file_name))) {
						$upload_success = false;
						break;
					}
					if(!copy('../' . config_item('path_products') . $new_file_name, '../' . config_item('path_products_thumb') . $new_file_name)) {
						$upload_success = false;
						break;
					}
					$uploaded_file_names[] = $new_file_name;
				}
			}
			
			if ($upload_success) {
				$this->db->insert('pd', elements($request_fields, $params));
				$id = $this->db->insert_id();
				foreach($uploaded_file_names as $image_name) {
					$this->db->insert('pd_images', array('image' => $image_name, 'pid' => $id));
				}
				if($id > 0) $state = 1;
			} else {
				$state = 3;
			}
				
		}
		return array('state' => $state);
	}
	public function edit_product($params, $edit_id) {
		$state = 0;
		$request_fields = array('title', 'category_id', 'content');
		foreach(config_item('product_details') as $key => $val) {
			$request_fields[] = $key;
		}
		$query_check = $this->db->get_where('pd', array_merge(elements($request_fields, $params), array('id !=' => $edit_id)));
		if($query_check->num_rows() > 0) {
			$state = 2;
		} else {

			$images_upload_url_thumb = '../' . config_item('path_products_thumb');
			$images_upload_url_large = '../' . config_item('path_products');
			
			if(isset($params['image_ids']) && count($params['image_ids']) > 0) {
				$query_i = $this->db->get_where('pd_images', array('pid' => $edit_id));
				$image_ids = $params['image_ids'];
				$remove_image_ids = array();
				foreach($query_i->result_array() as $row) {
					if(!in_array($row['id'], $image_ids)) $remove_image_ids[] = $row;
				}
				foreach($remove_image_ids as $row) {
					if(file_exists($images_upload_url_large . $row['image'])) unlink($images_upload_url_large . $row['image']);
					if(file_exists($images_upload_url_thumb . $row['image'])) unlink($images_upload_url_thumb . $row['image']);
					$this->db->delete('pd_images', array('id' => $row['id']));
				}
			}
			if(isset($params['add_new_image']) && isset($params['be_file_upload_name']) && $params['be_file_upload_name'] != '') {
// 				$upload_success = true;
// 				$image_names = explode('*', $params['images']);
// 				foreach($image_names as $image_name) {
// 					if(!rename($images_upload_temp_url . $image_name, $images_upload_url_large . $image_name) ||
// 							!rename($images_upload_temp_url . 'thumbnail/' . $image_name, $images_upload_url_thumb . $image_name)) {
// 						$upload_success = false;
// 						break;
// 					}
// 				}
// 				if ($upload_success) {
// 					foreach($image_names as $image_name) {
// 						$this->db->insert('pd_images', array('image' => $image_name, 'pid' => $edit_id));
// 					}
// 				} else {
// 					$state = 3;
// 				}

				$path_upload_temp = config_item('path_uploads_temp');
					
				$upload_success = true;
				$image_names = explode(config_item('file_upload_imagename_separator'), $params['be_file_upload_name']);
				$uploaded_file_names = array();
					
				foreach($image_names as $file_upload_name) {
					if($file_upload_name != '') {
						$be_file_upload_name_temp = explode('_', $file_upload_name);
						$uploaded_file_name = substr($file_upload_name, strlen($be_file_upload_name_temp[0] . '_'));
						//echo $path_upload_temp . $uploaded_file_name . '<br>';
							
						$new_file_name = time() . '_' . $uploaded_file_name;
						if(!file_exists($path_upload_temp . $uploaded_file_name) ||
								(file_exists($path_upload_temp . $uploaded_file_name) && !rename($path_upload_temp . $uploaded_file_name, '../' . config_item('path_products') . $new_file_name))) {
							$upload_success = false;
							break;
						}
						if(!copy('../' . config_item('path_products') . $new_file_name, '../' . config_item('path_products_thumb') . $new_file_name)) {
							$upload_success = false;
							break;
						}
						$uploaded_file_names[] = $new_file_name;
					}
				}
					
				if ($upload_success) {
					foreach($uploaded_file_names as $image_name) {
						$this->db->insert('pd_images', array('image' => $image_name, 'pid' => $edit_id));
					}
				} else {
					$state = 3;
				}
				
			}
			if($state != 3) {
				$this->db->update('pd', elements($request_fields, $params), array('id' => $edit_id));
				$state = 1;
			}
		}
		return array('state' => $state);
	}
	public function remove_product($remove_id) {
		$this->db->delete('pd_award', array('pid' => $remove_id));
		
		$images_upload_url_thumb = '../' . config_item('path_products_thumb');
		$images_upload_url_large = '../' . config_item('path_products');
		$query_i = $this->db->get_where('pd_images', array('pid' => $remove_id));
		foreach($query_i->result_array() as $row) {
			if(file_exists($images_upload_url_large . $row['image'])) unlink($images_upload_url_large . $row['image']);
			if(file_exists($images_upload_url_thumb . $row['image'])) unlink($images_upload_url_thumb . $row['image']);
		}
		$this->db->delete('pd_images', array('pid' => $remove_id));
		
		$this->db->delete('files', array('pid' => $remove_id));
		$this->db->delete('pd', array('id' => $remove_id));
		return;
	}
	
	
	// Utility Functions
	
	public function get_post_prefix_removed_media_name($image_name) {
		$prefix_length = strlen(config_item('media_post_photo_self_domain_prefix'));
		if(substr($image_name, 0, $prefix_length) == config_item('media_post_photo_self_domain_prefix')) {
			return substr($image_name, $prefix_length);
		} else {
			return $image_name;
		}
	}
	
	public function get_post_thumb_prefix_removed_media_name($image_name) {
		$prefix_length = strlen(config_item('media_post_thumb_self_domain_prefix'));
		if(substr($image_name, 0, $prefix_length) == config_item('media_post_thumb_self_domain_prefix')) {
			return substr($image_name, $prefix_length);
		} else {
			return $image_name;
		}
	}
	
	public function get_user_prefix_removed_media_name($image_name) {
		$prefix_length = strlen(config_item('media_user_self_domain_prefix'));
		if(substr($image_name, 0, $prefix_length) == config_item('media_user_self_domain_prefix')) {
			return substr($image_name, $prefix_length);
		} else {
			return $image_name;
		}
	}
}