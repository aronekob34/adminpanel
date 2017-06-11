<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_upload extends CI_Controller {
	public function index()	{
		$path_upload_temp = config_item('path_uploads_temp');
		// A list of permitted file extensions
		$allowed = array('png', 'jpg', 'jpeg', 'gif');
		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){
		
			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
			
			if(!in_array(strtolower($extension), $allowed)){
				echo '{"status":"error"}';
				return;
			}
			
			$file_name = element('id', $this->session->userdata('admin_logged_in')) . '_' . $_FILES['upl']['name'];
			
			if(move_uploaded_file($_FILES['upl']['tmp_name'], $path_upload_temp . $file_name)){
				echo '{"status":"success"}';
				return;
			}
		}
		
		echo '{"status":"error"}';
		return;
	}
	
	public function remove_temp_file() {
		$result = 's0';
		if(isset($_REQUEST['temp_file_name']) && $_REQUEST['temp_file_name'] != '') {
			$temp_file = config_item('path_uploads_temp') . $_REQUEST['temp_file_name'];
			if(file_exists($temp_file)) {
				unlink($temp_file);
				$result = 's1';
			} else {
				$result = 's2';
			}
		}
		echo $result;
		return;
	}
}