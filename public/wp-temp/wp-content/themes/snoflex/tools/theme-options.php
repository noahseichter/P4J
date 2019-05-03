<?php

$theme_base = get_option('stylesheet');
$settings = 'theme_mods_'.$theme_base; 

add_action('admin_init', 'register_theme_settings');
function register_theme_settings() {
	global $settings;
	register_setting($settings, $settings);
}

add_action('admin_menu', 'add_theme_options_menu');
function add_theme_options_menu() {
	add_submenu_page('themes.php', 'SNO '.__('Design Options','sno'), 'SNO '.__('Design Options','sno'), 'manage_options', 'theme-options', 'theme_settings_admin');
}

function theme_settings_admin() { ?>
<?php theme_options_css_js(); ?>
<div class="wrap">
<?php

global $settings, $defaults;	

	if(isset($_REQUEST['restored']) && $_REQUEST['restored'] == 'true') {
		$timestamp = $_REQUEST['id'];
		$gmtOffset=get_option('gmt_offset'); 
		$offset = $gmtOffset * 3600;
		$time = $timestamp + $offset; 
		$design_time = date("M j, Y, g:i a", $time);
		
		echo '<div class="updated" style="background: #c2e3b9; border-color: #85c175;" id="message"><p>'.__('SNO Design Options', 'sno').' <strong>Restored</strong> to '.$design_time.'</p></div>';
		sno_delete_transients();
		delete_transient( 'sno_custom_css' );
	}


	if(isset($_REQUEST['settings-updated']) && $_REQUEST['settings-updated'] == 'true') {


		echo '<div class="updated fade" style="background: #c2e3b9; border-color: #85c175;" id="message"><p>'.__('SNO Design Options', 'sno').' <strong>'.__('SAVED', 'sno').'</strong></p></div>';
		sno_delete_transients();
		delete_transient( 'sno_custom_css' );

		global $wpdb;
		$clear_transients = $wpdb->get_results("DELETE FROM $wpdb->options WHERE option_name LIKE '%sno_sp_mini%'");

		$timestamp = time();
		$saved_options = maybe_serialize(get_theme_mods());
		$table_name = $wpdb->prefix . 'snodesignoptions';
		$wpdb->insert( $table_name, 
			array(
					'timestamp' => $timestamp,
					'backup' => $saved_options,
					'userid' => get_current_user_id(),
					'starred' => 0
			),
			array(
					'%d',
					'%s',
					'%d',
					'%d'
			)
		);
		
		// let's delete out any unstarred, untagged revisions that are more than one month old
		$one_month_ago = $timestamp - 2678400;
		$out_of_date_revisions = $wpdb->get_results( "SELECT * FROM $table_name WHERE timestamp < $one_month_ago AND starred = '0' AND name IS NULL" );
		
		foreach( $out_of_date_revisions as $revision) {
			$wpdb->delete( $table_name, array( 'id' => $revision->id));
		}
	
	}

	$oldstyle = get_theme_mod('sno-widget-style');
	$preset = get_theme_mod('design-preset');
	$create_new = get_theme_mod('design-create');
	$new_design_name = get_theme_mod('design-name');
	set_theme_mod( 'design-create', '' ); 

	if ($create_new == "Create New Preset") { 
	
		$new_names = sno_preset_names();
			
			$new_names = explode (",", $new_names);
			foreach ($new_names as $new_name) {
				if ($new_design_name == $new_name) $safety = "Stop";
			}
				
			$added_designs = get_option('added_designs');
			if ($added_designs != "") {
				foreach ($added_designs as $key => $value) {
					if ($new_design_name == $key) $safety = "Stop";
				}
			}						
	
		if ($safety != "Stop") {
		
			$newdesign = get_theme_mods();
				
			$new_array[$new_design_name] = $newdesign;

			$old_array = get_option ('added_designs');
			
				foreach ($old_array as $key => $value) {
				
					$new_array[$key] = $value;
				}
		
			update_option ('added_designs', $new_array);
			
			echo '<div class="updated" style="background: #c2e3b9; border-color: #85c175;" id="message"><p>You have successfully added <b>' . $new_design_name . '</b> to the <b>Preset Design</b> list.</strong></p></div>';
			
		} else {
		
			echo '<div class="updated" style="background: #ffebe8; border-color: #cc0000;" id="message"><p>Design creation failed.  Choose a design name that isn\'t already in use.</strong></p></div>';
		
		}

	} else if (($preset != "--Select--") && ($preset != "")) { 

		$newstyles = sno_default_designs($preset);
	
		if ($newstyles) {
		
			update_option($settings, $newstyles);
			update_option('sno_preset', $preset);
			echo '<div class="updated" style="background: #c2e3b9; border-color: #85c175;" id="message"><p>"'.$preset.'" Style Starter applied to site.  Nice choice!</strong></p></div>';

			
			$alloptions = get_option('sidebars_widgets'); 
			
			$changeto = get_theme_mod('widget-style-sno'); 
				if ($changeto == "") $changeto = get_theme_mod('widget-style');
				if ($changeto == "") $changeto = "Style 4"; 

			$changerightto = get_theme_mod('widget-style'); 
				if ($changerightto == "") $changerightto = "Style 4";
				
			foreach ($alloptions as $widget_area => $widgets) {
				if ($widget_area == 'sidebar-5' || $widget_area == 'sidebar-1') {
					$changeto = get_theme_mod('widget-style');
				} else {
					$changeto = get_theme_mod('widget-style-sno');
				}
				if ($changeto == '') $changeto = 'Style 4';
				
				foreach ($widgets as $number => $sno_widget) {
					$widget_id =  ltrim(strrchr($sno_widget,'-'), '-');
					$widget_name = 'widget_'.substr($sno_widget, 0, strripos($sno_widget, '-')); 	
					$widget_values = get_option($widget_name);
									
					if ($widget_values) {
	 					$widget_values[$widget_id]['widget-style'] = $changeto;
	 					$widget_values[$widget_id]['custom-colors'] = '';
	 					update_option ($widget_name, $widget_values);
 					}

				}
			}	
		} 
		
	} else if ((get_theme_mod('sno-widget-style') != "--Select--") && (get_theme_mod('sno-widget-style') != "")) {

		global $wpdb;
		$changeto = get_theme_mod('sno-widget-style');
		$number = array (1,2,3,4,5,6);
		$widgets = array (
			'widget_audio',
			'widget_video',
			'widget_videoembed',
			'widget_staff_profile',
			'widget_category',
			'widget_sportsscore',
			'widget_sportsschedule',
			'widget_athlete_profile', 
			'widget_sportsstandings', 
			'widget_page', 
			'widget_sno_text', 
			'widget_enews',
			'widget_sno_gallery'
		);
	
		foreach ($number as $count) {
			foreach ($widgets as $widget) {
				$wpdb->query("UPDATE wp_options SET option_value = REPLACE(option_value, 'Style $count', '$changeto') WHERE option_name = '$widget';"); 
					$wpdb->query("UPDATE wp_options SET option_value = REPLACE(option_value, 'snoccon', 'turnoff') WHERE option_name = '$widget';"); 
			}
		}	
					
	} 
		

?>
	<h2><?php _e('SNO Design Options', 'sno'); ?></h2>
	<form method="post" action="options.php">
	<?php settings_fields($settings); // important! ?>
	
    <div class="sno_options_page" style="width:855px">
	<div class="metabox-holder" style="width:635px">

<div class="glossymenu">

<div class="mainbar"><a class="menuheader submenuheader" id="section1" href="#">General Design and Layout</a></div>
<div class="submenu" style="padding:0px 0px 0px 35px;background: #f1f1f1;">

<a class="menuitem submenuheader" id="section1" href="#">How to Design Your Site</a>
<div class="submenu" id="section1body">
	<div class="inside">
		<div class="optionsboxwide">
			<p class="subheadingtext">Step 1: Customize Your Style Choices.</p>
			<p>Change the fonts, background, general appearance, and even your site's favicon and bullet points by using the tools provided under General Design and Layout.</p>
		</div>
		<div class="optionsboxwide">
			<p class="subheadingtext">Step 2: Create a custom header graphic.</p>
			<p>Your header graphic should have your logo, organization name, tagline, and any other essential information about your program.  Your graphic should be sized to 1400px wide, and the height should be between 150px and 200px.  You can upload your header graphic in the Custom Header Graphic section below.</p>
		</div>
		<div class="optionsboxwide">
			<p class="subheadingtext">Step 3: Select a width for your site.</p>
			<p>You can set the width anywhere from 980px to 1400px in the <b>Full-Width Browser Options</b> section on this page.</p>
		</div>
		<div class="optionsboxwide">
			<p class="subheadingtext">Step 4: Understand the structure of your homepage.</p>
			<p>By reading the <b>About the Homepage Structure</b> section on this page, you can view a diagram of the different areas of your homepage.</p>
		</div>
		<div class="optionsboxwide">
			<p class="subheadingtext">Step 5: Choose how you want the top four widget areas configured.</p>
			<p>In the <b>Widget Area Configuration</b> section on this page, you can choose which widget layout you want for the top widget areas of your homepage.</p>
		</div>
		<div class="optionsboxwide">
			<p class="subheadingtext">Step 6: Arrange the widgets on your homepage.</p>
			<p>Your homepage is constructed of widgets (individual blocks of content). By going to the <a href="/wp-admin/widgets.php" target="_blank">Edit Widgets page</a>, you can drag and drop individual widgets into the widget areas of your site.</p>
		</div>
		<div class="optionsboxwide">
			<p class="subheadingtext">Step 7: Customize your widget design.</p>
			<p>Each widget on your site can be assigned to one of five widget styles that you can customize in the Widget Styles section on this page. In addition, SNO widgets can each be assigned custom colors and styles in the controls for the individual widget on the <a href="/wp-admin/widgets.php" target="_blank">Edit Widget page</a>.</p>
		</div>


		<div style="clear:both"></div>
	</div>
</div>

<a class="menuitem submenuheader" id="section1a" href="#">Design Options Revision History</a>
<div class="submenu" id="section1abody">
	<div class="inside">
		<div class="optionsbox" style="width:550px;margin-bottom:10px;">
		<p class="headingtext">Restore previous design options</p>
		<p>Every time the design options on this page are saved, a new revision entry is created. To restore a previous design, click the Restore link next to the timestamp. This options restores all options on this page in addition to menu locations.  It does NOT restore widget settings or configurations.
		</p>
			<?php
			global $wpdb;
			$table_name = $wpdb->prefix . 'snodesignoptions';
			$count_query = "select count(*) from $table_name";
			$num = $wpdb->get_var($count_query);
			$limit = 20;
			$page = 1;
			$offset = 0;
			$start = $offset + 1;
			
			if ($num > $limit) {
				$limit_query = "LIMIT $limit";
			}
			
			$end = $limit;
			if ($num < $limit) $end = $num;
			
			$design_history = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY timestamp DESC $limit_query" );
			echo '<div id="restorearea">';
			echo '<div class="restorecontrols">';
				echo "$start-$end of $num Available Revisions";
				echo '<div id="restorelistnamed" class="restorelist restorelisticon dashicons dashicons-tag"></div>';
				echo '<div id="restoreliststarred" class="restorelist dashicons restorelisticon dashicons-star-filled"></div>';
				if ($limit < $num) echo '<div id="restorelistolder" class="restorelist restorelistbutton">Older</div>';
				if ($page != 1) echo '<div id="restorelistnewer" class="restorelist restorelistbutton">Newer</div>';
				echo '<div class="clear"></div>';
			echo '</div>';
			?><script type="text/javascript">
    			jQuery(document).ready(function() {
	    			jQuery(".restorelist").click(function(){
		    			var restoreaction = this.id;
						jQuery.ajax({
                           	url:"/wp-admin/admin-ajax.php",
							type:'POST',
							data:'action=morerestores&listtype=' + restoreaction + '&currentpage=1',
							success:function(results)
							{
								jQuery("#restorearea").replaceWith(results);
							}
	    				});

	    			});				
	    		});
				
			</script><?php

			echo '<div id="restoredesignlist">';
						
			foreach ($design_history as $design) {
				
				$gmtOffset=get_option('gmt_offset'); 
				$offset = $gmtOffset * 3600;
				$time = $design->timestamp + $offset; 
				$revision_id = $design->id;

				$design_time = date("M j, Y, g:ia", $time);
				echo '<div class="restoredesignrow">';
					echo $design_time;
					if ($design->userid != 0) {
						$designuser = get_userdata( $design->userid );
						echo " <i>(" . substr($designuser->first_name . " " . $designuser->last_name,0,15) . ")</i>";
					}
					echo '<div class="restoredesign" id="restore-'.$design->timestamp.'">Restore</div>';
					echo '<div class="restorestarred">';
						if ( $design->starred == 0 ) {
							echo '<div id="star-'.$design->timestamp.'" class="dashicons dashicons-star-empty"></div>';
						} else {
							echo '<div id="star-'.$design->timestamp.'" class="dashicons dashicons-star-filled"></div>';
						}
					echo '</div>';
					echo '<div class="restorename">';
						if ( $design->name == '') {
							echo '<div id="restore-tag-'.$design->timestamp.'" class="dashicons dashicons-tag"></div>';
							echo '<input id="restore-name-'.$design->timestamp.'" name="restore-name-'.$design->timestamp.'" value="" class="restore-name" placeholder="Tag this revision" style="display:none;" />';
							echo '<div id="restore-name-instructions-'.$design->timestamp.'" class="restore-name-instructions">Click Tag Icon to Save</div>';
						} else {
							echo '<input id="restore-name-'.$design->timestamp.'" name="restore-name-'.$design->timestamp.'" value="'.stripslashes($design->name).'" class="restore-name"  placeholder="Tag this revision" />';
							echo '<div id="restore-name-instructions-'.$design->timestamp.'" class="restore-name-instructions">Click Tag Icon to Save</div>';
							echo '<div id="restore-tag-'.$design->timestamp.'" class="dashicons dashicons-tag"></div>';
						} 
					echo '</div>';
				echo '</div>';
				?><script type="text/javascript">
    				jQuery(document).ready(function() {
	    				jQuery("#restore-tag-<?php echo $design->timestamp; ?>").click(function(){
		    				if (jQuery("#restore-name-<?php echo $design->timestamp; ?>").is(":visible")) { 
							} else {
								jQuery("#restore-name-<?php echo $design->timestamp; ?>").fadeIn().focus();
							}
		    			});
		    			jQuery("#restore-name-<?php echo $design->timestamp; ?>").keypress(function(){
			    			var string=jQuery(this).val();	
							if(string.length > 1){
								jQuery("#restore-name-instructions-<?php echo $design->timestamp; ?>").show();
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").addClass('tag-icon-save');
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").addClass('tag-icon-save-<?php echo $design->timestamp; ?>');
							} else {
								jQuery("#restore-name-instructions-<?php echo $design->timestamp; ?>").hide();								
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save');
								jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save-<?php echo $design->timestamp; ?>');
							}
			    		});
			    		jQuery(".tag-icon-save-<?php echo $design->timestamp; ?>").live('click', function(){
				    		var revisionname = encodeURIComponent(jQuery("#restore-name-<?php echo $design->timestamp; ?>").val());
							jQuery.ajax({
                            	url:"/wp-admin/admin-ajax.php",
								type:'POST',
								data:'action=namerevision&name=' + revisionname + '&id=' + <?php echo $revision_id; ?>,
								success:function(results)
								{
									jQuery("#restore-name-instructions-<?php echo $design->timestamp; ?>").hide();								
									jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save');
									jQuery("#restore-tag-<?php echo $design->timestamp; ?>").removeClass('tag-icon-save-<?php echo $design->timestamp; ?>');
								}
	    					});
			    		});
	    				jQuery("#star-<?php echo $design->timestamp; ?>").click(function(){
		    				if (jQuery(this).hasClass('dashicons-star-empty')) {
			    				jQuery(this).removeClass('dashicons-star-empty').addClass('dashicons-star-filled');
			    				var changeStar = 1;
							} else {
			    				jQuery(this).removeClass('dashicons-star-filled').addClass('dashicons-star-empty');								
			    				var changeStar = 0;
							}
							jQuery.ajax({
                            	url:"/wp-admin/admin-ajax.php",
								type:'POST',
								data:'action=updatestar&value=' + changeStar + '&id=' + <?php echo $revision_id; ?>,
								success:function(results)
								{
								}
	    					});
	    				});
	    				jQuery("#restore-<?php echo $design->timestamp; ?>").click(function(){
		    				jQuery("#restore-<?php echo $design->timestamp; ?>").text('Wait...');
	    					jQuery.ajax({
                            	url:"/wp-admin/admin-ajax.php",
								type:'POST',
								data:'action=restoredesign&id=' + <?php echo $revision_id; ?>,
								success:function(results)
								{
									window.location = '/wp-admin/themes.php?page=theme-options&restored=true&id=<?php echo $design->timestamp; ?>';
								}

	    					});
	    				});
	    			});
				</script><?php
			}
			
			echo '</div>'; // end of restoredesignlist
			
			echo '</div>'; // end of restorearea
			?>
			
		</div>
		<div style="clear:both"></div>
	</div>
</div>
				<?php $menus = get_theme_mod('nav_menu_locations'); ?>
				<input type="hidden" name="<?php echo $settings; ?>[nav_menu_locations][footer-menu]" value="<?php echo $menus['footer-menu']; ?>">
				<input type="hidden" name="<?php echo $settings; ?>[nav_menu_locations][header-menu]" value="<?php echo $menus['header-menu']; ?>">
				<input type="hidden" name="<?php echo $settings; ?>[nav_menu_locations][header-menu-2]" value="<?php echo $menus['header-menu-2']; ?>">
				<input type="hidden" name="<?php echo $settings; ?>[nav_menu_locations][mobile-menu]" value="<?php echo $menus['mobile-menu']; ?>">



<?php /* ?>
<a class="menuitem submenuheader" id="section1" href="#">SNO Preset Style Starters</a>
<div class="submenu" id="section1body">
	<div class="inside">

		<div class="optionsbox" style="width:550px;margin-bottom:10px;">
		<p class="headingtext">Apply a SNO Preset Style Starter</p>
		<p>When you apply a preset style, your site loads a preset configuration of style choices into the options below (colors, backgrounds, styles).  Applying a preset style will not affect any other non-style settings on this page (header images, category configurations, advertisement URLs, favicon, etc...).
		</p>
		<p><a target="_blank" href="http://www.snosites.com/style-starters/">View Descriptions of All Preset Style Starters</a></p> 
		</div>

		<div class="optionsbox" style="width:300px">
				<div style="border: 1px solid #85c175; background: #c2e3b9;padding:10px 10px 0px;margin-bottom:10px;">
				<p class="headingtext">Current Style Choice: <?php echo get_option('sno_preset'); ?></p>
				</div>
				
				
				
				<?php $menus = get_theme_mod('nav_menu_locations'); ?>
				<input type="hidden" name="<?php echo $settings; ?>[nav_menu_locations][footer-menu]" value="<?php echo $menus['footer-menu']; ?>">
				<input type="hidden" name="<?php echo $settings; ?>[nav_menu_locations][header-menu]" value="<?php echo $menus['header-menu']; ?>">
				<input type="hidden" name="<?php echo $settings; ?>[nav_menu_locations][header-menu-2]" value="<?php echo $menus['header-menu-2']; ?>">
				<input type="hidden" name="<?php echo $settings; ?>[nav_menu_locations][mobile-menu]" value="<?php echo $menus['mobile-menu']; ?>">



			<p class="headingtext">Apply a New Style</p>

			<p>
				1. Select a preset style.<br />
				<select class="design-preset" name="<?php echo $settings; ?>[design-preset]">
					<option value="">--Select--</option>

					<?php 	$new_names = sno_preset_names();
							$new_names = explode (",", $new_names);
							foreach ($new_names as $new_name) {
								echo '<option value="' . $new_name . '">' . $new_name . '</option>';
							}
					
					
							$added_designs = get_option('added_designs');
							if ($added_designs != "") {
								foreach ($added_designs as $key => $value) {
									echo '<option value="' . $key . '">' . $key . '</option>';
								}
							}					
					?>
				</select>
			</p>
			<div class="preset-choices">
				<p>
					2. Select a major accent color.<br />
					<?php sno_color_input($settings, 'reset-color1', $default='#990000'); ?> 
				</p>
		
				<p>
					3. Select a text color that shows on your major accent color. White (#ffffff) and black (#000000) work best.<br />
					<?php sno_color_input($settings, 'reset-color1-text', $default='#ffffff'); ?> 
				</p>

				<p>
					4. Select a minor accent color<br />
					<?php sno_color_input($settings, 'reset-color2', $default='#393939'); ?> 
				</p>

				<p>
					5. Select a text color that shows on your minor accent color. White (#ffffff) and black (#000000) work best.<br />
					<?php sno_color_input($settings, 'reset-color2-text', $default='#ffffff'); ?> 
				</p>
			
				<p>
					6. Click the "Save All Settings" Button.<br />
				</p>
			</div>
			<div class="custom-preset" style="display:none">
				<p>When you activate a preset style you created, the color override options are not active.  Rather, the preset style will show the colors that were on the site when the preset was originally saved.
				</p>
			</div>
			
			<script type="text/javascript">
    			jQuery(document).ready(function() {
        			if (jQuery(".design-preset").val() == "Fresh") { 
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(".design-preset").val() == "Smart") {
	        			jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(".design-preset").val() == "Sharp") {
	        			jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(".design-preset").val() == "Dusk") {
	        			jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(".design-preset").val() == "Classic") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(".design-preset").val() == "Keen") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(".design-preset").val() == "Pro") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(".design-preset").val() == "Bold") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(".design-preset").val() == "Modern") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(".design-preset").val() == "Minimalist") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(".design-preset").val() == "Clean") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(".design-preset").val() == "") {
        				jQuery(".preset-choices").slideUp('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else {
        				jQuery(".custom-preset").slideDown('slow');
        				jQuery(".preset-choices").slideUp('slow');
        			}
    			});
    			jQuery(".design-preset").change(function() {
        			if (jQuery(this).val() == "Fresh") { 
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(this).val() == "Smart") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(this).val() == "Sharp") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');	
        			} else if (jQuery(this).val() == "Dusk") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(this).val() == "Classic") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
					} else if (jQuery(this).val() == "Pro") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(this).val() == "Keen") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(this).val() == "Bold") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(this).val() == "Modern") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(this).val() == "Minimalist") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(this).val() == "Clean") {
        				jQuery(".preset-choices").slideDown('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else if (jQuery(this).val() == "") {
        				jQuery(".preset-choices").slideUp('slow');
        				jQuery(".custom-preset").slideUp('slow');
        			} else {
        				jQuery(".custom-preset").slideDown('slow');
        				jQuery(".preset-choices").slideUp('slow');
        			}
    			});
       		</script>
			
		</div>
	
		<div class="optionsboxright" style="width:220px;border:1px solid #ccc;">
			<p class="headingtext">Create your own Style</p>
			<p>If you've created a style that you'd like to save and come back to later, select "Create New Preset" from the option below and add a name for your new style.  After you create your style, it will show up in the list of preset options to the left.</p>
			<p>		
				<select class="design-create" name="<?php echo $settings; ?>[design-create]">
					<option value="">--Select--</option>
					<option style="padding-right:10px;" value="Create New Preset">Create New Preset</option>
				</select>
			</p>
			<div class="new-design-name">
				<p><input type="text" placeholder="Enter new design name" name="<?php echo $settings; ?>[design-name]" size="20" /></p>
			</div>
			<script type="text/javascript">
    			jQuery(".design-create").change(function() {
        			(jQuery(this).val() != "") ? jQuery(".new-design-name").slideDown('slow') : jQuery(".new-design-name").slideUp('slow');
    			});
	   			jQuery(document).ready(function() {
    	    		(jQuery(".design-create").val() != "") ? jQuery(".new-design-name").slideDown('slow') : jQuery(".new-design-name").slideUp('slow');
    			});
    		</script>

		
		</div>


		<div style="clear:both"></div>
	</div>
</div>
<?php */ ?>

<a class="menuitem submenuheader" id="section10" href="#">Fonts</a>
<div class="submenu" id="section10body">
	<div class="inside">
		<div class="optionsbox">

			<p>Header Website Name<br />
			<?php sno_font_selectbox($settings, 'header-font'); ?>
			</p>
			<p>Header Tagline<br />
				<?php sno_font_selectbox($settings, 'tagline-font'); ?>
			</p>
			<p>Top Navigation Bar<br />
				<?php sno_font_selectbox($settings, 'topnav-font'); ?>
			</p>
			<p>Bottom Navigation Bar<br />
				<?php sno_font_selectbox($settings, 'bottomnav-font'); ?>
			</p>
			<p>Headlines<br />
				<?php sno_font_selectbox($settings, 'headline-font'); ?>
			</p>
			<p>Headline Decks<br />
				<?php sno_font_selectbox($settings, 'deck-font'); ?>
			<p>Captions<br />
				<?php sno_font_selectbox($settings, 'caption-font'); ?>
			</p>
			<p>Headings Text (h1, h2, h3, h4, h5, h6)<br />
				<?php sno_font_selectbox($settings, 'headings-font'); ?> 
			</p>
			<p>Body Text<br />
				<?php sno_font_selectbox($settings, 'body-font'); ?> 
			</p>
			<p>Widget Titles<br />
				<?php sno_font_selectbox($settings, 'widget-font'); ?>
			</p>
			<p>Breaking News Ticker<br />
				<?php sno_font_selectbox($settings, 'breaking-font'); ?>
			</p>

		</div>
		<div class="optionsboxright">
			<p class="headingtext">Add More Google Fonts</p>
			<p>Just type the name of a Google Font on a new line below. Any font names added here will automatically be added to the font selectboxes after this page is saved.</p>
			<p><a target="_blank" href="http://www.google.com/webfonts/">Search for Fonts</a></p>
			<p>
<?php $addedfonts = get_theme_mod('add-font'); if ($addedfonts == '') $addedfonts = 'Monoton
Nosifer
Plaster
Special Elite'; ?>
			<textarea id="<?php echo $settings; ?>[add-font]" name="<?php echo $settings; ?>[add-font]" cols="20" rows="6"><?php echo $addedfonts; ?></textarea></p>
			<p>
				<?php sno_select_toggle($settings, 'googlefonts-activate', 'Enable,Disable', $default='Enable'); ?> Google Fonts
			</p>
			
		</div>

		<div style="clear:both"></div>
	</div>
</div>


<a class="menuitem submenuheader" id="section9" href="#">Background & General Appearance</a>
<div class="submenu" id="section9body">
	<div class="inside">
	<div class="optionsboxwrap">
		
		<div style="display:none;">
				<?php // This option is designed for exclusion of breaking news, sports scores, and staff profiles from story lists and widgets 
						$category = get_term_by('name', 'Uncategorized', 'category')->term_id; 
						wp_dropdown_categories(array('selected' => $category, 'name' => $settings.'[breaking-hidecat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); 
				?>
			
		</div>
		<div class="optionsbox" style="background: #eee;margin-bottom:10px;">
					

				<p class="headingtext">Links</p>
				<p>
					<?php sno_color_input($settings, 'accentcolor-links', $default='#990000'); ?> Color <br />
					<?php sno_select_toggle($settings, 'links-style', 'Hover Underline,Always Underline,Highlighter', $default='Hover Underline'); ?> Style<br />
					<?php sno_color_input($settings, 'links-style-color', $default='#cccccc'); ?> Highlighter Color
				</p>
		</div>
		<div class="optionsbox" style="background: #eee;margin-bottom:10px;">
				<p class="headingtext">Headline Links</p>
				<p>
					<?php sno_color_input($settings, 'accentcolor-headlines', $default='#990000'); ?> Color <br />
					<?php sno_select_toggle($settings, 'headline-links-style', 'Hover Underline,Always Underline,Highlighter', $default='Hover Underline'); ?> Style<br />
					<?php sno_color_input($settings, 'headline-links-style-color', $default='#cccccc'); ?> Highlighter Color
				</p>
		</div>
		<div class="optionsbox" style="background: #eee;margin-bottom:10px;">

				<p class="headingtext">Color Override</p>
				<p>
					<?php sno_checkbox($settings, 'homepage-override', $label='Activate Homepage Override', $default='On'); ?>
					<?php sno_color_input($settings, 'homepage-override-links', $default='#ffffff'); ?> Homepage Links Color <br />
					<?php sno_color_input($settings, 'homepage-override-text', $default='#ffffff'); ?> Homepage Text Color <br />
				</p>
				
		</div>
		<div class="optionsbox" style="background: #eee;margin-bottom:10px;">
				<p class="headingtext">Homepage Inner Background</p>
				<p>
					<?php sno_color_input($settings, 'innerbackground', $default='#dddddd'); ?> Inner Background Color
					<?php sno_pattern_selectbox($settings, 'innerbackground-pattern', $default='None'); ?> Pattern<br />
				</p>


		</div>
		<div class="optionsbox" style="background: #eee;margin-bottom:10px;">
			<p class="headingtext">Animation Effects</p>
			<p>
				<?php sno_checkbox($settings, 'sno-animate', $label='Disable Slide-Up Animations', $default='Disable'); ?>
			</p>
			<p>
				<?php sno_checkbox($settings, 'photo-animate', $label='Disable Photo Animations', $default='Disable'); ?>
			</p>
		</div>

		<div class="optionsbox" style="background: #eee;margin-bottom:10px;">
			<p class="headingtext">Date/Time Options</p>
			<p>
				<?php sno_checkbox($settings, 'time-style', $label='Convert to Uppercase', $default='on'); ?>
			</p>
			<p>Text to be added in front of date stamp<br />
				<input type="text" name="<?php echo $settings; ?>[time-pretext]" value="<?php echo get_theme_mod('time-pretext'); ?>" size="20" /> 
			</p><br />
			<p><b>Date/Time Style for Recent Stories</b><br />
				<?php sno_select_toggle($settings, 'time-format', 'Date Stamp,Time Stamp,Elapsed Time', $default='Date Stamp'); ?>
			</p>
			<div class="date-stamp-options">
			<p>Apply to stories for 
				<?php sno_select_toggle($settings, 'time-elapsed-limit', '1|1 Hour,2|6 Hours,3|12 Hours,4|24 Hours,5|1 Week', $default='4'); ?>
			</p>
			<p>
				<?php sno_checkbox($settings, 'time-alert', $label='Activate Custom Colors', $default='on'); ?>
			</p>
			<div class="time-color-options">
			<p>
				<?php sno_color_input($settings, 'time-alert-text', $default = get_theme_mod('reset-color1-text')); ?> Time Color
			</p>
			<p>
				<?php sno_checkbox($settings, 'time-alert-back', $label='Activate Custom Background Color', $default='on'); ?>
			</p>
			<div class="time-background-color-option">
			<p>
				<?php sno_color_input($settings, 'time-alert-background', $default = '#f3f032'); ?> Background Color
			</p>
			</div>
			<p>
				<?php sno_select_toggle($settings, 'time-alert-limit', '1|1 Hour,2|6 Hours,3|12 Hours,4|24 Hours,5|1 Week', $default='3'); ?> Duration for Custom Colors<br />
			</p>
			</div>
			<p>Text to be added in front of elapsed time or time stamp<br />
				<input type="text" name="<?php echo $settings; ?>[time-pretext-elapsed]" value="<?php echo get_theme_mod('time-pretext-elapsed'); ?>" size="20" /> 
			</p>
			<p>
				<?php sno_checkbox($settings, 'time-story-page', $label='Also apply options to story pages', $default='on'); ?>
			</p>
			</div>
		</div>
		<div class="optionsbox" style="background: #eee;margin-bottom:10px;">
			<p class="headingtext">School Name</p>
			<p>
				<input type="text" name="<?php echo $settings; ?>[school-name]" value="<?php echo get_theme_mod('school-name'); ?>" size="20" /> 
			</p>
		</div>
		<div class="optionsbox" style="background: #eee;margin-bottom:10px;">
				<p class="headingtext">Main Accent Color</p>
				<p>
					<?php sno_color_input($settings, 'reset-color1', $default='#990000'); ?> Background<br />
					<?php sno_color_input($settings, 'reset-color1-text', $default='#ffffff'); ?> Text
				</p>
		</div>		
		<div class="optionsbox" style="background: #eee;margin-bottom:10px;">
			<p class="headingtext">Story Custom Links</p>

			<p>Stories displayed in carousels, grids, parallax displays, and the immersive splash page can be assigned custom links.  To use this feature, enable custom links below, and add your custom link in the "Custom Link" custom field when adding/editing a story.</p>
			<p><?php sno_checkbox($settings, 'top-stories-links', $label='Enable Custom Links', $default='Yes'); ?></p>

		</div>

				
		<script type="text/javascript">
		    jQuery(".time-format").change(function() {
        		(jQuery(this).val() == "Date Stamp") ? jQuery(".date-stamp-options").slideUp('slow') : jQuery(".date-stamp-options").slideDown('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".time-format").val() == "Date Stamp") ? jQuery(".date-stamp-options").slideUp('slow') : jQuery(".date-stamp-options").slideDown('slow');
    		});
		
			jQuery('#time-alert-ck').change(function() {
   		 		jQuery('.time-color-options').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#time-alert-ck').prop('checked')) {
					jQuery(".time-color-options").slideDown('slow');
				} else {
					jQuery(".time-color-options").slideUp('slow');
				}
			});

			jQuery('#time-alert-back-ck').change(function() {
   		 		jQuery('.time-background-color-option').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#time-alert-back-ck').prop('checked')) {
					jQuery(".time-background-color-option").slideDown('slow');
				} else {
					jQuery(".time-background-color-option").slideUp('slow');
				}
			});
			
		</script>

		</div>
			<div class="optionsboxright">
					

				<p class="headingtext">Horizontal Section Borders</p>
				<p>Your site is built out of horizontal sections, each with a bottom border.  Use the options below to set a color and thickness for each border.</p>

				<p>Top Edge<br />
					<?php sno_color_input($settings, 'topedge-border', $default='#000000'); ?> 
					<?php sno_thickness_selectbox($settings, 'topedge-thickness', 40, $default='1px'); ?>
				</p>

				<p>Story Scroll Bar<br />
					<?php sno_color_input($settings, 'storybar-border', $default='#000000'); ?> 
					<?php sno_thickness_selectbox($settings, 'storybar-thickness', 40, $default='0px'); ?>
				</p>

				<p>Social/Search Border<br />
					<?php sno_color_input($settings, 'topbar-border', $default='#000000'); ?> 
					<?php sno_thickness_selectbox($settings, 'topbar-thickness', 40, $default='1px'); ?>
				</p>

				<p>Breaking News Border<br />
					<?php sno_color_input($settings, 'breaking-border', $default='#000000'); ?> 
					<?php sno_thickness_selectbox($settings, 'breaking-thickness', 40, $default='1px'); ?>
				</p>

				<p>Leaderboard Ad Border<br />
					<?php sno_color_input($settings, 'leaderboard-border', $default='#000000'); ?> 
					<?php sno_thickness_selectbox($settings, 'leaderboard-thickness', 40, $default='1px'); ?>
				</p>

				<p>Header Border<br /> 
					<?php sno_color_input($settings, 'header-border', $default='#000000'); ?> 
					<?php sno_thickness_selectbox($settings, 'header-thickness', 40, $default='1px'); ?>
				</p>

				<p>Top Navbar Border<br />
					<?php sno_color_input($settings, 'navbar-border', $default='#000000'); ?> 
					<?php sno_thickness_selectbox($settings, 'navbar-thickness', 40, $default='1px'); ?>
				</p>

				<p> Bottom Navbar Border<br /> 
					<?php sno_color_input($settings, 'subnavbar-border', $default='#000000'); ?> 
					<?php sno_thickness_selectbox($settings, 'subnavbar-thickness', 40, $default='1px'); ?>
				</p>

				<p>Main Content Border<br /> 
					<?php sno_color_input($settings, 'main-border', $default='#000000'); ?>
					<?php sno_thickness_selectbox($settings, 'main-thickness', 40, $default='1px'); ?>
				</p>
				
				<p>Footer Border<br />
					<?php sno_color_input($settings, 'footer-border', $default='#000000'); ?>
					<?php sno_thickness_selectbox($settings, 'footer-thickness', 40, $default='1px'); ?>					

</p>
</div>

			<div class="optionsboxright" style="margin-top:10px;">
					

				<p class="headingtext">Continue Reading Links</p>

					<?php $read_text = get_theme_mod('read-text'); if ($read_text == '') $read_text = "Read Story"; ?>
					<?php $continue_text = get_theme_mod('continue-text'); if ($continue_text == '') $continue_text = "Continue Reading"; ?>
					<p>Link Text<br />
					<input type="text" name="<?php echo $settings; ?>[read-text]" value="<?php echo $read_text; ?>" size="20" /> 
					</p>
					<p>Link Text after Teaser<br />
					<input type="text" name="<?php echo $settings; ?>[continue-text]" value="<?php echo $continue_text; ?>" size="20" /> 
					</p>
					<br />
				<p style="text-decoration: underline;margin-bottom:3px;font-weight:bold;">Styles for Overlay Links</p>
					<?php sno_color_input($settings, 'continue-overlay-border-color', $default='#ffffff'); ?> Border Color<br />
					<?php sno_thickness_selectbox($settings, 'continue-overlay-border-thickness', 3, $default='1px'); ?> Border Thickness<br />
					<?php sno_color_input($settings, 'continue-overlay-background-hover', $default='#ffffff'); ?> Background Hover<br />
					<?php sno_color_input($settings, 'continue-overlay-text-hover', $default='#000000'); ?> Text Hover<br />
					<?php sno_select_toggle($settings, 'continue-overlay-letter-spacing', '0px,1px,2px,3px', $default='1px'); ?> Letter Spacing<br />
					<?php sno_select_toggle($settings, 'continue-overlay-text-style', 'uppercase|UPPERCASE,capitalize|Capitalize,lowercase', $default='uppercase'); ?> Text Style<br />
					<?php sno_select_toggle($settings, 'continue-overlay-font-size', '10px,11px,12px,13px,14px,15px,16px', $default='12px'); ?> Text Size<br />
				
				<br />
				<p style="text-decoration: underline;margin-bottom:3px;font-weight:bold;">Styles for Non-Overlay Links</p>
					<?php sno_color_input($settings, 'continue-border-color', $default='#e5e5e5'); ?> Border Color<br />
					<?php sno_thickness_selectbox($settings, 'continue-border-thickness', 3, $default='1px'); ?> Border Thickness<br />
					<?php sno_color_input($settings, 'continue-background', $default='#fbfbfb'); ?> Background<br />
					<?php sno_color_input($settings, 'continue-text-color', $default='#777777'); ?> Text<br />
					<?php sno_color_input($settings, 'continue-background-hover', $default='#161616'); ?> Background Hover<br />
					<?php sno_color_input($settings, 'continue-text-hover', $default='#ffffff'); ?> Text Hover<br />
					<?php sno_select_toggle($settings, 'continue-letter-spacing', '0px,1px,2px,3px', $default='2px'); ?> Letter Spacing<br />
					<?php sno_select_toggle($settings, 'continue-text-style', 'uppercase|UPPERCASE,capitalize|Capitalize,lowercase', $default='uppercase'); ?> Text Style<br />
					<?php sno_select_toggle($settings, 'continue-font-size', '10px,11px,12px,13px,14px,15px,16px', $default='10px'); ?> Text Size<br />

			</div>
	<div style="clear:both"></div>
	</div>
</div>


<a class="menuitem submenuheader" id="section23" href="#">Favicon and Bullet Point Image</a>
<div class="submenu" id="section23body">
	<div class="inside">
	
	<div class="optionsbox">
		<p class="headingtext">Favicon</p>
				<p>A favicon is a small graphic that is associated with a website and that is displayed in the browser URL window as well as on the browser tab. To add a custom favicon, create a .png or .ico image that is 32px by 32px. After upload is completed, click "Insert into Post".</p>
				<input class="upload_image_button4 button-primary" type="button" value="Click to Upload Favicon Image" style="margin-bottom:5px;width:240px;"/>
				<input class="upload_image4" type="text" name="<?php echo $settings; ?>[favicon]" value="<?php if (get_theme_mod('favicon') == '') { echo '/wp-content/themes/snoflex/images/reddot.png'; } else { echo get_theme_mod('favicon'); } ?>" style="width:240px;" /> </p>
				<p class="headingtext">Current Favicon: <?php if (get_theme_mod('favicon')) { ?><img src="<?php if (is_ssl()) { echo str_replace("http://", "https://", get_theme_mod('favicon')); } else { echo get_theme_mod('favicon'); } ?>" style="width:16px"><?php } ?></p>
	</div>

	<div class="optionsboxright">
		<p class="headingtext">Bullet Point Image</p>

				<p>To add a custom bullet point image to replace the default black arrow, create a .png image that is 32px by 32px and upload it below. After upload is completed, click "Insert into Post".</p>
				<input class="upload_image_button5 button-primary" type="button" value="Click to Upload Bullet Point Image" style="margin-bottom:5px;width:240px;"/>
				<input class="upload_image5" type="text" name="<?php echo $settings; ?>[bullet-point]" value="<?php if (get_theme_mod('bullet-point') == '') { echo '/wp-content/themes/snoflex/images/bulletarrow.png'; } else { echo get_theme_mod('bullet-point'); } ?>" style="width:240px;" /> </p>
				<p class="headingtext">Current Bullet Point: <?php if (get_theme_mod('bullet-point')) { ?><img src="<?php if (is_ssl()) { echo str_replace("http://", "https://", get_theme_mod('bullet-point')); } else { echo get_theme_mod('bullet-point'); } ?>" style="max-width:16px"><?php } ?></p>
	</div>
	<div style="clear:both"></div>

	</div>
</div>


<a class="menuitem submenuheader" id="section25" href="#">Custom CSS</a>		
<div class="submenu" id="section25body" style="border-bottom:1px solid #cccccc;">
	<div class="inside">
		<div class="optionsbox" style="width:550px;margin-bottom:10px;">
			<p>
			<?php sno_checkbox($settings, 'activate-css', $label='Activate Custom CSS', $default='checked'); ?>
			</p>
			<p>Use the textarea below to add custom styles to override the default styles on the site.  If you don't understand how to write CSS, just pretend that this option doesn't even exist.</p>
			<textarea id="<?php echo $settings; ?>[custom-css]" name="<?php echo $settings; ?>[custom-css]" style="width:540px" rows="15"><?php echo get_theme_mod('custom-css'); ?></textarea></p>
		</div>
		<div style="clear:both"></div>
	</div>

</div>

</div><!-- end of first section-->
<!-- start of the second section-->
<div class="mainbar" style="margin-top:35px"><a class="menuheader submenuheader" id="section1" href="#">Homepage and Widget Areas</a></div>
<div class="submenu" style="padding:0px 0px 0px 35px;background: #f1f1f1;">
	
<?php $check_widgets = get_option('sidebars_widgets'); 
	
//	if (!empty($check_widgets['sidebar-11'])) echo 'Full-Width is active';
//	echo '<pre>'; print_r($check_widgets); echo '</pre>'; 
?>
	
	
	

<a class="menuitem submenuheader" id="section2" href="#">About the Homepage Structure</a>
<div class="submenu" id="section2body" >
	<div class="inside">
	
			<div class="optionsbox" style="width:550px">
				<img style="margin:0px 10px 0px 0px;width:334px;" src="<?php bloginfo('template_url');?>/images/sno-layout.jpg" />
				<div style="width:200px;float:right;margin-top:10px;">
					<div style="height:90px;width:100%;margin-bottom:10px;">
						<div style="<?php if (get_theme_mod('top-stories-scrollbox') != "Display") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 0px 0px 10px; margin-bottom:10px;">
							<p class="headingtext" style="margin-bottom:6px">Showcase Area is <?php if (get_theme_mod('top-stories-scrollbox') != "Display") { echo 'Inactive'; } else { echo 'Active';} ?></p>
						</div>
						<div style="<?php if (empty($check_widgets['sidebar-11'])) { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 0px 0px 10px;">
							<p class="headingtext" style="margin-bottom:6px">Top Full Width is <?php if (empty($check_widgets['sidebar-11'])) { echo 'Empty'; } else { echo 'Active';} ?></p>
						</div>
					</div>
					
					<div style="height:170px;margin-bottom:10px;border: 1px solid #85c175; background: #c2e3b9;padding:10px;">
						<p class="headingtext" style="margin-bottom:6px">
						Home Top Widget Areas
						</p>
						<p>
						You can add widgets to these four areas using the <a target="_blank" href="/wp-admin/widgets.php">widget interface</a>.  In the Home Top Widget Areas section below, you can choose any of 6 configurations for these areas.
						</p>
					</div>
					
					<div style="height:42px;margin-bottom:10px">
						<div style="<?php if (empty($check_widgets['sidebar-m-11'])) { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;">
							<p class="headingtext" style="margin-bottom:6px">Middle Area is <?php if (empty($check_widgets['sidebar-m-11'])) { echo 'Empty'; } else { echo 'Active';} ?></p>
						</div>
					</div>
					
					<div style="<?php if (empty($check_widgets['sidebar-7']) && empty($check_widgets['sidebar-8']) && empty($check_widgets['sidebar-9'])) { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;height:115px;">
							<p class="headingtext" style="margin-bottom:6px">Home Bottom Widget Areas are <?php if (empty($check_widgets['sidebar-7']) && empty($check_widgets['sidebar-8']) && empty($check_widgets['sidebar-9'])) { echo 'Empty'; } else { echo 'Active';} ?></p>
						</p>

						<p>
						Use the WordPress <a href="/wp-admin/widgets.php" target="_blank">widget interface</a> to add widgets.
						</p>
					</div>

					<div style="height:45px;margin-bottom:10px">
						<div style="<?php if (empty($check_widgets['sidebar-b-11'])) { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;">
							<p class="headingtext" style="margin-bottom:6px">Bottom Area is <?php if (empty($check_widgets['sidebar-b-11'])) { echo 'Empty'; } else { echo 'Active';} ?></p>
						</div>
					</div>

				</div>

			</div>
		<div style="clear:both"></div>

	</div>
</div>


<a class="menuitem submenuheader" id="section3" href="#">Immersive Splash Page</a>
<div class="submenu" id="section3abody">
	<div class="inside">
				<div style="<?php if (get_theme_mod('home-immersive-activate') == "") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
				<p class="headingtext">Immersive Splash Page is <?php if (get_theme_mod('home-immersive-activate') == "") { echo 'Inactive.'; } else { echo 'Active';} ?></p>
				</div>

		<div class="optionsbox">
				<p class="subheadingtext">About the Immersive Splash Page</p>
				<p>This option allows you to display a single story and its photo as an immersive splash page that will be seen at your home URL.</p>

				<div style="<?php if (get_theme_mod('home-immersive-activate') == "") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
				<p>
					<?php sno_checkbox($settings, 'home-immersive-activate', $label='Activate Immersive Splash Page', $default='Immersive'); ?>
				</p>
				</div>				


				<div class="subdivider"></div>


				<div class="immersive-options">

					<p class="subheadingtext">Category to be Displayed</p>
					<p>
					<?php $homebreakingcat = get_theme_mod('home-immersive-cat'); if ($homebreakingcat == '') $homebreakingcat = 11; ?>
    				<?php wp_dropdown_categories(array('selected' => $homebreakingcat, 'name' => $settings.'[home-immersive-cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?>
    				</p>
    				<p><?php sno_checkbox($settings, 'home-immersive-disable-widgets', $label='Disable Widget-Based Homepage', $default='Disable'); ?></p>

					<p><?php sno_select_toggle($settings, 'immersive-header', 'site|Text Link,logo|Mini Logo,none|None', $default='site'); ?> Mini Header<br />
					<span class="immersivelogooptions">	
						<?php sno_select_toggle($settings, 'immersive-header-transparency', '#fff|White,#000|Black,none|None', $default='none'); ?> Header Background<br />
					</span>
					<?php $skip_text = get_theme_mod('skip-text'); if ($skip_text == '') $skip_text = "&#8212; View Full Site"; ?>
					<span class="immersivetextoptions">	
						<input type="text" name="<?php echo $settings; ?>[skip-text]" value="<?php echo $skip_text; ?>" size="15" /> Link Text<br />
					</span>
					</p>	


    			</div>
		</div>
		<div class="immersive-options">
		<div class="optionsboxwrap" style="float:right">
			<div class="optionsboxright" style="margin-top:10px">
				<p>
					<?php sno_checkbox($settings, 'home-immersive-hide-overlay', $label='Hide Title Overlay', $default='on'); ?>
				</p>
				
				<div class="overlay-options">
				<p class="subheadingtext">Byline and Date</p>
				<p>
					<?php sno_checkbox($settings, 'home-immersive-byline', $label='Display Byline and Date', $default='Display'); ?>
				</p>
				<p class="subheadingtext">Content Appearance</p>
				<p>
					<?php sno_checkbox($settings, 'home-immersive-hide-menu', $label='Hide Menu', $default='Hide'); ?><br />
					<?php sno_checkbox($settings, 'home-immersive-hide-headline', $label='Hide Headline', $default='Hide'); ?><br />
					<?php sno_checkbox($settings, 'home-immersive-headline', $label='Remove Headline Link', $default='Remove'); ?><br />
					<?php sno_checkbox($settings, 'home-immersive-hide-teaser', $label='Hide Teaser', $default='Hide'); ?><br />
					<?php sno_checkbox($settings, 'home-immersive-html', $label='Allow HTML in Teaser', $default='Allow'); ?>
				</p>
				<p class="immersive-teaser-options">
					<?php sno_select_toggle($settings, 'home-immersive-teaser', '200,225,250,275,300,325,350,375,400,425,450,475,500', $default='350'); ?> Teaser Length (characters)
				<br /><i>If you add a custom excerpt to a story, the full excerpt will override this option.</i>	
				</p>
				<p>
					<?php sno_checkbox($settings, 'home-immersive-continue', $label='Hide Read More Link', $default='Hide'); ?>
				</p>
				
				<p class="subheadingtext">Overlay Appearance</p>
				
				<p>
					<?php sno_select_toggle($settings, 'home-immersive-width', '20%,30%,40%,50%,60%,70%,80%', $default='30%'); ?> Overlay Width<br />
					<?php sno_select_toggle($settings, 'home-immersive-position', 'Top Left,Top Right,Bottom Left,Bottom Right', $default='Top Left'); ?> Overlay Position<br />
					<?php sno_select_toggle($settings, 'home-immersive-darkness', '0|0 (No overlay),.1|1 (Lightest),.2|2,.3|3,.4|4,.5|5 (Medium),.6|6,.7|7,.8|8,.9|9,1|10 (Darkest)', $default='.5'); ?> Overlay Darkness<br />
					<?php sno_thickness_selectbox($settings, 'home-immersive-corner', 40, $default='10px'); ?> Corner Radius<br />
					<?php sno_select_toggle($settings, 'home-immersive-horizontal', '5%,10%,15%,20%,25%,30%', $default='20%'); ?> Horizontal Offset<br />
					<?php sno_select_toggle($settings, 'home-immersive-vertical', '5%,10%,15%,20%,25%,30%', $default='20%'); ?> Vertical Offset<br />
				</p>
				<p>
					<?php sno_checkbox($settings, 'home-immersive-catname', $label='Hide Category Name', $default='Hide'); ?>
				</p>
				<p class="home-immersive-cat-options">
					<?php sno_color_input($settings, 'home-immersive-header', $default=get_theme_mod('accentcolor-links')); ?> Cat Name Color<br />
				</p>
				</div>
			</div>
		</div>
		</div>

		<script type="text/javascript">

		    jQuery(".immersive-header").change(function() {
        		if (jQuery(this).val() == "logo") { jQuery(".immersivelogooptions").slideDown('slow'); jQuery(".immersivetextoptions").slideUp('slow')}
        		if (jQuery(this).val() == "site") { jQuery(".immersivetextoptions").slideDown('slow'); jQuery(".immersivelogooptions").slideUp('slow') }
        		if (jQuery(this).val() == "none") { jQuery(".immersivetextoptions").slideUp('slow'); jQuery(".immersivelogooptions").slideUp('slow') }
    		});
   			jQuery(document).ready(function() {
        		if (jQuery(".immersive-header").val() == "logo") { jQuery(".immersivelogooptions").slideDown('slow'); jQuery(".immersivetextoptions").slideUp('slow'); }
        		if (jQuery(".immersive-header").val() == "site") { jQuery(".immersivetextoptions").slideDown('slow'); jQuery(".immersivelogooptions").slideUp('slow'); }
        		if (jQuery(".immersive-header").val() == "none") { jQuery(".immersivetextoptions").slideUp('slow'); jQuery(".immersivelogooptions").slideUp('slow'); }
    		});
    		
			jQuery('#home-immersive-html-ck').change(function() {
   		 		jQuery('.immersive-teaser-options').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#home-immersive-html-ck').prop('checked')) {
					jQuery(".immersive-teaser-options").slideUp('slow');
				} else {
					jQuery(".immersive-teaser-options").slideDown('slow');
				}
			});
		
			jQuery('#home-immersive-catname-ck').change(function() {
   		 		jQuery('.home-immersive-cat-options').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#home-immersive-catname-ck').prop('checked')) {
					jQuery(".home-immersive-cat-options").slideUp('slow');
				} else {
					jQuery(".home-immersive-cat-options").slideDown('slow');
				}
			});

			jQuery('#home-immersive-hide-overlay-ck').change(function() {
   		 		jQuery('.overlay-options').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#home-immersive-hide-overlay-ck').prop('checked')) {
					jQuery(".overlay-options").slideUp('slow');
				} else {
					jQuery(".overlay-options").slideDown('slow');
				}
			});

			jQuery('#home-immersive-activate-ck').change(function() {
   		 		jQuery('.immersive-options').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#home-immersive-activate-ck').prop('checked')) {
					jQuery(".immersive-options").slideDown('slow');
				} else {
					jQuery(".immersive-options").slideUp('slow');
				}
			});

		</script>

		<div style="clear:both"></div>
	</div>
</div>

<a class="menuitem submenuheader" id="section3a" href="#">Above Header Full-Width Widget Area </a>
<div class="submenu" id="section3abody">
	<div class="inside">
				<div style="<?php if ( !is_active_sidebar('sidebar-h-11') ) { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
				<p class="headingtext">The Above Header Full-Width Widget Area is <?php if ( is_active_sidebar('sidebar-h-11') ) { echo 'Active.'; } else { echo 'Empty';} ?></p>
				</div>

				<p class="subheadingtext">About the Above Header Full-Width Widget Area</p>
				<p>This widget area is designed to allow you to place content above your homepage header area.  It is designed specifically for the Parallax Widget and the SNO Story Carousel widget.</p>
			<div class="optionsboxwide">
				<p class="subheadingtext">Jump Button/Logo</p>
				<p>If this widget area is tall enough to cause the header to not display until the reader scrolls down, you can add a jump button that takes the reader to the header area.</p>

					<?php sno_select_toggle($settings, 'above-header-jump', 'bouncing|Bouncing Arrow (Bottom Right),skip|Skip Link (Top Left)|skip,logo|Mini Logo (Top Left),none|Do Not Display', $default='skip'); ?> Jump Button<br />	
					<?php sno_select_toggle($settings, 'above-header-logo-transparency', '#fff|White,#000|Black,none|None', $default='none'); ?> Logo Background Transparency<br />	
					<?php sno_color_input($settings, 'upperwrap-background', $default='#000000'); ?> Background Color<br />
			<br />
				<?php $jump_text = get_theme_mod('jump-text'); if ($jump_text == '') $jump_text = "Skip to Main Site"; ?>
				<input type="text" name="<?php echo $settings; ?>[jump-text]" value="<?php echo $jump_text; ?>" size="20" /> Skip Link Text<br />
 					
			</div>
			<div class="optionsboxwide">
				<p class="subheadingtext">Margins</p>
 					<?php sno_checkbox($settings, 'upperwrap-top-margin', $label='Hide Top Margin', $default='on'); ?><br />
 					<?php sno_checkbox($settings, 'upperwrap-bottom-margin', $label='Activate Bottom Margin', $default='on'); ?>
			</div>
		<div style="clear:both"></div>
	</div>
</div>


<span class="topstory-options">
<a class="menuitem submenuheader" id="section3" href="#">Top Story Display Area</a>
<div class="submenu" id="section3body">
	<div class="inside">
				<div style="<?php if (get_theme_mod('home-breaking') == "") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
				<p class="headingtext">Homepage Top Story Display Area is <?php if (get_theme_mod('home-breaking') == "") { echo 'Inactive.'; } else { echo 'Active';} ?></p>
				</div>

		<div class="optionsbox">
				<p class="subheadingtext">About the Top Story Display Area</p>
				<p>This option allows you to display a single story at the top of your homepage rather than a carousel of stories.  It is useful for displaying major stories and breaking news events.</p>

				<div style="<?php if (get_theme_mod('home-breaking') == "") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
				<p>
					<?php sno_checkbox($settings, 'home-breaking', $label='Display Top Story Area', $default='Display'); ?>
				</p>
				</div>				
				<div class="subdivider"></div>


				<div class="topstory-options">

					<p class="subheadingtext">Category to be Displayed</p>
					<p>
					<?php $homebreakingcat = get_theme_mod('home-breaking-cat'); if ($homebreakingcat == '') $homebreakingcat = 11; ?>
    				<?php wp_dropdown_categories(array('selected' => $homebreakingcat, 'name' => $settings.'[home-breaking-cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?>
    				</p>
 					<p>
 						<?php sno_checkbox($settings, 'topstory-exclude', $label='Exclude Top Story from Category widgets on homepage', $default='Exclude'); ?>
 					</p>
 					<p>
 						<?php sno_checkbox($settings, 'topstory-mobile', $label='Include Top Story area when Mobile Widget Area is in use.', $default='Include'); ?>
 					</p>

    			</div>
		</div>
		<div class="topstory-options">
		<div class="optionsboxwrap" style="float:right">
			<div class="optionsboxright nonimmersive-options" style="margin-top:10px">
				<p class="subheadingtext">Headline Appearance</p>
				<p>
					<?php sno_select_toggle($settings, 'home-breaking-headline', '1.5em|Small,2em|Medium,2.5em|Large,3em|XL', $default='2.5em'); ?> Headline Size<br />
					<?php sno_select_toggle($settings, 'home-breaking-headline-caps', 'uppercase|Uppercase,none|None', $default='none'); ?> Headline Style
				</p>
			</div>
			<div class="optionsboxright" style="margin-top:10px">
				<p class="subheadingtext">Byline Appearance</p>
				<p>
					<?php sno_checkbox($settings, 'home-breaking-byline', $label='Display Byline', $default='Display'); ?>
				</p>
				<div class="breaking-byline-options">
					<p>
						<?php sno_color_input($settings, 'home-breaking-byline-background', $default='#f5f5f5'); ?> Byline Background Color<br />
						<?php sno_color_input($settings, 'home-breaking-byline-border', $default='#dddddd'); ?> Byline Border Color<br />
						<?php sno_thickness_selectbox($settings, 'home-breaking-byline-thickness', 10, $default='1px'); ?> Byline Border Thickness
					</p>
				</div>
			</div>
			<div class="optionsboxright" style="margin-top:10px">
				<p class="subheadingtext">Content Appearance</p>
				<p>
					<?php sno_select_toggle($settings, 'home-breaking-teaser', '200,225,250,275,300,325,350,375,400,425,450,475,500', $default='350'); ?> Teaser Length (characters)
				<br /><i>If you add a custom excerpt to a story, the full excerpt will override this option.</i>	
				</p>
				
				<p class="subheadingtext immersive-options">Overlay Appearance</p>

			</div>
			<div class="optionsboxright" style="margin-top:10px">
				<p class="subheadingtext">Background Appearance</p>
				<p>
					<?php sno_color_input($settings, 'home-breaking-background', $default='#f5f5f5'); ?> Background Color<br />
					<?php sno_color_input($settings, 'home-breaking-border', $default='#dddddd'); ?> Border Color<br />
				</p>
				<p>
					<?php sno_checkbox($settings, 'home-breaking-shadow', $label='Display Outer Drop Shadow', $default='On'); ?>
				</p>
			</div>
		</div>
		</div>

		<script type="text/javascript">
			jQuery('#home-breaking-byline-ck').change(function() {
   		 		jQuery('.breaking-byline-options').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#home-breaking-byline-ck').prop('checked')) {
					jQuery(".breaking-byline-options").slideDown('slow');
				} else {
					jQuery(".breaking-byline-options").slideUp('slow');
				}
			});
			
			jQuery('#home-breaking-ck').change(function() {
   		 		jQuery('.topstory-options').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#home-breaking-ck').prop('checked')) {
					jQuery(".topstory-options").slideDown('slow');
				} else {
					jQuery(".topstory-options").slideUp('slow');
				}
			});

		</script>
		
		<div style="clear:both"></div>
	</div>
</div>
</span>

<span class="showcase-hide">
<a class="menuitem submenuheader" id="section4" href="#">Showcase Carousel</a>
<div class="submenu" id="section4body">
	<div class="inside">
		<div style="<?php if (get_theme_mod('top-stories-scrollbox') == "") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
			<p class="headingtext">Homepage Showcase Carousel Display Area is <?php if (get_theme_mod('top-stories-scrollbox') == "") { echo 'Inactive.'; } else { echo 'Active';} ?></p>
		</div>

		<div class="optionsbox">
				<p class="subheadingtext">About the Showcase Area</p>
				<p>This option allows you to display a collection of stories at the top of your homepage.  For a story to be displayed in this area, it must have an image set as the Featured Image.</p>

				<div style="<?php if (get_theme_mod('top-stories-scrollbox') == "") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
				<p>
					<?php sno_checkbox($settings, 'top-stories-scrollbox', $label='Display Showcase Area', $default='Display'); ?>
				</p>
				</div>
				<div class="subdivider"></div>

				<div class="carousel-options">
				
					<p class="subheadingtext">Category to be Displayed</p>
					<p>
						<?php $featuredcat = get_theme_mod('featured-cat'); if ($featuredcat == '') $featuredcat = 11; ?>
    					<?php wp_dropdown_categories(array('selected' => $featuredcat, 'name' => $settings.'[featured-cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?></p>
    					
 					<p>
 						<?php sno_checkbox($settings, 'showcase-exclude', $label='Exclude Showcase stories from Category widgets on homepage', $default='Exclude'); ?>
 					</p>
 					<p>
 						<?php sno_checkbox($settings, 'showcase-mobile', $label='Include Showcase area when Mobile Widget Area is in use.', $default='Include'); ?>
 					</p>
    				
					<div class="subdivider"></div>
					<p class="subheadingtext">Showcase Style</p>
					<p>
						<?php sno_select_toggle($settings, 'top-stories-wide', 'Style 1|Image Carousel Standard Width,Style 2|Image Carousel Panoramic,Style 8|Image Carousel Full Photo,Style 6|Image Carousel with Thumbs,Style 3|Image/Text Carousel,Style 7|Image/Text Carousel with Thumbs,Style 4|Photo Blocks Standard Width,Style 5|Photo Blocks Full Width,Style 9|Photo Blocks Single Row Carousel,Style 10|Photo Blocks Two Rows', $default='Style 3'); ?>
					</p>
					<div class="subdivider"></div>

					<div style="<?php if (get_theme_mod('top-stories-links') == "") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">

					</div>
				</div>
			</div>
			
			<div class="optionsboxright carousel-options"><?php
				echo '<p class="headingtext">Appearance Options</p>';
				$carousel_style = get_theme_mod('top-stories-wide'); 

						echo "<p class='car-number-stories'>";
						sno_select_toggle($settings, 'featured-count', '1,2,3,4,5,6,7,8,9,10', $default='5'); 
						echo ' Number of Stories';
						echo '</p>';

						echo "<p class='car-extend'>";
						sno_checkbox($settings, 'top-stories-extend', $label='Extend ', $default='Extend');
						sno_select_toggle($settings, 'top-stories-extend-width', '15|30px,50|100px,100|200px,200|400px,Full Browser|to Browser Edges', $default='15');

						echo '</p>';
		
						echo "<p class='car-display-headline'>";
						sno_checkbox($settings, 'featured-scroll', $label='Display Headline Overlay', $default='Show');
						echo '</p>';

						echo "<p class='car-teaser-length'>";
						sno_select_toggle($settings, 'top-stories-teaser', '100,125,150,175,200,225,250,275,300,325,350,375,400,425,450', $default='300');
						echo ' Teaser Length (characters)</p>';

						echo "<p class='car-headline-location'>";
						sno_select_toggle($settings, 'top-stories-headline-location', 'Bottom Left,Bottom Right,Top Left,Top Right', $default='bottom left');
						echo ' Headline Location</p>';

						echo "<p class='car-photo-credit'>";
						sno_checkbox($settings, 'top-stories-credit', $label='Display Photo Credit', $default='Show');
						echo '</p>';

						echo "<p class='car-photo-caption'>";
						sno_checkbox($settings, 'top-stories-caption', $label='Display Photo Caption', $default='Show');
						echo '</p>';
						
						echo "<p class='car-cat-name'>";
						sno_checkbox($settings, 'top-stories-hide-cat', $label='Display Category Name', $default='No');
						echo '</p>';
						
						echo "<p class='car-date'>";
						sno_checkbox($settings, 'top-stories-hide-date', $label='Display Date', $default='No');
						echo '</p>';

						echo "<p class='car-nav-buttons'>";
						sno_checkbox($settings, 'top-stories-nav-buttons', $label='Display Navigation Buttons', $default='On');
						echo '</p>';

						echo "<p class='car-shadow'>";
						sno_checkbox($settings, 'top-stories-shadow', $label='Display Drop Shadow', $default='On');
						echo '</p>';
				
						echo "<p class='car-border'>";
						sno_checkbox($settings, 'top-stories-border', $label='Display Border', $default='On');
						echo '</p>';

					echo "<div class='top-stories-border'>";

						echo "<p class='car-border-thick'>";
						sno_thickness_selectbox($settings, 'top-stories-border-thickness', 20, $default='5px');
						echo ' Border Thickness';
						echo '</p>';
					
											echo "<p class='car-border-color'>";
						sno_color_input($settings, 'topstoriesborder', $default='#aaaaaa');
						echo ' Border Color';
						echo '</p>';

					echo '</div>';

						echo "<p class='car-back-color'>";
						sno_color_input($settings, 'topstoriesbackground', $default='#eeeeee');
						echo ' Background Color';
						echo '</p>';

						echo "<p class='car-grid'>";
						sno_checkbox($settings, 'top-stories-grid', $label='Display Grid Overlay', $default='Show');
						echo '</p>';

						echo "<p class='car-grid'>";
						sno_checkbox($settings, 'top-stories-mobile-override', $label='Show Headlines on Hover for Mobile', $default='On');
						echo '</p>';

						echo "<p class='car-padding'>";
						sno_checkbox($settings, 'top-stories-padding', $label='Remove Top Padding', $default='Remove');
						echo '</p>';
						
						echo "<div class='car-javascript subdivider'></div>";
						echo "<p class='car-javascript headingtext'>Javascript Controls</p>";


						echo "<p class='car-javascript'>";
						sno_select_toggle($settings, 'top-stories-transition', 'Fade,Horizontal|Slide', $default='Fade');
						echo ' Transition Style';
						echo '</p>';
						
						echo "<p class='car-javascript'>";
						sno_checkbox($settings, 'top-stories-automate', $label='Auto Scroll', $default='On');
						echo '</p>';
						
						echo "<p class='car-javascript'>";
						sno_select_toggle($settings, 'top-stories-speed', '4000|4 Seconds,5000|5 Seconds,6000|6 Seconds,7000|7 Seconds,8000|8 Seconds,9000|9 Seconds,10000|10 Seconds,11000|11 Seconds,12000|12 Seconds', $default='5000');			
						echo ' Slide Duration';
						echo '</p>';
						
						echo "<p class='car-javascript'>";
						sno_select_toggle($settings, 'top-stories-trans-speed', '333|Fast,666|Medium,1000|Slow', $default='666'); 
						echo ' Slide Transition Time';
						echo '</p>';
						?>	
		</div>
		<script type="text/javascript">
			jQuery('#top-stories-scrollbox-ck').change(function() {
   					jQuery('.showcase-hide').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#top-stories-scrollbox-ck').prop('checked')) {
					jQuery(".showcase-hide").slideDown('slow');
				} else {
					jQuery(".showcase-hide").slideUp('slow');
				}
			});

			jQuery('#top-stories-scrollbox-ck').change(function() {
   		 		jQuery('.carousel-options').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#top-stories-scrollbox-ck').prop('checked')) {
					jQuery(".carousel-options").slideDown('slow');
				} else {
					jQuery(".carousel-options").slideUp('slow');
				}
			});
						
			jQuery('#top-stories-border-ck').change(function() {
   		 		jQuery('.top-stories-border').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#top-stories-border-ck').prop('checked')) {
					jQuery(".top-stories-border").slideDown('slow');
				} else {
					jQuery(".top-stories-border").slideUp('slow');
				}
			});
						
    		jQuery(".top-stories-wide").change(function() {
        		if (jQuery(this).val() == "Style 1") { 

        			jQuery(".car-number-stories").slideDown('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideDown('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideUp('slow');
        			jQuery(".car-photo-credit").slideDown('slow');
        			jQuery(".car-photo-caption").slideUp('slow');
        			jQuery(".car-cat-name").slideUp('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideDown('slow');
        			jQuery(".car-shadow").slideDown('slow');
        			jQuery(".car-border").slideDown('slow');
        			jQuery(".car-border-thick").slideDown('slow');
        			jQuery(".car-border-color").slideDown('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideUp('slow');
        			jQuery(".car-javascript").slideDown('slow');
        			jQuery(".car-padding").slideUp('slow');

        		} else if ((jQuery(this).val() == "Style 2") || (jQuery(this).val() == "Style 8")) {

        			jQuery(".car-number-stories").slideDown('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideDown('slow');
        			jQuery(".car-headline-location").slideDown('slow');
        			jQuery(".car-teaser-length").slideUp('slow');
        			jQuery(".car-photo-credit").slideDown('slow');
        			jQuery(".car-photo-caption").slideUp('slow');
        			jQuery(".car-cat-name").slideUp('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideDown('slow');
        			jQuery(".car-shadow").slideDown('slow');
        			jQuery(".car-border").slideDown('slow');
        			jQuery(".car-border-thick").slideDown('slow');
        			jQuery(".car-border-color").slideDown('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideUp('slow');
        			jQuery(".car-javascript").slideDown('slow');
        			jQuery(".car-padding").slideDown('slow');

        		} else if (jQuery(this).val() == "Style 3") {

        			jQuery(".car-number-stories").slideDown('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideUp('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideDown('slow');
        			jQuery(".car-photo-credit").slideUp('slow');
        			jQuery(".car-photo-caption").slideDown('slow');
        			jQuery(".car-cat-name").slideDown('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideDown('slow');
        			jQuery(".car-shadow").slideDown('slow');
        			jQuery(".car-border").slideDown('slow');
        			jQuery(".car-border-thick").slideDown('slow');
        			jQuery(".car-border-color").slideDown('slow');
        			jQuery(".car-back-color").slideDown('slow');
        			jQuery(".car-grid").slideUp('slow');
        			jQuery(".car-javascript").slideDown('slow');
        			jQuery(".car-padding").slideDown('slow');

        		} else if (jQuery(this).val() == "Style 4") {

        			jQuery(".car-number-stories").slideUp('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideUp('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideUp('slow');
        			jQuery(".car-photo-credit").slideUp('slow');
        			jQuery(".car-photo-caption").slideUp('slow');
        			jQuery(".car-cat-name").slideDown('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideUp('slow');
        			jQuery(".car-shadow").slideUp('slow');
        			jQuery(".car-border").slideUp('slow');
        			jQuery(".car-border-thick").slideUp('slow');
        			jQuery(".car-border-color").slideUp('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideDown('slow');
        			jQuery(".car-javascript").slideUp('slow');
        			jQuery(".car-padding").slideUp('slow');

        		} else if (jQuery(this).val() == "Style 5") {

        			jQuery(".car-number-stories").slideUp('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideUp('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideUp('slow');
        			jQuery(".car-photo-credit").slideUp('slow');
        			jQuery(".car-photo-caption").slideUp('slow');
        			jQuery(".car-cat-name").slideDown('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideUp('slow');
        			jQuery(".car-shadow").slideUp('slow');
        			jQuery(".car-border").slideUp('slow');
        			jQuery(".car-border-thick").slideUp('slow');
        			jQuery(".car-border-color").slideUp('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideDown('slow');
        			jQuery(".car-javascript").slideUp('slow');
        			jQuery(".car-padding").slideDown('slow');

        		} else if (jQuery(this).val() == "Style 6") {

        			jQuery(".car-number-stories").slideDown('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideDown('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideUp('slow');
        			jQuery(".car-photo-credit").slideDown('slow');
        			jQuery(".car-photo-caption").slideUp('slow');
        			jQuery(".car-cat-name").slideUp('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideUp('slow');
        			jQuery(".car-shadow").slideUp('slow');
        			jQuery(".car-border").slideUp('slow');
        			jQuery(".car-border-thick").slideUp('slow');
        			jQuery(".car-border-color").slideUp('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideUp('slow');
        			jQuery(".car-javascript").slideDown('slow');
        			jQuery(".car-padding").slideUp('slow');

        		} else if (jQuery(this).val() == "Style 7") {

        			jQuery(".car-number-stories").slideDown('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideUp('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideDown('slow');
        			jQuery(".car-photo-credit").slideUp('slow');
        			jQuery(".car-photo-caption").slideDown('slow');
        			jQuery(".car-cat-name").slideDown('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideUp('slow');
        			jQuery(".car-shadow").slideUp('slow');
        			jQuery(".car-border").slideUp('slow');
        			jQuery(".car-border-thick").slideUp('slow');
        			jQuery(".car-border-color").slideUp('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideUp('slow');
        			jQuery(".car-javascript").slideDown('slow');
        			jQuery(".car-padding").slideDown('slow');

        		} else if (jQuery(this).val() == "Style 9") {

        			jQuery(".car-number-stories").slideDown('slow');
        			jQuery(".car-extend").slideDown('slow');
        			jQuery(".car-display-headline").slideUp('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideUp('slow');
        			jQuery(".car-photo-credit").slideUp('slow');
        			jQuery(".car-photo-caption").slideUp('slow');
        			jQuery(".car-cat-name").slideDown('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideUp('slow');
        			jQuery(".car-shadow").slideDown('slow');
        			jQuery(".car-border").slideUp('slow');
        			jQuery(".car-border-thick").slideUp('slow');
        			jQuery(".car-border-color").slideUp('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideUp('slow');
        			jQuery(".car-javascript").slideUp('slow');
        			jQuery(".car-padding").slideDown('slow');

        		} else if (jQuery(this).val() == "Style 10") {

        			jQuery(".car-number-stories").slideUp('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideUp('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideUp('slow');
        			jQuery(".car-photo-credit").slideUp('slow');
        			jQuery(".car-photo-caption").slideUp('slow');
        			jQuery(".car-cat-name").slideDown('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideUp('slow');
        			jQuery(".car-shadow").slideUp('slow');
        			jQuery(".car-border").slideUp('slow');
        			jQuery(".car-border-thick").slideUp('slow');
        			jQuery(".car-border-color").slideUp('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideUp('slow');
        			jQuery(".car-javascript").slideUp('slow');
        			jQuery(".car-padding").slideDown('slow');
        		} 
    		});


   			jQuery(document).ready(function() {
        		if (jQuery(".top-stories-wide").val() == "Style 1") { 

        			jQuery(".car-number-stories").slideDown('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideDown('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideUp('slow');
        			jQuery(".car-photo-credit").slideDown('slow');
        			jQuery(".car-photo-caption").slideUp('slow');
        			jQuery(".car-cat-name").slideUp('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideDown('slow');
        			jQuery(".car-shadow").slideDown('slow');
        			jQuery(".car-border").slideDown('slow');
        			jQuery(".car-border-thick").slideDown('slow');
        			jQuery(".car-border-color").slideDown('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideUp('slow');
        			jQuery(".car-javascript").slideDown('slow');
        			jQuery(".car-padding").slideUp('slow');

        		} else if ((jQuery(".top-stories-wide").val() == "Style 2") || (jQuery(".top-stories-wide").val() == "Style 8")) {

        			jQuery(".car-number-stories").slideDown('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideDown('slow');
        			jQuery(".car-headline-location").slideDown('slow');
        			jQuery(".car-teaser-length").slideUp('slow');
        			jQuery(".car-photo-credit").slideDown('slow');
        			jQuery(".car-photo-caption").slideUp('slow');
        			jQuery(".car-cat-name").slideUp('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideDown('slow');
        			jQuery(".car-shadow").slideDown('slow');
        			jQuery(".car-border").slideDown('slow');
        			jQuery(".car-border-thick").slideDown('slow');
        			jQuery(".car-border-color").slideDown('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideUp('slow');
        			jQuery(".car-javascript").slideDown('slow');
        			jQuery(".car-padding").slideDown('slow');

        		} else if (jQuery(".top-stories-wide").val() == "Style 3") {

        			jQuery(".car-number-stories").slideDown('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideUp('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideDown('slow');
        			jQuery(".car-photo-credit").slideUp('slow');
        			jQuery(".car-photo-caption").slideDown('slow');
        			jQuery(".car-cat-name").slideDown('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideDown('slow');
        			jQuery(".car-shadow").slideDown('slow');
        			jQuery(".car-border").slideDown('slow');
        			jQuery(".car-border-thick").slideDown('slow');
        			jQuery(".car-border-color").slideDown('slow');
        			jQuery(".car-back-color").slideDown('slow');
        			jQuery(".car-grid").slideUp('slow');
        			jQuery(".car-javascript").slideDown('slow');
        			jQuery(".car-padding").slideDown('slow');

        		} else if (jQuery(".top-stories-wide").val() == "Style 4") {

        			jQuery(".car-number-stories").slideUp('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideUp('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideUp('slow');
        			jQuery(".car-photo-credit").slideUp('slow');
        			jQuery(".car-photo-caption").slideUp('slow');
        			jQuery(".car-cat-name").slideDown('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideUp('slow');
        			jQuery(".car-shadow").slideUp('slow');
        			jQuery(".car-border").slideUp('slow');
        			jQuery(".car-border-thick").slideUp('slow');
        			jQuery(".car-border-color").slideUp('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideDown('slow');
        			jQuery(".car-javascript").slideUp('slow');
        			jQuery(".car-padding").slideUp('slow');

        		} else if (jQuery(".top-stories-wide").val() == "Style 5") {

        			jQuery(".car-number-stories").slideUp('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideUp('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideUp('slow');
        			jQuery(".car-photo-credit").slideUp('slow');
        			jQuery(".car-photo-caption").slideUp('slow');
        			jQuery(".car-cat-name").slideUp('slow');
        			jQuery(".car-date").slideUp('slow');
        			jQuery(".car-nav-buttons").slideUp('slow');
        			jQuery(".car-shadow").slideUp('slow');
        			jQuery(".car-border").slideUp('slow');
        			jQuery(".car-border-thick").slideUp('slow');
        			jQuery(".car-border-color").slideUp('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideDown('slow');
        			jQuery(".car-javascript").slideUp('slow');
        			jQuery(".car-padding").slideDown('slow');

        		} else if (jQuery(".top-stories-wide").val() == "Style 6") {

        			jQuery(".car-number-stories").slideDown('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideDown('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideUp('slow');
        			jQuery(".car-photo-credit").slideDown('slow');
        			jQuery(".car-photo-caption").slideUp('slow');
        			jQuery(".car-cat-name").slideUp('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideUp('slow');
        			jQuery(".car-shadow").slideUp('slow');
        			jQuery(".car-border").slideUp('slow');
        			jQuery(".car-border-thick").slideUp('slow');
        			jQuery(".car-border-color").slideUp('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideUp('slow');
        			jQuery(".car-javascript").slideDown('slow');
        			jQuery(".car-padding").slideUp('slow');

        		} else if (jQuery(".top-stories-wide").val() == "Style 7") {

        			jQuery(".car-number-stories").slideDown('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideUp('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideDown('slow');
        			jQuery(".car-photo-credit").slideUp('slow');
        			jQuery(".car-photo-caption").slideDown('slow');
        			jQuery(".car-cat-name").slideDown('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideUp('slow');
        			jQuery(".car-shadow").slideUp('slow');
        			jQuery(".car-border").slideUp('slow');
        			jQuery(".car-border-thick").slideUp('slow');
        			jQuery(".car-border-color").slideUp('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideUp('slow');
        			jQuery(".car-javascript").slideDown('slow');
        			jQuery(".car-padding").slideDown('slow');

        		} else if (jQuery(".top-stories-wide").val() == "Style 9") {

        			jQuery(".car-number-stories").slideDown('slow');
        			jQuery(".car-extend").slideDown('slow');
        			jQuery(".car-display-headline").slideUp('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideUp('slow');
        			jQuery(".car-photo-credit").slideUp('slow');
        			jQuery(".car-photo-caption").slideUp('slow');
        			jQuery(".car-cat-name").slideDown('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideUp('slow');
        			jQuery(".car-shadow").slideDown('slow');
        			jQuery(".car-border").slideUp('slow');
        			jQuery(".car-border-thick").slideUp('slow');
        			jQuery(".car-border-color").slideUp('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideUp('slow');
        			jQuery(".car-javascript").slideUp('slow');
        			jQuery(".car-padding").slideDown('slow');

        		} else if (jQuery(".top-stories-wide").val() == "Style 10") {

        			jQuery(".car-number-stories").slideUp('slow');
        			jQuery(".car-extend").slideUp('slow');
        			jQuery(".car-display-headline").slideUp('slow');
        			jQuery(".car-headline-location").slideUp('slow');
        			jQuery(".car-teaser-length").slideUp('slow');
        			jQuery(".car-photo-credit").slideUp('slow');
        			jQuery(".car-photo-caption").slideUp('slow');
        			jQuery(".car-cat-name").slideDown('slow');
        			jQuery(".car-date").slideDown('slow');
        			jQuery(".car-nav-buttons").slideUp('slow');
        			jQuery(".car-shadow").slideUp('slow');
        			jQuery(".car-border").slideUp('slow');
        			jQuery(".car-border-thick").slideUp('slow');
        			jQuery(".car-border-color").slideUp('slow');
        			jQuery(".car-back-color").slideUp('slow');
        			jQuery(".car-grid").slideUp('slow');
        			jQuery(".car-javascript").slideUp('slow');
        			jQuery(".car-padding").slideDown('slow');

        		} 
    		});
		</script>

		<div style="clear:both"></div>

	</div>
</div>
</span>

<a class="menuitem submenuheader" id="section5" href="#">Widget Area Configuration (Top Widget Areas)</a>
<div class="submenu" id="section5body">
	<div class="inside">
			<div class="optionsbox" style="width:550px">
				<div style="border: 1px solid #85c175; background: #c2e3b9;padding:10px 10px 0px;margin-bottom:10px;">

				<p class="headingtext">
				Home Top Widget Areas are configured to <?php sno_select_toggle($settings, 'sno-layout', 'Option 1,Option 2,Option 3,Option 4,Option 5,Option 6', $default='Option 3'); ?>
				</p>
				</div>
				<img style="margin:10px 0px 10px 0px;width:528px;" src="<?php bloginfo('template_url');?>/images/snotopwidgets.jpg" />
			</div>

		<div style="clear:both"></div>

	</div>
</div>


<a class="menuitem submenuheader" id="section8" href="#">Widget Styles</a>
<div class="submenu" id="section8body">
	<div class="inside">
		<p class="subheadingtext">About Widgets</p>
			<p>Your homepage is constructed of widgets (individual blocks of content).  There are two classifications of widgets (SNO and non-SNO).  <span style="font-weight:bold">Non-SNO widgets</span> come from either your default WordPress installation or from plugins added to your site.  <span style="font-weight:bold">SNO widgets</span> are the ones developed as custom tools for your news site by School Newspapers Online.</p>
		<p class="subheadingtext">About Widget Styles</p>
			<p>Each widget on your site can be assigned to one of five widget styles.  Use the choices on the left to assign default widget styles. Use the choices on the right to customize your five widget styles.</p>
				<p>Each SNO widget has an option that allows you to assign the widget to one of the five styles.  In addition, SNO widgets can each be assigned a custom color scheme in the controls for the individual widget.  <a href="/wp-admin/widgets.php">Click here</a> to view the widget control panel.</p>

	<div class="optionsbox" style="width:200px;">				
			
				<div style="border: 1px solid #4b6bdf; background: #a7b5e9;padding:10px;margin-bottom:10px;">
				
				<p class="subheadingtext">Style for Non-SNO Widgets</p>

				<p>All non-SNO widgets will be assigned to the style selected below.</p>
				
				<p>
					<?php sno_select_toggle($settings, 'widget-style', 'Style 1,Style 2,Style 3,Style 4,Style 5,Style 6', $default='Style 4'); ?>
 				</p>
 				
 				<p><i>This style will also apply to any SNO widgets in the Home Top Right widget area.</i></p>
				</div>				
				<div style="border: 1px solid #7327c6; background: #c999fd;padding:10px;margin-bottom:10px;">

				<p class="subheadingtext">Style for SNO Widgets</p>

				<p>All newly added SNO widgets will have this style as their default.  Changing this value <b>WILL NOT</b> change SNO widgets already on your site.</p>
				<p>
					<?php sno_select_toggle($settings, 'widget-style-sno', 'Style 1,Style 2,Style 3,Style 4,Style 5,Style 6', $default='Style 4'); ?> 
				</p>
				</div>
				

				<div class="subdivider"></div>

				<p class="subheadingtext">SNO Widget Style Reset</p>
				<p>Setting this value <b>WILL</b> change SNO widgets already in place on your site.</p>
				<p>
				<select name="<?php echo $settings; ?>[sno-widget-style]">
					<option>--Select--</option>
					<option value="Style 1">Style 1</option>
					<option value="Style 2">Style 2</option>
					<option value="Style 3">Style 3</option>
					<option value="Style 4">Style 4</option>
					<option value="Style 5">Style 5</option>
					<option value="Style 6">Style 6</option>
				</select>
				</p>
				<div class="subdivider" style="border-color:#eee"></div>
				<p> 
					<?php sno_checkbox($settings, 'widget-shadows', $label='Add Drop Shadows', $default='On'); ?>
				</p>

</div>

<div class="optionsboxwidgets">

<p class="headingtext">Widget Style 1</p>

<div style="width:140px;float:right;">
<div style="
	padding:6px;color:<?php echo get_theme_mod('widgetcolor1-text'); ?>; 
	background: <?php echo get_theme_mod('widgetcolor1'); ?> <?php if (get_theme_mod('widget1-gradient') == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if (get_theme_mod('widget1-gradient') == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo get_theme_mod('widget1-pattern'); ?>) repeat <?php } ?> !important;
	border-top: <?php echo get_theme_mod('widget1-thickness'); ?> solid <?php echo get_theme_mod('widgetborder1'); ?>; 
	border-left: <?php echo get_theme_mod('widget1-thickness'); ?> solid <?php echo get_theme_mod('widgetborder1'); ?>;
	border-right: <?php echo get_theme_mod('widget1-thickness'); ?> solid <?php echo get_theme_mod('widgetborder1'); ?>
">Widget Title</div>
<div style="
	padding:10px;background:<?php echo get_theme_mod('widgetbackground1'); ?>;
	border-bottom: <?php echo get_theme_mod('widget1-thickness'); ?> solid <?php echo get_theme_mod('widgetborder1'); ?>; 
	border-left: <?php echo get_theme_mod('widget1-thickness'); ?> solid <?php echo get_theme_mod('widgetborder1'); ?>;
	border-right: <?php echo get_theme_mod('widget1-thickness'); ?> solid <?php echo get_theme_mod('widgetborder1'); ?>
">Click "Save All Settings" to Update Appearance</div>
</div>

				<p>
					<?php sno_color_input($settings, 'widgetcolor1', $default='#990000'); ?> Title Bar<br />
					<?php sno_color_input($settings, 'widgetcolor1-text', $default='#ffffff'); ?> Title Bar Text<br />
					<?php sno_select_toggle($settings, 'widget1-text-size', 'Small,Medium,Large', $default='On'); ?> Title Bar Size<br />

					<?php sno_color_input($settings, 'widgetborder1', $default='#cccccc'); ?> Border <br />
					<?php sno_color_input($settings, 'widgetbackground1', $default='#ffffff'); ?> Background <br />
					<?php sno_thickness_selectbox($settings, 'widget1-thickness', 10, $default='1px'); ?> Border Thickness<br />
					<?php sno_select_toggle($settings, 'widget1-gradient', 'On|Gradient,Off|Pattern,None|None', $default='On'); ?> Title Bar Background<br />
					<?php sno_pattern_selectbox($settings, 'widget1-pattern', $default='None'); ?> Title Bar Pattern (if active)<br />
					<?php sno_checkbox($settings, 'widget1-center', $label='Center title', $default='On'); ?><br />
				</p>

			<?php if (get_theme_mod('widget-style') == "Style 1") { ?>
				<div style="border: 1px solid #4b6bdf; background: #a7b5e9;padding:10px 10px 0px;margin-bottom:10px;">
					<p>Style 1 is the default style for non-SNO widgets.</p>
				</div>
			<?php } ?>
			<?php if (get_theme_mod('widget-style-sno') == "Style 1") { ?>
				<div style="border: 1px solid #7327c6; background: #c999fd;padding:10px 10px 0px;margin-bottom:10px;">
					<p>Style 1 is the default style for SNO widgets.</p>
				</div>
			<?php } ?>

</div>
<div class="optionsboxwidgets">

<p class="headingtext">Widget Style 2</p>

<div style="width:140px;float:right;">

<div style="
	<?php if (get_theme_mod('widget7-padding') == "Off") { ?>
		margin: 0px 10px 0px; 
	<?php } else { ?>
		margin-bottom:0px; 
	<?php } ?> 
		border-bottom:<?php echo get_theme_mod('widget7-thickness2'); ?> solid <?php echo get_theme_mod('widgetborder7'); ?>; 
		border-top:<?php echo get_theme_mod('widget7-thickness'); ?> solid <?php echo get_theme_mod('widgetborder7'); ?>;
		background:<?php echo get_theme_mod('widgetbackground7'); ?>;
">

<div style="
	<?php if (get_theme_mod('widget7-padding') == "Off") { ?>
		padding:8px 0px 8px <?php if (get_theme_mod('widget7-indent') == "On") { ?>8px;<?php } else { ?> 0px; <?php } ?>
	<?php } else { ?>
		padding:8px; 
	<?php } ?>
		margin:1px 0px;color:<?php echo get_theme_mod('widgetcolor7-text'); ?>;
	background: <?php echo get_theme_mod('widgetcolor7'); ?> <?php if (get_theme_mod('widget7-gradient') == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if (get_theme_mod('widget7-gradient') == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo get_theme_mod('widget7-pattern'); ?>) repeat <?php } ?> !important;
">Widget Title
</div>
</div>
<div style="<?php if (get_theme_mod('widget7-padding') == "Off") { ?>margin: 0px 10px 20px; padding:10px 0px 0px 0px; <?php } else { ?>padding:10px; <?php } ?>background:<?php echo get_theme_mod('widgetbackground7'); ?>;">Click "Save All Settings" to Update Appearance
</div>

</div>

				<p>
					<?php sno_color_input($settings, 'widgetcolor7', $default='#990000'); ?> Title Bar<br />
					<?php sno_color_input($settings, 'widgetcolor7-text', $default='#ffffff'); ?> Title Bar Text <br />
					<?php sno_select_toggle($settings, 'widget7-text-size', 'Small,Medium,Large', $default='On'); ?> Title Bar Size<br />
					<?php sno_color_input($settings, 'widgetborder7', $default='#aaaaaa'); ?> Header Border<br />
					<?php sno_color_input($settings, 'widgetbackground7', $default='#ffffff'); ?> Background<br />
					<?php sno_thickness_selectbox($settings, 'widget7-thickness', 10, $default='5px'); ?> Border Thickness<br />
					<?php sno_thickness_selectbox($settings, 'widget7-thickness2', 10, $default='1px'); ?> Border Thickness<br />
					<?php sno_select_toggle($settings, 'widget7-padding', 'On,Off', $default='On'); ?> Widget Body Padding<br />
					<?php sno_select_toggle($settings, 'widget7-gradient', 'On|Gradient,Off|Pattern,None|None', $default='On'); ?> Title Bar Background<br />
					<?php sno_pattern_selectbox($settings, 'widget7-pattern', $default='None'); ?> Title Bar Pattern (if active)<br />
					<?php sno_select_toggle($settings, 'widget7-indent', 'On,Off', $default='On'); ?> Title Bar Indent<br />
					<?php sno_checkbox($settings, 'widget7-center', $label='Center title', $default='On'); ?><br />
				</p>

			<?php if (get_theme_mod('widget-style') == "Style 2") { ?>
				<div style="border: 1px solid #4b6bdf; background: #a7b5e9;padding:10px 10px 0px;margin-bottom:10px;">
					<p>Style 2 is the default style for non-SNO widgets.</p>
				</div>
			<?php } ?>
			<?php if (get_theme_mod('widget-style-sno') == "Style 2") { ?>
				<div style="border: 1px solid #7327c6; background: #c999fd;padding:10px 10px 0px;margin-bottom:10px;">
					<p>Style 2 is the default style for SNO widgets.</p>
				</div>
			<?php } ?>
</div>
<div class="optionsboxwidgets">
<p class="headingtext">Widget Style 3</p>

<div style="width:140px;float:right;">
<div style="
	padding:2px; 
	font-size:10px;
	text-transform:uppercase;
	text-align:center;
	line-height:11px;
	color:<?php echo get_theme_mod('widgetcolor3-text'); ?>;
	background: <?php echo get_theme_mod('widgetcolor3'); ?> <?php if (get_theme_mod('widget3-gradient') == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if (get_theme_mod('widget3-gradient') == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo get_theme_mod('widget3-pattern'); ?>) repeat <?php } ?> !important;
">Widget Title</div>
<div style="
	padding:10px;
	background:<?php echo get_theme_mod('widgetbackground3'); ?>;
	border-left: <?php echo get_theme_mod('widget3-thickness'); ?> solid <?php echo get_theme_mod('widgetborder3'); ?>;
	border-right: <?php echo get_theme_mod('widget3-thickness'); ?> solid <?php echo get_theme_mod('widgetborder3'); ?>
">Click "Save All Settings" to Update Appearance</div>
<div style="
	display:block;
	height:15px;
	background: <?php echo get_theme_mod('widgetcolor3'); ?> <?php if (get_theme_mod('widget3-gradient') == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x<?php } ?> !important;
"></div>

</div>

				<p>
					<?php sno_color_input($settings, 'widgetcolor3', $default='#990000'); ?> Title Bar<br />
					<?php sno_color_input($settings, 'widgetcolor3-text', $default='#ffffff'); ?> Title Bar Text <br />
					<?php sno_select_toggle($settings, 'widget3-text-size', 'Small,Medium,Large', $default='On'); ?> Title Bar Size<br />
					<?php sno_color_input($settings, 'widgetborder3', $default='#cccccc'); ?> Border<br />
					<?php sno_color_input($settings, 'widgetbackground3', $default='#eeeeee'); ?> Background<br />
					<?php sno_thickness_selectbox($settings, 'widget3-thickness', 10, $default='0px'); ?> Border Thickness<br />
					<?php sno_select_toggle($settings, 'widget3-gradient', 'On|Gradient,Off|Pattern,None|None', $default='On'); ?> Title Bar Background<br />
					<?php sno_pattern_selectbox($settings, 'widget3-pattern', $default='None'); ?> Title Bar Pattern (if active)<br />
				
				</p>

			<?php if (get_theme_mod('widget-style') == "Style 3") { ?>
				<div style="border: 1px solid #4b6bdf; background: #a7b5e9;padding:10px 10px 0px;margin-bottom:10px;">
					<p>Style 3 is the default style for non-SNO widgets.</p>
				</div>
			<?php } ?>
			<?php if (get_theme_mod('widget-style-sno') == "Style 3") { ?>
				<div style="border: 1px solid #7327c6; background: #c999fd;padding:10px 10px 0px;margin-bottom:10px;">
					<p>Style 3 is the default style for SNO widgets.</p>
				</div>
			<?php } ?>

</div>
<div class="optionsboxwidgets">

<p class="headingtext">Widget Style 4</p>


<div style="width:140px;float:right;margin-bottom:10px;">
<div style="
	border-top: <?php echo get_theme_mod('widget4-thickness'); ?> solid <?php echo get_theme_mod('widgetborder4'); ?>; 
	border-left: <?php echo get_theme_mod('widget4-thickness'); ?> solid <?php echo get_theme_mod('widgetborder4'); ?>;
	border-right: <?php echo get_theme_mod('widget4-thickness'); ?> solid <?php echo get_theme_mod('widgetborder4'); ?>;
	padding:10px;
	background: <?php echo get_theme_mod('widgetbackground4'); ?> !important;
">
<div style="
	padding:2px;
	font-size:11px;
	line-height:13px;
	color:<?php echo get_theme_mod('widgetcolor4-text'); ?>;
	background: <?php echo get_theme_mod('widgetcolor4'); ?> <?php if (get_theme_mod('widget4-gradient') == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if (get_theme_mod('widget4-gradient') == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo get_theme_mod('widget4-pattern'); ?>) repeat <?php } ?> !important;
">Widget Title</div>
</div>

<div style="
	margin-bottom:10px;
	padding:0px 10px 10px;
	background:<?php echo get_theme_mod('widgetbackground4'); ?>;
	border-left: <?php echo get_theme_mod('widget4-thickness'); ?> solid <?php echo get_theme_mod('widgetborder4'); ?>;
	border-right: <?php echo get_theme_mod('widget4-thickness'); ?> solid <?php echo get_theme_mod('widgetborder4'); ?>; 
	border-bottom: <?php echo get_theme_mod('widget4-thickness'); ?> solid <?php echo get_theme_mod('widgetborder4'); ?>
">Click "Save All Settings" to Update Appearance</div>
</div>


				<p>
					<?php sno_color_input($settings, 'widgetcolor4', $default='#990000'); ?> Title Bar<br />
					<?php sno_color_input($settings, 'widgetcolor4-text', $default='#ffffff'); ?> Title Bar Text <br />
					<?php sno_select_toggle($settings, 'widget4-text-size', 'Small,Medium,Large', $default='Small'); ?> Title Bar Size<br />
					<?php sno_color_input($settings, 'widgetborder4', $default='#cccccc'); ?> Border<br />
					<?php sno_color_input($settings, 'widgetbackground4', $default='#ffffff'); ?> Background<br />
					<?php sno_thickness_selectbox($settings, 'widget4-thickness', 10, $default='1px'); ?> Border Thickness<br />
					<?php sno_select_toggle($settings, 'widget4-gradient', 'On|Gradient,Off|Pattern,None|None', $default='On'); ?> Title Bar Background<br />
					<?php sno_pattern_selectbox($settings, 'widget4-pattern', $default='None'); ?> Title Bar Pattern (if active)<br />
					<?php sno_checkbox($settings, 'widget4-center', $label='Center title', $default='On'); ?><br />

</p>

			<?php if (get_theme_mod('widget-style') == "Style 4") { ?>
				<div style="border: 1px solid #4b6bdf; background: #a7b5e9;padding:10px 10px 0px;margin-bottom:10px;">
					<p>Style 4 is the default style for non-SNO widgets.</p>
				</div>
			<?php } ?>
			<?php if (get_theme_mod('widget-style-sno') == "Style 4") { ?>
				<div style="border: 1px solid #7327c6; background: #c999fd;padding:10px 10px 0px;margin-bottom:10px;">
					<p>Style 4 is the default style for SNO widgets.</p>
				</div>
			<?php } ?>

</div>
<div class="optionsboxwidgets">

<p class="headingtext">Widget Style 5</p>

<div style="width:140px;float:right;">
<div style="
	padding:6px;color:<?php echo get_theme_mod('widgetcolor6-text'); ?>;
	background: <?php echo get_theme_mod('widgetcolor6'); ?> <?php if (get_theme_mod('widget6-gradient') == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if (get_theme_mod('widget6-gradient') == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo get_theme_mod('widget6-pattern'); ?>) repeat <?php } ?> !important;
	border:<?php echo get_theme_mod('widget6-thickness'); ?> solid <?php echo get_theme_mod('widgetborder6'); ?>;
">Widget Title</div>
<div style="
	padding:10px;
	background:<?php echo get_theme_mod('widgetbackground6'); ?>;
	border-left: <?php echo get_theme_mod('widget6-thickness'); ?> solid <?php echo get_theme_mod('widgetborder6'); ?>;
	border-right: <?php echo get_theme_mod('widget6-thickness'); ?> solid <?php echo get_theme_mod('widgetborder6'); ?>;
	border-bottom: <?php echo get_theme_mod('widget6-thickness'); ?> solid <?php echo get_theme_mod('widgetborder6'); ?>;
">Click "Save All Settings" to Update Appearance</div>

</div>

				<p>
					<?php sno_color_input($settings, 'widgetcolor6', $default='#990000'); ?> Title Bar<br />
					<?php sno_color_input($settings, 'widgetcolor6-text', $default='#ffffff'); ?> Title Bar Text <br />
					<?php sno_select_toggle($settings, 'widget6-text-size', 'Small,Medium,Large', $default='On'); ?> Title Bar Size<br />
					<?php sno_color_input($settings, 'widgetborder6', $default='#aaaaaa'); ?> Border<br />
					<?php sno_color_input($settings, 'widgetbackground6', $default='#eeeeee'); ?> Background<br />
					<?php sno_thickness_selectbox($settings, 'widget6-thickness', 10, $default='1px'); ?> Border Thickness<br />
					<?php sno_select_toggle($settings, 'widget6-gradient', 'On|Gradient,Off|Pattern,None|None', $default='On'); ?> Title Bar Background<br />
					<?php sno_pattern_selectbox($settings, 'widget6-pattern', $default='None'); ?> Title Bar Pattern (if active)<br />
					<?php sno_checkbox($settings, 'widget6-center', $label='Center title', $default='On'); ?><br />
				</p>

			<?php if (get_theme_mod('widget-style') == "Style 5") { ?>
				<div style="border: 1px solid #4b6bdf; background: #a7b5e9;padding:10px 10px 0px;margin-bottom:10px;">
					<p>Style 5 is the default style for non-SNO widgets.</p>
				</div>
			<?php } ?>
			<?php if (get_theme_mod('widget-style-sno') == "Style 5") { ?>
				<div style="border: 1px solid #7327c6; background: #c999fd;padding:10px 10px 0px;margin-bottom:10px;">
					<p>Style 5 is the default style for SNO widgets.</p>
				</div>
			<?php } ?>


</div>
<div class="optionsboxwidgets">

<p class="headingtext">Widget Style 6</p>

<div style="width:140px;float:right;">

<div style="
		border-top:<?php echo get_theme_mod('widget8-thickness'); ?> solid <?php echo get_theme_mod('widgetborder8'); ?>;
		background:<?php echo get_theme_mod('widgetbackground8'); ?>;
	<?php if (get_theme_mod('widget8-indent') != "On") { ?>
		background:<?php echo get_theme_mod('widgetborder8'); ?>;
		border-top: 0px;
	<?php } ?>
	
">

<div style="
		padding:0px 8px; 
		margin: 0 0 0 <?php if (get_theme_mod('widget8-indent') == "On") { ?>10px;<?php } else { ?>0px; <?php } ?>;
		float:left;
		color:<?php echo get_theme_mod('widgetcolor8-text'); ?>;
		<?php if (get_theme_mod('widget8-indent') != "On") { ?>
		border-right: <?php echo get_theme_mod('widget8-thickness'); ?> solid <?php echo get_theme_mod('widgetbackground8'); ?>;
		<?php } ?>
		background: <?php echo get_theme_mod('widgetcolor8'); ?> <?php if (get_theme_mod('widget8-gradient') == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if (get_theme_mod('widget8-gradient') == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo get_theme_mod('widget8-pattern'); ?>) repeat <?php } ?> !important;
">Widget Title
</div>
<div class="clear"></div>
</div>
<div style="<?php if (get_theme_mod('widget8-padding') == "Off") { ?>margin: 0px 10px 20px; padding:10px 0px 0px 0px; <?php } else { ?>padding:10px; <?php } ?>background:<?php echo get_theme_mod('widgetbackground8'); ?>;">Click "Save All Settings" to Update Appearance
</div>

</div>

				<p>
					<?php sno_color_input($settings, 'widgetcolor8', $default='#990000'); ?> Title Bar<br />
					<?php sno_color_input($settings, 'widgetcolor8-text', $default='#ffffff'); ?> Title Bar Text <br />
					<?php sno_select_toggle($settings, 'widget8-text-size', 'Small,Medium,Large', $default='On'); ?> Title Bar Size<br />
					<?php sno_color_input($settings, 'widgetborder8', $default='#aaaaaa'); ?> Header Border<br />
					<?php sno_color_input($settings, 'widgetbackground8', $default='#ffffff'); ?> Background<br />
					<?php sno_thickness_selectbox($settings, 'widget8-thickness', 10, $default='3px'); ?> Border Thickness<br />
					<?php sno_select_toggle($settings, 'widget8-gradient', 'On|Gradient,Off|Pattern,None|None', $default='None'); ?> Title Bar Background<br />
					<?php sno_pattern_selectbox($settings, 'widget8-pattern', $default='None'); ?> Title Bar Pattern (if active)<br />
					<?php sno_select_toggle($settings, 'widget8-indent', 'On,Off', $default='On'); ?> Title Bar Indent<br />
				</p>
				
				<p><i>If the Title Bar Indent is set to "Off", the border thickness applies to the right margin of the title, and the border color applies to the right side of the title bar.</i></p>

			<?php if (get_theme_mod('widget-style') == "Style 6") { ?>
				<div style="border: 1px solid #4b6bdf; background: #a7b5e9;padding:10px 10px 0px;margin-bottom:10px;">
					<p>Style 6 is the default style for non-SNO widgets.</p>
				</div>
			<?php } ?>
			<?php if (get_theme_mod('widget-style-sno') == "Style 6") { ?>
				<div style="border: 1px solid #7327c6; background: #c999fd;padding:10px 10px 0px;margin-bottom:10px;">
					<p>Style 6 is the default style for SNO widgets.</p>
				</div>
			<?php } ?>
</div>

<div style="clear:both"></div>

	</div>
</div>

<a class="menuitem submenuheader" id="section8a" href="#">Widget "View All" Links</a>
<div class="submenu" id="section8body">
	<div class="inside">
		<div class="optionsboxwide" style="margin-bottom:10px;">
			<p class="headingtext">View All Links</p>
				<p>These options control the appearance of "View All" links that can be displayed at the bottom of the SNO Category Display widget and the SNO Story Grid widget.</p>
		</div>
		<div class="clear"></div>
		<div class="optionsbox" style="background: #eee;">
			<p class="headingtext">SNO Category Display widget<br />SNO Video Category Display widget</p>
					<p>
					<?php $viewall_text = get_theme_mod('viewall-text'); if ($viewall_text == '') $viewall_text = "View All"; ?>
					<input type="text" name="<?php echo $settings; ?>[viewall-text]" value="<?php echo $viewall_text; ?>" size="20" /> Link Text<br />
					<span style="font-style: italic;">Use %category% to include the actual category name in the link text.</span></p>
					
					<br />
					<?php sno_color_input($settings, 'viewall-border-color', $default='#e5e5e5'); ?> Border Color<br />
					<?php sno_thickness_selectbox($settings, 'viewall-border-thickness', 3, $default='1px'); ?> Border Thickness<br />
					<?php sno_color_input($settings, 'viewall-background', $default='#fbfbfb'); ?> Background<br />
					<?php sno_color_input($settings, 'viewall-text-color', $default='#777777'); ?> Text<br />
					<?php sno_color_input($settings, 'viewall-background-hover', $default='#161616'); ?> Background Hover<br />
					<?php sno_color_input($settings, 'viewall-text-hover', $default='#ffffff'); ?> Text Hover<br />
					<?php sno_select_toggle($settings, 'viewall-letter-spacing', '0px,1px,2px,3px', $default='1px'); ?> Letter Spacing<br />
					<?php sno_select_toggle($settings, 'viewall-text-style', 'uppercase|UPPERCASE,capitalize|Capitalize,lowercase', $default='uppercase'); ?> Text Style<br />
					<?php sno_select_toggle($settings, 'viewall-font-size', '12px,13px,14px,15px,16px,17px,18px,19px,20px', $default='14px'); ?> Text Size<br />
					<?php sno_select_toggle($settings, 'viewall-block-style', 'Centered,Left,Right,Full-Width', $default='Centered'); ?> Alignment<br />

		</div>
		<div class="optionsboxright">
			<p class="headingtext">SNO Story Grid widget<br /><br /></p>
					<p>
					<?php $viewall_grid_text = get_theme_mod('viewall-grid-text'); if ($viewall_grid_text == '') $viewall_grid_text = "View All"; ?>
					<input type="text" name="<?php echo $settings; ?>[viewall-grid-text]" value="<?php echo $viewall_grid_text; ?>" size="20" /> Link Text<br />
					<span style="font-style: italic;">Use %category% to include the actual category name in the link text.</span></p>
					
					<br />
					<?php sno_color_input($settings, 'viewall-grid-border-color', $default='#e5e5e5'); ?> Border Color<br />
					<?php sno_thickness_selectbox($settings, 'viewall-grid-border-thickness', 3, $default='1px'); ?> Border Thickness<br />
					<?php sno_color_input($settings, 'viewall-grid-background', $default='#fbfbfb'); ?> Background<br />
					<?php sno_color_input($settings, 'viewall-grid-text-color', $default='#777777'); ?> Text<br />
					<?php sno_color_input($settings, 'viewall-grid-background-hover', $default='#161616'); ?> Background Hover<br />
					<?php sno_color_input($settings, 'viewall-grid-text-hover', $default='#ffffff'); ?> Text Hover<br />
					<?php sno_select_toggle($settings, 'viewall-grid-letter-spacing', '0px,1px,2px,3px', $default='1px'); ?> Letter Spacing<br />
					<?php sno_select_toggle($settings, 'viewall-grid-text-style', 'uppercase|UPPERCASE,capitalize|Capitalize,lowercase', $default='uppercase'); ?> Text Style<br />
					<?php sno_select_toggle($settings, 'viewall-grid-font-size', '12px,13px,14px,15px,16px,17px,18px,19px,20px', $default='14px'); ?> Text Size<br />
					<?php sno_select_toggle($settings, 'viewall-grid-block-style', 'Centered,Left,Right,Full-Width', $default='Centered'); ?> Alignment<br />

		</div>
	<div style="clear:both"></div>

	</div>
</div>


<span class="hts-options">
<a class="menuitem submenuheader" id="section6" href="#">Teaser Bar A</a>
<div class="submenu" id="section6body">
	<div class="inside">

			<div style="<?php if (get_theme_mod('hts') != "Display") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
			<p class="headingtext">Teaser Bar A is <?php if (get_theme_mod('hts') != "Display") { echo 'Inactive.'; } else { echo 'Active';} ?></p>
			</div>
			
			<div class="optionsbox">
				<p class="subheadingtext">About Teaser Bar A</p>
				<p>This horizontal carousel spans the full width of the homepage and is located below the Home Top set of widgets and above the Home Bottom set of widgets.</p>

				<div style="<?php if (get_theme_mod('hts') != "Display") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
					<p>
						<?php sno_checkbox($settings, 'hts', $label='Display Teaser Bar A', $default='Display'); ?>
					</p>
				</div>
				
				<div class="subdivider"></div>
				<div class="hts-options">
			
					<p class="subheadingtext">Category to be Displayed</p>
    				<?php wp_dropdown_categories(array('selected' => get_theme_mod('hts-cat'), 'name' => $settings.'[hts-cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?>
    		
					<div class="subdivider"></div>
    			
					<p class="subheadingtext">Number of Stories to Load</p>
					<?php sno_select_toggle($settings, 'hts-count', '5,10,15,20', $default='10'); ?>
				</div>
			</div>
			<div class="hts-options optionsboxright">
				<p class="subheadingtext">Style and Design</p>
					<p>
						<?php sno_checkbox($settings, 'hts-blocks', $label='Display as Photo Blocks', $default='Blocks'); ?>
					</p>

					<div class="hts-blocks-options">
						<p>
							<?php sno_checkbox($settings, 'hts-blocks-extend', $label='Extend ', $default='Extend'); ?>
							<?php sno_select_toggle($settings, 'hts-blocks-extend-width', '15|30px,106|1 Photo,222|2 Photos,Full Browser', $default='15'); ?>
						</p>
					</div>
				<div class="hts-widget-options">
				<p>This header and background of this carousel are generated with the styles defined on the <span style="font-weight:bold">Widget Styles</span> section on this page.</p>
				<p>
				<?php sno_select_toggle($settings, 'hts-style', 'Style 1,Style 2,Style 4,Style 5', $default='Style 2'); ?> Widget Style
				</p>
				
				<p>
					<?php sno_checkbox($settings, 'hts-custom', $label='Activate Custom Styles', $default='snoccon'); ?>
				</p><?php
					echo "<div id='hts-custom'>";
						
						echo '<p>';
							sno_color_input($settings, 'hts-titlebar', $default='#ffffff');
							echo ' Title Bar Color<br />';
							sno_color_input($settings, 'hts-title', $default='#444444');
							echo ' Title Bar Text Color<br />';
							sno_color_input($settings, 'hts-background', $default='#ffffff');
							echo ' Body Background<br />';							
							sno_color_input($settings, 'hts-border', $default='#444444');
							echo ' Border Color';
							echo '</p>';
							
						echo '<p>';
							sno_thickness_selectbox($settings, 'hts-border-thickness', 10, $default='4px');
							echo ' Border Thickness';
							echo '</p>';
							
						echo "<div class='hts-border-2'>";
							echo '<p>';
							sno_thickness_selectbox($settings, 'hts-border-thickness2', 10, $default='2px');
							echo ' Secondary Border Thickness';
							echo '</p>';
							echo '</div>';
							
						echo '<p>';
							sno_select_toggle($settings, 'hts-overlay', 'On|Gradient,Off|Pattern,None|None', $default='None');
							echo ' Title Bar Background';
							echo '</p>';
						
						echo "<div class='hts-back-pattern'>";
							echo '<p>';
							sno_pattern_selectbox($settings, 'hts-pattern');
							echo ' Title Bar Pattern';
							echo '</p>';
							echo '</div>';
							
					?> </div>
					</div>
				<script type="text/javascript">
					jQuery('#hts-custom-ck').change(function() {
   				 		jQuery('#hts-custom').slideToggle('slow');
					});
			   		jQuery(document).ready(function() {
						if (jQuery('#hts-custom-ck').prop('checked')) {
							jQuery("#hts-custom").slideDown('slow');
						} else {
							jQuery("#hts-custom").slideUp('slow');
						}
					});

					jQuery('#hts-blocks-ck').change(function() {
   				 		jQuery('.hts-blocks-options').slideToggle('slow');
					});
			   		jQuery(document).ready(function() {
						if (jQuery('#hts-blocks-ck').prop('checked')) {
							jQuery(".hts-blocks-options").slideDown('slow');
						} else {
							jQuery(".hts-blocks-options").slideUp('slow');
						}
					});

					
		    		jQuery(".hts-overlay").change(function() {
        				(jQuery(this).val() == "Off") ? jQuery(".hts-back-pattern").slideDown('slow') : jQuery(".hts-back-pattern").slideUp('slow');
    				});
   					jQuery(document).ready(function() {
        				(jQuery(".hts-overlay").val() == "Off") ? jQuery(".hts-back-pattern").slideDown('slow') : jQuery(".hts-back-pattern").slideUp('slow');
    				});
		    		
		    		jQuery(".hts-style").change(function() {
        				(jQuery(this).val() == "Style 2") ? jQuery(".hts-border-2").slideDown('slow') : jQuery(".hts-border-2").slideUp('slow');
    				});
   					jQuery(document).ready(function() {
        				(jQuery(".hts-style").val() == "Style 2") ? jQuery(".hts-border-2").slideDown('slow') : jQuery(".hts-border-2").slideUp('slow');
    				});
					
					jQuery('#hts-ck').change(function() {
   				 		jQuery('.hts-options').slideToggle('slow');
					});
				   	jQuery(document).ready(function() {
						if (jQuery('#hts-ck').prop('checked')) {
							jQuery(".hts-options").slideDown('slow');
						} else {
							jQuery(".hts-options").slideUp('slow');
						}
					});
				</script>
			</div>

	<div style="clear:both"></div>

	</div>
</div>
</span>

<span class="hbs-options">
<a class="menuitem submenuheader" id="section7" href="#">Teaser Bar B</a>
<div class="submenu" id="section7body">
	<div class="inside">

			<div style="<?php if (get_theme_mod('hbs') != "Display") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
				<p class="headingtext">Teaser Bar B is <?php if (get_theme_mod('hbs') != "Display") { echo 'Inactive.'; } else { echo 'Active';} ?></p>
			</div>
	
			<div class="optionsbox">
				<p>This horizontal carousel spans the full width of the homepage and is located below the Home Bottom widget areas.</p>
				<div style="<?php if (get_theme_mod('hbs') != "Display") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">					<p>
						<?php sno_checkbox($settings, 'hbs', $label='Display Teaser Bar B', $default='Display'); ?>
					</p>
				</div>
				
				<div class="subdivider"></div>
				<div class="hbs-options">

					<p class="subheadingtext">Category to be Displayed</p>
    				<?php wp_dropdown_categories(array('selected' => get_theme_mod('hbs-cat'), 'name' => $settings.'[hbs-cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?></p>
    			
					<div class="subdivider"></div>
    			
					<p class="subheadingtext">Number of Stories to Load</p>
					<?php sno_select_toggle($settings, 'hbs-count', '5,10,15,20', $default='10'); ?> Number of Stories
				</div>
			</div>
			<div class="hbs-options optionsboxright">
				<p class="subheadingtext">Style and Design</p>

					<p>
						<?php sno_checkbox($settings, 'hbs-blocks', $label='Display as Photo Blocks', $default='Blocks'); ?>
					</p>

					<div class="hbs-blocks-options">
						<p>
							<?php sno_checkbox($settings, 'hbs-blocks-extend', $label='Extend ', $default='Extend'); ?>
							<?php sno_select_toggle($settings, 'hbs-blocks-extend-width', '15|30px,106|1 Photo,222|2 Photos,Full Browser', $default='15'); ?>
						</p>
					</div>

				<p>This header and background of this carousel are generated with the styles defined on the <span style="font-weight:bold">Widget Styles</span> section on this page.</p>
				<p>
				<?php sno_select_toggle($settings, 'hbs-style', 'Style 1,Style 2,Style 4,Style 5', $default='Style 2'); ?> Widget Style
				</p>
				
				<p>
					<?php sno_checkbox($settings, 'hbs-custom', $label='Activate Custom Styles', $default='snoccon'); ?>
				</p><?php
					echo "<div id='hbs-custom'>";
						
						echo '<p>';
							sno_color_input($settings, 'hbs-titlebar', $default='#ffffff');
							echo ' Title Bar Color<br />';
							sno_color_input($settings, 'hbs-title', $default='#444444');
							echo ' Title Bar Text Color<br />';
							sno_color_input($settings, 'hbs-background', $default='#ffffff');
							echo ' Body Background<br />';							
							sno_color_input($settings, 'hbs-border', $default='#444444');
							echo ' Border Color';
							echo '</p>';
							
						echo '<p>';
							sno_thickness_selectbox($settings, 'hbs-border-thickness', 10, $default='4px');
							echo ' Border Thickness';
							echo '</p>';
							
						echo "<div class='hbs-border-2'>";
							echo '<p>';
							sno_thickness_selectbox($settings, 'hbs-border-thickness2', 10, $default='2px');
							echo ' Secondary Border Thickness';
							echo '</p>';
							echo '</div>';
							
						echo '<p>';
							sno_select_toggle($settings, 'hbs-overlay', 'On|Gradient,Off|Pattern,None|None', $default='None');
							echo ' Title Bar Background';
							echo '</p>';
						
						echo "<div class='hbs-back-pattern'";
							echo '<p>';
							sno_pattern_selectbox($settings, 'hbs-pattern');
							echo ' Title Bar Pattern';
							echo '</p>';
							echo '</div>';
							
					?> </div>
				<script type="text/javascript">
					jQuery('#hbs-custom-ck').change(function() {
   				 		jQuery('#hbs-custom').slideToggle('slow');
					});
				   	jQuery(document).ready(function() {
						if (jQuery('#hbs-custom-ck').prop('checked')) {
							jQuery("#hbs-custom").slideDown('slow');
						} else {
							jQuery("#hbs-custom").slideUp('slow');
						}
					});
					jQuery('#hbs-blocks-ck').change(function() {
   				 		jQuery('.hbs-blocks-options').slideToggle('slow');
					});
			   		jQuery(document).ready(function() {
						if (jQuery('#hbs-blocks-ck').prop('checked')) {
							jQuery(".hbs-blocks-options").slideDown('slow');
						} else {
							jQuery(".hbs-blocks-options").slideUp('slow');
						}
					});
					
		    		jQuery(".hbs-overlay").change(function() {
        				(jQuery(this).val() == "Off") ? jQuery(".hbs-back-pattern").slideDown('slow') : jQuery(".hbs-back-pattern").slideUp('slow');
    				});
   					jQuery(document).ready(function() {
        				(jQuery(".hbs-overlay").val() == "Off") ? jQuery(".hbs-back-pattern").slideDown('slow') : jQuery(".hbs-back-pattern").slideUp('slow');
    				});
    				
		    		jQuery(".hbs-style").change(function() {
        				(jQuery(this).val() == "Style 2") ? jQuery(".hbs-border-2").slideDown('slow') : jQuery(".hbs-border-2").slideUp('slow');
    				});
   					jQuery(document).ready(function() {
        				(jQuery(".hbs-style").val() == "Style 2") ? jQuery(".hbs-border-2").slideDown('slow') : jQuery(".hbs-border-2").slideUp('slow');
    				});
    				
					jQuery('#hbs-ck').change(function() {
   				 		jQuery('.hbs-options').slideToggle('slow');
					});
				   	jQuery(document).ready(function() {
						if (jQuery('#hbs-ck').prop('checked')) {
							jQuery(".hbs-options").slideDown('slow');
						} else {
							jQuery(".hbs-options").slideUp('slow');
						}
					});
				</script>
			</div>


	<div style="clear:both"></div>

	</div>
</div>
</span>

<a class="menuitem submenuheader" id="section7.2" href="#">SNO Ad Marketplace Advertisement</a>
<div class="submenu" id="section7body">
	<div class="inside">

		<?php $options = get_option('sno_analytics_options'); ?>
		<?php if (isset($options['sno_adbutler_analytics_activate']) && $options['sno_adbutler_analytics_activate']=='on') { ?>
		
			<p>The SNO Ad Marketplace allows people to buy ads on your site -- these ads will be served automatically, and your share of the ad revenue will be automatically credited to your account with SNO.  </p>
			<p>Use the options below to control the position of the SNO Ad Marketplace advertisement.</p>
			
			<p class="headingtext">Ad Positions</p>

				<p>
					<?php sno_select_toggle($settings, 'sno_ad_network_position', 'Top|Top of Column,Bottom|Bottom of Column', $default='Top'); ?> Home Page Widget Ad<br />

					<?php sno_select_toggle($settings, 'sno_ad_network_nonhome', 'Top|Top of Column,Bottom|Bottom of Column', $default='Top'); ?> Non-Home Widget Ad<br />

					<?php sno_select_toggle($settings, 'sno_ad_network_full', 'On,Off', $default='On'); ?> Full-Width Story Page Template<br />

					<?php sno_select_toggle($settings, 'sno_ad_network_rails', 'On,Off', $default='On'); ?> Side Rails Story Page Template<br />

				</p>
					
			<p>If you would like to remove your site from the Ad Marketplace, please submit a <a target="_blank" href="https://sno.zendesk.com/hc/en-us/requests/new">support ticket</a>. 
			
		<?php } else { ?>
		
			<p>The SNO Ad Marketplace allows people to buy ads on your site -- these ads will be served automatically, and your share of the ad revenue will be automatically credited to your account with SNO.</p>
						
			<p>If you would like to have your site listed in the SNO Ad Marketplace, please fill out <a href="https://snosites.com/join-the-sno-ad-network/" target="_blank">this form</a>.</p>
		
		
		<?php } ?>

	<div style="clear:both"></div>

	</div>
</div>

</div><!-- end of second section-->

<!--start of third section-->
<div class="mainbar" style="margin-top:35px"><a class="menuheader submenuheader" id="section1" href="#">Header and Footer</a></div>
<div class="submenu" style="padding:0px 0px 0px 35px;background: #f1f1f1;">


<a class="menuitem submenuheader" id="section13" href="#">Custom Header Graphics</a>
<div class="submenu" id="section13body">
	<div class="inside">
			<?php $header_title = get_theme_mod('header_blog_title'); ?>
					
				<div style="<?php if ($header_title == "Text") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
					<p class="headingtext"><?php if (get_theme_mod('header_blog_title') == "Text") { 
							echo 'Image Header is NOT ACTIVE.  <br /><i>Select "Image Header" below and click "Save All Settings" to activate.</i>'; 
						} else {
								echo 'Image Header is ACTIVE.';
						} ?></p>
				</div>

		<div class="optionsboxwrap">
			<div class="optionsbox" style="background: #eee;margin-bottom:10px">
				<p class="headingtext">Type of Header</p>
				<p>
					<?php sno_select_toggle($settings, 'header_blog_title', 'Image|Image Header,Text|Text Header', $default='Text'); ?>
				</p>
				<p>
					<?php sno_checkbox($settings, 'header-off', $label='Hide Entire Header Area', $default='Off'); ?>
				</p>
				<div class="header-image">
					<div class="subdivider"></div>
					<p class="subheadingtext">About the Image Uploader</p>	
					<p>After using the options to the right to upload an image, make sure "Full Size" is checked and click "Insert into Post".</p>
				</div>
			</div>
		
			<div class="optionsbox" style="background: #eee;margin-bottom:10px">
				
				<p class="headingtext">Background Options</p>
				<p>				
					<?php sno_color_input($settings, 'accentcolor-header', $default='#990000'); ?> Background Color<br />
				</p>
				<p>
					<?php sno_color_input($settings, 'accentcolor-header-text', $default='#ffffff'); ?> Text Color<br />
				</p>
				<p>	
					<?php sno_select_toggle($settings, 'headergradient', 'Gradient,Pattern,None', $default='Gradient'); ?> Background Overlay
				</p>

				<?php $header_pattern = get_theme_mod('headergradient'); ?>
				<div class="header-pattern-options">
					<p>
						<?php sno_pattern_selectbox($settings, 'header-pattern', $default='stripes1.png'); ?> Pattern<br />
					</p>
				</div>
				<script type="text/javascript">
    				jQuery(".headergradient").change(function() {
        				(jQuery(this).val() == "Pattern") ? jQuery(".header-pattern-options").slideDown('slow') : jQuery(".header-pattern-options").slideUp('slow');
    				});
   				jQuery(document).ready(function() {
        			(jQuery(".headergradient").val() == "Pattern") ? jQuery(".header-pattern-options").slideDown('slow') : jQuery(".header-pattern-options").slideUp('slow');
    			});
    			</script>
				
			</div>
			
			<div class="optionsbox" style="background: #eee;margin-bottom:10px">
				<p class="headingtext">iPhone/iPad Shortcut Icon</p>
				<p>Build an image that is 128px by 128px.</p>
				<p>
					<input class="upload_image_button9 button-primary" type="button" value="Click to Upload Image" style="margin-bottom:5px;width:250px"/>
					<input class="upload_image9" type="text" name="<?php echo $settings; ?>[touch-icon]" value="<?php echo get_theme_mod('touch-icon'); ?>" style="width:250px;" /> 
				</p>
				<p>Current Shortcut Icon</p>
				<?php if (get_theme_mod('touch-icon') !="") { ?><img src="<?php if (is_ssl()) { echo str_replace("http://", "https://", get_theme_mod('touch-icon')); } else { echo get_theme_mod('touch-icon'); } ?>" style="width:100px;"/><?php } ?><br /><br />

				<p class="headingtext">iPhone/iPad App ID</p>
				<p>If you have an app for your site in the Apple Store and would like to prompt users to download it when using a mobile platform, enter your App ID here:<br />
					<input type="text" name="<?php echo $settings; ?>[apple-app-id]" value="<?php echo get_theme_mod('apple-app-id'); ?>" size="15" /></p>
			</div>
		</div>
		
		<div style="width:290px;float:right;">
			<div class="optionsboxright header-text" style="margin-bottom:10px">
				<p class="subheadingtext">Text Header Options</p>
				<p>The Text Header will display the name of your site and your site tagline.  These can be edited on the <a href="/wp-admin/options-general.php">General Settings</a> page.</p>

				<p>
					<?php sno_checkbox($settings, 'header-shadow', $label='Display Text Drop Shadow', $default='Show'); ?>
				</p>

				<p>
					<?php sno_select_toggle($settings, 'header-align', 'left|Left,center|Center,right|Right', $default='left'); ?> Title alignment</p>
				</p>
				<p>
					<?php sno_select_toggle($settings, 'tagline-align', 'left|Left,center|Center,right|Right', $default='left'); ?> Tagline alignment</p>
				</p>
			
			</div>
		
			<div class="optionsboxright header-image" style="margin-bottom:10px">
				
				<p class="subheadingtext">Standard Header Image</p>
				<p>Build an image that is 1400px wide by 150px tall.</p>
				<p>
					<input class="upload_image_button2 button-primary" type="button" value="Click to Upload Image" style="margin-bottom:5px;width:250px"/>
					<input class="upload_image2" type="text" name="<?php echo $settings; ?>[header-image]" value="<?php echo get_theme_mod('header-image'); ?>" style="width:250px;" /> 
				</p>
				<p class="altheader-deactivate">
					<?php sno_select_toggle($settings, 'header-center', 'Yes,No', $default='Yes'); ?> Center Header Graphic</p>
				</p>
				<p>Current Header:</p>
				<?php if (get_theme_mod('header-image')) { ?><img src="<?php if (is_ssl()) { echo str_replace("http://", "https://", get_theme_mod('header-image')); } else { echo get_theme_mod('header-image'); } ?>" style="width:250px;"/><?php } ?>

			</div>
			<div class="optionsboxright header-image" style="margin-bottom:10px">

				<p class="subheadingtext">Header Image for Tablet Portrait</p>
				<p>Build an image that is 780px wide.</p>

				<p>
					<input class="upload_image_button7 button-primary" type="button" value="Click to Upload Image" style="margin-bottom:5px;width:250px;"/>
					<input class="upload_image7" type="text" name="<?php echo $settings; ?>[header-image-medium]" value="<?php echo get_theme_mod('header-image-medium'); ?>" style="width:250px;" /> 
				</p>
				<p>Current Tablet Portrait Header:</p>
				<?php if (get_theme_mod('header-image-medium')) { ?><img src="<?php if (is_ssl()) { echo str_replace("http://", "https://", get_theme_mod('header-image-medium')); } else { echo get_theme_mod('header-image-medium'); } ?>" style="width:250px;"/><?php } ?>

			</div>
			<div class="optionsboxright header-image" style="margin-bottom:10px">

				<p class="subheadingtext">Header Image for Alternate Header Mode and Phone/Handheld</p>
				
				<?php 
							$height = 80;
						if (get_theme_mod('altheader-right') == 3) {
							$height = 90;
							$padding = rtrim(get_theme_mod('altheader-leaderboard-margin'), 'px')*2; 
							$height += $padding; 
						} 
						
						if ((get_theme_mod('altheader-right') == 1 || get_theme_mod('altheader-right-bottom') == 3) && get_theme_mod('altheader-top') != 'Search & Social Icons') {
							$padding = rtrim(get_theme_mod('altheader-icons-border-thickness'), 'px')*2; 
							$height += $padding;
							
						} 
						
						if (get_theme_mod('altheader-left') == 'Display') {
							$width = 250;
						} else {
							$width = 325;
						}
						
						$scalevertical = floor((480 * $height)/$width);
						?>
						
				
				
				<p>Build an image that is <b>480px wide</b> by <b><?php echo $scalevertical; ?>px tall</b>.</p>
				<p>
					<input class="upload_image_button8 button-primary" type="button" value="Click to Upload Image" style="margin-bottom:5px;width:250px;"/>
					<input class="upload_image8" type="text" name="<?php echo $settings; ?>[header-image-small]" value="<?php echo get_theme_mod('header-image-small'); ?>" style="width:250px;" /> 
				</p>
				<p>Current Phone/Handheld Header:</p>
				<?php if (get_theme_mod('header-image-small')) { ?><img src="<?php if (is_ssl()) { echo str_replace("http://", "https://", get_theme_mod('header-image-small')); } else { echo get_theme_mod('header-image-small'); } ?>" style="width:250px;"/><?php } ?>

			</div>
			<div class="optionsboxright" style="margin-bottom:10px">

				<p class="subheadingtext">Mini Logo for Navigation Bars</p>
				<p>The mini logo should have a max width of 150px wide and a max height of 50px.</p>
				<p>After uploading a mini logo, there are two steps to make it active:</p>
				<ol>
				<li>Scroll down to the Navigation Menus on this page and activate Scroll-to-Fix and the mini logo for one of your menus.</li>
				<li>Go to the <a href="/wp-admin/nav-menus.php">Menus interface</a> and add the class "mini-logo" (no quotes) to the Home menu item.</li>
				</ol>
				<p>
					<input class="upload_image_button12 button-primary" type="button" value="Click to Upload Image" style="margin-bottom:5px;width:250px;"/>
					<input class="upload_image12" type="text" name="<?php echo $settings; ?>[mini-logo]" value="<?php echo get_theme_mod('mini-logo'); ?>" style="width:250px;" /> 
				</p>
				<p>Current Mini Logo:</p>
				<?php if (get_theme_mod('mini-logo')) { ?><img src="<?php if (is_ssl()) { echo str_replace("http://", "https://", get_theme_mod('mini-logo')); } else { echo get_theme_mod('mini-logo'); } ?>" style="max-width:150px;"/><?php } ?>

			</div>

		</div>
		<script type="text/javascript">
    		jQuery(".header_blog_title").change(function() {
        		(jQuery(this).val() == "Text") ? jQuery(".header-text").slideDown('slow') : jQuery(".header-text").slideUp('slow');
        		(jQuery(this).val() == "Image") ? jQuery(".header-image").slideDown('slow') : jQuery(".header-image").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".header_blog_title").val() == "Text") ? jQuery(".header-text").slideDown('slow') : jQuery(".header-text").slideUp('slow');
        		(jQuery(".header_blog_title").val() == "Image") ? jQuery(".header-image").slideDown('slow') : jQuery(".header-image").slideUp('slow');
    		});
    	</script>

		
		
	<div style="clear:both"></div>
	</div>
</div>

<a class="menuitem submenuheader" id="section9" href="#">Full-Width Browser Options</a>
<div class="submenu" id="section9body">
	<div class="inside">

			<div style="<?php if (get_theme_mod('header-alt') != "Display") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
			<p class="headingtext">Alternate Header Mode is <?php if (get_theme_mod('header-alt') != "Display") { echo 'Inactive.'; } else { echo 'Active';} ?></p>
			</div>
			
			<div class="optionsbox">
				<p class="subheadingtext">About Alternate Header Mode</p>
				<p><i>When activated, the alternate header mode provides a lower profile header.  The header image itself is smaller and placed to the left, and to the right of the header image you can add other features, such as menus, social media icons, and the breaking news ticker.  There's also an option for a hidden menu triggered by an icon on the left side of the header area.</i></p>

				<div style="<?php if (get_theme_mod('header-alt') != "Display") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
					<p>
						<?php sno_checkbox($settings, 'header-alt', $label='Activate Alternate Header Mode', $default='Display'); ?>
					</p>
				</div>
				<div class="altheader-activate">
					<div class="optionsboxdetail">
						<p class="subheadingtext">Header Options</p>
						<p>
							<?php sno_select_toggle($settings, 'altheader-height', 'Full,Half', $default='Full'); ?> Header Height		
						</p>
						<p>Make header area sticky:<br />
							<?php sno_select_toggle($settings, 'altheader-stick', 'Activate|Full Header,Half|Half Header,Deactivate|Deactivate', $default='Deactivate'); ?>			
						</p>
						<p>
							<?php sno_checkbox($settings, 'altheader-logo-force', $label='Force Header Graphic to Fit', $default='Yes'); ?>
						</p>
					</div>
				</div>
		<div class="optionsboxdetail" style="background: #eee;margin-bottom:10px;">
				<p class="headingtext">Site Width Options</p>
				<p>
					<?php sno_select_toggle($settings, 'content-width', '980,1100,1200,1300,1400', $default='980'); ?> 
				</p>
		</div>

		<div class="optionsboxdetail" style="background: #eee;margin-bottom:10px;">
			<div class="altheader-deactivate">
				<p class="headingtext">Outer Background Options</p>
				<p>
					<?php sno_select_toggle($settings, 'background-wrap', 'Defined Edges,Full Browser Width', $default='Defined Edges'); ?> 
				</p>


				<div class="background-info-disabled">
					<p>
						<?php sno_checkbox($settings, 'background-shadow', $label='Outer Drop Shadow', $default='On'); ?>
					</p>
					<p>
						<?php sno_checkbox($settings, 'outer-padding', $label='Remove Homepage Outer Padding', $default='Remove'); ?>
					</p>
					<p>
						<?php sno_color_input($settings, 'outerwrap', $default='#777777'); ?> Outer Background Color <br />
					</p>
					<p>				
						<?php sno_select_toggle($settings, 'background', 'Gradient,Pattern,Custom Image,None', $default='None'); ?> Outer Background
					</p>
			
					<div class="background-pattern">
						<p>
							<?php sno_pattern_selectbox($settings, 'outerwrap-pattern', $default='stripes1.png'); ?> Pattern<br />
						</p>
					</div>

					<div class="background-image">
				
						<p class="headingtext">Custom Background Image/Pattern</p>
						<p>Use the button below to upload your image. After upload is completed, click "Insert into Post".</p>

						<p>
							<input class="upload_image_button button-primary" type="button" value="Click to Upload Background Image" style="margin-bottom:5px;width:240px"/>
							<input class="upload_image" type="text" name="<?php echo $settings; ?>[background-pattern]" value="<?php echo get_theme_mod('background-pattern'); ?>" style="width:240px;" /> 
						</p>


						<p>
							<?php sno_checkbox($settings, 'background-tile', $label='Tile Background Image', $default='Yes'); ?>
						</p>

						<p class="subheadingtext">Background Image Position</p>
							<?php sno_select_toggle($settings, 'background-position', 'scroll|Scroll,fixed|Fixed,fixed center top|Fixed Center', $default='scroll'); ?>
					</div>

				</div>
			</div>
		<div class="extra-widget-area">
			<div class="subdivider"></div>
					<p class="subheadingtext">Extra Widget Area</p>
					<p>
						<?php sno_checkbox($settings, 'extra-column', $label='Activate Extra Widget Area', $default='Display'); ?>
					</p>
					<p class="extra-column-options">
						<?php sno_checkbox($settings, 'extra-column-stick', $label='Make Extra Widget Area Sticky', $default='Yes'); ?><br />
						<?php sno_checkbox($settings, 'extra-column-fullwidth', $label='Display on Full-Width Stories', $default='Yes'); ?><br />
						<?php sno_checkbox($settings, 'extra-column-siderails', $label='Display on Side Rails Stories', $default='Yes'); ?><br />
						<?php sno_checkbox($settings, 'extra-column-classic', $label='Display on Classic Stories', $default='Yes'); ?><br />
						<?php sno_checkbox($settings, 'extra-column-category', $label='Display on Category Pages', $default='Yes'); ?>
					</p>
					<p><i>When your site is viewed with a wide screen monitor (more than 1210px wide), the Extra Widget area displays on the left of your main content.  The content in this widget area does NOT display on screens smaller than 1210px wide or mobile devices.</i></p>


			<script type="text/javascript">
			jQuery('#extra-column-ck').change(function() {
   		 		jQuery('.extra-column-options').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#extra-column-ck').prop('checked')) {
					jQuery(".extra-column-options").slideDown('slow');
				} else {
					jQuery(".extra-column-options").slideUp('slow');
				}
			});
			</script>
			<div class="clear"></div>



		</div>
				<script type="text/javascript">
   					jQuery(document).ready(function() {
        				if (jQuery(".background-wrap").val() == "Defined Edges") {
        					jQuery(".background-info").slideDown('slow');
        				} else { 
        					jQuery(".background-info").slideUp('slow');
        				}
    				});
		    		jQuery(".background").change(function() {
        				(jQuery(this).val() == "Pattern") ? jQuery(".background-pattern").slideDown('slow') : jQuery(".background-pattern").slideUp('slow');
        				(jQuery(this).val() == "Custom Image") ? jQuery(".background-image").slideDown('slow') : jQuery(".background-image").slideUp('slow');
    				});
   					jQuery(document).ready(function() {
        				(jQuery(".background").val() == "Pattern") ? jQuery(".background-pattern").slideDown('slow') : jQuery(".background-pattern").slideUp('slow');
        				(jQuery(".background").val() == "Custom Image") ? jQuery(".background-image").slideDown('slow') : jQuery(".background-image").slideUp('slow');
    				});

		    		jQuery(".background-wrap").change(function() {
        				(jQuery(this).val() == "Full Browser Width") ? jQuery(".background-info").slideUp('slow') : jQuery(".background-info").slideDown('slow');


    				});
		    		
				</script>

		</div>


			</div>
			<div class="optionsboxright altheader-activate" style="margin-bottom:10px;">
				<p class="headingtext">Bar Above Header</p>
				<p>
					<?php sno_select_toggle($settings, 'altheader-top', 'Off,Menu A,Search & Social Icons,Breaking News Ticker', $default='Off'); ?>
				</p>

				<div class="subdivider"></div>

				<p class="headingtext">Slide Out Menu (Left Side)</p>
					<p>
						<?php sno_checkbox($settings, 'altheader-left', $label='Display Slide Out Menu Icon', $default='Display'); ?>
					</p>
					
					<div class="altheader-left-menu">
						<p>
							<?php sno_checkbox($settings, 'altheader-menu-colors', $label='Use Custom Colors for Menu Icon', $default='Yes'); ?>
						</p>
						<div class="altheader-left-colors">
							<p>
								<?php sno_color_input($settings, 'altheader-menu-background', $default='#444444'); ?> Menu Icon Background<br />
								<?php sno_color_input($settings, 'altheader-menu-text', $default='#ffffff'); ?> Menu Icon Bars
							</p>
						</div>
						<p>
							<?php sno_color_input($settings, 'altheader-mobile-hover', $default='#444444'); ?> Menu Hover Background<br />
							<?php sno_color_input($settings, 'altheader-mobile-hover-text', $default='#ffffff'); ?> Menu Hover Text<br />
							<?php sno_color_input($settings, 'altheader-mobile-borders', $default='#eeeeee'); ?> Menu Border Color<br />
						</p>
					</div>
				
				<div class="subdivider"></div>
				
				<p class="headingtext">Header Right (Top Bar)</p>
				<p>
					<?php sno_select_toggle($settings, 'altheader-right', '1|Search & Social Icons,2|Breaking News Ticker,3|Leaderboard Ad Area,4|Off', $default='1'); ?>			
				</p>
					<div class="alt-leaderboard-options">
						<p>
							<?php sno_thickness_selectbox($settings, 'altheader-leaderboard-margin', 10, $default='0px'); ?> Leaderboard Ad Margin
						</p>
					</div>
					
				<div class="subdivider"></div>
				<div class="alt-leaderboard-active">
					<p class="headingtext">Header Right (Bottom Bar)</p>
					<p>
						<?php sno_select_toggle($settings, 'altheader-right-bottom', '1|Menu B,2|Breaking News Ticker,3|Search & Social Icons,4|Off', $default='1'); ?>		
					</p>
				</div>
			</div>

		<script type="text/javascript">
			jQuery('#header-alt-ck').change(function() {
   		 		jQuery('.altheader-activate').slideToggle('slow');
   		 		jQuery('.altheader-deactivate').slideToggle('slow');
					if (jQuery('#header-alt-ck').prop('checked')) {
						jQuery(".topnav-options").slideDown('slow');
					} else if (jQuery(".topnav-location").val() == "Off") {
						jQuery(".topnav-options").slideUp('slow');
					}
					if (jQuery('#header-alt-ck').prop('checked')) {
						jQuery(".bottomnav-options").slideDown('slow');
					} else if (jQuery("#bottomnav-ck").prop('checked') == false) {
						jQuery(".bottomnav-options").slideUp('slow');
					}
					if (jQuery('#header-alt-ck').prop('checked')) {
						jQuery(".breaking-controls").slideDown('slow');
					} else if (jQuery(".breakingnews-location").val() == "Off") {
						jQuery(".breaking-controls").slideUp('slow');
					}
					if (jQuery('#header-alt-ck').prop('checked')) {
						jQuery(".leader-controls").slideDown('slow');
					} else if (jQuery(".display-leader").val() == "Off") {
						jQuery(".leader-controls").slideUp('slow');
					}
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#header-alt-ck').prop('checked')) {
					jQuery(".altheader-activate").slideDown('slow');
					jQuery(".altheader-deactivate").slideUp('slow');
					jQuery(".topnav-options").slideDown('slow');		
					jQuery(".bottomnav-options").slideDown('slow');		
					jQuery(".breaking-controls").slideDown('slow');		
					jQuery(".leader-controls").slideDown('slow');		
				} else {
					jQuery(".altheader-activate").slideUp('slow');
					jQuery(".altheader-deactivate").slideDown('slow');
					if (jQuery(".topnav-location").val() == "Off") {
						jQuery(".topnav-options").slideUp('slow');
					}
					if (jQuery("#bottomnav-ck").prop('checked') == false) {
						jQuery(".bottomnav-options").slideUp('slow');
					}
					if (jQuery(".breakingnews-location").val() == "Off") {
						jQuery(".breaking-controls").slideUp('slow');
					}
					if (jQuery(".display-leader").val() == "Off") {
						jQuery(".leader-controls").slideUp('slow');
					}

				}
			});

			jQuery('#altheader-left-ck').change(function() {
   		 		jQuery('.altheader-left-menu').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#altheader-left-ck').prop('checked')) {
					jQuery(".altheader-left-menu").slideDown('slow');
				} else {
					jQuery(".altheader-left-menu").slideUp('slow');
				}
			});
			jQuery('#altheader-menu-colors-ck').change(function() {
   		 		jQuery('.altheader-left-colors').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#altheader-menu-colors-ck').prop('checked')) {
					jQuery(".altheader-left-colors").slideDown('slow');
				} else {
					jQuery(".altheader-left-colors").slideUp('slow');
				}
			});
    		jQuery(".altheader-right").change(function() {
        		(jQuery(this).val() != "3") ? jQuery(".alt-leaderboard-options").slideUp('slow') : jQuery(".alt-leaderboard-options").slideDown('slow');
        		(jQuery(this).val() != "3") ? jQuery(".alt-leaderboard-active").slideDown('slow') : jQuery(".alt-leaderboard-active").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".altheader-right").val() == "3") ? jQuery(".alt-leaderboard-options").slideDown('slow') : jQuery(".alt-leaderboard-options").slideUp('slow');
        		(jQuery(".altheader-right").val() == "3") ? jQuery(".alt-leaderboard-active").slideDown('slow') : jQuery(".alt-leaderboard-options").slideUp('slow');
    		});
    		</script>

		
		
		<div style="clear:both"></div>

	</div>
</div>



<a class="menuitem submenuheader" id="section14" href="#">Navigation Menus</a>
<div class="submenu" id="section14body">
	<div class="inside">
	
		<?php 
			$location = ''; $active = '';
			if (get_theme_mod('altheader-top') == 'Menu A' && get_theme_mod('header-alt') == 'Display') {
				$location = " Active above the header.";
				$active = 'active';
			} else if (get_theme_mod('topnav-location') == "Off") {
				$location = " Inactive.";
			} else {
				$location = " Active.";
				$active = 'active';
			} ?>
	
<div class="optionsbox" style="background: #eee;">
				<?php $topnav_display = get_theme_mod('topnav-location'); ?>

				<div style="<?php if ($active != "active") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
				<p class="headingtext">Header Location "A" is <?php echo $location; ?></p>
				</div>
				<p class="altheader-deactivate">Position of Header Location "A"<br />
					<?php sno_select_toggle($settings, 'topnav-location', 'Top Edge,Above Header,Below Header,Off', $default='Below Header'); ?> 
				</p>
				<div class="topnav-options">
					<div class="subdivider"></div>
					<p>		
						<?php sno_select_toggle($settings, 'topnav-align', 'left,center,right', $default='left'); ?> Menu Alignment<br />
					</p>
					<p>		
						<?php sno_select_toggle($settings, 'topnav-size', 'Small,Medium,Large', $default='Small'); ?> Menu Size<br />
					</p>
					<p>
						<?php sno_select_toggle($settings, 'topnav-stick', 'Activate,Deactivate', $default='Deactivate'); ?> Scroll-to-Fix			
					</p>
					<p>
						<?php sno_select_toggle($settings, 'topnav-mini-logo', 'Do Not Display,Display on Scroll,Always Display', $default='Do Not Display'); ?> Mini Logo			
					</p>

					<div class="subdivider"></div>

					<p>
						<?php sno_select_toggle($settings, 'topnav-style', 'capitalize,uppercase,lowercase,none', $default='capitalize'); ?> Text Style
					</p>
					<p>
						<?php sno_color_input($settings, 'accentcolor1', $default='#990000'); ?> Background Color <br />
						<?php sno_color_input($settings, 'accentcolor1-text', $default='#ffffff'); ?> Text Color <br />
						<?php sno_color_input($settings, 'accentcolor1-hover', $default='#393939'); ?> Hover Background Color <br />
						<?php sno_color_input($settings, 'accentcolor1-text-hover', $default='#ffffff'); ?> Hover Text Color 
					</p>
					<p>	
						<?php sno_checkbox($settings, 'navbar-gradient', $label='Gradient Overlay', $default='Color'); ?>
					</p>
					<div class="subdivider"></div>
					<p class="subheadingtext">Menu Display Style</p>
					<p>
						<?php sno_select_toggle($settings, 'topnav-appearance', 'Bar,Blocks', $default='Bar'); ?> 
					</p>
								
					<div class="topnav-blocks">
						<p>		
							<?php sno_color_input($settings, 'topnav-background', $default='#ffffff'); ?> Background beside blocks <br />
							<?php sno_color_input($settings, 'topnav-blockbackground', $default='#ffffff'); ?> Background between blocks <br />
							<?php sno_thickness_selectbox($settings, 'topnav-margin', 20, $default='0px'); ?> Margin between blocks<br />
							<?php sno_pattern_selectbox($settings, 'topnav-pattern', $default='stripes.png'); ?> Pattern Behind blocks<br />
						</p>
					</div>
					<p>The "Blocks" style allows for styling choices between individual menu items.</p>
				</div>
		<script type="text/javascript">
    		jQuery(".topnav-location").change(function() {
        		(jQuery(this).val() == "Off" && jQuery('#header-alt-ck').prop('checked') == false) ? jQuery(".topnav-options").slideUp('slow') : jQuery(".topnav-options").slideDown('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".topnav-location").val() == "Off" && jQuery('#header-alt-ck').prop('checked') == false) ? jQuery(".topnav-options").slideUp('slow') : jQuery(".topnav-options").slideDown('slow');
    		});
    		jQuery(".topnav-appearance").change(function() {
        		(jQuery(this).val() == "Bar") ? jQuery(".topnav-blocks").slideUp('slow') : jQuery(".topnav-blocks").slideDown('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".topnav-appearance").val() == "Bar") ? jQuery(".topnav-blocks").slideUp('slow') : jQuery(".topnav-blocks").slideDown('slow');
    		});
    	</script>

</div>

		<?php 
			$location = ''; $active = '';
			if (get_theme_mod('altheader-right-bottom') == '1' && get_theme_mod('header-alt') == 'Display') {
				$location = " Active in the header.";
				$active = 'active';
			} else if (get_theme_mod('bottomnav') != "Show") {
				$location = " Inactive.";
			} else {
				$location = " Active.";
				$active = 'active';
			} ?>

<div class="optionsboxright">
				<?php $bottomnav_display = get_theme_mod('bottomnav'); ?>

				<div style="<?php if ($active != "active") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
					<p class="headingtext">Header Location "B" is <?php echo $location; ?></p>
				</div>
				<p class="altheader-deactivate" style="padding-bottom:9px"><br />
					<?php sno_checkbox($settings, 'bottomnav', $label='Display Header Location "B"', $default='Show'); ?>
				</p>
			
				<div class="bottomnav-options">
					<div class="subdivider"></div>
					<p>
						<?php sno_select_toggle($settings, 'bottomnav-align', 'left,center,right', $default='left'); ?> Menu Alignment
					</p>
					<p>		
						<?php sno_select_toggle($settings, 'bottomnav-size', 'Small,Medium,Large', $default='Small'); ?> Menu Size<br />
					</p>
					<p>
						<?php sno_select_toggle($settings, 'bottomnav-stick', 'Activate,Deactivate', $default='Activate'); ?> Scroll-to-Fix			
					</p>
					<p>
						<?php sno_select_toggle($settings, 'bottomnav-mini-logo', 'Do Not Display,Display on Scroll,Always Display', $default='Do Not Display'); ?> Mini Logo			
					</p>

					<div class="subdivider"></div>

					<p>
						<?php sno_select_toggle($settings, 'bottomnav-style', 'capitalize,uppercase,lowercase,none', $default='capitalize'); ?> Text Style<br />
					</p>
					<p>
						<?php sno_color_input($settings, 'accentcolor2', $default='#393939'); ?> Background Color <br />
						<?php sno_color_input($settings, 'accentcolor2-text', $default='#ffffff'); ?> Text Color<br />
						<?php sno_color_input($settings, 'accentcolor2-hover', $default='#990000'); ?> Hover Background Color<br />
						<?php sno_color_input($settings, 'accentcolor2-text-hover', $default='#ffffff'); ?> Hover Text Color<br />
					</p>
					<p>
						<?php sno_checkbox($settings, 'bottomnav-gradient', $label='Gradient Overlay', $default='Gradient'); ?>
					</p>
					<div class="subdivider"></div>
					<p class="subheadingtext">Menu Display Style</p>
					<p>
						<?php sno_select_toggle($settings, 'bottomnav-appearance', 'Bar,Blocks', $default='Bar'); ?>
					</p>
					
					<div class="bottomnav-blocks">		
						<p>
							<?php sno_color_input($settings, 'bottomnav-background', $default='#ffffff'); ?> Background beside blocks <br />
							<?php sno_color_input($settings, 'bottomnav-blockbackground', $default='#ffffff'); ?> Background between blocks <br />
							<?php sno_thickness_selectbox($settings, 'bottomnav-margin', 20, $default='0px'); ?> Margin between blocks<br />
							<?php sno_pattern_selectbox($settings, 'bottomnav-pattern', $default='stripes.png'); ?> Pattern beside blocks<br />
						</p>
					</div>
					<p>The "Blocks" style allows for styling choices between individual menu items.</p>
				</div>
		<script type="text/javascript">
			jQuery('#bottomnav-ck').change(function() {
				if (jQuery('#header-alt-ck').prop('checked') == false) {
   		 			jQuery('.bottomnav-options').slideToggle('slow');
   		 		}
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#bottomnav-ck').prop('checked')) {
					jQuery(".bottomnav-options").slideDown('slow');
				} else if (jQuery('#header-alt-ck').prop('checked') == false) {
					jQuery(".bottomnav-options").slideUp('slow');
				}
			});
			
    		jQuery(".bottomnav-appearance").change(function() {
        		(jQuery(this).val() == "Bar") ? jQuery(".bottomnav-blocks").slideUp('slow') : jQuery(".bottomnav-blocks").slideDown('slow');
    		});
			jQuery(document).ready(function() {
        		(jQuery(".bottomnav-appearance").val() == "Bar") ? jQuery(".bottomnav-blocks").slideUp('slow') : jQuery(".bottomnav-blocks").slideDown('slow');
    		});    	
    		</script>
</div>
	<div style="clear:both"></div>
	</div>
</div>





<a class="menuitem submenuheader" id="section11" href="#">Breaking News Ticker</a>
<div class="submenu" id="section11body">
	<div class="inside">
	
		<?php 
			$location = ''; $active = '';
			if (get_theme_mod('breakingnews-location') == "Off") {
				$location = " Inactive.";
				$active = "Inactive";
			} else {
				$location = " Active.";
				$active = 'active';
			}
			if (get_theme_mod('header-alt') == 'Display') {
				if (get_theme_mod('altheader-right-bottom') == 'Breaking News Ticker') {
					$location = " Active in the right side of the header.  Control this location in the Full-Width Browser Options section above.";
					$active = 'active';
				}
				if (get_theme_mod('altheader-right') == '2') { 
					$location = " Active in the right side of the header.  Control this location in the Full-Width Browser Options section above.";
					$active = 'active';
				}
				if (get_theme_mod('altheader-top') == '2') {
					$location = " Active in the bar above the header.  Control this location in the Full-Width Browser Options section above.";
					$active = 'active';
				}
			} ?>
				<div style="<?php if ($active == 'Inactive') { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
				<p class="headingtext">Breaking News Ticker is <?php echo $location; ?>
				
				</p>
				</div>

			<div class="optionsbox">

				<p class="altheader-deactivate">
					<?php sno_select_toggle($settings, 'breakingnews-location', 'Off,Top Edge,Above Header,Below Header,Below Nav Bars', $default='Top Edge'); ?> Location
				</p>
				<div class="breaking-controls">
				<p>Type of Content to Display 
					<?php sno_select_toggle($settings, 'breaking-recent', 'Breaking News Entries|Only Breaking News Entries,All Recent Posts|All Recent Headlines', $default='Breaking News Entries'); ?>
				</p>
				<p>
					<input type="text" name="<?php echo $settings; ?>[breakingnews-scrollbox]" value="<?php if (get_theme_mod('breakingnews-scrollbox')=='') {echo '3';} else { echo get_theme_mod('breakingnews-scrollbox'); } ?>" size="2" /> Number of Headlines to Display
				</p>
				
				<p>
					<?php sno_checkbox($settings, 'breakingnews-date', $label='Show Publish Date', $default='Show'); ?>
				</p>
				<p>
					<?php sno_checkbox($settings, 'breakingnews-time', $label='Show Publish Time', $default='Show'); ?>
				</p>
				<br />
				</div>

 </div>

 <div class="optionsboxright breaking-controls">
  			<p class="headingtext">Appearance</p>                       

 				<p>
					<?php sno_color_input($settings, 'breakingnews-color', $default='#ffffff'); ?> Bar Background Color <br />

					<?php sno_color_input($settings, 'breakingnews-text-background', $default = get_theme_mod('breakingnews-color')); ?> Text Background Color <br />

					<?php sno_color_input($settings, 'breakingnews-text', $default = '#000000'); ?> Text Color<br />

					<?php sno_color_input($settings, 'breakingnews-date-background', $default = get_theme_mod('breakingnews-color')); ?> Date Background Color <br />

					<?php sno_color_input($settings, 'breakingnews-date-text', $default = get_theme_mod('breakingnews-text')) ?> Date Text Color <br />
				</p>
				<p>
					<?php sno_select_toggle($settings, 'breakingnews-textsize', 'Small,Medium,Large', $default='Small'); ?> Text Size
				</p>

				<p>
					
					<?php sno_checkbox($settings, 'breaking-gradient', $label='Add Gradient Overlay', $default='On'); ?>
				</p>

 			<p class="headingtext">Javascript Controls</p>                       
				<p>
					<?php sno_select_toggle($settings, 'breaking-scroll-style', 'vertical|Vertical,horizontal|Horizontal', $default='horizontal'); ?> Slide Direction<br />
					<?php sno_select_toggle($settings, 'breakingnews-speed', '1000|1 Second,2000|2 Seconds,3000|3 Seconds,4000|4 Seconds,5000|5 Seconds,6000|6 Seconds,7000|7 Seconds,8000|8 Seconds,9000|9 Seconds,10000|10 Seconds,11000|11 Seconds,12000|12 Seconds', $default='3000'); ?> Slide Duration<br />
		
					<?php sno_select_toggle($settings, 'breakingnews-transition', '666|Fast,1300|Medium,2000|Slow,10000|Very Slow', $default='1300'); ?>Slide Transition Time
				</p>

</div>

		<script type="text/javascript">
    		jQuery(".breakingnews-location").change(function() {
        		(jQuery(this).val() == "Off" && jQuery('#header-alt-ck').prop('checked') == false) ? jQuery(".breaking-controls").slideUp('slow') : jQuery(".breaking-controls").slideDown('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".breakingnews-location").val() == "Off" && jQuery('#header-alt-ck').prop('checked') == false) ? jQuery(".breaking-controls").slideUp('slow') : jQuery(".breaking-controls").slideDown('slow');
    		});

    	</script>
	
	<div style="clear:both"></div>
	</div>
</div>


<a class="menuitem submenuheader" href="#">Leaderboard Ad Area</a>
<div class="submenu">
	<div class="inside">

		<?php 
			$location = ''; $active = '';
			if (get_theme_mod('altheader-right') == '3' && get_theme_mod('header-alt') == 'Display') {
				$location = " Active in the right side of the header.  Control this location in the Full-Width Browser Options section above.";
				$active = 'active';
			} else if (get_theme_mod('display-leader') == "Off") {
				$location = " Inactive.";
			} else {
				$location = " Active.";
				$active = 'active';
			} ?>

		<div style="<?php if ($active != 'active') { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
			<p class="headingtext">Leaderboard Ad Area is <?php echo $location; ?></p>
		</div>
		
		<div class="optionsbox" style="width:200px">
			<div>     	
		      	<p class="subheadlabel">Location</p>
					<?php sno_select_toggle($settings, 'display-leader', 'Off,Top Edge,Above Header,Below Header', $default='Off'); ?>
			</div> 
			<div class="leader-controls">
				<div class="subdivider"></div>
				<p class="subheadingtext">Background Color</p>
					<?php sno_color_input($settings, 'leaderboard-background', $default='#dddddd'); ?>
				
				<p class="subheadlabel">Background Overlay</p>
					<?php sno_select_toggle($settings, 'leaderboard-gradient', 'Gradient,Pattern,None', $default='Pattern'); ?>
				<div class="leader-pattern">
				<p class="subheadlabel">Background Pattern</p>
					<?php sno_pattern_selectbox($settings, 'leaderboard-pattern', $default='stripes1.png'); ?>
				</div>
				<div class="subdivider"></div>
				<p>
					<?php sno_checkbox($settings, 'leaderad-hidehome', $label='Hide on Home Page', $default='Hide'); ?>	
				</p>

			</div>
		<script type="text/javascript">
    		jQuery(".leaderboard-gradient").change(function() {
        		(jQuery(this).val() == "Pattern") ? jQuery(".leader-pattern").slideDown('slow') : jQuery(".leader-pattern").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".leaderboard-gradient").val() == "Pattern") ? jQuery(".leader-pattern").slideDown('slow') : jQuery(".leader-pattern").slideUp('slow');
    		});
    	</script>

		</div>
		<div class="optionsboxwidgets leader-controls"<?php if (isset($hide_option) && $hide_option) echo $hide_option; ?>>

			<p class="headingtext">Leaderboard Main Ad (728px wide x 90px tall)</p>

				<p>Type of Ad Space<br />
				
					<?php if(function_exists('snoadrotate_ad_group')) { ?>
					<?php sno_select_toggle($settings, 'leaderad-type', 'Static Image,SNO Ad Rotate|SNO Ad Manager,Ad Tag', $default='Static Image'); ?> 
					<?php } else { ?>
					<?php sno_select_toggle($settings, 'leaderad-type', 'Static Image,Ad Tag', $default='Static Image'); ?> 
					<?php } ?>
				
				</p>
				
				<p>
					<?php sno_checkbox($settings, 'leaderad-center', $label='Center Ad in Leaderboard Area', $default='Center'); ?>	
				</p>
				
				<div class="leader-main-static">
					<p>Click the button to upload your image. After the upload is completed, click "Insert into Post".</p>

					<input class="upload_image_button3 button-primary" type="button" value="Click to Upload Ad Image" style="margin-bottom:10px"/>
					<input class="upload_image3" type="text" name="<?php echo $settings; ?>[leader-image]" value="<?php echo get_theme_mod('leader-image'); ?>" size="32" /> </p>
					<p class="subheadlabel">Advertisement Link</p>
					<input type="text" name="<?php echo $settings; ?>[leader-url]" value="<?php if(get_theme_mod('leader-url') == '') { echo 'http://snosites.com/'; } else { echo get_theme_mod('leader-url'); } ?>" size="32" /> </p>
					<p class="subheadlabel">Current Ad</p>
					<?php if (get_theme_mod('leader-image')) { ?><img src="<?php echo get_theme_mod('leader-image'); ?>" style="width:250px;margin-bottom:10px;"/><?php } ?>
				</div>
				<div class="leader-main-tag">
					<p>Use this option if you have subscribed to a third-party ad-server.  Paste the ad tag they provide in the box below.
					<textarea name="<?php echo $settings; ?>[openx-code]" cols=33 rows=5><?php echo stripslashes(get_theme_mod('openx-code')); ?></textarea></p>
				</div>
				<div class="leader-main-rotate">
					<p>This leaderboard Main Ad area is now configured to display ads uploaded to the Leaderboard Main Ad group in the SNO Ad Manager interface.   This feature will work only if you have purchased the SNO Ad Manager add-on.</p>
				</div>

		<script type="text/javascript">
    		jQuery(".leaderad-type").change(function() {
        		(jQuery(this).val() == "Static Image") ? jQuery(".leader-main-static").slideDown('slow') : jQuery(".leader-main-static").slideUp('slow');
        		(jQuery(this).val() == "Ad Tag") ? jQuery(".leader-main-tag").slideDown('slow') : jQuery(".leader-main-tag").slideUp('slow');
        		(jQuery(this).val() == "SNO Ad Rotate") ? jQuery(".leader-main-rotate").slideDown('slow') : jQuery(".leader-main-rotate").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".leaderad-type").val() == "Static Image") ? jQuery(".leader-main-static").slideDown('slow') : jQuery(".leader-main-static").slideUp('slow');
        		(jQuery(".leaderad-type").val() == "Ad Tag") ? jQuery(".leader-main-tag").slideDown('slow') : jQuery(".leader-main-tag").slideUp('slow');
        		(jQuery(".leaderad-type").val() == "SNO Ad Rotate") ? jQuery(".leader-main-rotate").slideDown('slow') : jQuery(".leader-main-rotate").slideUp('slow');
    		});
    	</script>


</div>
<div style="clear:both"></div>
<div class="second-ad">
<div class="optionsboxwidgets leader-controls">

				<p class="headingtext">Leaderboard Small Ad (205px wide x 90px tall)</p>
				
				<p>Type of Ad Space<br />
					<?php if(function_exists('snoadrotate_ad_group')) { ?>
					<?php sno_select_toggle($settings, 'leaderad-type-right', 'Static Image,SNO Ad Rotate|SNO Ad Manager,Ad Tag', $default='Static Image'); ?> 
					<?php } else { ?>
					<?php sno_select_toggle($settings, 'leaderad-type-right', 'Static Image,Ad Tag', $default='Static Image'); ?> 
					<?php } ?>
				
				</p>
				<p>
					<?php sno_checkbox($settings, 'leaderad-right-position', $label='Move Small Ad to left side', $default='Left'); ?>	
				</p>
				

				<div class="leader-small-static">
				
					<p>Click the button to upload your image. After the upload is completed, click "Insert into Post".</p>

					<input class="upload_image_button6 button-primary" type="button" value="Click to Upload Ad Image" style="margin-bottom:10px"/>
				
					<input class="upload_image6" type="text" name="<?php echo $settings; ?>[leader-image-right]" value="<?php echo get_theme_mod('leader-image-right'); ?>" size="32" /> </p>
				
					<p>Advertisement Link<br /><input type="text" name="<?php echo $settings; ?>[leader-url-right]" value="<?php if(get_theme_mod('leader-url-right') == '') { echo 'http://snosites.com/'; } else { echo get_theme_mod('leader-url-right'); } ?>" size="32" /> </p>
				
					<p>Current Ad</p>
					<?php if (get_theme_mod('leader-image-right')) { ?><img src="<?php echo get_theme_mod('leader-image-right'); ?>" style="width:62px;"/><?php } ?>

				</div>
				<div class="leader-small-tag">
					<p class="headingtext">Ad Serving Code</p>
					<p>Use this option if you have subscribed to a third-party ad-server.  Paste the ad tag they provide in the box below.
					<textarea name="<?php echo $settings; ?>[openx-code-right]" cols=33 rows=5><?php echo stripslashes(get_theme_mod('openx-code-right')); ?></textarea></p>
				</div>
				<div class="leader-small-rotate">
					<p>This leaderboard Small Ad area is now configured to display ads uploaded to the Leaderboard Small Ad group in the SNO Ad Manager interface. This feature will work only if you have purchased the SNO Ad Manager add-on.</p>
				</div>
	</div>
</div>
		<script type="text/javascript">
    		jQuery(".leaderad-type-right").change(function() {
        		(jQuery(this).val() == "Static Image") ? jQuery(".leader-small-static").slideDown('slow') : jQuery(".leader-small-static").slideUp('slow');
        		(jQuery(this).val() == "Ad Tag") ? jQuery(".leader-small-tag").slideDown('slow') : jQuery(".leader-small-tag").slideUp('slow');
        		(jQuery(this).val() == "SNO Ad Rotate") ? jQuery(".leader-small-rotate").slideDown('slow') : jQuery(".leader-small-rotate").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".leaderad-type-right").val() == "Static Image") ? jQuery(".leader-small-static").slideDown('slow') : jQuery(".leader-small-static").slideUp('slow');
        		(jQuery(".leaderad-type-right").val() == "Ad Tag") ? jQuery(".leader-small-tag").slideDown('slow') : jQuery(".leader-small-tag").slideUp('slow');
        		(jQuery(".leaderad-type-right").val() == "SNO Ad Rotate") ? jQuery(".leader-small-rotate").slideDown('slow') : jQuery(".leader-small-rotate").slideUp('slow');
    		});

    		jQuery(".display-leader").change(function() {
        		(jQuery(this).val() == "Off" && jQuery('#header-alt-ck').prop('checked') == false) ? jQuery(".leader-controls").slideUp('slow') : jQuery(".leader-controls").slideDown('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".display-leader").val() == "Off" && jQuery('#header-alt-ck').prop('checked') == false) ? jQuery(".leader-controls").slideUp('slow') : jQuery(".leader-controls").slideDown('slow');
    		});

			jQuery('#leaderad-center-ck').change(function() {
   		 		jQuery('.second-ad').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#leaderad-center-ck').prop('checked')) {
					jQuery(".second-ad").slideUp('slow');
				} else {
					jQuery(".second-ad").slideDown('slow');
				}
			});
    	</script>
<div style="clear:both"></div>
	</div>
</div>



<a class="menuitem submenuheader" id="section12" href="#">Social Media Icons and Search</a>
<div class="submenu" id="section12body">
	<div class="inside">
		<?php if (get_theme_mod('facebook') == "") { ?>
			<div style="border: 1px solid #c6474e; background: #eb979c;padding:10px 10px 0px;margin-bottom:10px;">
				<p class="headingtext">Add Links to your Social Media Accounts.</p>
			</div>
		<?php } ?>
	
	<div class="optionsboxwrap">
		<div class="optionsboxdetail altheader-deactivate" style="margin-top:0px">
				<p class="subheadingtext">Display Location</p>
				<p>	
					<?php sno_select_toggle($settings, 'search-location', 'Top Edge,Above Header,In Header,Below Header,Below Nav Bars,Off', $default='Top Edge'); ?>
				</p>
		</div>
				
			<div class="optionsboxdetail social-bar">
					<p class="headingtext">Bar Display Options</p>
					<p>
						<?php sno_color_input($settings, 'topbar', $default='#000000'); ?> Background Color<br />
						<?php sno_color_input($settings, 'topbar-text', $default='#ffffff'); ?> Text Color<br />
					</p>
					<p>
						<?php sno_select_toggle($settings, 'topbar-gradient', 'Gradient,Pattern,None', $default='Gradient'); ?> Background Overlay<br />
					</p>
					<div class="searchbar-pattern">
						<p>
							<?php sno_pattern_selectbox($settings, 'topbar-pattern', $default='stripes.png'); ?> Pattern<br />
						</p>
					</div>
					<p>
						<?php sno_select_toggle($settings, 'show-date', 'Show,Hide', $default='Hide'); ?><?php _e(" Today's Date", 'sno'); ?>
					</p>
			
			</div>
			<div class="optionsboxdetail">
					<p class="headingtext">Social Icons Options</p>
					<p>Icons Display Style<br />
						<?php sno_select_toggle($settings, 'altheader-icons', 'Full Color,Full Color Inverse,Monochromatic,Monochromatic Inverse', $default='Full Color'); ?>			
					</p>
					<p>Icons Hover Display Style<br />
						<?php sno_select_toggle($settings, 'altheader-icons-hover', 'Full Color,Full Color Inverse,Monochromatic,Monochromatic Inverse', $default='Full Color Inverse'); ?> 		
					</p>
					<p><i>The monochromatic options will use the colors listed just above in the <b>Bar Display Options section</b> for background and text.</i></p>
					<p>
						<?php sno_thickness_selectbox($settings, 'altheader-icons-border-thickness', 10, $default='0px'); ?> Icons Margin
					</p>
					<p>
						<?php sno_thickness_selectbox($settings, 'altheader-icons-border-radius', 20, $default='0px'); ?> Corner Radius
					</p>
					<p>
						<?php sno_checkbox($settings, 'altheader-icons-border-option', $label='Hide Top/Bottom Borders', $default='Hide'); ?>	

					</p>
			</div>
			<div class="optionsboxdetail">
				<div class="altheadersearchoptions">
					<p class="headingtext">Search Bar Options</p>
					<p>
						<?php sno_color_input($settings, 'altheader-search-background', $default='#444444'); ?> Search Bar Color
					</p>
					<p>
						<?php sno_color_input($settings, 'altheader-search-text', $default='#ffffff'); ?> Search Bar Text
					</p>
				</div>
				<div class="searchoptions">
					<p class="headingtext">Search Bar Options</p>
					<p>
						<?php sno_color_input($settings, 'searchbar-background', $default='#dddddd'); ?> Search Bar Background
					</p>
					<p>
						<?php sno_color_input($settings, 'searchbar-text', $default='#aaaaaa'); ?> Search Bar Text
					</p>
					<p>
						<?php sno_color_input($settings, 'searchbar-border', $default='#dddddd'); ?> Search Bar Border
					</p>
					<p>
						<?php sno_color_input($settings, 'searchbar-icon-background', $default='#dddddd'); ?> Search Icon Background
					</p>
					<p>
						<?php sno_color_input($settings, 'searchbar-icon-text', $default='#aaaaaa'); ?> Search Icon Text
					</p>
				</div>
			</div>
			<div class="altheader-hide">
				<div class="optionsboxdetail social-header">

					<p class="headingtext">In Header Display Options</p>
					<p>These options allow you to place your social icons and search box directly in the area where your header graphic is.</p>
					<p>
						<?php sno_select_toggle($settings, 'icons-location', 'Top Right,Center Right,Bottom Right,Top Left,Bottom Left,Off', $default='Top Right'); ?> Icons Location<br />
						<?php sno_select_toggle($settings, 'search-header-location', 'Top Right,Center Right,Bottom Right,Off', $default='Bottom Right'); ?> Search Location<br />
					</p>
					<p>
						<?php sno_color_input($settings, 'search-color', $default='#eeeeee'); ?> Search Border Color<br />
						<?php sno_thickness_selectbox($settings, 'search-background-thickness', 20, $default='8px'); ?> Search Border Thickness<br />
						<?php sno_select_toggle($settings, 'search-background', 'Color,Pattern,None', $default='Color'); ?> Search Border Style<br />
					</p>	

					<div class="search-pattern">
						<p>
							<?php sno_pattern_selectbox($settings, 'search-pattern', $default='stripes.png'); ?> Pattern<br />
						</p>
					</div>
				</div>
			</div>
		</div>
		
				<script type="text/javascript">
    					jQuery(".topbar-gradient").change(function() {
        					(jQuery(this).val() == "Pattern") ? jQuery(".searchbar-pattern").slideDown('slow') : jQuery(".searchbar-pattern").slideUp('slow');
    					});
						jQuery(document).ready(function() {
        					(jQuery(".topbar-gradient").val() == "Pattern") ? jQuery(".searchbar-pattern").slideDown('slow') : jQuery(".searchbar-pattern").slideUp('slow');
    					});
				
    					jQuery(".search-background").change(function() {
        					(jQuery(this).val() == "Pattern") ? jQuery(".search-pattern").slideDown('slow') : jQuery(".search-pattern").slideUp('slow');
    					});
						jQuery(document).ready(function() {
        					(jQuery(".search-background").val() == "Pattern") ? jQuery(".search-pattern").slideDown('slow') : jQuery(".search-pattern").slideUp('slow');
    					});
    				
    					
   					jQuery(document).ready(function() {
        				if (jQuery(".search-location").val() == "Off") { 
        					jQuery(".social-bar").slideUp('slow');
        					jQuery(".social-header").slideUp('slow');
        				} else if (jQuery(".search-location").val() == "In Header" && jQuery('#header-alt-ck').prop('checked') == false) {
        					jQuery(".social-header").slideDown('slow');
        					jQuery(".social-bar").slideUp('slow');
        				} else {
        					jQuery(".social-header").slideUp('slow');
        					jQuery(".social-bar").slideDown('slow');        				
        				}
    				});
    				jQuery(".search-location").change(function() {
        				if (jQuery(this).val() == "Off") { 
        					jQuery(".social-bar").slideUp('slow');
        					jQuery(".social-header").slideUp('slow');
        				} else if (jQuery(this).val() == "In Header" && jQuery('#header-alt-ck').prop('checked') == false) {
        					jQuery(".social-header").slideDown('slow');
        					jQuery(".social-bar").slideUp('slow');
        				} else {
        					jQuery(".social-header").slideUp('slow');
        					jQuery(".social-bar").slideDown('slow');        				
        				}
    				});

					jQuery('#header-alt-ck').change(function() {
   				 		jQuery('.altheader-hide').slideToggle('slow');
					});
			   		jQuery(document).ready(function() {
						if (jQuery('#header-alt-ck').prop('checked')) {
							jQuery(".altheader-hide").slideUp('slow');
						} else {
							jQuery(".altheader-hide").slideDown('slow');
						}
					});

					jQuery('#header-alt-ck').change(function() {
   				 		jQuery('.altheadersearchoptions').slideToggle('slow');
						jQuery(".searchoptions").slideToggle('slow');
					});
			   		jQuery(document).ready(function() {
						if (jQuery('#header-alt-ck').prop('checked')) {
							jQuery(".altheadersearchoptions").slideDown('slow');
							jQuery(".searchoptions").slideUp('slow');
						} else {
							jQuery(".altheadersearchoptions").slideUp('slow');
							jQuery(".searchoptions").slideDown('slow');
						}
					});

    			</script>
				
				
			<div class="optionsboxright" style="background: #fff">
				<p class="headingtext">Add Social Media Links</p>
				<p>Enter the URLs for your social media accounts below to make the social media icons appear on your site.  Each link must start with "http://".</p>

		<p>Facebook Fan Page URL<br />
		<input type="text" name="<?php echo $settings; ?>[facebook]" value="<?php echo get_theme_mod('facebook'); ?>" size="25" />
		</p>
		<p>Twitter URL<br />
		<input type="text" name="<?php echo $settings; ?>[twitter]" value="<?php echo get_theme_mod('twitter'); ?>" size="25" />
		</p>
		<p>Google Plus URL<br />
		<input type="text" name="<?php echo $settings; ?>[googleplus]" value="<?php echo get_theme_mod('googleplus'); ?>" size="25" />
		</p>
		<p>Tumblr URL<br />
		<input type="text" name="<?php echo $settings; ?>[tumblr]" value="<?php echo get_theme_mod('tumblr'); ?>" size="25" />
		</p>
		<p>YouTube Channel URL<br />
		<input type="text" name="<?php echo $settings; ?>[youtube]" value="<?php echo get_theme_mod('youtube'); ?>" size="25" />
		</p>
		<p>Snapchat Username<br />
		<input type="text" name="<?php echo $settings; ?>[snapchat]" value="<?php echo get_theme_mod('snapchat'); ?>" size="25" />
		</p>
		<p>Vimeo URL<br />
		<input type="text" name="<?php echo $settings; ?>[vimeo]" value="<?php echo get_theme_mod('vimeo'); ?>" size="25" />
		</p>
		<p>SchoolTube URL<br />
		<input type="text" name="<?php echo $settings; ?>[schooltube]" value="<?php echo get_theme_mod('schooltube'); ?>" size="25" />
		</p>
		<p>FlickR URL<br />
		<input type="text" name="<?php echo $settings; ?>[flickr]" value="<?php echo get_theme_mod('flickr'); ?>" size="25" />
		</p>
		<p>Instagram URL<br />
		<input type="text" name="<?php echo $settings; ?>[instagram]" value="<?php echo get_theme_mod('instagram'); ?>" size="25" />
		</p>
		<p>Pinterest URL<br />
		<input type="text" name="<?php echo $settings; ?>[pinterest]" value="<?php echo get_theme_mod('pinterest'); ?>" size="25" />
		</p>
		<p>Reddit URL<br />
		<input type="text" name="<?php echo $settings; ?>[reddit]" value="<?php echo get_theme_mod('reddit'); ?>" size="25" />
		</p>
		<p>SoundCloud URL<br />
		<input type="text" name="<?php echo $settings; ?>[soundcloud]" value="<?php echo get_theme_mod('soundcloud'); ?>" size="25" />
		</p>
		<p>LinkedIn URL<br />
		<input type="text" name="<?php echo $settings; ?>[linkedin]" value="<?php echo get_theme_mod('linkedin'); ?>" size="25" />
		</p>
		<div class="divline"></div>
		<p class="headingtext">RSS and Feedburner </p>
		<p>Register your site with Feedburner to enable daily emails to your readers.</p>
		<?php $feedoptions = get_option('sno_analytics_options'); if (isset($feedoptions['sno_site_feedburner_code'])) { $feedburneradmin = $feedoptions['sno_site_feedburner_code']; } else { $feedburneradmin = ''; } $feedburner = get_theme_mod('feedburner'); ?>
		<?php if (($feedburner == '') && ($feedburneradmin)) { $feedburnervalue = $feedburneradmin; } else { $feedburnervalue = $feedburner; } ?>
		<input type="text" name="<?php echo $settings; ?>[feedburner]" value="<?php echo $feedburnervalue; ?>" size="16" /> Feedburner ID
		</p>
			<p>
				<?php sno_checkbox($settings, 'email-rss', $label='Show Feedburner Email Icon', $default='Show'); ?>
			</p>
		<p>
			<?php sno_checkbox($settings, 'rss-icon', $label='Hide RSS Feed Icon', $default='Hide'); ?>
		</p>
</div>



	<div style="clear:both"></div>
	</div>
</div>

<a class="menuitem submenuheader" id="section16b" href="#">Sharing Options on Story Pages</a>
<div class="submenu" id="section16bbody">
	<div class="inside">

		<div class="optionsboxwrap">
			<div class="optionsboxdetail" style="background: #fff;margin-top:0px;">
			<p class="headingtext">Select Sharing Services</p>
				<?php sno_select_toggle($settings, 'sharing-comments', 'Show,Hide', $default='Show'); ?> Comments Icon<br />		
				<?php sno_select_toggle($settings, 'sharing-facebook', 'Show,Hide', $default='Show'); ?> Facebook Icon<br />		
				<?php sno_select_toggle($settings, 'sharing-twitter', 'Show,Hide', $default='Show'); ?> Twitter Icon<br />
				<div class="sharing-twitter-options">
					<input style="margin-bottom:10px;" type="text" name="<?php echo $settings; ?>[sharing-twitter-username]" placeholder="Twitter Username" value="<?php echo get_theme_mod('sharing-twitter-username'); ?>" size="20" />
				</div>
				<?php sno_select_toggle($settings, 'sharing-google', 'Show,Hide', $default='Hide'); ?> Google Plus Icon<br />		
				<?php sno_select_toggle($settings, 'sharing-pinterest', 'Show,Hide', $default='Hide'); ?> Pinterest Icon<br />		
				<?php sno_select_toggle($settings, 'sharing-reddit', 'Show,Hide', $default='Hide'); ?> Reddit Icon<br />		
				<?php sno_select_toggle($settings, 'sharing-tumblr', 'Show,Hide', $default='Hide'); ?> Tumblr Icon<br />		
				<?php sno_select_toggle($settings, 'sharing-email', 'Show,Hide', $default='Show'); ?> Email Icon<br />		
			</div>
			
			<div style="border: 1px solid #aaa; padding: 10px;margin-top:10px;">
				<p class="headingtext">Fallback Sharing Image</p>
					<p>Upload an image to be used by sharing services when your story does not have a featured image.</p>
					<p>After the image uploads, make sure "Full Size" is checked and then click "Insert into Post".</p>

					<input class="upload_image_button_fb button-primary" type="button" value="Click to Upload Image" style="margin-bottom:10px"/>
					<input class="upload_image_fb" type="text" name="<?php echo $settings; ?>[fallback-image]" value="<?php echo get_theme_mod('fallback-image'); ?>" size="28" /> </p>
					<p class="subheadlabel">Current Fallback Image</p>
					<?php if (get_theme_mod('fallback-image')) { ?><img src="<?php echo get_theme_mod('fallback-image'); ?>" style="width:250px;margin-bottom:10px;"/><?php } ?>
			</div>
			
			<div style="border: 1px solid #aaa; padding: 10px;margin-top:10px;">
				<p class="headingtext">Options for Mobile Devices</p>
					<p><?php sno_checkbox($settings, 'sharing-mobile-stick', $label='Activate Sharing Bar', $default='Stick'); ?></p>
					<div class="mobile-sharing-icons">
						<p class="sharing-comments-options"><?php sno_checkbox($settings, 'sharing-mobile-comments', $label='Display Comments Button', $default='Display'); ?></p>
						<p class="sharing-email-options"><?php sno_checkbox($settings, 'sharing-mobile-email', $label='Display Email button', $default='Display'); ?></p>
						<p><?php sno_checkbox($settings, 'sharing-mobile', $label='Display Sharing Icons', $default='Display'); ?></p>
						<p><i>Mobile browsers have their own sharing functionality.  For this reason, we recommend not displaying FLEX's sharing icons on mobile.</i></p>
					</div>
			</div>
		</div>
		<div class="optionsboxright">
			<p class="headingtext">Sharing Icon Placement</p>
				<p><?php sno_select_toggle($settings, 'sharing-icons-classic', 'Above,Below,Above/Below,Off', $default='Above'); ?> Classic (With Sidebar)</p>		
				<p><?php sno_select_toggle($settings, 'sharing-icons-fullwidth', 'Above,Below,Above/Below,Off', $default='Above'); ?> Full-Width</p>
				<p><?php sno_select_toggle($settings, 'sharing-icons-siderails', 'Left Rail,Below,Left Rail/Below,Off', $default='Left Rail'); ?> Side Rails</p>
				<p><?php sno_select_toggle($settings, 'lf-social', 'Hide,Display', $default='Display'); ?> on Long-Form Templates</p>
		</div>
		<div class="optionsbox">
		</div>
		<div class="optionsboxright">
					<p class="headingtext">Icon Appearance</p>
						<?php sno_select_toggle($settings, 'sharing-icons-size', 'Small,Large', $default='Small'); ?> Icons Size<br />
						<?php sno_thickness_selectbox($settings, 'sharing-icons-margin', 10, $default='0px'); ?> Icons Margin<br />
						<?php sno_select_toggle($settings, 'sharing-icons-width', '30px,40px,50px,60px,70px,80px,90px,100px', $default='90px'); ?> Icons Width<br />
						<?php sno_thickness_selectbox($settings, 'sharing-icons-border-radius', 20, $default='0px'); ?> Corner Radius<br /><br />
					
					<p>Icons Color<br />
						<?php sno_select_toggle($settings, 'sharing-icons', 'Full Color,Full Color Inverse,Monochromatic,Monochromatic Inverse', $default='Full Color'); ?>			
					</p>
					<p>Icons Hover Color<br />
						<?php sno_select_toggle($settings, 'sharing-icons-hover', 'Full Color,Full Color Inverse,Monochromatic,Monochromatic Inverse', $default='Full Color Inverse'); ?> 		
					</p>
					<?php sno_color_input($settings, 'sharing-mono-1', $default = get_theme_mod('reset-color1')); ?> Monochromatic Color<br /><br />
					<p><?php sno_checkbox($settings, 'sharing-icons-opaque', $label='Make Icons Opaque', $default='Yes'); ?></p>
					
		</div>

		<script type="text/javascript">
    		jQuery(".sharing-twitter").change(function() {
        		(jQuery(this).val() == "Show") ? jQuery(".sharing-twitter-options").slideDown('slow') : jQuery(".sharing-twitter-options").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".sharing-twitter").val() == "Show") ? jQuery(".sharing-twitter-options").slideDown('slow') : jQuery(".sharing-twitter-options").slideUp('slow');
    		});
		</script>
	<div style="clear:both"></div>
	</div>
</div>

<a class="menuitem submenuheader" id="section16b" href="#">Story Scroll Bar</a>
<div class="submenu" id="section16cbody">
	<div class="inside">

			<?php 	$storybarcat = get_theme_mod('storybar-cat'); 
					if ($storybarcat == '') $storybarcat = get_theme_mod('featured-cat'); 
					if ($storybarcat == '') $storybarcat = 11; 
					$storybarcathome = get_theme_mod('storybar-cat-home'); 
					if ($storybarcathome == '') $$storybarcathome = get_theme_mod('featured-cat'); 
					if ($storybarcathome == '') $storybarcathome = 11; 
					
			?>
					
			<div class="optionsbox">
				<p class="subheadingtext">About the Story Scroll Bar</p>
				<p>The Story Scroll Bar is a skinny bar of teasers to stories that can be placed at the top of your site on the homepage and that can appear on scroll on story pages.</p>
				
				<div class="subdivider"></div>
			<div class="optionsboxdetail">
					<p class="subheadingtext" style="text-decoration:underline;">Home Page Options</p>

					<p class="subheadingtext">Home Location</p>

					<?php sno_select_toggle($settings, 'storybar-home', 'Off,Top Edge,Above Header,Below Header,Below Nav Bars', $default='Off'); ?><br /><br />
					
					<div class="ssb-home">
						<p class="subheadingtext">Category to be Displayed</p>
						<?php wp_dropdown_categories(array('selected' => $storybarcathome, 'name' => $settings.'[storybar-cat-home]', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?><br /><br />

						<p><?php sno_select_toggle($settings, 'storybar-home-count', '5,10,15,20,25,30', $default='10'); ?> Number of Stories</p>
						<p><?php sno_color_input($settings, 'storybar-home-accent', $default = get_theme_mod('reset-color1')); ?> Accent Color</p>
						<p><?php sno_select_toggle($settings, 'storybar-home-scheme', 'Light,Dark', $default='Light'); ?> Color Scheme</p>
					</div>
    			
				</div>
			</div>

			<div class="optionsboxright">
				<p class="subheadingtext" style="text-decoration:underline">Story Page Options</p>
				<p><i>On story pages, the Story Scroll Bar will only appear as the reader scrolls up the page.</i></p>
				<p class="subheadingtext">Teaser Selection</p>
					<?php sno_select_toggle($settings, 'storybar-content', 'Same Category as Story,Same Tags as Story,Same Writer as Story,Custom Category,Off', $default='Same Category as Story'); ?><br /><br />
					<div class="ssb-story">
					<div class="ssb-cat">

						<p class="subheadingtext">Category to be Displayed</p>
						<?php wp_dropdown_categories(array('selected' => $storybarcat, 'name' => $settings.'[storybar-cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?><br /><br />
					</div>
					
					<p><?php sno_select_toggle($settings, 'storybar-count', '5,10,15,20,25,30', $default='10'); ?> Number of Stories</p>
					<p><b>NOTE:</b> <i>If there are not enough stories in the option you chose, your site will add other recent posts to the end of the list.</i></p>
				
					<p class="subheadingtext">Appearance</p>
					<?php sno_select_toggle($settings, 'storybar-direction', 'Top,Bottom', $default='Top'); ?> Location<br />
  					<?php sno_color_input($settings, 'storybar-accent', $default = get_theme_mod('reset-color1')); ?> Accent Color<br />
					<?php sno_select_toggle($settings, 'storybar-scheme', 'Light,Dark', $default='Light'); ?> Color Scheme<br /><br />

					<p class="subheadingtext">Template Options</p>
					<?php sno_checkbox($settings, 'storybar-sidebar', $label='Hide on Non-Home Sidebar Template', $default='Hide'); ?><br />
					<?php sno_checkbox($settings, 'storybar-fullwidth', $label='Hide on Full-Width Template', $default='Hide'); ?><br />
					<?php sno_checkbox($settings, 'storybar-rails', $label='Hide on Side Rails Template', $default='Hide'); ?><br />
					
					</div>

			</div>
			
			<script type="text/javascript">
    			jQuery(".storybar-home").change(function() {
        			(jQuery(this).val() != "Off") ? jQuery(".ssb-home").slideDown('slow') : jQuery(".ssb-home").slideUp('slow');
    			});
				jQuery(document).ready(function() {
        			(jQuery(".storybar-home").val() != "Off") ? jQuery(".ssb-home").slideDown('slow') : jQuery(".ssb-home").slideUp('slow');
    			});

    			jQuery(".storybar-content").change(function() {
        			(jQuery(this).val() == "Custom Category") ? jQuery(".ssb-cat").slideDown('slow') : jQuery(".ssb-cat").slideUp('slow');
    			});
				jQuery(document).ready(function() {
        			(jQuery(".storybar-content").val() == "Custom Category") ? jQuery(".ssb-cat").slideDown('slow') : jQuery(".ssb-cat").slideUp('slow');
    			});
    			jQuery(".storybar-content").change(function() {
        			(jQuery(this).val() != "Off") ? jQuery(".ssb-story").slideDown('slow') : jQuery(".ssb-story").slideUp('slow');
    			});
				jQuery(document).ready(function() {
        			(jQuery(".storybar-content").val() != "Off") ? jQuery(".ssb-story").slideDown('slow') : jQuery(".ssb-story").slideUp('slow');
    			});

			</script>
				
	<div style="clear:both"></div>
	</div>
</div>


<a class="menuitem submenuheader" id="section16b" href="#">Hover Bar</a>
<div class="submenu" id="section16bbody">
	<div class="inside">

			<div style="<?php if (get_theme_mod('hoverbar') == "Deactivate") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
			<p class="headingtext">The Hover Bar is <?php if (get_theme_mod('hoverbar') == "Deactivate") { echo 'Inactive.'; } else { echo 'Active';} ?></p>
			</div>
			
			<div class="optionsbox">
				<p class="subheadingtext">About the Hover Bar</p>
				<p>The hover bar appears at the top of the screen as your reader scrolls down the page and contains options for menus, searching, and sharing.</p>

				<div style="<?php if (get_theme_mod('hoverbar') == "Deactivate") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
					<p>
						<?php sno_select_toggle($settings, 'hoverbar', 'Activate,Deactivate', $default='Activate'); ?> Hover Bar<br />
					</p>
					
				</div>
					<p>
						<?php sno_select_toggle($settings, 'hoverbar-color', 'Light,Dark,Custom', $default='Light'); ?> Color Scheme<br /><br />
					</p>
				
				<div class="hoverbar-options">
					<?php sno_color_input($settings, 'hoverbar-accent', $default = get_theme_mod('reset-color1')); ?> Highlight Color<br />
				</div>
					<div class="hoverbar-custom">
  						<?php sno_color_input($settings, 'hoverbar-background', $default = '#ffffff'); ?> Background Color<br />
  						<?php sno_color_input($settings, 'hoverbar-text', $default = '#000000'); ?> Title Text Color<br />
  						<?php sno_color_input($settings, 'hoverbar-hover-background', $default = '#000000'); ?> Hover Background Color<br />
  						<?php sno_color_input($settings, 'hoverbar-hover-text', $default = '#ffffff'); ?> Hover Text Color<br />
  						<div class="hover-progress-options">
	  						<?php sno_color_input($settings, 'hoverbar-progress-color', $default = '#eeeeee'); ?> Progress Bar Color<br />
  						</div>
  						<div class="hover-search-options">
	  						<?php sno_color_input($settings, 'hoverbar-search-color', $default = '#dddddd'); ?> Search Bar Background<br />
  						</div>
  						<div style="border: 1px solid #aaa;padding: 10px;margin-top: 10px;">
  							<p class="headingtext">Site Icons Design Options</p>
	  						<p><i>Site icons are the menu, home, up, and search icons.</i></p>
	  						<?php sno_color_input($settings, 'hoverbar-site-icons-background', $default = '#eeeeee'); ?> Site Icon Background<br />
  							<?php sno_color_input($settings, 'hoverbar-site-icons', $default = '#cccccc'); ?> Icons Color<br />
	  						<?php sno_select_toggle($settings, 'hoverbar-border', 'On,Off', $default='On'); ?> Icons Border<br />
	  						<div class="hoverbar-border-hide">
		  						<?php sno_color_input($settings, 'hoverbar-border-color', $default = '#cccccc'); ?> Site Icon Border Color<br />
  							</div>
  						</div>
					</div>
			</div>
		<div class="optionsboxright hoverbar-options">
					<p class="headingtext">Hover Bar Content</p>
					<p><?php sno_checkbox($settings, 'hoverbar-logo-center', $label='Center Logo', $default='Center'); ?></p>
					<div class="centered-logo">
						<?php sno_select_toggle($settings, 'hoverbar-title', 'Show,Hide', $default='Show'); ?> Title in Hover Bar<br />
						<?php sno_select_toggle($settings, 'hoverbar-progress', 'Activate|Full Height,Half|Skinny,Deactivate', $default='Activate'); ?> Scroll Progress Bar<br />
					</div>
					<?php sno_select_toggle($settings, 'hoverbar-social', 'Show,Hide', $default='Show'); ?> Sharing Icons on Story Page<br />
					<div class="sharing-comments-options">
						<?php sno_select_toggle($settings, 'hoverbar-comments', 'Show,Hide', $default='Show'); ?> Comments Icon on Story Page<br />
					</div>
					<div class="sharing-email-options">
						<?php sno_select_toggle($settings, 'hoverbar-email', 'Show,Hide', $default='Show'); ?> Email Icon on Story Page<br />
					</div>
					<?php sno_select_toggle($settings, 'hoverbar-search', 'Show,Hide', $default='Show'); ?> Search Icon<br />
				<div class="hover-sharing-design" style="margin-top: 10px;">
					<div class="subdivider"></div>
					<p class="headingtext">Design for Hover Bar Sharing Icons</p>
					<p>Display Style<br />
						<?php sno_select_toggle($settings, 'hoverbar-icons', 'Full Color,Full Color Inverse,Monochromatic,Monochromatic Inverse', $default='Full Color'); ?>			
					</p>
					<p>Hover Style<br />
						<?php sno_select_toggle($settings, 'hoverbar-icons-hover', 'Full Color,Full Color Inverse,Monochromatic,Monochromatic Inverse', $default='Full Color Inverse'); ?> 		
					</p>
					<p><?php sno_color_input($settings, 'hoverbar-mono-1', $default = get_theme_mod('reset-color1')); ?> Monochromatic Color</p>
					<p><?php sno_checkbox($settings, 'hoverbar-icons-opaque', $label='Make Icons Opaque', $default='Yes'); ?></p>
				</div>
		</div>
		
		<div class="clear"></div>


		<script type="text/javascript">
					jQuery('#sharing-mobile-stick-ck').change(function() {
   				 		jQuery('.mobile-sharing-icons').slideToggle('slow');
					});
			   		jQuery(document).ready(function() {
						if (jQuery('#sharing-mobile-stick-ck').prop('checked')) {
							jQuery(".mobile-sharing-icons").slideDown('slow');
						} else {
							jQuery(".mobile-sharing-icons").slideUp('slow');
						}
					});
			
					jQuery('#hoverbar-logo-center-ck').change(function() {
   				 		jQuery('.centered-logo').slideToggle('slow');
					});
			   		jQuery(document).ready(function() {
						if (jQuery('#hoverbar-logo-center-ck').prop('checked')) {
							jQuery(".centered-logo").slideUp('slow');
						} else {
							jQuery(".centered-logo").slideDown('slow');
						}
					});


    		jQuery(".sharing-comments").change(function() {
        		(jQuery(this).val() == "Show") ? jQuery(".sharing-comments-options").slideDown('slow') : jQuery(".sharing-comments-options").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".sharing-comments").val() == "Show") ? jQuery(".sharing-comments-options").slideDown('slow') : jQuery(".sharing-comments-options").slideUp('slow');
    		});

    		jQuery(".sharing-email").change(function() {
        		(jQuery(this).val() == "Show") ? jQuery(".sharing-email-options").slideDown('slow') : jQuery(".sharing-email-options").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".sharing-email").val() == "Show") ? jQuery(".sharing-email-options").slideDown('slow') : jQuery(".sharing-email-options").slideUp('slow');
    		});

    		jQuery(".hoverbar").change(function() {
        		(jQuery(this).val() == "Activate") ? jQuery(".hoverbar-options").slideDown('slow') : jQuery(".hoverbar-options").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".hoverbar").val() == "Activate") ? jQuery(".hoverbar-options").slideDown('slow') : jQuery(".hoverbar-options").slideUp('slow');
    		});

    		jQuery(".hoverbar-search").change(function() {
        		(jQuery(this).val() == "Show") ? jQuery(".hover-search-options").slideDown('slow') : jQuery(".hover-search-options").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".hoverbar-search").val() == "Show") ? jQuery(".hover-search-options").slideDown('slow') : jQuery(".hover-search-options").slideUp('slow');
    		});

    		jQuery(".hoverbar-progress").change(function() {
        		(jQuery(this).val() == "Deactivate") ? jQuery(".hover-progress-options").slideUp('slow') : jQuery(".hover-progress-options").slideDown('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".hoverbar-progress").val() == "Deactivate") ? jQuery(".hover-progress-options").slideUp('slow') : jQuery(".hover-progress-options").slideDown('slow');
    		});



    		jQuery(".hoverbar-social").change(function() {
        		(jQuery(this).val() == "Show") ? jQuery(".hover-sharing-design").slideDown('slow') : jQuery(".hover-sharing-design").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".hoverbar-social").val() == "Show") ? jQuery(".hover-sharing-design").slideDown('slow') : jQuery(".hover-sharing-design").slideUp('slow');
    		});


    		jQuery(".hoverbar-border").change(function() {
        		(jQuery(this).val() == "On") ? jQuery(".hoverbar-border-hide").slideDown('slow') : jQuery(".hoverbar-border-hide").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".hoverbar-border").val() == "On") ? jQuery(".hoverbar-border-hide").slideDown('slow') : jQuery(".hoverbar-border-hide").slideUp('slow');
    		});


    		jQuery(".hoverbar-color").change(function() {
        		(jQuery(this).val() == "Custom") ? jQuery(".hoverbar-custom").slideDown('slow') : jQuery(".hoverbar-custom").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".hoverbar-color").val() == "Custom") ? jQuery(".hoverbar-custom").slideDown('slow') : jQuery(".hoverbar-custom").slideUp('slow');
    		});
		</script>
	<div style="clear:both"></div>
	</div>
</div>




<a class="menuitem submenuheader" id="section24" href="#">Footer</a>		
<div class="submenu" id="section24body" style="border-bottom:1px solid #cccccc;">
		<div class="inside">
			<div class="optionsbox">
			<p class="headingtext">Footer Content</p>
					<p><?php sno_checkbox($settings, 'footer-name', $label='Display Website Name', $default='Display'); ?></p>
					<p><?php sno_checkbox($settings, 'footer-tagline', $label='Display Website Tagline', $default='Display'); ?></p>
					<p><?php sno_checkbox($settings, 'footer-social', $label='Display Social Media Icons', $default='Display'); ?></p>
					<p><?php sno_checkbox($settings, 'footer-search', $label='Display Search Box', $default='Display'); ?></p>
					<p><?php sno_checkbox($settings, 'footer-menu', $label='Display Navigation Menu', $default='Display'); ?></p>
				
					<div class="subdivider"></div>
					<p>To display the Footer Navigation Menu, you also need to go to the <a href="/wp-admin/nav-menus.php" target="_blank">Menu Interface</a> and assign a menu to the Footer Menu location.</p>
					<p>Copyright Notice<br />
					<input type="text" name="<?php echo $settings; ?>[copyright]" value="<?php echo get_theme_mod('copyright'); ?>" size="27" /></p>

					<p>Privacy Policy Link<br />
					<input type="text" name="<?php echo $settings; ?>[privacy]" value="<?php echo get_theme_mod('privacy'); ?>" size="27" /></p>

					<p>Address<br />
					<textarea name="<?php echo $settings; ?>[address]" style="width:100%;" rows=4><?php echo get_theme_mod('address'); ?></textarea></p>


			</div>
			<div class="optionsboxright">
				<p class="headingtext">Appearance</p>
					<?php sno_color_input($settings, 'footer-background', $default='#393939'); ?> Footer Background<br />
					<?php sno_color_input($settings, 'footer-color', $default='#ffffff'); ?> Footer Text <br />
					<?php sno_pattern_selectbox($settings, 'footer-background-pattern', $default='dots.png'); ?> Pattern<br />
				</p>
					<div class="subdivider"></div>
					
				<div id="footericonsinfo">
					<p class="headingtext">Social Icons Options</p>
					<p>
						<?php sno_thickness_selectbox($settings, 'footer-icons-border-thickness', 10, $default='0px'); ?> Icons Margin
					</p>
					<p>
						<?php sno_thickness_selectbox($settings, 'footer-icons-radius', 15, $default='0px'); ?> Icons Border Radius
					</p>
				</div>
					<div class="subdivider"></div>

				<div id="navigationinfo">
					<p class="headingtext">Navigation Menu Options</p>

					<?php sno_color_input($settings, 'footer-accent-color', $default='#990000'); ?> Menu Accent Color<br />
					<?php sno_thickness_selectbox($settings, 'footer-accent-thickness', 20, $default='5px'); ?> Menu Border Thickness<br />
					<div class="subdivider"></div>

				</div>

				<p class="headingtext">Footer Link</p>
				<p>The name of your Web site in the footer will link to the URL you've entered in the box below.  Make sure the link begins with <strong>http://</strong>.</p>
				<p><input type="text" name="<?php echo $settings; ?>[google-apps]" value="<?php echo get_theme_mod('google-apps'); ?>" size="27" /></p>
			</div>
				<script type="text/javascript">
					jQuery('#footer-menu-ck').change(function() {
   				 		jQuery('#navigationinfo').slideToggle('slow');
					});
				   	jQuery(document).ready(function() {
						if (jQuery('#footer-menu-ck').prop('checked')) {
							jQuery("#navigationinfo").slideDown('slow');
						} else {
							jQuery("#navigationinfo").slideUp('slow');
						}
					});
					jQuery('#footer-social-ck').change(function() {
   				 		jQuery('#footericonsinfo').slideToggle('slow');
					});
				   	jQuery(document).ready(function() {
						if (jQuery('#footer-social-ck').prop('checked')) {
							jQuery("#footericonsinfo").slideDown('slow');
						} else {
							jQuery("#footericonsinfo").slideUp('slow');
						}
					});
				</script>

			<div style="clear:both"></div>
            </div>
</div>

<a class="menuitem submenuheader" href="#">Footer Ad Area</a>
<div class="submenu">
	<div class="inside">
		<div style="<?php if (get_theme_mod('display-footerad') == "Inactive") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
			<p class="headingtext">Footer Ad Area is <?php if (get_theme_mod('display-footerad') == "Inactive") { echo 'Inactive.'; } else { echo 'Active';} ?></p>
		</div>
		
		<div class="optionsbox" style="width:200px">
		      	<p class="subheadlabel">Location</p>
					<?php sno_select_toggle($settings, 'display-footerad', 'Inactive,Active', $default='Inactive'); ?>

			<div class="footerad-controls">
				<div class="subdivider"></div>
				<p class="subheadingtext">Background Color</p>
					<?php sno_color_input($settings, 'footerad-background', $default='#dddddd'); ?>
				
				<p class="subheadlabel">Background Overlay</p>
					<?php sno_select_toggle($settings, 'footerad-gradient', 'Gradient,Pattern,None', $default='Pattern'); ?>
				<div class="footerad-pattern">
				<p class="subheadlabel">Background Pattern</p>
					<?php sno_pattern_selectbox($settings, 'footerad-pattern', $default='stripes1.png'); ?>
				</div>
			</div>
		<script type="text/javascript">
    		jQuery(".footerad-gradient").change(function() {
        		(jQuery(this).val() == "Pattern") ? jQuery(".footerad-pattern").slideDown('slow') : jQuery(".footerad-pattern").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".footerad-gradient").val() == "Pattern") ? jQuery(".footerad-pattern").slideDown('slow') : jQuery(".footerad-pattern").slideUp('slow');
    		});
    	</script>

		</div>
		<div class="optionsboxwidgets footerad-controls"<?php if (isset($hide_option) && $hide_option) echo $hide_option; ?>>

			<p class="headingtext">Main Footer Ad (728px wide x 90px tall)</p>

				<p>Type of Ad Space<br />
					<?php if(function_exists('snoadrotate_ad_group')) { ?>
					<?php sno_select_toggle($settings, 'footerad-type', 'Static Image,SNO Ad Rotate|SNO Ad Manager,Ad Tag', $default='Static Image'); ?> 
					<?php } else { ?>
					<?php sno_select_toggle($settings, 'footerad-type', 'Static Image,Ad Tag', $default='Static Image'); ?> 
					<?php } ?>
				</p>
				
				<p>
					<?php sno_checkbox($settings, 'footerad-center', $label='Center Ad in Footer Ad Area', $default='Center'); ?>	
				</p>
				
				<div class="footerad-main-static">
					<p>Click the button to upload your image. After the upload is completed, click "Insert into Post".</p>

					<input class="upload_image_button10 button-primary" type="button" value="Click to Upload Ad Image" style="margin-bottom:10px"/>
					<input class="upload_image10" type="text" name="<?php echo $settings; ?>[footerad-image]" value="<?php echo get_theme_mod('footerad-image'); ?>" size="32" /> </p>
					<p class="subheadlabel">Advertisement Link</p>
					<input type="text" name="<?php echo $settings; ?>[footerad-url]" value="<?php if(get_theme_mod('footerad-url') == '') { echo 'http://snosites.com/'; } else { echo get_theme_mod('footerad-url'); } ?>" size="32" /> </p>
					<p class="subheadlabel">Current Ad</p>
					<?php if (get_theme_mod('footerad-image')) { ?><img src="<?php echo get_theme_mod('footerad-image'); ?>" style="width:250px;margin-bottom:10px;"/><?php } ?>
				</div>
				<div class="footerad-main-tag">
					<p>Use this option if you have subscribed to a third-party ad-server.  Paste the ad tag they provide in the box below.
					<textarea name="<?php echo $settings; ?>[footerad-code]" cols=33 rows=5><?php echo stripslashes(get_theme_mod('footerad-code')); ?></textarea></p>
				</div>
				<div class="footerad-main-rotate">
					<p>This Main Footer Ad area is now configured to display ads uploaded to the Main Footer Ad group in the SNO Ad Manager interface.   This feature will work only if you have purchased the SNO Ad Manager add-on.</p>
				</div>

		<script type="text/javascript">
    		jQuery(".footerad-type").change(function() {
        		(jQuery(this).val() == "Static Image") ? jQuery(".footerad-main-static").slideDown('slow') : jQuery(".footerad-main-static").slideUp('slow');
        		(jQuery(this).val() == "Ad Tag") ? jQuery(".footerad-main-tag").slideDown('slow') : jQuery(".footerad-main-tag").slideUp('slow');
        		(jQuery(this).val() == "SNO Ad Rotate") ? jQuery(".footerad-main-rotate").slideDown('slow') : jQuery(".footerad-main-rotate").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".footerad-type").val() == "Static Image") ? jQuery(".footerad-main-static").slideDown('slow') : jQuery(".footerad-main-static").slideUp('slow');
        		(jQuery(".footerad-type").val() == "Ad Tag") ? jQuery(".footerad-main-tag").slideDown('slow') : jQuery(".footerad-main-tag").slideUp('slow');
        		(jQuery(".footerad-type").val() == "SNO Ad Rotate") ? jQuery(".footerad-main-rotate").slideDown('slow') : jQuery(".footerad-main-rotate").slideUp('slow');
    		});
    	</script>


</div>
<div style="clear:both"></div>
<div class="footer-second-ad">
<div class="optionsboxwidgets footerad-controls">

				<p class="headingtext">Small Footer Ad (205px wide x 90px tall)</p>
				
				<p>Type of Ad Space<br />
				
					<?php if(function_exists('snoadrotate_ad_group')) { ?>
					<?php sno_select_toggle($settings, 'footerad-type-right', 'Static Image,SNO Ad Rotate|SNO Ad Manager,Ad Tag', $default='Static Image'); ?> 
					<?php } else { ?>
					<?php sno_select_toggle($settings, 'footerad-type-right', 'Static Image,Ad Tag', $default='Static Image'); ?> 
					<?php } ?>

				</p>

				<div class="footerad-small-static">
				
					<p>Click the button to upload your image. After the upload is completed, click "Insert into Post".</p>

					<input class="upload_image_button11 button-primary" type="button" value="Click to Upload Ad Image" style="margin-bottom:10px"/>
				
					<input class="upload_image11" type="text" name="<?php echo $settings; ?>[footerad-image-right]" value="<?php echo get_theme_mod('footerad-image-right'); ?>" size="32" /> </p>
				
					<p>Advertisement Link<br /><input type="text" name="<?php echo $settings; ?>[footerad-url-right]" value="<?php if(get_theme_mod('footerad-url-right') == '') { echo 'http://snosites.com/'; } else { echo get_theme_mod('footerad-url-right'); } ?>" size="32" /> </p>
				
					<p>Current Ad</p>
					<?php if (get_theme_mod('footerad-image-right')) { ?><img src="<?php echo get_theme_mod('footerad-image-right'); ?>" style="width:62px;"/><?php } ?>

				</div>
				<div class="footerad-small-tag">
					<p class="headingtext">Ad Serving Code</p>
					<p>Use this option if you have subscribed to a third-party ad-server.  Paste the ad tag they provide in the box below.
					<textarea name="<?php echo $settings; ?>[footerad-code-right]" cols=33 rows=5><?php echo stripslashes(get_theme_mod('footerad-code-right')); ?></textarea></p>
				</div>
				<div class="footerad-small-rotate">
					<p>This Small Footer Ad area is now configured to display ads uploaded to the Small Footer Ad group in the SNO Ad Manager interface.   This feature will work only if you have purchased the SNO Ad Manager add-on.</p>
				</div>
	</div>
</div>
		<script type="text/javascript">
    		jQuery(".footerad-type-right").change(function() {
        		(jQuery(this).val() == "Static Image") ? jQuery(".footerad-small-static").slideDown('slow') : jQuery(".footerad-small-static").slideUp('slow');
        		(jQuery(this).val() == "Ad Tag") ? jQuery(".footerad-small-tag").slideDown('slow') : jQuery(".footerad-small-tag").slideUp('slow');
        		(jQuery(this).val() == "SNO Ad Rotate") ? jQuery(".footerad-small-rotate").slideDown('slow') : jQuery(".footerad-small-rotate").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".footerad-type-right").val() == "Static Image") ? jQuery(".footerad-small-static").slideDown('slow') : jQuery(".footerad-small-static").slideUp('slow');
        		(jQuery(".footerad-type-right").val() == "Ad Tag") ? jQuery(".footerad-small-tag").slideDown('slow') : jQuery(".footerad-small-tag").slideUp('slow');
        		(jQuery(".footerad-type-right").val() == "SNO Ad Rotate") ? jQuery(".footerad-small-rotate").slideDown('slow') : jQuery(".footerad-small-rotate").slideUp('slow');
    		});

    		jQuery(".display-footerad").change(function() {
        		(jQuery(this).val() != "Inactive") ? jQuery(".footerad-controls").slideDown('slow') : jQuery(".footerad-controls").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".display-footerad").val() != "Inactive") ? jQuery(".footerad-controls").slideDown('slow') : jQuery(".footerad-controls").slideUp('slow');
    		});
			
			jQuery('#footerad-center-ck').change(function() {
   		 		jQuery('.footer-second-ad').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#footerad-center-ck').prop('checked')) {
					jQuery(".footer-second-ad").slideUp('slow');
				} else {
					jQuery(".footer-second-ad").slideDown('slow');
				}
			});
    	</script>
<div style="clear:both"></div>
	</div>
</div>



</div><!--end of third section-->


<!--start of fourth section-->
<div class="mainbar" style="margin-top:35px"><a class="menuheader submenuheader" id="section1" href="#">Non-Home Pages</a></div>
<div class="submenu" style="padding:0px 0px 0px 35px;background: #f1f1f1;">

<a class="menuitem submenuheader" id="section15" href="#">Story Page Extras</a>
<div class="submenu" id="section15body">
	<div class="inside">
		
		<div class="optionsboxwide">
			<p class="subheadingtext">Display Views</p>
			
				<p><?php sno_checkbox($settings, 'show-views', $label='Display Google Analytics View Data on Stories.', $default='Yes'); ?></p>
		</div>

		<div class="optionsboxwide">
			<p class="subheadingtext">Byline and Photo Credit Options</p>
			
				<p><?php sno_checkbox($settings, 'sp-jobtitle', $label='Display "Staff Position" field from the writer\'s staff profile as part of the byline rather than the Job Title field on the edit story page.', $default='Yes'); ?></p>
				<p>Text to be added in front of byline<br />
				 	<input type="text" name="<?php echo $settings; ?>[story-byline-text]" value="<?php echo get_theme_mod('story-byline-text'); ?>" size="20" /> 
				</p>
				<p>Text to be added in front of photo credit<br />
				 	<input type="text" name="<?php echo $settings; ?>[story-photo-credit]" value="<?php echo get_theme_mod('story-photo-credit'); ?>" size="20" /> 
				</p>
		</div>

		<div class="optionsboxwide">
			<p class="subheadingtext">Staff Profiles on Story Pages</p>
				<p>You can display staff profiles at the bottom of your different story page templates based on story contributors.</p>
				<p>
					<?php sno_checkbox($settings, 'sp-classic', $label='With Non-Home Sidebar', $default='On'); ?><br />
					<?php sno_checkbox($settings, 'sp-fullwidth', $label='Full-Width', $default='On'); ?><br />
					<?php sno_checkbox($settings, 'sp-siderails', $label='Side Rails', $default='On'); ?><br />
					<?php sno_checkbox($settings, 'sp-sidebyside', $label='Side by Side', $default='On'); ?><br />
					<?php sno_checkbox($settings, 'sp-grid', $label='Grid', $default='On'); ?><br />
					<?php sno_checkbox($settings, 'sp-longform', $label='Long-Form', $default='On'); ?><br />
				</p>
			<br />
			<p class="subheadingtext">Design Options</p>
				<p>You can control the appearance of staff profiles on story pages.</p>
					<?php sno_select_toggle($settings, 'sp-border', 'All Sides,Top,Top/Bottom,Left', $default='All Sides'); ?> Outer Border Style<br />
					<?php sno_thickness_selectbox($settings, 'sp-border-thickness', 20, $default='1px'); ?> Outer Border Thickness<br />
					<?php sno_color_input($settings, 'sp-border-color', $default='#dddddd'); ?> Outer Border Color<br />
					<?php sno_color_input($settings, 'sp-outer-background', $default='#eeeeee'); ?> Outer Background Color<br />
					<?php sno_color_input($settings, 'sp-outer-color', $default='#000000'); ?> Title Text Color<br /><br />
					
					<?php sno_thickness_selectbox($settings, 'sp-panel-thickness', 10, $default='0px'); ?> Inner Panel Border Thickness<br />
					<?php sno_color_input($settings, 'sp-panel-border-color', $default='#dddddd'); ?> Inner Panel Border Color<br />
					<?php sno_color_input($settings, 'sp-panel-background', $default='#eeeeee'); ?> Inner Panel Background<br />
					<?php sno_color_input($settings, 'sp-panel-color', $default='#000000'); ?> Inner Panel Text Color<br /><br />

			<p class="subheadingtext">Content Options</p>
					
					<?php sno_select_toggle($settings, 'sp-label-text', 'Automatic,Custom,Off', $default='Automatic'); ?> Title Text<br />
					<span class="sp-title-text"><input type="text" name="<?php echo $settings; ?>[sp-label-custom]" value="<?php echo get_theme_mod('sp-label-custom'); ?>" size="27" /> Custom Label</span><br /><br />
					

					<?php sno_checkbox($settings, 'sp-photo', $label='Hide Staff Profile Images', $default='Hide'); ?><br />
					<div class="sp-photo-options">
						<?php sno_checkbox($settings, 'sp-photo-wrap', $label='Prevent Text from Wrapping Around Photo', $default='Off'); ?><br />
						<?php sno_select_toggle($settings, 'sp-photo-size', 'Force Horizontal,Original Scale', $default='Original Scale'); ?> Photo Dimensions<br />
					</div>
					<br />

					<?php sno_checkbox($settings, 'sp-columns', $label='Enable Two Column Format', $default='On'); ?><br />
					<?php sno_select_toggle($settings, 'sp-tile-height', 'Auto|Auto (1 Column Format Only),90px,100px,110px,120px,130px,140px,150px,160px,170px,180px,190px,200px,210px,220px,230px,240px,250px,260px,270px,280px,290px,300px', $default='110px'); ?> Fixed Tile Height<br /><br />
					<?php sno_checkbox($settings, 'sp-hide-photographer', $label='Exclude Photo Credits', $default='Exclude'); ?><br />
					<?php sno_checkbox($settings, 'sp-hide-videographer', $label='Exclude Video Credits', $default='Exclude'); ?><br />


			<br />
				<p>These options let you adjust the content of staff profiles on story pages.</p>
				<?php sno_select_toggle($settings, 'sp-excerpt', 'Automatic Excerpt,Formatted Excerpt,Full Profile', $default='Automatic Excerpt'); ?> Staff Profile Text<br />
				<?php $excerpt_length = get_theme_mod('sp-excerpt-length'); if ($excerpt_length == '' || !is_numeric($excerpt_length)) $excerpt_length = 150; ?>
				<div class="sp-excerpt-options">
					<input type="text" name="<?php echo $settings; ?>[sp-excerpt-length]" value="<?php echo $excerpt_length; ?>" size="3" maxlength="3"/> Excerpt Length (characters)<br />
				</div>

				
		</div>

		<div class="optionsboxwide">
			<p class="subheadingtext">Gallery Options</p>
			<p><?php sno_select_toggle($settings, 'slideshow-scheme', 'Dark,Light', $default='Dark'); ?> Color Scheme</p>
			<p><?php sno_color_input($settings, 'slideshow-arrow-hover', $default=get_theme_mod('reset-color1')); ?> Arrow Hover Color</p>
	 		<p><?php sno_select_toggle($settings, 'slideshow-thumb-location', 'Bottom,Top,Off', $default='Bottom'); ?> Thumbnail Navigation Location</p>
			<p><?php sno_select_toggle($settings, 'slideshow-type', 'Overlay,Inline', $default='Overlay'); ?> Gallery Display</p>
			
			<p class="subheadingtext">Inline Gallery Options</p>
	 		<p><?php sno_select_toggle($settings, 'inline-thumb-location', 'Bottom,Top,Off', $default='Bottom'); ?> Thumbnail Navigation Location</p>
	 		<p><?php sno_checkbox($settings, 'inline-autoscroll', $label='Activate Auto-Scroll', $default='Yes'); ?></p>
	 		<p><?php sno_select_toggle($settings, 'inline-autoscroll-speed', '3000|3 Seconds,4000|4 Seconds,5000|5 Seconds,6000|6 Seconds,7000|7 Seconds,8000|8 Seconds,9000|9 Seconds,10000|10 Seconds', $default='4000'); ?> Slide Duration</p>
		</div>

		<div class="optionsboxwide">
			<p class="subheadingtext">Best of SNO Badge Options</p>
	 		<p><?php sno_checkbox($settings, 'bos-show-badge', $label='Hide Best of SNO badge', $default='Hide'); ?></p>
			<p><?php sno_select_toggle($settings, 'bos-logo', 'Color,White', $default='Color'); ?> Best of SNO Logo Style</p>
			<div class="bos-color-options">
				<p><?php sno_color_input($settings, 'bos-background-color', $default='#241f20'); ?> Badge Background Color</p>
			</div>
			<p><?php sno_select_toggle($settings, 'bos-border', 'All Sides,Bottom,Top/Bottom', $default='Top/Bottom'); ?> Outer Border Style</p>
			<p><?php sno_thickness_selectbox($settings, 'bos-border-thickness', 20, $default='0px'); ?> Outer Border Thickness</p>
			<p><?php sno_color_input($settings, 'bos-border-color', $default='#241f20'); ?> Outer Border Color</p>
		</div>

		<script type="text/javascript">
			jQuery('#sp-photo-ck').change(function() {
   				jQuery('.sp-photo-options').slideToggle('slow');
			});
		   	jQuery(document).ready(function() {
				if (jQuery('#sp-photo-ck').prop('checked')) {
					jQuery(".sp-photo-options").slideUp('slow');
				} else {
					jQuery(".sp-photo-options").slideDown('slow');
				}
			});
   			jQuery(document).ready(function() {
        		(jQuery(".bos-logo").val() == "Color") ? jQuery(".bos-color-options").slideUp('slow') : jQuery(".bos-color-options").slideDown('slow');
    		});
    		jQuery(".bos-logo").change(function() {
        		(jQuery(this).val() == "Color") ? jQuery(".bos-color-options").slideUp('slow') : jQuery(".bos-color-options").slideDown('slow');
    		});

   			jQuery(document).ready(function() {
        		(jQuery(".sp-label-text").val() == "Custom") ? jQuery(".sp-title-text").slideDown('slow') : jQuery(".sp-title-text").slideUp('slow');
    		});
    		jQuery(".sp-label-text").change(function() {
        		(jQuery(this).val() == "Custom") ? jQuery(".sp-title-text").slideDown('slow') : jQuery(".sp-title-text").slideUp('slow');
    		});
    		
   			jQuery(document).ready(function() {
        		(jQuery(".sp-excerpt").val() == "Formatted Excerpt" || jQuery(".sp-excerpt").val() == "Automatic Excerpt") ? jQuery(".sp-excerpt-options").slideDown('slow') : jQuery(".sp-excerpt-options").slideUp('slow');
    		});
    		jQuery(".sp-excerpt").change(function() {
        		(jQuery(this).val() == "Formatted Excerpt" || jQuery(this).val() == "Automatic Excerpt") ? jQuery(".sp-excerpt-options").slideDown('slow') : jQuery(".sp-excerpt-options").slideUp('slow');
    		});
    	</script>

	<div style="clear:both"></div>
	</div>
</div>

<a class="menuitem submenuheader" id="section15" href="#">Story Page</a>
<div class="submenu" id="section15body">
	<div class="inside">
		<div style="border: 1px solid #85c175; background: #c2e3b9;padding:10px 10px 0px;">

			<p class="subheadingtext"><?php sno_select_toggle($settings, 'story-template', 'Full-Width,Classic|Classic (With Sidebar)', $default='Classic'); ?> Select a Default Template</p>
			<p>Individual stories can be assigned to either template on the top right of the Edit Story page.</p>

		</div>	
		<div class="optionsbox" style="background: #eee;margin-top:10px;">
			
			<p class="subheadingtext">Color Overrides</p>
				<p>
					<?php sno_checkbox($settings, 'story-page-override', $label='Activate Story Page Color Override', $default='On'); ?>
				</p>
				<div class="override-options">
					<p>
						<?php sno_color_input($settings, 'story-page-background', $default='#ffffff'); ?> Page Background Color<br />
						<?php sno_color_input($settings, 'story-page-override-links', $default='#ffffff'); ?> Story Page Links Color <br />
						<?php sno_color_input($settings, 'story-page-override-text', $default='#ffffff'); ?> Story Page Text Color <br />
					</p>
				</div>

		</div>
		<div style="clear:both;"></div>


		<div class="optionsboxwide">
			<div class="optionsboxbase">
				
				<p class="subheadingtext">Headline Appearance</p>
				<p>
					<?php sno_select_toggle($settings, 'story-headline', '2.6em|Small,3.6em|Medium,4.6em|Large,5.6em|XL,6.6em|Woah!', $default='3.6em'); ?> Headline Size<br />
					<?php sno_select_toggle($settings, 'classic-story-headline-align', 'center|Centered,left|Left', $default='left'); ?> Headline Alignment<br />
				</p>
			</div>
			<div class="optionsboxextra">
			<p style="font-style:italic">Additional Full-Width Template Options</p>
				<p>
					<?php sno_select_toggle($settings, 'story-headline-align', 'center|Centered,left|Left', $default='center'); ?> Headline Alignment<br />
				</p>
			</div>	
			<div style="clear:both;"></div>
		</div>
		<div class="optionsbox" style="background: #eee;margin-top:10px;">
			<p class="subheadingtext">Deck Appearance</p>

				<?php sno_select_toggle($settings, 'story-deck-size', '1.8em|Small,2em|Medium,2.4em|Large', $default='2em'); ?> Deck Size<br />
				<?php sno_select_toggle($settings, 'story-deck-style', 'Plain,Bold,Italic', $default='Plain'); ?> Deck Style<br />
				<?php sno_select_toggle($settings, 'story-deck-align', 'center|Centered,left|Left', $default='center'); ?> Deck Alignment<br />
					<?php sno_color_input($settings, 'story-deck-color', $default='#444444'); ?> Deck Color
			</p>
		</div>
		<div style="clear:both;"></div>
		<div class="optionsboxwide">
			<div class="optionsboxbase">
				<p class="subheadingtext">Byline/Date Appearance</p>
				<p>
					<?php sno_select_toggle($settings, 'story-byline-display', 'Display,Hide', $default='Display'); ?> Byline<br />
				</p>
				<p>
					<?php sno_select_toggle($settings, 'story-date-display', 'Display,Hide', $default='Display'); ?> Date<br />
				</p>

			</div>

			<div class="optionsboxextra">
			<p style="font-style:italic">Additional Full-Width Template Options</p>
				<p>
						<?php sno_color_input($settings, 'story-byline-background', $default='#f5f5f5'); ?> Byline Background Color<br />
						<?php sno_color_input($settings, 'story-byline-border', $default='#dddddd'); ?> Byline Border Color<br />
					<?php sno_thickness_selectbox($settings, 'story-byline-thickness', 10, $default='1px'); ?> Byline Border Thickness
				</p>
			</div>	
			<div style="clear:both"></div>
		</div>


		<div class="optionsboxwide">
			<div class="optionsboxbase">
				<p class="subheadingtext">Photo Captions/Credits</p>
				<p>
					<?php sno_color_input($settings, 'story-page-caption-background', $default='#eeeeee'); ?> Caption Background Color<br />
					<?php sno_color_input($settings, 'story-page-caption-border', $default='#dddddd'); ?> Caption Border Color<br />
				</p>
				<p>
					<?php sno_select_toggle($settings, 'storypage-slideshow', 'Activate,Deactivate', $default='Activate'); ?> Slideshow Overlay<br />
				</p>
								
			</div>
			<div class="optionsboxextra">
			<p style="font-style:italic">Additional Full-Width Template Option</p>
				<p>
 					<?php sno_checkbox($settings, 'story-page-photo-shadow', $label='Display Photo/Caption Drop Shadow', $default='Display'); ?>
				</p>
			</div>
			<div style="clear:both"></div>
		</div>
		<div class="optionsboxwide">
			<div class="optionsboxbase">
				<p class="subheadingtext">Category Information</p>
				<p>
 					<?php sno_checkbox($settings, 'story-bar', $label='Display Category Name', $default='Display'); ?>
				</p>
			</div>
			<div class="optionsboxextra">
	
			<p style="font-style:italic">Additional Full-Width Template Options</p>
				<p>
					<?php sno_color_input($settings, 'story-bar-background', $default='#888888'); ?> Background Color<br />
					<?php sno_color_input($settings, 'story-bar-text', $default='#ffffff'); ?> Text Color<br />
				</p>
				<p>
 					<?php sno_checkbox($settings, 'story-categories', $label='Display other stories in Category', $default='Display'); ?>
				</p>
			</div>
			<div style="clear:both;"></div>
		</div>
		

		<div class="optionsbox" style="background: #eee;margin-top:10px;">
			<p class="subheadingtext">Sharing Icons</p>
			<p>
 				<?php sno_checkbox($settings, 'story-social', $label='Display Sharing Icons', $default='Display'); ?>
			</p>				
		</div>
		<div style="clear:both;"></div>

		<div class="optionsbox" style="background: #eee;margin-top:10px;">
			<div class="optionsboxbase">
				<p class="subheadingtext">SNO Story Element Defaults</p>
					<p>
						<?php sno_select_toggle($settings, 'story-element-align', 'left|Left,center|Center,right|Right', $default='left'); ?> Alignment<br />
						<?php sno_select_toggle($settings, 'story-element-border', 'all|All,none|None,top|Top,right|Right,bottom|Bottom,left|Left', $default='all'); ?> Border<br />
						<?php sno_color_input($settings, 'story-element-border-color', $default='#888888'); ?> Border Color<br />
						<?php sno_select_toggle($settings, 'story-element-background', 'on|On,off|Off', $default='normal'); ?> Background<br />
						<?php sno_select_toggle($settings, 'story-element-shadow', 'on|On,off|Off', $default='normal'); ?> Shadow<br />
						<?php sno_color_input($settings, 'story-element-pullquote-color', $default='#888888'); ?> Pullquote Color<br />
					</p>
			</div>
		</div>


	<div style="clear:both"></div>
	</div>
</div>

				<script type="text/javascript">
					jQuery('#story-page-override-ck').change(function() {
   				 		jQuery('.override-options').slideToggle('slow');
   				 		jQuery('.override-options-opposite').slideToggle('slow');
					});
				   	jQuery(document).ready(function() {
						if (jQuery('#story-page-override-ck').prop('checked')) {
							jQuery(".override-options").slideDown('slow');
							jQuery(".override-options-opposite").slideUp('slow');
						} else {
							jQuery(".override-options").slideUp('slow');
							jQuery(".override-options-opposite").slideDown('slow');
						}
					});
				</script>





<a class="menuitem submenuheader" id="section16" href="#">Long-Form Story Template</a>
<div class="submenu" id="section16body">
	<div class="inside">

		<div class="optionsboxwide" style="margin-top:0px;">
			<p class="subheadingtext">Header/Footer Display Styles</p>
			<p>
				The header and footer styles for long-form templates are set in the Hover Bar section above.
			</p>
			
		</div>
		<div class="optionsboxwide">
			<p class="subheadingtext">Immersive Image Options</p>
				<p>
					<?php sno_select_toggle($settings, 'lf-caption-location', 'bottom-right|Bottom Right,bottom-left|Bottom Left', $default='bottom-right'); ?> Caption Location
				</p>
				<p>
					<?php sno_checkbox($settings, 'lf-show-header', $label='Show header bar on load with immersive photos', $default='Yes'); ?><br />

					<?php sno_color_input($settings, 'lf-story-page-background', $default='#000000'); ?> Page Background Color<br />
					<?php sno_color_input($settings, 'lf-story-page-override-links', $default='#ffffff'); ?> Page Links Color <br />
					<?php sno_color_input($settings, 'lf-story-page-override-text', $default='#ffffff'); ?> Page Text Color <br />
				</p>
		</div>
		<div class="optionsboxwide">
			<p class="subheadingtext">Background and Text Overrides</p>
				<p>
					<?php sno_checkbox($settings, 'lf-story-page-override', $label='Activate Background/Text Overrides', $default='On'); ?>
				</p>
				<p>
					<?php sno_color_input($settings, 'lf-story-page-background', $default='#000000'); ?> Page Background Color<br />
					<?php sno_color_input($settings, 'lf-story-page-override-links', $default='#ffffff'); ?> Page Links Color <br />
					<?php sno_color_input($settings, 'lf-story-page-override-text', $default='#ffffff'); ?> Page Text Color <br />
				</p>
		</div>
		<div class="optionsboxwide">
			<p class="subheadingtext">Headline Display Styles</p>
			<p>
				<?php sno_color_input($settings, 'lf-head-border-color', $default='#393939'); ?> Headline Bottom Border Color<br />
				<?php sno_thickness_selectbox($settings, 'lf-head-border-thickness', 20, $default='5px'); ?> Headline Bottom Border Thickness<br />
			</p>
		</div>
		<div class="optionsboxwide">
			<p class="subheadingtext">Deck Display Styles</p>
			<p>	
				<?php sno_color_input($settings, 'lf-deck-border-color', $default='#393939'); ?> Deck Text and Bottom Border Color<br />
				<?php sno_thickness_selectbox($settings, 'lf-deck-border-thickness', 20, $default='5px'); ?> Deck Bottom Border Thickness
			</p>
			<p>
				<?php sno_select_toggle($settings, 'lf-deck-style', 'normal|Normal,italic|Italics', $default='normal'); ?> Display Style
			</p>
		</div>
		<div class="optionsboxwide">
			<p class="subheadingtext">Byline and Date</p>
				<p>
					<?php sno_select_toggle($settings, 'lf-byline-display', 'Display,Hide', $default='Display'); ?> Byline<br />
				</p>
				<p>
					<?php sno_select_toggle($settings, 'lf-date-display', 'Display,Hide', $default='Display'); ?> Date<br />
				</p>
		</div>
		<div class="optionsboxwide">
			<p class="subheadingtext">Drop Caps Options</p>
			<p>
				<?php sno_select_toggle($settings, 'lf-dropcap-style', 'Normal,Inverted,None', $default='Normal'); ?> Display Style
			</p>

			<div class="dropcap-options">
			<p>
				<?php sno_color_input($settings, 'lf-dropcap-color', $default='#990000'); ?> Background Color
			</p>
			</div>
		</div>
		<div class="optionsboxwide">
			<p class="subheadingtext">Related Stories List</p>
			<p>
 				<?php sno_checkbox($settings, 'lf-other-stories', $label='Display teasers at bottom of page for other stories in same category.', $default='Display'); ?>
			</p>
		</div>
		<script type="text/javascript">
    		jQuery(".lf-dropcap-style").change(function() {
        		(jQuery(this).val() != "None") ? jQuery(".dropcap-options").slideDown('slow') : jQuery(".dropcap-options").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".lf-dropcap-style").val() != "None") ? jQuery(".dropcap-options").slideDown('slow') : jQuery(".dropcap-options").slideUp('slow');
    		});
    	</script>

	<div style="clear:both"></div>
	</div>
</div>


<a class="menuitem submenuheader" id="section17" href="#">Comments on Story Page</a>
<div class="submenu" id="section17body">
	<div class="inside">
	
			<?php $comments = get_theme_mod('comments'); ?>
				<div style="<?php if ($comments != "Enable") { ?>border: 1px solid #c6474e; background: #eb979c;<?php } else { ?>border: 1px solid #85c175; background: #c2e3b9;<?php } ?>padding:10px 10px 0px;margin-bottom:10px;">
				<p class="headingtext">Comments on this site are <?php if ($comments != "Enable") { ?>disabled<?php } else { ?>enabled<?php } ?>.</p>
				</div>

 				<p class="subheadingtext"><?php sno_checkbox($settings, 'comments', $label='Enable comments on this site.', $default='Enable'); ?></p>
			<div class="comments-options">
				<div class="subdivider"></div>
				<p class="subheadingtext">Comment Moderation</p>
				<p>Click on <a href="/wp-admin/options-discussion.php" target="_blank">Discussion under the Settings tab</a> to adjust the default WordPress settings for comments and comment approval.
				</p>
				<div class="subdivider"></div>
				<p class="subheadingtext">Comments Policy</p>
				<p>Any text entered below will be displayed just above the comments box on each story's page.</p>
				<p><textarea id="<?php echo $settings; ?>[comments-policy]" name="<?php echo $settings; ?>[comments-policy]" style="width:540px" rows="6"><?php echo get_theme_mod('comments-policy'); ?></textarea></p>
				<p>
				<?php sno_checkbox($settings, 'story-comments', $label='Collapse Comments Box by Default', $default='Collapse'); ?>
				</p>
		</div>
				<script type="text/javascript">
					jQuery('#comments-ck').change(function() {
   				 		jQuery('.comments-options').slideToggle('slow');
					});
				   	jQuery(document).ready(function() {
						if (jQuery('#comments-ck').prop('checked')) {
							jQuery(".comments-options").slideDown('slow');
						} else {
							jQuery(".comments-options").slideUp('slow');
						}
					});
				</script>
	<div style="clear:both"></div>
	</div>
</div>



<a class="menuitem submenuheader" id="section18" href="#">Category Pages</a>
<div class="submenu" id="section18body">
	<div class="inside">
		<div class="optionsboxwide">
		<p class="headingtext">Category Page Templates</p>
		<p><i>For each main level category that has at least 10 stories assigned to it, you can assign that category to a custom template. If you select "Widget Areas" for a category, click Widgets under the Appearance tab to add content to those widget areas.</i></p>
		<div style="background: #fff;padding: 10px;margin-bottom:10px;border: 1px solid #ddd;">		
			<?php sno_checkbox($settings, 'catpage-include-all', $label='Activate Design Options for Categories with fewer than 10 stories.', $default='on'); ?>
		</div>
		
			<?php $categories = get_categories ( array ( 'orderby' => 'name', 'parent' => 0 ) ); $catlist = array(); 
								
				foreach ($categories as $category) if ($category->count >= 10 || get_theme_mod('catpage-include-all') == 'on') $catlist[$category->term_id] = $category->name; 
				
				foreach ($catlist as $cat_id => $cat_name) {
					if ($cat_name != 'Uncategorized' && $cat_id != get_theme_mod('breaking-hidecat')) {
						echo '<div style="margin-bottom:15px; padding: 10px;background: #fff; border: 1px solid #ddd;">';
						echo "<p class='headingtext'>$cat_name</p>";
						sno_select_toggle($settings, 'cat-template-'.$cat_id, 'Use Default,Preview Tiles,List with Sidebar,Widget Areas', $defualt = 'Use Default');
						echo ' ' . $cat_name . ' ';
						echo "<div style='float:right' class='cat-widget-option-$cat_id'>";
						sno_select_toggle($settings, 'cat-widget-layout-'.$cat_id, 'Option 1,Option 2,Option 3,Option 4,Option 5,Option 6', $defualt = 'Option 3');
						echo ' <i>Widget Configuration (See Above)</i></div>';
						echo '<br /><br />';
						echo '<p>';
						
						sno_checkbox($settings, "cat-header-$cat_id", $label="Activate Custom Header Graphic for $cat_name", $default='on'); 
						echo '</p>';
						echo "<div class='cat-header-activated-$cat_id'>";
						
						echo "<p><input class='upload_image_button-cat-$cat_id button-primary' type='button' value='Click to Upload Custom $cat_name Header' style='margin-bottom:5px;width:100%;'/></p>";
						$current_header = get_theme_mod("cat-$cat_id-header");
						?><input class='upload_image-cat-<?php echo $cat_id; ?>' placeholder='Image URL goes here' type='text' style="width:100%;" name='<?php echo $settings?>[cat-<?php echo $cat_id; ?>-header]' value='<?php echo $current_header; ?>' style='width:240px;' /> </p><?php
						if ($current_header) {
							echo "<p class='headingtext>Current $cat_name Header:</p> <img src='$current_header style='width:200px' />";
						}
						echo '</div>';
						echo '</div><div class="clear"></div>';

						?><script type="text/javascript">
							jQuery(".cat-template-<?php echo $cat_id; ?>").change(function() {
								(jQuery(this).val() == "Widget Areas") ? jQuery(".cat-widget-option-<?php echo $cat_id; ?>").show() : jQuery(".cat-widget-option-<?php echo $cat_id; ?>").hide();
    						});
							jQuery(document).ready(function() {
								(jQuery(".cat-template-<?php echo $cat_id; ?>").val() == "Widget Areas") ? jQuery(".cat-widget-option-<?php echo $cat_id; ?>").show() : jQuery(".cat-widget-option-<?php echo $cat_id; ?>").hide();
    						});

							jQuery('#cat-header-<?php echo $cat_id; ?>-ck').change(function() {
								jQuery('.cat-header-activated-<?php echo $cat_id; ?>').slideToggle('slow');
							});
							jQuery(document).ready(function() {
								if (jQuery('#cat-header-<?php echo $cat_id; ?>-ck').prop('checked')) {
									jQuery(".cat-header-activated-<?php echo $cat_id; ?>").slideDown('slow');
								} else {
									jQuery(".cat-header-activated-<?php echo $cat_id; ?>").slideUp('slow');
								}
							});

							jQuery(document).ready(function() {
								jQuery('.upload_image_button-cat-<?php echo $cat_id; ?>').click(function() {
									formfield = jQuery(this).prev('.upload_image-cat-<?php echo $cat_id; ?>');
									tb_show('', 'media-upload.php?type=image&TB_iframe=true');
									window.send_to_editor = function(html) {
										if (jQuery(html).is("a")) {
											var imgurl = jQuery('img', html).attr('src');
										} else if (jQuery(html).is("img")) {
											var imgurl = jQuery(html).attr('src');
										}
										jQuery('.upload_image-cat-<?php echo $cat_id; ?>').val(imgurl);
										tb_remove();
									}
									return false;
								});
							});
							
    					</script><?php
    					
    				

					}
				}
								
				 ?>
				
				<?php update_option('sno_active_cats', $catlist); ?>
		</div>
		<p class="subheadingtext" style="margin-top:20px;">Style for default category list and tile views</p>
		<p><?php sno_select_toggle($settings, 'catpage', 'Preview Tiles,List with Sidebar', $default='Preview Tiles'); ?></p>
				<p>
					<?php sno_color_input($settings, 'catpage-background', $default='#ffffff'); ?> Page Background<br />
				</p>
		<p>		
			<?php sno_checkbox($settings, 'catpage-videos', $label='Hide Videos on Category Pages', $default='Off'); ?>
		</p>

			<div class="category-options">

				<div class="subdivider"></div>

 				<p><?php sno_checkbox($settings, 'catpage-photo', $label='Allow Vertical Photos', $default='Allow Vertical'); ?></p>
				<p>
					<?php sno_color_input($settings, 'catpage-tile-background', $default='#ffffff'); ?> Preview Tile Background<br />
				</p>
				<p>
					<?php sno_color_input($settings, 'catpage-tile-border', $default='#eeeeee'); ?> Preview Tile Border<br />
				</p>
				<p>
					<?php sno_select_toggle($settings, 'catpage-tile-height', '160px,180px,200px,220px,240px,260px,280px,300px,320px,340px,360px,380px,400px,420px,440px,460px,480px,500px,520px,540px,560px,580px,600px', $default='280px'); ?> Preview Tile Height
				</p>
				<p>
					<?php sno_select_toggle($settings, 'catpage-headline', 'Display,Hide', $default='Display'); ?> Headline (when a photo or video is displayed)
				</p>
				<p>
					<?php sno_select_toggle($settings, 'catpage-date', 'Display,Hide', $default='Display'); ?> Date
				</p>
				<p>
					<?php sno_select_toggle($settings, 'catpage-cat', 'Display,Hide', $default='Normal'); ?> Category Name
				</p>
				<p>
					<?php sno_select_toggle($settings, 'catpage-teaser', '0,100,125,150,175,200,225,250,275,300,325,350,375,400,425,450,475,500,525,550,575,600', $default='0'); ?> Teaser Length (in characters)
				</p>


			</div>

 				<p><?php sno_checkbox($settings, 'catpage-pagination', $label='Hide Pagination on First Page of Widget-Based Category Pages', $default='Hide'); ?></p>
	</div>

		<div class="optionsboxwide">
			<p class="subheadingtext">Text Color Overrides</p>
				<p>
					<?php sno_checkbox($settings, 'catpage-override', $label='Activate Text Overrides', $default='On'); ?>
				</p>
				<div class="catpage-override-options">
					<p>
						<?php sno_color_input($settings, 'catpage-override-links', $default='#ffffff'); ?> Links Color <br />
						<?php sno_color_input($settings, 'catpage-override-text', $default='#ffffff'); ?> Text Color <br />
					</p>
				</div>
		</div>

		<script type="text/javascript">
    		jQuery(".catpage").change(function() {
        		(jQuery(this).val() == "Preview Tiles") ? jQuery(".category-options").slideDown('slow') : jQuery(".category-options").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".catpage").val() == "Preview Tiles") ? jQuery(".category-options").slideDown('slow') : jQuery(".category-options").slideUp('slow');
    		});

					jQuery('#catpage-override-ck').change(function() {
   				 		jQuery('.catpage-override-options').slideToggle('slow');
					});
				   	jQuery(document).ready(function() {
						if (jQuery('#catpage-override-ck').prop('checked')) {
							jQuery(".catpage-override-options").slideDown('slow');
						} else {
							jQuery(".catpage-override-options").slideUp('slow');
						}
					});
				</script>

	<div style="clear:both"></div>
</div>





<a class="menuitem submenuheader" id="section19" href="#">Staff Page</a>
<div class="submenu" id="section19body">
	<div class="inside">

		<p class="subheadingtext">Select a Style for the Staff Page</p>
		<?php sno_select_toggle($settings, 'staffpage', 'Photo Blocks,Profile Preview,List', $default='Profile Preview'); ?>
		</p> 
		
		<div id="photoblock-options">
			<p>
				<?php sno_select_toggle($settings, 'photoblock-margin', '0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20', $default='1'); ?> Margin Between Blocks
			</p>
			<p>
				<?php sno_select_toggle($settings, 'photoblock-ratio', '2:1 Horizontal,3:2 Horizontal,Square,2:3 Vertical', $default='3:2 Horizontal'); ?> Photo Size Ratio
			</p>
			<p>
				<?php sno_select_toggle($settings, 'photoblock-columns', '1,2,3,4,5,6', $default='5'); ?> Number of Columns
			</p>
		</div>
		<p>
			<?php sno_color_input($settings, 'staffpage-background', $default='#ffffff'); ?> Page Background<br />
		</p>
		<p>
			<?php $staffpage_custom_label = get_theme_mod('staffpage-custom-label'); ?>
			<input type="text" name="<?php echo $settings; ?>[staffpage-custom-label]" value="<?php echo $staffpage_custom_label; ?>" size="20"/> Staff Page Custom Label (replaces the text "School Year")
		</p>
			<div class="staff-options">
				<div class="subdivider"></div>
 				<p><?php sno_checkbox($settings, 'staffpage-photo', $label='Allow Vertical Photos', $default='Full Size'); ?></p>

				<p>
					<?php sno_select_toggle($settings, 'staffpage-box-height', '200px,225px,250px,275px,300px,325px,350px,375px,400px,425px,450px,475px,500px,525px,550px,575px,600px', $default='400px'); ?> Height for Profile Preview Boxes
				</p>
				<p>
					<?php sno_select_toggle($settings, 'staffpage-teaser', '0,100,125,150,175,200,225,250,275,300,325,350,375,400', $default='225'); ?> Teaser Length (in characters)
				</p>

 				<p>
					<?php sno_select_toggle($settings, 'staffpage-name', 'Display,Hide', $default='Display'); ?> Display Name and Staff Position below Photo
 				</p>

				<p>
					<?php sno_color_input($settings, 'staffpage-tile-background', $default='#ffffff'); ?> Preview Tile Background<br />
				</p>
				<p>
					<?php sno_color_input($settings, 'staffpage-tile-border', $default='#eeeeee'); ?> Preview Tile Border<br />
				</p>
			</div>
			
		<div class="optionsboxwide">
			<p class="subheadingtext">Text Color Overrides</p>
				<p>
					<?php sno_checkbox($settings, 'staffpage-override', $label='Activate Text Overrides', $default='On'); ?>
				</p>
				<div class="staffpage-override-options">
					<p>
						<?php sno_color_input($settings, 'staffpage-override-links', $default='#ffffff'); ?> Links Color <br />
						<?php sno_color_input($settings, 'staffpage-override-text', $default='#ffffff'); ?> Text Color <br />
					</p>
				</div>
		</div>
			
		<script type="text/javascript">
   			jQuery(document).ready(function() {
        		(jQuery(".staffpage").val() == "Photo Blocks") ? jQuery("#photoblock-options").slideDown('slow') : jQuery("#photoblock-options").slideUp('slow');
    		});
    		jQuery(".staffpage").change(function() {
        		(jQuery(this).val() == "Photo Blocks") ? jQuery("#photoblock-options").slideDown('slow') : jQuery("#photoblock-options").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".staffpage").val() == "Profile Preview") ? jQuery(".staff-options").slideDown('slow') : jQuery(".staff-options").slideUp('slow');
    		});
    		jQuery(".staffpage").change(function() {
        		(jQuery(this).val() == "Profile Preview") ? jQuery(".staff-options").slideDown('slow') : jQuery(".staff-options").slideUp('slow');
    		});
					jQuery('#staffpage-override-ck').change(function() {
   				 		jQuery('.staffpage-override-options').slideToggle('slow');
					});
				   	jQuery(document).ready(function() {
						if (jQuery('#staffpage-override-ck').prop('checked')) {
							jQuery(".staffpage-override-options").slideDown('slow');
						} else {
							jQuery(".staffpage-override-options").slideUp('slow');
						}
					});
    	</script>
		
		<div class="subdivider"></div>
		<p>
			<?php sno_select_toggle($settings, 'staffpage-width', '22|25%,30|30%,35|35%,40|40%', $default='30'); ?> Width of Profile Picture on Individual Profiles 
		</p>
 		<p><?php sno_checkbox($settings, 'staffpage-exclude', $label='Exclude photos and videos', $default='exclude'); ?></p>
 		<p><?php sno_checkbox($settings, 'staffpage-disable-caching', $label='Disable Staff Page Caching', $default='Disable'); ?></p>
 		<p><?php sno_checkbox($settings, 'staffpage-require-profiles', $label='Require Staff Profiles before generating linked bylines', $default='Require'); ?></p>
 		<p><?php sno_checkbox($settings, 'staffpage-custom', $label='Use custom breakdown for staff page', $default='Activate'); ?></p>

 		<p class="staffpage-custom-show"><?php 	$years = sno_staff_organization_list(); $years_list = ''; $current_year = sno_current_schoolyear(); 
	 				foreach ($years as $year) {
		 				if ($years_list) $years_list .= ',';
		 				$years_list .= $year;
	 				}
	 				sno_select_toggle($settings, 'staffpage-year', $years_list, $default = $current_year); ?> Select the group for the current staff page.
  		</p>
  		<p class="staffpage-custom-show"><i>To have custom groups added to your options for staff pages, please submit a <a target="_blank" href='https://sno.zendesk.com/anonymous_requests/new'>support request</a>.</i></p>
		<p class="staffpage-custom-hide">
			<?php sno_select_toggle($settings, 'staff-reset', '01|January,02|February,03|March,04|April,05|May,06|June,07|July,08|August,09|September,10|October,11|November,12|December', $default='07'); ?> Start new school year at which month? 
		</p>
		<script type="text/javascript">
					jQuery('#staffpage-custom-ck').change(function() {
   				 		jQuery('.staffpage-custom-show').slideToggle('slow');
   				 		jQuery('.staffpage-custom-hide').slideToggle('slow');
					});
				   	jQuery(document).ready(function() {
						if (jQuery('#staffpage-custom-ck').prop('checked')) {
							jQuery(".staffpage-custom-show").slideDown('slow');
							jQuery(".staffpage-custom-hide").slideUp('slow');
						} else {
							jQuery(".staffpage-custom-show").slideUp('slow');
							jQuery(".staffpage-custom-hide").slideDown('slow');
						}
					});
    	</script>

	<div style="clear:both"></div>
	</div>
</div>


<a class="menuitem submenuheader" id="section20" href="#">SNO Sports Center Page Add-on</a>
<div class="submenu" id="section20body">
	<div class="inside">

<?php $sccheck = get_option('ssno'); if ($sccheck == "ssno928462s") { ?>
	
	<div class="optionsbox">
	
 			<p><?php sno_checkbox($settings, 'sports-stories-scrollbox', $label='Display Featured Sports Carousel', $default='Display'); ?></p>
			<div class="optionsboxdetail" id="sports-details">				
				<p class="subheadingtext">Carousel Options</p>
				<p>Category to be Displayed</p>
				<?php $sscat = get_theme_mod('sports-scrollbox-cat'); if ($sscat == '') $sscat = 6; ?>
                 <?php wp_dropdown_categories(array('selected' => $sscat, 'name' => $settings.'[sports-scrollbox-cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?>
                </p>
				
				<p>
					<?php sno_select_toggle($settings, 'sports-count', '1,2,3,4,5,6,7,8,9,10', $default='3'); ?> Number of Stories
				</p>
	 			<p><?php sno_checkbox($settings, 'sports-scroll-teaser', $label='Display Headline', $default='Show'); ?></p>
			</div>
				<script type="text/javascript">
					jQuery('#sports-stories-scrollbox-ck').change(function() {
   				 		jQuery('#sports-details').slideToggle('slow');
					});
				   	jQuery(document).ready(function() {
						if (jQuery('#sports-stories-scrollbox-ck').prop('checked')) {
							jQuery("#sports-details").slideDown('slow');
						} else {
							jQuery("#sports-details").slideUp('slow');
						}
					});
				</script>
			<div class="subdivider"></div>
				<p>
				<?php $recentresults = get_theme_mod('recent-results'); if ($recentresults == '') $recentresults = 20; ?>
				 <input type="text" name="<?php echo $settings; ?>[recent-results]" value="<?php echo $recentresults; ?>" size="2" /> Number of Results to Display<br />

				<?php $upcominggames = get_theme_mod('upcoming-games'); if ($upcominggames == '') $upcominggames = 20; ?>
				 <input type="text" name="<?php echo $settings; ?>[upcoming-games]" value="<?php echo $upcominggames; ?>" size="2" /> Number of Upcoming Games
				 
				 </p>

				<p>
					<?php sno_select_toggle($settings, 'sports-reset', '01|January,02|February,03|March,04|April,05|May,06|June,07|July,08|August,09|September,10|October,11|November,12|December', $default='07'); ?> Reset Month
				</p>
	 			<p><?php sno_checkbox($settings, 'sports-roster-links', $label='Open Roster Links in New Tab', $default='Yes'); ?></p>

				 </div>
				 
				 <div class="optionsboxright">
				<p class="headingtext">Sports Center Page Widgets</p>
				<p>Add content to the right sidebar of the Sports Center page by using the <a href="/wp-admin/widgets.php" target="_blank">Widget Interface</a> and adding widgets to the Sports Center Sidebar </p>
				<p>Included with the Sports Center package are three widgets that you can add to any homepage column: Standings, Schedules, and Score Scrollbox.</p>

				</div>
<?php } else { ?>
<div class="optionsboxright" style="width:555px">
<p><a href="http://www.schoolnewspapersonline.com/add-on-features/sports-center/" target="_blank">Click here</a> to learn more about ordering the Sports Center add-on package.</p>
</div>
<?php } ?>
	<div style="clear:both"></div>
	
	
	</div>
</div>



<?php $acheck = get_option('asno'); if ($acheck == "asno836158a") { ?>

<a class="menuitem submenuheader" id="section21" href="#" >SNO A&E Section Page Add-on</a>
<div class="submenu" id="section21body">
	<div class="inside">
     
     <div class="optionsboxright" style="width:555px">
                        

					<p class="headingtext">A&E Page Categories
					</p>                        
					
					<p>
						<?php wp_dropdown_categories(array('selected' => get_theme_mod('ae-featured'), 'name' => $settings.'[ae-featured]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?> A&E Page Featured Category
					</p>
					
					<p>
						<?php wp_dropdown_categories(array('selected' => get_theme_mod('ae-cat3'), 'name' => $settings.'[ae-cat3]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?>
					
						<?php sno_select_toggle($settings, 'ae-cat3-count', '0,1,2,3,4,5,6,7,8,9,10', $default='3'); ?> A&E Top Right Category and Count
					</p>


                   	<p>
                   		<?php wp_dropdown_categories(array('selected' => get_theme_mod('ae-cat1'), 'name' => $settings.'[ae-cat1]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?>

						<?php sno_select_toggle($settings, 'ae-cat1-count', '0,1,2,3,4,5,6,7,8,9,10', $default='3'); ?> A&E Bottom Left Category and Count
					</p>

                    <p>
                    	<?php wp_dropdown_categories(array('selected' => get_theme_mod('ae-cat2'), 'name' => $settings.'[ae-cat2]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?>
						<?php sno_select_toggle($settings, 'ae-cat2-count', '0,1,2,3,4,5,6,7,8,9,10', $default='3'); ?> A&E Bottom Center Category and Count
					</p>

                    <p>
                    	<?php wp_dropdown_categories(array('selected' => get_theme_mod('ae-cat4'), 'name' => $settings.'[ae-cat4]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?>
						<?php sno_select_toggle($settings, 'ae-cat4-count', '0,1,2,3,4,5,6,7,8,9,10', $default='3'); ?> A&E Bottom Right Category and Count
					</p>

	</div>
	<div style="clear:both"></div>
	</div>
</div>

<?php } ?>	

<a class="menuitem submenuheader" id="section22" href="#">SNO Multimedia Package Add-on</a>
<div class="submenu" id="section22body">
		<div class="inside">
                        

		<div class="optionsbox">
				<p class="headingtext">Home Video Display Options</p>
				<p>This option allows you to create a video display at the top of the homepage -- this is designed to be used in place of the Showcase Carousel.</p>
					<p><?php sno_checkbox($settings, 'mm-home', $label='Display Homepage Video Carousel', $default='Display'); ?></p>
					

				<div id="video-home">
	    			<p>Video Category to Display <br />
					<?php $mmhomecat = get_theme_mod('mm-home-cat'); if ($mmhomecat == '') $mmhomecat = 12; ?>

    				<?php wp_dropdown_categories(array('selected' => $mmhomecat, 'name' => $settings.'[mm-home-cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?>
					</p>

					<p>Number of Videos to Display <br />
						<?php sno_select_toggle($settings, 'mm-home-count', '5,6,7,8,9,10,15,20', $default='8'); ?> 
					</p>
					<div class="optionsboxdetail">
					<p class="subheadingtext">Style Options</p>
					<p>
					<?php sno_color_input($settings, 'mm-home-border', $default='#eeeeee'); ?> Border Color<br />
					<?php sno_color_input($settings, 'mm-home-arrowbar', $default='#dddddd'); ?> Arrow Bar Color<br />
					<?php sno_color_input($settings, 'mm-home-background-right', $default='#ffffff'); ?> Right Background<br />
					<?php sno_color_input($settings, 'mm-home-background-left', $default='#ffffff'); ?> Left Background<br />
					</p>
					<p><?php sno_checkbox($settings, 'mm-home-shadow', $label='Drop Shadow', $default='On'); ?></p>
					</div>
				</div>
				<script type="text/javascript">
					jQuery('#mm-home-ck').change(function() {
   				 		jQuery('#video-home').slideToggle('slow');
					});
				   	jQuery(document).ready(function() {
						if (jQuery('#mm-home-ck').prop('checked')) {
							jQuery("#video-home").slideDown('slow');
						} else {
							jQuery("#video-home").slideUp('slow');
						}
					});
				</script>
		
		</div> 

		<div class="optionsboxright">

				<p class="headingtext">Video Page Options</p>
			
				<p>Your Video page will automatically display the video added in the Video custom field for any story from the category selected below.
				</p>

    			<p>Video Page Category: <br />
				<?php $mmcat = get_theme_mod('mm-video'); if ($mmcat == '') $mmcat = 12; ?>

    				<?php wp_dropdown_categories(array('selected' => $mmcat, 'name' => $settings.'[mm-video]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?>
				</p>

				<p>Max Number of Videos on Video Page<br />
						<?php sno_select_toggle($settings, 'mm-video-count', '5,10,15,20,25,30', $default='15'); ?> 
				</p>

				<br />
				<p class="headingtext">Slideshow Page Options
				</p>                   

				<p>Any story with the Slideshow option selected for Featured Image Location will automatically appear on your Slideshow Page.
				</p>

				<p>Max Number of Slideshows to Include<br />
						<?php sno_select_toggle($settings, 'mm-slideshow-count', '5,10,15,20,25,30', $default='15'); ?> 
				</p>
				<br />
				<p class="headingtext">Multimedia Page Appearance</p>

					<?php sno_color_input($settings, 'mm-borders', $default='#ffffff'); ?> Page Borders<br /><br />
	


</div>


<div style="clear:both"></div>		
		
		</div>	
</div>






<?php if (get_option('qsno') == "qsno785643q") { ?>

<a class="menuitem submenuheader" id="section14a" href="#">SNO Quick Look Add-On</a>
<div class="submenu" id="section14bodya">
	<div class="inside">

<div class="optionsbox">
<p class="headingtext">Header Text</p>

<p>
 <select name="<?php echo $settings; ?>[quick-activate]">
					<option style="padding-right:10px;" value="On" <?php selected('On', get_theme_mod('quick-activate')); ?>><?php _e("On", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Off" <?php selected('Off', get_theme_mod('quick-activate')); ?>><?php _e("Off", 'sno'); ?></option>
</select> Quick Look Menu<br />
</p>
				<p>
				<select name="<?php echo $settings; ?>[quick-type-1]">
					<option style="padding-right:10px;" value="Story Category" <?php selected('Story Category', get_theme_mod('quick-type-1')); ?>><?php _e("Story Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Video Category" <?php selected('Video Category', get_theme_mod('quick-type-1')); ?>><?php _e("Video Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Upcoming Games" <?php selected('Upcoming Games', get_theme_mod('quick-type-1')); ?>><?php _e("Upcoming Games", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Recent Results" <?php selected('Recent Results', get_theme_mod('quick-type-1')); ?>><?php _e("Recent Results", 'sno'); ?></option>
				</select> Tab 1<br />
				</p>


				<p>
				Quick Look Category #1<br />
                 <?php wp_dropdown_categories(array('selected' => get_theme_mod('quick-cat-1'), 'name' => $settings.'[quick-cat-1]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?>
                 </p>
				<p>
				<select name="<?php echo $settings; ?>[quick-type-2]">
					<option style="padding-right:10px;" value="Story Category" <?php selected('Story Category', get_theme_mod('quick-type-2')); ?>><?php _e("Story Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Video Category" <?php selected('Video Category', get_theme_mod('quick-type-2')); ?>><?php _e("Video Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Upcoming Games" <?php selected('Upcoming Games', get_theme_mod('quick-type-2')); ?>><?php _e("Upcoming Games", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Recent Results" <?php selected('Recent Results', get_theme_mod('quick-type-2')); ?>><?php _e("Recent Results", 'sno'); ?></option>
				</select>
				</p>

				<p>
				Quick Look Category #2<br />
                 <?php wp_dropdown_categories(array('selected' => get_theme_mod('quick-cat-2'), 'name' => $settings.'[quick-cat-2]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?>
                 </p>
                 
				<p>
				<select name="<?php echo $settings; ?>[quick-type-3]">
					<option style="padding-right:10px;" value="Story Category" <?php selected('Story Category', get_theme_mod('quick-type-3')); ?>><?php _e("Story Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Video Category" <?php selected('Video Category', get_theme_mod('quick-type-3')); ?>><?php _e("Video Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Upcoming Games" <?php selected('Upcoming Games', get_theme_mod('quick-type-3')); ?>><?php _e("Upcoming Games", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Recent Results" <?php selected('Recent Results', get_theme_mod('quick-type-3')); ?>><?php _e("Recent Results", 'sno'); ?></option>
				</select>
				</p>

				<p>
				Quick Look Category #3<br />
                 <?php wp_dropdown_categories(array('selected' => get_theme_mod('quick-cat-3'), 'name' => $settings.'[quick-cat-3]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?>
                 </p>

				<p>
				<select name="<?php echo $settings; ?>[quick-type-4]">
					<option style="padding-right:10px;" value="Story Category" <?php selected('Story Category', get_theme_mod('quick-type-4')); ?>><?php _e("Story Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Video Category" <?php selected('Video Category', get_theme_mod('quick-type-4')); ?>><?php _e("Video Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Upcoming Games" <?php selected('Upcoming Games', get_theme_mod('quick-type-4')); ?>><?php _e("Upcoming Games", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Recent Results" <?php selected('Recent Results', get_theme_mod('quick-type-4')); ?>><?php _e("Recent Results", 'sno'); ?></option>
				</select>
				</p>

				<p>
				Quick Look Category #4<br />
                 <?php wp_dropdown_categories(array('selected' => get_theme_mod('quick-cat-4'), 'name' => $settings.'[quick-cat-4]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?>
                 </p>

				<p>
				<select name="<?php echo $settings; ?>[quick-type-5]">
					<option style="padding-right:10px;" value="Story Category" <?php selected('Story Category', get_theme_mod('quick-type-5')); ?>><?php _e("Story Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Video Category" <?php selected('Video Category', get_theme_mod('quick-type-5')); ?>><?php _e("Video Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Upcoming Games" <?php selected('Upcoming Games', get_theme_mod('quick-type-5')); ?>><?php _e("Upcoming Games", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Recent Results" <?php selected('Recent Results', get_theme_mod('quick-type-5')); ?>><?php _e("Recent Results", 'sno'); ?></option>
				</select>
				</p>

				<p>
				Quick Look Category #5<br />
                 <?php wp_dropdown_categories(array('selected' => get_theme_mod('quick-cat-5'), 'name' => $settings.'[quick-cat-5]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?>
                 </p>

				<p>
				<select name="<?php echo $settings; ?>[quick-type-6]">
					<option style="padding-right:10px;" value="Story Category" <?php selected('Story Category', get_theme_mod('quick-type-6')); ?>><?php _e("Story Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Video Category" <?php selected('Video Category', get_theme_mod('quick-type-6')); ?>><?php _e("Video Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Upcoming Games" <?php selected('Upcoming Games', get_theme_mod('quick-type-6')); ?>><?php _e("Upcoming Games", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Recent Results" <?php selected('Recent Results', get_theme_mod('quick-type-6')); ?>><?php _e("Recent Results", 'sno'); ?></option>
				</select>
				</p>

				<p>
				Quick Look Category #6<br />
                 <?php wp_dropdown_categories(array('selected' => get_theme_mod('quick-cat-6'), 'name' => $settings.'[quick-cat-6]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?>
                 </p>

				<p>
				<select name="<?php echo $settings; ?>[quick-type-7]">
					<option style="padding-right:10px;" value="Story Category" <?php selected('Story Category', get_theme_mod('quick-type-7')); ?>><?php _e("Story Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Video Category" <?php selected('Video Category', get_theme_mod('quick-type-7')); ?>><?php _e("Video Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Upcoming Games" <?php selected('Upcoming Games', get_theme_mod('quick-type-7')); ?>><?php _e("Upcoming Games", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Recent Results" <?php selected('Recent Results', get_theme_mod('quick-type-7')); ?>><?php _e("Recent Results", 'sno'); ?></option>
				</select>
				</p>

				<p>
				Quick Look Category #7<br />
                 <?php wp_dropdown_categories(array('selected' => get_theme_mod('quick-cat-7'), 'name' => $settings.'[quick-cat-7]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?>
                 </p>

				<p>
				<select name="<?php echo $settings; ?>[quick-type-8]">
					<option style="padding-right:10px;" value="Story Category" <?php selected('Story Category', get_theme_mod('quick-type-8')); ?>><?php _e("Story Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Video Category" <?php selected('Video Category', get_theme_mod('quick-type-8')); ?>><?php _e("Video Category", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Upcoming Games" <?php selected('Upcoming Games', get_theme_mod('quick-type-8')); ?>><?php _e("Upcoming Games", 'sno'); ?></option>
					<option style="padding-right:10px;" value="Recent Results" <?php selected('Recent Results', get_theme_mod('quick-type-8')); ?>><?php _e("Recent Results", 'sno'); ?></option>
				</select>
				</p>

				<p>
				Quick Look Category #8<br />
                 <?php wp_dropdown_categories(array('selected' => get_theme_mod('quick-cat-8'), 'name' => $settings.'[quick-cat-8]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'sno'), 'hide_empty' => '0' )); ?>
                 </p>

</div>
	<div style="clear:both"></div>
	</div>
</div>
<?php } ?>

</div><!--end of fourth section-->







</div>
</div>

	<div class="metabox-holder" style="width:200px">

		<div id="snocolorpicker"></div>
		<div class="savebutton">
			<input type="submit" class="button-primary save-button" value="<?php _e('Save All Settings') ?>" />
		</div>
	</div>        
    </div>
	</form>

</div>
<?php }

// add CSS and JS if necessary
function theme_options_css_js() {
echo <<<CSS

<style type="text/css">
	.metabox-holder { 
		width: 350px; float: left;
		margin: 0px; padding: 0px 10px 0px 0px;
	}
	.metabox-holder .postbox .inside {
		padding: 0px 10px 0px 10px;
	}
</style>

CSS;
echo <<<JS

<script type="text/javascript">
jQuery(document).ready(function($) {
	$(".fade").fadeIn(1000).fadeTo(1000, 1).fadeOut(1000);
});

</script>

JS;
}
?>