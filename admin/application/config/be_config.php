<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Admin Specific
//$config['domain_sub_directory'] = 'wagzapp.com';
$config['domain_sub_directory'] = '';

$config['path_uploads_temp'] = 'assets/file_upload/uploads/';
$config['file_upload_imagename_separator'] = '*.*';

$config['msg_success'] = 'Transaction Success!';
$config['msg_canceled'] = 'Transaction Canceled!';
$config['msg_failed'] = 'Transaction Failed!';

$config['msg_s'] = 'Operation Successful!';
$config['msg_f'] = 'Operation Failed!';
$config['msg_c'] = 'Operation Cancelled!';

$config['user_role'] = array(
		'50' => array('name' => 'bizadmin', 'val' => 50, 'title' => 'Business Administrator'),
		'100' => array('name' => 'superadmin', 'val' => 100, 'title' => 'Super Administrator')
);


// System
$config['app_name'] = 'Wagz';
$config['appstore_url'] = 'https://itunes.apple.com/us/app/wagz/id1182723272?ls=1&mt=8';
$config['info_email'] = 'info@wagzapp.com';
$config['no_reply_email'] = 'no-reply@wagzapp.com'; 

// API Auth
$config['api_key'] = '2e020ec9c9e4af4f56fa378a79932e56';

// Messages
$config['msg_fill_form'] = 'Please fill the form correctly.';
$config['msg_username_taken'] = 'Your username is already taken. Try with a different name.';
$config['msg_email_taken'] = 'Your email address is already registered.';
$config['msg_location_empty'] = 'Your location is invalid.';
$config['msg_authentication_failed'] = 'Authentication failed.';
$config['msg_file_upload_failed'] = 'File Upload failed.';
$config['msg_process_error'] = 'An error occurred while processing your request. Please try again later.';
$config['msg_invite_already_sent'] = 'You have already sent an invite.';

// Paths
$config['path_media_users'] = 'assets/media/users/';
$config['path_media_pets'] = 'assets/media/pets/';
$config['path_media_businesses'] = 'assets/media/business_logo/';

$config['media_user_self_domain_prefix'] = 'wg_media_user_';
$config['media_pet_self_domain_prefix'] = 'wg_media_pet_';

// Settings
$config['user_auth_salt'] = '5491161f5ce55fdb9617b3133646e134';
$config['user_new_password_length'] = 7;


$config['user_settings_distance_default'] = 99; // miles
$config['user_settings_age_min_default'] = 18;
$config['user_settings_age_max_default'] = 55;

$config['limit_query_search_default'] = 30;
$config['limit_timelines_default'] = 100;
$config['limit_photos_per_user'] = 20;

$config['http_timeout_default'] = 10;

$config['feedback_receiver_emails'] = array('frankas35@yahoo.com', 'ethelen1@gmail.com', 'cscottward@gmail.com');


// Data
$config['request_care_types'] = array(
		1 => 'Boarding',
		2 => 'House Sitting',
		3 => 'Drop In Visit'
);

// Push notification
$config['pn_message_placeholder'] = 'WAGZ_PLACEHOLDER';

$config['pn_msg_invite'] = $config['pn_message_placeholder'] . ' sent a group invitation to you!';
$config['pn_msg_new_request'] = $config['pn_message_placeholder'] . ' made a request to your group!';
$config['pn_msg_request_accept'] = 'Your request is accepted!';

// Twilio
$config['tw_account_sid'] = 'ACd3993bccaec2e23952e4ddc7f334e6dc';
$config['tw_auth_token'] = '68a9ef42ee8cf19bc4dbd5aa1469a418';
$config['tw_from_number'] = '+16789169370';

// Others
error_reporting(1);
ini_set('display_errors', 1);
date_default_timezone_set('Europe/London');

?>