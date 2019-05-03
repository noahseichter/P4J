<?php

get_header();
$unique_id = $post->ID;

echo "<div id='storyrails' class='sno-story-$unique_id'>";
echo '<div id="content">';

    echo '<div id="contentleft">';
    
        echo '<div class="postarea" style="position:relative;">';
                
            if (have_posts()) : while (have_posts()) : the_post();

				$custom_fields = get_post_custom($post->ID); $postid = $post->ID;
					$video = ''; $videographer = ''; $deck = ''; $audio = ''; $imagelocation = ''; $videolocation = ''; $imageid = ''; $railwriter = '';
					$sno_network_ads = ''; $photographer = ''; $caption = ''; $oldcaption = ''; $oldphotographer = '';
					if (isset($custom_fields['video'])) $video = $custom_fields['video'][0];
					if (isset($custom_fields['videographer'])) $videographer = $custom_fields['videographer'][0];
					if (isset($custom_fields['sno_deck'])) $deck = $custom_fields['sno_deck'][0];
					if (isset($custom_fields['audio'])) $audio = $custom_fields['audio'][0];
						$audioplayer = '';
					if (isset($custom_fields['featureimage'])) $imagelocation = $custom_fields['featureimage'][0]; 
					if (isset($custom_fields['videolocation'])) $videolocation = $custom_fields['videolocation'][0]; 
					if (isset($custom_fields['_thumbnail_id'])) $imageid = $custom_fields['_thumbnail_id'][0]; 
					if (isset($custom_fields['sno_rails_writer'])) $railwriter = $custom_fields['sno_rails_writer'][0]; 
					if (isset($custom_fields['sno_network_ads'])) $sno_network_ads = $custom_fields['sno_network_ads'][0]; 
					if (isset($custom_fields['sno_views'])) $sno_views = $custom_fields['sno_views'][0]; 

				if (has_post_thumbnail()) {
					$photographer = get_post_meta($imageid, 'photographer', true);
	   				$caption = get_post_field('post_excerpt', $imageid);
	   				if (isset($custom_fields['caption'])) $oldcaption = $custom_fields['caption'][0];
	   				if (isset($custom_fields['photographer'])) $oldphotographer = $custom_fields['photographer'][0];
	   			}
                
	   			get_best_of_sno_badge($custom_fields);

				$categories = get_the_category();
				$title = get_the_title();
            	echo '<h1 id="storyheadline" class="storyheadline">' . $title . '</h1>';
            	echo '<div class="clear"></div>';
				if ((get_theme_mod('story-byline-display') == 'Display') || (get_theme_mod('story-date-display') == 'Display')) {			
	   				echo '<div id="storymeta" class="storymeta">';
	   				echo '<p>';
						if (get_theme_mod('story-byline-display') != 'Hide') {
	                   		$byline = snowriter(); if ($byline) echo $byline; 
 						}
 						if (get_theme_mod('story-date-display') != 'Hide') {   
            	       		echo '<span class="storydate">';	
	            	       		echo get_sno_timestamp(); 
							echo '</span>';
                   		}
                   		if (get_theme_mod('show-views') == 'Yes' && $sno_views > 1) { 
	                   		$sno_views = number_format ( $sno_views , 0, "." , "," );
                   			echo '<span class="snopostviews sno_views">'; 
                   				echo $sno_views . ' Views';
                   			echo '</span>';
                   		} 
                   		if (get_theme_mod('comments')=="Enable") {
			   				echo '<a id="commentslink" class="commentscroll" href="' . get_comments_link() . '">';
			   				comments_number( 'Leave a Comment', '1 Comment', '% Comments' );
			   				echo '</a>';
			   			}
					echo '</p>';
	   				echo '</div>';
	   			}
				
				echo '<div id="leftrail">';
					sno_sharing_icons( $template = 'Side Rails', $location = 'Left Rail');
					if ($railwriter != 'Hide') echo sno_profile_teaser();
									
				
				echo '</div>';

			echo '<div id="story_column">';

	   			
				if ($imagelocation == "Slideshow of All Attached Images") {
	
					sno_sfi_story_page($post, $caption, $photographer);

				}
	   			
				if (($imagelocation == "Above Story") && (has_post_thumbnail())) {
							sno_get_single_image($post, $caption, $photographer);
							echo '<div class="clear"></div>';
							if ($photographer || $oldphotographer || $caption || $oldcaption) echo '<div class="captionboxmit">';

							echo '<div style="float:right;width:400px;">' . get_sno_photographer($wrap) . '</div><div class="clear"></div>';
	   						
	   						if ($caption) { 
	   							echo '<p class="photocaption" style="max-width:none;">'.$caption.'</p>'; 
	   						} else if ($oldcaption) { 
	   							echo '<p class="photocaption" style="max-width:none;">'.$oldcaption.'</p>';
	   						}
							if ($photographer || $oldphotographer || $caption || $oldcaption) { echo '</div>'; } else { echo '<div class="photobottom"></div>'; }
				}
				
				if (($videolocation == "Above Story") && ($video)) {
					$pattern = "/height=\"[0-9]*\"/"; 
						$video = preg_replace($pattern, "", $video); 
						$pattern = "/width=\"[0-9]*\"/"; 
						$video = preg_replace($pattern, "", $video);
					echo '<div class="photowrap" style="max-width:none;">';
					echo '<div class="videowrap"><div class="embedcontainer">' . $video . '</div></div>';
					sno_videographer($classname);
					echo '</div>';
				}
				

				if ($deck) {
					echo '<div class="storydeck">';
					echo '<p>' . $deck . '</p>';
					echo '</div>';
					echo '<div class="clear"></div>';
				}

					if ( ((($imagelocation == "") || ($imagelocation == "Beside Story") || ($imagelocation == "Yes")) && (has_post_thumbnail())) || ((($videolocation == "") || ($videolocation == "Beside Story")) && ($video)) ) {
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
					                 	   
						echo '</div>';
                   	
                   	}
					
					
						if ($sno_network_ads == '' && get_theme_mod('sno_ad_network_rails') != 'Off' && get_option('sno_analytics_options')['sno_adbutler_analytics_activate'] == "on") {
							echo '<div id="rightrail">';
								echo '<div id="sno_ad" style="min-height:1px;width:300px;">';
									echo sno_ad_network($ad = 'image', $styles = null);					
								echo '</div>';		
							echo '</div>';
						}		
					
					echo '<div class="storycontent">';
						the_content();
					echo '</div>';
					
						sno_sharing_icons( $template = 'Side Rails', $location = 'Below');

					
					echo '<div class="clear"></div>';
						the_tags('<div class="storytags"><p>Tags: ', ', ', '</p></div>');
						

						
				echo '</div>';
				
				echo '<div class="clear"></div>';

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
        	echo '<div id="comments" class="snoanimate" style="height:60px;display:block"></div>';
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

if (get_theme_mod('storybar-rails') != 'Hide' && get_theme_mod('storybar-content') != 'Off') sno_get_teaserbar();


get_footer(); 
?>