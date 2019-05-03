<?php
/*
Template Name: A&E
*/
 
get_header(); 

if (get_option('asno') == "asno836158a") { 

echo '<div id="content">';

	echo '<div id="contentleft">';
	
		if (get_theme_mod('ae-featured') != "-1") { 
	
			echo '<div class="postarea">';
	
	        echo '<div class="breadcrumb">Featured ' . get_the_title() . ' Review</div>';

			query_posts('showposts=1&cat='.get_theme_mod('ae-featured')); 
			if (have_posts()) : while (have_posts()) : the_post(); $do_not_duplicate[$post->ID] = $post->ID;

				echo '<a href="' . get_permalink() . '" class="headline"><h1 class="storyheadline">' . get_the_title() . '</h1></a>';
				$custom_fields = get_post_custom($post->ID);
					$video = $custom_fields['video'][0];
					$videographer = $custom_fields['videographer'][0];
					$audio = $custom_fields['audio'][0];
					$imageid = $custom_fields['_thumbnail_id'][0]; 
					$teasertitle = $custom_fields['teasertitle'][0]; 
					$teaser = $custom_fields['teaser'][0]; 
					$grade = $custom_fields['grade'][0]; 
					$showratings = $custom_fields['showratings'][0];

				if (has_post_thumbnail()) {
					$photographer = get_post_meta($imageid, 'photographer', true);
	   				$caption = get_post_field(post_excerpt, $imageid);
	   			}


				if ($video) { 

					echo '<div id="reviewside">';
	                    $pattern = "/height=\"[0-9]*\"/"; 
    	                $video = preg_replace($pattern, "height='250'", $video); 
        	            $pattern = "/width=\"[0-9]*\"/"; 
            	        $video = preg_replace($pattern, "width='300'", $video); 
						echo '<div class="videowrap"><div class="embedcontainer">' . $video . '</div></div>';
                	    sno_videographer();

						if (($teaser) || ($teasertitle)) { 
							echo '<div class="teaserbox">';
								if (has_post_thumbnail()) the_post_thumbnail( 'thumbnail', array('class' => 'reviewthumbnail')); 
								if ($teasertitle) echo '<p class="teasertitle">' . $teasertitle . '</p>';
								if ($teaser) echo '<p class="teasertext">' . $teaser . '</p>';
								if ($grade) echo '<p class="teasergrade">Our Rating: ' . $grade . '</p>';
							echo '</div>';
						}
					
						if ($showratings=="Yes") { 
							echo '<div class="ratingsbox">';
								echo '<p class="teasertitle">What\'s Your Rating of ' . $teasertitle . '?</p>';
								if (function_exists('wp_gdsr_render_article')) { wp_gdsr_render_article(10); }
							echo '</div>';
						}
					echo '</div>';

				} else if ((has_post_thumbnail()) || ($teaser) || ($teasertitle)) { 

					echo '<div id="reviewside">';
						if (has_post_thumbnail()) {
							$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); 
							echo '<a href="' . get_permalink() . '"><img src="' . $image[0] . '" style="width:100%" class="catboxphoto" alt="' . get_the_title() . '" /></a>'; 
							sno_photographer($wrap);
							if ($caption) echo '<p class="photocaption">' . $caption . '</p>';
						}
						
						if (($teaser) || ($teasertitle)) { 
							echo '<div class="teaserbox">';
								if ($teasertitle) echo '<p class="teasertitle">' . $teasertitle . '</p>';
								if ($teaser) echo '<p class="teasertext">' . $teaser . '</p>';
								if ($grade) echo '<p class="teasergrade">Our Rating: ' . $grade . '</p>';
							echo '</div>';
						}
					
						if ($showratings=="Yes") { 
							echo '<div class="ratingsbox">';
								echo '<p class="teasertitle">What\'s Your Rating of ' . $teasertitle . '?</p>';
								if (function_exists('wp_gdsr_render_article')) { wp_gdsr_render_article(10); }
							echo '</div>';
						}

					echo '</div>';

				}

				echo '<p>';
					$byline = snowriter(); if ($byline) echo $byline . '<br />';
					the_time('F j, Y'); 
					edit_post_link('(Edit)', ' &bull; ', '');
				echo '</p>';
				
				the_content_limit(600, "Read more &raquo;");

			endwhile; else: endif;
			
			echo '</div>';
			echo '<div class="clear"></div>';

		}

		if ((get_theme_mod('ae-cat1') != "-1") && (get_theme_mod('ae-cat1-count') != "0")) {
		
			echo '<div id="homepageleft" style="width:300px;float:left;">';
				echo '<div class="widgetwrap"><div class="titlewrap">';
					echo '<a href="' . cat_id_to_slug(get_theme_mod('ae-cat1')) . '">';
					echo '<h2>' . cat_id_to_name(get_theme_mod('ae-cat1')) . '</h2>';
					echo '</a>';
				echo '</div>';
				
				echo '<div class="widgetbody">';

				query_posts('showposts='.get_theme_mod('ae-cat1-count').'&cat='.get_theme_mod('ae-cat1')); 
				if (have_posts()) : while (have_posts()) : the_post(); 

					if ($post->ID != $do_not_duplicate[$post->ID] ) { 
	
						$custom_fields = get_post_custom($post->ID);
							$audio = $custom_fields['audio'][0];
							$imageid = $custom_fields['_thumbnail_id'][0]; 
							$teasertitle = $custom_fields['teasertitle'][0]; 
							$teaser = $custom_fields['teaser'][0]; 
							$grade = $custom_fields['grade'][0]; 
							$showratings = $custom_fields['showratings'][0];

						if (has_post_thumbnail()) the_post_thumbnail( 'thumbnail', array('class' => 'reviewthumbnail'));
					
						echo '<a href="' . get_permalink() . '" class="teasertitle headline">';
							if ($teasertitle) { echo $teasertitle; } else { the_title(); }
						echo '</a>';
					
						echo '<p class="teasertext">';
							if ($teaser) { echo $teaser; } else { the_content_limit(100, ''); } 
						echo '</p>';
					
            	        if ($grade) echo '<p class="teasergrade">Our Rating: ' . $grade . '</p>';

						if ($audio) { 
                             	$audioplayer = "[audio mp3=" . $audio . "]";
                             	echo '<div class="audiobox">';
								echo do_shortcode($audioplayer); 
								echo '</div>';
						}

                		echo '<div class="clear"></div>';

						if (($showratings=="Yes") && (function_exists('wp_gdsr_render_article'))) wp_gdsr_render_article(10);
                
                		echo '<div class="clear"></div>';
                		echo '<div class="aeline"></div>';

					} 			
			
				endwhile; else: endif;

				echo '<a href="' . cat_id_to_slug(get_theme_mod('ae-cat1')) . '"><h3>View All</h3></a>';
                
                echo '</div><div class="widgetfooter"></div></div>';
			echo '</div>';

		}


		if ((get_theme_mod('ae-cat2') != "-1") && (get_theme_mod('ae-cat2-count') != "0")) {
		
			echo '<div id="homepageright" style="width:300px;margin-right:0px;">';
				echo '<div class="widgetwrap"><div class="titlewrap">';
					echo '<a href="' . cat_id_to_slug(get_theme_mod('ae-cat2')) . '">';
					echo '<h2>' . cat_id_to_name(get_theme_mod('ae-cat2')) . '</h2>';
					echo '</a>';
				echo '</div>';
				
				echo '<div class="widgetbody">';

				query_posts('showposts='.get_theme_mod('ae-cat2-count').'&cat='.get_theme_mod('ae-cat2')); 
				if (have_posts()) : while (have_posts()) : the_post(); 

					if ($post->ID != $do_not_duplicate[$post->ID] ) { 
	
						$custom_fields = get_post_custom($post->ID);
							$audio = $custom_fields['audio'][0];
							$imageid = $custom_fields['_thumbnail_id'][0]; 
							$teasertitle = $custom_fields['teasertitle'][0]; 
							$teaser = $custom_fields['teaser'][0]; 
							$grade = $custom_fields['grade'][0]; 
							$showratings = $custom_fields['showratings'][0];

						if (has_post_thumbnail()) the_post_thumbnail( 'thumbnail', array('class' => 'reviewthumbnail'));
					
						echo '<a href="' . get_permalink() . '" class="teasertitle headline">';
							if ($teasertitle) { echo $teasertitle; } else { the_title(); }
						echo '</a>';
					
						echo '<p class="teasertext">';
							if ($teaser) { echo $teaser; } else { the_content_limit(100, ''); } 
						echo '</p>';
					
            	        if ($grade) echo '<p class="teasergrade">Our Rating: ' . $grade . '</p>';

						if ($audio) { 
                             	$audioplayer = "[audio mp3=" . $audio . "]";
                             	echo '<div class="audiobox">';
								echo do_shortcode($audioplayer); 
								echo '</div>';
						}

                		echo '<div class="clear"></div>';

						if (($showratings=="Yes") && (function_exists('wp_gdsr_render_article'))) wp_gdsr_render_article(10);
                
                		echo '<div class="clear"></div>';
                		echo '<div class="aeline"></div>';

					} 			
			
				endwhile; else: endif;

				echo '<a href="' . cat_id_to_slug(get_theme_mod('ae-cat2')) . '"><h3>View All</h3></a>';
                
                echo '</div><div class="widgetfooter"></div></div>';
			echo '</div>';

		}

	echo '</div>';
	
	echo '<div id="sidebar">';

		if ((get_theme_mod('ae-cat3') != "-1") && (get_theme_mod('ae-cat3-count') != "0")) {
	
				echo '<div class="widgetwrap"><div class="titlewrap">';
					echo '<a href="' . cat_id_to_slug(get_theme_mod('ae-cat3')) . '">';
					echo '<h2>' . cat_id_to_name(get_theme_mod('ae-cat3')) . '</h2>';
					echo '</a>';
				echo '</div>';
			
				echo '<div class="widgetbody">';

				query_posts('showposts='.get_theme_mod('ae-cat3-count').'&cat='.get_theme_mod('ae-cat3')); 
				if (have_posts()) : while (have_posts()) : the_post(); 
				
					if ($post->ID != $do_not_duplicate[$post->ID] ) { 
	
						$custom_fields = get_post_custom($post->ID);
							$audio = $custom_fields['audio'][0];
							$imageid = $custom_fields['_thumbnail_id'][0]; 
							$teasertitle = $custom_fields['teasertitle'][0]; 
							$teaser = $custom_fields['teaser'][0]; 
							$grade = $custom_fields['grade'][0]; 
							$showratings = $custom_fields['showratings'][0];

						if (has_post_thumbnail()) the_post_thumbnail( 'thumbnail', array('class' => 'reviewthumbnail'));
					
						echo '<a href="' . get_permalink() . '" class="teasertitle headline">';
							if ($teasertitle) { echo $teasertitle; } else { the_title(); }
						echo '</a>';
					
						echo '<p class="teasertext">';
							if ($teaser) { echo $teaser; } else { the_content_limit(100, ''); } 
						echo '</p>';
					
            	        if ($grade) echo '<p class="teasergrade">Our Rating: ' . $grade . '</p>';

						if ($audio) { 
                             	$audioplayer = "[audio mp3=" . $audio . "]";
                             	echo '<div class="audiobox">';
								echo do_shortcode($audioplayer); 
								echo '</div>';
						}

                		echo '<div class="clear"></div>';

						if (($showratings=="Yes") && (function_exists('wp_gdsr_render_article'))) wp_gdsr_render_article(10);
                
                		echo '<div class="clear"></div>';
                		echo '<div class="aeline"></div>';

					} 			
			
				endwhile; else: endif;

				echo '<a href="' . cat_id_to_slug(get_theme_mod('ae-cat3')) . '"><h3>View All</h3></a>';
                
                echo '</div><div class="widgetfooter"></div></div>';

		}
	
		echo '<div style="clear:both"></div>';
		
		if ((get_theme_mod('ae-cat4') != "-1") && (get_theme_mod('ae-cat4-count') != "0")) {
	
				echo '<div class="widgetwrap"><div class="titlewrap">';
					echo '<a href="' . cat_id_to_slug(get_theme_mod('ae-cat4')) . '">';
					echo '<h2>' . cat_id_to_name(get_theme_mod('ae-cat4')) . '</h2>';
					echo '</a>';
				echo '</div>';
			
				echo '<div class="widgetbody">';

				query_posts('showposts='.get_theme_mod('ae-cat4-count').'&cat='.get_theme_mod('ae-cat4')); 
				if (have_posts()) : while (have_posts()) : the_post(); 
				
					if ($post->ID != $do_not_duplicate[$post->ID] ) { 
	
						$custom_fields = get_post_custom($post->ID);
							$audio = $custom_fields['audio'][0];
							$imageid = $custom_fields['_thumbnail_id'][0]; 
							$teasertitle = $custom_fields['teasertitle'][0]; 
							$teaser = $custom_fields['teaser'][0]; 
							$grade = $custom_fields['grade'][0]; 
							$showratings = $custom_fields['showratings'][0];

						if (has_post_thumbnail()) the_post_thumbnail( 'thumbnail', array('class' => 'reviewthumbnail'));
					
						echo '<a href="' . get_permalink() . '" class="teasertitle headline">';
							if ($teasertitle) { echo $teasertitle; } else { the_title(); }
						echo '</a>';
					
						echo '<p class="teasertext">';
							if ($teaser) { echo $teaser; } else { the_content_limit(100, ''); } 
						echo '</p>';
					
            	        if ($grade) echo '<p class="teasergrade">Our Rating: ' . $grade . '</p>';

						if ($audio) { 
                             	$audioplayer = "[audio mp3=" . $audio . "]";
                             	echo '<div class="audiobox">';
								echo do_shortcode($audioplayer); 
								echo '</div>';
						}

                		echo '<div class="clear"></div>';

						if (($showratings=="Yes") && (function_exists('wp_gdsr_render_article'))) wp_gdsr_render_article(10);
                
                		echo '<div class="clear"></div>';
                		echo '<div class="aeline"></div>';

					} 			
			
				endwhile; else: endif;

				echo '<a href="' . cat_id_to_slug(get_theme_mod('ae-cat4')) . '"><h3>View All</h3></a>';
                
                echo '</div><div class="widgetfooter"></div></div>';

		}

	echo '</div>';
		
echo '</div>';

get_footer();

} else {

echo '<div id="content">';
	echo '<div id="contentleft">';
	echo 'The A&E Section Page Add-On feature can be added to your site by filling out this <a href="http://www.schoolnewspapersonline.com/add-on-features/addons-upgrades/">order form</a>.';
	echo '</div>';
echo '</div>';
get_footer();

} 
?>