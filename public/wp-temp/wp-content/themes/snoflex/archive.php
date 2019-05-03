<?php 

get_header();

$active_cat_id = get_query_var('cat');
$cat_template = get_theme_mod('cat-template-'.$active_cat_id);
if ($cat_template == '' || $cat_template == 'Use Default') $cat_template = get_theme_mod('catpage');
$list = '';
if ( isset($_GET['list'])) {
	$list = 'true';
	$_SERVER['REQUEST_URI'] = str_replace('?list','',$_SERVER['REQUEST_URI']);
	$original_url = $_SERVER['REQUEST_URI'];
	echo "<script type='text/javascript'>window.history.pushState('', '', '$original_url');</script>";
}

echo "<div id='catpage' class='sno-categoryview-$active_cat_id'>";

if ( $cat_template == 'Widget Areas' && ! is_paged() && $list != 'true') {
	
	if (get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 1") {
		echo '<style>';
			echo '.hp_top_left { width: 30%; }';
			echo '.hp_top_center { width: calc(70% - 15px); width: -moz-calc(70% - 15px); width: -webkit-calc(70% - 15px); }';
		echo '</style>';
	}
	if (get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 2") {
		echo '<style>';
			echo '.hp_top_left { width: 70%; }';
			echo '.hp_top_center { width: calc(30% - 15px); width: -moz-calc(30% - 15px); width: -webkit-calc(30% - 15px); }';
		echo '</style>';
	}
	if (get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 3") {
		echo '<style>';
			echo '.hp_top_left { width: 50%; }';
			echo '.hp_top_center { width: calc(50% - 15px); width: -moz-calc(50% - 15px); width: -webkit-calc(50% - 15px); }';
		echo '</style>';
	}
	if (get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 4") {
		echo '<style>';
			echo '.hp_top_left { width: 30%; }';
			echo '.hp_top_center { width: calc(70% - 15px); width: -moz-calc(70% - 15px); width: -webkit-calc(70% - 15px); }';
		echo '</style>';
	}
	if (get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 5") {
		echo '<style>';
			echo '.hp_top_center { width: calc(30% - 15px); width: -moz-calc(30% - 15px); width: -webkit-calc(30% - 15px); }';
			echo '.hp_top_left {  width: 70%; }';
		echo '</style>';
	}
	if (get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 6") {
		echo '<style>';
			echo '.hp_top_left { width: 50%; }';
			echo '.hp_top_center { width: calc(50% - 15px); width: -moz-calc(50% - 15px); width: -webkit-calc(50% - 15px); }';
		echo '</style>';
	}

	echo '<div id="category-widgets">';
		
	echo '<div id="content">';
	
		echo '<div id="fullhomepage">';

			if ( function_exists('dynamic_sidebar') && dynamic_sidebar('cat'.$active_cat_id.'-t-11') ) : else : endif;

		echo '<div class="hp_wide_extra" style="';
			if ((get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 4") || (get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 5") || (get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 6")) { 
				echo 'float:right;';
			} else { 
				echo 'float:left;'; 
			} 
		echo '">';

			wp_reset_query();
			echo '<div id="homepagewide">';
					
				if ( function_exists('dynamic_sidebar') && dynamic_sidebar('cat'.$active_cat_id.'-2') ) : else : endif;
							
			echo '</div>';

			echo '<div class="clear"></div>';


			if (get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 3" || get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 1" || get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 2") {
				echo "<div class='hp_top_left'>";
					dynamic_sidebar('cat'.$active_cat_id.'-3');
					echo '</div>';
					echo "<div class='hp_top_center'>";
					dynamic_sidebar('cat'.$active_cat_id.'-4');
				echo '</div>';
			}

			if (get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 6" || get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 5"|| get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 4") {
				echo "<div class='hp_top_left'>";
					dynamic_sidebar('cat'.$active_cat_id.'-4');
				echo '</div>';
				echo "<div class='hp_top_center'>";
					dynamic_sidebar('cat'.$active_cat_id.'-5');
				echo '</div>';
			}


	
	echo '</div>';

		echo '<div id="sidebar" style="';	
			if ((get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 4") || (get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 5") || (get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 6")) { 
				echo 'float:left;';
			} else { 
				echo 'float:right;'; 
			} 
		echo '">';
		echo '<div style="width:100%">';
		

			if ((get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 4") || (get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 5") || (get_theme_mod("cat-widget-layout-$active_cat_id") == "Option 6")) { 
				if ( function_exists('dynamic_sidebar') && dynamic_sidebar('cat'.$active_cat_id.'-3') ) : else : endif;
			} else {
				if ( function_exists('dynamic_sidebar') && dynamic_sidebar('cat'.$active_cat_id.'-5') ) : else : endif;
			}


		echo '</div>';
	echo '</div>';
	
	echo '<div class="clear"></div>';
	
	if ( function_exists('dynamic_sidebar') && dynamic_sidebar('cat'.$active_cat_id.'-b-11') ) : else : endif;
			
			wp_reset_query();
		if ( get_theme_mod('catpage-pagination') == 'Hide' && ! is_paged() ) {} else {	
			echo '<p>';
				if(function_exists('wp_paginate')) { wp_paginate(); } else { posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;'));}
			echo '</p>';
		}

		echo '</div>';



	echo '</div>';
	echo '</div>';
	
} else if (get_theme_mod('catpage') == 'Dominant Story') {

	echo '<div id="content">';
	
		echo '<div class="postarea" style="padding:1.5%">'; $i = '';
		
		if (is_paged()) {  // for all non-first pages on category views
			
			$i = 0;
            if (have_posts()) : while (have_posts()) : the_post(); global $post; $i++;				
            		
					$sno_teaser = ''; $imageid = ''; $video = '';
					$custom_fields = get_post_custom($post->ID);
					if (get_theme_mod('catpage-videos') != "Off" && isset($custom_fields['video'])) $video = $custom_fields['video'][0];
					if (isset($custom_fields['sno_teaser'])) $sno_teaser = $custom_fields['sno_teaser'][0];
					$teaser_length = get_theme_mod('catpage-teaser');
					$customlink = '';
					if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
					if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }

					if ($i < 3) {
						$class = 'cat_dom_three';
					} else if ($i == 3) {
						$class = 'cat_dom_three_final';
					} else if ($i %5 != 0) {
						$class = 'cat_dom_five';
					} else {
						$class = 'cat_dom_five_final';
					}

					echo "<div class='sno-animate $class'>";
					$classname = ""; 

						if ($video) { 
							$pattern = "/height=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video); 
							$pattern = "/width=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video); 
							echo '<div class="previewstaffpic"><div class="embedcontainer">' . $video . '</div></div>';
						
							echo '<h2 class="catprofile categoryheadline"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>'; 
							echo '<p class="categorydate">';
								echo get_sno_timestamp(); 
							echo '</p>'; 
								if ($i < 4 ) {
									echo '<div class="categoryteaser">';
										if ($sno_teaser) { 
											echo '<p>' . $sno_teaser . '</p>'; 
			  							} else {
			  								the_content_limit(200, "");
			   							}
			   						echo '</div>';
			   					}
						} else if (has_post_thumbnail()) {

							$catimage = wp_get_attachment_image_src( $imageid, 'medium'); 			
							if (($catimage[2] >= $catimage[1]) && (get_theme_mod('catpage-photo') == 'Allow Vertical')) {

								echo '<h2 class="catprofile categoryheadline"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>'; 
								echo '<a href="' . $storylink . '"><img src="' . $catimage[0] . '" class="previewstaffpic" style="width:50%!important;float:right;" alt="' . get_the_title() . '" /></a>'; 
								$byline = snowriter(); if ($byline) echo '<p class="writer">' . $byline . '</p>';
								echo '<p class="categorydate">';
									echo get_sno_timestamp(); 
									echo '</p>';
								if ($i < 4 ) {
		           					echo '<div class="categoryteaser">';
				   					if ($sno_teaser) { 
		       							echo '<p>' . $sno_teaser . '</p>'; 
			   						} else {
										the_content_limit($teaser_length, "");
									}
									echo '</div>';
								}
							} else {

								$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'tsbigblock'); 
							
								if ($image[2] >= $image[1] || $image[1] < 200) { 
							
									echo '<h2 class="catprofile categoryheadline"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>'; 
									echo '<p class="categorydate">';
										echo get_sno_timestamp();
									echo '</p>'; 
									
									if ($i < 4 ) {
		            					echo '<div class="categoryteaser">';
										if ($sno_teaser) { 
		           							echo '<p>' . $sno_teaser . '</p>'; 
		           						} else {
											the_content_limit(200, "");
										}
										echo '</div>';
									}
								} else {

									echo '<a href="' . $storylink . '"><img src="' . $image[0] . '" class="previewstaffpic" alt="' . get_the_title() . '" /></a>'; 
									echo '<h2 class="catprofile categoryheadline"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>'; 
									echo '<p class="categorydate">';
										echo get_sno_timestamp(); 
									echo '</p>'; 
									if ($i < 4 ) {
										echo '<div class="categoryteaser">';
										if ($sno_teaser) { 
											echo '<p>' . $sno_teaser . '</p>'; 
		           						} else {
				   							the_content_limit(200, "");
										}
										echo '</div>';
									}
								}
							}
						} else {	

							echo '<h2 class="catprofile"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>';         
							$byline = snowriter(); if ($byline) echo '<p class="writer">' . $byline . '</p>';
							echo '<p class="categorydate">';
								echo get_sno_timestamp(); 
							echo '</p>';
							if ($i < 4 ) {
								echo '<div class="categoryteaser">';
								if ($sno_teaser) { 
		           					echo '<p>' . $sno_teaser . '</p>'; 
		           				} else {
									the_content_limit(425, "");
								}
								echo '</div>';
							}
					}
				
					echo '<div class="clear"></div>'; 

				echo '</div>';
				
				if ($i == 3 || ($i-3) % 5 == 0) echo '<div class="clear"></div><div class="cat_dom_divider_h"></div>';

			endwhile; endif; 

			
			
		} else {  // for all first pages
			
			$category = get_category( get_query_var( 'cat' ) );
			$cat_id = $category->cat_ID; 
            query_posts('meta_key=_thumbnail_id&showposts=1&cat='.$cat_id); // add option to include sticky post here
            if (have_posts()) : while (have_posts()) : the_post();
				$sno_teaser = get_post_meta($post->ID, 'sno_teaser', true);
            	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');  // need to build option in case of vertical/square photo

				$custom_fields = get_post_custom($post->ID); $customlink = '';
				if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
				if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }

            	echo '<div class="cat_dom">';
            	if ($image) {
	            	echo '<div class="cat_dom_photo">';
	            		echo "<img src='" . $image[0] . "'  alt='" . get_the_title() . "' />";
						$imageid = get_post_meta($post->ID, '_thumbnail_id', true);
	   					$caption = get_post_field('post_excerpt', $imageid);	
						echo get_sno_photographer($wrap = null);								   						
	   					if ($caption) { 
	   						echo "<p class='photocaption' style='padding-bottom:8px !important'>$caption</p>"; 
	   					} 
	            	echo '</div>';
            	}
            	
				echo '<h2 class="cat_dom_headline"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>'; 

				$byline = snowriter(); if ($byline) echo '<p class="cat_writer">' . $byline . '</p>';
				echo '<p class="categorydate">';
					echo get_sno_timestamp(); 
				echo '</p>';

				
				echo '<div class="cat_dom_teaser">';
		  	     	if ($sno_teaser) { 
		    	    	echo '<p>' . $sno_teaser . '</p>'; 
					} else {
						the_content_limit(250, "");
					}
				echo '</div>';
				echo '</div>';
				echo '<div class="clear"></div>';
				echo '<div class="cat_dom_divider_h"></div>';
				
				$exclude_post = $post->ID; 
			endwhile; endif; 
			
			
			$exclusionarray = array();
			$exclusionarray[] = $exclude_post;
			$args = array ( 'cat' => $cat_id, 'showposts' => 13, 'post__not_in' => $exclusionarray);
			
            query_posts($args); $count = 0;
            if (have_posts()) : while (have_posts()) : the_post(); global $post; 
					$sno_teaser = ''; $imageid = ''; $video = ''; $customlink = '';
					$custom_fields = get_post_custom($post->ID);
					if (get_theme_mod('catpage-videos') != "Off" && isset($custom_fields['video'])) $video = $custom_fields['video'][0];
					if (isset($custom_fields['sno_teaser']))$sno_teaser = $custom_fields['sno_teaser'][0];
					$teaser_length = get_theme_mod('catpage-teaser');
					if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
					if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }

				$i++;
				
					if ($i < 3) {
						$class = 'cat_dom_three';
					} else if ($i == 3) {
						$class = 'cat_dom_three_final';
					} else if ($i != 8 && $i != 13) {
						$class = 'cat_dom_five';
					} else {
						$class = 'cat_dom_five_final';
					}
					echo "<div class='sno-animate $class'>";
					$classname = ""; 

						if ($video) { 
							$pattern = "/height=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video); 
							$pattern = "/width=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video); 
							echo '<div class="previewstaffpic"><div class="embedcontainer">' . $video . '</div></div>';
						
							echo '<h2 class="catprofile categoryheadline"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>'; 
							
							$byline = snowriter(); if ($byline) echo '<p class="cat_writer">' . $byline . '</p>';
							echo '<p class="categorydate">';
								echo get_sno_timestamp(); 
							echo '</p>';

						} else if (has_post_thumbnail()) {

							$catimage = wp_get_attachment_image_src( $imageid, 'medium'); 			
							if (($catimage[2] >= $catimage[1]) && (get_theme_mod('catpage-photo') == 'Allow Vertical')) {

								echo '<h2 class="catprofile categoryheadline"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>'; 
								echo '<a href="' . get_permalink() . '"><img src="' . $catimage[0] . '" class="previewstaffpic" style="width:50%!important;float:right;" alt="' . get_the_title() . '" /></a>'; 
								$byline = snowriter(); if ($byline) echo '<p class="cat_writer">' . $byline . '</p>';
								echo '<p class="categorydate">';
									echo get_sno_timestamp(); 
								echo '</p>';

							} else {

								$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'tsbigblock'); 
							
								if ($image[2] >= $image[1] || $image[1] < 200) { 
							
									echo '<h2 class="catprofile categoryheadline"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>'; 
									
									$byline = snowriter(); if ($byline) echo '<p class="cat_writer">' . $byline . '</p>';
									echo '<p class="categorydate">';
										echo get_sno_timestamp(); 
									echo '</p>';
									
									if ($i < 4 ) {
		            					echo '<div class="cat_teaser">';
										if ($sno_teaser) { 
		           							echo '<p>' . $sno_teaser . '</p>'; 
		           						} else {
											the_content_limit(200, "");
										}
										echo '</div>';
									}
								} else {

									echo '<a href="' . $storylink . '"><img src="' . $image[0] . '" class="previewstaffpic" alt="' . get_the_title() . '" /></a>'; 
									echo '<h2 class="catprofile categoryheadline"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>'; 
									$byline = snowriter(); if ($byline) echo '<p class="cat_writer">' . $byline . '</p>';
									echo '<p class="categorydate">';
										echo get_sno_timestamp();
									echo '</p>';
									if ($i < 4 ) {
										echo '<div class="cat_teaser">';
										if ($sno_teaser) { 
											echo '<p>' . $sno_teaser . '</p>'; 
		           						} else {
				   							the_content_limit(200, "");
										}
										echo '</div>';
									}
								}
							}
						} else {	

							echo '<h2 class="catprofile"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>';         
							$byline = snowriter(); if ($byline) echo '<p class="cat_writer">' . $byline . '</p>';
							echo '<p class="cat_date">';
								echo get_sno_timestamp();
							echo '</p>';
							$teaser_length = 225;
							if ($i < 4 ) $teaser_length = 525;
								echo '<div class="cat_teaser">';
								if ($sno_teaser) { 
		           					echo '<p>' . $sno_teaser . '</p>'; 
		           				} else {
									the_content_limit($teaser_length, "");
								}
								echo '</div>';
					}
				
					echo '<div class="clear"></div>'; 

				echo '</div>';

				if ($i == 3 || $i == 8) echo '<div class="clear"></div><div class="cat_dom_divider_h"></div>';


			endwhile; endif; 

		}
		
	

			echo '<div class="clear"></div>';
			
			echo '<p>';
				if(function_exists('wp_paginate')) { wp_paginate(); } else { posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;'));}
			echo '</p>';
			
		echo '</div>';
				
			
	echo '</div>';
	
	
} else if ($cat_template == 'Preview Tiles') {


	echo '<div id="content">';

		echo '<div style="padding:1.5%">'; $i = '';
    
            if (have_posts()) : while (have_posts()) : the_post(); 
            
				$custom_fields = get_post_custom($post->ID);
					$sno_teaser = ''; $imageid = ''; $audio = ''; $video = ''; $customlink = '';
					if (get_theme_mod('catpage-videos') != "Off" && isset($custom_fields['video'])) $video = $custom_fields['video'][0];
					if (isset($custom_fields['_thumbnail_id'])) $imageid = $custom_fields['_thumbnail_id'][0]; 
					if (isset($custom_fields['sno_teaser']))$sno_teaser = $custom_fields['sno_teaser'][0];
					if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
					if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }
				$teaser_length = get_theme_mod('catpage-teaser');

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


				echo '<div class="sno-animate categorypreviewbox ' . $classname . '">';
				$classname = ""; 

					if ($video) { 
						$pattern = "/height=\"[0-9]*\"/"; 
						$video = preg_replace($pattern, "", $video); 
						$pattern = "/width=\"[0-9]*\"/"; 
						$video = preg_replace($pattern, "", $video); 
						echo '<div class="previewstaffpic"><div class="embedcontainer">' . $video . '</div></div>';
						
						echo '<h2 class="catprofile categoryheadline"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>'; 
						echo '<p class="categorydate">';
							echo get_sno_timestamp(); 
						echo '</p>'; 
						if ($teaser_length != '0') {
		           			echo '<div class="categoryteaser">';
		           				if ($sno_teaser) { 
		           					echo '<p>' . $sno_teaser . '</p>'; 
		           				} else {
									the_content_limit($teaser_length, "");
								}
							echo '</div>';
						}
					} else if (has_post_thumbnail()) {

						$catimage = wp_get_attachment_image_src( $imageid, 'medium'); 			
						if (($catimage[2] >= $catimage[1]) && (get_theme_mod('catpage-photo') == 'Allow Vertical')) {

							echo '<h2 class="catprofile categoryheadline"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>'; 
							echo '<a href="' . $storylink . '"><img src="' . $catimage[0] . '" class="previewstaffpic" style="width:50%!important;float:right;" alt="' . get_the_title() . '" /></a>'; 
							$byline = snowriter(); if ($byline) echo '<p class="writer">' . $byline . '</p>';
							echo '<p class="categorydate">';
								echo get_sno_timestamp(); 
							echo '</p>';
							echo '<p class="categorycat">';
							echo 'Filed under ';
								the_category(', '); 
							echo '</p>'; 
							if ($teaser_length != '0') {
		            			echo '<div class="categoryteaser">';
		           				if ($sno_teaser) { 
		           					echo '<p>' . $sno_teaser . '</p>'; 
		           				} else {
									the_content_limit($teaser_length, "");
								}
								echo '</div>';
							}
						} else {

							$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'tsbigblock'); 
							
							if ($image[2] >= $image[1] || $image[1] < 200) { 
							
							echo '<h2 class="catprofile categoryheadline"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>'; 
							echo '<p class="categorydate">';
								echo get_sno_timestamp(); 
							echo '</p>'; 
							if ($teaser_length != '0') {
		            			echo '<div class="categoryteaser">';
		           				if ($sno_teaser) { 
		           					echo '<p>' . $sno_teaser . '</p>'; 
		           				} else {
									the_content_limit($teaser_length, "");
								}
								echo '</div>';
							}
							
							} else {

							echo '<a href="' . $storylink . '"><img src="' . $image[0] . '" class="previewstaffpic" alt="' . get_the_title() . '" /></a>'; 
							echo '<h2 class="catprofile categoryheadline"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>'; 
							echo '<p class="categorydate">';
								echo get_sno_timestamp(); 
							echo '</p>'; 
							if ($teaser_length != '0') {
		            			echo '<div class="categoryteaser">';
		           				if ($sno_teaser) { 
		           					echo '<p>' . $sno_teaser . '</p>'; 
		           				} else {
									the_content_limit($teaser_length, "");
								}
								echo '</div>';
							}
							}
						}
					} else {	

						echo '<h2 class="catprofile"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>';         
						$byline = snowriter(); if ($byline) echo '<p class="writer">' . $byline . '</p>';
						echo '<p class="categorydate">';
							echo get_sno_timestamp();
						echo '</p>';
						echo '<p class="categorycat">Filed under ';
							the_category(', '); 
						echo '</p>'; 
            			$teaser_length += 225;
            			echo '<div class="categoryteaser">';
		           				if ($sno_teaser) { 
		           					echo '<p>' . $sno_teaser . '</p>'; 
		           				} else {
									the_content_limit($teaser_length, "");
								}
						echo '</div>';
					}
				
					echo '<div class="clear"></div>'; 

				echo '</div>';

				// echo '<div class="postmeta2">';
				//		the_tags('<p><span class="tags">Tags: ', ', ', '</span></p>'); 
				//	echo '</div>';

			endwhile; else: echo '<p>Sorry, no posts matched your criteria.</p>'; endif; 
			
			echo '<div class="clear"></div>';
			
			echo '<p>';
				if(function_exists('wp_paginate')) { wp_paginate(); } else { posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;'));}
			echo '</p>';
			
		echo '</div>';
				
			
	echo '</div>';
	
            
} else {

	echo '<div id="content">';

    echo '<div id="contentleft">';
    
        echo '<div class="postarea archivepage">';
                
            if (have_posts()) : while (have_posts()) : the_post(); 
				$custom_fields = get_post_custom($post->ID); $customlink = '';
				if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 
				if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }

				echo '<div class="sno-animate">';
				echo '<h2 class="searchheadline"><a href="' . $storylink . '" rel="bookmark">' . get_the_title() . '</a></h2>'; 

					$sno_teaser = ''; $imageid = ''; $video = '';
					if (get_theme_mod('catpage-videos') != "Off" && isset($custom_fields['video'])) $video = $custom_fields['video'][0];
					if (isset($custom_fields['_thumbnail_id'])) $imageid = $custom_fields['_thumbnail_id'][0]; 
					if (isset($custom_fields['sno_teaser'])) $sno_teaser = $custom_fields['sno_teaser'][0];
				

                if (has_post_thumbnail()) {
									$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); 
									echo '<a href="' . $storylink . '"><img src="' . $image[0] . '" class="categoryimage" alt="' . get_the_title() . '" /></a>'; 
				}					
				
				if ($video) { 
						$pattern = "/height=\"[0-9]*\"/"; 
						$video = preg_replace($pattern, "", $video); 
						$pattern = "/width=\"[0-9]*\"/"; 
						$video = preg_replace($pattern, "", $video); 
						echo '<div class="archivevideowrap"><div class="embedcontainer">' . $video . '</div></div>';
				} 
			
					$byline = snowriter(); if ($byline) {
						echo '<p>';
							echo $byline . '<br />';
						echo '</p>';
						}
					echo '<p class="categorydate">';		
						echo get_sno_timestamp(); 
					echo '</p>';
					echo '<p class="categorycat"><br />Filed under ';
					the_category(', '); 
					echo '</p>';

		        if ($sno_teaser) { 
		           echo '<p>' . $sno_teaser . '</p>'; 
				} else {
					the_content_limit(300, "");
				}

				
				echo '<div class="clear"></div>'; 

				if ((isset ($audioplayer) && $audioplayer == "") && ($audio)) { 
					$audioplayer = "[audio mp3=" . $audio . "]";
					echo '<div class="audiobox">';
					echo do_shortcode($audioplayer); 
					echo '</div>';
				}

				echo '<div class="postmeta2">';
					the_tags('<p><span class="tags">Tags: ', ', ', '</span></p>'); 
				echo '</div>';
				
				echo '</div>';

			endwhile; else: echo '<p>Sorry, no posts matched your criteria.</p>'; endif; 
		
			echo '<p>';
				if(function_exists('wp_paginate')) { wp_paginate(); } else { posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;'));}
			echo '</p>';
			
		echo '</div>';
				
	echo '</div>';
	
	include(TEMPLATEPATH."/sidebar.php");
		
	echo '</div>';
			
}			

echo '</div>';

get_footer(); 
?>