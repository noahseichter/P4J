<?php
function sno_google_sans_fonts() { $fontlist = '
Abel
Actor
Antic
Arimo
Asap
Belleza
Cabin
Cantarell
Carme
Chivo
Coda
Didact Gothic
Doppio One
Dosis
Droid Sans
Erica One
Exo
Francois One
Gruppo
Gudea
Istok Web
Karla
Lato
Mako
Metrophobic
Montserrat
Muli
News Cycle 
Nobile
Numans
Open Sans
Open Sans Condensed
Oswald
Oxygen
PT Sans
PT Sans Narrow
Play
Poiret One
Pontano Sans
Questrial
Raleway
Roboto
Roboto Slab
Roboto Condensed
Ropa Sans
Rosario
Signika Negative
Squada One
Telex
Tenor Sans
Ubuntu
Varela
Voltaire';
	return $fontlist;
}

function sno_google_serif_fonts() { $fontlist = '
Adamina
Alegreya
Amethysta
Andada
Average
Balthazar
Belgrano
Brawler
Buenard
Cardo
Caudex
Crete Round
Della Respira
Droid Serif
Estaban
Fanwood Text
Fjord One
Forum
Gentium Basic
Glegoo
Hollywood One SC
Judson
Junge
Kameron
Kotta One
Kreon
Linden Hill
Lusitana
Lustria
Mate
Merriweather
Montaga
Neuton
Nixie One
Ovo
PT Serif
Playfair Display
Prociono
Quattrocento
Rokkitt
Rosarivo
Shanti
Simonetta
Sorts Mill Goudy
Trocchi
Ultra
Unna
Volkhorn';
	return $fontlist;
}

function sno_google_script_fonts() { $fontlist = '
Alex Brush
Allura
Bilbo Swash Caps
Covered By Your Grace
Italianno
Julee
Kaushan Script
Mrs Sheppards
Nothing You Could Do
Paprika
Permanent Marker
Pinyon Script
Rock Salt
Sansita One
Tangerine';
	return $fontlist;
}

function sno_font_selectbox($settings, $location) {
				echo '<select name="' . $settings . '['.$location.']">';

				sno_standard_fonts($settings, $location);
				
				$fonts = sno_google_sans_fonts();
				$fonts = explode ("\n", $fonts);
				
				echo '<option> -- Google Sans Serif Web Fonts -- </option>';

				foreach ($fonts as $font) {
					$font = trim($font);
					echo '<option value="' . $font . '" ';
						if ($font == get_theme_mod($location)) echo 'selected="selected"';
						echo '>' . $font . '</option>'; 					
				
				}
				
				$fonts = sno_google_serif_fonts();
				$fonts = explode ("\n", $fonts);
				echo '<option></option>';
				echo '<option> -- Google Serif Web Fonts -- </option>';

				foreach ($fonts as $font) {
					$font = trim($font);
					echo '<option value="' . $font . '" ';
						if ($font == get_theme_mod($location)) echo 'selected="selected"';
						echo '>' . $font . '</option>'; 					
				
				}

				$fonts = sno_google_script_fonts();
				$fonts = explode ("\n", $fonts);
				echo '<option></option>';
				echo '<option> -- Google Script Web Fonts -- </option>';

				foreach ($fonts as $font) {
					$font = trim($font);
					echo '<option value="' . $font . '" ';
						if ($font == get_theme_mod($location)) echo 'selected="selected"';
						echo '>' . $font . '</option>'; 					
				
				}
				
				$fonts = get_theme_mod('add-font');
				$fonts = explode ("\n", $fonts);
				echo '<option></option>';
				echo '<option> -- Google Fonts You Added -- </option>';

				foreach ($fonts as $font) {
					$font = trim($font);
					echo '<option value="' . $font . '" ';
						if ($font == get_theme_mod($location)) echo 'selected="selected"';
						echo '>' . $font . '</option>'; 					
				
				}
									
				echo '</select>';
}
function sno_standard_fonts ($settings, $location){
	$selectedfont = get_theme_mod($location); if ($selectedfont=='') $selectedfont = 'Arial, sans-serif';
					echo '<option> -- Standard Web Fonts -- </option>';
					echo '<option></option>';
                    echo '<option value="Arial, sans-serif" ';
                    	 if ('Arial, sans-serif' == $selectedfont) echo 'selected="selected"';
                    	 echo '>Arial</option>';
                    echo '<option value="Arial Black, sans-serif" ';
                    	 if ('Arial Black, sans-serif' == $selectedfont) echo 'selected="selected"';
                    	 echo '>Arial Black</option>';
                    echo '<option value="Georgia, serif" ';
                    	 if ('Georgia, serif' == $selectedfont) echo 'selected="selected"';
                    	 echo '>Georgia</option>';
                    echo '<option value="Lucida Sans Unicode, Lucida Grande, sans-serif" ';
                    	 if ('Lucida Sans Unicode, Lucida Grande, sans-serif' == $selectedfont) echo 'selected="selected"';
                    	 echo '>Lucida</option>';
                    echo '<option value="Tahoma, Geneva, sans-serif" ';
                    	 if ('Tahoma, Geneva, sans-serif' == $selectedfont) echo 'selected="selected"';
                    	 echo '>Tahoma</option>';
                    echo '<option value="Times New Roman, Times, serif" ';
                    	 if ('Times New Roman, Times, serif' == $selectedfont) echo 'selected="selected"';
                    	 echo '>Times New Roman</option>';
                    echo '<option value="Verdana, Geneva, sans-serif" ';
                    	 if ('Verdana, Geneva, sans-serif' == $selectedfont) echo 'selected="selected"';
                    	 echo '>Verdana</option>';
                    echo '<option></option>';
}

