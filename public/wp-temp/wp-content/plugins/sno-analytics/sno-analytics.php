<?php
/*
Plugin Name: SNO Site Analytics
Plugin URI: http://schoolnewspapersonline.com/
Author: School Newspapers Online
Author URI: http://schoolnewspapersonline.com/
Version: 3.3
Description: This plugin enables site stats and analytics.
*/

// add css file for plugin

function sno_analytics_register_head() {
    $siteurl = get_option('siteurl');
    $url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/snoanalytics.css';
    echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
}
add_action('admin_head', 'sno_analytics_register_head');

// add the admin options page

add_action('admin_menu', 'sno_analytics_admin_add_page');

function sno_analytics_admin_add_page() {
	global $current_user; wp_get_current_user();
	$sno_user_name = $current_user->user_login;
	if (($sno_user_name == "snoadmin") || ($sno_user_name == "admin")) {
		add_options_page('SNO Admin Settings', 'SNO Admin Settings', 'manage_options', 'sno_analytics_plugin', 'sno_analytics_plugin_options_page');
	}
}
include_once ( dirname (__FILE__) . '/codes.php' ); 
include_once ( dirname (__FILE__) . '/update.php' ); 

// display the admin options page for the plugin

function sno_analytics_plugin_options_page() {
?>
<div class="snoprivacy">
<div class="wrap">
<div id="icon-options-general" class="icon32"></div>
<h2>SNO Administrator Settings</h2>
<form action="options.php" method="post">
<?php settings_fields('sno_analytics_options'); ?>
<?php do_settings_sections('sno_analytics_plugin'); ?>

<input class="button-primary" name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div></div>
<?php
}

// add the plugin settings on the options page

add_action('admin_init', 'sno_analytics_plugin_admin_init');
function sno_analytics_plugin_admin_init(){
register_setting( 'sno_analytics_options', 'sno_analytics_options', 'sno_analytics_options_validate' );

add_settings_section('sno_mobile', 'SNO Mobile', '', 'sno_analytics_plugin');
add_settings_field('sno_mobile_active', 'Is SNOMobile installed?', 'sno_mobile_settings', 'sno_analytics_plugin', 'sno_mobile');

add_settings_section('sno_hosting_credit', 'SNO Hosting Credit', '', 'sno_analytics_plugin');
add_settings_field('sno_hosting_credit', 'SNO Hosting Credit', 'sno_hosting_credit', 'sno_analytics_plugin', 'sno_hosting_credit');

add_settings_section('sno_site_analytics', 'Google Analytics', '', 'sno_analytics_plugin');
add_settings_field('sno_site_analytics_activate', 'Activate Site Analytics?', 'sno_site_analytics_activation_settings', 'sno_analytics_plugin', 'sno_site_analytics');
add_settings_field('sno_site_analytics_code', 'UA Code for Site', 'sno_site_analytics_code', 'sno_analytics_plugin', 'sno_site_analytics');

add_settings_section('sno_feedburner', 'Feedburner', '', 'sno_analytics_plugin');
add_settings_field('sno_analytics_activate', 'Activate Feedburner?', 'sno_feedburner_activation_settings', 'sno_analytics_plugin', 'sno_feedburner');
add_settings_field('sno_site_feedburner_code', 'Feedburner Code for Site', 'sno_site_feedburner_code', 'sno_analytics_plugin', 'sno_feedburner');

add_settings_section('sno_adbutler', 'Ad Butler', '', 'sno_analytics_plugin');
add_settings_field('sno_analytics_activate', 'Activate Ad Butler Code?', 'sno_adbutler_activation_settings', 'sno_analytics_plugin', 'sno_adbutler');
add_settings_field('sno_site_adbutler_code', 'Ad Butler Embed Code', 'sno_site_adbutler_code', 'sno_analytics_plugin', 'sno_adbutler');

//add_settings_section('sno_adzerk', 'Adzerk', '', 'sno_analytics_plugin');
//add_settings_field('sno_analytics_activate', 'Activate Adzerk Code?', 'sno_adzerk_activation_settings', 'sno_analytics_plugin', 'sno_adzerk');
//add_settings_field('sno_site_adzerk_code', 'Adzerk URL for javascript', 'sno_site_adzerk_code', 'sno_analytics_plugin', 'sno_adzerk');


add_settings_section('sno_ds', 'SNO Distinguished Sites', '', 'sno_analytics_plugin');
add_settings_field('sno_ds_2018_site', 'Site Excellence Badge 2018', 'sno_ds_2018_site', 'sno_analytics_plugin', 'sno_ds');
add_settings_field('sno_ds_2018_story', 'Story Page Excellence Badge 2018', 'sno_ds_2018_story', 'sno_analytics_plugin', 'sno_ds');
add_settings_field('sno_ds_2018_writing', 'Writing Excellence Badge 2018', 'sno_ds_2018_writing', 'sno_analytics_plugin', 'sno_ds');
add_settings_field('sno_ds_2018_media', 'Multimedia Excellence Badge 2018', 'sno_ds_2018_media', 'sno_analytics_plugin', 'sno_ds');
add_settings_field('sno_ds_2018_audience', 'Audience Engagement Badge 2018', 'sno_ds_2018_audience', 'sno_analytics_plugin', 'sno_ds');
add_settings_field('sno_ds_2018_coverage', 'Continuous Coverage Badge 2018', 'sno_ds_2018_coverage', 'sno_analytics_plugin', 'sno_ds');
add_settings_field('sno_ds_2018', 'SNO Distinguished Site 2018', 'sno_ds_2018', 'sno_analytics_plugin', 'sno_ds');

}

