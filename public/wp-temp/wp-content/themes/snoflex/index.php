<?php
$unique_id = $post->ID;

get_header();
echo "<div id='storypage' class='full-width sno-story-$unique_id'>";
echo '<div id="content">';

    echo "<div id='contentleft'>";
    
        echo '<div class="postarea">';
        
            if (have_posts()) : while (have_posts()) : the_post();

				$custom_fields = get_post_custom($post->ID); $postid = $post->ID;
					$video = ''; $videographer = ''; $deck = ''; $audio = ''; $imagelocation = ''; $videolocation = ''; $imageid = ''; $oldcaption = ''; $oldphotographer = '';
					$sno_network_ads = ''; $photographer = ''; $wrap = ''; $styles = '';
					if (isset($custom_fields['video'])) $video = $custom_fields['video'][0];
					if (isset($custom_fields['videographer'])) $videographer = $custom_fields['videographer'][0];
					if (isset($custom_fields['sno_deck'])) $deck = $custom_fields['sno_deck'][0];
					if (isset($custom_fields['audio'])) $audio = $custom_fields['audio'][0];
						$audioplayer = '';
					if (isset($custom_fields['featureimage'])) $imagelocation = $custom_fields['featureimage'][0]; 
					if (isset($custom_fields['videolocation'])) $videolocation = $custom_fields['videolocation'][0]; 
					if (isset($custom_fields['_thumbnail_id'])) $imageid = $custom_fields['_thumbnail_id'][0]; 
					if (isset($custom_fields['sno_network_ads'])) $sno_network_ads = $custom_fields['sno_network_ads'][0]; 
					if (isset($custom_fields['sno_views'])) $sno_views = $custom_fields['sno_views'][0]; 

				if (has_post_thumbnail()) {
					$photographer = get_post_meta($imageid, 'photographer', true);
	   				$caption = get_post_field('post_excerpt', $imageid);
	   				if (isset($custom_fields['caption'])) $oldcaption = $custom_fields['caption'][0];
	   				if (isset($custom_fields['photographer'])) $oldphotographer = $custom_fields['photographer'][0];
	   			}
				
	   			get_best_of_sno_badge($custom_fields);

				if (get_theme_mod('story-bar') == 'Display') {
					echo '<div class="storycat"><span>';
						echo 'Filed under ';
                		the_category(', ');
                	echo '</span></div>';
                }                

				$categories = get_the_category();
				$title = get_the_title();
            	echo '<h1 id="storyheadline" class="storyheadline">' . $title . '</h1>';
            	
				if ($deck) {
					echo '<div class="storydeckbottom"></div>';
					echo '<div class="storydeck">';
					echo "<p>$deck</p>";
					echo '</div>';
				}
				if (get_theme_mod('story-byline-display') == 'Display' || get_theme_mod('story-date-display') == 'Display' || get_theme_mod('comments')=="Enable") {
	   				echo '<div id="storymeta" class="storymeta">';
	   				echo '<p>';
						if (get_theme_mod('story-byline-display') != 'Hide') {
	                   		$byline = snowriter(); if ($byline) { echo $byline; $bulletpoint = 'on'; }
 						}
 						if (get_theme_mod('story-date-display') != 'Hide') {   
            	       		echo '<span class="storydate">';	
            	       			if ($bulletpoint == 'on') echo '<span class="byline-divider">|</span>'; $bulletpoint = 'on';
	            	       		echo get_sno_timestamp(); 
							echo '</span>';
                   		}
                   		if (get_theme_mod('show-views') == 'Yes' && $sno_views > 1) { 
	                   		$sno_views = number_format ( $sno_views , 0, "." , "," );
                   			echo '<span class="snopostviews">'; if ($bulletpoint == 'on') { echo '<span class="byline-divider">|</span>'; } $bulletpoint = 'on'; 
                   				echo '<span class="sno_views">' . $sno_views . ' Views</span>'; 
                   			echo '</span>';
                   		} 
					echo '</p>';
	   				echo '</div>';
	   			}
				
				if ($imagelocation == "Slideshow of All Attached Images") {
					
					sno_sfi_story_page($post, $caption, $photographer);
				
				}
	   			
				if (($imagelocation == "Above Story") && (has_post_thumbnail())) {
					sno_get_single_image($post, $caption, $photographer);
					echo '<div class="clear"></div>';
					if ($photographer || $oldphotographer || $caption || $oldcaption) echo '<div class="captionboxmittop">';
					
					sno_photographer($wrap);
						   						
	   				if ($caption) { 
	   					echo '<p class="photocaption">'.$caption.'</p>'; 
	   				} else if ($oldcaption) { 
	   					echo '<p class="photocaption">'.$oldcaption.'</p>';
	   				}
					if ($photographer || $oldphotographer || $caption || $oldcaption) { echo '</div>'; } else { echo '<div class="photobottom"></div>'; }
				}
				
				if (($videolocation == "Above Story") && ($video)) {
					$pattern = "/height=\"[0-9]*\"/"; 
						$video = preg_replace($pattern, "", $video); 
						$pattern = "/width=\"[0-9]*\"/"; 
						$video = preg_replace($pattern, "", $video);
					echo '<div class="photowrap">';
					echo '<div class="videowrap"><div class="embedcontainer">' . $video . '</div></div>';
					sno_videographer($classname);
					echo '</div>';
				}
				
				
				$options = get_option('sno_analytics_options'); 

				if (((($videolocation == "Beside Story") || ($videolocation == "")) && ($video)) || ((($imagelocation == "") || ($imagelocation == "Beside Story") || ($imagelocation == "Yes")) && (has_post_thumbnail()))) {
                   
                   echo '<div class="permalinkphotobox">';
						
						if ((($imagelocation == "") || ($imagelocation == "Beside Story") || ($imagelocation == "Yes")) && (has_post_thumbnail())) {
							echo '<div class="storyshadow">';
							sno_get_single_image($post, $caption, $photographer);
							echo '<div class="clear"></div>';
							if ($photographer || $oldphotographer || $caption || $oldcaption) echo '<div class="captionboxmit">';

							sno_photographer($wrap);
	   						
	   						if ($caption) { 
	   							echo '<p class="photocaption">'.$caption.'</p>'; 
	   						} else if ($oldcaption) { 
	   							echo '<p class="photocaption">'.$oldcaption.'</p>';
	   						}
							if ($photographer || $oldphotographer || $caption || $oldcaption) { echo '</div>'; } else { echo '<div class="photobottom"></div>'; }
							echo '</div>';
						}


						if ((($videolocation == "") || ($videolocation == "Beside Story")) && ($video)) {
							$pattern = "/height=\"[0-9]*\"/"; 
								$video = preg_replace($pattern, "height='300'", $video); 
								$pattern = "/width=\"[0-9]*\"/"; 
								$video = preg_replace($pattern, "width='400'", $video);
							echo '<div class="videowrap storyshadow"><div class="embedcontainer">' . $video . '</div></div>';
							sno_videographer($classname);

						}
						if ($sno_network_ads == '' && get_theme_mod('sno_ad_network_full') != 'Off') echo sno_ad_network($ad = 'image', $styles);
				                 	   
                   	   echo '</div>';
					} else if ($options['sno_adbutler_analytics_activate'] == 'on' && get_theme_mod('sno_ad_network_full') != 'Off') {
						if ($sno_network_ads == '') echo sno_ad_network($ad = 'image',  $styles = 'adright');
					}

					sno_sharing_icons( $template = 'Full-Width', $location = 'Above');

					echo '<span class="storycontent">';
						the_content();
					echo '</span>';
					
					echo '<div class="clear"></div>';
					if(function_exists('email_link')) { email_link(); }
					sno_sharing_icons( $template = 'Full-Width', $location = 'Below');
					
					
					
					the_tags('<div class="storytags"><p>Tags: ', ', ', '</p></div>');

					echo sno_get_staff_profile_preview($postid);

        	endwhile; else: endif;
		
        if (get_theme_mod('comments')=="Enable") {
        	?><script>
        		$(document).ready(function() {
    				$("#commentsbox").click(function() {
    			    	$("#commentsbody").slideToggle('slow');
    			    	$("#expand").toggle();
    			    	$("#collapse").toggle();
    				});
				});				
        		$(document).ready(function() {
    				$("#commentslink").click(function() {
    			    	$("#commentsbody").slideDown('slow');
    			    	$("#expand").hide();
    			    	$("#collapse").show();
    				});
				});				
			</script><?php
			echo '<div class="clear"></div>';
			echo '<div id="commentswrap">';
			echo '<div class="widgetwrap"><div class="titlewrap cursorpoint" id="commentsbox"><div id="expand"><div class="fa fa-plus-square"></div></div><div id="collapse"><div class="fa fa-minus-square"></div></div><div class="widgettitle-nonsno">';
				comments_number( 'Leave a Comment', '1 Comment', '% Comments' );
				echo '</div></div><div id="commentsbody" class="widgetbody">';
            comments_template(); 
			echo '</div><div class="widgetfooter"></div></div>';   
			echo '</div>';  
        }

		echo '</div>';
		echo '<div class="clear"></div>';
		
		if (get_theme_mod('story-categories') == 'Display') {
			$relatedlist = sno_make_list(sno_extract_related_stories(get_the_content()));
			if ($relatedlist) echo sno_related_stories_list($relatedlist);		
			echo sno_other_stories_list();		
		}
        
    echo '</div>';
	
echo '</div>';
echo '</div>';

if (get_theme_mod('storybar-fullwidth') != 'Hide' && get_theme_mod('storybar-content') != 'Off') sno_get_teaserbar();

get_footer(); 

?>