function sno_pattern_selectbox($settings, $location, $default=null) {
	$patternselect = get_theme_mod($location); if ($patternselect == '') $patternselect = $default;		
				echo '<select name="' . $settings . '['.$location.']">';
				
				$patterns = sno_pattern_list();
				$patterns = explode (";", $patterns);
				
				foreach ($patterns as $pattern) {
					
					$pattern = explode(",", $pattern);

					if ($pattern[1] == "none") {
						echo '<option style="padding-right:30px; background: #fff" value="' . $pattern[1] . '" ';
					} else {
						echo '<option style="padding-right:30px; background: #fff url(' . get_bloginfo("template_url") . '/images/' . $pattern[1] . ') repeat" value="' . $pattern[1] . '" ';
					}
						if ($pattern[1] == $patternselect) echo 'selected="selected"';
						echo '>' . $pattern[0] . '</option>'; 					
				
				}
				
				echo '</select>';

}

function sno_widget_pattern_selectbox($selectid, $selectname, $value, $location) {

				echo '<select id="'.$selectid.'" name="'.$selectname.'['.$location.']">';
				
				$patterns = sno_pattern_list();
				$patterns = explode (";", $patterns);
				
				foreach ($patterns as $pattern) {
					
					$pattern = explode(",", $pattern);

					if ($pattern[1] == "none") {
						echo '<option style="padding-right:30px; background: #fff" value="' . $pattern[1] . '" ';
					} else {
						echo '<option style="padding-right:30px; background: #fff url(' . get_bloginfo("template_url") . '/images/' . $pattern[1] . ') repeat" value="' . $pattern[1] . '" ';
					
					}


						if ($pattern[1] == $value) echo 'selected="selected"';
						echo '>' . $pattern[0] . '</option>'; 					
				
				}
				
				echo '</select>';
}

function sno_pattern_list() { 
	$patternlist = 'none,none;Boxes,boxes.png;Diagonals,diagonals.png;Vertical,vertical.png;Stripes 1,stripes1.png;Stripes 2,stripes2.png;Stripes 3,stripes3.png;Texture 1,texture.png;Texture 2,texture4.png;Dots,dots.png';
	return $patternlist;
}

