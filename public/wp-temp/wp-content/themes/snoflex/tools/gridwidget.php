<?php

add_action('widgets_init', create_function('', "register_widget('sno_category_grid');"));
class sno_category_grid extends WP_Widget {

	function __construct() {

		$this->defaults = array(
			'title' => '',
			'image' => '',
			'link'  => ''
			);

		$widget_ops = array(
			'classname' => 'sno_category_grid',
			'description' => __( 'Use this widget to add a grid of stories.  Stories will only be displayed if they have a featured image.' )
			);

		$control_ops = array(
			'id_base' => 'grid'
			);

		parent::__construct( 'grid', __( '(SNO) Story Grid' ), $widget_ops, $control_ops );

	}


	function widget($args, $instance) {
		extract($args);
		
		wp_reset_query();
		$active_cat_id = get_query_var('cat');
				
		$transient_id = 'sno_cat_' . $this->id;
			
		$transient = get_transient( $transient_id );
				  
		if( ! empty( $transient ) && ! is_customize_preview() && ! is_user_logged_in()) {
    		
    		echo "\n<!-- widget displayed from cache -->\n";
    		
			echo $transient;
		
		} else {
		
		$output = ''; $count = 0; $unique_id = ''; $spacers = '';
		
		$widget = $this->id; 
		$unique = $widget;
		$sidebartest = get_option('sidebars_widgets'); 
				
		if (is_archive()) {
			$columns = get_theme_mod("cat-widget-layout-$active_cat_id");
		} else { 
			$columns = get_theme_mod('sno-layout'); 
		}
				
				
		$widget_area_info = sno_get_widget_width($widget);				
				
		if ($instance['custom-view-all']=="on") {
			$categoryslug = $instance['custom-link'];
			if ( !is_home() ) $categoryslug .= '?list';
		} else {
			$categoryslug = cat_id_to_slug($instance['category']); 
			if ( !is_home() ) $categoryslug .= '?list';
		}

		$categoryname = cat_id_to_name($instance['category']);
		if ($instance['category'] === '0') { $categoryname = "Recent Posts"; $categoryslug = "/";}
				
		$customcolors=$instance['custom-colors']; $videotitle = '';

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
				} else if ($args['id'] == 'mega-menu') {
					$instance['sidebarname'] = 'Full-Width'; 
				} else {
					$instance['sidebarname'] = 'Home Sidebar';
				}
		
		foreach($sidebartest as $area => $widgets) {
			if (is_array($widgets)) foreach($widgets as $widget) {
				if ( $widget === $widget_id ) $current_area = $area;	
			}
    	}		

		$shadow = '';
		if ($instance['hide-shadow'] == 'Hide' && get_theme_mod('widget-shadows') == 'On') {
			$shadow = "box-shadow: none;";
		} else if ($instance['hide-shadow'] == 'Show' && get_theme_mod('widget-shadows') != 'On') {
			$shadow = "box-shadow: -1px 0 2px 0 rgba(0, 0, 0, 0.12), 1px 0 2px 0 rgba(0, 0, 0, 0.12), 0 1px 1px 0 rgba(0, 0, 0, 0.24);";
		}

		$top_margin_style = '';
    	$first_widget = 'Yes';
		if (substr($current_area, -4) != 'h-11' && substr($current_area, -4) != 'r-11') {
	    	$first_widget = 'No'; 			
		}
    	if ($sidebartest[$current_area][0] != $widget_id) { 
	    	$first_widget = 'No'; 
	    }

		if ($first_widget == 'Yes') {
			if ($instance['remove-top-margin'] == 'on' ) $top_margin_style = "margin-top: -15px;";
		}

		$bottom_margin_style = '';
		if ($instance['remove-bottom-margin'] == 'on' && $instance['sidebarname'] == 'Full-Width') $bottom_margin_style = "margin-bottom: 0px;";

		$widgetwrap_style = " style='$shadow$top_margin_style$bottom_margin_style'";

		if ( $instance['custom-colors'] == 'snoccon' ) { 
			$widget_background_color = $instance['widget-background'];
		} else {
			$widget_background_style = str_replace("Style ", "", $instance['widget-style']);
			$widget_style_map = array( "0","1","7","3","4","6","8");
			$widget_style_mapped = $widget_style_map[$widget_background_style];
			$widget_background_color = get_theme_mod("widgetbackground$widget_style_mapped");
		}
		$expander_background = $widget_background_color;

		if ( $instance['widget-expander-top'] != '0px' ) $output .= "<div class='widget-expander' style='background: $expander_background; padding-bottom:" . $instance['widget-expander-top'] . "'></div><div class='clear'></div>";
		
		$output .= "<div class='widgetwrap carousel-widget sno-animate sno-$unique'$widgetwrap_style>";
		 
		if ($instance['hide-title'] != 'on') $output .= sno_widget_styles($instance, $customcolors, $categoryslug, $videotitle, $categoryname);			


					switch ($widget_area_info[0]) {
						case ('Full-Width'): {
							$outer_width = 950;
							if (get_theme_mod('outerwrap') == get_theme_mod('innerbackground')) $outer_width += 30;
							break;
						}
						case ('Main Column'): {
							$outer_width = 615;
							if (get_theme_mod('outerwrap') == get_theme_mod('innerbackground')) $outer_width += 30;
							break;
						}
						case ('Wide'): {
							$outer_width = 420;
							if (get_theme_mod('outerwrap') == get_theme_mod('innerbackground')) $outer_width += 30;
							break;
						}
						case ('Narrow'): {
							$outer_width = 180;
							$instance['grid-style'] = 'Equal-Size Panels';
							$instance['equal-style-columns'] = 1;
							break;
						}
						case ('Mobile'): {
							$outer_width = 400;
							$instance['grid-style'] = 'Equal-Size Panels';
							$instance['equal-style-columns'] = 1;
							break;
						}
						case ('Small Sidebar'): {
							$outer_width = 300;
							if (get_theme_mod('outerwrap') == get_theme_mod('innerbackground')) $outer_width += 15;
							$instance['grid-style'] = 'Equal-Size Panels';
							$instance['equal-style-columns'] = 1;
							break;
						}
						default: {
							$outer_width = 320;
							$instance['grid-style'] = 'Equal-Size Panels';
							$instance['equal-style-columns'] = 1;
						}
							
					}
		
		$outer_width=$widget_area_info[1]; // this is overriding widths created in the options above -- remove the options above once this works.

		if ($instance['grid-style'] == 'Mixed-Size Panels') {
			if ($instance['mixed-style'] == '1 Left - 2 Right') { $number = 3; $spacers = 1; }
			if ($instance['mixed-style'] == '1 Left - 3 Right') { $number = 4; $spacers = 1; }
			if ($instance['mixed-style'] == '1 Left - 4 Right') { $number = 5; $spacers = 2; }
			if ($instance['mixed-style'] == '2 Left - 1 Center - 2 Right') { $number = 5; $spacers = 2; }
			if ($instance['mixed-style'] == '2 Top - 3 Bottom') $number = 5;
			if ($instance['mixed-style'] == '2 Top - 4 Bottom') $number = 6;
		}
		if ($instance['grid-style'] == 'Equal-Size Panels') {
			if ($instance['equal-style-rows'] == '') $instance['equal-style-rows'] = 3;
			if ($instance['equal-style-columns'] == '') $instance['equal-style-columns'] = 2;
			if ($instance['fixed-height'] == '') $instance['fixed-height'] = 200;
			$number = $instance['equal-style-rows'] * $instance['equal-style-columns'];
			$spacers = $instance['equal-style-columns'] - 1;
		}
		
		$not_bottom_row = $number - $instance['equal-style-columns'];
		
		
		$margin = $instance['margin-width']; if ($margin == '') $margin = 1;
		$interior_margins = $margin * $spacers;

			
			if ($instance['show-border'] == 'on') $outer_width -= ($instance['carousel-border-thickness'] * 2);
			$px_ratio = number_format((float)((100 / $outer_width)*$margin), 2, '.', '');
			
			if ($instance['grid-style'] == 'Mixed-Size Panels') { 
				$divider = 3;
			} else {
				$divider = $instance['equal-style-columns'];
			}
			
			$grid_panel_width = (100 - ($spacers * $px_ratio) ) / $divider;
			$side_margin_px = $px_ratio . '%';
			$grid_panel_width_pct = $grid_panel_width . '%';
			
			if ($instance['grid-style'] == 'Mixed-Size Panels') {
				
				if ($instance['mixed-style'] == '1 Left - 2 Right') {
					$big_grid_panel_width = 66.67 - $px_ratio;
					$small_grid_panel_width = 33.33;
					$pattern = array('big','small','small');
					$b_margin_pattern = array('no','yes','no');
					$v_spacers = 1;
				}
				if ($instance['mixed-style'] == '1 Left - 3 Right') {
					$big_grid_panel_width = 75 - $px_ratio;
					$small_grid_panel_width = 25;
					$pattern = array('big','small','small','small');
					$b_margin_pattern = array('no','yes','yes','no');
					$v_spacers = 2;
				}
				if ($instance['mixed-style'] == '1 Left - 4 Right') {
					$big_grid_panel_width = 50 - $px_ratio;
					$small_grid_panel_width = 25 - ($px_ratio / 2);
					$pattern = array('big','small-m','small','small-m','small');
					$b_margin_pattern = array('no','yes','yes','no','no');
					$v_spacers = 1;
				}
				if ($instance['mixed-style'] == '2 Top - 3 Bottom') {
					$big_grid_panel_width = (100 - $px_ratio) / 2;
					$small_grid_panel_width = (100 - ($px_ratio * 2)) / 3;
					$pattern = array('big','big-n','small-m','small-m','small');
					$b_margin_pattern = array('yes','yes','no','no','no');
					$v_spacers = 0;
				}
				if ($instance['mixed-style'] == '2 Top - 4 Bottom') {
					$big_grid_panel_width = (100 - $px_ratio) / 2;
					$small_grid_panel_width = (100 - ($px_ratio * 3)) / 4;
					$pattern = array('big','big-n','small-m','small-m','small-m','small');
					$b_margin_pattern = array('yes','yes','no','no','no','no');
					$v_spacers = 0;
				}

			}

			$tile_ratio = $instance['tile-ratio']; 
			if ($tile_ratio != 'Fixed Height') { 
				
				if ($tile_ratio == '3:1 Horizontal') $grid_panel_height = ($grid_panel_width*($outer_width/100))/3;
				if ($tile_ratio == '2:1 Horizontal') $grid_panel_height = ($grid_panel_width*($outer_width/100))/2;
				if ($tile_ratio == '3:2 Horizontal') $grid_panel_height = ($grid_panel_width*($outer_width/100) * 2)/3;
				if ($tile_ratio == 'Square') $grid_panel_height = $grid_panel_width*($outer_width/100);
				if ($tile_ratio == '2:3 Vertical') $grid_panel_height = ($grid_panel_width*($outer_width/100) * 3)/2;
			} else {
				$grid_panel_height = $instance['fixed-height']; 
			}
			
			$grid_panel_height_px = $grid_panel_height . 'px';
						
			$grid_panel_width_px = $grid_panel_width*($outer_width/100);
			
			$grid_panel_width_px = floor($grid_panel_width_px);
					
		$exclusionarray = array();
		if ($instance['exclude'] == 'on') {
			if ($instance['exclude-number'] == 'All') {
				$exclude = array($instance['exclude-cat']);
				$exclusionarray = sno_exclude_posts();
			} else {
				$exclusionarray = sno_exclude_posts($widget = 'widget', $cat = $instance['exclude-cat'], $exclude_number = $instance['exclude-number']); 
				$exclude = array();
			}
		} else {
			$exclude = array();
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
			
			$uncategorized = '-'.get_theme_mod('breaking-hidecat'); 
			$args = array ( 'meta_key' => '_thumbnail_id', 'cat' => $uncategorized, 'showposts' => $number, 'category__not_in' => $exclude, 'offset' => $offset, 'post__not_in' => $exclusionarray);
		
		} else {
			
			$args = array ( 'meta_key' => '_thumbnail_id', 'cat' => $instance['category'], 'showposts' => $number, 'category__not_in' => $exclude, 'offset' => $offset, 'post__not_in' => $exclusionarray);
		
		}

		$headlinesize = $instance['headline-size']; $headlinesize_px = $headlinesize . 'px';
		$lineheight = round($headlinesize * 1.2); $lineheight_px = $lineheight . 'px';
		$headline_style = " style='font-size:$headlinesize_px; line-height:$lineheight_px; margin-right:8px; margin-left:8px; '";


		if ($instance['overlay-location'] == 'Full Panel') { 
			$overlay_styles = "top:0;left:0;right:0;bottom:0;text-align:center;";
			$cat_style_align = "text-align:center;";
		} else if ($instance['overlay-location'] == 'Bottom') { 
			$overlay_styles = "left:0;right:0;bottom:0;padding-top:10px;";
		} else if ($instance['overlay-location'] == 'Top') { 
			$overlay_styles = "left:0;right:0;top:0;padding-top:10px;";
		}
		
		if ($instance['overlay'] == 'Show on Hover') {
			$overlay_styles .= "display:none;";
		}

		if ($instance['overlay-style'] != 'on') {
			$overlay_styles .= "background:none;";
		}
		
		$overlay = " style='$overlay_styles'";
		$mixed_tile = '';
		if ($instance['grid-style'] == 'Mixed-Size Panels') { 
			$mixed_tile = 'mixed-tile-mobile'; 
			$output .= "<style>
							@media only screen and (min-width: 600px) and (max-width: 800px) { 
								.mixed-tile-mobile { height: $grid_panel_height_px !important; max-height: $grid_panel_height_px !important; }
								.mixed-tile-mobile img { min-height: 0px !important; min-width: 0px !important; }
							}
						</style>";
		}
		
		$border_color = $instance['carousel-border-color']; if ($border_color == '') $border_color = '#ffffff';
		$border = ''; 
		$border_thickness = $instance['carousel-border-thickness'] . 'px';
		if ($instance['show-border'] == 'on') $border = "border:$border_thickness solid $border_color;";
		$output .= "<div class='grid-wrap' style='background:$border_color;$border'>";

//		$activate_cropping = $instance['cropping']; $crop_css = '';
					
//		$crop_info = $instance['crop-info']; 
		$test_for_mobile = new SNO_Mobile_Detect;

				
		query_posts( $args ); $wrapclass = ''; $count = 0; 
		if (have_posts()) : while (have_posts()) : the_post(); global $post; 
			$custom_fields = get_post_custom($post->ID); $customlink = '';
			if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
			if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }

