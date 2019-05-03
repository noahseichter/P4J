<?php

add_action('widgets_init', create_function('', "register_widget('sno_category_carousel');"));
class sno_category_carousel extends WP_Widget {

	function __construct() {

		$this->defaults = array(
			'title' => '',
			'image' => '',
			'link'  => ''
			);

		$widget_ops = array(
			'classname' => 'sno_category_carousel',
			'description' => __( 'Use this widget to add a carousel of stories.  Stories will only be displayed if they have a featured image.' )
			);

		$control_ops = array(
			'id_base' => 'carousel'
			);

		parent::__construct( 'carousel', __( '(SNO) Story Carousel' ), $widget_ops, $control_ops );

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
		
		$output = ''; $count = 0; $unique_id = '';
		
 		$number = $instance['number'];		
		if (($instance['category'] == -1) || ($number <= 0)) {} else {


				$widget_this = $this->id; 
				$unique = $widget_this;
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
								
		if ($instance['custom-view-all']=="on") {
			$categoryslug = $instance['custom-link'];
		} else {
			$categoryslug = cat_id_to_slug($instance['category']); 
			if ( !is_home() ) $categoryslug .= '?list';
		}
		$categoryname = cat_id_to_name($instance['category']);
		if ($instance['category'] === '0') { $categoryname = "Recent Posts"; $categoryslug = "/";}
		
		if ( !is_home() ) $categoryslug .= '?list';
		
		$customcolors=$instance['custom-colors']; $videotitle = '';
		
		$widgetfullscreen = '';
				
		if ($instance['full-width-activate'] == 'on' && get_theme_mod('background-wrap') == 'Full Browser Width' && $instance['sidebarname'] == "Full-Width" && $instance['carousel-style'] == "Text Overlay on Image") $widgetfullscreen = 'widgetfullscreen';

		$current_widget_area = '';
		if ( substr($args['id'], -12) == 'sidebar-h-11') $current_widget_area = 'Above Header';

		$site_width = get_theme_mod('content-width'); if ($site_width == '') $site_width = 980;
		if ( $site_width == 980 && is_active_sidebar(10) && get_theme_mod('extra-column') && $current_widget_area != 'Above Header') $widgetfullscreen = ''; // block full-screen functionalty when extra widget area is being displayed
		
		foreach($sidebartest as $area => $widgets) {
			if (is_array($widgets)) foreach($widgets as $widget) {
				if ( $widget === $widget_id ) $current_area = $area;	
			}
    	}		
				
		$top_margin_style = ''; $bottom_margin_style = '';
		$shadow = '';
		if ($instance['hide-shadow'] == 'Hide' && get_theme_mod('widget-shadows') == 'On') {
			$shadow = "box-shadow: none;";
		} else if ($instance['hide-shadow'] == 'Show' && get_theme_mod('widget-shadows') != 'On') {
			$shadow = "box-shadow: -1px 0 2px 0 rgba(0, 0, 0, 0.12), 1px 0 2px 0 rgba(0, 0, 0, 0.12), 0 1px 1px 0 rgba(0, 0, 0, 0.24);";
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
		$sno_animate = "sno-animate";
		if ( $widgetfullscreen == 'widgetfullscreen') $sno_animate = '';
		
		$output .= "<div class='widgetwrap carousel-widget $sno_animate $widgetfullscreen sno-$unique'$widgetwrap_style>";
		
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
		
		if ($instance['hide-title'] == 'on') { $output .= "<style>#carousel$unique { background: " . get_theme_mod('innerbackground') . " !important;}</style>"; }
		
		
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
		
			$output .= "<div id='$unique' class='flex-container' style='position:relative;'>";
				$marginbottom = ''; $border = ''; $height_method = '';
				$fixed_height_px = $instance['fixed-height']; if ($fixed_height_px == '') $fixed_height_px = '300px';
				$fixed_height = substr($fixed_height_px, 0, -2);
				$cat_style_align = ''; $cat_style_margin = 'margin-bottom:10px;';

				if ($instance['navigation-buttons'] != 'on') { $marginbottom = "margin-bottom:0px;"; }
				if ($instance['show-border'] != 'on') { 
					$border = "border:0px;"; 
				} else {
					$cb_thickness = $instance['carousel-border-thickness']; if ($cb_thickness == '') $cb_thickness = 1;
					$cb_thickness_px = $cb_thickness . 'px';
					$cb_color = $instance['carousel-border-color']; if ($cb_color == '') $cb_color = '#fff';
					$border = "border:$cb_thickness_px solid $cb_color;";
					
					$button_adjustment = (-35 - $cb_thickness) . 'px'; 
										
					$output .= "<style>#carousel$unique { background: $cb_color !important; } #carousel$unique .flex-control-nav { bottom:$button_adjustment !important; }</style>";
				}

				if ($instance['carousel-style'] == 'Text Overlay on Image' ) {
					$padding_top = ($fixed_height / 2 - 70) . 'px';

					if ($instance['use-ratio'] == 'Ratio' && $widgetfullscreen != '') {
						$padding_top = ($instance['height-ratio'] / 2 - 5) . 'vw';
					}  else if ($instance['use-ratio'] == 'Ratio') {
						$padding_top = ($instance['height-ratio'] / 2 - 5) . '%';
					}
								
					$opacity = $instance['overlay-darkness'];
					if ($opacity == '') $opacity = '77';
					
					if ($instance['overlay'] == 'Middle Left') {
						$overlay = " style='text-align:right;left:5%;right:auto;top:$padding_top;bottom:auto;position:absolute;width:45%;background-color: rgba(0,0,0,$opacity);'";
					}
					if ($instance['overlay'] == 'Middle Center') {
						$overlay = " style='position:absolute;left:50%;top:$padding_top;bottom:auto;right:auto;width:auto;padding-right:15px;padding-left:15px;transform:translateX(-50%);max-width:50%;background-color: rgba(0,0,0,$opacity);'";
					}
					if ($instance['overlay'] == 'Middle Right') {
						$overlay = " style='right:5%;left:auto;top:$padding_top;bottom:auto;position:absolute;width:45%;background-color: rgba(0,0,0,$opacity);'";
					}
					if ($instance['overlay'] == 'Top Left') {
						$overlay = " style='top:0;left:0;right:50%;bottom:auto;position:absolute;background-color: rgba(0,0,0,$opacity);'";
					}
					if ($instance['overlay'] == 'Top Right') {
						$overlay = " style='top:0;left:50%;right:0;bottom:auto;position:absolute;background-color: rgba(0,0,0,$opacity);'";
					}
					if ($instance['overlay'] == 'Top') {
						$overlay = " style='top:0;left:0;right:0;bottom:auto;position:absolute;background-color: rgba(0,0,0,$opacity);'";
					}
					if ($instance['overlay'] == 'Bottom Left') {
						$overlay = " style='top:auto;left:0;right:50%;bottom:0;position:absolute;background-color: rgba(0,0,0,$opacity);'";
					}
					if ($instance['overlay'] == 'Bottom Right') {
						$overlay = " style='top:auto;left:50%;right:0;bottom:0;position:absolute;background-color: rgba(0,0,0,$opacity);'";
					}
					if ($instance['overlay'] == 'Bottom') {
						$overlay = " style='bottom:0;left:0;right:0;top:auto;position:absolute;background-color: rgba(0,0,0,$opacity);'";
					}
					if ($instance['overlay'] == 'Cover on Hover') { 
						$overlay = " style='position: absolute; top:0;left:0;right:0;bottom:0;display:none;padding-top:$padding_top;text-align:center;'";
						$overlaybackground = " style='display:none;background: rgba(0,0,0,$opacity);'";
						$cat_style_align = "text-align:center;";
					}
					if ($instance['overlay'] == 'Full Cover') {
						$overlay = " style='position: absolute;top:0;left:0;right:0;bottom:0;padding-top:$padding_top;text-align:center;'";
						$overlaybackground = " style='background: rgba(0,0,0,$opacity);'";
						$cat_style_align = "text-align:center;";
					}
					$cat_style_margin = "margin:10px 0px;";
				
				// fix for Microsoft Edge opacity
				$output .= "<style>@supports (-ms-ime-align: auto) {.carouseloverlay { opacity: ".$instance['overlay-darkness']."; } }</style>";
				}
					
				
				$center_text = ''; $center_teaser = ''; $continue_location = " style='text-align:left;'";
				$cat_name_location = '';
				if ($instance['text-area-center-h'] == 'on') {
					$center_text = " style='text-align:center;'";
					$continue_location = " style='text-align:center;'";
					$cat_name_location = "text-align:center;";
				}
				$catstyle= " style='$cat_style_margin $cat_style_align $cat_name_location'";

				$display_width = ''; $item_width = ''; $margin_width = $instance['margin-width']; if ($margin_width == '') $margin_width = 0; $textarea_padding = ''; $thumb_output = '';
					

				
					switch ($instance['sidebarname']) {
						case ('Full-Width'): {
							$outer_width = 950;
							if (get_theme_mod('outerwrap') == get_theme_mod('innerbackground')) $outer_width += 30;
							$textarea_padding = 'width:47%;padding:1.5%;';
							break;
						}
						case ('Main Column'): {
							$outer_width = 615;
							if (get_theme_mod('outerwrap') == get_theme_mod('innerbackground')) $outer_width += 30;
							$textarea_padding = 'width:46%;padding:2%;';
							break;
						}
						case ('Wide'): {
							$outer_width = 420;
							if (get_theme_mod('outerwrap') == get_theme_mod('innerbackground')) $outer_width += 30;
							$textarea_padding = 'width:45%;padding:2.5%;';
							break;
						}
						case ('Narrow'): {
							$outer_width = 180;
							break;
						}
						case ('Mobile'): {
							$outer_width = 400;
							break;
						}
						case ('Small Sidebar'): {
							$outer_width = 300;
							if (get_theme_mod('outerwrap') == get_theme_mod('innerbackground')) $outer_width += 15;
							$textarea_padding = 'width:44%;padding:3%;';
							break;
						}
						default: {
							$outer_width = 320;
							$textarea_padding = 'width:44%;padding:3%;';

						}
							
					}
					
				// with new width options for site, the calculations above no longer always work right.  Use the new function to override that value
				
				$widget_area_info = sno_get_widget_width($widget_this);				
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
					if ($instance['carousel-style'] == 'Text Beside Image' && $instance['sidebarname'] == 'Narrow') {
						$instance['carousel-style'] = 'Text Below Image';
						$instance['display-number'] = 1;
					}
					if ($instance['transition-style'] == 'Fade') $instance['display-number'] = 1;
					if ($instance['carousel-style'] == 'Text Beside Image') $instance['display-number'] = 1;
					if ($instance['sidebarname'] == 'Narrow') $instance['display-number'] = 1;
					if ($instance['sidebarname'] == 'Mobile') $instance['display-number'] = 1;
					if ($instance['sidebarname'] == 'Small Sidebar' || $instance['sidebarname'] == 'Home Sidebar') {
						if ($instance['display-number'] > 2) $instance['display-number'] = 2;
					}
					if ($instance['sidebarname'] == 'Wide' && $instance['display-number'] > 3) $instance['display-number'] = 3;
					
					$hide_load = '';
					if ($instance['display-number'] != '' && $instance['display-number'] != 1){
						$display_number = $instance['display-number'];
						$outer_width = ( $outer_width - ( $margin_width * ($display_number - 1) ) ) / $display_number;
						if ($instance['hide-load'] == 'on') $hide_load = 'display:none;';
					} else {
						$display_number = $instance['display-number'];
					}
										
					$final_width = $outer_width;
					$final_width_px = $final_width . 'px'; 
					$margin_width_px = $margin_width . 'px!important;';
					$item_width = "itemWidth: $final_width";
					if ($outer_width == '' || $instance['transition-style'] == 'Fade') {
						$display_width = "width:100%;";
					} else {
						$display_width = "width:$final_width_px;margin-right:$margin_width_px";					
					}
					
					$headlinesize = $instance['headline-size']; $headlinesize_px = $headlinesize . 'px';
					$lineheight = round($headlinesize * 1.2); $lineheight_px = $lineheight . 'px';
					$headline_style = " style='font-size:$headlinesize_px; line-height:$lineheight_px; '";

					$textsize = $instance['text-size']; $textsize_px = $textsize . 'px';
					$textlineheight = round($textsize * 1.4); $textlineheight_px = $textlineheight . 'px';
					
					$center_teaser = '';
					if ($instance['text-area-center-t'] == 'on') {
						$center_teaser = "text-align:center;";
					} 
					$text_style = " style='font-size:$textsize_px; line-height:$textlineheight_px;$center_teaser'";
					
					$activate_cropping = $instance['cropping']; $crop_css = '';
					
					$crop_info = $instance['crop-info']; 		
				








					$inside = 'bottom'; $outside = 'top';
					if ( $instance['thumbnail-location'] == 'Below Carousel' ) { $inside = 'top'; $outside = 'bottom'; }
					if ( $instance['thumbnail-location'] == 'Below Text Area' ) { $inside = 'top'; $outside = 'bottom'; }
					$thumb_margin = $instance['thumbnail-margin'] . 'px';
					$thumb_arrows_offset = $thumb_margin;
					

						if ( $instance['show-thumbnails'] == 'on' ) {
							
							$add_padding = ''; $position_css = '';

							if ( $instance['thumbnail-location'] == 'Above Carousel' || $instance['thumbnail-location'] == 'Below Carousel' ) {
								if ( $instance['hide-title'] != 'on' ) {
									if ( $widget_background_color != $instance['thumbnail-background'] ) {
										$add_padding = "padding-left:$thumb_margin;padding-$outside:$thumb_margin;padding-right:$thumb_margin;";
									}
								} else if ( $instance['show-border'] == 'on' ) {
									$inside_padding = '';
									if ( $instance['carousel-border-color'] == $instance['thumbnail-background'] ) $inside_padding = "margin-$inside:-$thumb_margin";
										$add_padding = "padding-left:$thumb_margin;padding-$outside:$thumb_margin;padding-right:$thumb_margin;".$inside_padding;
								} else {
									if ( $instance['thumbnail-background'] != get_theme_mod('innerbackground') ) {
										$add_padding = "padding-left:$thumb_margin;padding-top:$thumb_margin;padding-bottom:$thumb_margin;padding-right:$thumb_margin;";
									} 
								
								}
							
							} else if ( $instance['thumbnail-location'] == 'Below Text Area' || $instance['thumbnail-location'] == 'Above Text Area' ) {
								$bottom_thumbs_border = $instance['carousel-border-thickness'] . 'px';
								$right_thumbs_border = $instance['carousel-border-thickness'] . 'px';
								if ( $instance['show-border'] == 'on' ) {
									if ( $instance['carousel-border-thickness'] > 0 ) {
										if ( $instance['carousel-border-color'] == $instance['thumbnail-background'] ) {
											$placement = "width: calc( 50% - $right_thumbs_border );$outside:$bottom_thumbs_border;right:$bottom_thumbs_border;border-bottom:none;border-right:none;padding-left:$thumb_margin;";
											$add_padding = "padding-left:$thumb_margin;";											
										} else {
											$placement = "width: calc( 50% - $right_thumbs_border );$outside:$bottom_thumbs_border;right:$bottom_thumbs_border;border-bottom:none;border-right:none;padding-left:$thumb_margin;";
											$add_padding = "padding-left:$thumb_margin;padding-right:$thumb_margin;padding-$outside:$thumb_margin;";											
										}
									}
								} else if ( $instance['hide-title'] != 'on' ) {
									if ( $widget_background_color == $instance['thumbnail-background'] ) {
										$placement = "width: 50%;$outside:0px;right:0px;border-bottom:none;border-right:none;padding-left:$thumb_margin;";
										$add_padding = "padding-left:$thumb_margin;";																					
									} else {
										$placement = "width: 50%;$outside:0px;right:0px;border-bottom:none;border-right:none;padding-left:$thumb_margin;";
										$add_padding = "padding-left:$thumb_margin;padding-right:$thumb_margin;padding-$outside:$thumb_margin;";																					
									}
								} else {
									if ( get_theme_mod('innerbackground') == $instance['thumbnail-background'] ) {
										$placement = "width: 50%;$outside:0px;right:0px;border-bottom:none;border-right:none;padding-left:$thumb_margin;";
										$add_padding = "padding-left:$thumb_margin;";																					
									} else {
										$placement = "width: 50%;right:0px;border-bottom:none;border-right:none;padding-left:$thumb_margin;";
										$add_padding = "padding-left:$thumb_margin;padding-right:$thumb_margin;padding-$outside:$thumb_margin;";																					
									}
								}
								$position_css = " style='position:absolute;right:0;$placement'";
							}  
														
														
							$background_color = $instance['thumbnail-background'];
							$thumb_output .= "<div class='carouselthumbs thumbshide'$position_css>";
							$thumb_output .= "<div id='thumbcarousel$unique' class='flexslider thumbnailslider' style='background: $background_color !important; margin-bottom: 0px;padding-$inside:$thumb_margin;$add_padding'>";

								$thumb_output .= '<div class="sno_thumbnail_nav_left">';
									$thumb_output .= '<div class="custom-navigation">';
										$thumb_output .= '<span class="flex-prev"><div class="thumbnail_left"><div class="fa fa-angle-left"><div class="icon-hidden-text">Navigate Left</div></div></div></span>';
									$thumb_output .= '</div>';
								$thumb_output .= '</div>';
					
								$thumb_output .= '<div class="sno_thumbnail_nav_right">';
									$thumb_output .= '<div class="custom-navigation">';
										$thumb_output .= '<span class="flex-next"><div class="thumbnail_right"><div class="fa fa-angle-right"><div class="icon-hidden-text">Navigate Right</div></div></div></span>';
									$thumb_output .= '</div>';
								$thumb_output .= '</div>';
								$thumb_output .= "<style>
									#thumbcarousel$unique:hover .sno_thumbnail_nav_left { left: $thumb_arrows_offset; }
									#thumbcarousel$unique:hover .sno_thumbnail_nav_right { right: $thumb_arrows_offset; }
								</style>";

  								$thumb_output .= '<ul class="slides">';			
									query_posts( $args );
									if (have_posts()) : while (have_posts()) : the_post();
										
										if (has_post_thumbnail()) { 
	
	    								$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'tsmediumblock', false);
					
										$thumb_output .= '<li class="storyslide" style="max-width:'.$instance["thumbnail-width"].'px; max-height:'.($instance["thumbnail-width"]*.66).'px; overflow:hidden;">';
											$thumb_output .= '<img src="' . $thumb[0] . '" alt="' . get_the_title() . '"/>';
										$thumb_output .= '</li>';
										
										}
										
									endwhile; else: endif;

  								$thumb_output .= '</ul>';
							$thumb_output .= '</div>';
							$thumb_output .= '</div>';
						}

				if ( $instance['thumbnail-location'] == 'Above Carousel' ) $output .= $thumb_output;
				if ( $instance['carousel-style'] == 'Text Beside Image' && ( $instance['thumbnail-location'] == 'Above Text Area' || $instance['thumbnail-location'] == 'Below Text Area' ) ) $output .= $thumb_output;


				$output .= "<div id='carousel$unique' class='flexslider carouselslider' style='$marginbottom $border position:relative;'>";

					$output .= '<div class="sno_carousel_nav_left">';
						$output .= '<div class="custom-navigation">';
							$output .= '<span class="flex-prev"><div class="carousel_left"><div class="fa fa-angle-left"><div class="icon-hidden-text">Navigate Left</div></div></div></span>';
						$output .= '</div>';
					$output .= '</div>';
		
					$output .= '<div class="sno_carousel_nav_right">';
						$output .= '<div class="custom-navigation">';
							$output .= '<span class="flex-next"><div class="carousel_right"><div class="fa fa-angle-right"><div class="icon-hidden-text">Navigate Right</div></div></div></span>';
						$output .= '</div>';
					$output .= '</div>';

					$output .= "<ul class='slides'>";
            
						query_posts( $args ); $wrapclass = ''; $count = 0; 
						if (have_posts()) : while (have_posts()) : the_post(); global $post; $count++; $crop_css = '';
							$custom_fields = get_post_custom($post->ID); $customlink = '';
							if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
							if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }
						
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
																			
							if ($instance['carousel-style'] == 'Text Overlay on Image') {
								
								$height_method = $instance['use-ratio'];
								if ($height_method == "Ratio" && $widgetfullscreen != '') {
									$fixed_height_px = $instance['height-ratio'] . 'vw';
								}  else if ($height_method == "Ratio") {
									$fixed_height_px = $instance['height-ratio'] . '%';
								}
								
								if ($widgetfullscreen == 'widgetfullscreen' ) {
									$output .= "<li class='carousel-widget-slide' style='$hide_load height:$fixed_height_px;position:relative;width: 100%;'>";
								} else {
									$output .= "<li class='carousel-widget-slide' style='$hide_load height:$fixed_height_px;position:relative;$display_width'>";
								}
								
								$thumb_selection = 'large';
								if ( $instance['sidebarname'] == 'Full-Width' && $instance['display-number'] == 1 ) $thumb_selection = 'full';
																
								$image = wp_get_attachment_image_src( get_post_thumbnail_id(), $thumb_selection);
								$image0 = $image[0]; $image1 = $image[1]; $image2 = $image[2];
								
								$fixed_height = substr($fixed_height_px, 0, -2);
								$image_proportion = $image1 / $image2;
								$frame_proportion = $final_width / $fixed_height;
								
								
								if ($activate_cropping == 'on' && $height_method == "Ratio") {
									if ($crop_info[$post->ID]['left'] != '0px') $crop_css .= 'margin-left:-'.$crop_info[$post->ID]['left'].';';
									if ($crop_info[$post->ID]['top'] != '0px') $crop_css .= 'margin-top:-'.$crop_info[$post->ID]['top'].';';
								} else if ($activate_cropping == 'on') {
									$crop_css = 'position:absolute;';
									if ($crop_info[$post->ID]['left'] != '0px') $crop_css .= 'left:-'.$crop_info[$post->ID]['left'].';';
									if ($crop_info[$post->ID]['top'] != '0px') $crop_css .= 'top:-'.$crop_info[$post->ID]['top'].';';									
								}
								
								$crop_css = ''; // blanking out this variable as we test new CSS
								
								if ($frame_proportion >= $image_proportion) {
									$cropping = " style='width:100%;height:auto;$crop_css'";
								} else {
									$cropping = " style='height:100%;width:auto;$crop_css'";									
								}

								$uniquestory = $unique . $post->ID;
								
								$cropping = " style='height: 100%; width: 100%; object-fit:cover;";
																
								$output .= "<a href='$storylink'><img src='$image0' id='img$uniquestory' $cropping alt='" . get_the_title() . "' /></a>"; 
/*
								if ($widgetfullscreen == 'widgetfullscreen') {
									$output .= "
										<script type='text/javascript'>
											$(window).load(function() {
												var photoWidth = $(window).width() / " . $display_number . ";
												var final_proportion = photoWidth / " . $fixed_height . ";
												var image_proportion = " . $image_proportion . ";
												if (final_proportion >= image_proportion) {
													$('#img".$uniquestory."').css('width','100%');
													$('#img".$uniquestory."').css('height','auto');
												} else {
													$('#img".$uniquestory."').css('height','100%');
													$('#img".$uniquestory."').css('width','auto');												
												}
											});
										</script>
									";
										
								} else 
*/
								
								if ($height_method == "Ratio") {
									$output .= "
										<script type='text/javascript'>
											$(window).load(function() {
												var carouselWidth = $('#carousel$unique').width()
												var carouselHeight = $('#carousel$unique').width()*.".$instance['height-ratio'].";
												
												$('#img".$uniquestory."').closest('li').css('height', carouselHeight);

												var photoWidth = $('#carousel$unique').width() / $display_number;
												var final_proportion = photoWidth / carouselHeight;
												var image_proportion = " . $image_proportion . ";
												if (final_proportion >= image_proportion) {
													$('#img".$uniquestory."').css('width',carouselWidth + 1);
													$('#img".$uniquestory."').css('height','auto');
												} else {
													$('#img".$uniquestory."').css('height',carouselHeight);
													$('#img".$uniquestory."').css('width','auto');												
												}
											});
										</script>
									";
								}
							
								if ($instance['overlay'] != "None") { 	
									if ($instance['overlay'] == 'Cover on Hover' || $instance['overlay'] == 'Full Cover') {
										$output .= "<div id='overlay$uniquestory' class='carouseloverlay'$overlaybackground></div>";
										$output .= "<div class='carouseloverlaytext' id='text$uniquestory'$overlay>"; 
									} else {
										$output .= "<div id='text$uniquestory' class='carouseloverlay'$overlay>";
									}
									if (isset ($single_cat) && $instance['show-cat'] == 'on') {
										$output .= "<div class='topstorycat' $catstyle>";
											$output .= "<span class='blockscat'>";
												$output .= get_cat_name($single_cat);
											$output .= '</span>';
										$output .= '</div>';
									}
									 						
									$output .= "<div class='widgetheadlineoverlay'$center_text><a$headline_style class='homeheadline' href='$storylink'>" . get_the_title() . "</a></div>";
									
									$writer = '';
									if ($instance['show-writer'] == 'on') $writer = snowriter(); 
									$showdate = $instance['show-date'];
									
									if (($writer) || ($showdate == "on")) {
										$output .= "<p class='carouselbyline'$center_text>";
										if ($writer) $output .= "<span class='sno_writer_carousel'>$writer</span>";
										if ($showdate == 'on') { 
											if ($writer) $output .= ' | '; 
											$output .= '<span class="sno_date_carousel">' . get_sno_timestamp() . '</span>';
										}
									
										$output .= "</p>";
									}
									
  									if ( $instance['show-continue'] == 'on' ) {
										$output .= "<div class='continue-overlay'$continue_location><span class='continue-overlay-link'>";
												$continue_text = get_theme_mod('read-text');
											if ($continue_text == '') $continue_text = "Read Story";
											$output .= $continue_text;
										$output .= '<span></div>';
									}
									
									
								$output .= "</div>";
									
								
								} 

									$output .= "	
									<script type='text/javascript'>
										$(document).ready(function() {
											$('#text$uniquestory').click(function() {
												window.location=$(this).find('a').attr('href');
											});
										});
									</script>";


								if ($instance['overlay'] == 'Cover on Hover') {
									$output .= "	
									<script type='text/javascript'>
										$(document).ready(function() {
											$('#img$uniquestory').mouseenter(function() {
												$('#overlay$uniquestory').fadeIn();
												$('#text$uniquestory').fadeIn();
											});
											$('#text$uniquestory').mouseleave(function() {
												$('#overlay$uniquestory').fadeOut();
												$('#text$uniquestory').fadeOut();
											});
										});
									</script>";
								}
								
								if ( $count == 1 && ($instance['overlay'] == 'Middle Left' || $instance['overlay'] == 'Middle Center' || $instance['overlay'] == 'Middle Right')  && $use_ratio == 'Fixed Height') { 
									$output .= "
										<script type='text/javascript'>
												var height = $('#text$uniquestory').height();
												var photoHeight = $fixed_height;
												var new_padding = Math.floor((photoHeight - height)/2);
												$('#carousel$unique .carouseloverlay').css('top', new_padding);
										</script>";
								}
									

								
								$output .= '</li>';
								
							} else if ($instance['carousel-style'] == 'Text Below Image') {

								$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
								$image0 = $image[0]; $image1 = $image[1]; $image2 = $image[2];
								
								$image_proportion = $image1 / $image2;
								$frame_proportion = $final_width / $fixed_height;
								$text_height = $instance['text-height']; if ($text_height == '') $text_height = 100;
								$text_height_px = $text_height . 'px';
								$text_override = '';
								
								if ($instance['text-padding'] == 'On') {
									$text_background = $instance['text-background']; if ($text_background == '') $text_background = '#fff';
									$text_padding = " padding:10px; background: $text_background; ";
									if ($instance['text-override'] == 'on') {
										$text_override_color = $instance['text-override-color']; if ($text_override_color == '') $text_override_color = '#000';
										$output .= "<style>.carouseltext$unique a, .carouseltext$unique { color: $text_override_color !important; }</style>";
									}
								} else {
									$text_padding = ' padding-top:10px;';
								}
								
								$total_height = $fixed_height + $text_height;
								$total_height_px = $total_height . 'px';
								
								
								$cropping = " style='height:100%;width:101%; object-fit:cover;'";									

								$uniquestory = $unique . $post->ID;
								
								$output .= "<li class='carousel-widget-slide' style='$display_width $hide_load'>";
									
									$output .= "<div style='height:$fixed_height_px;width:100%;overflow:hidden;position:relative;'>";
										$output .= "<a href='$storylink'><img src='$image0' id='img$uniquestory' $cropping alt='" . get_the_title() . "' /></a>"; 
									$output .= "</div>";
									
									$output .= "<div class='carouseltext carouseltext$unique' style='max-height:$text_height_px;min-height:$text_height_px;$text_padding'>";
									if (isset ($single_cat) && $instance['show-cat'] == 'on') {
										$output .= "<div class='topstorycat' $catstyle>";
											$output .= '<span class="blockscat">';
												$output .= get_cat_name($single_cat);
											$output .= '</span>';
										$output .= '</div>';
									}
									
									$output .= "<div class='widgetheadline'$center_text><a$headline_style class='homeheadline' href='$storylink'>" . get_the_title() . "</a></div>";
									
									$writer = '';
									if ($instance['show-writer'] == 'on') $writer = snowriter(); 
									$showdate = $instance['show-date'];
									
									if (($writer) || ($showdate == "on")) {
										$output .= "<p class='carouselbyline'$center_text>";
										if ($showdate == 'on') $output .= '<span class="sno_date_carousel">' . get_sno_timestamp() . '</span>';
										if ($writer) { 
											if ($showdate == 'on') $output .= '<br />'; 
											$output .= "<span class='sno_writer_carousel'>$writer</span>"; 
										}
									
										$output .= "</p>";
									}
									
									$teaser = $instance['category-teaser']; if ($teaser == 0) { $kill_excerpt = 'on'; } else { $kill_excerpt = ''; }
									$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
									if ($excerpt && $kill_excerpt != 'on') { 
										$output .= "<div class='sno_teaser_carousel'$text_style>";
										$output .= '<p>' . $excerpt . '</p>'; 
										$output .= '</div>';
  									} else if ($teaser) { 
										$output .= "<div class='sno_teaser_carousel'$text_style>";
	  									$output .= get_the_content_limit($teaser, "");
										$output .= '</div>';
  									}

  									if ( $instance['show-continue'] == 'on' ) {
										$output .= "<div class='continue'$continue_location><span class='continue-link'>";
											if ($instance['category-teaser'] != 0 ) {
												$continue_text = get_theme_mod('continue-text');
											} else {
												$continue_text = get_theme_mod('read-text');
											}
											if ($continue_text == '') $continue_text = "Continue Reading";
											$output .= $continue_text;
										$output .= '<span></div>';
									}
									
									$output .= "	
									<script type='text/javascript'>
										$(document).ready(function() {
											$('.carouseltext$unique .continue').click(function() {
												window.location=$(this).parent().find('a').attr('href');
											});
										});
									</script>";
									
									$output .= "</div>";
									
								$output .= "</li>";

							} else if ($instance['carousel-style'] == 'Text Beside Image') {

								$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
								$image0 = $image[0]; $image1 = $image[1]; $image2 = $image[2];
								
								$image_proportion = $image1 / $image2;
								$frame_proportion = ($final_width / 2) / $fixed_height;

								$uniquestory = $unique . $post->ID;

								if ($activate_cropping == 'on') {
									$crop_css = 'position:absolute;';
									if ($crop_info[$post->ID]['left'] != '0px') $crop_css .= 'left:-'.$crop_info[$post->ID]['left'].';';
									if ($crop_info[$post->ID]['top'] != '0px') $crop_css .= 'top:-'.$crop_info[$post->ID]['top'].';';									
								}
								
								if ($frame_proportion >= $image_proportion) {
									$cropping = " style='width:100%;height:auto;$crop_css'";
								} else {
									$cropping = " style='height:100%;width:auto;$crop_css'";									
								}
								
								$text_padding = '';
								$text_background = $instance['text-background']; if ($text_background == '') $text_background = '#fff';
								$text_padding = "background: $text_background; ";
								if ($instance['text-override'] == 'on') {
									$text_override_color = $instance['text-override-color']; if ($text_override_color == '') $text_override_color = '#000';
									$output .= "<style>.carouseltext$unique a, .carouseltext$unique { color: $text_override_color !important; }</style>";
								}

								$output .= "<li class='carousel-widget-slide carousel-widget-slide-beside' style='width:100%;height:$fixed_height_px;overflow:hidden;$hide_load'>";
									
									$output .= "<div class='carousel-image-beside' style='height:$fixed_height_px;width:50%;overflow:hidden;float:left;position:relative'>";
										$output .= "<a href='$storylink'><img src='$image0' id='img$uniquestory' $cropping alt='" . get_the_title() . "' /></a>"; 
									$output .= "</div>";
									

									$output .= "<div class='carouseltext carouseltext$unique carousel-text-beside' style='$text_padding;$textarea_padding;height:$fixed_height_px;float:left;'>";
									$adjustment = 20;

									if ( $instance['thumbnail-location'] == 'Above Text Area' ) { 
										$thumb_row_height = floor($instance['thumbnail-width'] * .66) + ($thumbnail_spacing * 2);
										$thumb_row_height_px = $thumb_row_height . 'px';
										$output .= "<div style='width:100%;display:block;height:$thumb_row_height_px;'></div>";
										$adjustment = $thumb_row_height;
									}
									$adjustment_px = $adjustment . 'px';
									$horiz_text_padding = '';
									if ($instance['text-area-padding'] != '') {
										$horiz_text_padding = 'padding-left: ' . $instance['text-area-padding'] . 'px;padding-right: ' . $instance['text-area-padding'] . 'px;';
									}
									$output .= "<div id='carousel-textarea$uniquestory' class='carousel-textarea' style='position:relative;$horiz_text_padding'>";
									if ($instance['text-area-center'] == 'on') $output .= "<style>@media (min-width: 600px) { #carousel-textarea$uniquestory { top:calc(50% - $adjustment_px); transform: translateY(-50%);}}</style>";

									if (isset ($single_cat) && $instance['show-cat'] == 'on') {
										$output .= "<div class='topstorycat' $catstyle>";
											$output .= '<span class="blockscat">';
												$output .= get_cat_name($single_cat);
											$output .= '</span>';
										$output .= '</div>';
									}

									$output .= "<div class='widgetheadline'$center_text><a$headline_style class='homeheadline' href='$storylink'>" . get_the_title() . "</a></div>";
									
									$writer = '';
									if ($instance['show-writer'] == 'on') $writer = snowriter(); 
									$showdate = $instance['show-date'];
									
									if (($writer) || ($showdate == "on")) {
										$output .= "<p class='carouselbyline'$center_text>";
										if ($showdate == 'on') $output .= '<span class="sno_date_carousel">' . get_sno_timestamp() . '</span>';
										if ($writer) { 
											if ($showdate == 'on') $output .= '<br />'; 
											$output .= "<span class='sno_writer_carousel'>$writer</span>"; 
										}
									
										$output .= "</p>";
									}
									
									$teaser = $instance['category-teaser']; if ($teaser == 0) { $kill_excerpt = 'on'; } else { $kill_excerpt = ''; }
									$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
									if ($excerpt && $kill_excerpt != 'on') { 
										$output .= "<div class='sno_teaser_carousel'$text_style>";
										$output .= '<p>' . $excerpt . '</p>'; 
										$output .= '</div>';
  									} else if ($teaser) { 
										$output .= "<div class='sno_teaser_carousel'$text_style>";
	  									$output .= get_the_content_limit($teaser, "");
										$output .= '</div>';
  									}

  									if ( $instance['show-continue'] == 'on' ) {
										$output .= "<div class='continue'$continue_location><span class='continue-link'>";
											if ($instance['category-teaser'] != 0 ) {
												$continue_text = get_theme_mod('continue-text');
											} else {
												$continue_text = get_theme_mod('read-text');
											}
											if ($continue_text == '') $continue_text = "Continue Reading";
											$output .= $continue_text;
										$output .= '</span></div>';
									}
									
									$output .= "</div>"; // end of text area
									
									$output .= "	
									<script type='text/javascript'>
										$(document).ready(function() {
											$('#carousel-textarea$uniquestory').click(function() {
												window.location=$(this).find('a').attr('href');
											});
										});
									</script>";


									$output .= "</div>";
									
								$output .= '</li>';
								
								
							}

						endwhile; else: endif; 
		
					$output .= "</ul>";
				$output .= "</div>";
				if ( $instance['thumbnail-location'] == 'Below Carousel' ) {
					$output .= '<div class="clear"></div>';
					$output .= $thumb_output;
				}
				
			
			$output .= "</div>";
			
			if ($instance['auto-scroll'] == 'on') { $autoscroll = 'true'; } else { $autoscroll = 'false'; }
			if ($instance['transition-style'] == 'Fade') { $transition = 'fade'; } else { $transition = 'slide'; }
			if ($instance['navigation-buttons'] == 'on') { $buttons = 'true'; } else { $buttons = 'false'; }
			
			$width_adjustment = 0;
			if ( $instance['show-border'] == 'on' ) {
				$width_adjustment = ($instance['carousel-border-thickness']	* 2);
			}
			if ( $display_number > 1 && $margin_width > 0) {
				$width_adjustment += $margin_width * ($display_number - 1);
			}
			
			$auto_scroll_speed = $instance['auto-scroll-speed'];
			if ($auto_scroll_speed == '') $auto_scroll_speed = 4000;

			$transition_speed = $instance['transition-speed'];
			if ($transition_speed == '') $transition_speed = 1000;
			
			$move_number = $display_number;
			if ( $instance['show-thumbnails'] == 'on' ) $move_number = 1;
						
			$output .= "	
							<script type='text/javascript'>
								$(window).load(function() {";
			if ($instance['show-thumbnails'] == 'on') $output .= "
									$('#thumbcarousel$unique').flexslider({
										animation: 'slide',
										customDirectionNav: $('#thumbcarousel$unique .custom-navigation span'), 
										controlNav: false,
										directionNav: true,
										animationLoop: true,
										slideshow: false,
										itemWidth: ".$instance['thumbnail-width'].",
										itemMargin: ".$instance['thumbnail-margin'].",
										touch: true,
										asNavFor: '#carousel$unique',
									});";
			$output .= "
									var carouselWindowWidth = ($(window).width() - ".$width_adjustment.") / " . $display_number . ";
									$('#carousel$unique').flexslider({
										animationSpeed: $transition_speed,
										animationLoop: true,
										customDirectionNav: $('#carousel$unique .custom-navigation span'), 
									    controlNav: $buttons,
										smoothHeight: false,
										slideshowSpeed: $auto_scroll_speed,
										slideshow: $autoscroll,
										animation: '$transition',";
			if ($instance['show-thumbnails'] == 'on') $output .= "										
										sync: '#thumbcarousel$unique',";
			
			if ($widgetfullscreen == 'widgetfullscreen' && $display_number != 1) {
			$output .= "				
										itemWidth: carouselWindowWidth,
										itemMargin: $margin_width,
										";
			} else if ($widgetfullscreen == 'widgetfullscreen') {
				
			} else {
			$output .= "				
										$item_width,
										itemMargin: $margin_width,
										";
			}
			$output .= "				
										minItems: 1,
										move: $move_number,
										maxItems: 5,
									});


								});
								$(window).load(function() {
									$('.flexslider').animate({'opacity': 1}, { 'duration': 'slow'});
								});
							</script>";
		
							if ($height_method == "Ratio") {
									$output .= "
										<script type='text/javascript'>
											$(window).load(function() {
												var carouselHeight = $('#carousel$unique').width()*.".$instance['height-ratio'].";
												$('#carousel$unique').css('height',carouselHeight);
											});
										</script>
									";
								}



        if ($instance['view-all']=='on' && $instance['category'] != 0) { 
				$output .= "<div class='clear'></div><a href='$categoryslug' class='view-all-link'><div class='view-all-container'><span class='view-all-text view-all-category'>";
					$view_all_text = get_theme_mod('viewall-text');
					if ($view_all_text == '') $view_all_text = "View All";
					$view_all_text = str_replace('%category%', $categoryname, $view_all_text);
					$output .= $view_all_text;
					$output .= '</span></div></a><div class="clear"></div>';
		}
		
		//end of carousel building
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

	}

