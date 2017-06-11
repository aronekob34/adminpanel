<?php

if ( !defined('BASEPATH') )
    exit('No direct script access allowed');

class Pharmacies extends CI_Controller {
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
        
/************************************  common data for all page that is required ************************/        
        $page_title = 'View All Pharmacies Info';
        $page_link = 'pharmacies/index';
        $breadcrumb = array(
            'Pharmacies' => '',
            'View All Pharmacies' => $page_link
        );
        $data = array();
        $data['class'] = 'Pharmacies';
        $data['method'] = 'viewall';
/************************************** Form validation of the form ***********************************/     
        
        $data['all_data'] = $this->common_model->select_all_data("uc_pharmacies");
        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
      
    }
    
    public function addnew() {
      
/************************************  common data for all page that is required ************************/        
        $page_title = 'Add Pharmacies';
        $page_link = 'pharmacies/addnew';
        $breadcrumb = array(
            'Pharmacies' => '',
            'Add Pharmacies' => $page_link
        );
        $data = array();
        $data['class'] = 'pharmacies';
        $data['method'] = 'addnew';
/************************************** Form validation of the form ***********************************/     
        
        if($_POST){
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('pharmacy_name', 'Pharmacies Name', 'trim|required');
            $this->form_validation->set_rules('pharmacy_email', 'Pharmacies Email', 'trim|required');
            $this->form_validation->set_rules('pharmacy_country', 'Country field', 'trim|required');
            $this->form_validation->set_rules('pharmacy_zipcode', 'Zipcode field', 'trim|required');
            $this->form_validation->set_rules('pharmacy_city', 'City field', 'trim|required');
            $this->form_validation->set_rules('pharmacy_address', 'Address', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $data['error'] = "error occured";

            }else{

               $post_data = Array(
                    'pharmacy_name' => $this->input->post('pharmacy_name'),
                    'pharmacy_email' => $this->input->post('pharmacy_email'),
                    'pharmacy_city' => $this->input->post('pharmacy_city'),
                    'pharmacy_address' => $this->input->post('pharmacy_address'),
                    'pharmacy_zipcode' => $this->input->post('pharmacy_zipcode'),
                    'pharmacy_country' => $this->input->post('pharmacy_country'),
                    'created_by' => $this->session->userdata['logged_in']['user_id'],
                    'created_at' => date("Y-m-d H:i:s ")
                ); 

               $property_id = $this->common_model->add_data("uc_pharmacies", $post_data);
               $this->session->set_flashdata('success','Information inserted successfully' );
               redirect("pharmacies/index", 'refresh');
            }
        }
          
        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
        
    }
    

    public function edit($edit_id = NULL) {
/************************************  common data for all page that is required ************************/        
        $page_title = 'Edit Pharmacies';
        $page_link = 'pharmacies/edit';
        $breadcrumb = array(
            'Pharmacies' => '',
            'Add Pharmacies' => $page_link
        );
        $data = array();
        $data['class'] = 'pharmacies';
        $data['method'] = 'edit';
/************************************** Form validation of the form ***********************************/     
        
        
        if($_POST){
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('pharmacy_name', 'Pharmacies Name', 'trim|required');
            $this->form_validation->set_rules('pharmacy_email', 'Pharmacies Email', 'trim|required');
            $this->form_validation->set_rules('pharmacy_country', 'Country field', 'trim|required');
            $this->form_validation->set_rules('pharmacy_zipcode', 'Zipcode field', 'trim|required');
            $this->form_validation->set_rules('pharmacy_city', 'City field', 'trim|required');
            $this->form_validation->set_rules('pharmacy_address', 'Address', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $data['error'] = "error occured";

            }else{

               $post_data = Array(
                    'pharmacy_name' => $this->input->post('pharmacy_name'),
                    'pharmacy_email' => $this->input->post('pharmacy_email'),
                    'pharmacy_city' => $this->input->post('pharmacy_city'),
                    'pharmacy_address' => $this->input->post('pharmacy_address'),
                    'pharmacy_zipcode' => $this->input->post('pharmacy_zipcode'),
                    'pharmacy_country' => $this->input->post('pharmacy_country'),
                    'created_by' => $this->session->userdata['logged_in']['user_id'],
                    'created_at' => date("Y-m-d H:i:s ")
                ); 

                $this->common_model->update_data("pharmacy_id",$edit_id,"uc_pharmacies", $post_data);
               $this->session->set_flashdata('success','Information updated successfully' );
               redirect("pharmacies/index", 'refresh');
            }
        }
        $data['all_data'] = $this->common_model->query_all_data("uc_pharmacies",'pharmacy_id',$edit_id);
        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
    }
    
    public function delete(){
        
                        $id=$this->uri->segment(3);
                        $this->common_model->delete_data('pharmacy_id', $id, 'uc_pharmacies');
                        $this->session->set_flashdata( 'delete', 'successfully deleted... ' );
                        redirect( base_url() . 'pharmacies/index' );
               
               
    }

}