function sno_thickness_selectbox($settings, $location, $max, $default=null) {
	$selectvalue = get_theme_mod($location); if ($selectvalue == '') $selectvalue = $default;
				
				echo '<select name="' . $settings . '['.$location.']">';
				
				$thicknesses = '0,1,2,3,4,5,6,7,8,9,10,15,20,25,30,35,40';
				$thicknesses = explode (",", $thicknesses);
				
				foreach ($thicknesses as $thickness) {
					
					if ($thickness <= $max) {
					
						$width = $thickness . 'px';
					
						echo '<option style="padding-right:10px" value="' . $width . '" ';
							if ($width == $selectvalue) echo 'selected="selected"';
							echo '>' . $width . '</option>'; 					
					
					}
				}
				
				echo '</select>';
}

function sno_color_input($settings, $location, $default=null) {
	$colorvalue = get_theme_mod($location); if ($colorvalue == '') $colorvalue = $default; 				
	echo '<input type="text" id="'.$location.'" name="' . $settings . '['.$location.']" maxlength="7" size="7" value="' . $colorvalue . '" class="colorwell" />';
				
}

function sno_select_toggle($settings, $location, $options, $default=null) {
	$selectvalue = get_theme_mod($location); if ($selectvalue == '') $selectvalue = $default;
				
				echo '<select name="' . $settings . '['.$location.']" class="'.$location.'">';
				
				$options = explode (",", $options);
				
					foreach ($options as $option) {

						$option = explode ("|", $option);
						
						if ($option[1] == "") $option[1] = $option[0];
						
							echo '<option style="padding-right:10px" value="' . $option[0] . '" ';
								if ($option[0] == $selectvalue) echo 'selected="selected"';
								echo '>' . $option[1] . '</option>'; 	
					
					}				
				
				echo '</select>';
}

function sno_checkbox($settings, $location, $label=null, $default=null) {
	$checkboxvalue = get_theme_mod($location); 
		echo '<label><input type="checkbox" id="' . $location . '-ck" name="' . $settings . '['.$location.']" value="'.$default.'"';
			if ($checkboxvalue == $default) echo 'checked="checked"';
			echo '>';
		echo ' '.$label.'</label>';
}


