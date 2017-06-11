<?php

if ( !defined('BASEPATH') )
    exit('No direct script access allowed');

class Interventions extends CI_Controller {
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
        $page_title = 'View All Interventions';
        $page_link = 'interventions/index';
        $breadcrumb = array(
            'Interventions' => '',
            'View All Interventions' => $page_link
        );
        $data = array();
        $data['class'] = 'interventions';
        $data['method'] = 'viewall';
/************************************** Form validation of the form ***********************************/     
        
        $data['all_data'] = $this->common_model->select_all_data("uc_interventions");
        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
      
    }
    
    public function addnew() {
      
/************************************  common data for all page that is required ************************/        
        $page_title = 'Add Interventions';
        $page_link = 'interventions/addnew';
        $breadcrumb = array(
            'Interventions' => '',
            'Add Interventions' => $page_link
        );
        $data = array();
        $data['class'] = 'interventions';
        $data['method'] = 'addnew';
/************************************** Form validation of the form ***********************************/     
        
        if($_POST){
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('intervention_name', 'Intervention Name', 'trim|required');
            $this->form_validation->set_rules('intervention_date', 'Intervention Date', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $data['error'] = "error occured";

            }else{

               $post_data = Array(
                    'intervention_name' => $this->input->post('intervention_name'),
                    'intervention_date' => date('Y-m-d',  strtotime($this->input->post('intervention_date'))),
                    'created_by' => $this->session->userdata['logged_in']['user_id'],
                    'created_at' => date("Y-m-d H:i:s ")
                ); 

               $property_id = $this->common_model->add_data("uc_interventions", $post_data);
               $this->session->set_flashdata('success','Information inserted successfully' );
               redirect("interventions/index", 'refresh');
            }
        }
          
        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
        
    }
    

    public function edit($edit_id = NULL) {
/************************************  common data for all page that is required ************************/        
        $page_title = 'Edit Interventions';
        $page_link = 'interventions/edit';
        $breadcrumb = array(
            'Interventions' => '',
            'Edit Interventions' => $page_link
        );
        $data = array();
        $data['class'] = 'interventions';
        $data['method'] = 'edit';
/************************************** Form validation of the form ***********************************/     
        if($_POST){
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            $this->form_validation->set_rules('intervention_name', 'Intervention Name', 'trim|required');
            $this->form_validation->set_rules('intervention_date', 'Intervention Date', 'trim|required');

            if ($this->form_validation->run() == FALSE) {

                $data['error'] = "error occured";

            }else{

               $post_data = Array(
                    'intervention_name' => $this->input->post('intervention_name'),
                    'intervention_date' => date('Y-m-d',  strtotime($this->input->post('intervention_date'))),
                    'created_by' => $this->session->userdata['logged_in']['user_id'],
                    'created_at' => date("Y-m-d H:i:s ")
                ); 

               $this->common_model->update_data("intervention_id",$edit_id,"uc_interventions", $post_data);
               $this->session->set_flashdata('success','Information updated successfully' );
               redirect("interventions/index", 'refresh');
            }
        }
        $data['all_data'] = $this->common_model->query_all_data("uc_interventions",'intervention_id',$edit_id);
        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
    }
    
    public function delete(){
        
                        $id=$this->uri->segment(3);
                        $this->common_model->delete_data('intervention_id', $id, 'uc_interventions');
                        $this->session->set_flashdata( 'delete', 'successfully deleted... ' );
                        redirect( base_url() . 'interventions/index' );
               
               
    }

}
