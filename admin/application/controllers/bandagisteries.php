<?php

if ( !defined('BASEPATH') )
    exit('No direct script access allowed');

class Bandagisteries extends CI_Controller {
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
        $page_title = 'View All Bandagisteries Info';
        $page_link = 'bandagisteries/index';
        $breadcrumb = array(
            'Bandagisteries' => '',
            'View All Bandagisteries' => $page_link
        );
        $data = array();
        $data['class'] = 'bandagisteries';
        $data['method'] = 'viewall';
/************************************** Form validation of the form ***********************************/     
        
        $data['all_data'] = $this->common_model->select_all_data("uc_bandagisteries");
        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
      
    }
    
    public function addnew() {
      
/************************************  common data for all page that is required ************************/        
        $page_title = 'Add Bandagisteries';
        $page_link = 'bandagisteries/addnew';
        $breadcrumb = array(
            'Bandagisteries' => '',
            'Add Bandagisteries' => $page_link
        );
        $data = array();
        $data['class'] = 'bandagisteries';
        $data['method'] = 'addnew';
/************************************** Form validation of the form ***********************************/     
        
        if($_POST){
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('bandagistery_name', 'Bandagistery Name', 'trim|required');
            $this->form_validation->set_rules('bandagistery_email', 'Bandagistery Email', 'trim|required');
            $this->form_validation->set_rules('bandagistery_country', 'Country field', 'trim|required');
            $this->form_validation->set_rules('bandagistery_zipcode', 'Zipcode field', 'trim|required');
            $this->form_validation->set_rules('bandagistery_city', 'City field', 'trim|required');
            $this->form_validation->set_rules('bandagistery_address', 'Address', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $data['error'] = "error occured";

            }else{

               $post_data = Array(
                    'bandagistery_name' => $this->input->post('bandagistery_name'),
                    'bandagistery_email' => $this->input->post('bandagistery_email'),
                    'bandagistery_city' => $this->input->post('bandagistery_city'),
                    'bandagistery_address' => $this->input->post('bandagistery_address'),
                    'bandagistery_zipcode' => $this->input->post('bandagistery_zipcode'),
                    'bandagistery_country' => $this->input->post('bandagistery_country'),
                    'created_by' => $this->session->userdata['logged_in']['user_id'],
                    'created_at' => date("Y-m-d H:i:s ")
                ); 

               $property_id = $this->common_model->add_data("uc_bandagisteries", $post_data);
               $this->session->set_flashdata('success','Information inserted successfully' );
               redirect("bandagisteries/index", 'refresh');
            }
        }
          
        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
        
    }
    

    public function edit($edit_id = NULL) {
/************************************  common data for all page that is required ************************/        
        $page_title = 'Edit Bandagistery';
        $page_link = 'bandagisteries/edit';
        $breadcrumb = array(
            'Bandagistery' => '',
            'Add Bandagistery' => $page_link
        );
        $data = array();
        $data['class'] = 'bandagisteries';
        $data['method'] = 'edit';
/************************************** Form validation of the form ***********************************/     
        
        
        if($_POST){
             $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('bandagistery_name', 'Bandagistery Name', 'trim|required');
            $this->form_validation->set_rules('bandagistery_email', 'Bandagistery Email', 'trim|required');
            $this->form_validation->set_rules('bandagistery_country', 'Country field', 'trim|required');
            $this->form_validation->set_rules('bandagistery_zipcode', 'Zipcode field', 'trim|required');
            $this->form_validation->set_rules('bandagistery_city', 'City field', 'trim|required');
            $this->form_validation->set_rules('bandagistery_address', 'Address', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $data['error'] = "error occured";

            }else{

                $post_data = Array(
                    'bandagistery_name' => $this->input->post('bandagistery_name'),
                    'bandagistery_email' => $this->input->post('bandagistery_email'),
                    'bandagistery_city' => $this->input->post('bandagistery_city'),
                    'bandagistery_address' => $this->input->post('bandagistery_address'),
                    'bandagistery_zipcode' => $this->input->post('bandagistery_zipcode'),
                    'bandagistery_country' => $this->input->post('bandagistery_country'),
                    'created_by' => $this->session->userdata['logged_in']['user_id'],
                    'created_at' => date("Y-m-d H:i:s ")
                ); 

                $this->common_model->update_data("bandagistery_id",$edit_id,"uc_bandagisteries", $post_data);
               $this->session->set_flashdata('success','Information updated successfully' );
               redirect("bandagisteries/index", 'refresh');
            }
        }
        $data['all_data'] = $this->common_model->query_all_data("uc_bandagisteries",'bandagistery_id',$edit_id);
        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
    }
    
    public function delete(){
        
                        $id=$this->uri->segment(3);
                        $this->common_model->delete_data('bandagistery_id', $id, 'uc_bandagisteries');
                        $this->session->set_flashdata( 'delete', 'successfully deleted... ' );
                        redirect( base_url() . 'bandagisteries/index' );
               
               
    }

}