			if ($instance['exclude-this'] == 'on') {
				$_ENV['sno_exclude'][] = $post->ID;
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
    					
			$cat_list = array_filter($cat_list); $co = ''; $single_cat = $cat_list[0];
		
			$margin_px = $margin . 'px';

			if ($instance['grid-style'] == 'Mixed-Size Panels') {
				if ($pattern[$count] == 'big' || $pattern[$count] == 'big-n') {
					$grid_panel_width = $big_grid_panel_width;
					$grid_panel_width_pct = $big_grid_panel_width . '%';
					if ($pattern[$count] == 'big') { $new_side_margin_px = $side_margin_px; } else { $new_side_margin_px = 0; }

					if ($tile_ratio == '3:1 Horizontal') $grid_panel_height = ($grid_panel_width*($outer_width/100))/3;
					if ($tile_ratio == '2:1 Horizontal') $grid_panel_height = ($grid_panel_width*($outer_width/100))/2;
					if ($tile_ratio == '3:2 Horizontal') $grid_panel_height = ($grid_panel_width*($outer_width/100) * 2)/3;
					if ($tile_ratio == 'Square') $grid_panel_height = $grid_panel_width*($outer_width/100);
					if ($tile_ratio == '2:3 Vertical') $grid_panel_height = ($grid_panel_width*($outer_width/100) * 3)/2;
					
					$height_adjustment = (floor($px_ratio*($outer_width/100))); 
					
					$small_grid_panel_height = ($grid_panel_height-($v_spacers * $height_adjustment))/($v_spacers + 1);			
					
	
				} else {
					$grid_panel_width = $small_grid_panel_width;
					$grid_panel_width_pct = $small_grid_panel_width . '%';
					$grid_panel_height = $small_grid_panel_height;
					
					if ($instance['mixed-style'] == '2 Top - 3 Bottom' || $instance['mixed-style'] == '2 Top - 4 Bottom') {
						if ($tile_ratio == '3:1 Horizontal') $grid_panel_height = ($grid_panel_width*($outer_width/100))/3;
						if ($tile_ratio == '2:1 Horizontal') $grid_panel_height = ($grid_panel_width*($outer_width/100))/2;
						if ($tile_ratio == '3:2 Horizontal') $grid_panel_height = ($grid_panel_width*($outer_width/100) * 2)/3;
						if ($tile_ratio == 'Square') $grid_panel_height = $grid_panel_width*($outer_width/100);
						if ($tile_ratio == '2:3 Vertical') $grid_panel_height = ($grid_panel_width*($outer_width/100) * 3)/2;
					}
					
					if ($pattern[$count] == 'small-m') {
						$new_side_margin_px = $side_margin_px;
					} else {
						$new_side_margin_px = 0;
					}
					
					$headlinesize = floor($instance['headline-size']/2); if ($headlinesize < 14) $headlinesize = 14; $headlinesize_px = $headlinesize . 'px';
					$lineheight = round($headlinesize * 1.2); $lineheight_px = $lineheight . 'px';
					$headline_style = " style='font-size:$headlinesize_px; line-height:$lineheight_px; margin-right:8px; margin-left:8px;'";

				} 

				$grid_panel_height_px = floor($grid_panel_height) . 'px';
				
				$grid_panel_width_px = $grid_panel_width * ($outer_width/100);
			}
			if ($b_margin_pattern[$count] == 'no') $margin_px = 0;

			$count++;
		
			if ($instance['grid-style'] == 'Equal-Size Panels') {
				if ( $count % $instance['equal-style-columns'] == 0) { $new_side_margin_px = 0; } else { $new_side_margin_px = $side_margin_px; }
				if ( $count > $not_bottom_row ) { $margin_px = 0; }
			}
			if ($instance['grid-style'] == 'Mixed-Size Panels') {
		
				if ($instance['mixed-style'] == '1 Left - 2 Right') { 
					if ($count == 1) { $total_height = $grid_panel_height; $partial_height = 0; }
					if ($count == 2) { $partial_height += $grid_panel_height; $partial_height += $margin; }
					if ($count == 3) {
						$grid_panel_height_px = ($total_height - $partial_height) . 'px';
					}
				}
				if ($instance['mixed-style'] == '1 Left - 3 Right') { 
					if ($count == 1) { $total_height = $grid_panel_height; $partial_height = 0; }
					if ($count == 2 || $count == 3) { $partial_height += $grid_panel_height; $partial_height += $margin; }
					if ($count == 4) {
						$grid_panel_height_px = ($total_height - $partial_height) . 'px';
					}
					}
				if ($instance['mixed-style'] == '1 Left - 4 Right') { 
					if ($count == 1) { $total_height = $grid_panel_height; $partial_height = 0; }
					if ($count == 2) { $grid_panel_height = floor($grid_panel_height); $partial_height += $grid_panel_height; $partial_height += $margin;}
					if ($count == 4 || $count == 5) {
						$grid_panel_height_px = ($total_height - $partial_height) . 'px';
					}
				}
			}
			
			$uniquestory = $unique . $post->ID;
			$output .= "<div id='grid-widget-tile-$uniquestory' class='grid-widget-tile $mixed_tile' style='margin-right:$new_side_margin_px;margin-bottom:$margin_px;height:$grid_panel_height_px;width:$grid_panel_width_pct;'>";
			
				$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
				$image0 = $image[0]; $image1 = $image[1]; $image2 = $image[2];
								
				$image_proportion = $image1 / $image2; 
				$frame_proportion = $grid_panel_width_px / $grid_panel_height; 
				
				
/*
				if ($activate_cropping == 'on') {
					$crop_css = 'position:absolute;';
					if ($crop_info[$post->ID]['left'] != '') $crop_css .= 'left:-'.$crop_info[$post->ID]['left'].';';
					if ($crop_info[$post->ID]['top'] != '') $crop_css .= 'top:-'.$crop_info[$post->ID]['top'].';';									
				}
								
								
				if ($frame_proportion >= $image_proportion) {
					$cropping = " style='width:100%;height:auto$crop_css'"; // this is the line causing issues on mobile
				} else {
					$cropping = " style='height:100%;width:auto;$crop_css'";									
				}
*/
				
				$cropping = ''; // removing this variable as we test new CSS
								
				$output .= "<a href='" . $storylink . "#photo'><img src='$image0' id='img$uniquestory' $cropping alt='" . get_the_title() . "' /></a>"; 
								
				if ($instance['overlay'] != "None") { 	
									
					$output .= "<div id='text$uniquestory' class='desc'$overlay>";
									
						$output .= "<div id='gridcontent$uniquestory' style='display:block;'>";

						if (isset ($single_cat) && $instance['show-cat'] == 'on') {
							$output .= "<div class='topstorycat'>";
								$output .= '<span class="blockscat">';
									$output .= get_cat_name($single_cat);
								$output .= '</span>';
							$output .= '</div>';
						}
															 						
						$output .= "<h5$headline_style class='homeheadline'><a href='" . $storylink . "'>" . get_the_title() . "</a></h5>";
									
						$writer = '';
						if ($instance['show-writer'] == 'on') $writer = snowriter(); 
						$showdate = $instance['show-date'];
									
						if (($writer) || ($showdate == "on")) {
							$output .= "<p class='carouselbyline'>";
								if ($writer) $output .= "<span class='sno_writer_carousel'>$writer</span>";
								if ($showdate == 'on') { 
									if ($writer) $output .= '</p><p>'; 
									$output .= '<span class="sno_date_carousel">' . get_sno_timestamp() . '</span>';
								}		
							$output .= "</p>";
						}

  						if ( $instance['show-continue-grid'] == 'on' ) {
							$output .= "<div class='continue-overlay'><span class='continue-overlay-link'>";
								$continue_text = get_theme_mod('read-text');
								if ($continue_text == '') $continue_text = "Read Story";
								$output .= $continue_text;
							$output .= '<span></div>';
						}

						
						$output .= "<div class='clear'></div></div>";
					
					$output .= '</div>';
					$output .= "	
									<script type='text/javascript'>
										$(document).ready(function() {
											$('#text$uniquestory').click(function() {
												window.location=$(this).find('a').attr('href');
											});
										});
									</script>";
								
				} 
				
				// resize images in grid frames based on actual screen size
	/*			$output .= " 
							<script type='text/javascript'>
								$(document).ready(function() {
									var gridHeight = $('#grid-widget-tile-$uniquestory').height();
									var gridWidth = $('#grid-widget-tile-$uniquestory').width();
									var gridProportion = gridWidth/gridHeight;
									if ($image_proportion > gridProportion) {
										$('#img$uniquestory').css({'height':'100%', 'width':'auto'});
									} else {
										$('#img$uniquestory').css({'width':'100%', 'height':'auto'});
									}
								});
							</script>";
	*/
				if ($instance['mobile-style'] == 'on') {
					$output .= "	
						<script type='text/javascript'>
							$(document).ready(function() {
								if ($(window).width() < 900) {
									$('#text$uniquestory').show();
								}
							});
						</script>";
				}

				if ($instance['overlay'] == 'Show on Hover') {
					if ($instance['overlay-location'] == 'Full Panel') { 
						$output .= "	
							<script type='text/javascript'>
								$(document).ready(function() {
									$('#img$uniquestory').mouseenter(function() {
										$('#text$uniquestory').fadeIn();
										var height = $('#gridcontent$uniquestory').height();
										var new_padding = Math.floor(($grid_panel_height - height)/2);
										if (new_padding < 10) { new_padding = 10; }
										$('#gridcontent$uniquestory').css('padding-top', new_padding);
									});
									$('#text$uniquestory').mouseleave(function() {
									";
										if ($instance['mobile-style'] == 'on') {
											$output .= "
												if ($(window).width() >= 900) {
													$('#text$uniquestory').fadeOut();
												}";
										} else {
											$output .= "
												$('#text$uniquestory').fadeOut();
												";
										}
									$output .= "});
								});
							</script>";
					} else {
						$output .= "
							<script type='text/javascript'>
								$(document).ready(function() {
									var timer;
									$('#img$uniquestory').mouseenter(function() {
										$('#text$uniquestory').fadeIn();
									});
									$('#text$uniquestory, #img$uniquestory').mouseleave(function() {
										timer = setTimeout(hideOverlay, 3);
									}).mouseenter(function() {
										clearTimeout(timer);
									});
									function hideOverlay() {
									";
										if ($instance['mobile-style'] == 'on') {
											$output .= "
												if ($(window).width() >= 900) {
													$('#text$uniquestory').fadeOut();
												}";
										} else {
											$output .= "
												$('#text$uniquestory').fadeOut();
												";
										}
									$output .= "};
								});
							</script>";
						
					}

				}
				
				if ($instance['overlay'] == 'Show Always' && $instance['overlay-location'] == 'Full Panel' && !$test_for_mobile->isMobile()) {
						$output .= "	
							<script type='text/javascript'>
								$(document).ready(function() {
									var height = $('#gridcontent$uniquestory').height();
									var new_padding = Math.floor(($grid_panel_height - height)/2);
									if (new_padding < 10) { new_padding = 10; }
									$('#gridcontent$uniquestory').css('padding-top', new_padding);
									
								});
							</script>";
				}		


				if ($instance['enlarge-photo'] == 'on') {
					$output .= "	
						<script type='text/javascript'>
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
									if ($instance['mobile-style'] == 'on') {
										$output .= "
											if ($(window).width() >= 900) {
												$('#img$uniquestory').addClass('shrink');
											}";
									} else {
										$output .= "
											$('#img$uniquestory').addClass('shrink');
										";
									}
								$output .= "};
							});
						</script>";
				}


			$output .= '</div>';


		endwhile; else: endif; wp_reset_query();

		
		$output .= '<div class="clear"></div></div>';
	
	        if ($instance['view-all']=='on' && $instance['category'] != 0) {  

				$output .= "<div class='clear'></div><a href='$categoryslug' class='view-all-link'><div class='view-all-container'><span class='view-all-grid-text view-all-grid'>";
					$view_all_text = get_theme_mod('viewall-grid-text');
					if ($view_all_text == '') $view_all_text = "View All";
					$view_all_text = str_replace('%category%', $categoryname, $view_all_text);
					$output .= $view_all_text;
					$output .= '</span></div></a><div class="clear"></div>';
			} 

		//end of carousel building
		
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
			
	echo $output;		
	if ( ! is_customize_preview() && ! is_user_logged_in()) set_transient( "sno_cat_".$this->id, $output, DAY_IN_SECONDS );
		
	}  // end of transient cache
	wp_reset_query();
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
		$instance['grid-style'] = $new_instance['grid-style'];											//active
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
		$instance['equal-style-rows'] = $new_instance['equal-style-rows'];								//active
		$instance['equal-style-columns'] = $new_instance['equal-style-columns'];						//active
		$instance['mixed-style'] = $new_instance['mixed-style'];										//active
		$instance['tile-ratio'] = $new_instance['tile-ratio'];											//active
 		$instance['overlay-style'] = ( isset( $new_instance['overlay-style'] ) ? on : "" );  			//active
		$instance['overlay-location'] = $new_instance['overlay-location'];										//active
		$instance['hide-shadow'] = $new_instance['hide-shadow'];										//active
		$instance['widget-style'] = $new_instance['widget-style'];
 		$instance['view-all'] = ( isset( $new_instance['view-all'] ) ? on : "" );  
 		$instance['custom-view-all'] = ( isset( $new_instance['custom-view-all'] ) ? on : "" );  
		$instance['custom-link'] = $new_instance['custom-link'];
 		$instance['exclude'] = ( isset( $new_instance['exclude'] ) ? on : "" );  			//active
 		$instance['exclude-this'] = ( isset( $new_instance['exclude-this'] ) ? on : "" );  			//active
		$instance['exclude-cat'] = $new_instance['exclude-cat'];												//active
 		$instance['skip'] = ( isset( $new_instance['skip'] ) ? on : "" );  			//active
		$instance['offset'] = $new_instance['offset'];												//active
		$instance['exclude-number'] = $new_instance['exclude-number'];												//active

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
 		$instance['hide-load'] = ( isset( $new_instance['hide-load'] ) ? on : "" );  				//active
 		$instance['enlarge-photo'] = ( isset( $new_instance['enlarge-photo'] ) ? on : "" );  				//active
 		$instance['mobile-style'] = ( isset( $new_instance['mobile-style'] ) ? on : "" );  				//active
 		$instance['show-date'] = ( isset( $new_instance['show-date'] ) ? on : "" );  
 		$instance['show-continue-grid'] = ( isset( $new_instance['show-continue-grid'] ) ? on : "" );  
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
		$instance['crop-info'] = $new_instance['crop-info'];		
		$instance['widget-expander-top'] = $new_instance['widget-expander-top'];										//active
 		$instance['cropping'] = ( isset( $new_instance['cropping'] ) ? on : "" );  						//active
 		$instance['remove-bottom-margin'] = ( isset( $new_instance['remove-bottom-margin'] ) ? on : "" );  						//active
 		$instance['remove-top-margin'] = ( isset( $new_instance['remove-top-margin'] ) ? on : "" );  						//active
 		$instance['full-width-activate'] = ( isset( $new_instance['full-width-activate'] ) ? on : "" );  						//active
		return $instance;
	}

