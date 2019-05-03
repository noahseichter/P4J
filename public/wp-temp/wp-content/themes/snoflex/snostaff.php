<?php
/*
Template Name: SNO Staff
*/

get_header();

$currentyear = date("Y"); 
$currentmonth = date("m"); 

$content = array(); 

if (get_theme_mod('staffpage-custom') == 'Activate') {
	$seasoncheck = get_theme_mod('staffpage-year');
	$namecheck = $seasoncheck;
	
} else {
	$resetmonth = get_theme_mod('staff-reset');
	if ($resetmonth == '') $resetmonth = '07';

	if ($currentmonth >= $resetmonth) {
		$spring = $currentyear +1; $seasoncheck = "$currentyear" . "-" . "$spring"; 
	} else {
		$fall = $currentyear - 1; $seasoncheck = "$fall" . "-" . "$currentyear";
	} 
	$namecheck = $seasoncheck; 

}
$staffpage = '';
if (isset($_GET['writer'])) $staffpage = $_GET['writer'];

$staffpage = trim ($staffpage); 
$staffpage = str_replace('_', ' ', $staffpage); 
	$transient_name = str_replace(' ', '_', $staffpage); 
	$transient_name = str_replace("'", "", $transient_name);
	$transient_name = str_replace("\\", "", $transient_name);
	$clean_name = $transient_name;
$profile_name = stripslashes($staffpage);

// get a list of all existing staff profiles as a safety check
$existing_bylines = sno_get_all_bylines();
if ($staffpage && !in_array($profile_name, $existing_bylines)) {
	// since there's not a staff profile, let's check if there's a byline with this name
	// if there's not a byline, we're not going feed URL input into a query
	if (sno_check_byline_existence($profile_name) == false) $staffpage = '';
}
$realname = $profile_name;
$profile_name = ucwords(str_replace( "'", "''", $profile_name ));
$pagelink = sno_staff_profile_link();

