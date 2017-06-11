<?php

if ( !defined('BASEPATH') )
    exit('No direct script access allowed');

class Products extends CI_Controller {

    public function index() {
        echo 'hello';
        die();
    }

    public function add() {
        $requests = $this->input->post();
        $response = array();
        if ( isset($requests['tag']) ) {
            $request_fields = array( 'title' => true, 'category_id' => true, 'content' => false, 'be_file_upload_name' => true );
            foreach ( config_item('product_details') as $key => $val ) {
                $request_fields = array_merge($request_fields, array( $key => false ));
            }
            $request_form_success = true;
            foreach ( $request_fields as $request_field => $required ) {
                if ( !isset($requests[$request_field]) ) {
                    $request_form_success = false;
                    break;
                } else {
                    if ( $required && ($requests[$request_field] == '') ) {
                        $request_form_success = false;
                        break;
                    }
                }
            }
            if ( !$request_form_success ) {
                $response['result'] = 0;
                $response['report']['status'] = 0;
                $response['report']['msg'] = 'Please fill the form correctly';
            } else {
                $result = $this->api_model->add_product($requests);
                if ( $result['state'] == 1 ) {
                    $response['result'] = 1;
                } else if ( $result['state'] == 2 ) {
                    $response['result'] = 0;
                    $response['report']['status'] = 2;
                    $response['report']['msg'] = 'Same data already exists in the table.';
                } else if ( $result['state'] == 3 ) {
                    $response['result'] = 0;
                    $response['report']['status'] = 2;
                    $response['report']['msg'] = 'File upload failed.';
                } else {
                    $response['result'] = 0;
                    $response['report']['status'] = 3;
                }
            }
        }
        $page_title = 'Add Product';
        $page_link = 'products/add';
        $breadcrumb = array(
            'Products' => '',
            'Manage Products' => '',
            'Add Product' => $page_link
        );
        $data = array();
      //  $data['products'] = $this->be_model->get_products();
       // $data['categories'] = $this->be_model->get_categories();

        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
    }

    public function edit($edit_id = NULL) {
        $requests = $this->input->post();
        $response = array();
        if ( isset($requests['tag']) && isset($edit_id) ) {

            $request_fields = array( 'title' => true, 'category_id' => true, 'content' => false );
            foreach ( config_item('product_details') as $key => $val ) {
                $request_fields = array_merge($request_fields, array( $key => false ));
            }
            $request_form_success = true;
            foreach ( $request_fields as $request_field => $required ) {
                if ( !isset($requests[$request_field]) ) {
                    $request_form_success = false;
                    break;
                } else {
                    if ( $required && $requests[$request_field] == '' ) {
                        $request_form_success = false;
                        break;
                    }
                }
            }
            if ( !isset($requests['be_file_upload_name']) || !isset($requests['image_ids']) )
                $request_form_success = false;

            if ( !$request_form_success ) {
                $response['result'] = 0;
                $response['report']['status'] = 0;
                $response['report']['msg'] = 'Please fill the form correctly';
            } else {
                $result = $this->api_model->edit_product($requests, $edit_id);
                if ( $result['state'] == 1 ) {
                    $response['result'] = 1;
                } else if ( $result['state'] == 2 ) {
                    $response['result'] = 0;
                    $response['report']['status'] = 2;
                    $response['report']['msg'] = 'Same data already exists in the table.';
                } else if ( $result['state'] == 3 ) {
                    $response['result'] = 0;
                    $response['report']['status'] = 2;
                    $response['report']['msg'] = 'File upload failed.';
                } else {
                    $response['result'] = 0;
                    $response['report']['status'] = 3;
                }
            }
        } else if ( isset($requests['tag']) && isset($requests['remove_id']) ) {
            $this->api_model->remove_product($requests['remove_id']);
            $response['result'] = 1;
        }
        $page_title = 'Edit Products';
        $page_link = 'products/edit';
        $breadcrumb = array(
            'Products' => '',
            'Manage Products' => '',
            'Edit Products' => $page_link
        );
        $data = array();
        $data['products'] = $this->be_model->get_products();
        $data['categories'] = $this->be_model->get_categories();

        if ( isset($edit_id) )
            $data['edit_id'] = $edit_id;

        $data_param = array( 'page_title' => $page_title, 'breadcrumb' => $breadcrumb, 'data' => $data );
        $this->be_page->generate(true, $page_link, $data_param, $response);
    }

}