	function form($instance) { 
		$defaults = array( 'number' => '10', 'carousel-border-thickness' => '5', 'fixed-height' => 'unset', 'number-headlines' => '3', 'number3c' => '3', 'headline-size' => '22', 'text-size' => '14', 'text-height' => '50', 'category-photo-placement' => 'Left', 'category-photo-size' => 'Large', 'border-thickness' => '1px','category-teaser' => '170','headline-teaser' => '0', 'show-writer' => 'on', 'view-all' => '', 'show-date' => 'on', 'widget-style'=>get_theme_mod('widget-style-sno'), 'bullet-list' => 'Teasers', 'header-color' => get_theme_mod('widgetcolor1'), 'header-text' => get_theme_mod('widgetcolor1-text'), 'widget-border' => '#aaaaaa', 'widget-background' => '#eeeeee', 'border-thickness' => '1px', 'border-thickness2' => '3px', 'widget-gradient' => 'On', 'widget-header-size' => 'Small', 'widget-expander' => '0px', 'text-override-color' => '#ffffff', 'text-background' => '#eeeeee', 'carousel-border-color' => '#ffffff', 'tile-ratio' => '3:2 Horizontal', 'enlarge-photo' => 'on', 'hide-title' => 'on', 'mobile-style' => 'on', 'overlay-style' => 'on', 'overlay-location' => 'Full Panel', 'overlay' => 'Show on Hover', 'show-continue-grid' => '', 'hide-shadow' => 'Hide', 'widget-expander-top' => '0px' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$random = mt_rand(); $disable_js = ''; $hide_all = '';
		$number = $this->number;
		
		$check = $this->number; $currentScreen = get_current_screen(); 
		
if ($check == '__i__' && $currentScreen->id === "widgets"){
	echo '<div class="not_saved">';
		?><script type="text/javascript">
			initwidgetgrid = setInterval(function() {
				$('.widget-control-save').prop("disabled", false); // Saving is now enabled.
				$('.widget-control-save').val("Save"); 
				clearInterval(initwidgetgrid)		
   			}, 1000);
		</script><?php
		echo '<p>Hit the Save button, pardner, and we\'ll get this party started.</p>';
	echo '</div>';
	$hide_all = ' style="display:none;"';

		
}

if ($check == '__i__' ) { $disable_js = 'on'; } // disable javascript here
		
		if ($instance['box1'] == 'Closed') { 
			$box1 = ' style="display:none"'; $expand1 = ''; $collapse1 = ' style="display:none"'; 
		} else { 
			$box1 = ''; $collapse1 = ''; $expand1 = ' style="display:none"'; 
		} 
		
		if ($instance['box2'] == 'Closed') { 
			$box2 = ' style="display:none"'; $expand2 = ''; $collapse2 = ' style="display:none"'; 
		} else { 
			$box2 = ''; $collapse2 = ''; $expand2 = ' style="display:none"'; 
		} 

		if ($instance['box3'] == 'Closed') { 
			$box3 = ' style="display:none"'; $expand3 = ''; $collapse3 = ' style="display:none"'; 
		} else { 
			$box3 = ''; $collapse3 = ''; $expand3 = ' style="display:none"'; 
		} 
		
		$widget_id = 'grid-'.$number;
		$sidebartest = get_option('sidebars_widgets'); 
		
		$current_area = '';
		foreach($sidebartest as $area => $widgets) {
			if (is_array($widgets)) foreach($widgets as $widget) {
				if ( $widget === $widget_id ) { $current_area = $area; }
					
			}
    	}		

    	$first_widget = '';
		if (substr($current_area, -4) != 'h-11' && substr($current_area, -4) != 'r-11') {
	    	$first_widget = ' style="display:none"'; 			
		}
    	if ($sidebartest[$current_area][0] != $widget_id) { 
	    	$first_widget = ' style="display:none"'; 
	    }

		if (substr($current_area, -3) == '-11') {
			$sidebarname = 'Full Width';
		}
		
?>
<?php $hmc_wrap = ''; $hmc_class = ''; if ($sidebarname == 'Home Main Column') {
	$hmc_wrap = " id='hmc_wrap$random'"; $hmc_class = 'hmc_wrap ';
	}	
?>

<div<?php echo $hmc_wrap; ?> class='<?php echo $hmc_class; ?> hide_all'<?php echo $hide_all; ?>>

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

		<p><i><b>NOTE:</b> This widget will only show stories if they have a featured image.  This widget is designed for the full-width widget areas. </i></p>

			<div class="widgetdivider"></div>


		<p><b>Select a category of stories</b></p>
			<?php wp_dropdown_categories(array('selected' => $instance['category'], 'name' => $this->get_field_name( 'category' ), 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'flex'), 'show_option_all' => __("All Posts", 'flex'), 'hide_empty' => '0' )); ?><br />
			
		

		<?php $categorytitle = cat_id_to_name($instance['category']); ?><input type="hidden" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $categorytitle; ?>" />


			
			<div class="widgetdivider"></div>

				<p><input type="checkbox" <?php if ($instance['exclude-this'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'exclude-this' ); ?>" name="<?php echo $this->get_field_name( 'exclude-this' ); ?>" /><label for="<?php echo $this->get_field_id('exclude-this'); ?>">Exclude stories in this widget from all other widgets loaded after this one</label></p>

				<p><input class="exclude<?php echo $random; ?>" type="checkbox" <?php if ($instance['exclude'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" /><label for="<?php echo $this->get_field_id('exclude'); ?>">Activate Category Exclusion Option</label></p>
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

<?php	if ($instance['grid-style'] == 'Mixed-Size Panels') {
			if ($instance['mixed-style'] == '1 Left - 2 Right') { $number = 3; }
			if ($instance['mixed-style'] == '1 Left - 3 Right') { $number = 4; }
			if ($instance['mixed-style'] == '1 Left - 4 Right') { $number = 5; }
			if ($instance['mixed-style'] == '2 Left - 1 Center - 2 Right') { $number = 5;  }
			if ($instance['mixed-style'] == '2 Top - 3 Bottom') $number = 5;
			if ($instance['mixed-style'] == '2 Top - 4 Bottom') $number = 6;
		}
		if ($instance['grid-style'] == 'Equal-Size Panels') {
			if ($instance['equal-style-rows'] == '') $instance['equal-style-rows'] = 3;
			if ($instance['equal-style-columns'] == '') $instance['equal-style-columns'] = 2;
			$number = $instance['equal-style-rows'] * $instance['equal-style-columns'];
		}
?>
<!--  Deactivating this option as we now do better centering.

				<p><input class="crop_activate<?php echo $random; ?>" type="checkbox" <?php if ($instance['cropping'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'cropping' ); ?>" name="<?php echo $this->get_field_name( 'cropping' ); ?>" /><label for="<?php echo $this->get_field_id('cropping'); ?>">Activate custom photo cropping</label></p>
				
			<div class="crop_info<?php echo $random; ?>">
				<?php $offset = 0; if ($instance['skip'] == "on") $offset = $instance['offset']; ?>
				
			<?php 
					$crop_info = array();
					$args = array ( 'meta_key' => '_thumbnail_id', 'category' => $instance['category'], 'posts_per_page' => $number, 'offset' => $offset, 'exclude' => $exclude);
										
					$crop_photos = get_posts( $args );
					
					foreach ($crop_photos as $post) {
						$postid = $post->ID;

						if ($instance['exclude-this'] == 'on') {
							$_ENV['sno_exclude'][] = $post->ID;
						}

						echo '<p>';
							echo '<b>' . $postid . ': ' . get_the_title($postid) . '</b>';
							
							echo '<br />';

						echo 'Left: <select id="' . $this->get_field_id('crop-info') . '-' . $postid . '-left" name="' . $this->get_field_name('crop-info') . '['.$postid.'][left]">';

						for ($i = 0; $i <= 600; $i+=25) { 
							$left = $i . 'px';
							echo "<option value='$left'";
							if ($left == $instance['crop-info'][$postid]['left']) echo ' selected="selected"';
							echo ">$left</option>";
						} 
						
						echo '</select>';

						echo ' Top: <select id="' . $this->get_field_id('crop-info') . '-' . $postid . '-top" name="' . $this->get_field_name('crop-info') . '['.$postid.'][top]">';

						for ($i = 0; $i <= 300; $i+=25) { 
							$top = $i . 'px';
							echo "<option value='$top'";
							if ($top == $instance['crop-info'][$postid]['top']) echo ' selected="selected"';
							echo ">$top</option>";
						} 
						
						echo '</select>';

						echo '</p>';
						
					
					}
					wp_reset_query();	
					
			?>			
			
			</div>

			<div class="widgetdivider"></div>
-->	

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
			
		


			<p>
				<select class="overlay<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'overlay' ); ?>" name="<?php echo $this->get_field_name( 'overlay' ); ?>">
					<option value="Show Always" <?php if ( 'Show Always' == $instance['overlay'] ) echo 'selected="selected"'; ?>>Show Always</option>
					<option value="Show on Hover" <?php if ( 'Show on Hover' == $instance['overlay'] ) echo 'selected="selected"'; ?>>Show on Hover</option>
					<option value="None" <?php if ( 'None' == $instance['overlay'] ) echo 'selected="selected"'; ?>>None</option>
				</select> Text Overlay</p>
			<div class="text-overlay-option<?php echo $random; ?>">
			<p>
				<select id="<?php echo $this->get_field_id( 'overlay-location' ); ?>" name="<?php echo $this->get_field_name( 'overlay-location' ); ?>">
					<option value="Full Panel" <?php if ( 'Full Panel' == $instance['overlay-location'] ) echo 'selected="selected"'; ?>>Full Panel</option>
					<option value="Bottom" <?php if ( 'Bottom' == $instance['overlay-location'] ) echo 'selected="selected"'; ?>>Bottom</option>
				</select> Text Overlay Location
			</p>

				<input class="checkbox" type="checkbox" <?php if ($instance['overlay-style'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'overlay-style' ); ?>" name="<?php echo $this->get_field_name( 'overlay-style' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'mobile-style' ); ?>">Darken photo when text is showing</label><br />			
			
			<input class="checkbox" type="checkbox" <?php if ($instance['mobile-style'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'mobile-style' ); ?>" name="<?php echo $this->get_field_name( 'mobile-style' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'mobile-style' ); ?>">Show text by default on mobile</label><br />
			</div>
			<br />

			<div class="widgetdivider"></div>

			<input class="checkbox" type="checkbox" <?php if ($instance['show-writer'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-writer' ); ?>" name="<?php echo $this->get_field_name( 'show-writer' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-writer' ); ?>">Show Byline</label>			
			<br />

			<input class="checkbox" type="checkbox" <?php if ($instance['show-continue-grid'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-continue-grid' ); ?>" name="<?php echo $this->get_field_name( 'show-continue-grid' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-continue-grid' ); ?>">Show Read More Link</label>			
			<br />

			<input class="checkbox" type="checkbox" <?php if ($instance['show-date'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-date' ); ?>" name="<?php echo $this->get_field_name( 'show-date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-date' ); ?>">Show Date</label>			
			<br />
		
			<input class="checkbox" type="checkbox" <?php if ($instance['show-cat'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-cat' ); ?>" name="<?php echo $this->get_field_name( 'show-cat' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-cat' ); ?>">Show Category Name</label>			
			<br /><br />

			<input class="viewallcheckbox<?php echo $random; ?>" type="checkbox" <?php if ($instance['view-all'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'view-all' ); ?>" name="<?php echo $this->get_field_name( 'view-all' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'view-all' ); ?>"> Show "View All" Link</label><br />
			
			<div class="viewall<?php echo $random; ?>">
				<input class="viewalllinkcheckbox<?php echo $random; ?>" type="checkbox" <?php if ($instance['custom-view-all'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'custom-view-all' ); ?>" name="<?php echo $this->get_field_name( 'custom-view-all' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'custom-view-all' ); ?>"> Activate Custom "View All" Link</label>

				<div class="viewalllink<?php echo $random; ?>"><br />
					<label for="<?php echo $this->get_field_id('custom-link'); ?>">Enter Custom Link:</label><br />
					<input placeholder="Start with http://" id="<?php echo $this->get_field_id('custom-link'); ?>" name="<?php echo $this->get_field_name('custom-link'); ?>" type="text" size="25" value="<?php echo $instance['custom-link']; ?>" />
				</div>
			</div>
			<br />
		

		
					

		</div>

		<div class="widgetsection" id="widgetsection2-<?php echo $random; ?>">
			<div class="expand" id="expand2-<?php echo $random; ?>" <?php echo $expand2; ?>></div><div class="collapse" id="collapse2-<?php echo $random; ?>" <?php echo $collapse2; ?>></div>
			Grid Display Options
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody2-<?php echo $random; ?>" <?php echo $box2; ?>>

			<p>
				<select class="gridstyle<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'grid-style' ); ?>" name="<?php echo $this->get_field_name( 'grid-style' ); ?>">
					<option value="Mixed-Size Panels" <?php if ( 'Mixed-Size Panels' == $instance['grid-style'] ) echo 'selected="selected"'; ?>>Mixed-Size Panels</option>
					<option value="Equal-Size Panels" <?php if ( 'Equal-Size Panels' == $instance['grid-style'] ) echo 'selected="selected"'; ?>>Equal-Size Panels</option>
				</select> Grid Style
			</p>
			 
			<div class="gridstyle-mixed<?php echo $random; ?>">
			<p>
				<select class="carouselstyle<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'mixed-style' ); ?>" name="<?php echo $this->get_field_name( 'mixed-style' ); ?>">
					<option value="1 Left - 2 Right" <?php if ( '1 Left - 2 Right' == $instance['mixed-style'] ) echo 'selected="selected"'; ?>>1 Left - 2 Right</option>
					<option value="1 Left - 3 Right" <?php if ( '1 Left - 3 Right' == $instance['mixed-style'] ) echo 'selected="selected"'; ?>>1 Left - 3 Right</option>
					<option value="1 Left - 4 Right" <?php if ( '1 Left - 4 Right' == $instance['mixed-style'] ) echo 'selected="selected"'; ?>>1 Left - 4 Right</option>
					<option value="2 Top - 3 Bottom" <?php if ( '2 Top - 3 Bottom' == $instance['mixed-style'] ) echo 'selected="selected"'; ?>>2 Top - 3 Bottom</option>
					<option value="2 Top - 4 Bottom" <?php if ( '2 Top - 4 Bottom' == $instance['mixed-style'] ) echo 'selected="selected"'; ?>>2 Top - 4 Bottom</option>
				</select>
			</p>
			</div>
			<div class="gridstyle-equal<?php echo $random; ?>">
			<p>
				<select id="<?php echo $this->get_field_id( 'equal-style-rows' ); ?>" name="<?php echo $this->get_field_name( 'equal-style-rows' ); ?>">
					<?php for ($i=1;$i<11;$i++) {
						echo "<option value='$i' ";
						if ($instance['equal-style-rows'] == $i) echo "selected='selected' ";
						echo ">$i</option>";	
					} ?>
				</select>
			 Rows</p>
			
			<p>
				<select id="<?php echo $this->get_field_id( 'equal-style-columns' ); ?>" name="<?php echo $this->get_field_name( 'equal-style-columns' ); ?>">
					<?php for ($i=1;$i<11;$i++) {
						echo "<option value='$i' ";
						if ($instance['equal-style-columns'] == $i) echo "selected='selected' ";
						echo ">$i</option>";	
					} ?>
				</select> Columns
			</p>
			</div>
			
			<p>
				<select class="photoratio<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'tile-ratio' ); ?>" name="<?php echo $this->get_field_name( 'tile-ratio' ); ?>">
					<option value="3:1 Horizontal" <?php if ( '3:1 Horizontal' == $instance['tile-ratio'] ) echo 'selected="selected"'; ?>>3:1 Horizontal</option>
					<option value="2:1 Horizontal" <?php if ( '2:1 Horizontal' == $instance['tile-ratio'] ) echo 'selected="selected"'; ?>>2:1 Horizontal</option>
					<option value="3:2 Horizontal" <?php if ( '3:2 Horizontal' == $instance['tile-ratio'] ) echo 'selected="selected"'; ?>>3:2 Horizontal</option>
					<option value="Square" <?php if ( 'Square' == $instance['tile-ratio'] ) echo 'selected="selected"'; ?>>Square</option>
					<option value="2:3 Vertical" <?php if ( '2:3 Vertical' == $instance['tile-ratio'] ) echo 'selected="selected"'; ?>>2:3 Vertical</option>
					<option value="Fixed Height" <?php if ( 'Fixed Height' == $instance['tile-ratio'] ) echo 'selected="selected"'; ?>>Fixed Height</option>
				</select> Photo Ratio
			</p>
			
			<div class="fixedheight<?php echo $random; ?>">
			<p>
				<select id="<?php echo $this->get_field_id('fixed-height'); ?>" name="<?php echo $this->get_field_name('fixed-height'); ?>">
					<?php 
						for ($i = 100; $i <= 650; $i+=25) { 
							$height = $i . 'px';
							echo "<option value='$i'";
							if ($i == $instance['fixed-height']) echo ' selected="selected"';
							echo ">$height</option>";
						} 
					?>
				
				</select>
				<label for="<?php echo $this->get_field_id('fixed-height'); ?>"><?php _e('Grid Tile Height'); ?></label>

			</p>
			</div>

			<p><input type="checkbox" <?php if ($instance['enlarge-photo'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'enlarge-photo' ); ?>" name="<?php echo $this->get_field_name( 'enlarge-photo' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'enlarge-photo' ); ?>">Enlarge Photo on Hover</label></p>

			<div class="widgetdivider"></div>

			<p>			
				<select id="<?php echo $this->get_field_id('margin-width'); ?>" name="<?php echo $this->get_field_name('margin-width'); ?>">
					<?php 
						if ($instance['margin-width'] == '') $instance['margin-width'] = 10;
						for ($i = 0; $i <= 20; $i+=1) { 
							$width = $i;
							echo "<option value='$width'";
							if ($width == $instance['margin-width']) echo ' selected="selected"';
							$width_px = $width . 'px';
							echo ">$width_px</option>";
						} 
					?>
				
				</select>
				<label for="<?php echo $this->get_field_id('margin-width'); ?>"><?php _e('Margin Between Panels'); ?></label>
			</p>

			<div class="widgetdivider"></div>



			<p>
				<label style="display:block" for="<?php echo $this->get_field_id('carousel-border-color'); ?>">Border/Background Color</label>
				<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('carousel-border-color'); ?>" name="<?php echo $this->get_field_name('carousel-border-color'); ?>" value="<?php echo $instance['carousel-border-color']; ?>" />
			</p>
			

			<p><input class="checkbox bordercontrol<?php echo $random; ?>" type="checkbox" <?php if ($instance['show-border'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-border' ); ?>" name="<?php echo $this->get_field_name( 'show-border' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-border' ); ?>">Add Outer Border</label></p>

			<div class="borderoptions<?php echo $random; ?>">
				<p>
					<select id="<?php echo $this->get_field_id('carousel-border-thickness'); ?>" name="<?php echo $this->get_field_name('carousel-border-thickness'); ?>">
					<?php 
						for ($i = 0; $i <= 40; $i+=1) { 
							$height = $i . 'px';
							echo "<option value='$i'";
							if ($i == $instance['carousel-border-thickness']) echo ' selected="selected"';
							$cb_thickness = $i . 'px';
							echo ">$cb_thickness</option>";
						} 
					?>
				
					</select>
					<label for="<?php echo $this->get_field_id('carousel-border-thickness'); ?>"><?php _e('Outer Border Thickness'); ?></label>
				</p>

			</div>
			<br />
		</div>
		
		<div class="widgetsection" id="widgetsection3-<?php echo $random; ?>">
			<div class="expand" id="expand3-<?php echo $random; ?>" <?php echo $expand3; ?>></div><div class="collapse" id="collapse3-<?php echo $random; ?>" <?php echo $collapse3; ?>></div>
			Widget Appearance
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody3-<?php echo $random; ?>" <?php echo $box3; ?>>

			<p><input class="hidetitle<?php echo $random; ?>" type="checkbox" <?php if ($instance['hide-title'] == 'on') echo "checked"; ?> id="<?php echo $this->get_field_id( 'hide-title' ); ?>" name="<?php echo $this->get_field_name( 'hide-title' ); ?>" /><label for="<?php echo $this->get_field_id('hide-title'); ?>">Hide widget title, border, and background</label></p>

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





		<div class="customoptions<?php echo $random; ?>">
		<div class="widgetdivider"></div>
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
		<div class="widgetdivider"></div>
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
		</div>
		</div>
		<div class="widgetdivider"></div>

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

		<div class="firstwidget"<?php echo $first_widget; ?>> 
			<p><input class="checkbox" type="checkbox" <?php if ($instance['remove-top-margin'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'remove-top-margin' ); ?>" name="<?php echo $this->get_field_name( 'remove-top-margin' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'remove-top-margin' ); ?>">Remove Top Margin</label></p>
		</div>

			<p><input class="checkbox" type="checkbox" <?php if ($instance['remove-bottom-margin'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'remove-bottom-margin' ); ?>" name="<?php echo $this->get_field_name( 'remove-bottom-margin' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'remove-bottom-margin' ); ?>">Remove Bottom Margin</label></p>

			<p>
				<select class="hideshadow<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'hide-shadow' ); ?>" name="<?php echo $this->get_field_name( 'hide-shadow' ); ?>">
					<option value="Use Default" <?php if ( 'Use Default' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Use Default</option>
					<option value="Hide" <?php if ( 'Hide' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Hide</option>
					<option value="Show" <?php if ( 'Show' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Show</option>
				</select>
				
			 Widget Drop Shadow</p>
		
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

			jQuery('.viewallcheckbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.viewall<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.viewallcheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".viewall<?php echo $random; ?>").show();
			} else {
				jQuery(".viewall<?php echo $random; ?>").hide();
			}
			
			jQuery('.viewalllinkcheckbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.viewalllink<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.viewalllinkcheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".viewalllink<?php echo $random; ?>").show();
			} else {
				jQuery(".viewalllink<?php echo $random; ?>").hide();
			}

			jQuery('.bordercontrol<?php echo $random; ?>').change(function() {
   		 		jQuery('.borderoptions<?php echo $random; ?>').slideToggle('slow');
			});
    		if (jQuery('.bordercontrol<?php echo $random; ?>').prop('checked')) {
				jQuery(".borderoptions<?php echo $random; ?>").show();
			} else {
				jQuery(".borderoptions<?php echo $random; ?>").hide();
			}

			jQuery('.textoverride<?php echo $random; ?>').change(function() {
   		 		jQuery('.textoverrideoption<?php echo $random; ?>').slideToggle('slow');
			});
    		if (jQuery('.textoverride<?php echo $random; ?>').prop('checked')) {
				jQuery(".textoverrideoption<?php echo $random; ?>").show();
			} else {
				jQuery(".textoverrideoption<?php echo $random; ?>").hide();
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

			jQuery('.crop_activate<?php echo $random; ?>').change(function() {
   		 		jQuery('.crop_info<?php echo $random; ?>').slideToggle('slow');
			});
    		if (jQuery('.crop_activate<?php echo $random; ?>').prop('checked')) {
				jQuery(".crop_info<?php echo $random; ?>").show();
			} else {
				jQuery(".crop_info<?php echo $random; ?>").hide();
			}

    		jQuery(".gridstyle<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "Mixed-Size Panels") ? jQuery(".gridstyle-mixed<?php echo $random; ?>").slideDown('slow') : jQuery(".gridstyle-mixed<?php echo $random; ?>").slideUp('slow');
        		(jQuery(this).val() == "Equal-Size Panels") ? jQuery(".gridstyle-equal<?php echo $random; ?>").slideDown('slow') : jQuery(".gridstyle-equal<?php echo $random; ?>").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".gridstyle<?php echo $random; ?>").val() == "Mixed-Size Panels") ? jQuery(".gridstyle-mixed<?php echo $random; ?>").show() : jQuery(".gridstyle-mixed<?php echo $random; ?>").hide();
        		(jQuery(".gridstyle<?php echo $random; ?>").val() == "Equal-Size Panels") ? jQuery(".gridstyle-equal<?php echo $random; ?>").show() : jQuery(".gridstyle-equal<?php echo $random; ?>").hide();
    		});

    		jQuery(".photoratio<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "Fixed Height") ? jQuery(".fixedheight<?php echo $random; ?>").slideDown('slow') : jQuery(".fixedheight<?php echo $random; ?>").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".photoratio<?php echo $random; ?>").val() == "Fixed Height") ? jQuery(".fixedheight<?php echo $random; ?>").show() : jQuery(".fixedheight<?php echo $random; ?>").hide();
    		});


    		jQuery(".textcontrol<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "On") ? jQuery(".textoptions<?php echo $random; ?>").slideDown('slow') : jQuery(".textoptions<?php echo $random; ?>").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".textcontrol<?php echo $random; ?>").val() == "On") ? jQuery(".textoptions<?php echo $random; ?>").show() : jQuery(".textoptions<?php echo $random; ?>").hide();
    		});

    		jQuery(".overlay<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "None") ? jQuery(".text-overlay-option<?php echo $random; ?>").slideUp('slow') : jQuery(".text-overlay-option<?php echo $random; ?>").slideDown('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".overlay<?php echo $random; ?>").val() == "None") ? jQuery(".text-overlay-option<?php echo $random; ?>").hide() : jQuery(".text-overlay-option<?php echo $random; ?>").show();
    		});

    		jQuery(".carouselstyle<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "Text Overlay on Image") ? jQuery(".overlayoptions<?php echo $random; ?>").slideDown('slow') : jQuery(".overlayoptions<?php echo $random; ?>").slideUp('slow');
        		(jQuery(this).val() == "Text Overlay on Image") ? jQuery(".overlayhide<?php echo $random; ?>").slideUp('slow') : jQuery(".overlayhide<?php echo $random; ?>").slideDown('slow');
        		(jQuery(this).val() == "Text Below Image") ? jQuery(".textbelow<?php echo $random; ?>").slideDown('slow') : jQuery(".textbelow<?php echo $random; ?>").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".carouselstyle<?php echo $random; ?>").val() == "Text Overlay on Image") ? jQuery(".overlayoptions<?php echo $random; ?>").show() : jQuery(".overlayoptions<?php echo $random; ?>").hide();
        		(jQuery(".carouselstyle<?php echo $random; ?>").val() == "Text Overlay on Image") ? jQuery(".overlayhide<?php echo $random; ?>").hide() : jQuery(".overlayhide<?php echo $random; ?>").show();
        		(jQuery(".carouselstyle<?php echo $random; ?>").val() == "Text Below Image") ? jQuery(".textbelow<?php echo $random; ?>").show() : jQuery(".textbelow<?php echo $random; ?>").hide();
    		});


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
	}

}
?>