if ($staffpage) {

echo '<div id="staffpage">';

echo '<div id="content" class="staffpage">';

	echo '<div id="contentleft">';
	
		echo '<div class="staffpostarea" style="padding:1.5%">';

						$realnametitle = $realname;
						
						if(is_user_logged_in()) {

							global $wpdb;
							$querystr = "
									SELECT * FROM $wpdb->posts
									JOIN $wpdb->postmeta AS name ON(
									$wpdb->posts.ID = name.post_id
									AND name.meta_key = 'name'
									AND name.meta_value = '$profile_name'
									)
									AND $wpdb->posts.post_status = 'publish'
									ORDER BY post_date DESC LIMIT 1
									";
						 	$pageposts = $wpdb->get_results($querystr, OBJECT);
							if ($pageposts) { 
								foreach ($pageposts as $post):
									setup_postdata($post);
										echo '<div class="editprofile">';
										echo edit_post_link('Edit this profile', '', '');
										echo ' &mdash; This box only shows for logged in users.</div>';
			
									endforeach; 

							} else {
						
								$sno_staff_panel = sno_staff_write_panel_id();
							
								echo '<a href="' . get_admin_url() . 'post-new.php?custom-write-panel-id=' . $sno_staff_panel . '"><div class="addprofile">';
							
								echo '<h3 style="text-align:center">Add Photo and Profile for ' . $realname . '</h3>';
								
								echo '</div></a>';
							}
						}
		


			$transient_id = 'sno_sp_' . $transient_name;
	
			$transient = get_transient( $transient_id ); $output = '';
		  
			if( ! empty( $transient )  && get_theme_mod('staffpage-disable-caching') != 'Disable') {  
				echo "\n<!-- profile displayed from cache -->\n";
				echo $transient;
		
			} else {


				global $wpdb;
				$querystr = "
						SELECT * FROM $wpdb->posts
						JOIN $wpdb->postmeta AS name ON(
						$wpdb->posts.ID = name.post_id
						AND name.meta_key = 'name'
						AND name.meta_value = '$profile_name'
						)
						AND $wpdb->posts.post_status = 'publish'
						ORDER BY post_date DESC LIMIT 1
						";
			 	$pageposts = $wpdb->get_results($querystr, OBJECT);
				if ($pageposts): 
					foreach ($pageposts as $post):
						setup_postdata($post);
						
						$staffposition = get_post_meta($post->ID, 'staffposition', true);
						
						if ($staffposition) $realnametitle = $realname . ', ' . $staffposition;
												
						$output .= '<div class="staffprofile sno-animate">';
						
							if (has_post_thumbnail()) {
								$output .= '<div class="photowrap">';
								$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); 
								$output .= '<img src="' . $image[0] . '" class="staffimage" alt="' . get_the_title() . '" />'; 
								$output .= '</div>';
							}
	
							$output .= nl2br($post->post_content);
						$output .= '</div>';

						endforeach; 
					else : 
						
					endif; 



				
				global $wpdb;
				$querystr = "
						SELECT * FROM $wpdb->posts
						JOIN $wpdb->postmeta AS credit ON( $wpdb->posts.ID = credit.post_id AND credit.meta_value = '$profile_name' AND credit.meta_key != 'name' AND credit.meta_key != 'roster_name')
						WHERE ($wpdb->posts.post_status = 'publish'
						OR $wpdb->posts.post_status = 'inherit')
						AND ($wpdb->posts.post_type = 'post'
						OR $wpdb->posts.post_type = 'attachment')
						ORDER BY post_date DESC
						";
		 	$pageposts = $wpdb->get_results($querystr, OBJECT);
		
				if ($pageposts): 
					
			
					foreach ($pageposts as $post):
						setup_postdata($post);
						$lfstoryid = ''; $lfcheck = '';
						$gridstoryid = ''; $gridcheck = '';

								
						if (get_post_field('post_type', $post->ID) == "attachment") {
			
							$storyid = get_post_field('post_parent', $post->ID); 
	
							if (get_post_meta($storyid, 'sno_format', true) == "Long-Form Chapter") {
								$lfstoryid = get_post_meta($storyid, 'sno_longform_list', true);
							}				

							if (get_post_meta($storyid, 'sno_format', true) == "Grid Chapter") {
								$gridstoryid = get_post_meta($storyid, 'sno_grid_list', true);
							}				
							
						} else {
			
							$storyid = $post->ID; 

							if (get_post_meta($storyid, 'sno_format', true) == "Long-Form Chapter") {
								$lfcheck = get_post_meta($post->ID, 'sno_longform_list', true);
								if ($lfcheck != '') $lfstoryid = $lfcheck; 
								
							}				

							if (get_post_meta($storyid, 'sno_format', true) == "Grid Chapter") {
								$gridcheck = get_post_meta($post->ID, 'sno_grid_list', true);
								if ($gridcheck != '') $gridstoryid = $gridcheck; 
								
							}				

						}
						
						if ($lfstoryid) {
						
							if (get_post_meta($storyid, 'writer', true)) {
								$content[$lfstoryid]['writer'] = get_post_meta($storyid, 'writer', false);
							}
							if (get_post_meta($post->ID, 'photographer', true) == $realname) {
								$content[$lfstoryid]['photographer'] = get_post_meta($post->ID, 'photographer', true);
							}
							if (get_post_meta($storyid, 'videographer', true)) {
								$content[$lfstoryid]['videographer'] = get_post_meta($storyid, 'videographer', false);
							}
								$content[$lfstoryid]['id'] = $lfstoryid;
								$content[$lfstoryid]['date'] = get_the_time( 'Y-m-d', $lfstoryid );
								
						} else if ($gridstoryid) {
						
							if (get_post_meta($storyid, 'writer', true)) {
								$content[$gridstoryid]['writer'] = get_post_meta($storyid, 'writer', false);
							}
							if (get_post_meta($post->ID, 'photographer', true) == $realname) {
								$content[$gridstoryid]['photographer'] = get_post_meta($post->ID, 'photographer', true);
							}
							if (get_post_meta($storyid, 'videographer', true)) {
								$content[$gridstoryid]['videographer'] = get_post_meta($storyid, 'videographer', false);
							}
								$content[$gridstoryid]['id'] = $gridstoryid;
								$content[$gridstoryid]['date'] = get_the_time( 'Y-m-d', $gridstoryid );

						} else {
						
							if (get_post_meta($storyid, 'writer', true)) {
								$content[$storyid]['writer'] = get_post_meta($storyid, 'writer', false);
							}
							if (get_post_meta($post->ID, 'photographer', true) == $realname) {
								$content[$storyid]['photographer'] = get_post_meta($post->ID, 'photographer', true);
							}



							if (get_post_meta($storyid, 'videographer', true)) {
								$content[$storyid]['videographer'] = get_post_meta($storyid, 'videographer', false);
							}
								$content[$storyid]['id'] = $storyid;
								$content[$storyid]['date'] = get_the_time('Y-m-d', $storyid);
						}
						
						endforeach; 
		
					else : endif; 
				
				$output .= '<h3>' . $realnametitle . '</h3>';
					$output .= '<div class="staffstorylist">';
					$output .= '<table class="schedule"><tbody>';
					
					
					
										
					/*	if (is_array($content)) */ foreach ($content as $story) {
						
							$open = 'off'; $type = ''; $media = 'off';
								if ( isset ( $story['writer'] ) && is_array($story['writer'])) {
									foreach ($story['writer'] as $writer) {
										if (trim(strtolower($writer)) == strtolower($realname) || trim(strtolower($writer)) == strtolower($clean_name)) { $type = 'Story'; $open = 'on'; }
									}
								}
								if ( isset ($story['photographer']) && trim(strtolower($story['photographer'])) == strtolower($realname) && $media == 'off') {
									if ($open == 'on') $type .= '/'; 
									$type .= 'Media'; $open = 'on'; $photoduplicate = 'on'; $media = 'on';
								}
								if ( isset ($story['videographer']) && is_array($story['videographer']) && $media == 'off') { 
									foreach ($story['videographer'] as $videographer) {
										if (trim(strtolower($videographer)) == strtolower($realname)) { 
											if ($open == 'on') $type .= '/';
											$type .= 'Media'; $open = 'on'; $media = 'on';
										}
									}
								}
								$date = explode("-",$story['date']); 
								if ( isset ($date[1]) ) $date = date("M d, Y",mktime(0,0,0,$date[1],$date[2],$date[0]));
							
							$status = get_post_status($story['id']);
							if ($status == 'publish' && $story['id'] != 0 && $type != "") {
								$output .= '<tr class="staffstoryrow clickable-row" data-href="' . get_permalink($story['id']) . '">'; 
									$output .= '<td class="tableindent staffdate">' . $date . '</td><td> ';
									$output .= '<div class="staffprofilelist">' . get_the_title($story['id']) . ' <span class="staffprofiletype">(' . $type . ')</span></div>';
									$output .= '</td>';
								$output .= '</tr>';
							}
												
						}
						
					$output .= '</tbody></table>';
					$output .= '</div>';
					$output .= "<script type='text/javascript'>
									jQuery(document).ready(function($) {
										$('.clickable-row').click(function() {
											window.document.location = $(this).data('href');
										});
									});
								</script>";
					$output .= '<div class="clear"></div>';

				echo $output;
				
				set_transient( $transient_id, $output, MONTH_IN_SECONDS );
				
			}