$sno_attribution = get_option('sno_analytics_options');
if (isset($sno_attribution['sno_hosting_credit']) && $sno_attribution['sno_hosting_credit'] != "Boosting Blue") add_action( 'admin_enqueue_scripts', 'sno_pointer_enqueue_scripts' );
function sno_pointer_enqueue_scripts() {
    wp_enqueue_style( 'wp-pointer' );
    wp_enqueue_script( 'wp-pointer' );
    add_action( 'admin_print_footer_scripts', 'sno_help_admin_print_footer_scripts' );
}
function sno_help_admin_print_footer_scripts() {
    $help_content = '<h3>Need more help getting started?</h3>';
    $help_content .= '<p>Check out the <b>SNO Support Site</b> with video tutorials.</p>';

    $stories_content = '<h3>Start adding stories.</h3>';
    $stories_content .= '<p>Click <b>New</b> under <b>Stories</b> to begin adding content to your site.</p>';    

    $staff_content = '<h3>Create Staff Profiles.</h3>';
    $staff_content .= '<p>Profiles added here will automatically display on the <b>Staff Page</b> and will link to stories written by the writer.</p>';    

    $design_content = '<h3>Customize your site.</h3>';
    $design_content .= '<p>Click <b>Widgets</b> under <b>Appearance</b> to rearrange your homepage content.</p>';
    $design_content .= '<p>Click <b>SNO Design Options</b> under <b>Appearance</b> to customize your site.</p>';    

    $users_content = '<h3>Add Student User Accounts.</h3>';
    $users_content .= '<p>Click <b>Add New</b> under <b>Users</b> to create accounts for students who will have access for adding stories.</p>';    

    $authenticate_google = '<h3>Authenticate your Google Account.</h3>';
	$authenticate_google .= '<p><a href="/wp-admin/admin.php?page=yst_ga_settings" style="text-decoration:underline">Authenticate</a> your Google account to use the SNO Trending Stories widget.</p>';
	
    $dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
  
    if ((in_array( 'snohelp2', $dismissed)) && (!in_array( 'snohelp1', $dismissed))) {    
		?><script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				$('#wp-admin-bar-custom_menu_help').pointer({
					content: '<?php echo $help_content; ?>',
					position: 'top',
					close: function() {
						$.post( ajaxurl, {
                	        pointer: 'snohelp1',
                	        action: 'dismiss-wp-pointer'
                	    });
         			}
      			}).pointer('open');
   			});
			//]]>
		</script><?php
	}

    if ( ! in_array( 'snohelp2', $dismissed ) ) { 
		?><script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				$('#mf-menu-1').pointer({
					content: '<?php echo $stories_content; ?>',
					position: {
						edge: 'left',
						align: 'center',
						offset: '75 0'
						},					
					close: function() {
						$.post( ajaxurl, {
                	        pointer: 'snohelp2',
                	        action: 'dismiss-wp-pointer'
                	    });
         			}
      			}).pointer('open');
   			});
			//]]>
		</script><?php
	}

    if ((!in_array( 'snohelp3', $dismissed ))  && (current_user_can('manage_options'))) { 
		?><script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				$('#mf-menu-2').pointer({
					content: '<?php echo $staff_content; ?>',
					position: {
						edge: 'top',
						align: 'left'
						},					
					close: function() {
						$.post( ajaxurl, {
                	        pointer: 'snohelp3',
                	        action: 'dismiss-wp-pointer'
                	    });
         			}
      			}).pointer('open');
   			});
			//]]>
		</script><?php
	}

    if ((!in_array( 'snohelp4', $dismissed )) && (current_user_can('manage_options'))) { 
		?><script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				$('#menu-appearance').pointer({
					content: '<?php echo $design_content; ?>',
					position: {
						edge: 'left',
						align: 'center',
						offset: '75 0'
						},					
					close: function() {
						$.post( ajaxurl, {
                	        pointer: 'snohelp4',
                	        action: 'dismiss-wp-pointer'
                	    });
         			}
      			}).pointer('open');
   			});
			//]]>
		</script><?php
	}

    if ((!in_array( 'snohelp5', $dismissed )) && (current_user_can('manage_options'))) { 
		?><script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				$('#menu-users').pointer({
					content: '<?php echo $users_content; ?>',
					position: {
						edge: 'top',
						align: 'left'
						},					
					close: function() {
						$.post( ajaxurl, {
                	        pointer: 'snohelp5',
                	        action: 'dismiss-wp-pointer'
                	    });
         			}
      			}).pointer('open');
   			});
			//]]>
		</script><?php
	}

    if ((!in_array( 'authenticate-google', $dismissed )) && (current_user_can('manage_options')) && get_option('yst_ga')['ga_general']['analytics_profile'] == '') { 
		?><script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				$('#toplevel_page_yst_ga_dashboard').pointer({
					content: '<?php echo $authenticate_google; ?>',
					position: {
						edge: 'left',
						align: 'center'
						},					
					close: function() {
						$.post( ajaxurl, {
                	        pointer: 'authenticate-google',
                	        action: 'dismiss-wp-pointer'
                	    });
         			}
      			}).pointer('open');
   			});
			//]]>
		</script><?php
	}

}
add_action('admin_menu', 'sno_welcome_page');

function sno_welcome_page() {
	$sno_attribution = get_option('sno_analytics_options');
	if (isset($sno_attribution['sno_hosting_credit']) && $sno_attribution['sno_hosting_credit'] == "Boosting Blue") {
	
	} else {
		add_dashboard_page('SNO Launch Pad', 'SNO Launch Pad', 'read', 'sno-launch-pad', 'sno_welcome_page_content');
	} 
}

