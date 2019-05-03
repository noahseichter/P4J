<?php

add_action('widgets_init', create_function('', "register_widget('sno_category');"));
class sno_category extends WP_Widget {

	function __construct() {

		$this->defaults = array(
			'title' => '',
			'image' => '',
			'link'  => ''
			);

		$widget_ops = array(
			'classname' => 'sno_category',
			'description' => __( 'Use this widget to add a Category Display box.' )
			);

		$control_ops = array(
			'id_base' => 'category'
			);

		parent::__construct( 'category', __( '(SNO) Category Display' ), $widget_ops, $control_ops );

	}


	function widget($args, $instance) {
		extract($args);
				
		$transient_id = 'sno_cat_' . $this->id;
	
		$transient = get_transient( $transient_id );
				  
		if( ! empty( $transient ) && ! is_customize_preview() && ! is_user_logged_in()) {
    		
    		echo "\n<!-- widget displayed from cache -->\n";
    		
			echo $transient;
		
		} else {
		
		$output = ''; $count = 0; $unique_id = ''; $unique_widget_id = ''; $exitkey = '';
		$unique_widget_id = $this->id; 
		
 		$totalstories=$instance['number']+$instance['number-headlines'];		
		if (($instance['category'] == -1) || ($totalstories <= 0)) {} else {


				$widget = $this->id; 
				$sidebartest = get_option('sidebars_widgets'); 
				
				if (is_archive()) {
					$active_cat_id = get_query_var('cat');
					$columns = get_theme_mod("cat-widget-layout-$active_cat_id");
				} else { 
					$columns = get_theme_mod('sno-layout'); 
				}
				
				if (substr($args['id'], -2) == '-2') {
					$instance['sidebarname'] = 'Home Main Column';
				} else if (substr($args['id'], -3) == '-11' || $args['id'] == '-11') {
					$instance['sidebarname'] = 'Full-Width'; 
				} else if (substr($args['id'], -2) == '-1' || $args['id'] == 'sidebar-6') {
					$instance['sidebarname'] = 'Non-Home Sidebar'; 
				} else if (substr($args['id'], -2) == '-3' && $columns == 'Option 1') {
					$instance['sidebarname'] = 'Home Bottom Narrow'; 
				} else if (substr($args['id'], -2) == '-3' && $columns == 'Option 2') {
					$instance['sidebarname'] = 'Home Bottom Wide';
				} else if (substr($args['id'], -2) == '-3') {
					$instance['sidebarname'] = 'Home Sidebar';
				} else if (substr($args['id'], -2) == '-4' && ($columns == 'Option 1' || $columns == 'Option 5')) {
					$instance['sidebarname'] = 'Home Bottom Wide'; 
				} else if (substr($args['id'], -2) == '-4' && ($columns == 'Option 2' || $columns == 'Option 4')) {
					$instance['sidebarname'] = 'Home Bottom Narrow';
				} else if (substr($args['id'], -2) == '-4') {
					$instance['sidebarname'] = 'Home Sidebar';
				} else if (substr($args['id'], -2) == '-5' && $columns == 'Option 5') {
					$instance['sidebarname'] = 'Home Bottom Narrow'; 
				} else if (substr($args['id'], -2) == '-5' && $columns == 'Option 4') {
					$instance['sidebarname'] = 'Home Bottom Wide';
				} else if (substr($args['id'], -2) == '-5') {
					$instance['sidebarname'] = 'Home Sidebar';
				} else if (substr($args['id'], -3) == '-10') {
					$instance['sidebarname'] = 'Extra';
				} else {
					$instance['sidebarname'] = 'Home Sidebar';
				}
				
		if ($instance['custom-view-all']=="on") {
			$categoryslug = $instance['custom-link'];
		} else {
			$categoryslug = cat_id_to_slug($instance['category']); 
			if ( !is_home() ) $categoryslug .= '?list';
		}
		
		
		$exclusionarray = array(); $exclude_category = '';
		if ($instance['exclude'] == 'on') {
			if ($instance['exclude-number'] == 'All') {
				$exclusionarray = sno_exclude_posts();
				$exclude_category = ',-'.$instance['exclude-cat'];
			} else {
				$exclusionarray = sno_exclude_posts($widget_type = 'widget', $cat = $instance['exclude-cat'], $exclude_number = $instance['exclude-number']); 
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

		$text_area_padding = $instance['text-area-padding'] . 'px';
		if ($text_area_padding == "px") $text_area_padding = '0px';
		$text_padding = "padding-left: $text_area_padding; padding-right: $text_area_padding;";

		$headlinesize_teasers = $instance['headline-size-teasers']; $headlineheight_teasers = floor($headlinesize_teasers * 1.2);
		if ($headlinesize_teasers == '') { $headlinesize_teasers = 16; $headlineheight_teasers = 20; }

		$categoryname = cat_id_to_name($instance['category']);
		if ($instance['category'] === '0') { $categoryname = "Recent Posts"; $categoryslug = "/";}
		$customcolors=$instance['custom-colors']; $videotitle = '';
		
		$bottom_margin_style = '';
		if ($instance['remove-bottom-margin'] == 'on' && $instance['sidebarname'] == 'Full-Width') $bottom_margin_style = "margin-bottom: 0px;";

		$shadow = '';
		if ($instance['hide-shadow'] == 'Hide' && get_theme_mod('widget-shadows') == 'On') {
			$shadow = "box-shadow: none;";
		} else if ($instance['hide-shadow'] == 'Show' && get_theme_mod('widget-shadows') != 'On') {
			$shadow = "box-shadow: -1px 0 2px 0 rgba(0, 0, 0, 0.12), 1px 0 2px 0 rgba(0, 0, 0, 0.12), 0 1px 1px 0 rgba(0, 0, 0, 0.24);";
		}
		
		$widgetwrap_style = " style='$shadow$bottom_margin_style'";

		$output .= "<div class='widgetwrap sno-animate sno-$unique_widget_id'$widgetwrap_style>";
		if ($instance['hide-title'] == 'on' || $instance['offset-title'] == 'on') {} else {
			$output .= sno_widget_styles($instance, $customcolors, $categoryslug, $videotitle, $categoryname);
		}
		if ($instance['sidebarname'] == 'Full-Width' && $instance['category-display-style'] == '1 Column') {

            if ($instance['outer-design'] == 'on') {
	            
	            $outer_background = $instance['outer-background-color'];
	            $outer_border_color = $instance['outer-border-color'];
	            $outer_border_thickness = $instance['outer-border-thickness'];
	            
	            $outer_style = " style='background: $outer_background; border: $outer_border_thickness solid $outer_border_color;'";
	            
	            $output .= "<div class='widget-outer-wrap'$outer_style>";
            }

			
			$displaynumber = $instance['number-full-width'];
			
			// exclude any story ids that have been already rendered on the page and added to the session variable
			if (isset($_ENV['sno_exclude'])) foreach ($_ENV['sno_exclude'] as $key => $value) {
				$exclusionarray[] = $value;
			}

			if ($instance['category'] === '0') { 
				$uncategorized = '-'.get_theme_mod('breaking-hidecat'); $args = array ( 'cat' => $uncategorized.$exclude_category, 'showposts' => $displaynumber, 'post__not_in' => $exclusionarray, 'offset' => $offset);
			} else {
				$args = array ( 'cat' => $instance['category'].$exclude_category, 'showposts' => $displaynumber, 'post__not_in' => $exclusionarray, 'offset' => $offset);
			}
			

						switch ($instance['main-photo-width']) {
							case ('25'): {
								$max_height = '167px';
								break;
							}
							case ('33'): {
								$max_height = '220px';
								break;
							}
							case ('50'): {
								$max_height = '333px';
								break;
							}
							case ('66'): {
								$max_height = '440px';
								break;
							}
							case ('75'): {
								$max_height = '500px';
								break;
							}
						}
						
			$allow_vertical = $instance['allow-vertical'];

			$headlinesize = $instance['headline-size-full-width']; $headlinesize_px = $headlinesize . 'px';
			$headline_style = " style='font-size:$headlinesize_px; line-height:1.2em; '";

			$textsize = $instance['text-size-full-width']; $textsize_px = $textsize . 'px';
			$textlineheight = round($textsize * 1.4); $textlineheight_px = $textlineheight . 'px';
			$center_teaser = '';
			if ($instance['text-area-center-t'] == 'on') {
				$center_teaser = "text-align:center";
			} else {
			}
			$text_style = " style='font-size:$textsize_px; line-height:1.2em;$center_teaser; $text_padding '";

			if ($instance['text-override'] == 'on' && $instance['text-padding'] == 'On') {
				$text_override_color = $instance['text-override-color']; if ($text_override_color == '') $text_override_color = '#000';
				$output .= "<style>#fw1-textarea$unique_widget_id a, #fw1-textarea$unique_widget_id { color: $text_override_color !important; }</style>";
			}
			
			$offset_style = '';
            if ($instance['offset-title'] == 'on') {
            	$offset_style = "style='width:85%;float:right;'";
            	$title_color = $instance['title-text-color'];
            	$title_background = $instance['title-background-color'];
            	$title_border_thickness = $instance['title-border-thickness'];
            	$title_border_color = $instance['title-border-color'];
            	
            	$title_style = " style='border-top:$title_border_thickness solid $title_border_color; border-bottom:$title_border_thickness solid $title_border_color; color: $title_color; background: $title_background;'";
            	$output .= "<div class='offset-title-wrap'$title_style>";
            		if ($instance['category']) { 
						$categoryslug = cat_id_to_slug($instance['category']);
						if (!is_home()) $categoryslug .= '?list';

	            		$output .= "<a style='color: $title_color;' href='$categoryslug'>" . get_cat_name($instance['category']) . "</a>";
	            	} else {
	            		$output .= 'Recent Posts';
	            	}
            	$output .= "</div>";
            	
            }

            $between_stories = $instance['story-separator'] . 'px';
            if ($between_stories == 'px') $between_stories = '0px';
            $above_stories = $instance['story-separator']/2 . 'px';
            if ($above_stories == 'px') $above_stories = '0px';

            $output .= "<div class='panel-wrap panel-wrap$unique_widget_id' $offset_style>";
 
            query_posts( $args ); $wrapclass = ''; $count = 0;
            if (have_posts()) : while (have_posts()) : the_post(); global $post; 
				$custom_fields = get_post_custom($post->ID); $customlink = '';
				if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
				if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }
            	
            	$panel_styles = '';
            	            	
            	if ($instance['text-padding'] == 'On') {
	            	$panel_styles = ' style="padding: 1.5%; width: 97%; background: ' . $instance['text-background'] . ';margin-top: ' . $above_stories . ';margin-bottom: ' . $between_stories . ';"';
            	} else {
	            	$panel_styles = ' style="margin-top: ' . $above_stories . ';margin-bottom: ' . $between_stories . ';"';
            	}
            
            	$output .= "<div class='fw1-panel'$panel_styles>";

			
				if ($instance['category-display-style'] == '1 Column') {
					$title = get_the_title();
					$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
					$photo_width = $instance['main-photo-width'];
					
					
					$image0 = $image[0]; $image1 = $image[1]; $image2 = $image[2];
					
					if ($image0) {
								

						$photo_style = ''; // temporarily overwriting this variable to test new CSS
						$max_height = $instance['full-fixed-height'] .'px';
						
						$unique_id = 'cat' . $this->number . $post->ID;
						$output .= "<div class='fw1-panel-img' id='catbox-$unique_id' style='max-height:$max_height;text-align:center;float:left;overflow:hidden;width:$photo_width%;max-width:$photo_width%'>";
							$output .= "<div id='photowrap-$unique_id' style='$photo_style overflow:hidden;margin: 0 auto;height: $max_height;'>";
								$output .= '<a href="' . $storylink . '#photo" title="'. $title .'">';
									$output .= '<img src="' . $image[0] . '" alt="' . $title . '" id="grow-' . $unique_id . '" style="'. $photo_style .'" />';
								$output .= '</a>';
							$output .= '</div>';					
						$output .= '</div>';					

						if (get_theme_mod('photo-animate') != 'Disable' && has_post_thumbnail()) {
							$max_height_clean = str_replace('px', '', $max_height);	
							if ($image1=='') $image1 = 300;						
							if ($image2=='') $image2 = 200;						
							$output .= "<script type='text/javascript'>
								$(document).ready(function() {
   								 	$('#grow-$unique_id').mouseenter(function() {
   										$('#grow-$unique_id').removeClass('shrink');
   										$('#grow-$unique_id').removeClass('grow');
   										$('#grow-$unique_id').addClass('grow');
   									}).mouseleave(function() {
   										$('#grow-$unique_id').addClass('shrink');
  									});";
					//				if ($allow_vertical == 'on') $output .= "
					//					var original_width = $image1;
					//					var original_height = $image2;
					//					var actual_height = $max_height_clean;
					//					var actual_width = ( original_width * actual_height ) / original_height;
					//					actual_width = Math.round(actual_width);
					//					$('#photowrap-$unique_id').css({ height: actual_height + 'px' });
					//					$('#photowrap-$unique_id').css({ width: actual_width + 'px' });";
									$output .= "
										});</script>";
						}
					} // end of photo display
					
				if (!$image0) {
					$output .= "<div id='fw1-textarea$unique_widget_id' class='fw1-textarea fw1-textarea$unique_id' style='width:98.5%; padding: 0'>";
				} else {
					$text_width = ( 98.5 - $instance['main-photo-width'] ) . '%'; // set to 97 allows for 3% total padding
					
					$output .= "<div class='fw1-textarea fw1-textarea$unique_id' style='width:$text_width; padding: 0 0 0 1.5%;$center_vertical'>";

				}	
					$center_text = ''; $center_teaser = ''; $continue_location = "text-align:left;";
					if ($instance['text-area-center-h'] == 'on') {
						$center_text = "text-align:center;";
						$continue_location = "text-align:center;";
					} 
					
					if ($instance['cat-above-title'] == 'on') {
						if ($instance['category']) {
							$single_cat = $instance['category'];
						} else {
    						$categories = get_the_category($thePostID); $cat_list = array();
							$catcount = count($categories);
							if ($catcount == 1) {
		    					foreach($categories as $category) $cat_list[] = $category->term_id;							
	    					} else {
								foreach($categories as $category)  {  	
									if ($category->term_id != $instance['category'] ) $cat_list[] = $category->term_id;	
								}
							}
							$cat_list = array_filter($cat_list); $co = ''; $single_cat = $cat_list[0];
						}
						$output .= "<div class='topstorycat' style='line-height:24px;margin-bottom:7px;$center_text $text_padding'>";
							$output .= '<span class="blockscat">';
								$output .= get_cat_name($single_cat);
							$output .= '</span>';
						$output .= '</div>';
						$output .= '<div class="clear"></div>';
					}
					
					$headlinesize = $instance['headline-size-full-width']; $headlineheight = floor($headlinesize * 1.2); 
					$output .= "<div class='widgetheadline' style='$center_text $text_padding'><a href='" . $storylink . "' class='homeheadline' $headline_style title='Permanent Link to " . get_the_title() . "'>" . get_the_title() . "</a></div>";
													
					$writer = '';
					if ($instance['full-show-writer'] == 'on') $writer = snowriter(); 
					$showdate = $instance['full-show-date'];
									
					if ($writer || $showdate == "on") {
						$output .= "<p class='fwbyline' style='$center_text $text_padding'>";
						if ($writer) $output .= "<span class='sno_writer_fw'>$writer</span>";
						if ($showdate == 'on') { 
							if ($writer) $output .= ' | '; 
							$output .= '<span class="sno_date_fw">' . get_sno_timestamp() . '</span>';
						}
						$output .= "</p>";
					}

					$teaser = $instance['category-teaser-full-width']; if ($teaser == 0) { $kill_excerpt = 'on'; } else { $kill_excerpt = ''; }
					$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
					if ($excerpt && $kill_excerpt != 'on') { 
						$output .= "<div class='fw_sno_teaser'$text_style>";
						$output .= '<p>' . $excerpt . '</p>'; 
						$output .= '</div>';
  					} else if ($teaser) { 
						$output .= "<div class='fw_sno_teaser'$text_style>";
	  					$output .= get_the_content_limit($teaser, "");
						$output .= '</div>';
  					}

  					if ( $instance['show-continue'] == 'on' ) {
						$output .= "<div class='continue' style='padding-bottom:10px;$continue_location $text_padding'><span class='continue-link'>";
							if ($instance['category-teaser-full-width'] != 0 ) {
								$continue_text = get_theme_mod('continue-text');
							} else {
								$continue_text = get_theme_mod('read-text');
							}
							if ($continue_text == '') $continue_text = "Continue Reading";
							$output .= $continue_text;
						$output .= '<span></div><div class="clear"></div>';
					}

					if ($instance['text-area-center'] == 'on' && $image0) { // only add this if image exists
						$output .= "<script type='text/javascript'>
										$(document).ready(function() {
											var panel_height = $max_height_clean - 20;
											var text_height = $('.fw1-textarea$unique_id').height();
											if (panel_height > text_height) {
												var padding = (panel_height - text_height) / 2;
												$('.fw1-textarea$unique_id').css('padding-top', padding)
											}
										});
									</script>";						
					}				

					$output .= "	
									<script type='text/javascript'>
										$(document).ready(function() {
											$('.fw1-textarea$unique_id .continue').click(function() {
												window.location=$(this).parent().find('a').attr('href');
											});
										});
									</script>";

				$output .= '</div>';

				
					
				}

			$output .= '<div class="clear"></div>'; 

			$output .= '</div>';

		//	$output .= '<div class="clear"></div>'; 

	        endwhile; else: endif; 


	        if ($instance['view-all']=='on' && $instance['category'] != 0) {  
				$output .= "<div class='clear'></div><a href='$categoryslug' class='view-all-link'><div class='view-all-container'><span class='view-all-text view-all-category'>";
					$view_all_text = get_theme_mod('viewall-text');
					if ($view_all_text == '') $view_all_text = "View All";
					$view_all_text = str_replace('%category%', $categoryname, $view_all_text);
					$output .= $view_all_text;
					$output .= '</span></div></a><div class="clear"></div>';
			} 
	        
	        $output .= '</div>';

            if ($instance['outer-design'] == 'on') {
	            $output .= "<div class='clear'></div></div>";
	            $output .= "<style>.panel-wrap$unique_widget_id .fw1-panel:last-of-type { margin-bottom:0px; }</style>";
            }

		} else if ($instance['sidebarname'] == 'Full-Width' && $instance['category-display-style'] == '2 Column') {
			
            if ($instance['outer-design'] == 'on') {
	            
	            $outer_background = $instance['outer-background-color'];
	            $outer_border_color = $instance['outer-border-color'];
	            $outer_border_thickness = $instance['outer-border-thickness'];
	            
	            $outer_style = " style='background: $outer_background; border: $outer_border_thickness solid $outer_border_color;'";
	            
	            $output .= "<div class='widget-outer-wrap'$outer_style>";
            }

			$displaynumber = $instance['number-full-width'];
			
			if ($displaynumber % 2 != 0) $displaynumber += 1;

			$headlinesize = $instance['headline-size-full-width']; $headlinesize_px = $headlinesize . 'px';
			$lineheight = round($headlinesize * 1.2); $lineheight_px = $lineheight . 'px';
			$headline_style = " style='font-size:$headlinesize_px; line-height:1.2em; '";

			$textsize = $instance['text-size-full-width']; $textsize_px = $textsize . 'px';
			$textlineheight = round($textsize * 1.4); $textlineheight_px = $textlineheight . 'px';
			$center_teaser = '';
			if ($instance['text-area-center-t'] == 'on') {
				$center_teaser = "text-align:center;";
			} 
			$text_style = " style='font-size:$textsize_px; line-height:1.2em;$center_teaser '";

			if ($instance['text-override'] == 'on' && $instance['text-padding'] == 'On') {
				$text_override_color = $instance['text-override-color']; if ($text_override_color == '') $text_override_color = '#000';
				$output .= "<style>#fw2-textarea$unique_widget_id a, #fw2-textarea$unique_widget_id { color: $text_override_color !important; }</style>";
			}
			
			// exclude any story ids that have been already rendered on the page and added to the session variable
			if (isset($_ENV['sno_exclude'])) foreach ($_ENV['sno_exclude'] as $key => $value) {
				$exclusionarray[] = $value;
			}

			if ($instance['category'] === '0') { 
				$uncategorized = '-'.get_theme_mod('breaking-hidecat'); $args = array ( 'cat' => $uncategorized.$exclude_category, 'showposts' => $displaynumber, 'post__not_in' => $exclusionarray, 'offset' => $offset);
			} else {
				$args = array ( 'cat' => $instance['category'].$exclude_category, 'showposts' => $displaynumber, 'post__not_in' => $exclusionarray, 'offset' => $offset);
			}
			
			$panel_styles = ''; $panel_background = ''; $panel_height = '';
				
			if ($instance['text-padding'] == 'On') {
	            $panel_background = 'background: ' . $instance['text-background'] . ';';
            }
            $panel_height_px = $instance['full-fixed-height'] . 'px'; 
            $max_height = $instance['full-fixed-height'];
            $panel_height = "max-height:$panel_height_px;min-height:$panel_height_px;";
            if ($instance['photo-position'] == 'Above Story') $panel_height = '';
            $bottom_margin = '';
            if ($instance['text-padding'] == 'Off') $bottom_margin = "margin-bottom:25px;";
            if ($instance['photo-position'] == 'Above Story') $panel_2c_width = "width:48.5%;margin-bottom:25px;";
            $cat_name_center = 'float:left;';
            if ($instance['photo-position'] == 'Above Story' && $instance['text-area-center-h'] == 'on' ) $cat_name_center = 'text-align:center;';
            if ($instance['photo-position'] == 'Above Story') $cat_name = 'position:relative;$cat_name_center';
            $panel_styles = " style='$panel_background $panel_height $bottom_margin $panel_2c_width $cat_name'";
            
            
            $offset_style = "style='width:100%;'";
            
            if ($instance['offset-title'] == 'on') {
            	$offset_style = "style='width:85%;float:right;'";
            	$title_color = $instance['title-text-color'];
            	$title_background = $instance['title-background-color'];
            	$title_border_thickness = $instance['title-border-thickness'];
            	$title_border_color = $instance['title-border-color'];
            	$padding_check = '';
            	if ($instance['text-padding'] == 'Off' && $instance['photo-padding'] == '') $padding_check = 'margin-top:10px;';
            	
            	$title_style = " style='$padding_check border-top:$title_border_thickness solid $title_border_color; border-bottom:$title_border_thickness solid $title_border_color; color: $title_color; background: $title_background;'";
            	$output .= "<div class='offset-title-wrap'$title_style>";
            		if ($instance['category']) { 
						$categoryslug = cat_id_to_slug($instance['category']);
						if (!is_home()) $categoryslug .= '?list';

	            		$output .= "<a style='color: $title_color;' href='$categoryslug'>" . get_cat_name($instance['category']) . "</a>";
	            	} else {
	            		$output .= 'Recent Posts';
	            	}
            	$output .= "</div>";
            	
            }
            $output .= "<div class='panel-wrap' $offset_style>";
            

            query_posts( $args ); $wrapclass = ''; $count = 0;
            if (have_posts()) : while (have_posts()) : the_post(); global $post; 
				$custom_fields = get_post_custom($post->ID); $customlink = '';
				if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
				if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }
            
            	$count++; if ($count % 2 == 0) { $displayside = 'fw2-rightside '; } else { $displayside = 'fw2-leftside '; }
            	
            	$output .= "<div class='$displayside fw2-panel'$panel_styles>";

					$title = get_the_title();
					$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
					$photo_width = $instance['main-photo-width'];
					
					
					$image0 = $image[0]; $image1 = $image[1]; $image2 = $image[2];
					
					if ($image0) {
						$area_width = 240;
						if ($instance['photo-position'] == 'Above Story') $area_width = 450;
						if ($instance['offset-title'] == 'on') $area_width -= 50;
						$image_proportion = $image1 / $image2; 
						$area_proportion = $area_width / $instance['full-fixed-height']; 
						
							if ($image_proportion < $area_proportion) { 
								$photo_style = "height:auto; width:100%;";
							} else {
								$photo_style = 'width:auto; height:100%;';						
							}

							$photo_style = ''; // temporarily overwriting this variable to test new CSS
							
						$unique_id = 'cat' . $this->number . $post->ID;
						
						$inner_panel_margin = '';
						$photo_position = "width:50%;max-width:50%;";
						$panel_height = $instance['full-fixed-height'];
						$panel_height_px .= 'px';
						$inner_panel_height = $instance['full-fixed-height'];
						if ($instance['photo-padding'] != 'on') {
							$inner_panel_height -= 20;		
							if ($instance['photo-position'] == 'Above Story') { 
								$inner_panel_margin = 'margin:10px;';
							} else {
								$inner_panel_margin = 'margin:10px 0 10px 10px;';
							}
						} else {
							$inner_panel_margin = 'margin:0 auto;';
						}				
						$inner_panel_height_px = $inner_panel_height . 'px';
						
						if ($instance['photo-position'] == 'Above Story') $photo_position = "width:100%;max-width:100%;";
						$output .= "<div id='catbox-$unique_id' style='height:$panel_height_px;float:left;overflow:hidden;$photo_position'>";
							$output .= "<div id='photowrap-$unique_id' style='height:$inner_panel_height_px; overflow:hidden;$inner_panel_margin'>";
								$output .= '<a href="' . $storylink . '#photo" title="'. $title .'">';
									$output .= '<img src="' . $image[0] . '" alt="' . $title . '" id="grow-' . $unique_id . '" style="'. $photo_style .'" />';
								$output .= '</a>';
							$output .= '</div>';					
						$output .= '</div>';					

						if (get_theme_mod('photo-animate') != 'Disable') {
							$max_height_clean = str_replace('px', '', $max_height);							
							$output .= "<script type='text/javascript'>
								$(document).ready(function() {
   								 	$('#grow-$unique_id').mouseenter(function() {
   										$('#grow-$unique_id').removeClass('shrink');
   										$('#grow-$unique_id').removeClass('grow');
   										$('#grow-$unique_id').addClass('grow');
   									}).mouseleave(function() {
   										$('#grow-$unique_id').addClass('shrink');
  									});";
									$output .= "
										});</script>";
						}
					} // end of photo display

				$panel_width = ''; $text_padding = ''; $text_background = ''; $text_panel_height = '';
				if (!$image0 || $instance['photo-position'] == 'Above Story') $panel_width = "width:96%;padding:2%;";
				
				if ($instance['text-padding'] == 'On') $text_background = $instance['text-background'];
				
				if ($instance['photo-position'] == 'Above Story') {
					$text_panel_height = $instance['text-height'];
					if (!$image0) $text_panel_height += $max_height;
					$text_panel_height .= 'px'; 
				}
				if ($instance['text-padding'] == 'Off') $text_padding = 'padding-top:0;';
				if ($instance['photo-position'] == 'Above Story' && $instance['text-padding'] == 'Off') $text_padding = 'padding: 7px 0 25px;';
				if ($instance['photo-position'] == 'Above Story' && $instance['text-padding'] == 'On') $text_padding = 'padding: 7px 2% 25px;';
				$output .= "<div id='fw2-textarea$unique_widget_id' class='fw2-textarea fw2-textarea$unique_id' style='background: $text_background;$panel_width$text_padding max-height:$text_panel_height; min-height: $text_panel_height;'>";
					
					$center_text = ''; $center_teaser = ''; $continue_location = "text-align:left;";
					if ($instance['text-area-center-h'] == 'on') {
						$center_text = "text-align:center;";
						$continue_location = "text-align:center;";
					} 

					
					if ($instance['cat-above-title'] == 'on') {
						if ($instance['category']) {
							$single_cat = $instance['category'];
						} else {
    						$categories = get_the_category($thePostID); $cat_list = array();
							$catcount = count($categories);
							if ($catcount == 1) {
		    					foreach($categories as $category) $cat_list[] = $category->term_id;							
	    					} else {
								foreach($categories as $category)  {  	
									if ($category->term_id != $instance['category'] ) $cat_list[] = $category->term_id;	
								}
							}
							$cat_list = array_filter($cat_list); $co = ''; $single_cat = $cat_list[0];
						}
						$cat_name = $center_text;
						$cat_name_offset = '20px';
						if ( $instance['photo-padding'] == 'on' ) $cat_name_offset = '10px';
						if ($instance['photo-position'] == 'Above Story' && $image0) $cat_name = "position:absolute;top:$cat_name_offset;left:$cat_name_offset;";
						$output .= "<div class='topstorycat' style='line-height:24px;margin-bottom:7px;$cat_name'>";
							$output .= '<span class="blockscat">';
								$output .= get_cat_name($single_cat);
							$output .= '</span>';
						$output .= '</div>';
						$output .= '<div class="clear"></div>';
					}
					
					$headlinesize = $instance['headline-size-full-width']; $headlineheight = floor($headlinesize * 1.2); 
					$output .= "<div class='widgetheadline' style='$center_text'><a href='" . $storylink . "' class='homeheadline' $headline_style title='Permanent Link to " . get_the_title() . "'>" . get_the_title() . "</a></div>";
													
					$writer = '';
					if ($instance['full-show-writer'] == 'on') $writer = snowriter(); 
					$showdate = $instance['full-show-date'];
									
					if ($writer || $showdate == "on") {
						$output .= "<p class='fwbyline' style='$center_text'>";
						if ($writer) $output .= "<span class='sno_writer_fw'>$writer</span>";
						if ($showdate == 'on') { 
							if ($writer) $output .= '<br />'; 
							$output .= '<span class="sno_date_fw">' . get_sno_timestamp() . '</span>';
						}
						$output .= "</p>";
					}
					
						$teaser = $instance['category-teaser-full-width']; if ($teaser == 0) { $kill_excerpt = 'on'; } else { $kill_excerpt = ''; }
						$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
						if ($excerpt && $kill_excerpt != 'on') { 
							$output .= "<div class='fw_sno_teaser'$text_style>";
							$output .= '<p>' . $excerpt . '</p>'; 
							$output .= '</div>';
  						} else if ($teaser) { 
	  						if (!$image0) { $teaser += 100; }
							$output .= "<div class='fw_sno_teaser'$text_style>";
							$output .= get_the_content_limit($teaser, " <span class='readmore'>Read More &raquo;</span>");
							$output .= '</div>';
  						}
  						
  					if ( $instance['show-continue'] == 'on' ) {
						$output .= "<div class='continue' style='padding-bottom:10px;$continue_location'><span class='continue-link'>";
							if ($instance['category-teaser-full-width'] != 0 ) {
								$continue_text = get_theme_mod('continue-text');
							} else {
								$continue_text = get_theme_mod('read-text');
							}
							if ($continue_text == '') $continue_text = "Continue Reading";
							$output .= $continue_text;
						$output .= '<span></div><div class="clear"></div>';
					}

					$output .= "	
									<script type='text/javascript'>
										$(document).ready(function() {
											$('.fw2-textarea$unique_id .continue').click(function() {
												window.location=$(this).parent().find('a').attr('href');
											});
										});
									</script>";
  						
		//			if ($instance['text-area-center'] == 'on') { 
		//				$output .= "
		//					<script type='text/javascript'>
		//							var height = $('.fw2-textarea$unique_id').height();
		//							var photoHeight = $('#catbox-$unique_id').height();
		//							var new_padding = Math.floor((photoHeight - height)/2);
		//							$('.fw2-textarea$unique_id').css('padding-top', new_padding);
		//					</script>";
		//			}
  						
				$output .= "</div>";

				$output .= "</div>";
	        endwhile; else: endif; 
	        
	        if ($instance['view-all']=='on' && $instance['category'] != 0) {  
				$output .= "<div class='clear'></div><a href='$categoryslug' class='view-all-link'><div class='view-all-container'><span class='view-all-text view-all-category'>";
					$view_all_text = get_theme_mod('viewall-text');
					if ($view_all_text == '') $view_all_text = "View All";
					$view_all_text = str_replace('%category%', $categoryname, $view_all_text);
					$output .= $view_all_text;
					$output .= '</span></div></a><div class="clear"></div>';
			} 

	        $output .= "</div>";

            if ($instance['outer-design'] == 'on') {
	            $output .= "<div class='clear'></div></div>";
            }

		} else if ($instance['sidebarname'] == 'Full-Width' && $instance['category-display-style'] == '3 Column') {
			
            if ($instance['outer-design'] == 'on') {
	            
	            $outer_background = $instance['outer-background-color'];
	            $outer_border_color = $instance['outer-border-color'];
	            $outer_border_thickness = $instance['outer-border-thickness'];
	            
	            $outer_style = " style='background: $outer_background; border: $outer_border_thickness solid $outer_border_color;'";
	            
	            $output .= "<div class='widget-outer-wrap'$outer_style>";
            }

			$displaynumber = $instance['number-full-width'];
			
			if ($displaynumber > 3) { $displaynumber = 6; } else { $displaynumber = 3; }

			$headlinesize = $instance['headline-size-full-width']; $headlinesize_px = $headlinesize . 'px';
			$lineheight = round($headlinesize * 1.2); $lineheight_px = $lineheight . 'px';
			$headline_style = " style='font-size:$headlinesize_px; line-height:1.2em; '";


			$textsize = $instance['text-size-full-width']; $textsize_px = $textsize . 'px';
			$textlineheight = round($textsize * 1.4); $textlineheight_px = $textlineheight . 'px';
			$center_teaser = '';
			if ($instance['text-area-center-t'] == 'on') {
				$center_teaser = "text-align:center;";
			} 
			$text_style = " style='font-size:$textsize_px; line-height:1.2em;$center_teaser'";

			if ($instance['text-override'] == 'on' && $instance['text-padding'] == 'On') {
				$text_override_color = $instance['text-override-color']; if ($text_override_color == '') $text_override_color = '#000';
				$output .= "<style>#fw3-textarea$unique_widget_id a, #fw3-textarea$unique_widget_id { color: $text_override_color !important; }</style>";
			}

			// exclude any story ids that have been already rendered on the page and added to the session variable
			if (isset($_ENV['sno_exclude'])) foreach ($_ENV['sno_exclude'] as $key => $value) {
				$exclusionarray[] = $value;
			}
			
			if ($instance['category'] === '0') { 
				$uncategorized = '-'.get_theme_mod('breaking-hidecat'); $args = array ( 'cat' => $uncategorized.$exclude_category, 'showposts' => $displaynumber, 'post__not_in' => $exclusionarray, 'offset' => $offset);
			} else {
				$args = array ( 'cat' => $instance['category'].$exclude_category, 'showposts' => $displaynumber, 'post__not_in' => $exclusionarray, 'offset' => $offset);
			}
			
			$panel_styles = ''; $panel_background = ''; $panel_height = '';
				
			if ($instance['text-padding'] == 'On') {
	            $panel_background = 'background: ' . $instance['text-background'] . ';';
            }
            $panel_height_px = $instance['full-fixed-height'] . 'px'; 
            $max_height = $instance['full-fixed-height'];
            $panel_height = "max-height:$panel_height_px;min-height:$panel_height_px;";
            $panel_height = '';
            $bottom_margin = '';
            if ($instance['text-padding'] == 'Off') $bottom_margin = "margin-bottom:25px;";
            $panel_2c_width = "margin-bottom:20px;";
            $cat_name = 'position:relative;';
            $panel_styles = " style='$panel_background $panel_height $bottom_margin $panel_2c_width $cat_name'";
            
            
            $offset_style = "style='width:100%;'";

					$center_text = ''; $center_teaser = ''; $continue_location = "text-align:left;";
					if ($instance['text-area-center-h'] == 'on') {
						$center_text = "text-align:center;";
						$continue_location = "text-align:center;";
					} 

            
            if ($instance['offset-title'] == 'on') {
            	$offset_style = "style='width:85%;float:right;'";
            	$title_color = $instance['title-text-color'];
            	$title_background = $instance['title-background-color'];
            	$title_border_thickness = $instance['title-border-thickness'];
            	$title_border_color = $instance['title-border-color'];
            	$padding_check = '';
            	if ($instance['text-padding'] == 'Off' && $instance['photo-padding'] == '') $padding_check = 'margin-top:10px;';
            	
            	$title_style = " style='$padding_check border-top:$title_border_thickness solid $title_border_color; border-bottom:$title_border_thickness solid $title_border_color; color: $title_color; background: $title_background;'";
            	$output .= "<div class='offset-title-wrap'$title_style>";
            		if ($instance['category']) { 
						$categoryslug = cat_id_to_slug($instance['category']);
						if (!is_home()) $categoryslug .= '?list';

	            		$output .= "<a style='color: $title_color;' href='$categoryslug'>" . get_cat_name($instance['category']) . "</a>";
	            	} else {
	            		$output .= 'Recent Posts';
	            	}
            	$output .= "</div>";
            	
            }
            $output .= "<div class='panel-wrap' $offset_style>";
            

            query_posts( $args ); $wrapclass = ''; $count = 0;
            if (have_posts()) : while (have_posts()) : the_post(); global $post; 
            
				$custom_fields = get_post_custom($post->ID); $customlink = '';
				if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
				if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }
    
            	$count++; 
            	if ($count % 3 == 0) { 
	            	$displayside = 'fw3-rightside '; 
	            } else if ($count % 3 == 1){ 
		            $displayside = 'fw3-leftside '; 
	            } else {
		            $displayside = 'fw3-center '; 
	            }
            	
            	$output .= "<div class='$displayside fw3-panel'$panel_styles>";

					$title = get_the_title();
					$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
					$photo_width = $instance['main-photo-width'];
					
					
					$image0 = $image[0]; $image1 = $image[1]; $image2 = $image[2];
					
					if ($image0) {
						$area_width = 314;
						if ($instance['text-padding'] == 'On') $area_width -= 20;
						if ($instance['offset-title'] == 'on') $area_width -= 46;
						if (get_theme_mod('outer-padding') != 'Remove') $area_width -= 10;
						
						$area_height = $instance['full-fixed-height'];
						if ($instance['text-padding'] == 'On') $area_height -= 20;						
						
						$image_proportion = $image1 / $image2; 
						$area_proportion = $area_width / $area_height; 
						
							if ($image_proportion <= $area_proportion) { 
								$photo_style = "height:auto; width:100%;";
							} else {
								$photo_style = 'width:auto; height:100%;';						
							}
							
							$photo_style = ''; // temporarily blanking out this variable to try new CSS

						$unique_id = 'cat' . $this->number . $post->ID;
						
						$inner_panel_margin = '';
						$photo_position = "width:50%;max-width:50%;";
						$panel_height = $instance['full-fixed-height'];
						$inner_panel_height = $instance['full-fixed-height'];
						if ($instance['photo-padding'] != 'on') {
							$inner_panel_margin = 'margin:10px;';
						} else {
							$inner_panel_margin = 'margin:0 auto;';
						}				
						$inner_panel_height_px = $inner_panel_height . 'px';
						
						$photo_position = "width:100%;max-width:100%;";
						$output .= "<div id='catbox-$unique_id' style='float:left;overflow:hidden;$photo_position'>";
							$output .= "<div class='fw3-image-wrap' id='photowrap-$unique_id' style='height:$inner_panel_height_px; overflow:hidden;$inner_panel_margin'>";
								$output .= '<a href="' . $storylink . '" title="'. $title .'">';
									$output .= '<img class="fw3-image" src="' . $image[0] . '#photo" alt="' . $title . '" id="grow-' . $unique_id . '" style="'. $photo_style .'" />';
								$output .= '</a>';
							$output .= '</div>';					
						$output .= '</div>';					

						if (get_theme_mod('photo-animate') != 'Disable') {
							$max_height_clean = str_replace('px', '', $max_height);							
							$output .= "<script type='text/javascript'>
								$(document).ready(function() {
   								 	$('#grow-$unique_id').mouseenter(function() {
   										$('#grow-$unique_id').removeClass('shrink');
   										$('#grow-$unique_id').removeClass('grow');
   										$('#grow-$unique_id').addClass('grow');
   									}).mouseleave(function() {
   										$('#grow-$unique_id').addClass('shrink');
  									});";
									$output .= "
										});</script>";
						}
					} // end of photo display

				$panel_width = ''; $text_padding = ''; $text_background = ''; $text_panel_height = '';
				if (!$image0) $panel_width = "width:96%;padding:2%;";
				
				if ($instance['text-padding'] == 'On') $text_background = $instance['text-background'];
				
					$text_panel_height = $instance['text-height'];
					if (!$image0) $text_panel_height += $max_height;
					$text_panel_height .= 'px'; 

				if ($instance['text-padding'] == 'Off') $text_padding = 'padding: 7px 10px 25px;';
				if ($instance['text-padding'] == 'On') $text_padding = 'padding: 7px 3% 25px;';
				$output .= "<div id='fw3-textarea$unique_widget_id' class='fw3-textarea fw3-textarea$unique_id' style='background: $text_background;$panel_width$text_padding max-height:$text_panel_height; min-height: $text_panel_height;'>";

					
					if ($instance['cat-above-title'] == 'on') {
						if ($instance['category']) {
							$single_cat = $instance['category'];
						} else {
    						$categories = get_the_category($thePostID); $cat_list = array();
							$catcount = count($categories);
							if ($catcount == 1) {
		    					foreach($categories as $category) $cat_list[] = $category->term_id;							
	    					} else {
								foreach($categories as $category)  {  	
									if ($category->term_id != $instance['category'] ) $cat_list[] = $category->term_id;	
								}
							}
							$cat_list = array_filter($cat_list); $co = ''; $single_cat = $cat_list[0];
						}
						$cat_name = '';
						if ($image0) $cat_name = 'position:absolute;top:10px;';
						$output .= "<div class='topstorycat' style='line-height:24px;margin-bottom:7px;$cat_name'>";
							$output .= '<span class="blockscat">';
								$output .= get_cat_name($single_cat);
							$output .= '</span>';
						$output .= '</div>';
						$output .= '<div class="clear"></div>';
					}
					
					$headlinesize = $instance['headline-size-full-width']; $headlineheight = floor($headlinesize * 1.2); 
					$output .= "<div class='widgetheadline' style='$center_text'><a href='" . $storylink . "' class='homeheadline' $headline_style title='Permanent Link to " . get_the_title() . "'>" . get_the_title() . "</a></div>";
													
					$writer = '';
					if ($instance['full-show-writer'] == 'on') $writer = snowriter(); 
					$showdate = $instance['full-show-date'];
									
					if ($writer || $showdate == "on") {
						$output .= "<p class='fwbyline' style='$center_text'>";
						if ($writer) $output .= "<span class='sno_writer_fw'>$writer</span>";
						if ($showdate == 'on') { 
							if ($writer) $output .= '<br />'; 
							$output .= '<span class="sno_date_fw">' . get_sno_timestamp() . '</span>';
						}
						$output .= "</p>";
					}
					
						$teaser = $instance['category-teaser-full-width']; if ($teaser == 0) { $kill_excerpt = 'on'; } else { $kill_excerpt = ''; }
						$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
						if ($excerpt && $kill_excerpt != 'on') { 
							$output .= "<div class='fw_sno_teaser'$text_style>";
							$output .= '<p>' . $excerpt . '</p>'; 
							$output .= '</div>';
  						} else if ($teaser) { 
	  						if (!$image0) { $teaser += 100; }
							$output .= "<div class='fw_sno_teaser'$text_style>";
							$output .= get_the_content_limit($teaser, " <span class='readmore'>Read More &raquo;</span>");
							$output .= '</div>';
  						}

  					if ( $instance['show-continue'] == 'on' ) {
						$output .= "<div class='continue' style='padding-bottom:10px;$continue_location'><span class='continue-link'>";
							if ($instance['category-teaser-full-width'] != 0 ) {
								$continue_text = get_theme_mod('continue-text');
							} else {
								$continue_text = get_theme_mod('read-text');
							}
							if ($continue_text == '') $continue_text = "Continue Reading";
							$output .= $continue_text;
						$output .= '<span></div><div class="clear"></div>';
					}

					$output .= "	
									<script type='text/javascript'>
										$(document).ready(function() {
											$('.fw3-textarea$unique_id .continue').click(function() {
												window.location=$(this).parent().find('a').attr('href');
											});
										});
									</script>";

				$output .= "</div>";

				$output .= "</div>";
	        endwhile; else: endif;
	        
	        if ($instance['view-all']=='on' && $instance['category'] != 0) {  
				$output .= "<div class='clear'></div><a href='$categoryslug' class='view-all-link'><div class='view-all-container'><span class='view-all-text view-all-category'>";
					$view_all_text = get_theme_mod('viewall-text');
					if ($view_all_text == '') $view_all_text = "View All";
					$view_all_text = str_replace('%category%', $categoryname, $view_all_text);
					$output .= $view_all_text;
					$output .= '</span></div></a><div class="clear"></div>';
			} 

	        $output .= "</div>";

            if ($instance['outer-design'] == 'on') {
	            $output .= "<div class='clear'></div></div>";
            }


		} else if ($instance['sidebarname'] == 'Full-Width' && $instance['category-display-style'] == '2 Column Dominant') {
		
            if ($instance['outer-design'] == 'on') {
	            
	            $outer_background = $instance['outer-background-color'];
	            $outer_border_color = $instance['outer-border-color'];
	            $outer_border_thickness = $instance['outer-border-thickness'];
	            
	            $outer_style = " style='background: $outer_background; border: $outer_border_thickness solid $outer_border_color;'";
	            
	            $output .= "<div class='widget-outer-wrap'$outer_style>";
            }
			
			$headlinesize = $instance['headline-size-full-width']; $headlinesize_px = $headlinesize . 'px';
			$lineheight = round($headlinesize * 1.2); $lineheight_px = $lineheight . 'px';
			$headline_style = " style='font-size:$headlinesize_px; line-height:1.2em; '";

			$textsize = $instance['text-size-full-width']; $textsize_px = $textsize . 'px';
			$textlineheight = round($textsize * 1.4); $textlineheight_px = $textlineheight . 'px';
			$text_style = " style='font-size:$textsize_px; line-height:1.2em; '";

			if ($instance['text-override'] == 'on' && $instance['text-padding'] == 'On') {
				$text_override_color = $instance['text-override-color']; if ($text_override_color == '') $text_override_color = '#000';
				$output .= "<style>#fw2-textarea$unique_widget_id a, #fw2-textarea$unique_widget_id { color: $text_override_color !important; }</style>";
			}
			
			$allow_vertical = $instance['allow-vertical'];
            $max_height = $instance['full-fixed-height'];
			$panel_styles = ''; $panel_background = ''; $panel_height = '';
				

            $offset_style = "style='width:100%;'";
            if ($instance['offset-title'] == 'on') {
            	$offset_style = "style='width:85%;float:right;'";
            	$title_color = $instance['title-text-color'];
            	$title_background = $instance['title-background-color'];
            	$title_border_thickness = $instance['title-border-thickness'];
            	$title_border_color = $instance['title-border-color'];
            	$padding_check = '';
            	if ($instance['text-padding'] == 'Off' && $instance['photo-padding'] == '') $padding_check = 'margin-top:10px;';
            	
            	$title_style = " style='$padding_check border-top:$title_border_thickness solid $title_border_color; border-bottom:$title_border_thickness solid $title_border_color; color: $title_color; background: $title_background;'";
            	$output .= "<div class='offset-title-wrap'$title_style>";
            		if ($instance['category']) { 
						$categoryslug = cat_id_to_slug($instance['category']);
						if (!is_home()) $categoryslug .= '?list';

	            		$output .= "<a style='color: $title_color;' href='$categoryslug'>" . get_cat_name($instance['category']) . "</a>";
	            	} else {
	            		$output .= 'Recent Posts';
	            	}
            	$output .= "</div>";
            	
            }
            $output .= "<div class='panel-wrap' $offset_style>";
            
			// exclude any story ids that have been already rendered on the page and added to the session variable
			if (isset($_ENV['sno_exclude'])) foreach ($_ENV['sno_exclude'] as $key => $value) {
				$exclusionarray[] = $value;
			}

			if ($instance['category'] === '0') { 
				$uncategorized = '-'.get_theme_mod('breaking-hidecat'); $args = array ( 'meta_key' => '_thumbnail_id', 'cat' => $uncategorized.$exclude_category, 'showposts' => 1, 'post__not_in' => $exclusionarray, 'offset' => $offset);
			} else {
				$args = array ( 'meta_key' => '_thumbnail_id', 'cat' => $instance['category'].$exclude_category, 'showposts' => 1, 'post__not_in' => $exclusionarray, 'offset' => $offset);
			}

            query_posts( $args ); $wrapclass = ''; $count = 0;
            if (have_posts()) : while (have_posts()) : the_post(); global $post; 
				$custom_fields = get_post_custom($post->ID); $customlink = '';
				if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
				if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }
            
            	
            	$display_width = $instance['dominant-column-width'];
            	$panel_styles = " style='float:left;position:relative;min-width:$display_width%;max-width:$display_width%;'";  
            	
            	$output .= "<div class='fw2-panel'$panel_styles>";

					$title = get_the_title();
					$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
					$photo_width = $instance['dominant-column-width'];
					
					
					$image0 = $image[0]; $image1 = $image[1]; $image2 = $image[2];
					
					if ($image0) {
						$site_width_multiplier = 9.8;
						if (get_theme_mod('content-width') != '') $site_width_multiplier = get_theme_mod('content-width')/100;
						$area_width = $instance['dominant-column-width'] * $site_width_multiplier;
												
						if ($instance['offset-title'] == 'on') $area_width -= 50;
						$image_proportion = $image1 / $image2; 
						$area_proportion = $area_width / $instance['full-fixed-height']; 
						
							if ($image_proportion < $area_proportion) { 
								$photo_style = "height:auto; width:100%;";
							} else {
								$photo_style = 'width:auto; height:100%;';						
							}

						$unique_id = 'cat' . $this->number . $post->ID;
						
						$photo_position = "width:100%;max-width:100%;";
						$panel_height_px = $instance['full-fixed-height'] . 'px';
						$panel_height = "max-height:$panel_height_px;min-height:$panel_height_px;";
						
						if ($instance['photo-padding'] == '') {
							$photo_background = '';
							if ($instance['text-padding'] == 'On') $photo_background = 'background:' . $instance['text-background'] . ';';
							$photo_position = "padding: 10px 2% 0;width:96%;max-width:96%;$photo_background";
							if ($instance['photo-overlay'] == 'on') { $photo_position = "padding:0;width:100%;max-width:100%;"; }

						}
						
						$photo_style = ''; // blanking out this variable as we try out some new CSS tricks
						
						$output .= "<div id='catbox-$unique_id' style='height:$panel_height_px;float:left;overflow:hidden;$photo_position'>";
							$output .= "<div id='photowrap-$unique_id' style='height:$panel_height_px; overflow:hidden;margin: 0 auto;'>";
								$output .= '<a href="' . $storylink . '#photo" title="'. $title .'">';
									$output .= '<img class="fw2d-image" src="' . $image[0] . '#photo" alt="' . $title . '" id="grow-' . $unique_id . '" style="'. $photo_style .'" />';
								$output .= '</a>';
							$output .= '</div>';					
						$output .= '</div>';					
						
						if (get_theme_mod('photo-animate') != 'Disable' && has_post_thumbnail()) {
							if ($instance['photo-overlay'] != 'on') {
								$max_height_clean = str_replace('px', '', $max_height);							
	  							if ($image1=='') $image1 = 300;						
	  							if ($image2=='') $image2 = 200;						
								$output .= "<script type='text/javascript'>
									$(document).ready(function() {
   									 	$('#grow-$unique_id').mouseenter(function() {
   											$('#grow-$unique_id').removeClass('shrink');
   											$('#grow-$unique_id').removeClass('grow');
   											$('#grow-$unique_id').addClass('grow');
   										}).mouseleave(function() {
   											$('#grow-$unique_id').addClass('shrink');
   										});";
   									if ($allow_vertical == 'on') $output .= "
										var original_width = $image1;
										var original_height = $image2;
										var actual_height = $max_height_clean;
										var actual_width = ( original_width * actual_height ) / original_height;
										actual_width = Math.round(actual_width);
										$('#photowrap-$unique_id').css({ height: actual_height + 'px' });
										$('#photowrap-$unique_id').css({ width: actual_width + 'px' });";
									$output .= "
										});</script>";
							} else {
																
								$max_height_clean = str_replace('px', '', $max_height);		
								if ($image1=='') $image1 = 300;						
	  							if ($image2=='') $image2 = 200;						
					
								$output .= "<script type='text/javascript'>
									$(document).ready(function() {
   									 	$('#grow-$unique_id, #fw2-textarea$unique_id').mouseenter(function() {
   											$('#grow-$unique_id').removeClass('shrink');
   											$('#grow-$unique_id').removeClass('grow');
   											$('#grow-$unique_id').addClass('grow');
   										})
   										$('#grow-$unique_id, #fw2-textarea$unique_id').mouseleave(function() {
											timer = setTimeout(hideOverlay, 3);
										}).mouseenter(function() {
											clearTimeout(timer);
										});
										function hideOverlay() {
   											$('#grow-$unique_id').addClass('shrink');
										};";
   									if ($allow_vertical == 'on') $output .= "
										var original_width = $image1;
										var original_height = $image2;
										var actual_height = $max_height_clean;
										var actual_width = ( original_width * actual_height ) / original_height;
										actual_width = Math.round(actual_width);
										$('#photowrap-$unique_id').css({ height: actual_height + 'px' });
										$('#photowrap-$unique_id').css({ width: actual_width + 'px' });";
									$output .= "
										});</script>";
							}
						}
					} // end of photo display
				
				$panel_width = ''; $text_padding = ''; $text_background = '';
				$panel_width = "width:96%;padding:10px 2%;";
				$text_panel_height = '';
				
				if ($instance['text-padding'] == 'On') $text_background = $instance['text-background'];
				if ($instance['text-padding'] == 'Off') $panel_width = "width:100%;padding:10px 0;";
				$text_panel_height = $instance['text-height'] . 'px';
				
				if ($instance['photo-overlay'] == 'on') {
					$output .= "<div id='fw2-textarea$unique_id' class='fw2-textarea desc' style='width:100%;position:absolute;padding:0;bottom:0px;left:0;right:0;overflow:hidden;'>";
				} else {
					$output .= "<div id='fw2-textarea$unique_id' class='fw2-textarea' style='background: $text_background;$panel_width$text_padding max-height:$text_panel_height; min-height: $text_panel_height;'>";
					
				}
					
					if ($instance['cat-above-title'] == 'on') {
						if ($instance['category']) {
							$single_cat = $instance['category'];
						} else {
    						$categories = get_the_category($thePostID); $cat_list = array();
							$catcount = count($categories);
							if ($catcount == 1) {
		    					foreach($categories as $category) $cat_list[] = $category->term_id;							
	    					} else {
								foreach($categories as $category)  {  	
									if ($category->term_id != $instance['category'] ) $cat_list[] = $category->term_id;	
								}
							}
							$cat_list = array_filter($cat_list); $co = ''; $single_cat = $cat_list[0];
						}
						if ($instance['text-padding'] != 'on') $cat_name = 'left:10px';
						$output .= "<div class='topstorycat' style='position:absolute;top:10px;float:left;line-height:24px;margin-bottom:7px;$cat_name'>";
							$output .= '<span class="blockscat">';
								$output .= get_cat_name($single_cat);
							$output .= '</span>';
						$output .= '</div>';
						$output .= '<div class="clear"></div>';
					}
					
					$headlinesize = $instance['headline-size-full-width']; $headlineheight = floor($headlinesize * 1.2); 
					$output .= "<div class='widgetheadline'><a href='" . $storylink . "' class='homeheadline' $headline_style title='Permanent Link to " . get_the_title() . "'>" . get_the_title() . "</a></div>";
													
					$writer = '';
					if ($instance['full-show-writer'] == 'on') $writer = snowriter(); 
					$showdate = $instance['full-show-date'];
									
					if ($writer || $showdate == "on") {
						$output .= "<p class='fwbyline'>";
						if ($writer) $output .= "<span class='sno_writer_fw'>$writer</span>";
						if ($showdate == 'on') { 
							if ($writer) $output .= '<br />'; 
							$output .= '<span class="sno_date_fw">' . get_sno_timestamp() . '</span>';
						}
						$output .= "</p>";
					}
					if ($instance['photo-overlay'] != 'on') {
						$teaser = $instance['category-teaser-full-width']; if ($teaser == 0) { $kill_excerpt = 'on'; } else { $kill_excerpt = ''; }
						$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
						if ($excerpt && $kill_excerpt != 'on') { 
							$output .= "<div class='fw_sno_teaser'$text_style>";
							$output .= '<p>' . $excerpt . '</p>'; 
							$output .= '</div>';
  						} else if ($teaser) { 
	  						if (!$image0) { $teaser += 100; }
							$output .= "<div class='fw_sno_teaser'$text_style>";
							$output .= get_the_content_limit($teaser, " <span class='readmore'>Read More &raquo;</span>");
							$output .= '</div>';
  						}
  					}
				$output .= "</div>";

				$output .= "</div>";

				$exclusion_array[] = $post->ID;
				
	        endwhile; else: endif;
			if ($instance['exclude-this'] == 'on') {
				if (have_posts()) : while (have_posts()) : the_post();
					$_ENV['sno_exclude'][] = $post->ID;
				endwhile; else: endif; wp_reset_query();
			}
	
	
	// start of new loop for right column -- exclude post already used
	
			$number = $instance['number-full-width'] - 1;
			$hide_photo = $instance['photo-display'];
			
			// exclude any story ids that have been already rendered on the page and added to the session variable
		
			if (isset($_ENV['sno_exclude'])) foreach ($_ENV['sno_exclude'] as $key => $value) {
				$exclusionarray[] = $value;
			}

			if ($instance['category'] === '0') { 
				$uncategorized = '-'.get_theme_mod('breaking-hidecat'); $args = array ( 'cat' => $uncategorized.$exclude_category, 'showposts' => $number, 'post__not_in' => $exclusion_array, 'offset' => $offset);
			} else {
				$args = array ( 'cat' => $instance['category'].$exclude_category, 'showposts' => $number, 'post__not_in' => $exclusion_array, 'offset' => $offset);
			}
			
			if ($instance['photo-overlay'] == 'on') $instance['text-height'] = -20;
            $total_height = $instance['full-fixed-height'] + $instance['text-height'] + 20; // calculates height of first column (includes text area padding)	
            if ($instance['photo-padding'] == '' && $instance['photo-overlay'] != 'on') $total_height += 10;
            $spacing = $instance['spacing']; if ($spacing == '') $spacing = 10; $spacing_px = $spacing . 'px';
           	$small_panel_height = ($total_height - (($number - 1) * $spacing)) / $number;
           	$small_panel_height_px = $small_panel_height . 'px';
			
			query_posts( $args ); $wrapclass = ''; $count = 0;
			if (have_posts()) : while (have_posts()) : the_post(); global $post; 
			
				$custom_fields = get_post_custom($post->ID); $customlink = '';
				if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
				if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }

            	$count++; $displayside = 'fw2-rightside ';

				$unique_id = 'cat' . $this->number . $post->ID;
            	
            	
            	$column_width = 100 - $instance['dominant-column-width']; 
				$spacing_perc = $spacing / 9; $column_width -= $spacing_perc;
            	
            	$background = '';
            	if ($instance['text-padding'] == 'On') $background = $instance['text-background'];
            	$output .= "<div class='fw2d-right' style='background: $background;margin-bottom:$spacing_px;min-height:$small_panel_height_px;max-height:$small_panel_height_px; width: $column_width%;'>";
            	

            	$output .= "<div id='fw2-textarea$unique_widget_id' class='fw2d-inner'>";

					$title = get_the_title();
					$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
					$photo_width = $instance['main-photo-width'];
					
					
					$image0 = $image[0]; $image1 = $image[1]; $image2 = $image[2];
					
					if ($image0 && $hide_photo != 'on') {
						$area_width = $small_panel_height;
						$image_proportion = $image1 / $image2; 
						$area_proportion = $area_width / $small_panel_height; 
												
							if ($image_proportion < $area_proportion || $instance['dominant-column-width'] > 70) { 
								$photo_style = "height:auto; width:100%;"; 
							} else {
								$photo_style = 'width:auto; height:100%;';			
							}
						$unique_id = 'cat' . $this->number . $post->ID;
						
						$inner_panel_margin = '';
						$inner_panel_height = $small_panel_height;
						$inner_panel_height_px = $inner_panel_height . 'px';
						if ($instance['photo-padding'] != 'on' && $instance['dominant-column-width'] > 70) {
							$inner_panel_height -= 10;		
							$inner_panel_margin = 'margin:10px 0 0px 4.5%;';
							$vot_padding = '91';
						} else if ($instance['photo-padding'] != 'on') {
							$inner_panel_margin = 'margin:10px 0px 10px 10px;';
							$outer_panel_height = $inner_panel_height;
							$outer_panel_height_px = $outer_panel_height . 'px';
							$inner_panel_height -= 20;								
							$inner_panel_height_px = $inner_panel_height . 'px';
						} else {	
							$inner_panel_margin = 'margin:0 auto;'; 
						}				
						$inner_panel_css = "height:$inner_panel_height_px;"; 
						$outer_panel_css = "height:$outer_panel_height_px;";
						$photo_position = "width:$small_panel_height_px;max-width:$small_panel_height_px;";
						
						$margin_bottom = ''; $photo_css = '';
						if ($instance['dominant-column-width'] > 70 ) { // force vertical mode
							$max_photo_height = ((98 - $instance['dominant-column-width']) * 6.6) . 'px';
							$v_padding = 100;
							if ($vot_padding) $v_padding = $vot_padding;
							$inner_panel_css = "height: 0px !important; overflow:hidden;padding-top:55%;position:relative;max-width:$v_padding%;width:$v_padding%;"; 
							$outer_panel_css = "max-width:$v_padding%;width:$v_padding%;height:auto;"; 
							$margin_bottom = 'margin-bottom:0px;';
							$photo_css = 'position:absolute;top:0;';
						}

						if ($instance['dominant-column-width'] > 70) $photo_position = "width:100%;max-width:100%;";
						$output .= "<div class='fw2d-img-wrap-outer' id='catbox-$unique_id' style='$outer_panel_css float:left;overflow:hidden;$photo_position;margin-right:10px;$margin_bottom'>";
						
						$photo_style = ''; // overwriting previous declarations as we try a new CSS trick

							$output .= "<div class='fw2d-img-wrap' id='photowrap-$unique_id' style='$inner_panel_css overflow:hidden;$inner_panel_margin'>";
								$output .= '<a href="' . $storylink . '#photo" title="'. $title .'">';
									$output .= "<img class='fw2d-img' src='$image0' alt='$title' id='grow-$unique_id' style='$photo_css$photo_style' />";
								$output .= '</a>';
							$output .= '</div>';					
						$output .= '</div>';					

						if (get_theme_mod('photo-animate') != 'Disable' && has_post_thumbnail()) {
							$max_height_clean = str_replace('px', '', $max_height);							
							$output .= "<script type='text/javascript'>
								$(document).ready(function() {
   								 	$('#grow-$unique_id').mouseenter(function() {
   										$('#grow-$unique_id').removeClass('shrink');
   										$('#grow-$unique_id').removeClass('grow');
   										$('#grow-$unique_id').addClass('grow');
   									}).mouseleave(function() {
   										$('#grow-$unique_id').addClass('shrink');
  									});";
									$output .= "
										});</script>";
						}
					} // end of photo display

				$panel_width = ''; $text_padding = ''; $text_background = ''; $text_panel_height = '';
				if (!$image0 || $instance['photo-position'] == 'Above Story') $panel_width = "width:96%;padding:2%;";
				
				if ($instance['text-padding'] == 'On') $text_background = $instance['text-background'];
				
				if ($instance['photo-position'] == 'Above Story') {
					$text_panel_height = $instance['text-height'];
					if (!$image0) $text_panel_height += $max_height;
					$text_panel_height .= 'px'; 
				}
				if ($instance['text-padding'] == 'Off') $text_padding = 'padding-top:0;';
				if ($instance['photo-position'] == 'Above Story' && $instance['text-padding'] == 'Off') $text_padding = 'padding: 7px 0 25px;';
				if ($instance['photo-position'] == 'Above Story' && $instance['text-padding'] == 'On') $text_padding = 'padding: 7px 2% 25px;';

				if ($instance['dominant-column-width'] > 70) $output .= "<div class='fw2d-right-text'></div>";
				$output .= "<div class='fw2d-right-text-wrap'>";
					
					$headlinesize = $instance['headline-size-full-width']; $headlineheight = floor($headlinesize * 1.2); 
					$output .= "<div class='widgetheadline'><a href='" . $storylink . "' class='homeheadline' title='Permanent Link to " . get_the_title() . "'>" . get_the_title() . "</a></div>";
													
					$writer = '';
					if ($instance['full-show-writer'] == 'on') $writer = snowriter(); 
					$showdate = $instance['full-show-date'];
				
				if ($instance['dominant-column-width'] < 70 || $hide_photo == 'on') {
					if ($writer || $showdate == "on") {
						$output .= "<p class='fwbyline'>";
						if ($writer) $output .= "<span class='sno_writer_fw'>$writer</span>";
						if ($showdate == 'on') { 
							if ($writer) $output .= '<br />'; 
							$output .= '<span class="sno_date_fw">' . get_sno_timestamp() . '</span>';
						}
						$output .= "</p>";
					}
				}									
					if (!$image0 && $small_panel_height > 120) {
						$teaser = $instance['category-teaser-full-width']; if ($teaser == 0) { $kill_excerpt = 'on'; } else { $kill_excerpt = ''; }
						$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
						if ($excerpt && $kill_excerpt != 'on') { 
							$output .= "<div class='fw_sno_teaser'>";
							$output .= '<p>' . $excerpt . '</p>'; 
							$output .= '</div>';
  						} else if ($teaser) { 
							$output .= "<div class='fw_sno_teaser'>";
							$output .= get_the_content_limit($teaser, " <span class='readmore'>Read More &raquo;</span>");
							$output .= '</div>';
  						}
  					}
  					$output .= '</div>';
				$output .= "</div>";

				$output .= "</div>";

	        endwhile; else: endif;
				
				$output .= "</div>";

	        if ($instance['view-all']=='on' && $instance['category'] != 0) {  
				$output .= "<div class='clear'></div><a href='$categoryslug' class='view-all-link'><div class='view-all-container'><span class='view-all-text view-all-category'>";
					$view_all_text = get_theme_mod('viewall-text');
					if ($view_all_text == '') $view_all_text = "View All";
					$view_all_text = str_replace('%category%', $categoryname, $view_all_text);
					$output .= $view_all_text;
					$output .= '</span></div></a><div class="clear"></div>';
			} 

            if ($instance['outer-design'] == 'on') {
	            $output .= "<div class='clear'></div></div>";
            }




		} else if (($instance['sidebarname'] == 'Home Main Column' ) && ($instance['three-column'] == 'on')) {
		
			$displaynumber = $instance['number3c']; if ($displaynumber == '') {
				
				$displaynumber = 3;
			}

			if (isset($_ENV['sno_exclude'])) foreach ($_ENV['sno_exclude'] as $key => $value) {
				$exclusionarray[] = $value;
			}
			
			if ($instance['category'] === '0') { 
				$uncategorized = '-'.get_theme_mod('breaking-hidecat'); $args = array ( 'cat' => $uncategorized.$exclude_category, 'showposts' => $displaynumber, 'post__not_in' => $exclusionarray, 'offset' => $offset);
			} else {
				$args = array ( 'cat' => $instance['category'].$exclude_category, 'showposts' => $displaynumber, 'post__not_in' => $exclusionarray, 'offset' => $offset);
			}
            query_posts( $args ); $wrapclass = ''; $count = 0;
            if (have_posts()) : while (have_posts()) : the_post(); global $post; 
            $count++; 
            if ($count % 3 == 0 ) { $wrapclass = ' widget3cwraplast'; } else { $wrapclass = ''; }
            if ($count <= 3) { $wrapmargin = ''; } else { $wrapmargin = ' widget3cmargin'; }

			$custom_fields = get_post_custom($post->ID); $customlink = '';
			if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
			if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }
            