function sno_mobile_settings() {
$options = get_option('sno_analytics_options'); ?>
<input type="checkbox" <?php if ($options['sno_mobile_active']=='on') echo ' checked'; ?> id="sno_mobile_active" name="sno_analytics_options[sno_mobile_active]" value="on" /><?php
}

function sno_hosting_credit() {
$options = get_option('sno_analytics_options'); ?>
<select id="sno_hosting_credit" name="sno_analytics_options[sno_hosting_credit]">
	<option value="SNO Sites" <?php if ($options['sno_hosting_credit']=='SNO Sites') echo 'selected="selected"'; ?>>SNO Sites</option>
	<option value="Boosting Blue" <?php if ($options['sno_hosting_credit']=='Boosting Blue') echo 'selected="selected"'; ?>>Boosting Blue</option>
	<option value="None" <?php if ($options['sno_hosting_credit']=='None') echo 'selected="selected"'; ?>>None</option>
</select><?php
}

function sno_site_analytics_activation_settings() {
$options = get_option('sno_analytics_options'); ?>
<input type="checkbox" <?php if ($options['sno_site_analytics_activate']=='on') echo ' checked'; ?> id="sno_site_analytics_activate" name="sno_analytics_options[sno_site_analytics_activate]" value="on" /><?php
}

function sno_site_analytics_code() {
$options = get_option('sno_analytics_options');
echo "<input id='sno_site_analytics_code' name='sno_analytics_options[sno_site_analytics_code]' size='40' type='text' value='{$options['sno_site_analytics_code']}' />";
}

function sno_feedburner_activation_settings() {
$options = get_option('sno_analytics_options'); ?>
<input type="checkbox" <?php if ($options['sno_feedburner_analytics_activate']=='on') echo ' checked'; ?> id="sno_feedburner_analytics_activate" name="sno_analytics_options[sno_feedburner_analytics_activate]" value="on" /><?php
}

function sno_site_feedburner_code() {
$options = get_option('sno_analytics_options');
echo "<input id='sno_site_feedburner_code' name='sno_analytics_options[sno_site_feedburner_code]' size='40' type='text' value='{$options['sno_site_feedburner_code']}' />";
}

function sno_adbutler_activation_settings() {
$options = get_option('sno_analytics_options'); ?>
<input type="checkbox" <?php if ($options['sno_adbutler_analytics_activate']=='on') echo ' checked'; ?> id="sno_adbutler_analytics_activate" name="sno_analytics_options[sno_adbutler_analytics_activate]" value="on" /><?php
}

function sno_site_adbutler_code() {
$options = get_option('sno_analytics_options');
echo '<textarea id="sno_site_adbutler_code" name="sno_analytics_options[sno_site_adbutler_code]" cols="75" rows="6">' . $options['sno_site_adbutler_code'] . '</textarea>';
}