function sno_welcome_page_content() {
	
	?>
	<div class="wrap about-wrap">

			<div class="welcome_tile" style="background-image: url('<?php bloginfo('template_url'); ?>/images/snowelcome.jpg'); background-repeat: no-repeat;background-color:#fff;background-position: bottom 5px right 5px;border:2px solid #990000;padding:8px;"><h1 style="color:#990000;font-weight:bold;">Get Started</h1><span class="welcome_text" style="color:#000;">Use the sidebar to the left to add content and manage your site.</span></div>

			<div class="welcome_tile_ad">
				<!-- FLEX Launch Pad #1 [async] -->
				<script type="text/javascript">if (!window.AdButler){(function(){var s = document.createElement("script"); s.async = true; s.type = "text/javascript";s.src = 'https://servedbyadbutler.com/app.js';var n = document.getElementsByTagName("script")[0]; n.parentNode.insertBefore(s, n);}());}</script>
				<script type="text/javascript">
					var AdButler = AdButler || {}; AdButler.ads = AdButler.ads || [];
					var abkw = window.abkw || '';
					var plc168882 = window.plc168882 || 0;
					document.write('<'+'div id="placement_168882_'+plc168882+'"></'+'div>');
					AdButler.ads.push({handler: function(opt){ AdButler.register(165471, 168882, [300,200], 'placement_168882_'+opt.place, opt); }, opt: { place: plc168882++, keywords: abkw, domain: 'servedbyadbutler.com', click:'CLICK_MACRO_PLACEHOLDER' }});
				</script>				<!-- 300x200 [async] -->
			</div>

			<div class="welcome_tile_ad">
				<!-- FLEX Launch Pad #2 [async] -->
				<script type="text/javascript">if (!window.AdButler){(function(){var s = document.createElement("script"); s.async = true; s.type = "text/javascript";s.src = 'https://servedbyadbutler.com/app.js';var n = document.getElementsByTagName("script")[0]; n.parentNode.insertBefore(s, n);}());}</script>
				<script type="text/javascript">
					var AdButler = AdButler || {}; AdButler.ads = AdButler.ads || [];
					var abkw = window.abkw || '';
					var plc168884 = window.plc168884 || 0;
					document.write('<'+'div id="placement_168884_'+plc168884+'"></'+'div>');
AdButler.ads.push({handler: function(opt){ AdButler.register(165471, 168884, [300,200], 'placement_168884_'+opt.place, opt); }, opt: { place: plc168884++, keywords: abkw, domain: 'servedbyadbutler.com', click:'CLICK_MACRO_PLACEHOLDER' }});
				</script>
			</div>
			
			<a href="https://sno.zendesk.com/hc/en-us" target="_blank"><div class="welcome_tile welcome_tile_link" style="background:#1BA1E2;"><h1>Tutorials</h1><span class="welcome_text">Check out our detailed instructions and video tutorials.</span></div></a>

			<a href="https://sno.zendesk.com/hc/en-us/requests/new" target="_blank"><div class="welcome_tile welcome_tile_link" style="background:#0C4662;"><h1>Need Help?</h1><span class="welcome_text">Submit a support request.</span></div></a>

			<a href="https://customers.snosites.com/training" target="_blank"><div class="welcome_tile welcome_tile_link" style="background:#61BBE7;"><h1>Training</h1><span class="welcome_text">Learn how the SNO team can customize training for you and your staff.</span></div></a>

			<a href="https://pinterest.com/snosites" target="_blank"><div class="welcome_tile welcome_tile_link" style="background: #326c88"><h1>Design Ideas</h1><span class="welcome_text">Explore the design possibilities that are built into your site.</span></div></a>
			
			<a href="https://bestofsno.com" target="_blank"><div class="welcome_tile welcome_tile_link" style="background:#157DAF;"><h1>Best of SNO</h1><span class="welcome_text">Read the best stories published daily for inspiration and ideas.</span></div></a>

			<a href="https://customers.snosites.com" target="_blank"><div class="welcome_tile welcome_tile_link" style="background:#295062;"><h1>Resources</h1><span class="welcome_text">Check out the <span style="font-weight:bold">Customer Portal</span> for all SNO resources.</span></div></a>
						
	</div>
	
	<?php
}


add_filter('image_size_names_choose', 'sno_image_sizes');
function sno_image_sizes($sizes) {
	$addsizes = array(
	"small" => __( "Small")
	);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
}

