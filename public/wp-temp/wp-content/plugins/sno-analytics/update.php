<?php
/*
// TEMP: Enable update check on every request. Normally you don't need this! This is for testing only!
// NOTE: The 
//	if (empty($checked_data->checked))
//		return $checked_data; 
// lines will need to be commented in the check_for_plugin_update function as well.
*/
// set_site_transient('update_plugins', null);
/*
// TEMP: Show which variables are being requested when query plugin API
add_filter('plugins_api_result', 'sno_anal_result', 10, 3);
function sno_anal_result($res, $action, $args) {
	print_r($res);
	return $res;
}
// NOTE: All variables and functions will need to be prefixed properly to allow multiple plugins to be updated
*/


$aapi_url = 'http://updates.snosites.com/api/index.php';
$aplugin_slug = basename(dirname(__FILE__));


// Take over the update check
add_filter('pre_set_site_transient_update_plugins', 'sno_anal_check_for_plugin_update');

function sno_anal_check_for_plugin_update($achecked_data) {
	global $aapi_url, $aplugin_slug;
	
	//Comment out these two lines during testing.
	if (empty($achecked_data->checked))
		return $achecked_data;
	
	$aargs = array(
		'slug' => $aplugin_slug,
		'version' => $achecked_data->checked[$aplugin_slug .'/'. $aplugin_slug .'.php'],
	);
	$arequest_string = array(
			'body' => array(
				'action' => 'basic_check', 
				'request' => serialize($aargs),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress: ' . get_bloginfo('url')
		);
	
	// Start checking for an update
	$araw_response = wp_remote_post($aapi_url, $arequest_string);
	
	if (!is_wp_error($araw_response) && ($araw_response['response']['code'] == 200))
		$aresponse = unserialize($araw_response['body']);
	
	if (is_object($aresponse) && !empty($aresponse)) // Feed the update data into WP updater
		$achecked_data->response[$aplugin_slug .'/'. $aplugin_slug .'.php'] = $aresponse;
	
	return $achecked_data;
}


// Take over the Plugin info screen
add_filter('plugins_api', 'sno_anal_plugin_api_call', 10, 3);

function sno_anal_plugin_api_call($adef, $aaction, $aargs) {
	global $aplugin_slug, $aapi_url;
	
	if ($aargs->slug != $aplugin_slug)
		return false;
	
	// Get the current version
	$aplugin_info = get_site_transient('update_plugins');
	$acurrent_version = $aplugin_info->checked[$aplugin_slug .'/'. $aplugin_slug .'.php'];
	$aargs->version = $acurrent_version;
	
	$arequest_string = array(
			'body' => array(
				'action' => $aaction, 
				'request' => serialize($aargs),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $awp_version . '; ' . get_bloginfo('url')
		);
	
	$arequest = wp_remote_post($aapi_url, $arequest_string);
	
	if (is_wp_error($arequest)) {
		$ares = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $arequest->get_error_message());
	} else {
		$ares = unserialize($arequest['body']);
		
		if ($ares === false)
			$ares = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $arequest['body']);
	}
	
	return $ares;
}
?>