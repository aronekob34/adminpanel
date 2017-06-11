<?php

if ( !defined('BASEPATH') )
    exit('No direct script access allowed');

class Patients extends CI_Controller {
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
        $page_title = 'View All Patients Info';
        $page_link = 'patients/index';
        $breadcrumb = array(
            'Patients' => '',
            'View All Patients' => $page_link
        );
        $data = array();
        $data['class'] = 'patients';
        $data['method'] = 'viewall';
/************************************** Form validation of the form ***********************************/     
        
        $data['all_data'] = $this->common_model->select_all_data("uc_patients");
        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
      
    }
    
    public function addnew() {
      
/************************************  common data for all page that is required ************************/        
        $page_title = 'Add Patients';
        $page_link = 'patients/addnew';
        $breadcrumb = array(
            'Patients' => '',
            'Add Patients' => $page_link
        );
        $data = array();
        $data['class'] = 'patients';
        $data['method'] = 'addnew';
/************************************** Form validation of the form ***********************************/     
        
        if($_POST){
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('patient_first_name', 'First  Name', 'trim|required');
            $this->form_validation->set_rules('patient_last_name', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('patient_email', 'Email Field', 'trim|required');
            $this->form_validation->set_rules('patient_phone_number', 'Phone Number', 'trim|required');
            $this->form_validation->set_rules('patient_interventions', 'Intervention field', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $data['error'] = "error occured";

            }else{

               $post_data = Array(
                    'patient_first_name' => $this->input->post('patient_first_name'),
                    'patient_last_name' => $this->input->post('patient_last_name'),
                    'patient_email' => $this->input->post('patient_email'),
                    'patient_phone_number' => $this->input->post('patient_phone_number'),
                    'patient_interventions' => $this->input->post('patient_interventions'),
                    'created_by' => $this->session->userdata['logged_in']['user_id'],
                    'created_at' => date("Y-m-d H:i:s ")
                ); 

               $property_id = $this->common_model->add_data("uc_patients", $post_data);
               $this->session->set_flashdata('success','Information inserted successfully' );
               redirect("patients/index", 'refresh');
            }
        }
        $data['all_data'] = array();
        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
        
    }
    

    public function edit($edit_id = NULL) {
/************************************  common data for all page that is required ************************/        
        $page_title = 'Edit Patients';
        $page_link = 'patients/edit';
        $breadcrumb = array(
            'Patients' => '',
            'Add Pharmacies' => $page_link
        );
        $data = array();
        $data['class'] = 'patients';
        $data['method'] = 'edit';
/************************************** Form validation of the form ***********************************/     
        
        
        if($_POST){
           $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('patient_first_name', 'First  Name', 'trim|required');
            $this->form_validation->set_rules('patient_last_name', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('patient_email', 'Email Field', 'trim|required');
            $this->form_validation->set_rules('patient_phone_number', 'Phone Number', 'trim|required');
            $this->form_validation->set_rules('patient_interventions', 'Intervention field', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $data['error'] = "error occured";

            }else{

               $post_data = Array(
                    'patient_first_name' => $this->input->post('patient_first_name'),
                    'patient_last_name' => $this->input->post('patient_last_name'),
                    'patient_email' => $this->input->post('patient_email'),
                    'patient_phone_number' => $this->input->post('patient_phone_number'),
                    'patient_interventions' => $this->input->post('patient_interventions'),
                    'created_by' => $this->session->userdata['logged_in']['user_id'],
                    'created_at' => date("Y-m-d H:i:s ")
                );  

                $this->common_model->update_data("patient_id",$edit_id,"uc_patients", $post_data);
               $this->session->set_flashdata('success','Information updated successfully' );
               redirect("patients/index", 'refresh');
            }
        }
        $data['all_data'] = $this->common_model->query_all_data("uc_patients",'patient_id',$edit_id);
        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
    }
    
    public function delete(){
        
                        $id=$this->uri->segment(3);
                        $this->common_model->delete_data('patient_id', $id, 'uc_patients');
                        $this->session->set_flashdata( 'delete', 'successfully deleted... ' );
                        redirect( base_url() . 'patients/index' );
               
               
    }

}