function sno_widget_interface_styles() {
	
	$customizer_css = '<style type="text/css">';
	$widget_areas = get_option('sidebars_widgets'); 
	foreach ($widget_areas as $widget_area => $widgets) {
		if (substr($widget_area, -3) == '-11') {
			$customizer_css .= '#sub-accordian-section-sidebar-widgets-'.$widget_area.' .full_width_area_options { display:block !important; }<br >';
			$customizer_css .= '#sub-accordian-section-sidebar-widgets-'.$widget_area.' .non_full_width_area_options{ display:none !important; }<br >';
		}
	} 
	$customizer_css .= '</style>';
	
	echo $customizer_css;

	?><style type="text/css">
		.widgetdivider { width:100%;border-bottom:1px solid #ddd;margin-bottom:10px; }
		.wp-admin select { max-width: 100%; }
		.widewidgetarea, .full_width_area_options { display: none; }
		.hmc_wrap .widewidgetarea, #accordion-section-sidebar-widgets-sidebar-2 .widewidgetarea { display: block !important;}
		.hfw_wrap .full_width_area_options  { display: block !important; }
		.hfw_wrap .widgetsection2 { display:none !important; }
		.hfw_wrap .non_full_width_area_options { display: none !important; }
		#th { display: none; }
		.wc2 { background: #eee; padding-left:10px; padding-right: 10px; margin-top:15px; }
		.customize-control input[type="text"] { width: auto; }
		.widgetsection { background: #eee; color: #23282d; padding: 10px;margin-top: 15px; border: 1px solid #ddd; }
		.expand { float: right; width: 14px; height: 14px; background-size: 14px; background-image: url("/wp-content/themes/snoflex/images/snoexpand.png"); }
		.collapse { float: right; width: 14px; height: 14px; background-size: 14px; background-image: url("/wp-content/themes/snoflex/images/snocollapse.png"); }
		.clear { clear: both; }
		.lastsection { display: block; margin-bottom:20px; }
		.widgetbody { padding: 10px 10px 0px; background: #fafafa; margin-top: 0px; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd; }
		.not_saved { padding: 20px; }
		.wpshed-media-container {
			width: 98%;
		}

		.wpshed-media-inner {
			border: 1px solid #ddd;
			padding: 10px;
			text-align: center;
			border-radius: 2px;
			margin-bottom: 10px;
		}

		.widget-description img,
		.wpshed-media-inner img {
			max-width: 100%;
			height: auto;
		}

		.wpshed-media-url {
			display: none;
		}

		.wpshed-media-remove {
			float: left;
			width: 48%;
		}

		.wpshed-media-upload {
			float: right;
			width: 48%;
		}
	</style><?php	
}

function sno_check_ssl_plugin() {
	if (get_option('sno_check_ssl_plugin') != 1) {
		
		$build_ssl_option = get_option('rlrsssl_options');
		
		if ($build_ssl_option == '') $build_ssl_option=array();
		
		$build_ssl_option['ssl_enabled'] = true;
		$build_ssl_option['wp_redirect'] = true;
		$build_ssl_option['ssl_success_message_shown'] = true;
		$build_ssl_option['site_has_ssl'] = true;
		$build_ssl_option['hsts'] = true;
		$build_ssl_option['htaccess_warning_show'] = true;
		$build_ssl_option['autoreplace_insecure_links'] = true;
		$build_ssl_option['plugin_db_version'] = '2.5.20';
		$build_ssl_option['debug'] = false;
		$build_ssl_option['do_not_edit_htaccess'] = true;
		$build_ssl_option['htaccess_redirect'] = true;
		$build_ssl_option['javascript_redirect'] = true;
		$build_ssl_option['switch_mixed_content_fixer-hook'] = true;
		
		update_option('rlrsssl_options', $build_ssl_option);
		update_option('sno_check_ssl_plugin', 1);
	} 
}
add_action ('admin_init', 'sno_check_ssl_plugin');

// this is just so those little brats don't delete our Uncategorized category or set something else to be the default category
function sno_set_default_category() {
	$category = get_term_by('name', 'Uncategorized', 'category'); 
	if (!$category) {
		$cat_defaults = array(
			'cat_name' => 'Uncategorized',
			'category_description' => 'Do NOT edit or delete this category',
			'taxonomy' => 'category' );				
		$my_cat_id = wp_insert_category($cat_defaults);		
		update_option('default_category', $my_cat_id);
	} else {
		$category_id = $category->term_id;
		if ($category_id != get_option('default_category')) {
			update_option('default_category', $category_id);
		}
	}
}
add_action('admin_init', 'sno_set_default_category');