function sno_quantcast_activation_settings() {
$options = get_option('sno_analytics_options'); ?>
<input type="checkbox" <?php if ($options['sno_quantcast_analytics_activate']=='on') echo ' checked'; ?> id="sno_quantcast_analytics_activate" name="sno_analytics_options[sno_quantcast_analytics_activate]" value="on" /><?php
}

function sno_ds_2018_site() {
$options = get_option('sno_analytics_options'); ?>
<input type="checkbox" <?php if ($options['sno_ds_2018_site']=='on') echo ' checked'; ?> id="sno_ds_2018_site" name="sno_analytics_options[sno_ds_2018_site]" value="on" /><?php
}

function sno_ds_2018_story() {
$options = get_option('sno_analytics_options'); ?>
<input type="checkbox" <?php if ($options['sno_ds_2018_story']=='on') echo ' checked'; ?> id="sno_ds_2018_story" name="sno_analytics_options[sno_ds_2018_story]" value="on" /><?php
}

function sno_ds_2018_writing() {
$options = get_option('sno_analytics_options'); ?>
<input type="checkbox" <?php if ($options['sno_ds_2018_writing']=='on') echo ' checked'; ?> id="sno_ds_2018_writing" name="sno_analytics_options[sno_ds_2018_writing]" value="on" /><?php
}

function sno_ds_2018_media() {
$options = get_option('sno_analytics_options'); ?>
<input type="checkbox" <?php if ($options['sno_ds_2018_media']=='on') echo ' checked'; ?> id="sno_ds_2018_media" name="sno_analytics_options[sno_ds_2018_media]" value="on" /><?php
}

function sno_ds_2018_audience() {
$options = get_option('sno_analytics_options'); ?>
<input type="checkbox" <?php if ($options['sno_ds_2018_audience']=='on') echo ' checked'; ?> id="sno_ds_2018_audience" name="sno_analytics_options[sno_ds_2018_audience]" value="on" /><?php
}

function sno_ds_2018_coverage() {
$options = get_option('sno_analytics_options'); ?>
<input type="checkbox" <?php if ($options['sno_ds_2018_coverage']=='on') echo ' checked'; ?> id="sno_ds_2018_coverage" name="sno_analytics_options[sno_ds_2018_coverage]" value="on" /><?php
}

function sno_ds_2018() {
$options = get_option('sno_analytics_options'); ?>
<input type="checkbox" <?php if ($options['sno_ds_2018']=='on') echo ' checked'; ?> id="sno_ds_2018" name="sno_analytics_options[sno_ds_2018]" value="on" /><?php
}

// validate our options

function sno_analytics_options_validate($input) {
$newinput['sno_site_analytics_code'] = trim($input['sno_site_analytics_code']);
$newinput['sno_site_feedburner_code'] = trim($input['sno_site_feedburner_code']);
$newinput['sno_site_adbutler_code'] = trim($input['sno_site_adbutler_code']);
$newinput['sno_site_analytics_activate'] = trim($input['sno_site_analytics_activate']);
$newinput['sno_feedburner_analytics_activate'] = trim($input['sno_feedburner_analytics_activate']);
$newinput['sno_adbutler_analytics_activate'] = trim($input['sno_adbutler_analytics_activate']);
$newinput['sno_mobile_active'] = trim($input['sno_mobile_active']);
$newinput['sno_hosting_credit'] = trim($input['sno_hosting_credit']);

$newinput['sno_ds_2018_site'] = trim($input['sno_ds_2018_site']);
$newinput['sno_ds_2018_story'] = trim($input['sno_ds_2018_story']);
$newinput['sno_ds_2018_writing'] = trim($input['sno_ds_2018_writing']);
$newinput['sno_ds_2018_media'] = trim($input['sno_ds_2018_media']);
$newinput['sno_ds_2018_audience'] = trim($input['sno_ds_2018_audience']);
$newinput['sno_ds_2018_coverage'] = trim($input['sno_ds_2018_coverage']);
$newinput['sno_ds_2018'] = trim($input['sno_ds_2018']);

return $newinput;
}

// end of options page
?>