            $height = $instance['fixed-height'];
            $output .= "<div class='widget3cwrap$wrapclass $wrapmargin' style='height: $height !important;'>";
				
				$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'tsmediumblock');
				$title = get_the_title();
  				$teaser = $instance['category-teaser']; if ($teaser == 0) { $kill_excerpt = 'on'; } else { $kill_excerpt = ''; }

				if ($image) {
						$unique_id = 'cat' . $this->number . $post->ID;
					$output .= "<div id='catbox-$unique_id' style='width:100%;'>";
					$output .= "<div id='photowrap-$unique_id' style='width:100%;overflow:hidden;'>";
					$output .= '<a href="' . $storylink . '#photo" title="'. $title .'"><img src="' . $image[0] . '" alt="' . $title . '" id="grow-' . $unique_id . '"style="width:100%;" /></a>';
					$output .= '</div>';
					$output .= '</div>';					
					$output .= '<div class="clear"></div>'; 
				} else if (get_option('teaser-kill') != 'on') {
					$teaser +=200;
				}
				$output .= "<div class='wa-textarea$unique_id'>";
				$output .= '<p>';
				$output .= '<a class="w3ctitle homeheadline" href="' . $storylink . '">' . $title . '</a>';
				$output .= '</p>';
           
				if ($instance['show-writer']=='on') { $byline = snowriter(); if ($byline) $output .= '<p class="writer">' . $byline . '</p>'; } 
  					
  				if (($instance['show-date']=='on') || ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on'))) { 
  					$output .= "<p class='datetime'>";
            
            			if ($instance['show-date']=='on') { $output .= get_sno_timestamp(); }
						if (($instance['show-date']=='on') && ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on'))) $output .= ' &bull; '; 
						if ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on')) { $output .= get_sno_comments_link(); } 

					$output .= '</p>'; 
  				} 

  				$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
  				if ($excerpt && $kill_excerpt != 'on') { 
  					$output .= '<p>' . $excerpt . '</p>'; 
  				} else if ($teaser) { 
  					$output .= get_the_content_limit($teaser, " <span class='readmore'>Read More &raquo;</span>");
  				}

  					if ( $instance['show-continue-nonfull'] == 'on' ) {
						$output .= "<div class='continue' style='padding-bottom:10px;$continue_location'><span class='continue-link'>";
							if ($instance['category-teaser'] != 0 ) {
								$continue_text = get_theme_mod('continue-text');
							} else {
								$continue_text = get_theme_mod('read-text');
							}
							if ($continue_text == '') $continue_text = "Continue Reading";
							$output .= $continue_text;
						$output .= '<span></div><div class="clear"></div>';

						$output .= "	
									<script type='text/javascript'>
										$(document).ready(function() {
											$('.wa-textarea$unique_id .continue').click(function() {
												window.location=$(this).parent().find('a').attr('href');
											});
										});
									</script>";
					}

			$output .= '</div>';
			$output .= '</div>';

						if (get_theme_mod('photo-animate') != 'Disable' && has_post_thumbnail()) {
							
								
							$output .= "<script type='text/javascript'>
								$(document).ready(function() {
   								 	$('#grow-$unique_id').mouseenter(function() {
   										$('#grow-$unique_id').removeClass('shrink');
   										$('#grow-$unique_id').removeClass('grow');
   										$('#grow-$unique_id').addClass('grow');
   									}).mouseleave(function() {
   										$('#grow-$unique_id').addClass('shrink');
  									});";
  							$image1 = $image[1];
  							$image2 = $image[2];
	  						if ($image1=='') $image1 = 300;						
	  						if ($image2=='') $image2 = 200;						
  							if (has_post_thumbnail()) { $output .= "
										var original_width = $image1;
										var original_height = $image2;
										var actual_width = $('#catbox-$unique_id').width();
										if (actual_width == 0) actual_width = original_width;
										var actual_height = (actual_width * original_height) / original_width;
										actual_height = Math.round(actual_height);
										$('#photowrap-$unique_id').css({ maxHeight: actual_height + 'px' });
										";
					
										}
							$output .= "});</script>";
						}
			
	        endwhile; else: endif; 
	        
	        if ($instance['view-all']=='on' && $instance['category'] != 0) {  
				$output .= "<div class='clear'></div><a href='$categoryslug' class='view-all-link'><div class='view-all-container'><span class='view-all-text view-all-category'>";
					$view_all_text = get_theme_mod('viewall-text');
					if ($view_all_text == '') $view_all_text = "View All";
					$view_all_text = str_replace('%category%', $categoryname, $view_all_text);
					$output .= $view_all_text;
					$output .= '</span></div></a><div class="clear"></div>';
			} 
		
		
		} else if (($instance['sidebarname'] == 'Home Main Column' ) && ($instance['number-headlines'] > 0) && ($instance['two-column'] == 'on')) { 
			
			$storydivider = $instance['number']+1;

			if (isset($_ENV['sno_exclude'])) foreach ($_ENV['sno_exclude'] as $key => $value) {
				$exclusionarray[] = $value;
			}
						
			if ($instance['category'] === '0') { 
				$uncategorized = '-'.get_theme_mod('breaking-hidecat'); $args = array ( 'cat' => $uncategorized.$exclude_category, 'showposts' => $totalstories, 'post__not_in' => $exclusionarray, 'offset' => $offset);
			} else {
				$args = array ( 'cat' => $instance['category'].$exclude_category, 'showposts' => $totalstories, 'post__not_in' => $exclusionarray, 'offset' => $offset);
			}
            query_posts( $args ); 
            if (have_posts()) : while (have_posts()) : the_post(); global $post; 
            $count++; 

				$custom_fields = get_post_custom($post->ID); $customlink = '';
				if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
				if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }

			if ($count == 1) {
				$output .= '<div class="catwidgetleft">';
				$exitkey = 4;
			}

			if ($count <= $instance['number']) {
			
			if (has_post_thumbnail()) { 
								
				$unique_id = 'cat' . $this->number . $post->ID; 
				$output .= "<div style='width:100%' id='catbox-$unique_id'>";
				$output .= "<div class='catboxthumbnail' id='photowrap-$unique_id' style='float:left; width:100%; margin-left:0px;margin-right: 0px;'>";
				$catimage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); 
					$output .= "<a href='" . $storylink . "#image'>";
						$catimage0 = $catimage[0];
						$output .= "<img src='$catimage0' id='grow-$unique_id' alt='" . get_the_title() . "'/>";
						$output .= '</a>';
						$output .= '</div>';
					
				$output .= '</div>';

					if ($instance['show-caption']=='on') {
						$imageid = get_post_meta($post->ID, '_thumbnail_id', true);
	   					$caption = get_post_field(post_excerpt, $imageid);	
						$output .= get_sno_photographer($wrap);								   						
	   					if ($caption) { 
	   						$output .= "<p class='photocaption' style='padding-bottom:8px !important'>$caption</p>"; 
	   					} 
					}
			}
			
			$output .= "<div class='wa-textarea$unique_id'>";

			$headlinesize = $instance['headline-size']; $headlineheight = floor($headlinesize * 1.5); 
			$output .= "<div class='widgetheadline'><a href='" . $storylink . "' class='homeheadline' style='font-size:".$headlinesize."px; line-height: 1.2em' rel='bookmark' title='Permanent Link to " . get_the_title() . "'>" . get_the_title() . "</a></div>";
            
            if ($instance['show-writer']=='on') { $byline = snowriter(); if ($byline) $output .= "<p class='writer'>$byline</p>"; } 

  				if (($instance['show-date']=='on') || ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on'))) { 
  					$output .= "<p class='datetime'>";
            
            			if ($instance['show-date']=='on') { $output .= get_sno_timestamp(); }
						if (($instance['show-date']=='on') && ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on'))) $output .= ' &bull; '; 
						if ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on')) { $output .= get_sno_comments_link(); } 

					$output .= '</p>'; 
  				} 


  			$teaser = $instance['category-teaser']; 
  			$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
  			if ($excerpt) { $output .= "<p>$excerpt</p>"; } 
  				else if ($teaser) { $output .= get_the_content_limit($teaser, ""); } 
 
   					if ( $instance['show-continue-nonfull'] == 'on' ) {
						$output .= "<div class='continue' style='padding-bottom:10px;$continue_location'><span class='continue-link'>";
							if ($instance['category-teaser'] != 0 ) {
								$continue_text = get_theme_mod('continue-text');
							} else {
								$continue_text = get_theme_mod('read-text');
							}
							if ($continue_text == '') $continue_text = "Continue Reading";
							$output .= $continue_text;
						$output .= '<span></div><div class="clear"></div>';

						$output .= "	
									<script type='text/javascript'>
										$(document).ready(function() {
											$('.wa-textarea$unique_id .continue').click(function() {
												window.location=$(this).parent().find('a').attr('href');
											});
										});
									</script>";
					}
 				
			$output .= '</div>';
			$output .= '<div class="storybottomnolineleft"></div>';   		
    		} else  {    		
	    		    		
				if (($count==$storydivider) && ($instance['headline-header'] == 'on')) { 
					$output .= "<a href='$categoryslug'><p class='sectionhead' style='font-size:14px;margin-bottom:7px;font-weight:normal;'>Recent $categoryname Stories</p></a>";
				}
				
				if ($instance['bullet-list']=="Bullet List") { 
					if ($exitkey != 5) { $output .= '<ul>'; $exitkey=5; }
                  	$output .= "<li class='catbullet'>";
			
					$output .= "<div class='widgetheadline'><a href='" . $storylink ."' class='homeheadline' style='font-size:".$headlinesize_teasers."px; line-height: 1.2em;' rel='bookmark' title='Permanent Link to " . get_the_title() . "'>" . get_the_title() . "</a></div>";
                  	if ($instance['teaser-date']=='on') { $output .= get_sno_timestamp(); }
                  	$output .= '</li>';
				} else {


                  	if($instance['teaser-thumb']=='on') { 
					  	
					  	$thumbplacement = $instance['teaser-thumb-placement'];
                  
					  	if (has_post_thumbnail()) {
						  	
							$catimage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium');
							
							$unique_id = 'cat' . $this->id . $post->ID;
							$output .= "<div style='width:100%;' id='catbox-$unique_id'>";
							$output .= "<div class='catboxthumbsmall' style='margin-$thumbplacement:0px;float: $thumbplacement;'>";

							if ($catimage[1] > $catimage[2]) { 
								$thumbstyle = " style='height:70px;min-height:70px;'";
							} else {
								$thumbstyle = " style='width:70px;min-width:70px;height: auto;'";
							} 
							
							$thumbstyle = ''; // temporarily blanking this to test new CSS
							
							$output .= "<a href='" . $storylink . "#continue'>";
							
							$catimage0 = $catimage[0];
							$output .= "<img src='$catimage0' id='grow-$unique_id' $thumbstyle alt='" . get_the_title() . "'/>";
						
							$output .= '</a>';
							$output .= '</div>'; 
							$output .= '</div>'; 
	
				  		}
					}

			
					$output .= "<div class='widgetheadline'><a href='" . $storylink ."' class='homeheadline' style='font-size:".$headlinesize_teasers."px; line-height: 1.2em;' rel='bookmark' title='Permanent Link to " . get_the_title() . "'>" . get_the_title() . "</a></div>";
                
					if ($instance['teaser-date']=='on') { $output .= "<p>" . get_sno_timestamp() . "</p>"; }
			
					$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
					$teaser_extra = $instance['headline-teaser']; 
		  			if ($excerpt) { $output .= "<p>$excerpt</p>"; } 
		  			else if ($teaser_extra != "0") { $output .= get_the_content_limit($teaser_extra, ""); } 
		 
		   			if ( $instance['show-continue-nonfull'] == 'on' ) {
						$output .= "<div class='continue' style='padding-bottom:10px;$continue_location'><span class='continue-link'>";
							if ($instance['category-teaser'] != 0 ) {
								$continue_text = get_theme_mod('continue-text');
							} else {
								$continue_text = get_theme_mod('read-text');
							}
							if ($continue_text == '') $continue_text = "Continue Reading";
							$output .= $continue_text;
							$output .= '<span></div><div class="clear"></div>';
		
							$output .= "	
								<script type='text/javascript'>
									$(document).ready(function() {
										$('.wa-textarea$unique_id .continue').click(function() {
											window.location=$(this).parent().find('a').attr('href');
										});
									});
								</script>";
					}
                
					$output .= "<div class='clear'></div><div style='margin-top:15px'></div>";
                }
    		    		
    		}
    		
    		if ($count == $instance['number']) {
	    		
	    		$dividingline = '';
	    		
    			if ($instance['dividing-line']=='on') { 
    			 	$thickness = $instance['dividing-line-thickness'];
    			 	$linetype = $instance['dividing-line-type'];
    				$dividingline = "style='border-top:$thickness $linetype #c0c0c0'";
    			}
    			$output .= "</div><div class='catwidgetright' $dividingline>";
    		}
						
						if (get_theme_mod('photo-animate') != 'Disable' && has_post_thumbnail()) {
							$output .= "<script type='text/javascript'>
								$(document).ready(function() {
   								 	$('#grow-$unique_id').mouseenter(function() {
   										$('#grow-$unique_id').removeClass('shrink');
   										$('#grow-$unique_id').removeClass('grow');
   										$('#grow-$unique_id').addClass('grow');
   									}).mouseleave(function() {
   										$('#grow-$unique_id').addClass('shrink');
  									});";
  								
  									if (has_post_thumbnail()) {
	  									$catimage1 = $catimage[1];
	  									$catimage2 = $catimage[2];
	  									if ($catimage1=='') $catimage1 = 300;						
	  									if ($catimage2=='') $catimage2 = 200;						
	  									$output .= "
											var original_width = $catimage1;
											var original_height = $catimage2;
											var actual_width = $('#catbox-$unique_id').width();
											if (actual_width == 0) actual_width = original_width;
											var actual_height = (actual_width * original_height) / original_width;
											actual_height = Math.round(actual_height);
											$('#photowrap-$unique_id').css({ maxHeight: actual_height + 'px' });
										";
					
									}
								$output .= "});</script>";
						}
						
        endwhile; else: endif; 
        
        
        if ($instance['view-all']=='on' && $instance['category'] != 0) { 
				$output .= "<div class='clear'></div><a href='$categoryslug' class='view-all-link'><div class='view-all-container'><span class='view-all-text view-all-category'>";
					$view_all_text = get_theme_mod('viewall-text');
					if ($view_all_text == '') $view_all_text = "View All";
					$view_all_text = str_replace('%category%', $categoryname, $view_all_text);
					$output .= $view_all_text;
					$output .= '</span></div></a><div class="clear"></div>';
		} 


        if ($exitkey == 4) $output .= '</div>';
        if ($exitkey == 5) $output .= '</ul></div>';


		} else {
						
		
			if((!is_int($totalstories)) || ($totalstories==0)) $totalstories=1; $storydivider = $instance['number']+1; $count=0;	

			if (isset($_ENV['sno_exclude'])) foreach ($_ENV['sno_exclude'] as $key => $value) {
				$exclusionarray[] = $value;
			}
			
			if ($instance['category'] === '0') { 
				
				$uncategorized = '-'.get_theme_mod('breaking-hidecat'); $args = array ( 'cat' => $uncategorized.$exclude_category, 'showposts' => $totalstories, 'post__not_in' => $exclusionarray, 'offset' => $offset);
			} else {
				$args = array ( 'cat' => $instance['category'], 'showposts' => $totalstories, 'post__not_in' => $exclusionarray, 'offset' => $offset);
			}

            query_posts( $args ); 
			if (have_posts()) : while (have_posts()) : the_post(); global $post; $count++; 

				$custom_fields = get_post_custom($post->ID); $customlink = '';
				if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
				if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }
			
            if ($count <= $instance['number']) {              
				if (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Bottom Wide")) { $photowidth = "100%"; $thumbnailsize="medium"; }
				else if (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Main Column")) { $photowidth = "50%"; $thumbnailsize="medium"; }
				else if ((($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Bottom Right")) || (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Bottom Left"))){ $photowidth = "100%"; $thumbnailsize="medium"; }
				else if (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Bottom Narrow")) { $photowidth = "100%"; $thumbnailsize="medium"; }
				else if ((($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Sidebar")) || (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Non-Home Sidebar")) || (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Sports Center Sidebar"))) { $photowidth = "100%"; $thumbnailsize="medium"; }
				
				else if ($instance['sidebarname'] == "Home Bottom Wide") { $photowidth = "33%"; $thumbnailsize="permalink"; } 
				else if ($instance['sidebarname'] == "Home Main Column") { $photowidth = "33%"; $thumbnailsize="permalink"; } 
				else if ($instance['sidebarname'] == "Home Bottom Narrow") { $photowidth = "100%"; $thumbnailsize="permalink"; } 
				else { $photowidth = "40%"; $thumbnailsize="medium"; } 
								
				if ($photowidth=="") { $photowidth = "100%"; $thumbnailsize="medium"; } 
				
				
				
				if (has_post_thumbnail()) { 
					
					$unique_id = 'cat' . $this->number . $post->ID; 
				
					$output .= "<div class='catboxthumbnail' id='photowrap-$unique_id' style='float:" . $instance['category-photo-placement'] . "; width:$photowidth; margin-" . $instance['category-photo-placement'] . ":0px;'>";
						
					if (has_post_thumbnail()) { 
						$catimage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium');
						$output .= "<div style='width:100%' id='catbox-$unique_id'>";
						$output .= "<a href='" . $storylink . "#photo'>";
							$catimage0 = $catimage[0];
							$output .= "<img src='$catimage0' style='width:100%' id='grow-$unique_id' alt='" . get_the_title() . "'/>";
							$output .= "</a>";
							$output .= "</div>";
					} 
						
					
						if ($instance['show-caption']=='on') {
							$imageid = get_post_meta($post->ID, '_thumbnail_id', true);
	   						$caption = get_post_field(post_excerpt, $imageid);
	   						$oldcaption = get_post_meta($post->ID, 'caption', true);
							
							$output .= get_sno_photographer($wrap);
								   						
	   						if ($caption) { 
	   							$output .= "<p class='photocaption' style='padding-bottom:8px !important'>$caption</p>"; 
	   						} else if ($oldcaption) { 
	   							$output .= "<p class='photocaption' style='padding-bottom:8px !important'>$oldcaption</p>";
	   						}

						}
				$output .= '</div>';
			
				}
				
			$headlinesize = $instance['headline-size']; $headlineheight = floor($headlinesize * 1.5);

			$output .= "<div class='wa-textarea$unique_id'>";
			
			$output .= "<div class='widgetheadline'><a href='" . $storylink ."' class='homeheadline' style='font-size:".$headlinesize."px; line-height:1.2em;' rel='bookmark' title='Permanent Link to " . get_the_title() . "'>" . get_the_title() . "</a></div>";
            
            if ($instance['show-writer']=='on') { $byline = snowriter(); if ($byline) $output .= "<p class='writer'>$byline</p>"; } 
  			
  				if (($instance['show-date']=='on') || ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on'))) { 
  					$output .= "<p class='datetime'>";
            
            			if ($instance['show-date']=='on') { $output .= get_sno_timestamp(); }
						if (($instance['show-date']=='on') && ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on'))) $output .= ' &bull; '; 
						if ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on')) { $output .= get_sno_comments_link(); } 

					$output .= '</p>'; 
  				} 

  			$teaser = $instance['category-teaser']; 
  			$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
  			
  			if ($excerpt) { 
	  			$output .= "<p>" . $excerpt . "</p>"; 
	  		} else if ($teaser) { 
		  		$output .= get_the_content_limit($teaser, "");  
		  	}
   					
   					if ( $instance['show-continue-nonfull'] == 'on' ) {
						$output .= "<div class='continue' style='padding-bottom:25px;$continue_location'><span class='continue-link'>";
							if ($instance['category-teaser'] != 0 ) {
								$continue_text = get_theme_mod('continue-text');
							} else {
								$continue_text = get_theme_mod('read-text');
							}
							if ($continue_text == '') $continue_text = "Continue Reading";
							$output .= $continue_text;
						$output .= '<span></div><div class="clear"></div>';
						$output .= "	
									<script type='text/javascript'>
										$(document).ready(function() {
											$('.wa-textarea$unique_id .continue').click(function() {
												window.location=$(this).parent().find('a').attr('href');
											});
										});
									</script>";
					}
			
			$output .= "</div>";
    		
	    	if (($count >= 1) && ($count < $totalstories) && ($totalstories!=1)) { 
		    	
	    		if ($instance['dividing-line']=='on') { 
		    		
		    		$output .= "<div style='border-bottom: " . $instance['dividing-line-thickness'] . " " . $instance['dividing-line-type'] . " #c0c0c0 !important;' class='storybottom'></div>"; 
			    } else { 
				    
				    $output .= "<div class='storybottomnoline'></div>";
				
				}
			}

            } else {

				if (($count==$storydivider) && ($instance['headline-header'] == 'on')) { 
						$output .= "<a href='$categoryslug'><p class='sectionhead' style='font-size:14px;margin-top:15px;margin-bottom:7px;font-weight:normal;'>Recent $categoryname Stories</p></a>";
				}

				if ($instance['bullet-list']=="Bullet List") { 
					if ($exitkey != 5) { $output .= '<ul>'; $exitkey=5; }
                  	$output .= "<li class='catbullet'><a class='homeheadline' style='font-size:".$headlinesize_teasers."px; line-height: 1.2em;' href='" . $storylink . "'>" . get_the_title() . "</a>";
                  	if ($instance['teaser-date']=='on') { $output .= get_sno_timestamp(); }
                  	$output .= "</li>";
				} else { 

            	    if($instance['teaser-thumb']=='on') { 
            	      	$thumbplacement=$instance['teaser-thumb-placement'];
                  
					  	if (has_post_thumbnail()) {
							$catimage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); 
							$unique_id = 'cat' . $this->number . $post->ID;
							$output .= "<div id='catbox-".$unique_id."' class='catboxthumbsmall' style='margin-" . $instance['teaser-thumb-placement'] . ":0px;float:" . $instance['teaser-thumb-placement'] . ";'>";
							$output .= "<a href='" . $storylink ."#photo'>";
								if ($catimage[1] > $catimage[2]) { 
									$thumbstyle = " style='height:70px;min-height:70px;'";
								} else {
									$thumbstyle = " style='width:70px;min-width:70px;height: auto;'";
								}
								
								$thumbstyle = ''; // temporarily blanking this to test new CSS
								$catimage0 = $catimage[0];
								$output .= "<img src='$catimage0' id='grow-$unique_id' $thumbstyle alt='" . get_the_title() . "' />";
							$output .= "</a>";
							$output .= "</div>"; 
						}

					}
                
					$output .= "<p><a class='homeheadline' style='font-size:".$headlinesize_teasers."px; line-height: 1.2em;' href='" . $storylink . "'>" . get_the_title() . "</a></p>";
                
					if ($instance['teaser-date']=='on') { $output .= "<p>" . get_sno_timestamp() . "</p>"; }

					$teaser = $instance['headline-teaser']; 
					if ($teaser) $output .= get_the_content_limit($teaser, " Read More &raquo;");
					$output .= "<div class='clear'></div><div style='margin-top:15px'></div>";
                 }
       		}        
						if (get_theme_mod('photo-animate') != 'Disable' && has_post_thumbnail()) {
							$output .= "<script type='text/javascript'>
								$(document).ready(function() {
   								 	$('#grow-$unique_id').mouseenter(function() {
   										$('#grow-$unique_id').removeClass('shrink');
   										$('#grow-$unique_id').removeClass('grow');
   										$('#grow-$unique_id').addClass('grow');
   									}).mouseleave(function() {
   										$('#grow-$unique_id').addClass('shrink');
  									});";
  									if (has_post_thumbnail() && $instance['sidebarname'] != 'Extra') {  
	  									$catimage1 = $catimage[1];
	  									$catimage2 = $catimage[2];
	  									if ($catimage1=='') $catimage1 = 300;						
	  									if ($catimage2=='') $catimage2 = 200;						
	  									$output .= "
										var original_width = $catimage1;
										var original_height = $catimage2;
										var actual_width = $('#catbox-$unique_id').width();
										if (actual_width == 0) actual_width = original_width;
										var actual_height = (actual_width * original_height) / original_width;
										actual_height = Math.round(actual_height);
										$('#photowrap-$unique_id').css({ maxHeight: actual_height + 'px' });";
					
									} 
								$output .= "});</script>";
						}

        endwhile; else: endif; 
        
        if (isset($exitkey) && $exitkey == 5) { $output .= "</ul>"; $exitkey = 0; }

        if ($instance['view-all']=='on' && $instance['category'] != 0) { 
				$output .= "<div class='clear'></div><a href='$categoryslug' class='view-all-link'><div class='view-all-container'><span class='view-all-text view-all-category'>";
					$view_all_text = get_theme_mod('viewall-text');
					if ($view_all_text == '') $view_all_text = "View All";
					$view_all_text = str_replace('%category%', $categoryname, $view_all_text);
					$output .= $view_all_text;
					$output .= '</span></div></a><div class="clear"></div>';
		}

	}
		$output .= "<div class='widget-expander' style='padding-bottom:" . $instance['widget-expander'] . "'></div><div class='clear'></div>";


		if ($instance['hide-title'] == 'on' || $instance['offset-title'] == 'on') {} else {

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

		$instance = $old_instance;
 		$instance['hide-title'] = ( isset( $new_instance['hide-title'] ) ? on : "" );  
 		$instance['offset-title'] = ( isset( $new_instance['offset-title'] ) ? on : "" );  
 		$instance['allow-vertical'] = ( isset( $new_instance['allow-vertical'] ) ? on : "" );  
		$instance['category-display-style'] = $new_instance['category-display-style'];
		$instance['number-full-width'] = $new_instance['number-full-width'];
		$instance['headline-size-full-width'] = $new_instance['headline-size-full-width'];
		$instance['category-teaser-full-width'] = $new_instance['category-teaser-full-width'];
		$instance['text-size-full-width'] = $new_instance['text-size-full-width'];
		$instance['main-photo-width'] = $new_instance['main-photo-width'];
		$instance['dominant-column-width'] = $new_instance['dominant-column-width'];
 		$instance['text-override'] = ( isset( $new_instance['text-override'] ) ? on : "" );  
		$instance['text-override-color'] = $new_instance['text-override-color'];
		$instance['text-background'] = $new_instance['text-background'];
		$instance['text-padding'] = $new_instance['text-padding'];
 		$instance['cat-above-title'] = ( isset( $new_instance['cat-above-title'] ) ? on : "" );  
 		$instance['full-show-writer'] = ( isset( $new_instance['full-show-writer'] ) ? on : "" );  
 		$instance['full-show-date'] = ( isset( $new_instance['full-show-date'] ) ? on : "" );  
		$instance['full-fixed-height'] = $new_instance['full-fixed-height'];
		$instance['text-height'] = $new_instance['text-height'];
 		$instance['outer-design'] = ( isset( $new_instance['outer-design'] ) ? on : "" );  
		$instance['outer-background-color'] = $new_instance['outer-background-color'];
		$instance['outer-border-color'] = $new_instance['outer-border-color'];
		$instance['outer-border-thickness'] = $new_instance['outer-border-thickness'];
		$instance['title-background-color'] = $new_instance['title-background-color'];
		$instance['title-text-color'] = $new_instance['title-text-color'];
		$instance['title-border-color'] = $new_instance['title-border-color'];
		$instance['title-border-thickness'] = $new_instance['title-border-thickness'];
		$instance['photo-position'] = $new_instance['photo-position'];
		$instance['photo-padding'] = $new_instance['photo-padding'];
 		$instance['photo-display'] = ( isset( $new_instance['photo-display'] ) ? on : "" );  
 		$instance['photo-overlay'] = ( isset( $new_instance['photo-overlay'] ) ? on : "" );  
		$instance['spacing'] = $new_instance['spacing'];
		$instance['center-title'] = $new_instance['center-title'];
		$instance['hide-shadow'] = $new_instance['hide-shadow'];

		$instance['title'] = $new_instance['title'];
		$instance['widget-style'] = $new_instance['widget-style'];
 		$instance['custom-colors'] = ( isset( $new_instance['custom-colors'] ) ? "snoccon" : "" );  
		$instance['header-color'] = $new_instance['header-color'];
		$instance['header-text'] = $new_instance['header-text'];
		$instance['widget-border'] = $new_instance['widget-border'];
		$instance['widget-background'] = $new_instance['widget-background'];
		$instance['border-thickness'] = $new_instance['border-thickness'];
		$instance['category'] = $new_instance['category'];
		$instance['number'] = $new_instance['number'];
		$instance['number3c'] = $new_instance['number3c'];
		$instance['number-headlines'] = $new_instance['number-headlines'];
		$instance['fixed-height'] = $new_instance['fixed-height'];
		$instance['category-photo-placement'] = $new_instance['category-photo-placement'];
		$instance['teaser-thumb-placement'] = $new_instance['teaser-thumb-placement'];
		$instance['category-photo-size'] = $new_instance['category-photo-size'];
		$instance['photowidth'] = $new_instance['photowidth'];
		$instance['sidebarname'] = $new_instance['sidebarname'];
		$instance['category-teaser'] = $new_instance['category-teaser'];
		$instance['headline-teaser'] = $new_instance['headline-teaser'];
		$instance['headline-size'] = $new_instance['headline-size'];
		$instance['headline-size-teasers'] = $new_instance['headline-size-teasers'];
 		$instance['show-writer'] = ( isset( $new_instance['show-writer'] ) ? on : "" );  
 		$instance['show-date'] = ( isset( $new_instance['show-date'] ) ? on : "" );  
 		$instance['show-comments'] = ( isset( $new_instance['show-comments'] ) ? on : "" );  
 		$instance['show-caption'] = ( isset( $new_instance['show-caption'] ) ? on : "" );  
 		$instance['view-all'] = ( isset( $new_instance['view-all'] ) ? on : "" );  
 		$instance['custom-view-all'] = ( isset( $new_instance['custom-view-all'] ) ? on : "" );  
 		$instance['teaser-thumb'] = ( isset( $new_instance['teaser-thumb'] ) ? on : "" );  
 		$instance['teaser-date'] = ( isset( $new_instance['teaser-date'] ) ? on : "" );  
 		$instance['dividing-line'] = ( isset( $new_instance['dividing-line'] ) ? on : "" );  
 		$instance['headline-header'] = ( isset( $new_instance['headline-header'] ) ? on : "" );  
 		$instance['two-column'] = ( isset( $new_instance['two-column'] ) ? on : "" );  
 		$instance['three-column'] = ( isset( $new_instance['three-column'] ) ? on : "" );  
 		$instance['text-area-center'] = ( isset( $new_instance['text-area-center'] ) ? on : "" );  
 		$instance['text-area-center-h'] = ( isset( $new_instance['text-area-center-h'] ) ? on : "" );  
 		$instance['text-area-center-t'] = ( isset( $new_instance['text-area-center-t'] ) ? on : "" );  
 		$instance['show-continue'] = ( isset( $new_instance['show-continue'] ) ? on : "" );  
 		$instance['show-continue-nonfull'] = ( isset( $new_instance['show-continue-nonfull'] ) ? on : "" );  
		$instance['bullet-list'] = $new_instance['bullet-list'];
		$instance['border-thickness2'] = $new_instance['border-thickness2'];
		$instance['widget-gradient'] = $new_instance['widget-gradient'];
		$instance['widget-padding'] = $new_instance['widget-padding'];
		$instance['widget-indent'] = $new_instance['widget-indent'];
		$instance['widget-pattern'] = $new_instance['widget-pattern'];
		$instance['dividing-line-type'] = $new_instance['dividing-line-type'];
		$instance['dividing-line-thickness'] = $new_instance['dividing-line-thickness'];
		$instance['custom-link'] = $new_instance['custom-link'];
		$instance['box1'] = $new_instance['box1'];
		$instance['box2'] = $new_instance['box2'];
		$instance['box3'] = $new_instance['box3'];
		$instance['widget-header-size'] = $new_instance['widget-header-size'];
		$instance['widget-expander'] = $new_instance['widget-expander'];
 		$instance['exclude'] = ( isset( $new_instance['exclude'] ) ? on : "" );  			//active
 		$instance['exclude-this'] = ( isset( $new_instance['exclude-this'] ) ? on : "" );  			//active
		$instance['exclude-cat'] = $new_instance['exclude-cat'];												//active
 		$instance['skip'] = ( isset( $new_instance['skip'] ) ? on : "" );  			//active
 		$instance['remove-bottom-margin'] = ( isset( $new_instance['remove-bottom-margin'] ) ? on : "" );  			//active
		$instance['offset'] = $new_instance['offset'];												//active
		$instance['exclude-number'] = $new_instance['exclude-number'];												//active
		$instance['text-area-padding'] = $new_instance['text-area-padding'];												//active
		$instance['story-separator'] = $new_instance['story-separator'];												//active
		return $instance;
	}

	function form($instance) { 
		$defaults = array( 'full-fixed-height' => '250', 'text-height' => '100', 'headline-size-full-width' => '18', 'headline-size-teasers' => '16', 'category-teaser-full-width' => '200', 'text-size-full-width' => '14', 'full-show-writer' => 'on', 'full-show-date' => 'on', 'text-background' => '#eeeeee', 'text-override-color' => '#000000', 'title-background-color' => get_theme_mod('reset-color1'), 'title-text-color' => get_theme_mod('reset-color1-text'), 'title-border-color' => '#000000', 'outer-background-color' => '#dddddd', 'outer-border-color' => '#cccccc', 'outer-border-thickness' => '1px', 'title-border-thickness' => '0px', 'photo-position' => 'Above Story', 'number-full-width' => '2', 'category-display-style' => '1 Column', 'category-teaser-full-width' => '400', 'main-photo-width' => '33', 'dominant-column-width' => '75', 'number' => '1', 'number-headlines' => '3', 'number3c' => '3', 'headline-size' => '18', 'category-photo-placement' => 'Left', 'category-photo-size' => 'Large', 'border-thickness' => '1px','category-teaser' => '170','headline-teaser' => '0', 'show-writer' => 'on', 'fixed-height' => '300', 'view-all' => 'on', 'show-date' => 'on', 'show-caption' => '', 'show-comments' => '', 'teaser-date' => 'on', 'teaser-thumb' => 'on', 'teaser-thumb-placement' => 'Left', 'widget-style'=>get_theme_mod('widget-style-sno'), 'bullet-list' => 'Teasers', 'header-color' => get_theme_mod('widgetcolor1'), 'header-text' => get_theme_mod('widgetcolor1-text'), 'widget-border' => '#aaaaaa', 'widget-background' => '#eeeeee', 'border-thickness' => '1px', 'border-thickness2' => '3px', 'widget-gradient' => 'On', 'widget-header-size' => 'Small', 'widget-expander' => '0px', 'photo-display' => 'on', 'photo-overlay' => 'on', 'spacing' => '10', 'hide-shadow' => 'Use Default', 'show-continue' => 'on', 'text-area-center' => 'on', 'text-area-center-h' => '', 'text-area-center-t' => '', 'text-area-padding' => '0', 'story-separator' => '0' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$random = mt_rand(); $disable_js = ''; $hide_all = '';
		$number = $this->number;
		
		$check = $this->number; $currentScreen = get_current_screen(); 


if ($check == '__i__' && $currentScreen->id === "widgets"){
	echo '<div id="not_saved">';
		?><script type="text/javascript">
			
			var initwidget = setInterval(function() {
				$('.widget-control-save').prop("disabled", false); // Saving is now enabled.
				$('.widget-control-save').val("Save"); 
				clearInterval(initwidget);		
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
		
		$widget_id = 'category-'.$number;
		$sidebartest = get_option('sidebars_widgets'); 
		
		$current_area = '';
		foreach($sidebartest as $area => $widgets) {
			if (is_array($widgets)) foreach($widgets as $widget) {
				if ( $widget === $widget_id ) $current_area = $area;	
			}
    	}	
    	

    		
		if (substr($current_area, -2) == '-2') {
			$sidebarname = 'Home Main Column';
		}
		if (substr($current_area, -3) == '-11') {
			$sidebarname = 'Full-Width';
		}
		
//		$widget_width = sno_get_widget_width($widget_id);
//		echo $widget_width;
?>
<?php 
	$hmc_wrap = ''; $hmc_class = ''; 
	if ($sidebarname == 'Home Main Column') {
		$hmc_wrap = " id='hmc_wrap$random'"; $hmc_class = 'hmc_wrap ';
	}	
	$hfw_wrap = ''; $hfw_class = '';
	if ($sidebarname == 'Full-Width') {
		$hfw_class = 'hfw_wrap ';
	}
	
?>

<div<?php echo $hmc_wrap; ?> class='<?php echo $hmc_class; ?> <?php echo $hfw_class; ?> hide_all'<?php echo $hide_all; ?>>

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
			Story Display Options
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody1-<?php echo $random; ?>" <?php echo $box1; ?>>


		Select a category<br />
			<?php wp_dropdown_categories(array('selected' => $instance['category'], 'name' => $this->get_field_name( 'category' ), 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'flex'), 'show_option_all' => __("All Posts", 'flex'), 'hide_empty' => '0' )); ?><br /><br />
			
			<div class="widgetdivider"></div>

				<p><input type="checkbox" <?php if ($instance['exclude-this'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'exclude-this' ); ?>" name="<?php echo $this->get_field_name( 'exclude-this' ); ?>" /><label for="<?php echo $this->get_field_id('exclude-this'); ?>">Exclude stories in this widget from all other widgets loaded after this one</label></p>

				<p><input class="exclude<?php echo $random; ?>" type="checkbox" <?php if ($instance['exclude'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'exclude' ); ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" /><label for="<?php echo $this->get_field_id('exclude'); ?>">Exclude a category from this widget</label></p>
				<div class="exclusionoption<?php echo $random; ?>">
					<b>Select a category to exclude</b><br />
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
			
		

		<?php $categorytitle = cat_id_to_name($instance['category']); ?><input type="hidden" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $categorytitle; ?>" />
		
		
		

				<p><input class="hidetitle<?php echo $random; ?>" type="checkbox" <?php if ($instance['hide-title'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'hide-title' ); ?>" name="<?php echo $this->get_field_name( 'hide-title' ); ?>" /><label for="<?php echo $this->get_field_id('hide-title'); ?>">Hide widget header, border, and background</label></p>

			<span class='full_width_area_options'>

				<p><input class="offsettitle<?php echo $random; ?>" type="checkbox" <?php if ($instance['offset-title'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'offset-title' ); ?>" name="<?php echo $this->get_field_name( 'offset-title' ); ?>" /><label for="<?php echo $this->get_field_id('offset-title'); ?>">Display Offset Widget Title</label></p>

				<p>
					
		<div class="widgetdivider"></div>
		
			<p>
				<select id="<?php echo $this->get_field_id('number-full-width'); ?>" name="<?php echo $this->get_field_name('number-full-width'); ?>">
					<?php for ($i = 1; $i <= 6; $i++) { 
						echo "<option value='$i'";
						if ($i == $instance['number-full-width']) echo ' selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id('number-full-width'); ?>"><?php _e('Number of Stories'); ?></label>
			</p>

		<div class="widgetdivider"></div>

				<select class="displaycontrol<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'category-display-style' ); ?>" name="<?php echo $this->get_field_name( 'category-display-style' ); ?>">
					<option value="1 Column" <?php if ( '1 Column' == $instance['category-display-style'] ) echo 'selected="selected"'; ?>>1 Column</option>
					<option value="2 Column" <?php if ( '2 Column' == $instance['category-display-style'] ) echo 'selected="selected"'; ?>>2 Column</option>
					<option value="2 Column Dominant" <?php if ( '2 Column Dominant' == $instance['category-display-style'] ) echo 'selected="selected"'; ?>>2 Column Dominant</option>
					<option value="3 Column" <?php if ( '3 Column' == $instance['category-display-style'] ) echo 'selected="selected"'; ?>>3 Column</option>
				</select> Format
				</p>
			
				<p>
				<span class="c2d-show<?php echo $random; ?> c1-hide<?php echo $random; ?> c2-hide<?php echo $random; ?> c3-hide<?php echo $random; ?>">
				<select id="<?php echo $this->get_field_id( 'dominant-column-width' ); ?>" name="<?php echo $this->get_field_name( 'dominant-column-width' ); ?>">
					<option value="50" <?php if ( '50' == $instance['dominant-column-width'] ) echo 'selected="selected"'; ?>>50%</option>
					<option value="66" <?php if ( '66' == $instance['dominant-column-width'] ) echo 'selected="selected"'; ?>>66%</option>
					<option value="75" <?php if ( '75' == $instance['dominant-column-width'] ) echo 'selected="selected"'; ?>>75%</option>
					<option value="80" <?php if ( '80' == $instance['dominant-column-width'] ) echo 'selected="selected"'; ?>>80%</option>
				</select> Dominant Column Width
				<br />
				</span>
			<span class="c2d-hide<?php echo $random; ?> c1-show<?php echo $random; ?> c2-hide<?php echo $random; ?> c3-hide<?php echo $random; ?>">
				<select id="<?php echo $this->get_field_id( 'main-photo-width' ); ?>" name="<?php echo $this->get_field_name( 'main-photo-width' ); ?>">
					<option value="25" <?php if ( '25' == $instance['main-photo-width'] ) echo 'selected="selected"'; ?>>25%</option>
					<option value="33" <?php if ( '33' == $instance['main-photo-width'] ) echo 'selected="selected"'; ?>>33%</option>
					<option value="50" <?php if ( '50' == $instance['main-photo-width'] ) echo 'selected="selected"'; ?>>50%</option>
					<option value="66" <?php if ( '66' == $instance['main-photo-width'] ) echo 'selected="selected"'; ?>>66%</option>
				</select> Main Photo Width
			<br />
			</span>
				<select id="<?php echo $this->get_field_id('full-fixed-height'); ?>" name="<?php echo $this->get_field_name('full-fixed-height'); ?>">
					<?php 
						for ($i = 100; $i <= 500; $i+=25) { 
							echo "<option value='$i'";
							if ($i == $instance['full-fixed-height']) echo ' selected="selected"';
							$height = $i . 'px';
							echo ">$height</option>";
						} 
					?>
				</select>
				<label for="<?php echo $this->get_field_id('full-fixed-height'); ?>"><?php _e('Photo Area Height'); ?></label>

			<br />
			<span class="c2d-show<?php echo $random; ?> c1-hide<?php echo $random; ?> c2-show<?php echo $random; ?> c3-show<?php echo $random; ?>">
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
			<span class="c2d-show<?php echo $random; ?> c1-hide<?php echo $random; ?> c2-hide<?php echo $random; ?> c3-hide<?php echo $random; ?>">
			<p>
				<input class="checkbox" type="checkbox" <?php if ($instance['photo-display'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'photo-display' ); ?>" name="<?php echo $this->get_field_name( 'photo-display' ); ?>" /><label for="<?php echo $this->get_field_id( 'photo-display' ); ?>"> Hide 2nd Column Photos</label>			
				
			</p>
			<p>
				<input type="checkbox" <?php if ($instance['photo-overlay'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'photo-overlay' ); ?>" name="<?php echo $this->get_field_name( 'photo-overlay' ); ?>" /><label for="<?php echo $this->get_field_id( 'photo-overlay' ); ?>"> Text over Photo (first column)</label>			
				
			</p>
			</span>
			<span class="c2d-hide<?php echo $random; ?> c1-hide<?php echo $random; ?> c2-show<?php echo $random; ?> c3-hide<?php echo $random; ?>">
			<p>
				<select id="<?php echo $this->get_field_id( 'photo-position' ); ?>" name="<?php echo $this->get_field_name( 'photo-position' ); ?>">
					<option value="Above Story" <?php if ( 'Above Story' == $instance['photo-position'] ) echo 'selected="selected"'; ?>>Above Story</option>
					<option value="Beside Story" <?php if ( 'Beside Story' == $instance['photo-position'] ) echo 'selected="selected"'; ?>>Beside Story</option>
				</select>
				
			 Photo Position</p>
			</span>
			
			<span class="c2d-show<?php echo $random; ?> c1-hide<?php echo $random; ?> c2-show<?php echo $random; ?> c3-show<?php echo $random; ?>">
			<p>
				<input class="checkbox" type="checkbox" <?php if ($instance['photo-padding'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'photo-padding' ); ?>" name="<?php echo $this->get_field_name( 'photo-padding' ); ?>" /><label for="<?php echo $this->get_field_id( 'photo-padding' ); ?>"> Remove Photo Padding</label>			
			</p>
			</span>
			<span class="allowvert<?php echo $random; ?> c2d-hide<?php echo $random; ?> c1-show<?php echo $random; ?> c2-hide<?php echo $random; ?> c3-hide<?php echo $random; ?>">
			<p>
				<input class="checkbox" type="checkbox" <?php if ($instance['allow-vertical'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'allow-vertical' ); ?>" name="<?php echo $this->get_field_name( 'allow-vertical' ); ?>" /><label for="<?php echo $this->get_field_id('allow-vertical'); ?>"> Allow Vertical Photos</label>
			</p>
			<p><i><b>NOTE:</b> Using vertical photos in the full-width widget area will result in inconsistent spacing and blank white space.</i></p>
			</span>
			<div class="widgetdivider"></div>

			<p>
				<select id="<?php echo $this->get_field_id( 'headline-size-full-width' ); ?>" name="<?php echo $this->get_field_name( 'headline-size-full-width' ); ?>">
					<?php for ($i=14; $i <= 48; $i+=2) {
						echo "<option value='$i' ";
						if ($instance['headline-size-full-width'] == $i) echo 'selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id( 'headline-size-full-width' ); ?>">Headline Size</label>
			</p>
			
			<p>
				<input id="<?php echo $this->get_field_id('category-teaser-full-width'); ?>" name="<?php echo $this->get_field_name('category-teaser-full-width'); ?>" type="text" maxlength="3" size="3" value="<?php echo $instance['category-teaser-full-width']; ?>" />
				<label for="<?php echo $this->get_field_id('category-teaser-full-width'); ?>">Teaser Length (characters)</label>
			</p>
			<p>
				<select id="<?php echo $this->get_field_id( 'text-size-full-width' ); ?>" name="<?php echo $this->get_field_name( 'text-size-full-width' ); ?>">
					<?php for ($i=10; $i <= 24; $i+=1) {
						echo "<option value='$i' ";
						if ($instance['text-size-full-width'] == $i) echo 'selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id( 'text-size-full-width' ); ?>">Teaser Text Size</label>
			</p>
			<p class="c1-show<?php echo $random; ?> c2-hide<?php echo $random; ?> c3-hide<?php echo $random; ?> c2d-hide<?php echo $random; ?>">
				<select id="<?php echo $this->get_field_id( 'text-area-padding' ); ?>" name="<?php echo $this->get_field_name( 'text-area-padding' ); ?>">
					<?php for ($i=0; $i <= 100; $i+=10) {
						echo "<option value='$i' ";
						if ($instance['text-area-padding'] == $i) echo 'selected="selected"';
						echo ">$i px</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id( 'text-area-padding' ); ?>">Teaser Side Padding</label>
			</p>
			<p class="c1-show<?php echo $random; ?> c2-hide<?php echo $random; ?> c3-hide<?php echo $random; ?> c2d-hide<?php echo $random; ?>">
				<select id="<?php echo $this->get_field_id( 'story-separator' ); ?>" name="<?php echo $this->get_field_name( 'story-separator' ); ?>">
					<?php for ($i=20; $i <= 100; $i+=10) {
						echo "<option value='$i' ";
						if ($instance['story-separator'] == $i) echo 'selected="selected"';
						echo ">$i px</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id( 'story-separator' ); ?>">Space between stories</label>
			</p>

			<span class="c2d-hide<?php echo $random; ?> c1-show<?php echo $random; ?> c2-show<?php echo $random; ?> c3-show<?php echo $random; ?>">
				<input class="checkbox" type="checkbox" <?php if ($instance['text-area-center'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'text-area-center' ); ?>" name="<?php echo $this->get_field_name( 'text-area-center' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'text-area-center' ); ?>">Center Text Vertically</label>			
			<br />
				<input class="checkbox" type="checkbox" <?php if ($instance['text-area-center-h'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'text-area-center-h' ); ?>" name="<?php echo $this->get_field_name( 'text-area-center-h' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'text-area-center-h' ); ?>">Center Headline/Byline</label>			
			<br />
				<input class="checkbox" type="checkbox" <?php if ($instance['text-area-center-t'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'text-area-center-t' ); ?>" name="<?php echo $this->get_field_name( 'text-area-center-t' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'text-area-center-t' ); ?>">Center Teaser</label>			
			<br />
			</span>

				<input class="checkbox" type="checkbox" <?php if ($instance['full-show-writer'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'full-show-writer' ); ?>" name="<?php echo $this->get_field_name( 'full-show-writer' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'full-show-writer' ); ?>">Show Byline</label>			
				<br />

				<input class="checkbox" type="checkbox" <?php if ($instance['full-show-date'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'full-show-date' ); ?>" name="<?php echo $this->get_field_name( 'full-show-date' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'full-show-date' ); ?>">Show Date</label>			
				<br />

				<input class="checkbox" type="checkbox" <?php if ($instance['cat-above-title'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'cat-above-title' ); ?>" name="<?php echo $this->get_field_name( 'cat-above-title' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'cat-above-title' ); ?>">Show Category Name</label>	
				<br />		

				<input class="checkbox" type="checkbox" <?php if ($instance['show-continue'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-continue' ); ?>" name="<?php echo $this->get_field_name( 'show-continue' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show-continue' ); ?>">Show Read More Link</label>	
				<br /><br />		


			<div class="widgetdivider"></div>

			<p>
				<select class="textcontrol<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'text-padding' ); ?>" name="<?php echo $this->get_field_name( 'text-padding' ); ?>">
					<option value="Off" <?php if ( 'Off' == $instance['text-padding'] ) echo 'selected="selected"'; ?>>Off</option>
					<option value="On" <?php if ( 'On' == $instance['text-padding'] ) echo 'selected="selected"'; ?>>On</option>
				</select>
				
			 Story Panel Padding & Customization</p>
			 
			 <span class="textoptions<?php echo $random; ?>">
			 	<span class="c2d-show<?php echo $random; ?> c1-hide<?php echo $random; ?> c2-show<?php echo $random; ?> c3-show<?php echo $random; ?>">
			 	<p>
				<select id="<?php echo $this->get_field_id('spacing'); ?>" name="<?php echo $this->get_field_name('spacing'); ?>">
					<?php for ($i = 0; $i <= 15; $i++) { 
						echo "<option value='$i'";
						if ($i == $instance['spacing']) echo ' selected="selected"';
						echo ">$i px</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Spacing between panels'); ?></label>
				</p>
			 	</span>

				<label style="display:block" for="<?php echo $this->get_field_id('text-background'); ?>">Text Area Background</label>
				<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('text-background'); ?>" name="<?php echo $this->get_field_name('text-background'); ?>" value="<?php echo $instance['text-background']; ?>" /><br /><br />

				<input class="checkbox textoverride<?php echo $random; ?>" type="checkbox" <?php if ($instance['text-override'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'text-override' ); ?>" name="<?php echo $this->get_field_name( 'text-override' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'text-override' ); ?>">Activate Text Color Override</label>			
		
				<br /><br />

				<div class="textoverrideoption<?php echo $random; ?>">
				Text Override Color<br /><input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('text-override-color'); ?>" name="<?php echo $this->get_field_name('text-override-color'); ?>" value="<?php echo $instance['text-override-color']; ?>" />
				<br /><br />
				</div>
			 </span>
			<div class="widgetdivider"></div>

			<p>
				<input class="outerdesigncontrol<?php echo $random; ?>" type="checkbox" <?php if ($instance['outer-design'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'outer-design' ); ?>" name="<?php echo $this->get_field_name( 'outer-design' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'outer-design' ); ?>">Activate Outer Design</label>			
			</p>
				
			<span class="outerdesignoptions<?php echo $random; ?>">

				Title Background Color<br /><input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('title-background-color'); ?>" name="<?php echo $this->get_field_name('title-background-color'); ?>" value="<?php echo $instance['title-background-color']; ?>" />
				<br />

				Title Text Color<br /><input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('title-text-color'); ?>" name="<?php echo $this->get_field_name('title-text-color'); ?>" value="<?php echo $instance['title-text-color']; ?>" />
				<br />


				Title Border Color<br /><input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('title-border-color'); ?>" name="<?php echo $this->get_field_name('title-border-color'); ?>" value="<?php echo $instance['title-border-color']; ?>" />
				<br />
				
				Outer Background Color<br /><input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('outer-background-color'); ?>" name="<?php echo $this->get_field_name('outer-background-color'); ?>" value="<?php echo $instance['outer-background-color']; ?>" />
				<br />

				Outer Border Color<br /><input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('outer-border-color'); ?>" name="<?php echo $this->get_field_name('outer-border-color'); ?>" value="<?php echo $instance['outer-border-color']; ?>" />
				<br />

			<select id="<?php echo $this->get_field_id( 'outer-border-thickness' ); ?>" name="<?php echo $this->get_field_name( 'outer-border-thickness' ); ?>">
				<?php for ($i=0; $i <= 10; $i++) {
					$width = $i . 'px';
					echo "<option value='$width' ";
					if ($instance['outer-border-thickness'] == $width) echo 'selected="selected"';
					echo ">$width</option>";
				} ?>
			</select>
			<label for="<?php echo $this->get_field_id( 'outer-border-thickness' ); ?>"> Outer Border Thickness</label><br /><br />

			<select id="<?php echo $this->get_field_id( 'title-border-thickness' ); ?>" name="<?php echo $this->get_field_name( 'title-border-thickness' ); ?>">
				<?php for ($i=0; $i <= 10; $i++) {
					$width = $i . 'px';
					echo "<option value='$width' ";
					if ($instance['title-border-thickness'] == $width) echo 'selected="selected"';
					echo ">$width</option>";
				} ?>
			</select>
			<label for="<?php echo $this->get_field_id( 'title-border-thickness' ); ?>"> Title Border Thickness</label>
			</span>


			</span>
			<span class='non_full_width_area_options'>

			<span class='widewidgetarea'>
			<br />
			<input class="threecolumnmoved<?php echo $random; ?> threecolumncheckbox<?php echo $random; ?>" type="checkbox" <?php if ($instance['three-column'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'three-column' ); ?>" name="<?php echo $this->get_field_name( 'three-column' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'three-column' ); ?>"> Three Column Format</label>
			<br />
			</span>
			<br />
				
		<div class="widgetdivider"></div>

			<span class="threecolumn<?php echo $random; ?>">

			<p>
				<select id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>">
					<?php for ($i = 0; $i <= 14; $i++) { 
						echo "<option value='$i'";
						if ($i == $instance['number']) echo ' selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Stories'); ?></label>
			</p>

			<div class="widgetdivider"></div>

			</span>
			
			<span class="threecolumnhide<?php echo $random; ?>">
			<?php if ($disable_js == 'on') { echo '<div id="th">'; } ?>
			<p>
				<select id="<?php echo $this->get_field_id('number3c'); ?>" name="<?php echo $this->get_field_name('number3c'); ?>">
					<?php for ($i = 3; $i <= 12; $i+=3) { 
						echo "<option value='$i'";
						if ($i == $instance['number3c']) echo ' selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Stories'); ?></label>
			</p>

			<div class="widgetdivider"></div>

			<p>
				<select id="<?php echo $this->get_field_id('fixed-height'); ?>" name="<?php echo $this->get_field_name('fixed-height'); ?>">
					<?php for ($i = 150; $i <= 350; $i+=25) { 
						$height = $i . 'px';
						echo "<option value='$height'";
						if ($height == $instance['fixed-height']) echo ' selected="selected"';
						echo ">$height</option>";
					} ?>
				
				</select>
				<label for="<?php echo $this->get_field_id('fixed-height'); ?>"><?php _e('Fixed Story Height'); ?></label>
			</p>
		
			<div class="widgetdivider"></div>

			<?php if ($disable_js == 'on') { echo '</div>'; } ?>

			</span>
			
			<span class="threecolumn<?php echo $random; ?>">

				<select id="<?php echo $this->get_field_id( 'category-photo-placement' ); ?>" name="<?php echo $this->get_field_name( 'category-photo-placement' ); ?>">
					<option value="Left" <?php if ( 'Left' == $instance['category-photo-placement'] ) echo 'selected="selected"'; ?>>Left</option>
					<option value="Right" <?php if ( 'Right' == $instance['category-photo-placement'] ) echo 'selected="selected"'; ?>>Right</option>
				</select>
				<select id="<?php echo $this->get_field_id( 'category-photo-size' ); ?>" name="<?php echo $this->get_field_name( 'category-photo-size' ); ?>">
					<option value="Small" <?php if ( 'Small' == $instance['category-photo-size'] ) echo 'selected="selected"'; ?>>Small</option>
					<option value="Large" <?php if ( 'Large' == $instance['category-photo-size'] ) echo 'selected="selected"'; ?>>Large</option>
				</select>
				<label for="<?php echo $this->get_field_id( 'category-photo-size' ); ?>">Photos</label>
			
			<br /><br />
			</span>
		<div class="widgetdivider threecolumn<?php echo $random; ?>"></div>

			<span class="threecolumn<?php echo $random; ?>">
				<select id="<?php echo $this->get_field_id( 'headline-size' ); ?>" name="<?php echo $this->get_field_name( 'headline-size' ); ?>">
					<?php for ($i=14; $i <= 26; $i+=2) {
						echo "<option value='$i' ";
						if ($instance['headline-size'] == $i) echo 'selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id( 'headline-size' ); ?>">Headline Size</label>
			<br /><br />
			</span>
		<div class="widgetdivider threecolumn<?php echo $random; ?>"></div>
		
			<p>
				<input id="<?php echo $this->get_field_id('category-teaser'); ?>" name="<?php echo $this->get_field_name('category-teaser'); ?>" type="text" maxlength="3" size="3" value="<?php echo $instance['category-teaser']; ?>" />
				<label for="<?php echo $this->get_field_id('category-teaser'); ?>">Teaser Length (characters)</label>
			</p>

			
		<div class="widgetdivider"></div>
		

			<input class="checkbox" type="checkbox" <?php if ($instance['show-writer'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-writer' ); ?>" name="<?php echo $this->get_field_name( 'show-writer' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-writer' ); ?>">Show Byline</label>			
		
		<br />

			<input class="checkbox" type="checkbox" <?php if ($instance['show-date'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-date' ); ?>" name="<?php echo $this->get_field_name( 'show-date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-date' ); ?>">Show Date</label>			
		
		<br />
		
			<input class="checkbox" type="checkbox" <?php if ($instance['show-comments'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-comments' ); ?>" name="<?php echo $this->get_field_name( 'show-comments' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-comments' ); ?>">Show Comments Link</label>			

		<br />
		
				<input class="checkbox" type="checkbox" <?php if ($instance['show-continue-nonfull'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-continue-nonfull' ); ?>" name="<?php echo $this->get_field_name( 'show-continue-nonfull' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show-continue-nonfull' ); ?>">Show Read More Link</label>	
		<br />		

		<span class="threecolumn<?php echo $random; ?>">

			<input class="checkbox" type="checkbox" <?php if ($instance['show-caption'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-caption' ); ?>" name="<?php echo $this->get_field_name( 'show-caption' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-caption' ); ?>">Show Caption</label>			
		
		<br />
		
			<input class="checkbox<?php echo $random; ?>" type="checkbox" <?php if ($instance['dividing-line'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'dividing-line' ); ?>" name="<?php echo $this->get_field_name( 'dividing-line' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'dividing-line' ); ?>"> Show Dividing Lines</label>

		<br />
				

		<div class="dividinglines<?php echo $random; ?>">
		<br />

		<div class="widgetdivider"></div>

				<select id="<?php echo $this->get_field_id( 'dividing-line-type' ); ?>" name="<?php echo $this->get_field_name( 'dividing-line-type' ); ?>">
					<option value="solid" <?php if ( 'solid' == $instance['dividing-line-type'] ) echo 'selected="selected"'; ?>>Solid</option>
					<option value="dotted" <?php if ( 'dotted' == $instance['dividing-line-type'] ) echo 'selected="selected"'; ?>>Dotted</option>
					<option value="dashed" <?php if ( 'dashed' == $instance['dividing-line-type'] ) echo 'selected="selected"'; ?>>Dashed</option>
				</select>
				<select id="<?php echo $this->get_field_id( 'dividing-line-thickness' ); ?>" name="<?php echo $this->get_field_name( 'dividing-line-thickness' ); ?>">
					<option value="1px" <?php if ( '1px' == $instance['dividing-line-thickness'] ) echo 'selected="selected"'; ?>>1px</option>
					<option value="2px" <?php if ( '2px' == $instance['dividing-line-thickness'] ) echo 'selected="selected"'; ?>>2px</option>
					<option value="3px" <?php if ( '3px' == $instance['dividing-line-thickness'] ) echo 'selected="selected"'; ?>>3px</option>
					<option value="4px" <?php if ( '4px' == $instance['dividing-line-thickness'] ) echo 'selected="selected"'; ?>>4px</option>
					<option value="5px" <?php if ( '5px' == $instance['dividing-line-thickness'] ) echo 'selected="selected"'; ?>>5px</option>
				</select>
				<label for="<?php echo $this->get_field_id( 'dividing-line-thickness' ); ?>"> Line Style</label>
				<br />

		</div>
		<br />
		</span>
			</span>
		<br />

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

		<div class="widgetsection widgetsection2" id="widgetsection2-<?php echo $random; ?>">
			<div class="expand" id="expand2-<?php echo $random; ?>" <?php echo $expand2; ?>></div><div class="collapse" id="collapse2-<?php echo $random; ?>" <?php echo $collapse2; ?>></div>
			Extra Headlines
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody2-<?php echo $random; ?>" <?php echo $box2; ?>>

		<span class="threecolumn<?php echo $random; ?>">
			
			<span class='widewidgetarea'>
			<input class="checkbox" type="checkbox" <?php if ($instance['two-column'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'two-column' ); ?>" name="<?php echo $this->get_field_name( 'two-column' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'two-column' ); ?>"> Show as Second Column</label>
			<br />
			</span>


			<input class="checkbox" type="checkbox" <?php if ($instance['headline-header'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'headline-header' ); ?>" name="<?php echo $this->get_field_name( 'headline-header' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'headline-header' ); ?>"> Show Recent Headlines Label</label><br />

			<input class="checkbox" type="checkbox" <?php if ($instance['teaser-date'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'teaser-date' ); ?>" name="<?php echo $this->get_field_name( 'teaser-date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'teaser-date' ); ?>"> Show Dates</label>
			<br /><br />
			
			<div class="widgetdivider"></div>
			<p>
				<select id="<?php echo $this->get_field_id('number-headlines'); ?>" name="<?php echo $this->get_field_name('number-headlines'); ?>">
					<?php for ($i = 0; $i <= 14; $i++) { 
						echo "<option value='$i'";
						if ($i == $instance['number-headlines']) echo ' selected="selected"';
						echo ">$i</option>";
					} ?>
				
				</select>
				<label for="<?php echo $this->get_field_id('number-headlines'); ?>"><?php _e('Number of Extra Headlines'); ?></label>
			</p>

			<div class="widgetdivider"></div>

				<select id="<?php echo $this->get_field_id( 'headline-size-teasers' ); ?>" name="<?php echo $this->get_field_name( 'headline-size-teasers' ); ?>">
					<?php for ($i=12; $i <= 26; $i+=2) {
						echo "<option value='$i' ";
						if ($instance['headline-size-teasers'] == $i) echo 'selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id( 'headline-size-teasers' ); ?>">Headline Size</label>
			<br /><br />
			<div class="widgetdivider"></div>


			<p>
			<select class="displaystyle<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'bullet-list' ); ?>" name="<?php echo $this->get_field_name( 'bullet-list' ); ?>">
				<option style="padding-right:10px;" value="Bullet List" <?php if ( 'Bullet List' == $instance['bullet-list'] ) echo 'selected="selected"'; ?>>Bullet List</option>
				<option style="padding-right:10px;" value="Teasers" <?php if ( 'Teasers' == $instance['bullet-list'] ) echo 'selected="selected"'; ?>>Teasers</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'bullet-list' ); ?>"> Display Style</label><br />
			</p>
			


		<div class="displayoptions<?php echo $random; ?>">

			<div class="widgetdivider"></div>

			<p>
			<input id="<?php echo $this->get_field_id('headline-teaser'); ?>" name="<?php echo $this->get_field_name('headline-teaser'); ?>" type="text" maxlength="3" size="3" value="<?php echo $instance['headline-teaser']; ?>" />
			<label for="<?php echo $this->get_field_id('headline-teaser'); ?>">Teaser Length (characters)</label>
			</p>
			
			<p>
			<input class="teaserselect<?php echo $random; ?>" type="checkbox" <?php if ($instance['teaser-thumb'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'teaser-thumb' ); ?>" name="<?php echo $this->get_field_name( 'teaser-thumb' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'teaser-thumb' ); ?>"> Show Thumbnails</label><br />
			</p>
			<div class="teaseroptions<?php echo $random; ?>">
			<select id="<?php echo $this->get_field_id( 'teaser-thumb-placement' ); ?>" name="<?php echo $this->get_field_name( 'teaser-thumb-placement' ); ?>">
				<option value="left" <?php if ( 'left' == $instance['teaser-thumb-placement'] ) echo 'selected="selected"'; ?>>Left</option>
				<option value="right" <?php if ( 'right' == $instance['teaser-thumb-placement'] ) echo 'selected="selected"'; ?>>Right</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'teaser-thumb-placement' ); ?>">Thumbnail Placement</label><br /><br />
			</div>



		</div>

		<div class="widgetdivider"></div>
		</span>
	
		<div class="clear"></div>
		

		</div>
		
		<div class="widgetsection" id="widgetsection3-<?php echo $random; ?>">
			<div class="expand" id="expand3-<?php echo $random; ?>" <?php echo $expand3; ?>></div><div class="collapse" id="collapse3-<?php echo $random; ?>" <?php echo $collapse3; ?>></div>
			Widget Appearance
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody3-<?php echo $random; ?>" <?php echo $box3; ?>>
		
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
			<select class="widgetstyle<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'widget-expander' ); ?>" name="<?php echo $this->get_field_name( 'widget-expander' ); ?>">
				<?php for ($i=0; $i<101; $i++) { ?>
					<?php $height = $i . 'px'; ?>
					<option value="<?php echo $height; ?>" <?php if ( $instance['widget-expander'] == $height ) echo 'selected="selected"'; ?>><?php echo $height; ?></option>
				<?php } ?>
			</select> Extend Widget Height
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
		<div class="widgetdivider"></div>

			

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
		
	<?php 
		$wid = array(); 
		$wid[0] = $this->number;
		$wid[1] = $this->get_field_id('box1'); 
		$wid[2] = $this->get_field_id('box2'); 
		$wid[3] = $this->get_field_id('box3'); 
	//	sno_widget_toggles($wid, $boxes=3, $random);
		sno_widget_interface_styles(); 
	?>
	</div>
		<div class="widgetdivider"></div>

			<p><input class="checkbox" type="checkbox" <?php if ($instance['remove-bottom-margin'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'remove-bottom-margin' ); ?>" name="<?php echo $this->get_field_name( 'remove-bottom-margin' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'remove-bottom-margin' ); ?>">Remove Bottom Margin</label></p>

			<p>
				<select class="hideshadow<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'hide-shadow' ); ?>" name="<?php echo $this->get_field_name( 'hide-shadow' ); ?>">
					<option value="Use Default" <?php if ( 'Use Default' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Use Default</option>
					<option value="Hide" <?php if ( 'Hide' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Hide</option>
					<option value="Show" <?php if ( 'Show' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Show</option>
				</select>
				
			 Widget Drop Shadow</p>

	<?php if ($disable_js == '') { ?>
	
	<script type="text/javascript">

    		jQuery(".textcontrol<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "On") ? jQuery(".textoptions<?php echo $random; ?>").slideDown('slow') : jQuery(".textoptions<?php echo $random; ?>").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".textcontrol<?php echo $random; ?>").val() == "On") ? jQuery(".textoptions<?php echo $random; ?>").show() : jQuery(".textoptions<?php echo $random; ?>").hide();
    		});

			jQuery('.textoverride<?php echo $random; ?>').change(function() {
   		 		jQuery('.textoverrideoption<?php echo $random; ?>').slideToggle('slow');
			});
    		if (jQuery('.textoverride<?php echo $random; ?>').prop('checked')) {
				jQuery(".textoverrideoption<?php echo $random; ?>").show();
			} else {
				jQuery(".textoverrideoption<?php echo $random; ?>").hide();
			}

			jQuery('.outerdesigncontrol<?php echo $random; ?>').change(function() {
   		 		jQuery('.outerdesignoptions<?php echo $random; ?>').slideToggle('slow');
			});
    		if (jQuery('.outerdesigncontrol<?php echo $random; ?>').prop('checked')) {
				jQuery(".outerdesignoptions<?php echo $random; ?>").show();
			} else {
				jQuery(".outerdesignoptions<?php echo $random; ?>").hide();
			}

			jQuery('.hidetitle<?php echo $random; ?>').change(function() {
   		 		jQuery('#widgetsection3-<?php echo $random; ?>').slideToggle('slow');
			});
    		if (jQuery('.hidetitle<?php echo $random; ?>').prop('checked')) {
				jQuery("#widgetsection3-<?php echo $random; ?>").hide();
			} else {
				jQuery("#widgetsection3-<?php echo $random; ?>").show();
			}

			jQuery('.offsettitle<?php echo $random; ?>').change(function() {
    			if (jQuery('.offsettitle<?php echo $random; ?>').prop('checked')) {
					jQuery('.hidetitle<?php echo $random; ?>').prop('checked', true); // checks it
					jQuery("#widgetsection3-<?php echo $random; ?>").hide();
				} 
			});

		
			if ( jQuery(".threecolumnmoved<?php echo $random; ?>").parents("#hmc_wrap<?php echo $random; ?>").length == 1 ) { } else {
				jQuery('.threecolumnmoved<?php echo $random; ?>').prop('checked', false); // Unchecks it
			}
			jQuery('.checkbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.dividinglines<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.checkbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".dividinglines<?php echo $random; ?>").show();
			} else {
				jQuery(".dividinglines<?php echo $random; ?>").hide();
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

    		jQuery(".displaystyle<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "Teasers") ? jQuery(".displayoptions<?php echo $random; ?>").slideDown('slow') : jQuery(".displayoptions<?php echo $random; ?>").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".displaystyle<?php echo $random; ?>").val() == "Teasers") ? jQuery(".displayoptions<?php echo $random; ?>").show() : jQuery(".displayoptions<?php echo $random; ?>").hide();
    		});

    		jQuery(".displaycontrol<?php echo $random; ?>").change(function() {
        		if (jQuery(this).val() == "2 Column Dominant") { 
	        		jQuery(".c2d-show<?php echo $random; ?>").slideDown('slow'); 
	        		jQuery(".c2d-hide<?php echo $random; ?>").slideUp('slow'); 
	        	}
        		if (jQuery(this).val() == "1 Column") { 
	        		jQuery(".c1-show<?php echo $random; ?>").slideDown('slow'); 
	        		jQuery(".c1-hide<?php echo $random; ?>").slideUp('slow'); 
	        	}
        		if (jQuery(this).val() == "2 Column") { 
	        		jQuery(".c2-show<?php echo $random; ?>").slideDown('slow'); 
	        		jQuery(".c2-hide<?php echo $random; ?>").slideUp('slow'); 
	        	}
        		if (jQuery(this).val() == "3 Column") { 
	        		jQuery(".c3-show<?php echo $random; ?>").slideDown('slow'); 
	        		jQuery(".c3-hide<?php echo $random; ?>").slideUp('slow'); 
	        	}
    		});
        		if (jQuery(".displaycontrol<?php echo $random; ?>").val() == "2 Column Dominant") { 
	        		jQuery(".c2d-show<?php echo $random; ?>").slideDown('slow'); 
	        		jQuery(".c2d-hide<?php echo $random; ?>").slideUp('slow'); 
	        	}
        		if (jQuery(".displaycontrol<?php echo $random; ?>").val() == "1 Column") { 
	        		jQuery(".c1-show<?php echo $random; ?>").slideDown('slow'); 
	        		jQuery(".c1-hide<?php echo $random; ?>").slideUp('slow'); 
	        	}
        		if (jQuery(".displaycontrol<?php echo $random; ?>").val() == "2 Column") { 
	        		jQuery(".c2-show<?php echo $random; ?>").slideDown('slow'); 
	        		jQuery(".c2-hide<?php echo $random; ?>").slideUp('slow'); 
	        	}
        		if (jQuery(".displaycontrol<?php echo $random; ?>").val() == "3 Column") { 
	        		jQuery(".c3-show<?php echo $random; ?>").slideDown('slow'); 
	        		jQuery(".c3-hide<?php echo $random; ?>").slideUp('slow'); 
	        	}


    		jQuery(".widgetstyle<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "Style 2") ? jQuery(".style2options<?php echo $random; ?>").slideDown('slow') : jQuery(".style2options<?php echo $random; ?>").slideUp('slow');
        		(jQuery(this).val() == "Style 6") ? jQuery(".style6options<?php echo $random; ?>").slideUp('slow') : jQuery(".style6options<?php echo $random; ?>").slideDown('slow');
        		(jQuery(this).val() == "Style 2" || jQuery(this).val() == "Style 6") ? jQuery(".style26options<?php echo $random; ?>").slideDown('slow') : jQuery(".style26options<?php echo $random; ?>").slideUp('slow');
    		});
        	(jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 2") ? jQuery(".style2options<?php echo $random; ?>").show() : jQuery(".style2options<?php echo $random; ?>").hide();
        	(jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 6") ? jQuery(".style6options<?php echo $random; ?>").hide() : jQuery(".style6options<?php echo $random; ?>").show();
        	(jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 2" || jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 6") ? jQuery(".style26options<?php echo $random; ?>").show() : jQuery(".style26options<?php echo $random; ?>").hide();

			jQuery('.customoptionscheckbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.customoptions<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.customoptionscheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".customoptions<?php echo $random; ?>").show();
			} else {
				jQuery(".customoptions<?php echo $random; ?>").hide();
			}

			jQuery('.threecolumncheckbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.threecolumn<?php echo $random; ?>').slideToggle('slow');
   		 		jQuery('.threecolumnhide<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.threecolumncheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".threecolumn<?php echo $random; ?>").hide();
			} else {
				jQuery(".threecolumn<?php echo $random; ?>").show();
			}

    		
    		if (jQuery('.threecolumncheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".threecolumnhide<?php echo $random; ?>").show();
			} else {
				jQuery(".threecolumnhide<?php echo $random; ?>").hide();
			}
			
			
			jQuery('.teaserselect<?php echo $random; ?>').change(function() {
   		 		jQuery('.teaseroptions<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.teaserselect<?php echo $random; ?>').prop('checked')) {
				jQuery(".teaseroptions<?php echo $random; ?>").show();
			} else {
				jQuery(".teaseroptions<?php echo $random; ?>").hide();
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


    		jQuery(".widgetheader<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "Off") ? jQuery(".widgetheaderoptions<?php echo $random; ?>").slideDown('slow') : jQuery(".widgetheaderoptions<?php echo $random; ?>").slideUp('slow');
    		});
 			(jQuery(".widgetheader<?php echo $random; ?>").val() == "Off") ? jQuery(".widgetheaderoptions<?php echo $random; ?>").show() : jQuery(".widgetheaderoptions<?php echo $random; ?>").hide();




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