	if ($instance['exclude-this'] == 'on') {
		if (have_posts()) : while (have_posts()) : the_post();
			$_ENV['sno_exclude'][] = $post->ID;
		endwhile; else: endif; wp_reset_query();
	}
			
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
		$instance['hide-shadow'] = $new_instance['hide-shadow'];										//active
		$instance['auto-scroll-speed'] = $new_instance['auto-scroll-speed'];							//active
		$instance['transition-speed'] = $new_instance['transition-speed'];								//active
		$instance['thumbnail-location'] = $new_instance['thumbnail-location'];							//active
		$instance['thumbnail-margin'] = $new_instance['thumbnail-margin'];								//active
		$instance['thumbnail-width'] = $new_instance['thumbnail-width'];								//active
		$instance['thumbnail-background'] = $new_instance['thumbnail-background'];						//active
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
		$instance['crop-info'] = $new_instance['crop-info'];												//active
 		$instance['cropping'] = ( isset( $new_instance['cropping'] ) ? on : "" );  						//active
 		$instance['full-width-activate'] = ( isset( $new_instance['full-width-activate'] ) ? on : "" );  						//active
 		$instance['remove-top-margin'] = ( isset( $new_instance['remove-top-margin'] ) ? on : "" );  						//active
 		$instance['remove-bottom-margin'] = ( isset( $new_instance['remove-bottom-margin'] ) ? on : "" );  						//active
 		$instance['show-thumbnails'] = ( isset( $new_instance['show-thumbnails'] ) ? on : "" );  						//active
 		$instance['show-continue'] = ( isset( $new_instance['show-continue'] ) ? on : "" );  						//active
 		$instance['text-area-center'] = ( isset( $new_instance['text-area-center'] ) ? on : "" );  						//active
 		$instance['text-area-center-h'] = ( isset( $new_instance['text-area-center-h'] ) ? on : "" );  						//active
 		$instance['text-area-center-t'] = ( isset( $new_instance['text-area-center-t'] ) ? on : "" );  						//active
 		$instance['view-all'] = ( isset( $new_instance['view-all'] ) ? on : "" );  
 		$instance['custom-view-all'] = ( isset( $new_instance['custom-view-all'] ) ? on : "" );  
		$instance['custom-link'] = $new_instance['custom-link'];
		$instance['height-ratio'] = $new_instance['height-ratio'];
		$instance['use-ratio'] = $new_instance['use-ratio'];
		$instance['text-area-padding'] = $new_instance['text-area-padding'];

