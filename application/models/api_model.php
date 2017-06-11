<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function __construct() {

    }

    public function create_user($params){
        $result = array();
        $data = array();
        $request_fields = array('user_email', 'user_password', 'user_first_name', 'user_last_name', 'user_country_name', 'user_address', 'user_zipcode', 'user_city', 'user_country');
        foreach($request_fields as $request_field){
            if(isset($params[$request_field]) && $params[$request_field] != ''){
                $data[$request_field] = $params[$request_field];
                if($request_field == 'user_password'){
                    $data[$request_field] = $this->get_user_auth_salt($params[$request_field]);
                }
            }
        }
        $this->db->insert('uc_users', $data);
        $insert_id = $this->db->insert_id();
        $data['user_id'] = $insert_id;
        $result['user_data'] = $data;
        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;
    }

    public function edit_user($params){
        $result = array();
        $status = 0;
        $msg = '';
        $query = $this->db->get_where('uc_users', array('user_id'=>$params['user_id']));
        if($query->num_rows() > 0){
            $update_data = array();
            $request_fields = array('user_email', 'user_password', 'user_first_name', 'user_last_name', 'user_country_name', 'user_address', 'user_zipcode', 'user_city', 'user_country');
            foreach($request_fields as $request_field){
                if(isset($params[$request_field]) && $params[$request_field] != ''){
                    $update_data[$request_field] = $params[$request_field];
                    if($request_field == 'user_password'){
                        $update_data[$request_field] = $this->get_user_auth_salt($params[$request_field]);
                    }
                }
            }
            $this->db->update('uc_users', $update_data, array('user_id'=>$params['user_id']));
            $result['updated_user'] = $this->db->get_where('uc_users', array('user_id'=>$params['user_id']))->row_array();
            $status = 1;
            $msg = 'success';
        }
        $result['status'] = $status;
        $result['msg'] = $msg;
        return $result;
    }

    public function delete_user($params){
        $result = array();
        $status = 0;
        $msg = '';
        $query = $this->db->get_where('uc_users', array('user_id'=>$params['user_id']));
        if($query->num_rows() > 0){
            $this->db->delete('uc_users', array('user_id'=>$params['user_id']));
            $status = 1;
            $msg = 'success';
        }
        $result['status'] = $status;
        $result['msg'] = $msg;
        return $result;
    }

    public function create_product($params){
        $data = array();
        $request_fields = array('product_name', 'product_reference', 'product_description', 'product_supplier', 'product_color', 'product_stock', 'product_size', 'product_stock_unit', 'product_purchasing_price', 'product_selling_price', 'product_vat', 'product_category', 'product_category_code', 'product_sub_category', 'product_sub_category_code');
        foreach($request_fields as $request_field){
            if(isset($params[$request_field]) && $params[$request_field] != ''){
                $data[$request_field] = $params[$request_field];
            }
        }
        $data['product_user_id'] = $params['user_id'];
        $this->db->insert('uc_products', $data);
        $insert_id = $this->db->insert_id();
        $data['product_id'] = $insert_id;
        $result['product_data'] = $data;
        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;
    }

    public function edit_product($params){
        $result = array();
        $status = 0;
        $msg = '';
        $query = $this->db->get_where('uc_products', array('product_id'=>$params['product_id']));
        if($query->num_rows() > 0){
            $update_data = array();
            $request_fields = array('product_name', 'product_reference', 'product_description', 'product_supplier', 'product_color', 'product_stock', 'product_size', 'product_stock_unit', 'product_purchasing_price', 'product_selling_price', 'product_vat', 'product_category', 'product_category_code', 'product_sub_category', 'product_sub_category_code');
            foreach($request_fields as $request_field){
                if(isset($params[$request_field]) && $params[$request_field] != ''){
                    $update_data[$request_field] = $params[$request_field];
                }
            }
            $this->db->update('uc_products', $update_data, array('product_id'=>$params['product_id']));
            $result['updated_product'] = $this->db->get_where('uc_products', array('product_id'=>$params['product_id']))->row_array();
            $status = 1;
            $msg = 'success';
        }
        $result['status'] = $status;
        $result['msg'] = $msg;
        return $result;
    }

    public function delete_product($params){
        $result = array();
        $status = 0;
        $msg = '';
        $query = $this->db->get_where('uc_products', array('product_id'=>$params['product_id']));
        if($query->num_rows() > 0){
            $this->db->delete('uc_products', array('product_id'=>$params['product_id']));
            $status = 1;
            $msg = 'success';
        }
        $result['status'] = $status;
        $result['msg'] = $msg;
        return $result;
    }

    public function create_patient($params){
        $result = array();
        $data = array();
        $request_fields = array('patient_first_name', 'patient_last_name', 'patient_email', 'patient_phone_number', 'patient_interventions');
        foreach($request_fields as $request_field){
            if(isset($params[$request_field]) && $params[$request_field] != ''){
                $data[$request_field] = $params[$request_field];
            }
        }
        $data['patient_user_id'] = $params['user_id'];
        $this->db->insert('uc_patients', $data);
        $insert_id = $this->db->insert_id();
        $data['patient_id'] = $insert_id;
        $result['patient_data'] = $data;
        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;        
    }

    public function edit_patient($params){
        $result = array();
        $status = 0;
        $msg = '';
        $query = $this->db->get_where('uc_patients', array('patient_id'=>$params['patient_id']));
        if($query->num_rows() > 0){
            $update_data = array();
            $request_fields = array('patient_first_name', 'patient_last_name', 'patient_email', 'patient_phone_number', 'patient_interventions');
            foreach($request_fields as $request_field){
                if(isset($params[$request_field]) && $params[$request_field] != ''){
                    $update_data[$request_field] = $params[$request_field];
                }
            }
            $this->db->update('uc_patients', $update_data, array('patient_id'=>$params['patient_id']));
            $result['updated_patient'] = $this->db->get_where('uc_patients', array('patient_id'=>$params['patient_id']))->row_array();
            $status = 1;
            $msg = 'success';
        }
        $result['status'] = $status;
        $result['msg'] = $msg;
        return $result;        
    }

    public function delete_patient($params){
        $result = array();
        $status = 0;
        $msg = '';
        $query = $this->db->get_where('uc_patients', array('patient_id'=>$params['patient_id']));
        if($query->num_rows() > 0){
            $this->db->delete('uc_patients', array('patient_id'=>$params['patient_id']));
            $status = 1;
            $msg = 'success';
        }
        $result['status'] = $status;
        $result['msg'] = $msg;
        return $result;        
    }

    public function create_bandagistery($params){
        $result = array();
        $data = array();
        $request_fields = array('bandagistery_name', 'bandagistery_email', 'bandagistery_address', 'bandagistery_zipcode', 'bandagistery_city', 'bandagistery_country');
        foreach($request_fields as $request_field){
            if(isset($params[$request_field]) && $params[$request_field] != ''){
                $data[$request_field] = $params[$request_field];
            }
        }
        $data['bandagistery_user_id'] = $params['user_id'];
        $this->db->insert('uc_bandagisteries', $data);
        $insert_id = $this->db->insert_id();
        $data['bandagistery_id'] = $insert_id;
        $result['bandagistery_data'] = $data;
        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;            
    }

    public function edit_bandagistery($params){
        $result = array();
        $status = 0;
        $msg = '';
        $query = $this->db->get_where('uc_bandagisteries', array('bandagistery_id'=>$params['bandagistery_id']));
        if($query->num_rows() > 0){
            $update_data = array();
            $request_fields = array('bandagistery_name', 'bandagistery_email', 'bandagistery_address', 'bandagistery_zipcode', 'bandagistery_city', 'bandagistery_country');
            foreach($request_fields as $request_field){
                if(isset($params[$request_field]) && $params[$request_field] != ''){
                    $update_data[$request_field] = $params[$request_field];
                }
            }
            $this->db->update('uc_bandagisteries', $update_data, array('bandagistery_id'=>$params['bandagistery_id']));
            $result['updated_bandagistery'] = $this->db->get_where('uc_bandagisteries', array('bandagistery_id'=>$params['bandagistery_id']))->row_array();
            $status = 1;
            $msg = 'success';
        }
        $result['status'] = $status;
        $result['msg'] = $msg;
        return $result;          
    }

    public function delete_bandagistery($params){
        $result = array();
        $status = 0;
        $msg = '';
        $query = $this->db->get_where('uc_bandagisteries', array('bandagistery_id'=>$params['bandagistery_id']));
        if($query->num_rows() > 0){
            $this->db->delete('uc_bandagisteries', array('bandagistery_id'=>$params['bandagistery_id']));
            $status = 1;
            $msg = 'success';
        }
        $result['status'] = $status;
        $result['msg'] = $msg;
        return $result;            
    }

    public function create_pharmacy($params){
        $result = array();
        $data = array();
        $request_fields = array('pharmacy_name', 'pharmacy_email', 'pharmacy_address', 'pharmacy_zipcode', 'pharmacy_city', 'pharmacy_country');
        foreach($request_fields as $request_field){
            if(isset($params[$request_field]) && $params[$request_field] != ''){
                $data[$request_field] = $params[$request_field];
            }
        }
        $data['pharmacy_user_id'] = $params['user_id'];
        $this->db->insert('uc_pharmacies', $data);
        $insert_id = $this->db->insert_id();
        $data['pharmacy_id'] = $insert_id;
        $result['pharmacy_data'] = $data;
        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;           
    }

    public function edit_pharmacy($params){
        $result = array();
        $status = 0;
        $msg = '';
        $query = $this->db->get_where('uc_pharmacies', array('pharmacy_id'=>$params['pharmacy_id']));
        if($query->num_rows() > 0){
            $update_data = array();
            $request_fields = array('pharmacy_name', 'pharmacy_email', 'pharmacy_address', 'pharmacy_zipcode', 'pharmacy_city', 'pharmacy_country');
            foreach($request_fields as $request_field){
                if(isset($params[$request_field]) && $params[$request_field] != ''){
                    $update_data[$request_field] = $params[$request_field];
                }
            }
            $this->db->update('uc_pharmacies', $update_data, array('pharmacy_id'=>$params['pharmacy_id']));
            $result['updated_pharmacy'] = $this->db->get_where('uc_pharmacies', array('pharmacy_id'=>$params['pharmacy_id']))->row_array();
            $status = 1;
            $msg = 'success';
        }
        $result['status'] = $status;
        $result['msg'] = $msg;
        return $result;         
    }

    public function delete_pharmacy($params){
        $result = array();
        $status = 0;
        $msg = '';
        $query = $this->db->get_where('uc_pharmacies', array('pharmacy_id'=>$params['pharmacy_id']));
        if($query->num_rows() > 0){
            $this->db->delete('uc_pharmacies', array('pharmacy_id'=>$params['pharmacy_id']));
            $status = 1;
            $msg = 'success';
        }
        $result['status'] = $status;
        $result['msg'] = $msg;
        return $result;            
    }

    public function create_intervention($params){
        $result = array();
        $data = array();
        $request_fields = array('intervention_name', 'intervention_date');
        foreach($request_fields as $request_field){
            if(isset($params[$request_field]) && $params[$request_field] != ''){
                $data[$request_field] = $params[$request_field];
            }
        }
        $this->db->insert('uc_interventions', $data);
        $insert_id = $this->db->insert_id();
        $data['intervention_id'] = $insert_id;
        $result['intervention_data'] = $data;
        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;               
    }

    public function edit_intervention($params){
        $result = array();
        $status = 0;
        $msg = '';
        $query = $this->db->get_where('uc_interventions', array('intervention_id'=>$params['intervention_id']));
        if($query->num_rows() > 0){
            $update_data = array();
            $request_fields = array('intervention_name', 'intervention_date');
            foreach($request_fields as $request_field){
                if(isset($params[$request_field]) && $params[$request_field] != ''){
                    $update_data[$request_field] = $params[$request_field];
                }
            }
            $this->db->update('uc_interventions', $update_data, array('intervention_id'=>$params['intervention_id']));
            $result['updated_intervention'] = $this->db->get_where('uc_interventions', array('intervention_id'=>$params['intervention_id']))->row_array();
            $status = 1;
            $msg = 'success';
        }
        $result['status'] = $status;
        $result['msg'] = $msg;
        return $result;          
    }

    public function delete_intervention($params){
        $result = array();
        $status = 0;
        $msg = '';
        $query = $this->db->get_where('uc_interventions', array('intervention_id'=>$params['intervention_id']));
        if($query->num_rows() > 0){
            $this->db->delete('uc_interventions', array('intervention_id'=>$params['intervention_id']));
            $status = 1;
            $msg = 'success';
        }
        $result['status'] = $status;
        $result['msg'] = $msg;
        return $result;          
    }

    // Common Functions
    public function get_address($lat, $lng, $timeoutParam = 0) {
        $timeout = (($timeoutParam == 0) ? config_item('http_timeout_default') : $timeoutParam);
        $arContext['http']['timeout'] = $timeout;
        $context = stream_context_create($arContext);
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim($lat) . ',' . trim($lng) . '&sensor=false';
        $json = @file_get_contents($url);
        $data = json_decode($json);
        $status = $data->status;
        if ($status == "OK")
            return $data->results[0]->formatted_address;
        else
            return false;
    }


    public function remove_characters($needle, $str) {
        $s = str_replace($needle, '', $str);
        //$s = $this->clean($s);
        return $s;
    }

    public function distance($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return $miles;
    }

    public function get_user_auth_salt($password) {
        return sha1(config_item('user_auth_salt') . md5($password));
    }
}
