<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
    function __construct() {

        parent :: __construct();
//        $this->load->helper('common');
        $this->load->model('common_model');
//        $this->load->model('dash_board_model');
//        $this->layout->setLayout('layout_common_page');
//        $this->load->library('image_lib');
        $this->load->library('form_validation');
    }

    public function index() {
 /** **********************************  common data for all page that is required *********************** */
        $page_title = 'Create A New User';
        $page_link = 'users/index';
        $breadcrumb = array(
            'System Managers' => '',
            'View All System Managers' => $page_link
        );
        $data = array();
        $data['class'] = 'users';
        $data['method'] = 'viewall';
        /*         * ************************************ Form validation of the form ********************************** */

        $data['all_data'] = $this->common_model->select_all_data("uc_users");
        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
    }

    public function addnew() {

/************************************  common data for all page that is required *********************** */
        $page_title = 'Create A New User';
        $page_link = 'users/addnew';
        $breadcrumb = array(
            'Create A New User' => '',
            'Add Interventions' => $page_link
        );
        $data = array();
        $data['class'] = 'users';
        $data['method'] = 'addnew';
/************************************** Form validation of the form ********************************** */

        if ( $_POST ) {
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('user_role', 'User Role', 'trim|required');
            $this->form_validation->set_rules('user_email', 'User Email', 'trim|required');
            $this->form_validation->set_rules('user_first_name', 'User First Name', 'trim|required');
            $this->form_validation->set_rules('user_last_name', 'User Last Name', 'trim|required');
            $this->form_validation->set_rules('user_company_name', 'User Company Name', 'trim|required');
            $this->form_validation->set_rules('user_address', 'User Address', 'trim|required');
            $this->form_validation->set_rules('user_zipcode', 'User Zip Code', 'trim|required');
            $this->form_validation->set_rules('user_city', 'User City', 'trim|required');
            $this->form_validation->set_rules('user_country', 'User Country', 'trim|required');
            $this->form_validation->set_rules('user_password', 'User Password', 'trim|required');

            if ( $this->form_validation->run() == FALSE ) {

                $data['error'] = "error occured";
            } else {

                $post_data = Array(
                    'user_role' => $this->input->post('user_role'),
                    'user_email' => $this->input->post('user_email'),
                    'user_first_name' => $this->input->post('user_first_name'),
                    'user_last_name' => $this->input->post('user_last_name'),
                    'user_company_name' => $this->input->post('user_company_name'),
                    'user_address' => $this->input->post('user_address'),
                    'user_zipcode' => $this->input->post('user_zipcode'),
                    'user_city' => $this->input->post('user_city'),
                    'user_country' => $this->input->post('user_country'),
                    'user_password' => $this->input->post('user_password'),
                    'created_by' => $this->session->userdata['logged_in']['user_id'],
                    'created_at' => date("Y-m-d H:i:s ")
                );
                $data['all_data'] = array();
                $property_id = $this->common_model->add_data("uc_users", $post_data);
                $this->session->set_flashdata('success', 'Information inserted successfully');
                redirect("users/index", 'refresh');
            }
        }

        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
    }
    public function edit($edit_id = NULL) {
/************************************  common data for all page that is required ************************/        
        $page_title = 'Edit User Info';
        $page_link = 'users/addnew';
        $breadcrumb = array(
            'User Info Edit' => '',
            'Edit' => $page_link
        );
        $data = array();
        $data['class'] = 'users';
        $data['method'] = 'edit';
/************************************** Form validation of the form ***********************************/     
        if($_POST){
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('user_role', 'User Role', 'trim|required');
            $this->form_validation->set_rules('user_email', 'User Email', 'trim|required');
            $this->form_validation->set_rules('user_first_name', 'User First Name', 'trim|required');
            $this->form_validation->set_rules('user_last_name', 'User Last Name', 'trim|required');
            $this->form_validation->set_rules('user_company_name', 'User Company Name', 'trim|required');
            $this->form_validation->set_rules('user_address', 'User Address', 'trim|required');
            $this->form_validation->set_rules('user_zipcode', 'User Zip Code', 'trim|required');
            $this->form_validation->set_rules('user_city', 'User City', 'trim|required');
            $this->form_validation->set_rules('user_country', 'User Country', 'trim|required');
            $this->form_validation->set_rules('user_password', 'User Password', 'trim|required');

            if ( $this->form_validation->run() == FALSE ) {

                $data['error'] = "error occured";
            } else {

                $post_data = Array(
                    'user_role' => $this->input->post('user_role'),
                    'user_email' => $this->input->post('user_email'),
                    'user_first_name' => $this->input->post('user_first_name'),
                    'user_last_name' => $this->input->post('user_last_name'),
                    'user_company_name' => $this->input->post('user_company_name'),
                    'user_address' => $this->input->post('user_address'),
                    'user_zipcode' => $this->input->post('user_zipcode'),
                    'user_city' => $this->input->post('user_city'),
                    'user_country' => $this->input->post('user_country'),
                    'user_password' => $this->input->post('user_password'),
                    'created_by' => $this->session->userdata['logged_in']['user_id'],
                    'created_at' => date("Y-m-d H:i:s ")
            );

               $this->common_model->update_data("user_id",$edit_id,"uc_users", $post_data);
               $this->session->set_flashdata('success','Information updated successfully' );
               redirect("users/index", 'refresh');
            }
        }
        $data['all_data'] = $this->common_model->query_all_data("uc_users",'user_id',$edit_id);
        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
    }
    
    public function delete(){
        
            $id=$this->uri->segment(3);
            $this->common_model->delete_data('user_id', $id, 'uc_users');
            $this->session->set_flashdata( 'delete', 'successfully deleted... ' );
            redirect( base_url() . 'users/index' );
               
               
    }

    public function system_managers($edit_id = NULL) {
        $requests = $this->input->post();
		$response = array();

		

		$page_title = 'System Managers';
		$page_link = 'users/system_managers';
		$breadcrumb = array('System Managers' => $page_link);
		$data = array();
		$data['system_managers'] = $this->be_model->get_system_managers();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}

	public function business_managers($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();

		if($requests['submitted'] == "Cancel") {
			$response['result'] = 0;
		} else {
			if(isset($requests['tag']) && isset($requests['remove_id'])) {
				$this->api_model->remove_business_manager($requests['remove_id']);
				$response['result'] = 1;
			} else if(isset($requests['tag']) && isset($requests['edit_id'])) {
				$request_fields = array('full_name', 'email', 'phone_number', 'gender', 'password');
				$request_form_success = true;
				foreach ($request_fields as $request_field) {
					if(!(isset($requests[$request_field]) && $requests[$request_field] != '')) {
						$request_form_success = false;
						break;
					}
				}
				if (!$request_form_success) {
					$response['result'] = 2;
				} else {
					$this->api_model->edit_business_manager($requests);
					$response['result'] = 1;
				}				
			}
		}

		$page_title = 'Business Managers';
		$page_link = 'users/business_managers';
		$breadcrumb = array('Business Managers' => $page_link);
		$data = array();
		$data['business_managers'] = $this->be_model->get_business_managers();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}

	public function general_users($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();

		if($requests['submitted'] == "Cancel") {
			$response['result'] = 0;
		} else {
			if(isset($requests['tag']) && isset($requests['remove_id'])) {
				$this->api_model->remove_business_manager($requests['remove_id']);
				$response['result'] = 1;
			} else if(isset($requests['tag']) && isset($requests['edit_id'])) {
				$request_fields = array('full_name', 'email', 'phone_number', 'gender', 'password');
				$request_form_success = true;
				foreach ($request_fields as $request_field) {
					if(!(isset($requests[$request_field]) && $requests[$request_field] != '')) {
						$request_form_success = false;
						break;
					}
				}
				if (!$request_form_success) {
					$response['result'] = 2;
				} else {
					$this->api_model->edit_business_manager($requests);
					$response['result'] = 1;
				}				
			}
		}

		$page_title = 'Users';
		$page_link = 'users/general_users';
		$breadcrumb = array('Users' => $page_link);
		$data = array();
		$data['users'] = $this->be_model->get_users();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}



	
	public function users_edit($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag']) && isset($requests['remove_id'])) {
			$this->api_model->remove_user($requests['remove_id']);
			$response['result'] = 1;
		} else if(isset($requests['tag']) && isset($requests['suspend_id'])) {
			$this->api_model->suspend_user($requests['suspend_id'], 1);
			$response['result'] = 1;
		}
		$page_title = 'Wagz Pet Owners';
		$page_link = 'users/users_edit';
		$breadcrumb = array(
				'Pet Owners' => '',
				'Users' => $page_link
		);
		$data = array();
		$data['users'] = $this->be_model->get_users();
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
		
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
	
	public function approve($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag']) && isset($requests['remove_id'])) {
			$this->api_model->remove_user($requests['remove_id']);
			$response['result'] = 1;
		} else if(isset($requests['tag']) && isset($requests['approve_id'])) {
			$this->api_model->approve_user($requests['approve_id'], 1);
			$response['result'] = 1;
		}
		$page_title = 'Approve Registration';
		$page_link = 'users/approve';
		$breadcrumb = array(
				'Registered Users' => '',
				'Approve Registration' => $page_link
		);
		$data = array();
		$data['users'] = $this->be_model->get_users('approve');
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
	
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
	
	public function suspended_users($edit_id = NULL) {
		$requests = $this->input->post();
		$response = array();
		if(isset($requests['tag']) && isset($requests['remove_id'])) {
			$this->api_model->remove_user($requests['remove_id']);
			$response['result'] = 1;
		} else if(isset($requests['tag']) && isset($requests['suspend_id'])) {
			$this->api_model->suspend_user($requests['suspend_id'], 0);
			$response['result'] = 1;
		}
		$page_title = 'Suspended Users';
		$page_link = 'users/suspended_users';
		$breadcrumb = array(
				'Pet Owners' => '',
				'Suspended Users' => $page_link
		);
		$data = array();
		$data['users'] = $this->be_model->get_users('suspended');
		if(isset($edit_id)) $data['edit_id'] = $edit_id;
	
		$data_param = array('page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data);
		$this->be_page->generate(true, $page_link, $data_param, $response);
	}
	
}