echo '</div></div></div></div>';


} else {

echo '<div id="staffpage">';

echo '<div id="content" class="staffpage">';

	echo '<div id="contentleft">';
	
		echo '<div class="staffpostarea photoblocks" style="padding:1.5%">';
	
			$season_archive = ''; $o = '';
			if (isset($_GET['schoolyear'])) $season_archive = $_GET['schoolyear'];
			if ($season_archive) $seasoncheck = $season_archive;

			$staffpage_custom_label = get_theme_mod('staffpage-custom-label');
			
		 		$o .= '<div class="selectwrap">';
				$o .= '<form name="jump3">';
				$o .= '<select class="sportsselect" name="menu3" onChange="location=document.jump3.menu3.options[document.jump3.menu3.selectedIndex].value;" value="GO">';
				if (get_theme_mod('staffpage-custom') == 'Activate') {
					$label = "Class";
					if ($staffpage_custom_label) $label = $staffpage_custom_label;
					$o .= '<option value="">Select a Different '.$label.'</option>';					
				} else {
					$label = "School Year";
					if ($staffpage_custom_label) $label = $staffpage_custom_label;
					$o .= '<option value="">Select a Different '.$label.'</option>';
				}
				
				$datelist = get_active_staffpage_years();
					
				if (is_array($datelist)) {
					foreach ($datelist as $date) {
						$o .= '<option value="'. $pagelink .'?schoolyear='. $date .'">'. $date .'</option>';
					}
				}
	
				$o .= '</select>';
		    	$o .= '</form>';
		    	$o .= '</div>';

				echo '<div class="staffheading">';
				echo '<h3>'.$seasoncheck.' Staff</h3>';
				echo '</div><div class="staffselect">'.$o.'</div><div class="clear"></div>';

 			$querystr = "
				SELECT * FROM $wpdb->posts
				JOIN $wpdb->postmeta AS schoolyear ON(
				$wpdb->posts.ID = schoolyear.post_id
				AND schoolyear.meta_key = 'schoolyear'
				AND schoolyear.meta_value LIKE '%$seasoncheck%'
				)
				JOIN $wpdb->postmeta AS staffposition ON(
				$wpdb->posts.ID = staffposition.post_id
				AND staffposition.meta_key = 'staffposition'
				)
				AND $wpdb->posts.post_status = 'publish'
				ORDER BY post_date DESC
				";

 			$pageposts = $wpdb->get_results($querystr, OBJECT);
 			
 			
 			// this section is for the current school year, which is organized by staff position groups
 			if ($namecheck == $seasoncheck) { 
	 			$staff_order = get_option('sno_staffpage_role_order');
	 			if ($staff_order) {
		 			$i = 0;
		 			$new_pageposts = new stdClass();
		 			foreach($staff_order as $position) {
			 			$staff_profile_order = get_option('sno_staffpage_'.preg_replace("/[^a-zA-Z0-9]+/", "", $seasoncheck) . '_' . preg_replace("/[^a-zA-Z0-9]+/", "", $position));
			 			if ($staff_profile_order) foreach ($staff_profile_order as $individual_order) {
				 			foreach ($pageposts as $key => $staff_profile) {
					 			if (trim($staff_profile->ID) == trim($individual_order)) { 
						 			$new_pageposts->{$i} = $staff_profile; 
						 			$i++;
						 			unset($pageposts[$key]); 
						 		}
					 		}

			 			} else {
				 			foreach ($pageposts as $key => $staff_profile) {
					 			if (trim($staff_profile->meta_value) == trim($position)) { 
						 			$new_pageposts->{$i} = $staff_profile; 
						 			$i++; 
						 			unset($pageposts[$key]); 
						 		}
					 		}
				 		}
		 			}
					// loop through any remaining profiles that weren't already displayed based on stored sort order and add to the end
					foreach ($pageposts as $staff_profile) {
				 		$new_pageposts->{$i} = $staff_profile;
				 		$i++;
			 		}
		 			$pageposts = $new_pageposts;
	
	 			}
	 			
	 		// this section is for archived school years, which are only organized by individual staff profiles
 			} else {
			 	$staff_profile_order = get_option('sno_staffpage_'.preg_replace("/[^a-zA-Z0-9]+/", "", $seasoncheck));
			 	if ($staff_profile_order) {
				 	$i = 0;
		 			$new_pageposts = new stdClass();
			 			if ($staff_profile_order) foreach ($staff_profile_order as $individual_order) {
				 			foreach ($pageposts as $key => $staff_profile) {
					 			if ($staff_profile->ID == $individual_order) { 
						 			$new_pageposts->{$i} = $staff_profile; $i++; 
						 			unset($pageposts[$key]); 
						 		}
					 		}
			 			} 
			 			// add remainder of unordered profiles here -- they were added after sort order was created in admin
			 			foreach ($pageposts as $profile) {
						 	$new_pageposts->{$i} = $profile; $i++; 
			 			}
		 			$pageposts = $new_pageposts;
		 		}
 			}
			if (($pageposts) && (get_theme_mod('staffpage') == "Photo Blocks")):

				// need to build option for photo ratio for snodo page
						
				$ratio = get_theme_mod('photoblock-ratio');
				if ($ratio == '') $ratio = "3:2 Horizontal";
				
				// need to build option for number of columns for blocks style on snodo page
						
				$columns = get_theme_mod('photoblock-columns');
				if ($columns == '') $columns = 5;
				$spacers = $columns - 1;
						
				// need ot build option for spacing between staff page panels on snodo page
						
				$margin = get_theme_mod('photoblock-margin');  // px
				if ($margin == '') $margin = 1;
				$margin_px = $margin . 'px';
						
				// need to calculate width of page -- content width - outer margin
						
				$outer_padding = 30;
				if (get_theme_mod('outer-padding') == 'Remove') $outer_padding = 0; $outer_padding_px = $outer_padding . 'px';
				$width1 = get_theme_mod('content-width'); if ($width1 == '') $width1 = 980;
				$outer_width = $width1 - $outer_padding; $outer_width_px = $outer_width . 'px';
						
				// calculate widths of each column and margin
						
				$px_ratio = number_format((float)((100 / $outer_width)*$margin), 2, '.', '');

				$grid_panel_width = (100 - ($spacers * $px_ratio) ) / $columns;
				$side_margin_px = $px_ratio . '%'; 
				$grid_panel_width_pct = $grid_panel_width . '%';
						
				$tile_ratio = $ratio; 
					if ($tile_ratio == '2:1 Horizontal') $grid_panel_height = ($grid_panel_width*($outer_width/100))/2;
					if ($tile_ratio == '3:2 Horizontal') $grid_panel_height = ($grid_panel_width*($outer_width/100) * 2)/3;
					if ($tile_ratio == 'Square') $grid_panel_height = $grid_panel_width*($outer_width/100);
					if ($tile_ratio == '2:3 Vertical') $grid_panel_height = ($grid_panel_width*($outer_width/100) * 3)/2;

				$grid_panel_height_px = $grid_panel_height . 'px';
				$grid_panel_width_px = floor($grid_panel_width*($outer_width/100));
				$grid_panel_width_pct = $grid_panel_width . '%';
				
				$cat_style_align = "text-align:center;";
				$count = 0;

				foreach ($pageposts as $post):
				setup_postdata($post);
					
				$namekey=0; 
				$schoolyear = get_post_meta($post->ID, 'schoolyear', true); 
				if (is_array($schoolyear)) { if(in_array($seasoncheck, $schoolyear)) $namekey=5; } 
				if ($seasoncheck==$schoolyear) $namekey=5; 
					
				if ($namekey==5) { 
					$count++; $output = '';
					$custom_fields = get_post_custom($post->ID);
						$name = $custom_fields['name'][0];
						$staffposition = $custom_fields['staffposition'][0];
						$postid = $post->ID;
						
					if ( $count % $columns == 0) { $new_side_margin_px = 0; } else { $new_side_margin_px = $side_margin_px; }
						
					echo "<div class='grid-widget-tile' style='margin-right:$new_side_margin_px;margin-bottom:$margin_px;height:$grid_panel_height_px;width:$grid_panel_width_pct;'>";

					$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
					
					$image0 = $image[0]; $image1 = $image[1]; $image2 = $image[2];
					
					if ($image0) {
						$overlay_styles = "top:0;left:0;right:0;bottom:0;text-align:center;display:none;";
					} else {
						$overlay_styles = "top:0;left:0;right:0;bottom:0;text-align:center;display:block;";
					}
					$overlay = " style='$overlay_styles'";
						
						if ($image0) {		
							$image_proportion = $image1 / $image2; 
							$frame_proportion = $grid_panel_width_px / $grid_panel_height; 
						} else {
							$image_proportion = 1;
							$frame_proportion = 1;
						}
						if ($frame_proportion >= $image_proportion) {
							$cropping = " style='width:100%;height:auto;min-height:100%;min-width:100%;'"; // this is the line causing issues on mobile
						} else {
							$cropping = " style='height:100%;width:auto;min-height:100%;min-width:100%;'";									
						}
						
						$cropping = ''; // temporarily removing this variable as we test new CSS

						$uniquestory = 'stafftile' . $postid;
					
						echo "<a href='" . $pagelink . "?writer=" . urlencode($name) . "'>";
						if ($image0) echo "<img src='$image0' id='img$uniquestory' $cropping alt='" . get_the_title() . "' />"; 

						echo "<div id='text$uniquestory' class='desc'$overlay>";
									
							echo "<div id='gridcontent$uniquestory' style='display:block;'>";

							if (($season_archive == $namecheck) || ($season_archive == "")) { 
								echo "<div class='topstorycat'>";
									echo '<span class="blockscat">';
										echo $staffposition;
									echo '</span>';
								echo '</div>';
							}
															 						
							echo '<h3 class="staffmembername">' . $name . '</h3>';
									
							echo "<div class='clear'></div></div>";
						
						echo '</div></a>';

					$output .= "<script type='text/javascript'>
							$(document).ready(function() {
									$('#img$uniquestory').mouseenter(function() {
										$('#text$uniquestory').fadeIn();
										var height = $('#gridcontent$uniquestory').height();
										var new_padding = Math.floor(($grid_panel_height - height)/2);
										$('#gridcontent$uniquestory').css('padding-top', new_padding);
									});
									$('#text$uniquestory').mouseleave(function() {
									";
											$output .= "
												$('#text$uniquestory').fadeOut();
												";
									$output .= "});
							});
							
							$(document).ready(function() {
								var timer;
								$('#img$uniquestory').mouseenter(function() {
									$('#img$uniquestory').removeClass('shrink');
									$('#img$uniquestory').removeClass('grow');
									$('#img$uniquestory').addClass('grow');
								});
								$('#img$uniquestory, #text$uniquestory').mouseleave(function() {
										timer = setTimeout(hideOverlay, 3);
								}).mouseenter(function() {
									clearTimeout(timer);
								});
								function hideOverlay() {
									";
										$output .= "
											$('#img$uniquestory').addClass('shrink');
										";
								$output .= "};
							});
					</script>";
					
					if ($image0) {
						echo $output;
					} else { 
						$output = "<script type='text/javascript'>
							$(document).ready(function() {
								var height = $('#gridcontent$uniquestory').height();
								var new_padding = Math.floor(($grid_panel_height - height)/2);
								$('#gridcontent$uniquestory').css('padding-top', new_padding);
							});
						</script>";
						echo $output;
					}
					
				echo '</div>';


				
				}
				
				endforeach;
			else : endif;


			if (($pageposts) && (get_theme_mod('staffpage') == "Profile Preview")):
				$i = 0;
				foreach ($pageposts as $post):
				setup_postdata($post);

				$namekey = 0; 
				$schoolyear = get_post_meta($post->ID, 'schoolyear', true); 
				if (is_array($schoolyear)) { if(in_array($seasoncheck, $schoolyear)) $namekey=5; } 
				if ($seasoncheck==$schoolyear) $namekey=5; 
					
				if ($namekey==5) { 
					$i++; 
					if($i %3 == 0) { 
						$classname = "third"; 
					}
					if ($i %2 == 0) { 
						$classname = "second"; 
					}
					if (($i %2 == 0) && ($i %3 == 0)) {
						$classname = "third second";
					}
					if (($i %2 != 0) && ($i %3 != 0)) {
						$classname = "first";
					}
					$custom_fields = get_post_custom($post->ID);
						$name = $custom_fields['name'][0];
						$staffposition = $custom_fields['staffposition'][0];

					echo '<div class="sno-animate profilepreviewbox ' . $classname . '">';
					$classname = ""; $classname2 = "";
						if (has_post_thumbnail()) { 
							if (get_theme_mod('staffpage-photo') == 'Full Size') {
								$photolink = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' ); 
							} else {
								$photolink = wp_get_attachment_image_src( get_post_thumbnail_id(), 'tsbigblock' ); 
							}
							echo '<a href="' . $pagelink . '?writer=' . $name . '"><img src="' . $photolink[0] . '" class="previewstaffpic" /></a>';
    					}
    					if (get_theme_mod('staffpage-name') == 'Display') {
    						echo '<h3 class="staffmembername"><a href="' . $pagelink . '?writer=' . $name . '">' . $name . '</a></h3>';
							if ((isset($_GET['schoolyear']) && $_GET['schoolyear'] == $namecheck) || !isset($_GET['schoolyear'])) echo '<p class="staffposition">' . $staffposition . '</p>';
						}
						$teaser_length = get_theme_mod('staffpage-teaser');
						if ($teaser_length != "0") the_content_limit($teaser_length, '');


					echo '</div>';
				}

				endforeach;
			else : endif;

			if (($pageposts) && (get_theme_mod('staffpage') == "List")):

				echo '<table class="schedule" style="width:100%;"><thead>';
				echo '<tr class="schedulehead"><th class="tableindent">Staff Member</th>';
				if ((isset($_GET['schoolyear']) && $_GET['schoolyear'] == $namecheck) || !isset($_GET['schoolyear'])) echo '<th>Staff Position</th>';
				echo '<th></th></tr>';
				echo '</thead><tbody>';

				foreach ($pageposts as $post):
				setup_postdata($post);

				$namekey=0; 
				$schoolyear = get_post_meta($post->ID, 'schoolyear', true); 
				if (is_array($schoolyear)) { if(in_array($seasoncheck, $schoolyear)) $namekey=5; } 
				if ($seasoncheck==$schoolyear) $namekey=5; 
					
				if ($namekey==5) { 

					$custom_fields = get_post_custom($post->ID);
						$name = $custom_fields['name'][0];
						$staffposition = $custom_fields['staffposition'][0];
				
				
				echo '<tr class="staffrosterrow">';
				echo '<td class="tableindent">' . $name . '</td>';
				if ((isset($_GET['schoolyear']) && $_GET['schoolyear'] == $namecheck) || !isset($_GET['schoolyear'])) echo '<td>' . $staffposition . '</td>';
				echo '<td class="oneline"><a href="' . $pagelink . '?writer=' . $name . '">See ' . $name . '\'s profile</a></td>';
				echo '</tr>';
				echo '<tr class="staffrosterrow twoline">';
				echo '<td colspan="3"><a href="' . $pagelink . '?writer=' . $name . '">See ' . $name . '\'s profile</a></td>';
				echo '</tr>';
				

				}

				endforeach;
				
				echo '</tbody></table>';
				
			else : endif;

		echo '</div>';
		
	echo '</div>';
	
echo '</div>';

echo '</div>';

}

get_footer(); 

?>