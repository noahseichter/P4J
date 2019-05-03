<?php

add_action('widgets_init', create_function('', "register_widget('sno_parallax');"));
class sno_parallax extends WP_Widget {

	function __construct() {

		$this->defaults = array(
			'title' => '',
			'image' => '',
			'link'  => ''
			);

		$widget_ops = array(
			'classname' => 'sno_parallax',
			'description' => __( 'Use this widget to add a parallax display of cascading photos from a category of stories.  This widget only works in full-width areas on desktop displays.' )
			);

		$control_ops = array(
			'id_base' => 'parallax'
			);

		parent::__construct( 'parallax', __( '(SNO) Story Full Screen' ), $widget_ops, $control_ops );

	}


	function widget($args, $instance) {
		extract($args);
		
		wp_reset_query();
		$active_cat_id = get_query_var('cat');
				
		$output = ''; $count = 0; $unique = '';
		
 		$number = $instance['number'];		
		if (($instance['category'] == -1) || ($number <= 0)) {} else {


				$widget = $this->id; 
				$unique = $widget;
				$sidebartest = get_option('sidebars_widgets'); 
				
				if (is_archive()) {
					$columns = get_theme_mod("cat-widget-layout-$active_cat_id");
				} else { 
					$columns = get_theme_mod('sno-layout'); 
				}

				if (substr($args['id'], -2) == '-2') {
					$instance['sidebarname'] = 'Main Column';
				} else if (substr($args['id'], -3) == '-11' || $args['id'] == '-11') {
					$instance['sidebarname'] = 'Full-Width'; 
				} else if (substr($args['id'], -2) == '-1' || $args['id'] == 'sidebar-6') {
					$instance['sidebarname'] = 'Non-Home Sidebar'; 
				} else if (substr($args['id'], -2) == '-3' && $columns == 'Option 1') {
					$instance['sidebarname'] = 'Narrow'; 
				} else if (substr($args['id'], -2) == '-3' && $columns == 'Option 2') {
					$instance['sidebarname'] = 'Wide';
				} else if (substr($args['id'], -2) == '-3' && $columns == 'Option 3') {
					$instance['sidebarname'] = 'Small Sidebar';
				} else if (substr($args['id'], -2) == '-3') {
					$instance['sidebarname'] = 'Home Sidebar';
				} else if (substr($args['id'], -2) == '-4' && ($columns == 'Option 1' || $columns == 'Option 5')) {
					$instance['sidebarname'] = 'Wide'; 
				} else if (substr($args['id'], -2) == '-4' && ($columns == 'Option 2' || $columns == 'Option 4')) {
					$instance['sidebarname'] = 'Narrow';
				} else if (substr($args['id'], -2) == '-4') {
					$instance['sidebarname'] = 'Small Sidebar';
				} else if (substr($args['id'], -2) == '-5' && $columns == 'Option 5') {
					$instance['sidebarname'] = 'Narrow'; 
				} else if (substr($args['id'], -2) == '-5' && $columns == 'Option 4') {
					$instance['sidebarname'] = 'Wide';
				} else if (substr($args['id'], -2) == '-5' && $columns == 'Option 6') {
					$instance['sidebarname'] = 'Small Sidebar';
				} else if (substr($args['id'], -2) == '-5') {
					$instance['sidebarname'] = 'Home Sidebar';
				} else if (substr($args['id'], -3) == '-20') {
					$instance['sidebarname'] = 'Mobile';
				} else {
					$instance['sidebarname'] = 'Home Sidebar';
				}
	
	if ( $instance['sidebarname'] == 'Full-Width' ) { // only allow the widget to render if it's a full width widget area

								
		if ($instance['custom-view-all']=="on") {
			$categoryslug = $instance['custom-link'];
		} else {
			$categoryslug = cat_id_to_slug($instance['category']); 
		}
		$categoryname = cat_id_to_name($instance['category']);
		if ($instance['category'] === '0') { $categoryname = "Recent Posts"; $categoryslug = "/";}
		
		if ( !is_home() ) $categoryslug .= '?list';
		
		$customcolors=$instance['custom-colors']; $videotitle = '';
		
		$widgetfullscreen = '';
				
		if ( $instance['full-width-activate'] == 'on' && get_theme_mod('background-wrap') == 'Full Browser Width' && $instance['sidebarname'] == "Full-Width" ) $widgetfullscreen = 'widgetfullscreen';

		if ( substr($args['id'], -12) == 'sidebar-h-11') $widgetfullscreen = 'widgetfullscreen';

		$current_widget_area = '';
		if ( substr($args['id'], -12) == 'sidebar-h-11') $current_widget_area = 'Above Header';

		$site_width = get_theme_mod('content-width'); if ($site_width == '') $site_width = 980;
		if ( $site_width == 980 && is_active_sidebar(10) && get_theme_mod('extra-column') && $current_widget_area != 'Above Header') $widgetfullscreen = ''; // block full-screen functionalty when extra widget area is being displayed
		
		$top_margin_style = ''; $bottom_margin_style = ''; $overlay_style = ''; $catstyle = '';
		$shadow = '';
		if ($instance['hide-shadow'] == 'Hide' && get_theme_mod('widget-shadows') == 'On') {
			$shadow = "box-shadow: none;";
		} else if ($instance['hide-shadow'] == 'Show' && get_theme_mod('widget-shadows') != 'On') {
			$shadow = "box-shadow: -1px 0 2px 0 rgba(0, 0, 0, 0.12), 1px 0 2px 0 rgba(0, 0, 0, 0.12), 0 1px 1px 0 rgba(0, 0, 0, 0.24);";
		}

		foreach($sidebartest as $area => $widgets) {
			if ( is_array( $widgets ) ) foreach($widgets as $widget) {
				if ( $widget === $widget_id ) $current_area = $area;	
			}
    	}		

    	$first_widget = 'Yes';
		if (substr($current_area, -4) != 'h-11' && substr($current_area, -4) != 'r-11') {
	    	$first_widget = 'No'; 			
		}
    	if ($sidebartest[$current_area][0] != $widget_id) { 
	    	$first_widget = 'No'; 
	    }

		if ($first_widget == 'Yes') {
			if ($instance['remove-top-margin'] == 'on' && $instance['sidebarname'] == 'Full-Width') $top_margin_style = "margin-top: -15px;";
		}
		
		if ($instance['remove-bottom-margin'] == 'on' && $instance['sidebarname'] == 'Full-Width') $bottom_margin_style = "margin-bottom: 0px;";

		$widgetwrap_style = " style='$shadow$top_margin_style$bottom_margin_style'";
		$output .= "<div class='clear:both'></div>";
		$output .= "<div class='parallaxcontainer parallaxloading $widgetfullscreen' >";
		$output .= "<div class='widgetwrap carousel-widget $widgetfullscreen sno-$unique'$widgetwrap_style>";

		if ( $instance['custom-colors'] == 'snoccon' ) { 
			$widget_background_color = $instance['widget-background'];
		} else {
			$widget_background_style = str_replace("Style ", "", $instance['widget-style']);
			$widget_style_map = array( "0","1","7","3","4","6","8");
			$widget_style_mapped = $widget_style_map[$widget_background_style];
			$widget_background_color = get_theme_mod("widgetbackground$widget_style_mapped");
		}
		$expander_background = '';
		if ( $instance['hide-title'] != 'on' ) {
			$expander_background = $widget_background_color;
		} else if ( $instance['show-border'] == 'on' ) {
			$expander_background = $instance['carousel-border-color'];
		}
		if ( $instance['widget-expander-top'] != '0px' ) $output .= "<div class='widget-expander' style='background: $expander_background; padding-bottom:" . $instance['widget-expander-top'] . "'></div><div class='clear'></div>";
		 
		if ($instance['hide-title'] != 'on') $output .= sno_widget_styles($instance, $customcolors, $categoryslug, $videotitle, $categoryname);
				
		
		$exclusionarray = array();
		if ($instance['exclude'] == 'on') {
			if ($instance['exclude-number'] == 'All') {
				$exclude = '-' . $instance['exclude-cat'] . ',';
				$exclusionarray = sno_exclude_posts();
			} else {
				$exclusionarray = sno_exclude_posts($widget_type = 'widget', $cat = $instance['exclude-cat'], $exclude_number = $instance['exclude-number']); 
				$exclude = '';
			}
		} else {
			$exclude = '';
			$exclusionarray = sno_exclude_posts();
		}

			
		if ($instance['skip'] == 'on') {
			$offset = $instance['offset'];
		} else {
			$offset = 0;
		}

		// exclude any story ids that have been already rendered on the page and added to the session variable
		if (isset($_ENV['sno_exclude'])) foreach ($_ENV['sno_exclude'] as $key => $value) {
			$exclusionarray[] = $value;
		}
		
		if ($instance['category'] === '0') { 
			
			$uncategorized = $exclude.'-'.get_theme_mod('breaking-hidecat'); 
			$args = array ( 'meta_key' => '_thumbnail_id', 'cat' => $uncategorized, 'showposts' => $number, 'offset' => $offset, 'post__not_in' => $exclusionarray);
		} else {
			
			$args = array ( 'meta_key' => '_thumbnail_id', 'cat' => $instance['category'], 'showposts' => $number, 'category__not_in' => $exclude, 'offset' => $offset, 'post__not_in' => $exclusionarray);
		
		}
		
					
				// with new width options for site, the calculations above no longer always work right.  Use the new function to override that value
				

				$widget_area_info = sno_get_widget_width($widget);				
				$outer_width = $widget_area_info[1];
				
				
				if ( $instance['show-border'] == 'on' ) {
					$outer_width -= ($instance['carousel-border-thickness']	* 2);
				}
					$widget_style = $instance['widget-style'];
				
				if ($instance['hide-title'] != 'on') {
						
					switch ($widget_style) {
						case ('Style 1'): {
							if ($instance['custom-colors'] == 'snoccon') {
								$thickness = $instance['border-thickness'];
							} else {
								$thickness = get_theme_mod('widget1-thickness');
							}
							$border_thickness = 2 * (str_replace('px', '', $thickness));
							$border_thickness += 20; // widget padding
							$outer_width -= $border_thickness;
							break;
						}
						case ('Style 2'): {
							$border_thickness = 0;
							if (($instance['custom-colors'] == 'snoccon' && $instance['widget-padding'] == 'On') || ($instance['custom-colors'] != 'snoccon' && get_theme_mod('widget7-padding') == 'On')) {
								$border_thickness += 20; // widget padding
							} 
							$outer_width -= $border_thickness;
							break;
						}
						case ('Style 3'): {
							if ($instance['custom-colors'] == 'snoccon') {
								$thickness = $instance['border-thickness'];
							} else {
								$thickness = get_theme_mod('widget3-thickness');
							}
							$border_thickness = 2 * (str_replace('px', '', $thickness));
							$border_thickness += 20; // widget padding
							$outer_width -= $border_thickness;
							break;
						}
						case ('Style 4'): {
							if ($instance['custom-colors'] == 'snoccon') {
								$thickness = $instance['border-thickness'];
							} else {
								$thickness = get_theme_mod('widget4-thickness');
							}
							$border_thickness = 2 * (str_replace('px', '', $thickness));
							$border_thickness += 20; // widget padding
							$outer_width -= $border_thickness;
							break;
						}
						case ('Style 5'): {
							if ($instance['custom-colors'] == 'snoccon') {
								$thickness = $instance['border-thickness'];
							} else {
								$thickness = get_theme_mod('widget6-thickness');
							}
							$border_thickness = 2 * (str_replace('px', '', $thickness));
							$border_thickness += 20; // widget padding
							$outer_width -= $border_thickness;
							break;
						}
						case ('Style 6'): {
							$border_thickness = 0;
							$border_thickness += 20; // widget padding
							$outer_width -= $border_thickness;
							break;
						}

					}
				}
				
			$headlinesize = $instance['headline-size']; $headlinesize_px = $headlinesize . 'px';
			$lineheight = round($headlinesize * 1.2); $lineheight_px = $lineheight . 'px';
			$headline_style = " style='font-size:$headlinesize_px; line-height:$lineheight_px; '";

			$textsize = $instance['text-size']; $textsize_px = $textsize . 'px';
			$textlineheight = round($textsize * 1.4); $textlineheight_px = $textlineheight . 'px';
			$text_style = " style='font-size:$textsize_px; line-height:$textlineheight_px; '";

			$overlay_darkness = sno_get_opacity_code($instance['overlay-darkness']);
			$overlay_corners = $instance['overlay-corners'];
			$overlay_darkness_mobile = sno_get_opacity_code($instance['overlay-darkness-mobile']);
			$overlay_darkness_style = " style='background: #000000$overlay_darkness; border-radius: $overlay_corners;'";
			$mobile_overlay = " style='background: #000000$overlay_darkness_mobile;'";
			
			$activate_custom_overlay = $instance['overlay-custom']; $overlay_css = '';
			$overlay_info = $instance['custom-overlay']; 	
			
			$output .= '<div class="loading" style="position:relative;">';

	    				$preload_output = ''; $main_output = ''; $style_output = ''; $i = 0;
						query_posts( $args ); $wrapclass = ''; $count = 0;
						
						
						$preload_output .= '<div class="parallaximagesloading">';
						if (have_posts()) : while (have_posts()) : the_post(); global $post; $i++;
							
							$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
							$image0 = $image[0]; $image1 = $image[1]; $image2 = $image[2];
							$preload_output .= "<img src='$image0'>";
							
							$style_output .= "#slide-$unique-$i .bcg {background-image:url('$image0')}";

						
						endwhile; else: endif;  
						$preload_output .= '</div>';
						echo "<style>$style_output</style>";
				
				$output .= $preload_output;
				
				$frame_height = $instance['fixed-height']; 
				if ( $frame_height == '' ) $frame_height = '100';
				$frame_height_vh = $frame_height . 'vh';
				
				
				// set overlay location
				$story_data_points = '';
				$overlay_location = $instance['overlay'];
					switch ($overlay_location) {
						case ('Top Left'): {
							$story_data_class = 'top-left';
							$story_data_points = "data--100-bottom='opacity: 0;top:40vh' data--300-bottom='opacity: 1;top:25vh' data-center='opacity: 1;top:15vh;' data-100-top='opacity: 1;top:15vh' data--100-top='opacity: 0;top:15vh;' ";
							break;
						}
						case ('Top Center'): {
							$story_data_class = 'top-center';
							$story_data_points = "data--100-bottom='opacity: 0;top:40vh' data--300-bottom='opacity: 1;top:25vh' data-center='opacity: 1;top:15vh;' data-100-top='opacity: 1;top:15vh' data--100-top='opacity: 0;top:15vh;' ";
							break;
						}
						case ('Top Right'): {
							$story_data_class = 'top-right';
							$story_data_points = "data--100-bottom='opacity: 0;top:40vh' data--300-bottom='opacity: 1;top:25vh' data-center='opacity: 1;top:15vh;' data-100-top='opacity: 1;top:15vh' data--100-top='opacity: 0;top:15vh;' ";
							break;
						}
						case ('Middle Left'): {
							$story_data_class = 'middle-left';
							$story_data_points = "data-bottom='opacity: 0;' data--100-bottom='opacity:1;' data-center='opacity: 1; top:50%;' data-100-top='opacity:1; top:60%;' data--200-top='opacity: 0;top:70%)' ";
							break;
						}
						case ('Middle Center'): {
							$story_data_class = 'middle-center';
							$story_data_points = "data-bottom='opacity: 0;' data--100-bottom='opacity:1;' data-center='opacity: 1; top:50%;' data-100-top='opacity:1; top:60%;' data--200-top='opacity: 0;top:70%)' ";
							break;
						}
						case ('Middle Right'): {
							$story_data_class = 'middle-right';
							$story_data_points = "data-bottom='opacity: 0;' data--100-bottom='opacity:1;' data-center='opacity: 1; top:50%;' data-100-top='opacity:1; top:60%;' data--200-top='opacity: 0;top:70%)' ";
							break;
						}
						case ('Bottom Left'): {
							$story_data_class = 'bottom-left';
							$story_data_points = "data-100-bottom='opacity: 0;' data--100-bottom='opacity: 1; bottom:15vh;' data-center='opacity: 1; bottom:30vh;' data-200-top='opacity: 0; bottom:45vh;' ";
							break;
						}
						case ('Bottom Center'): {
							$story_data_class = 'bottom-center';
							$story_data_points = "data-100-bottom='opacity: 0;' data--100-bottom='opacity: 1; bottom:15vh;' data-center='opacity: 1; bottom:30vh;' data-200-top='opacity: 0; bottom:45vh;' ";
							break;
						}
						case ('Bottom Right'): {
							$story_data_class = 'bottom-right';
							$story_data_points = "data-100-bottom='opacity: 0;' data--100-bottom='opacity: 1; bottom:15vh;' data-center='opacity: 1; bottom:30vh;' data-200-top='opacity: 0; bottom:45vh;' ";
							break;
						}
						case ('None'): {
							$story_data_class = 'display-none;';
							break;
						}
					}


			$test_for_mobile = new SNO_Mobile_Detect;
				if ( $test_for_mobile->isMobile() ) {
					$main_output .= '<style>.parallaxcontainer { height: auto !important; }</style>';
				} else {
					?>
					<script type="text/javascript">
						$(window).load(function() {
							$body = $('.parallaxcontainer');
							var s = skrollr.init({
								forceHeight: false
							}); 
							$(".parallaxcontainer").css('height','auto');
							$(".parallaxcontainer section").fadeIn(2000);
							s.refresh($('.homeSlide'));
						});
					</script>
					<?php
				}	
			rewind_posts(); $i = 0; $slide = 0;
			if (have_posts()) : while (have_posts()) : the_post(); global $post; $i++;
				$custom_fields = get_post_custom($post->ID); $customlink = '';
				if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
				if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }

				if ( $test_for_mobile->isMobile() ) {		

					$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
					$image0 = $image[0]; $image1 = $image[1]; $image2 = $image[2];

					$main_output .= "<div class='parallax-mobile-widget-tile'>";
						$main_output .= "<img src='$image0' id='img-$unique-$i' $cropping alt='" . get_the_title() . "' style='width:100%;'/>"; 

					$main_output .= "<div id='text-$unique-$i' class='parallax-mobile-overlay desc'$mobile_overlay>";
					
						$main_output .= "<div id='text-overlay-parallax-mobile-$unique-$i'>";
									

						if (isset ($single_cat) && $instance['show-cat'] == 'on') {
							$main_output .= "<div class='topstorycat'>";
								$main_output .= '<span class="blockscat">';
									$main_output .= get_cat_name($single_cat);
								$main_output .= '</span>';
							$main_output .= '</div>';
						}
															 						
						$main_output .= "<div class='parallaxtitle widgetheadlineoverlay'><a class='homeheadline' href='" . $storylink . "'$headline_style>" . get_the_title() . "</a></div>";
									
						$writer = '';
						if ($instance['show-writer'] == 'on') $writer = snowriter(); 
						$showdate = $instance['show-date'];
									
						if (($writer) || ($showdate == "on")) {
							$main_output .= "<p class='carouselbyline'>";
								if ($writer) $main_output .= "<span class='sno_writer_carousel'>$writer</span>";
								if ($showdate == 'on') { 
									if ($writer) $main_output .= '</p><p>'; 
									$main_output .= '<span class="sno_date_carousel">' . get_sno_timestamp() . '</span>';
								}		
							$main_output .= "</p>";
						}

  						if ( $instance['show-continue'] == 'on' ) {
							$main_output .= "<div class='continue-overlay'><span class='continue-overlay-link'>";
								$continue_text = get_theme_mod('read-text');
								if ($continue_text == '') $continue_text = "Read Story";
								$main_output .= $continue_text;
							$main_output .= '<span></div>';
						}
					
					$main_output .= '</div></div></div>';
					$main_output .= "	
									<script type='text/javascript'>
										$(document).ready(function() {
											$('#text-$unique-$i').click(function() {
												window.location=$(this).find('a').attr('href');
											});
										});
									</script>";
					$main_output .= "
							<script type='text/javascript'>
								$(document).ready(function() {
									var height = $('#text-overlay-parallax-mobile-$unique-$i').height();
									var photoHeight = $('#img-$unique-$i').height();
									var new_padding = Math.floor((photoHeight - height)/2); 
									$('#text-$unique-$i').css('padding-top', new_padding);
								});
							</script>";

				} else {
					$story_overlay_css = $overlay_darkness_style;
					$story_overlay_style = $overlay_style;
					$animation = '';
					$data_target = "#slide-$unique-$i .parallaxoverlay";
				
					if ( $activate_custom_overlay == 'on' ) {
						
						$animation_start = ''; $animation_pause = ''; $animation_stop = '';
						
						$custom_location = $overlay_info[$post->ID]['position'];
						$custom_darkness = sno_get_opacity_code($overlay_info[$post->ID]['darkness'] / 10);
						$story_overlay_css = " style='background-color: #000000$custom_darkness;border-radius:$overlay_corners;'";
					
						switch ($custom_location) {
							case ('Top Left'): {
								$story_data_class = 'top-left';
								$story_data_points = "data--100-bottom='opacity: 0;top:40vh' data--300-bottom='opacity: 1;top:25vh' data-center='opacity: 1;top:15vh;' data-100-top='opacity: 1;top:15vh' data--100-top='opacity: 0;top:15vh;' ";
								break;
							}
							case ('Top Center'): {
								$story_data_class = 'top-center';
								$story_data_points = "data--100-bottom='opacity: 0;top:40vh' data--300-bottom='opacity: 1;top:25vh' data-center='opacity: 1;top:15vh;' data-100-top='opacity: 1;top:15vh' data--100-top='opacity: 0;top:15vh;' ";
								break;
							}
							case ('Top Right'): {
								$story_data_class = 'top-right';
								$story_data_points = "data--100-bottom='opacity: 0;top:40vh' data--300-bottom='opacity: 1;top:25vh' data-center='opacity: 1;top:15vh;' data-100-top='opacity: 1;top:15vh' data--100-top='opacity: 0;top:15vh;' ";
								break;
							}
							case ('Middle Left'): {
								$story_data_class = 'middle-left';
								$story_data_points = "data-bottom='opacity: 0;' data--100-bottom='opacity:1;' data-center='opacity: 1; top:50%;' data-100-top='opacity:1; top:60%;' data--200-top='opacity: 0;top:70%)' ";
								break;
							}
							case ('Middle Center'): {
								$story_data_class = 'middle-center';
								$story_data_points = "data-bottom='opacity: 0;' data--100-bottom='opacity:1;' data-center='opacity: 1; top:50%;' data-100-top='opacity:1; top:60%;' data--200-top='opacity: 0;top:70%)' ";
								break;
							}
							case ('Middle Right'): {
								$story_data_class = 'middle-right';
								$story_data_points = "data-bottom='opacity: 0;' data--100-bottom='opacity:1;' data-center='opacity: 1; top:50%;' data-100-top='opacity:1; top:60%;' data--200-top='opacity: 0;top:70%)' ";
								break;
							}
							case ('Bottom Left'): {
								$story_data_class = 'bottom-left';
							$story_data_points = "data-100-bottom='opacity: 0;' data--100-bottom='opacity: 1; bottom:15vh;' data-center='opacity: 1; bottom:30vh;' data-200-top='opacity: 0; bottom:45vh;' ";
								break;
							}
							case ('Bottom Center'): {
								$story_data_class = 'bottom-center';
								$story_data_points = "data-100-bottom='opacity: 0;' data--100-bottom='opacity: 1; bottom:15vh;' data-center='opacity: 1; bottom:30vh;' data-200-top='opacity: 0; bottom:45vh;' ";
								break;
							}
							case ('Bottom Right'): {
								$story_data_class = 'bottom-right';
								$story_data_points = "data-100-bottom='opacity: 0;' data--100-bottom='opacity: 1; bottom:15vh;' data-center='opacity: 1; bottom:30vh;' data-200-top='opacity: 0; bottom:45vh;' ";
								break;
							}
							case ('None'): {
								$custom_position = 'display:none;';
								break;
							}
						}
					
					}
    				
    				$categories = get_the_category($post->ID); $cat_list = array();
					$catcount = count($categories);
					if ($catcount == 1) {
		    			foreach($categories as $category) $cat_list[] = $category->term_id;							
	    			} else {
						foreach($categories as $category)  {  	
							if ($category->term_id != $instance['category'] ) $cat_list[] = $category->term_id;	
						}			
					}
					$cat_list = array_filter($cat_list); $single_cat = $cat_list[0];

					if ( $i == 1 && $instance['first-photo-adjust'] == 'on' ) { $photo_buffer_center = "0px"; $photo_buffer_end = "400px"; } else { $photo_buffer_center = "0px"; $photo_buffer_end = "100px"; }
					$main_output .= "<section style='height:$frame_height_vh;'><div id='slide-$unique-$i' class='homeSlide' style='height:$frame_height_vh;opacity:1;'>";
						$main_output .= "<div class='bcg' ";
										$main_output .= "	data-center='background-position: 50% $photo_buffer_center;'
															data-top-bottom='background-position: 50% -100px;'
															data-bottom-top='background-position: 50% $photo_buffer_end;'
															data-anchor-target='#slide-$unique-$i'";
										$main_output .= "	>";

						$main_output .= "<div class='hsContainer'>";
						$main_output .= "<div class='hsContent $story_data_class' $story_data_points";
							$main_output .= " data-anchor-target='#slide-$unique-$i .parallaxtitle'";
						$main_output .= ">";
							
							
						$main_output .= "<div class='parallaxoverlay'$story_overlay_css>";

									if (isset ($single_cat) && $instance['show-cat'] == 'on') {
										$main_output .= "<div class='topstorycat' $catstyle>";
											$main_output .= '<div class="blockscat">';
												$main_output .= get_cat_name($single_cat);
											$main_output .= '</div>';
										$main_output .= '</div>';
									}
						
						$main_output .= "<div class='parallaxtitle widgetheadlineoverlay'><a class='homeheadline' href='" . $storylink . "'$headline_style>" . get_the_title() . "</a></div>";
									 						
									
									$writer = '';
									if ($instance['show-writer'] == 'on') $writer = snowriter(); 
									$showdate = $instance['show-date'];
									
									if (($writer) || ($showdate == "on")) {
										$main_output .= "<p class='carouselbyline'>";
										if ($writer) $main_output .= "<span class='sno_writer_carousel'>$writer</span>";
										if ($showdate == 'on') { 
											if ($writer) $main_output .= ' | '; 
											$main_output .= '<span class="sno_date_carousel">' . get_sno_timestamp() . '</span>';
										}
									
										$main_output .= "</p>";
									}

									$teaser = $instance['category-teaser']; if ($teaser == 0) { $kill_excerpt = 'on'; } else { $kill_excerpt = ''; }
									$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
									if ($excerpt && $kill_excerpt != 'on') { 
										$main_output .= "<div class='sno_teaser_carousel'$text_style>";
										$main_output .= '<p>' . $excerpt . '</p>'; 
										$main_output .= '</div>';
  									} else if ($teaser) { 
										$main_output .= "<div class='sno_teaser_carousel'$text_style>";
	  									$main_output .= get_the_content_limit($teaser, "");
										$main_output .= '</div>';
  									}
  									if ( $instance['show-continue'] != 'No' ) {
  										$main_output .= "<div class='continue-overlay'><span class='continue-overlay-link'>";
											if ($instance['category-teaser'] != 0 ) {
												$continue_text = get_theme_mod('continue-text');
											} else {
												$continue_text = get_theme_mod('read-text');
											}
  											if ($continue_text == '') $continue_text = "Continue Reading";
  											$main_output .= $continue_text;
  										$main_output .= '<span></div>';
									}
									
						$main_output .= '</div>';
						$main_output .= '<div class="clear"></div>';
					$main_output .= '</div></div></div></div></section>';
					$slide++;
				
				}
					
				endwhile; else: endif;  
				
				$output .= $main_output;

				$output .= "	
									<script type='text/javascript'>
										$(document).ready(function() {
											$('.bcg').click(function() {
												window.location=$(this).find('a').attr('href');
											});
										});
									</script>";
										

	    $output .= '</div>';
								
		
		$output .= "<div class='widget-expander' style='padding-bottom:" . $instance['widget-expander'] . "'></div><div class='clear'></div>";
				
	if ($instance['hide-title'] != 'on') { 

		$output .= "</div>";

		if ($instance['widget-style']=="Style 3") { $output .= "<div style='display:block !important;";
		
			if ($instance['custom-colors'] == "snoccon") { 
				$output .= "background: " . $instance['header-color']; 
				if ($instance['widget-gradient'] == "On") { 
					$output .= "url(" . get_bloginfo('template_url') . "/images/navbg.png) repeat-x"; 
				} else if ($instance['widget-gradient'] == 'Off') { 
					$output .= "url(" . get_bloginfo('template_url') . "/images/" . $instance['widget-pattern'] . ") repeat";
				} 
				$output .= "!important;";
			} else { 
				$output .= "background: " . get_theme_mod('widgetcolor3') . " ";
				if (get_theme_mod('widget3-gradient') == "On") { 
					$output .= "url(" . get_bloginfo('template_url') . "/images/navbg.png) repeat-x";
				} else if (get_theme_mod('widget3-gradient') == 'Off') { 
					$output .= "url(" . get_bloginfo('template_url') . "/images/" . get_theme_mod('widget3-pattern') . ") repeat";
				} 
				$output .= "!important;";
			}
		
			$output .= "' class='widgetfooter3'></div>"; 
		
		} else if ($instance['widget-style']=="Style 2") { 
			
			$output .="<div style='display:inline-block;'></div>"; 
		
		}
	

	}		
		
	$output .= "</div>";
	$output .= "</div>";
	$output .= "</div>";

	}

	if ($instance['exclude-this'] == 'on') {
		if (have_posts()) : while (have_posts()) : the_post();
			$_ENV['sno_exclude'][] = $post->ID;
		endwhile; else: endif; wp_reset_query();
	}
			
	echo $output;		
	
	

	wp_reset_query();
	} // end of check for full width area
	} // end of function
	

	function update( $new_instance, $old_instance ) {
		
		delete_transient( "sno_cat_" . $this->id );

		// let's add some code to force LiteSpeed to flush its cache when the widget is saved

		if ( is_plugin_active( 'litespeed-cache/litespeed-cache.php' ) ) {
			LiteSpeed_Cache_API::purge_all();
		}

		// cool, that's done

		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];													//active
		$instance['carousel-style'] = $new_instance['carousel-style'];									//active
		$instance['transition-style'] = $new_instance['transition-style'];								//active
		$instance['overlay'] = $new_instance['overlay'];												//active
		$instance['display-number'] = $new_instance['display-number'];									//active
		$instance['margin-width'] = $new_instance['margin-width'];										//active
		$instance['text-height'] = $new_instance['text-height'];										//active
		$instance['text-padding'] = $new_instance['text-padding'];										//active
		$instance['text-background'] = $new_instance['text-background'];								//active
		$instance['text-override-color'] = $new_instance['text-override-color'];						//active
		$instance['carousel-border-thickness'] = $new_instance['carousel-border-thickness'];			//active
		$instance['carousel-border-color'] = $new_instance['carousel-border-color'];					//active
		$instance['center-title'] = $new_instance['center-title'];										//active
		$instance['overlay-darkness'] = $new_instance['overlay-darkness'];								//active
		$instance['overlay-darkness-mobile'] = $new_instance['overlay-darkness-mobile'];				//active
		$instance['overlay-custom'] = $new_instance['overlay-custom'];									//active
		$instance['hide-shadow'] = $new_instance['hide-shadow'];										//active
		$instance['auto-scroll-speed'] = $new_instance['auto-scroll-speed'];							//active
		$instance['transition-speed'] = $new_instance['transition-speed'];								//active
		$instance['thumbnail-location'] = $new_instance['thumbnail-location'];							//active
		$instance['thumbnail-margin'] = $new_instance['thumbnail-margin'];								//active
		$instance['thumbnail-width'] = $new_instance['thumbnail-width'];								//active
		$instance['thumbnail-background'] = $new_instance['thumbnail-background'];						//active
		$instance['first-photo-adjust'] = $new_instance['first-photo-adjust'];							//active
		$instance['overlay-corners'] = $new_instance['overlay-corners'];								//active
		$instance['show-continue'] = $new_instance['show-continue'];									//active
		$instance['widget-style'] = $new_instance['widget-style'];
 		$instance['custom-colors'] = ( isset( $new_instance['custom-colors'] ) ? "snoccon" : "" );  
		$instance['header-color'] = $new_instance['header-color'];
		$instance['header-text'] = $new_instance['header-text'];
		$instance['widget-border'] = $new_instance['widget-border'];
		$instance['widget-background'] = $new_instance['widget-background'];
		$instance['border-thickness'] = $new_instance['border-thickness'];
		$instance['category'] = $new_instance['category'];												//active
		$instance['number'] = $new_instance['number'];
		$instance['fixed-height'] = $new_instance['fixed-height'];
		$instance['sidebarname'] = $new_instance['sidebarname'];										//active
		$instance['category-teaser'] = $new_instance['category-teaser'];
		$instance['headline-size'] = $new_instance['headline-size'];									//active
		$instance['text-size'] = $new_instance['text-size'];											//active
 		$instance['text-override'] = ( isset( $new_instance['text-override'] ) ? on : "" );  			//active
 		$instance['show-writer'] = ( isset( $new_instance['show-writer'] ) ? on : "" );  				//active
 		$instance['show-cat'] = ( isset( $new_instance['show-cat'] ) ? on : "" );  						//active
 		$instance['hide-title'] = ( isset( $new_instance['hide-title'] ) ? on : "" );  					//active
 		$instance['auto-scroll'] = ( isset( $new_instance['auto-scroll'] ) ? on : "" );  				//active
 		$instance['navigation-buttons'] = ( isset( $new_instance['navigation-buttons'] ) ? on : "" );  	//active
 		$instance['show-border'] = ( isset( $new_instance['show-border'] ) ? on : "" );  				//active
 		$instance['hide-load'] = ( isset( $new_instance['hide-load'] ) ? on : "" );  					//active
 		$instance['show-date'] = ( isset( $new_instance['show-date'] ) ? on : "" );  
 		$instance['custom-view-all'] = ( isset( $new_instance['custom-view-all'] ) ? on : "" );  
		$instance['border-thickness2'] = $new_instance['border-thickness2'];
		$instance['widget-gradient'] = $new_instance['widget-gradient'];
		$instance['widget-padding'] = $new_instance['widget-padding'];
		$instance['widget-indent'] = $new_instance['widget-indent'];
		$instance['widget-pattern'] = $new_instance['widget-pattern'];
		$instance['custom-link'] = $new_instance['custom-link'];
		$instance['box1'] = $new_instance['box1'];														//active
		$instance['box2'] = $new_instance['box2'];														//active
		$instance['box3'] = $new_instance['box3'];														//active
		$instance['widget-header-size'] = $new_instance['widget-header-size'];
		$instance['widget-expander'] = $new_instance['widget-expander'];
		$instance['widget-expander-top'] = $new_instance['widget-expander-top'];
 		$instance['exclude'] = ( isset( $new_instance['exclude'] ) ? on : "" );  						//active
 		$instance['exclude-this'] = ( isset( $new_instance['exclude-this'] ) ? on : "" );  						//active
		$instance['exclude-cat'] = $new_instance['exclude-cat'];										//active
 		$instance['skip'] = ( isset( $new_instance['skip'] ) ? on : "" );  								//active
		$instance['offset'] = $new_instance['offset'];													//active
		$instance['exclude-number'] = $new_instance['exclude-number'];												//active
		$instance['custom-overlay'] = $new_instance['custom-overlay'];												//active
 		$instance['full-width-activate'] = ( isset( $new_instance['full-width-activate'] ) ? on : "" );  						//active
 		$instance['remove-top-margin'] = ( isset( $new_instance['remove-top-margin'] ) ? on : "" );  						//active
 		$instance['remove-bottom-margin'] = ( isset( $new_instance['remove-bottom-margin'] ) ? on : "" );  						//active
 		$instance['show-thumbnails'] = ( isset( $new_instance['show-thumbnails'] ) ? on : "" );  						//active

		return $instance;
	}

	function form($instance) { 
		$defaults = array( 'number' => '3', 'carousel-border-thickness' => '5', 'fixed-height' => '100', 'headline-size' => '28', 'text-size' => '14', 'text-height' => '50', 'border-thickness' => '1px', 'category-teaser' => '0','headline-teaser' => '0', 'show-writer' => 'on', 'view-all' => 'on', 'show-date' => 'on', 'widget-style'=>get_theme_mod('widget-style-sno'), 'header-color' => get_theme_mod('widgetcolor1'), 'header-text' => get_theme_mod('widgetcolor1-text'), 'widget-border' => '#aaaaaa', 'widget-background' => '#eeeeee', 'border-thickness' => '1px', 'border-thickness2' => '3px', 'widget-gradient' => 'On', 'widget-header-size' => 'Small', 'widget-expander' => '0px', 'text-override-color' => '#ffffff', 'text-background' => '#eeeeee', 'carousel-border-color' => '#000000', 'full-width-activate' => 'on', 'overlay-darkness' => '.5', 'overlay-darkness-mobile' => '.2', 'remove-top-margin' => 'on', 'remove-bottom-margin' => 'on', 'hide-title' => 'on', 'overlay' => 'Middle Center', 'remove-top-margin' => 'on', 'remove-bottom-margin' => 'on', 'hide-shadow' => 'Hide', 'thumbnail-background' => '#eeeeee', 'widget-expander-top' => '0px', 'show-cat' => 'on', 'overlay-corners' => '5px', 'show-continue' => 'Yes' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$random = mt_rand(); $disable_js = ''; $hide_all = '';
		$number = $this->number;
		
		$check = $this->number; $currentScreen = get_current_screen(); 
		
		
if ($check == '__i__' && $currentScreen->id === "widgets"){
	echo '<div class="not_saved">';
		?><script type="text/javascript">
			initwidgetcar = setInterval(function() {
				$('.widget-control-save').prop("disabled", false); // Saving is now enabled.
				$('.widget-control-save').val("Save"); 
				clearInterval(initwidgetcar)		
   			}, 1000);
		</script><?php
		echo '<p>Hit the Save button, pardner, and we\'ll get this party started.</p>';
	echo '</div>';
	$hide_all = ' style="display:none;"';

		
}

if ($check == '__i__' ) { $disable_js = 'on'; } // disable javascript here
		
		if ( isset( $instance['box1'] ) ) if ( $instance['box1'] == 'Closed' ) { 
			$box1 = ' style="display:none"'; $expand1 = ''; $collapse1 = ' style="display:none"'; 
		} else { 
			$box1 = ''; $collapse1 = ''; $expand1 = ' style="display:none"'; 
		} 
		
		if ( isset ( $instance['box2'] ) ) if ( $instance['box2'] == 'Closed' ) { 
			$box2 = ' style="display:none"'; $expand2 = ''; $collapse2 = ' style="display:none"'; 
		} else { 
			$box2 = ''; $collapse2 = ''; $expand2 = ' style="display:none"'; 
		} 

		if ( isset ( $instance['box3'] ) ) if ( $instance['box3'] == 'Closed' ) { 
			$box3 = ' style="display:none"'; $expand3 = ''; $collapse3 = ' style="display:none"'; 
		} else { 
			$box3 = ''; $collapse3 = ''; $expand3 = ' style="display:none"'; 
		} 
		
		$widget_id = 'parallax-'.$number;
		$sidebartest = get_option('sidebars_widgets'); 
				
		$current_area = '';
		foreach($sidebartest as $area => $widgets) {
			if ( is_array( $widgets ) ) foreach($widgets as $widget) {
				if ( $widget === $widget_id ) $current_area = $area;
					
			}
    	}
    	
    	$first_widget = '';
		if (substr($current_area, -4) != 'h-11' && substr($current_area, -4) != 'r-11') {
	    	$first_widget = ' style="display:none"'; 			
		}
    	if ( $current_area != '' && $sidebartest[$current_area][0] != $widget_id) { 
	    	$first_widget = ' style="display:none"'; 
	    }
		$sidebarname = '';
		if (substr($current_area, -2) == '-2') {
			$sidebarname = 'Main Column';
		}

		if (substr($current_area, -3) == '-11') {
			$sidebarname = 'Full Width';
		}
		
	if ( $sidebarname != 'Full Width' ) { echo '<div style="display:none;">'; }

?><div class='hide_all'<?php echo $hide_all; ?>>

				<select style="display:none;" id="<?php echo $this->get_field_id('box1'); ?>" name="<?php echo $this->get_field_name( 'box1' ); ?>">
					<option value="Closed" <?php if ($instance['box1'] == 'Closed') echo ' selected="selected"'; ?>>Closed</option>
					<option value="Open" <?php if ($instance['box1'] == 'Open') echo ' selected="selected"'; ?>>Open</option>
				</select>
				<select style="display:none;" id="<?php echo $this->get_field_id('box2'); ?>" name="<?php echo $this->get_field_name( 'box2' ); ?>">
					<option value="Closed" <?php if ($instance['box2'] == 'Closed') echo ' selected="selected"'; ?>>Closed</option>
					<option value="Open" <?php if ($instance['box2'] == 'Open') echo ' selected="selected"'; ?>>Open</option>
				</select>
				<select style="display:none;" id="<?php echo $this->get_field_id('box3'); ?>" name="<?php echo $this->get_field_name( 'box3' ); ?>">
					<option value="Closed" <?php if ($instance['box3'] == 'Closed') echo ' selected="selected"'; ?>>Closed</option>
					<option value="Open" <?php if ($instance['box3'] == 'Open') echo ' selected="selected"'; ?>>Open</option>
				</select>
				<input type="hidden" id="<?php echo $this->get_field_id('sidebarname'); ?>" name="<?php echo $this->get_field_name('sidebarname'); ?>" value="<?php echo $sidebarname; ?>" />
						
		<div class="widgetsection" id="widgetsection1-<?php echo $random; ?>">
			<div class="expand" id="expand1-<?php echo $random; ?>" <?php echo $expand1; ?>></div><div class="collapse" id="collapse1-<?php echo $random; ?>" <?php echo $collapse1; ?>></div>
			Content Display Options
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody1-<?php echo $random; ?>" <?php echo $box1; ?>>

		<p><i><b>NOTE:</b> This widget will only show stories if they have a featured image.</i></p>

			<div class="widgetdivider"></div>


		<p><b>Select a category of stories</b></p>
			<?php wp_dropdown_categories(array('selected' => $instance['category'], 'name' => $this->get_field_name( 'category' ), 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'flex'), 'show_option_all' => __("All Posts", 'flex'), 'hide_empty' => '0' )); ?><br />
			
		

		<?php $categorytitle = cat_id_to_name($instance['category']); ?><input type="hidden" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $categorytitle; ?>" />




			<p>
				<select id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>">
					
					<?php
						if ($instance['number'] == '') $instance['number'] = 4; 
						for ($i = 1; $i <= 10; $i++) { 
							echo "<option value='$i'";
							if ($i == $instance['number']) echo ' selected="selected"';
							echo ">$i</option>";
						} ?>
				</select>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Stories'); ?></label>
			</p>
			
			<div class="widgetdivider"></div>

				<p><input type="checkbox" <?php if ($instance['exclude-this'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'exclude-this' ); ?>" name="<?php echo $this->get_field_name( 'exclude-this' ); ?>" /><label for="<?php echo $this->get_field_id('exclude-this'); ?>">Exclude stories in this widget from all other widgets loaded after this one</label></p>

				<p><input class="exclude<?php echo $random; ?>" type="checkbox" <?php if ($instance['exclude'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" /><label for="<?php echo $this->get_field_id('exclude'); ?>">Activate Exclusion Option</label></p>
				<div class="exclusionoption<?php echo $random; ?>">
					<p><b>Select a category to exclude</b></p>
					<?php wp_dropdown_categories(array('selected' => $instance['exclude-cat'], 'name' => $this->get_field_name( 'exclude-cat' ), 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '1' )); ?><br />
					
					<select id="<?php echo $this->get_field_id('exclude-number'); ?>" name="<?php echo $this->get_field_name('exclude-number'); ?>">
					<?php echo "<option value='All'";
						if ('All' == $instance['exclude-number']) echo ' selected="selected"';
						echo ">All</option>";
					for ($i = 1; $i <= 10; $i++) { 
						echo "<option value='$i'";
						if ($i == $instance['exclude-number']) echo ' selected="selected"';
						echo ">$i</option>";
					} ?>
				
					</select>
					<label for="<?php echo $this->get_field_id('exclude-number'); ?>"><?php _e('Number to Exclude'); ?></label>
<br /><br />
				</div>


			<div class="widgetdivider"></div>

				<p><input class="skip<?php echo $random; ?>" type="checkbox" <?php if ($instance['skip'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'skip' ); ?>" name="<?php echo $this->get_field_name( 'skip' ); ?>" /><label for="<?php echo $this->get_field_id('skip'); ?>">Skip Newest Stories</label></p>
				<div class="skipoption<?php echo $random; ?>">
				<p>
				<select id="<?php echo $this->get_field_id('offset'); ?>" name="<?php echo $this->get_field_name('offset'); ?>">
					<?php for ($i = 0; $i <= 10; $i++) { 
						echo "<option value='$i'";
						if ($i == $instance['offset']) echo ' selected="selected"';
						echo ">$i</option>";
					} ?>
				
				</select>
				<label for="<?php echo $this->get_field_id('number-headlines'); ?>"><?php _e('Stories to Skip'); ?></label>
				</p>
				</div>


			
			<div class="widgetdivider"></div>

			<p>
				<select id="<?php echo $this->get_field_id( 'headline-size' ); ?>" name="<?php echo $this->get_field_name( 'headline-size' ); ?>">
					<?php for ($i=14; $i <= 48; $i+=2) {
						echo "<option value='$i' ";
						if ($instance['headline-size'] == $i) echo 'selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id( 'headline-size' ); ?>">Headline Size</label>
			</p>
			
			<div class="overlayhide<?php echo $random; ?>">
			<p>
				<input id="<?php echo $this->get_field_id('category-teaser'); ?>" name="<?php echo $this->get_field_name('category-teaser'); ?>" type="text" maxlength="3" size="3" value="<?php echo $instance['category-teaser']; ?>" />
				<label for="<?php echo $this->get_field_id('category-teaser'); ?>">Teaser Length (characters)</label>
			</p>
			<p>
				<select id="<?php echo $this->get_field_id( 'text-size' ); ?>" name="<?php echo $this->get_field_name( 'text-size' ); ?>">
					<?php for ($i=10; $i <= 24; $i+=1) {
						echo "<option value='$i' ";
						if ($instance['text-size'] == $i) echo 'selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id( 'text-size' ); ?>">Teaser Text Size</label>
			</p>

			</div>

			<div class="widgetdivider"></div>

			<input class="checkbox" type="checkbox" <?php if ($instance['show-writer'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-writer' ); ?>" name="<?php echo $this->get_field_name( 'show-writer' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-writer' ); ?>">Show Byline</label>			
			<br />

			<input class="checkbox" type="checkbox" <?php if ($instance['show-date'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-date' ); ?>" name="<?php echo $this->get_field_name( 'show-date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-date' ); ?>">Show Date</label>			
			<br />
		
			<input class="checkbox" type="checkbox" <?php if ($instance['show-cat'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-cat' ); ?>" name="<?php echo $this->get_field_name( 'show-cat' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-cat' ); ?>">Show Category Name</label>			
			<br /><br />

				<select id="<?php echo $this->get_field_id( 'show-continue' ); ?>" name="<?php echo $this->get_field_name( 'show-continue' ); ?>">
					<option value="Yes" <?php if ( 'Yes' == $instance['show-continue'] ) echo 'selected="selected"'; ?>>Yes</option>
					<option value="No" <?php if ( 'No' == $instance['show-continue'] ) echo 'selected="selected"'; ?>>No</option>
				</select> Show Read More Link
			<br /><br />

		

		
					

		</div>

		<div class="widgetsection" id="widgetsection2-<?php echo $random; ?>">
			<div class="expand" id="expand2-<?php echo $random; ?>" <?php echo $expand2; ?>></div><div class="collapse" id="collapse2-<?php echo $random; ?>" <?php echo $collapse2; ?>></div>
			Parallax Display Options
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody2-<?php echo $random; ?>" <?php echo $box2; ?>>

			

			<?php if ($instance['fixed-height'] == '100px' && $instance['sidebarname'] == '') {
					if ($sidebarname == 'Full Width') { $instance['fixed-height'] = '450px'; }
					else if ($sidebarname == 'Main Column') { $instance['fixed-height'] = '300px'; }
					else { $instance['fixed-height'] = '200px'; }
			} ?>
			
			<p>
				<select id="<?php echo $this->get_field_id('fixed-height'); ?>" name="<?php echo $this->get_field_name('fixed-height'); ?>">
					<?php 
						for ($i = 50; $i <= 100; $i+=10) { 
							$height = $i . '%';
							echo "<option value='$i'";
							if ($i == $instance['fixed-height']) echo ' selected="selected"';
							echo ">$height</option>";
						} 
					?>
				
				</select>
				<label for="<?php echo $this->get_field_id('fixed-height'); ?>"><?php _e('Parallax Frame Height'); ?></label></p>
			<p>
				<select class="overlayoption<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'overlay' ); ?>" name="<?php echo $this->get_field_name( 'overlay' ); ?>">
					<option value="Top Left" <?php if ( 'Top Left' == $instance['overlay'] ) echo 'selected="selected"'; ?>>Top Left</option>
					<option value="Top Center" <?php if ( 'Top Center' == $instance['overlay'] ) echo 'selected="selected"'; ?>>Top Center</option>
					<option value="Top Right" <?php if ( 'Top Right' == $instance['overlay'] ) echo 'selected="selected"'; ?>>Top Right</option>
					<option value="Middle Left" <?php if ( 'Middle Left' == $instance['overlay'] ) echo 'selected="selected"'; ?>>Middle Left</option>
					<option value="Middle Center" <?php if ( 'Middle Center' == $instance['overlay'] ) echo 'selected="selected"'; ?>>Middle Center</option>
					<option value="Middle Right" <?php if ( 'Middle Right' == $instance['overlay'] ) echo 'selected="selected"'; ?>>Middle Right</option>
					<option value="Bottom Left" <?php if ( 'Bottom Left' == $instance['overlay'] ) echo 'selected="selected"'; ?>>Bottom Left</option>
					<option value="Bottom Center" <?php if ( 'Bottom Center' == $instance['overlay'] ) echo 'selected="selected"'; ?>>Bottom Center</option>
					<option value="Bottom Right" <?php if ( 'Bottom Right' == $instance['overlay'] ) echo 'selected="selected"'; ?>>Bottom Right</option>
					<option value="None" <?php if ( 'None' == $instance['overlay'] ) echo 'selected="selected"'; ?>>None</option>
				</select>
			 Overlay Position</p>
			<?php if ($instance['overlay-darkness'] == '') $instance['overlay-darkness'] = '.5'; ?>
			
			<p>
				<select id="<?php echo $this->get_field_id( 'overlay-darkness' ); ?>" name="<?php echo $this->get_field_name( 'overlay-darkness' ); ?>">
					<option value="0" <?php if ( '0' == $instance['overlay-darkness'] ) echo 'selected="selected"'; ?>>0 (Lightest)</option>
					<option value=".1" <?php if ( '.1' == $instance['overlay-darkness'] ) echo 'selected="selected"'; ?>>1</option>
					<option value=".2" <?php if ( '.2' == $instance['overlay-darkness'] ) echo 'selected="selected"'; ?>>2</option>
					<option value=".3" <?php if ( '.3' == $instance['overlay-darkness'] ) echo 'selected="selected"'; ?>>3</option>
					<option value=".4" <?php if ( '.4' == $instance['overlay-darkness'] ) echo 'selected="selected"'; ?>>4</option>
					<option value=".5" <?php if ( '.5' == $instance['overlay-darkness'] ) echo 'selected="selected"'; ?>>5 (Medium)</option>
					<option value=".6" <?php if ( '.6' == $instance['overlay-darkness'] ) echo 'selected="selected"'; ?>>6</option>
					<option value=".7" <?php if ( '.7' == $instance['overlay-darkness'] ) echo 'selected="selected"'; ?>>7</option>
					<option value=".8" <?php if ( '.8' == $instance['overlay-darkness'] ) echo 'selected="selected"'; ?>>8</option>
					<option value=".9" <?php if ( '.9' == $instance['overlay-darkness'] ) echo 'selected="selected"'; ?>>9</option>
					<option value="1" <?php if ( '1' == $instance['overlay-darkness'] ) echo 'selected="selected"'; ?>>10 (Darkest)</option>
				</select>
			 Overlay Darkness</p>

			<?php if ($instance['overlay-darkness-mobile'] == '') $instance['overlay-darkness-mobile'] = '.2'; ?>
			
			<p>
				<select id="<?php echo $this->get_field_id( 'overlay-darkness-mobile' ); ?>" name="<?php echo $this->get_field_name( 'overlay-darkness-mobile' ); ?>">
					<option value="0" <?php if ( '0' == $instance['overlay-darkness-mobile'] ) echo 'selected="selected"'; ?>>0 (Lightest)</option>
					<option value=".1" <?php if ( '.1' == $instance['overlay-darkness-mobile'] ) echo 'selected="selected"'; ?>>1</option>
					<option value=".2" <?php if ( '.2' == $instance['overlay-darkness-mobile'] ) echo 'selected="selected"'; ?>>2</option>
					<option value=".3" <?php if ( '.3' == $instance['overlay-darkness-mobile'] ) echo 'selected="selected"'; ?>>3</option>
					<option value=".4" <?php if ( '.4' == $instance['overlay-darkness-mobile'] ) echo 'selected="selected"'; ?>>4</option>
					<option value=".5" <?php if ( '.5' == $instance['overlay-darkness-mobile'] ) echo 'selected="selected"'; ?>>5 (Darkest)</option>
				</select>
			 Overlay Darkness for Mobile</p>

			<p>
				<select id="<?php echo $this->get_field_id( 'overlay-corners' ); ?>" name="<?php echo $this->get_field_name( 'overlay-corners' ); ?>">
				<?php for ($i = 0; $i <= 20; $i++) { 
					$radius = $i . 'px';
					echo "<option value='$radius' "; 
					if ( $instance['overlay-corners'] == $radius ) echo 'selected="selected" ';
					echo ">$radius</option>";
				} ?>
				</select>
			 Overlay Corner Radius</p>
			


		
			<div class="widgetdivider"></div>

				<p><input class="overlay_activate<?php echo $random; ?>" type="checkbox" <?php if ($instance['overlay-custom'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'overlay-custom' ); ?>" name="<?php echo $this->get_field_name( 'overlay-custom' ); ?>" /><label for="<?php echo $this->get_field_id('overlay-custom'); ?>">Activate custom overlay design</label></p>
				
			<div class="overlay_info<?php echo $random; ?>">
				
			<?php 
					$crop_info = array();
					$args = array ( 'meta_key' => '_thumbnail_id', 'cat' => $instance['category'], 'showposts' => $instance['number'], 'category__not_in' => $exclude, 'offset' => $offset);
										
					query_posts( $args );
					if (have_posts()) : while (have_posts()) : the_post(); global $post; $postid = $post->ID;

						echo '<p>';
							echo '<b>' . $postid . ': ' . get_the_title() . '</b>';
							
							echo '<br />';

						echo '<select id="' . $this->get_field_id('custom-overlay') . '-' . $postid . '-position" name="' . $this->get_field_name('custom-overlay') . '['.$postid.'][position]">';
						$positions = array('Top Left','Top Center','Top Right','Middle Left','Middle Center','Middle Right','Bottom Left','Bottom Center','Bottom Right','None');
						if ($instance['custom-overlay'][$postid]['position'] == '') $instance['custom-overlay'][$postid]['position'] = 'Middle Center';
						foreach ($positions as $position) { 
							echo "<option value='$position'";
							if ($position == $instance['custom-overlay'][$postid]['position']) echo ' selected="selected"';
							echo ">$position</option>";
						} 
						
						echo '</select> Position<br />';

						echo '<select id="' . $this->get_field_id('custom-overlay') . '-' . $postid . '-darkness" name="' . $this->get_field_name('custom-overlay') . '['.$postid.'][darkness]">';

						if ($instance['custom-overlay'][$postid]['darkness'] == '') $instance['custom-overlay'][$postid]['darkness'] = '5';
						for ($i = 0; $i <= 10; $i+=1) { 
							$darkness = $i;
							echo "<option value='$darkness'";
							if ($darkness == $instance['custom-overlay'][$postid]['darkness']) echo ' selected="selected"';
							$darkness_label = '';
							if ($darkness == 0) $darkness_label .= ' (Lightest)'; if ($darkness == 5) $darkness_label .= ' (Medium)'; if ($darkness == 10) $darkness_label .= ' (Darkest)';
							echo ">$darkness$darkness_label</option>";
						} 
						
						echo '</select> Darkness';

						echo '</p>';
						
					
					endwhile; else: endif; wp_reset_query();	
					
			?>				
			
			</div>

			<div class="widgetdivider"></div>

				<p><input type="checkbox" <?php if ($instance['first-photo-adjust'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'first-photo-adjust' ); ?>" name="<?php echo $this->get_field_name( 'first-photo-adjust' ); ?>" /><label for="<?php echo $this->get_field_id('first-photo-adjust'); ?>">Shift First Photo Down</label></p>
				

		</div>
		
		<div class="widgetsection" id="widgetsection3-<?php echo $random; ?>">
			<div class="expand" id="expand3-<?php echo $random; ?>" <?php echo $expand3; ?>></div><div class="collapse" id="collapse3-<?php echo $random; ?>" <?php echo $collapse3; ?>></div>
			Widget Appearance
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody3-<?php echo $random; ?>" <?php echo $box3; ?>>
			
			<p><input class="hidetitle<?php echo $random; ?>" type="checkbox" <?php if ($instance['hide-title'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'hide-title' ); ?>" name="<?php echo $this->get_field_name( 'hide-title' ); ?>" /><label for="<?php echo $this->get_field_id('hide-title'); ?>">Hide widget title, border, and background</label></p>

				
		<div id="hidewidgetdesignoptions-<?php echo $random; ?>">

		
		<p>
			<select class="widgetstyle<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'widget-style' ); ?>" name="<?php echo $this->get_field_name( 'widget-style' ); ?>">
				<option value="Style 1" <?php if ( 'Style 1' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 1</option>
				<option value="Style 2" <?php if ( 'Style 2' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 2</option>
				<option value="Style 3" <?php if ( 'Style 3' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 3</option>
				<option value="Style 4" <?php if ( 'Style 4' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 4</option>
				<option value="Style 5" <?php if ( 'Style 5' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 5</option>
				<option value="Style 6" <?php if ( 'Style 6' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 6</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'widget-style' ); ?>">Widget Style</label>
		</p>


		<p>
			<input class="customoptionscheckbox<?php echo $random; ?>" type="checkbox" <?php if ($instance['custom-colors'] == "snoccon") echo checked; ?> id="<?php echo $this->get_field_id( 'custom-colors' ); ?>" name="<?php echo $this->get_field_name( 'custom-colors' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'custom-colors' ); ?>">Activate Custom Design</label>			
		</p>



		<div class="widgetdivider"></div>


		<div class="customoptions<?php echo $random; ?>">
			<select class="widgetheader<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'widget-gradient' ); ?>" name="<?php echo $this->get_field_name( 'widget-gradient' ); ?>">
				<option value="On" <?php if ( 'On' == $instance['widget-gradient'] ) echo 'selected="selected"'; ?>>Gradient</option>
				<option value="Off" <?php if ( 'Off' == $instance['widget-gradient'] ) echo 'selected="selected"'; ?>>Pattern</option>
				<option value="None" <?php if ( 'None' == $instance['widget-gradient'] ) echo 'selected="selected"'; ?>>None</option>
			</select> Header Overlay<br />
			
			<?php $sno_id_base = $this->id_base; ?>
			<?php $selectid = 'widget-'.$sno_id_base.'-'.$number.'-widget-pattern'; ?>
			<?php $selectname = 'widget-'.$sno_id_base.'['.$number.']'; ?>
			<?php $value = $instance['widget-pattern']; ?>

			<div class="widgetheaderoptions<?php echo $random; ?>">
				<?php sno_widget_pattern_selectbox($selectid, $selectname, $value, 'widget-pattern'); ?> Pattern<br />
			</div>
			<br />
			<div class="widgetdivider"></div>


			<label style="display:block" for="<?php echo $this->get_field_id('header-color'); ?>">Header Color</label>
			<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('header-color'); ?>" name="<?php echo $this->get_field_name('header-color'); ?>" value="<?php echo $instance['header-color']; ?>" />

			<br />

			<label style="display:block" for="<?php echo $this->get_field_id('header-text'); ?>">Header Text</label>
			<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('header-text'); ?>" name="<?php echo $this->get_field_name('header-text'); ?>" value="<?php echo $instance['header-text']; ?>" />

			<br />


			<label style="display:block" for="<?php echo $this->get_field_id('widget-border'); ?>">Widget Border</label>
			<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('widget-border'); ?>" name="<?php echo $this->get_field_name('widget-border'); ?>" value="<?php echo $instance['widget-border']; ?>" />

			<br />

			<label style="display:block" for="<?php echo $this->get_field_id('widget-background'); ?>">Widget Background</label>
			<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('widget-background'); ?>" name="<?php echo $this->get_field_name('widget-background'); ?>" value="<?php echo $instance['widget-background']; ?>" />

			
			<br /><br />
			
			<div class="widgetdivider"></div>

			<select class="widgetheader<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'widget-header-size' ); ?>" name="<?php echo $this->get_field_name( 'widget-header-size' ); ?>">
				<option value="Small" <?php if ( 'Small' == $instance['widget-header-size'] ) echo 'selected="selected"'; ?>>Small</option>
				<option value="Medium" <?php if ( 'Medium' == $instance['widget-header-size'] ) echo 'selected="selected"'; ?>>Medium</option>
				<option value="Large" <?php if ( 'Large' == $instance['widget-header-size'] ) echo 'selected="selected"'; ?>>Large</option>
			</select> Header Text Size<br />
			
		<p class="style6options<?php echo $random; ?>">
			<input type="checkbox" <?php if ($instance['center-title'] == "on") echo checked; ?> id="<?php echo $this->get_field_id( 'center-title' ); ?>" name="<?php echo $this->get_field_name( 'center-title' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'center-title' ); ?>">Center Title</label>			
		</p>
			
			
			<br />

			<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('.my-color-picker').wpColorPicker();
			});
			jQuery('.my-color-picker').wpColorPicker();
			</script>
			
			<div class="widgetdivider"></div>

			<select id="<?php echo $this->get_field_id( 'border-thickness' ); ?>" name="<?php echo $this->get_field_name( 'border-thickness' ); ?>">
				<?php for ($i=0; $i <= 10; $i++) {
					$width = $i . 'px';
					echo "<option value='$width' ";
					if ($instance['border-thickness'] == $width) echo 'selected="selected"';
					echo ">$width</option>";
				} ?>
			</select>
			<label for="<?php echo $this->get_field_id( 'border-thickness' ); ?>"> Widget Border</label>

			<br />
			
		<div class="style2options<?php echo $random; ?>">
			<select id="<?php echo $this->get_field_id( 'border-thickness2' ); ?>" name="<?php echo $this->get_field_name( 'border-thickness2' ); ?>">
				<?php for ($i=0; $i <= 10; $i++) {
					$width = $i . 'px';
					echo "<option value='$width' ";
					if ($instance['border-thickness2'] == $width) echo 'selected="selected"';
					echo ">$width</option>";
				} ?>
			</select>
			<label for="<?php echo $this->get_field_id( 'border-thickness' ); ?>"> Header Bottom Border</label>
			
			<br />
		</div>
		<br />
		<div class="widgetdivider"></div>
		<div class="style2options<?php echo $random; ?>">

			

			<select id="<?php echo $this->get_field_id( 'widget-padding' ); ?>" name="<?php echo $this->get_field_name( 'widget-padding' ); ?>">
				<option value="On" <?php if ( 'On' == $instance['widget-padding'] ) echo 'selected="selected"'; ?>>On</option>
				<option value="Off" <?php if ( 'Off' == $instance['widget-padding'] ) echo 'selected="selected"'; ?>>Off</option>
			</select> Body Padding
			
			<br />


		</div>
		<div class="style26options<?php echo $random; ?>">

			<select id="<?php echo $this->get_field_id( 'widget-indent' ); ?>" name="<?php echo $this->get_field_name( 'widget-indent' ); ?>">
				<option value="On" <?php if ( 'On' == $instance['widget-indent'] ) echo 'selected="selected"'; ?>>On</option>
				<option value="Off" <?php if ( 'Off' == $instance['widget-indent'] ) echo 'selected="selected"'; ?>>Off</option>
			</select> Title Indent<br />

			<br />
		</div>
		</div> <?php // end of div to hide widget design options ?>
		</div>
		<?php if ( $sidebarname == 'Full Width' ) { ?>


				<p><input class="full_width_activate<?php echo $random; ?>" type="checkbox" <?php if ($instance['full-width-activate'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'full-width-activate' ); ?>" name="<?php echo $this->get_field_name( 'full-width-activate' ); ?>" /><label for="<?php echo $this->get_field_id('full-width-activate'); ?>">Extend Widget to Full Browser Width</label></p>
			<div class="widgetdivider"></div>

		<?php } ?>
		
				

		<div class="widgetfullwidth" <?php if ( $sidebarname != 'Full Width' ) { ?>style="display:none;"<?php } ?>>

		<div class="firstwidget"<?php echo $first_widget; ?>> 
			<p><input class="checkbox" type="checkbox" <?php if ($instance['remove-top-margin'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'remove-top-margin' ); ?>" name="<?php echo $this->get_field_name( 'remove-top-margin' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'remove-top-margin' ); ?>"<?php echo $first_widget; ?>>Remove Top Margin</label></p>
		</div>
			
			<p><input class="checkbox" type="checkbox" <?php if ($instance['remove-bottom-margin'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'remove-bottom-margin' ); ?>" name="<?php echo $this->get_field_name( 'remove-bottom-margin' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'remove-bottom-margin' ); ?>">Remove Bottom Margin</label></p>
			<div class="widgetdivider"></div>
		</div>

			<p>
				<select class="hideshadow<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'hide-shadow' ); ?>" name="<?php echo $this->get_field_name( 'hide-shadow' ); ?>">
					<option value="Use Default" <?php if ( 'Use Default' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Use Default</option>
					<option value="Hide" <?php if ( 'Hide' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Hide</option>
					<option value="Show" <?php if ( 'Show' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Show</option>
				</select>
				
			 Widget Drop Shadow</p>
		<p>
			<select class="widgetstyle<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'widget-expander-top' ); ?>" name="<?php echo $this->get_field_name( 'widget-expander-top' ); ?>">
				<?php for ($i=0; $i<101; $i++) { ?>
					<?php $height = $i . 'px'; ?>
					<option value="<?php echo $height; ?>" <?php if ( $instance['widget-expander-top'] == $height ) echo 'selected="selected"'; ?>><?php echo $height; ?></option>
				<?php } ?>
			</select> Space Buffer Above Title
		</p>
		<p>
			<select class="widgetstyle<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'widget-expander' ); ?>" name="<?php echo $this->get_field_name( 'widget-expander' ); ?>">
				<?php for ($i=0; $i<101; $i++) { ?>
					<?php $height = $i . 'px'; ?>
					<option value="<?php echo $height; ?>" <?php if ( $instance['widget-expander'] == $height ) echo 'selected="selected"'; ?>><?php echo $height; ?></option>
				<?php } ?>
			</select> Extend Widget Height
		</p>

	<?php 
		$wid = array(); 
		$wid[0] = $this->number;
		$wid[1] = $this->get_field_id('box1'); 
		$wid[2] = $this->get_field_id('box2'); 
		$wid[3] = $this->get_field_id('box3'); 
	//	sno_widget_toggles($wid, $boxes=3, $random);
		sno_widget_interface_styles(); 
	?>
		
	<?php if ($disable_js == '') { ?>
	
	<script type="text/javascript">

			jQuery('.customoptionscheckbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.customoptions<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.customoptionscheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".customoptions<?php echo $random; ?>").show();
			} else {
				jQuery(".customoptions<?php echo $random; ?>").hide();
			}

    		jQuery(".widgetstyle<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "Style 2") ? jQuery(".style2options<?php echo $random; ?>").slideDown('slow') : jQuery(".style2options<?php echo $random; ?>").slideUp('slow');
        		(jQuery(this).val() == "Style 6") ? jQuery(".style6options<?php echo $random; ?>").slideUp('slow') : jQuery(".style6options<?php echo $random; ?>").slideDown('slow');
        		(jQuery(this).val() == "Style 2" || jQuery(this).val() == "Style 6") ? jQuery(".style26options<?php echo $random; ?>").slideDown('slow') : jQuery(".style26options<?php echo $random; ?>").slideUp('slow');
    		});
        	(jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 2") ? jQuery(".style2options<?php echo $random; ?>").show() : jQuery(".style2options<?php echo $random; ?>").hide();
        	(jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 6") ? jQuery(".style6options<?php echo $random; ?>").hide() : jQuery(".style6options<?php echo $random; ?>").show();
        	(jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 2" || jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 6") ? jQuery(".style26options<?php echo $random; ?>").show() : jQuery(".style26options<?php echo $random; ?>").hide();
		
			jQuery('.hidetitle<?php echo $random; ?>').change(function() {
   		 		jQuery('#hidewidgetdesignoptions-<?php echo $random; ?>').slideToggle('slow');
			});
    		if (jQuery('.hidetitle<?php echo $random; ?>').prop('checked')) {
				jQuery("#hidewidgetdesignoptions-<?php echo $random; ?>").hide();
			} else {
				jQuery("#hidewidgetdesignoptions-<?php echo $random; ?>").show();
			}


			jQuery('.exclude<?php echo $random; ?>').change(function() {
   		 		jQuery('.exclusionoption<?php echo $random; ?>').slideToggle('slow');
			});
    		if (jQuery('.exclude<?php echo $random; ?>').prop('checked')) {
				jQuery(".exclusionoption<?php echo $random; ?>").show();
			} else {
				jQuery(".exclusionoption<?php echo $random; ?>").hide();
			}

			jQuery('.skip<?php echo $random; ?>').change(function() {
   		 		jQuery('.skipoption<?php echo $random; ?>').slideToggle('slow');
			});
    		if (jQuery('.skip<?php echo $random; ?>').prop('checked')) {
				jQuery(".skipoption<?php echo $random; ?>").show();
			} else {
				jQuery(".skipoption<?php echo $random; ?>").hide();
			}

			jQuery('.overlay_activate<?php echo $random; ?>').change(function() {
   		 		jQuery('.overlay_info<?php echo $random; ?>').slideToggle('slow');
			});
    		if (jQuery('.overlay_activate<?php echo $random; ?>').prop('checked')) {
				jQuery(".overlay_info<?php echo $random; ?>").show();
			} else {
				jQuery(".overlay_info<?php echo $random; ?>").hide();
			}





    				jQuery("#widgetsection1-<?php echo $random; ?>").click(function() {
    			    	jQuery("#widgetbody1-<?php echo $random; ?>").slideToggle('slow');
    			    	jQuery("#collapse1-<?php echo $random; ?>").toggle();
    			    	jQuery("#expand1-<?php echo $random; ?>").toggle();
    					if(jQuery('#collapse1-<?php echo $random; ?>').is(':visible')) { 
    						jQuery("#widgetbody2-<?php echo $random; ?>").slideUp('slow'); 
    						jQuery("#widgetbody3-<?php echo $random; ?>").slideUp('slow'); 
	    			    	jQuery("#collapse2-<?php echo $random; ?>").hide();
	    			    	jQuery("#collapse3-<?php echo $random; ?>").hide();
	    			    	jQuery("#expand2-<?php echo $random; ?>").show();
	    			    	jQuery("#expand3-<?php echo $random; ?>").show();
     						jQuery('#<?php echo $wid[1]; ?>').val('Open'); 
     						jQuery('#<?php echo $wid[2]; ?>').val('Closed'); 
     						jQuery('#<?php echo $wid[3]; ?>').val('Closed'); 
    					} 

    				});
    				jQuery("#widgetsection2-<?php echo $random; ?>").click(function() {
    			    	jQuery("#widgetbody2-<?php echo $random; ?>").slideToggle('slow');
    			    	jQuery("#collapse2-<?php echo $random; ?>").toggle();
    			    	jQuery("#expand2-<?php echo $random; ?>").toggle();
    					if(jQuery('#collapse2-<?php echo $random; ?>').is(':visible')) { 
    						jQuery("#widgetbody1-<?php echo $random; ?>").slideUp('slow'); 
    						jQuery("#widgetbody3-<?php echo $random; ?>").slideUp('slow'); 
	    			    	jQuery("#collapse1-<?php echo $random; ?>").hide();
	    			    	jQuery("#collapse3-<?php echo $random; ?>").hide();
	    			    	jQuery("#expand1-<?php echo $random; ?>").show();
	    			    	jQuery("#expand3-<?php echo $random; ?>").show();
     						jQuery('#<?php echo $wid[1]; ?>').val('Closed'); 
     						jQuery('#<?php echo $wid[2]; ?>').val('Open'); 
     						jQuery('#<?php echo $wid[3]; ?>').val('Closed'); 
    					} 
    				});
    				jQuery("#widgetsection3-<?php echo $random; ?>").click(function() {
    			    	jQuery("#widgetbody3-<?php echo $random; ?>").slideToggle('slow');
    			    	jQuery("#collapse3-<?php echo $random; ?>").toggle();
    			    	jQuery("#expand3-<?php echo $random; ?>").toggle();
    					if(jQuery('#collapse3-<?php echo $random; ?>').is(':visible')) { 
    						jQuery("#widgetbody1-<?php echo $random; ?>").slideUp('slow'); 
    						jQuery("#widgetbody2-<?php echo $random; ?>").slideUp('slow'); 
	    			    	jQuery("#collapse1-<?php echo $random; ?>").hide();
	    			    	jQuery("#collapse2-<?php echo $random; ?>").hide();
	    			    	jQuery("#expand1-<?php echo $random; ?>").show();
	    			    	jQuery("#expand2-<?php echo $random; ?>").show();
     						jQuery('#<?php echo $wid[1]; ?>').val('Closed'); 
     						jQuery('#<?php echo $wid[2]; ?>').val('Closed'); 
     						jQuery('#<?php echo $wid[3]; ?>').val('Open'); 
    					} 
    				});
			

	</script>
	
	<?php } ?>
		</div>
		<div class="lastsection"></div>
	</div>
	<?php 
		
		
	if ( $sidebarname != 'Full Width' ) { 
		echo '</div>'; 
		
		if ( $check != '__i__' ) {
		
			echo '<div class="not_the_right_area">';
				echo '<h3>Ah, snap!</h3><p>You can\'t use this widget here.  Try one of the full-width areas instead.</p>';
			echo '</div>';
		}
		
	}
		
	}
}
?>