		return $instance;
	}

	function form($instance) { 
		$defaults = array( 'number' => '10', 'carousel-border-thickness' => '5', 'fixed-height' => 'unset', 'number-headlines' => '3', 'number3c' => '3', 'headline-size' => '22', 'text-size' => '14', 'text-height' => '50', 'category-photo-placement' => 'Left', 'category-photo-size' => 'Large', 'border-thickness' => '1px','category-teaser' => '170','headline-teaser' => '0', 'show-writer' => 'on', 'view-all' => '', 'show-date' => 'on', 'widget-style'=>get_theme_mod('widget-style-sno'), 'bullet-list' => 'Teasers', 'header-color' => get_theme_mod('widgetcolor1'), 'header-text' => get_theme_mod('widgetcolor1-text'), 'widget-border' => '#aaaaaa', 'widget-background' => '#eeeeee', 'border-thickness' => '1px', 'border-thickness2' => '3px', 'widget-gradient' => 'On', 'widget-header-size' => 'Small', 'widget-expander' => '0px', 'text-override-color' => '#ffffff', 'text-background' => '#eeeeee', 'carousel-border-color' => '#000000', 'full-width-activate' => '', 'overlay-darkness' => '.5', 'hide-title' => 'on', 'overlay' => 'Cover on Hover', 'remove-top-margin' => '', 'hide-shadow' => 'Hide', 'auto-scroll-speed' => '4000', 'transition-speed' => '1000', 'show-thumbnails' => '', 'thumbnail-margin' => '2', 'thumbnail-location' => 'Below Carousel', 'thumbnail-width' => '120', 'thumbnail-background' => '#eeeeee', 'widget-expander-top' => '0px', 'show-continue' => '', 'text-area-center' => 'on', 'text-area-center-h' => 'on', 'text-area-center-t' => 'on', 'height-ratio' => '66', 'use-ratio' => 'Ratio', 'text-area-padding' => '20px' );
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
		
		$widget_id = 'carousel-'.$number;
		$js_widget_id = $number;
		$sidebartest = get_option('sidebars_widgets'); 
		
		$current_area = '';
		foreach($sidebartest as $area => $widgets) {
			if (is_array($widgets)) foreach($widgets as $widget) {
				if ( $widget === $widget_id ) $current_area = $area;	
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

		<p><i><b>NOTE:</b> This widget will only show stories if they have a featured image.</i></p>

			<div class="widgetdivider"></div>


		<p><b>Select a category of stories</b></p>
			<?php wp_dropdown_categories(array('selected' => $instance['category'], 'name' => $this->get_field_name( 'category' ), 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'flex'), 'show_option_all' => __("All Posts", 'flex'), 'hide_empty' => '0' )); ?><br />
			
		

		<?php $categorytitle = cat_id_to_name($instance['category']); ?><input type="hidden" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $categorytitle; ?>" />




			<p>
				<select id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>">
					
					<?php
						if ($instance['number'] == '') $instance['number'] = 10; 
						for ($i = 1; $i <= 25; $i++) { 
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
			<p class="teasersidepadding<?php echo $random; ?>">
				<select id="<?php echo $this->get_field_id( 'text-area-padding' ); ?>" name="<?php echo $this->get_field_name( 'text-area-padding' ); ?>">
					<?php for ($i=10; $i <= 100; $i+=10) {
						echo "<option value='$i' ";
						if ($instance['text-area-padding'] == $i) echo 'selected="selected"';
						echo ">$i px</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id( 'text-area-padding' ); ?>">Teaser Side Padding</label>
			</p>

				<label style="display:block" for="<?php echo $this->get_field_id('text-background'); ?>">Text Area Background</label>
				<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('text-background'); ?>" name="<?php echo $this->get_field_name('text-background'); ?>" value="<?php echo $instance['text-background']; ?>" /><br /><br />

				<input class="checkbox textoverride<?php echo $random; ?>" type="checkbox" <?php if ($instance['text-override'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'text-override' ); ?>" name="<?php echo $this->get_field_name( 'text-override' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'text-override' ); ?>">Activate Text Color Override</label>			
		
				<br /><br />

				<div class="textoverrideoption<?php echo $random; ?>">
				Text Override Color<br /><input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('text-override-color'); ?>" name="<?php echo $this->get_field_name('text-override-color'); ?>" value="<?php echo $instance['text-override-color']; ?>" />
				<br /><br />
				</div>
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
			<br />

				<input class="checkbox" type="checkbox" <?php if ($instance['text-area-center'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'text-area-center' ); ?>" name="<?php echo $this->get_field_name( 'text-area-center' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'text-area-center' ); ?>">Center Text Vertically</label>			
			<br />
				<input class="checkbox" type="checkbox" <?php if ($instance['text-area-center-h'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'text-area-center-h' ); ?>" name="<?php echo $this->get_field_name( 'text-area-center-h' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'text-area-center-h' ); ?>">Center Headline/Byline</label>			
			<br />
				<input class="checkbox" type="checkbox" <?php if ($instance['text-area-center-t'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'text-area-center-t' ); ?>" name="<?php echo $this->get_field_name( 'text-area-center-t' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'text-area-center-t' ); ?>">Center Teaser</label>			
			<br />

			<input class="checkbox" type="checkbox" <?php if ($instance['show-continue'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-continue' ); ?>" name="<?php echo $this->get_field_name( 'show-continue' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-continue' ); ?>">Show Read More Link</label>			
			<br /><br />

			<div class="widgetdivider"></div>
			
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
			Carousel Display Options
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody2-<?php echo $random; ?>" <?php echo $box2; ?>>

			<p>
				<select class="carouselstyle<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'carousel-style' ); ?>" name="<?php echo $this->get_field_name( 'carousel-style' ); ?>">
					<option value="Text Overlay on Image" <?php if ( 'Text Overlay on Image' == $instance['carousel-style'] ) echo 'selected="selected"'; ?>>Text Overlay on Image</option>
					<option value="Text Beside Image" <?php if ( 'Text Beside Image' == $instance['carousel-style'] ) echo 'selected="selected"'; ?>>Text Beside Image</option>
					<option value="Text Below Image" <?php if ( 'Text Below Image' == $instance['carousel-style'] ) echo 'selected="selected"'; ?>>Text Below Image</option>
				</select>
			 Carousel Style</p>
			
			<div class="overlayoptions<?php echo $random; ?>">
			<?php $overlay_options = array('Bottom Left','Bottom Right','Bottom','Middle Left','Middle Center','Middle Right','Top Left','Top Right','Top','Cover on Hover','Full Cover','None'); ?>
			<p>
				<select class="overlayoption<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'overlay' ); ?>" name="<?php echo $this->get_field_name( 'overlay' ); ?>">
					<?php foreach ($overlay_options as $overlay_option) {
						echo "<option value='$overlay_option'";
						if ( $instance['overlay'] == $overlay_option ) echo " selected='selected'";
						echo ">$overlay_option</option>"; 
					} ?>
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
			<div class="widgetdivider"></div>

			</div>
			


			<?php if ($instance['fixed-height'] == '100px' && $instance['sidebarname'] == '') {
					if ($sidebarname == 'Full Width') { $instance['fixed-height'] = '450px'; }
					else if ($sidebarname == 'Main Column') { $instance['fixed-height'] = '300px'; }
					else { $instance['fixed-height'] = '200px'; }
			} ?>
			
			<p>
				<select class="carouselheight<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'use-ratio' ); ?>" name="<?php echo $this->get_field_name( 'use-ratio' ); ?>">
					<option value="Fixed Height" <?php if ( 'Fixed Height' == $instance['use-ratio'] ) echo 'selected="selected"'; ?>>Fixed Height</option>
					<option class="hideoption<?php echo $random; ?>" value="Ratio" <?php if ( 'Ratio' == $instance['use-ratio'] ) echo 'selected="selected"'; ?>>Ratio</option>
				</select> Method to Set Height
			 </p>
			<p class="fixedheight<?php echo $random; ?>">
				<select id="<?php echo $this->get_field_id('fixed-height'); ?>" name="<?php echo $this->get_field_name('fixed-height'); ?>">
					<?php 
						for ($i = 100; $i <= 650; $i+=25) { 
							$height = $i . 'px';
							echo "<option value='$height'";
							if ($height == $instance['fixed-height']) echo ' selected="selected"';
							echo ">$height</option>";
						} 
					?>
				
				</select>
				<label for="<?php echo $this->get_field_id('fixed-height'); ?>"><?php _e('Photo Area Height'); ?></label>
			</p>
			<p class="ratioheight<?php echo $random; ?>">
				<select id="<?php echo $this->get_field_id('height-ratio'); ?>" name="<?php echo $this->get_field_name('height-ratio'); ?>">
					<?php 
						for ($i = 40; $i < 100; $i+=1) { 
							$height = $i;
							echo "<option value='$height'";
							if ($height == $instance['height-ratio']) echo ' selected="selected"';
							echo ">$height%</option>";
						} 
					?>
				
				</select>
				<label for="<?php echo $this->get_field_id('height-ratio'); ?>"><?php _e('Carousel Height Ratio'); ?></label>
			</p>
		
			<div class="widgetdivider"></div>

<!--
				<p><input class="crop_activate<?php echo $random; ?>" type="checkbox" <?php if ($instance['cropping'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'cropping' ); ?>" name="<?php echo $this->get_field_name( 'cropping' ); ?>" /><label for="<?php echo $this->get_field_id('cropping'); ?>">Activate custom photo cropping</label></p>
				
			<div class="crop_info<?php echo $random; ?>">
				
				<?php $offset = 0; if ($instance['skip'] == "on") $offset = $instance['offset']; ?>
				
			<?php 
					$crop_info = array();
					$args = array ( 'meta_key' => '_thumbnail_id', 'category' => $instance['category'], 'posts_per_page' => $instance['number'], 'offset' => $offset, 'exclude' => $exclude);
										
					$crop_photos = get_posts( $args );
					
					foreach ($crop_photos as $post) {
						$postid = $post->ID;

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
						
					
					} wp_reset_query();	
					
			?>				
			
			</div>
-->


			<span class="textbelow<?php echo $random; ?>">
			<br />
				<select id="<?php echo $this->get_field_id('text-height'); ?>" name="<?php echo $this->get_field_name('text-height'); ?>">
					<?php 
						for ($i = 50; $i <= 400; $i+=10) { 
							$text_height = $i;
							echo "<option value='$text_height'";
							if ($text_height == $instance['text-height']) echo ' selected="selected"';
							$text_height_px = $text_height . 'px';
							echo ">$text_height_px</option>";
						} 
					?>
				
				</select>
				<label for="<?php echo $this->get_field_id('text-height'); ?>"><?php _e('Text Area Height'); ?></label>
			</span>
			</p>

			<div class="widgetdivider"></div>

			<p>
				<select id="<?php echo $this->get_field_id('display-number'); ?>" name="<?php echo $this->get_field_name('display-number'); ?>">
					<?php 
						for ($i = 1; $i <= 5; $i+=1) { 
							$number = $i;
							echo "<option value='$number'";
							if ($number == $instance['display-number']) echo ' selected="selected"';
							echo ">$number</option>";
						} 
					?>
				
				</select>
				<label for="<?php echo $this->get_field_id('display-number'); ?>"><?php _e('Number of Panels to Display'); ?></label>
			</p>
			<p><i><b>NOTE:</b> If this number is too large for a given widget area, it will be automatically adjusted.</i></p>
			
			
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

			<p><input class="navigationbuttons<?php echo $random; ?>" type="checkbox" <?php if ($instance['navigation-buttons'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'navigation-buttons' ); ?>" name="<?php echo $this->get_field_name( 'navigation-buttons' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'navigation-buttons' ); ?>">Show Navigation Buttons</label></p>


				<p><input class="thumbnails_active<?php echo $random; ?>" type="checkbox" <?php if ($instance['show-thumbnails'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'show-thumbnails' ); ?>" name="<?php echo $this->get_field_name( 'show-thumbnails' ); ?>" /><label for="<?php echo $this->get_field_id('show-thumbnails'); ?>"> Show Thumbnail Navigation Row</label></p>
				
			<div class="thumbnailoptions<?php echo $random; ?>">
				<p>
					<select id="<?php echo $this->get_field_id( 'thumbnail-location' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail-location' ); ?>">
						<option value="Above Carousel" <?php if ( 'Above Carousel' == $instance['thumbnail-location'] ) echo 'selected="selected"'; ?>>Above Carousel</option>
						<option class="carouselthumboptions<?php echo $random; ?>" value="Above Text Area" <?php if ( 'Above Text Area' == $instance['thumbnail-location'] ) echo 'selected="selected"'; ?>>Above Text Area</option>
						<option class="carouselthumboptions<?php echo $random; ?>" value="Below Text Area" <?php if ( 'Below Text Area' == $instance['thumbnail-location'] ) echo 'selected="selected"'; ?>>Below Text Area</option>
						<option value="Below Carousel" <?php if ( 'Below Carousel' == $instance['thumbnail-location'] ) echo 'selected="selected"'; ?>>Below Carousel</option>
					</select>
					<label for="<?php echo $this->get_field_id( 'thumbnail-location' ); ?>">Thumbnail Location</label>
				</p>

				<p>
					<select id="<?php echo $this->get_field_id( 'thumbnail-width' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail-width' ); ?>">
					<?php 
						for ($i=80; $i <= 200; $i+=10) {
							echo "<option value='$i' ";
							if ($instance['thumbnail-width'] == $i) echo 'selected="selected"';
							echo ">$i px</option>";
						} ?>
					</select>
					<label for="<?php echo $this->get_field_id( 'thumbnail-width' ); ?>">Thumbnail Width</label>
				</p>

				<p>
					<select id="<?php echo $this->get_field_id( 'thumbnail-margin' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail-margin' ); ?>">
					<?php 
						for ($i=0; $i <= 10; $i+=1) {
							echo "<option value='$i' ";
							if ($instance['thumbnail-margin'] == $i) echo 'selected="selected"';
							echo ">$i px</option>";
						} ?>
					</select>
					<label for="<?php echo $this->get_field_id( 'thumbnail-margin' ); ?>">Thumbnail Margin</label>
				</p>
				<p>
					<label style="display:block" for="<?php echo $this->get_field_id('thumbnail-background'); ?>">Margin Color</label>
					<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('thumbnail-background'); ?>" name="<?php echo $this->get_field_name('thumbnail-background'); ?>" value="<?php echo $instance['thumbnail-background']; ?>" />
				</p>
				
			</div>	

			<div class="widgetdivider"></div>

			<p>
				<select id="<?php echo $this->get_field_id( 'transition-style' ); ?>" name="<?php echo $this->get_field_name( 'transition-style' ); ?>">
					<option value="Scroll" <?php if ( 'Scroll' == $instance['transition-style'] ) echo 'selected="selected"'; ?>>Slide</option>
					<option class="hideoptionfade<?php echo $random; ?>" value="Fade" <?php if ( 'Fade' == $instance['transition-style'] ) echo 'selected="selected"'; ?>>Fade</option>
				</select>
			 Transition Style</p>
			
			<?php if ($instance['transition-speed'] == '') $instance['transition-speed'] = 1000; ?>
			<p>
				<select id="<?php echo $this->get_field_id( 'transition-speed' ); ?>" name="<?php echo $this->get_field_name( 'transition-speed' ); ?>">
					<option value="666" <?php if ( '666' == $instance['transition-speed'] ) echo 'selected="selected"'; ?>>Fast</option>
					<option value="1000" <?php if ( '1000' == $instance['transition-speed'] ) echo 'selected="selected"'; ?>>Medium</option>
					<option value="1500" <?php if ( '1500' == $instance['transition-speed'] ) echo 'selected="selected"'; ?>>Slow</option>
				</select>
			 Transition Speed</p>


		
			<input class="autoscroll<?php echo $random; ?>" type="checkbox" <?php if ($instance['auto-scroll'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'auto-scroll' ); ?>" name="<?php echo $this->get_field_name( 'auto-scroll' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'auto-scroll' ); ?>">Activate Auto-Scroll</label>	
			<br /><br />
			
			<div class="autoscrolloptions<?php echo $random; ?>">
			
				<select id="<?php echo $this->get_field_id('auto-scroll-speed'); ?>" name="<?php echo $this->get_field_name('auto-scroll-speed'); ?>">
					<?php 
						if ($instance['auto-scroll-speed'] == '') $instance['auto-scroll-speed'] = 4000;
						for ($i = 3; $i <= 10; $i+=1) { 
							$speed = $i * 1000;
							echo "<option value='$speed'";
							if ($speed == $instance['auto-scroll-speed']) echo ' selected="selected"';
							echo ">$i Seconds</option>";
						} 
					?>
				
				</select>
				<label for="<?php echo $this->get_field_id('auto-scroll-speed'); ?>"><?php _e('Slide Timer'); ?></label>
			<br /><br />
			</div>

			<input class="checkbox" type="checkbox" <?php if ($instance['hide-load'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'hide-load' ); ?>" name="<?php echo $this->get_field_name( 'hide-load' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'hide-load' ); ?>">Hide Carousel Until Images Load</label>	<br /><br />
			<div class="widgetdivider"></div>

			<p><input class="checkbox bordercontrol<?php echo $random; ?>" type="checkbox" <?php if ($instance['show-border'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-border' ); ?>" name="<?php echo $this->get_field_name( 'show-border' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-border' ); ?>">Show Carousel Border</label></p>

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
					<label for="<?php echo $this->get_field_id('carousel-border-thickness'); ?>"><?php _e('Carousel Border Thickness'); ?></label>
				</p>

				<label style="display:block" for="<?php echo $this->get_field_id('carousel-border-color'); ?>">Carousel Border & Margin Color</label>
				<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('carousel-border-color'); ?>" name="<?php echo $this->get_field_name('carousel-border-color'); ?>" value="<?php echo $instance['carousel-border-color']; ?>" />
			</div>
			<br />
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
		</div> <?php // end of div to hide widget design options ?>
		<div class="widgetdivider"></div>
		</div>
		<?php if ( $sidebarname == 'Full Width' ) { ?>


				<p><input class="full_width_activate<?php echo $random; ?>" type="checkbox" <?php if ($instance['full-width-activate'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'full-width-activate' ); ?>" name="<?php echo $this->get_field_name( 'full-width-activate' ); ?>" /><label for="<?php echo $this->get_field_id('full-width-activate'); ?>">Extend Widget to Full Browser Width</label></p>
			<div class="widgetdivider"></div>

		<?php } ?>
		<?php if ( $sidebarname == 'Full Width' ) { ?>
		
		<div class="firstwidget"<?php echo $first_widget; ?>> 
			<p><input class="checkbox" type="checkbox" <?php if ($instance['remove-top-margin'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'remove-top-margin' ); ?>" name="<?php echo $this->get_field_name( 'remove-top-margin' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'remove-top-margin' ); ?>">Remove Top Margin</label></p>
		</div>
		
			<p><input class="checkbox" type="checkbox" <?php if ($instance['remove-bottom-margin'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'remove-bottom-margin' ); ?>" name="<?php echo $this->get_field_name( 'remove-bottom-margin' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'remove-bottom-margin' ); ?>">Remove Bottom Margin</label></p>
			<div class="widgetdivider"></div>
		
		<?php } ?>


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

			jQuery('.autoscroll<?php echo $random; ?>').change(function() {
   		 		jQuery('.autoscrolloptions<?php echo $random; ?>').slideToggle('slow');
			});
    		if (jQuery('.autoscroll<?php echo $random; ?>').prop('checked')) {
				jQuery(".autoscrolloptions<?php echo $random; ?>").show();
			} else {
				jQuery(".autoscrolloptions<?php echo $random; ?>").hide();
			}

			jQuery('.navigationbuttons<?php echo $random; ?>').change(function() {
   		 		if (jQuery('.navigationbuttons<?php echo $random; ?>').prop('checked')) {
					jQuery(".thumbnails_active<?php echo $random; ?>").attr('checked', false);
					jQuery(".thumbnailoptions<?php echo $random; ?>").slideUp();
	   		 	}
			});

			jQuery('.thumbnails_active<?php echo $random; ?>').change(function() {
   		 		jQuery('.thumbnailoptions<?php echo $random; ?>').slideToggle('slow');
   		 		if (jQuery('.thumbnails_active<?php echo $random; ?>').prop('checked')) {
					jQuery(".navigationbuttons<?php echo $random; ?>").attr('checked', false)
	   		 	}
			});
    		if (jQuery('.thumbnails_active<?php echo $random; ?>').prop('checked')) {
				jQuery(".thumbnailoptions<?php echo $random; ?>").show();
			} else {
				jQuery(".thumbnailoptions<?php echo $random; ?>").hide();
			}

    		jQuery(".textcontrol<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "On") ? jQuery(".textoptions<?php echo $random; ?>").slideDown('slow') : jQuery(".textoptions<?php echo $random; ?>").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".textcontrol<?php echo $random; ?>").val() == "On") ? jQuery(".textoptions<?php echo $random; ?>").show() : jQuery(".textoptions<?php echo $random; ?>").hide();
    		});

    		jQuery(".carouselstyle<?php echo $random; ?>").change(function() {
        		if (jQuery(this).val() != "Text Overlay on Image") {
	        		jQuery(".carouselheight<?php echo $random; ?>").val('Fixed Height');
	        		jQuery(".fixedheight<?php echo $random; ?>").slideDown('slow');
	        		jQuery(".ratioheight<?php echo $random; ?>").slideUp('slow');
	        		jQuery(".hideoption<?php echo $random; ?>").hide();
	        	} else {
	        		jQuery(".hideoption<?php echo $random; ?>").show();
	        	}
    		});
   			jQuery(document).ready(function() {
        		if (jQuery(".carouselstyle<?php echo $random; ?>").val() != "Text Overlay on Image") {
	        		jQuery(".carouselheight<?php echo $random; ?>").val('Fixed Height');
	        		jQuery(".fixedheight<?php echo $random; ?>").slideDown('slow');
	        		jQuery(".ratioheight<?php echo $random; ?>").slideUp('slow');
	        		jQuery(".hideoption<?php echo $random; ?>").hide();
	        	} else {
	        		jQuery(".hideoption<?php echo $random; ?>").show();
	        	}
    		});

    		jQuery(".carouselheight<?php echo $random; ?>").change(function() {
        		if (jQuery(this).val() == "Fixed Height") {
	        		jQuery(".fixedheight<?php echo $random; ?>").slideDown('slow');
	        		jQuery(".ratioheight<?php echo $random; ?>").slideUp('slow');
	        		jQuery(".hideoptionfade<?php echo $random; ?>").show();
	        	} else { 
		        	jQuery(".fixedheight<?php echo $random; ?>").slideUp('slow');
	        		jQuery(".ratioheight<?php echo $random; ?>").slideDown('slow');
	        		jQuery("#widget-carousel-<?php echo $js_widget_id; ?>-transition-style").val('Scroll');
	        		jQuery(".hideoptionfade<?php echo $random; ?>").hide();
		        }
    		});
   			jQuery(document).ready(function() {
        		if (jQuery(".carouselheight<?php echo $random; ?>").val() == "Fixed Height") {
	        		jQuery(".fixedheight<?php echo $random; ?>").slideDown('slow');
	        		jQuery(".ratioheight<?php echo $random; ?>").slideUp('slow');
	        		jQuery(".hideoptionfade<?php echo $random; ?>").show();
	        	} else { 
		        	jQuery(".fixedheight<?php echo $random; ?>").slideUp('slow');
	        		jQuery(".ratioheight<?php echo $random; ?>").slideDown('slow');
	        		jQuery(".hideoptionfade<?php echo $random; ?>").hide();
	        		jQuery("#widget-carousel-<?php echo $js_widget_id; ?>-transition-style").val('Scroll');
		        }
    		});

    		jQuery(".carouselstyle<?php echo $random; ?>").change(function() {
        		if (jQuery(this).val() == "Text Beside Image") {
	        		jQuery(".teasersidepadding<?php echo $random; ?>").slideDown('slow');
	        	} else {
		        	jQuery(".teasersidepadding<?php echo $random; ?>").slideUp('slow');
				}
    		});
   			jQuery(document).ready(function() {
        		if (jQuery(".carouselstyle<?php echo $random; ?>").val() == "Text Beside Image") { 
	        		jQuery(".teasersidepadding<?php echo $random; ?>").show();
	        	} else {
		        	jQuery(".teasersidepadding<?php echo $random; ?>").hide();
				}
    		});

    		jQuery(".carouselstyle<?php echo $random; ?>").change(function() {
        		if (jQuery(this).val() == "Text Beside Image") {
	        		jQuery(".carouselthumboptions<?php echo $random; ?>").slideDown('slow');
	        		jQuery(".carouselthumboptions<?php echo $random; ?>").attr('selected', false);
	        	} else {
		        	jQuery(".carouselthumboptions<?php echo $random; ?>").slideUp('slow');
	        		jQuery(".carouselthumboptions<?php echo $random; ?>").attr('selected', false);
				}
    		});
   			jQuery(document).ready(function() {
        		if (jQuery(".carouselstyle<?php echo $random; ?>").val() == "Text Beside Image") { 
	        		jQuery(".carouselthumboptions<?php echo $random; ?>").show();
	        	} else {
		        	jQuery(".carouselthumboptions<?php echo $random; ?>").hide();
				}
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


    		jQuery(".overlayoption<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "Cover on Hover" || jQuery(this).val() == "Full Cover") ? jQuery(".overlaydarkness<?php echo $random; ?>").slideDown('slow') : jQuery(".overlaydarkness<?php echo $random; ?>").slideUp('slow');
    		});
        	(jQuery(".overlayoption<?php echo $random; ?>").val() == "Cover on Hover" || jQuery(".overlayoption<?php echo $random; ?>").val() == "Full Cover") ? jQuery(".overlaydarkness<?php echo $random; ?>").show() : jQuery(".overlaydarkness<?php echo $random; ?>").hide();
        	
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