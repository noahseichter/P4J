<?php

get_header();
$unique_id = $post->ID;

echo "<div id='classic_story' class='sno-story-$unique_id'>";
echo '<div id="content">';

	$outer_padding = 30;
	$width1 = get_theme_mod('content-width');
	if ($width1 == '') $width1 = 980;
	$width1 -= 320;
	$width2 = $width1 - $outer_padding; $width2_px = $width2 . 'px';
	

    echo "<div id='contentleft'>";
    
        echo '<div class="postarea">';

            if (have_posts()) : while (have_posts()) : the_post();

				$custom_fields = get_post_custom($post->ID); $postid = $post->ID;
					$video = ''; $videographer = ''; $audio = ''; $deck = ''; $slideshow = ''; $gallery = ''; $slideshowcredit = '';
					$imagelocation = ''; $videolocation = ''; $slideshowlocation = ''; $related = ''; $imageid = ''; 
					$sno_sidebyside_list = ''; $teasertitle = ''; $teaser = ''; $grade = ''; $showratings = '';
					$photographer = ''; $caption = ''; $oldcaption = ''; $oldphotographer = ''; $other_story = ''; 
					
					if (isset($custom_fields['video'])) $video = $custom_fields['video'][0];
					if (isset($custom_fields['videographer'])) $videographer = $custom_fields['videographer'][0];
					if (isset($custom_fields['audio'])) $audio = $custom_fields['audio'][0];
						$audioplayer = '';
					if (isset($custom_fields['sno_deck'])) $deck = $custom_fields['sno_deck'][0];
					if (isset($custom_fields['slideshow'])) $slideshow = $custom_fields['slideshow'][0];
					if (isset($custom_fields['gallery'])) $gallery = $custom_fields['gallery'][0];
					if (isset($custom_fields['slideshowcredit'])) $slideshowcredit = $custom_fields['slideshowcredit'][0];
					if (isset($custom_fields['featureimage'])) $imagelocation = $custom_fields['featureimage'][0]; 
					if (isset($custom_fields['videolocation'])) $videolocation = $custom_fields['videolocation'][0]; 
					if (isset($custom_fields['slideshowlocation'])) $slideshowlocation = $custom_fields['slideshowlocation'][0]; 
					if (isset($custom_fields['related'])) $related = $custom_fields['related'][0]; 
					if (isset($custom_fields['_thumbnail_id'])) $imageid = $custom_fields['_thumbnail_id'][0]; 
					if (isset($custom_fields['sno_views'])) $sno_views = $custom_fields['sno_views'][0]; 

					if (isset($custom_fields['sno_sidebyside_list'])) $sno_sidebyside_list = $custom_fields['sno_sidebyside_list'][0]; 
					$relatedlist = '';
				
				if (has_post_thumbnail()) {
					$photographer = get_post_meta($imageid, 'photographer', true);
	   				$caption = get_post_field('post_excerpt', $imageid);
	   				if (isset($custom_fields['caption'])) $oldcaption = $custom_fields['caption'][0];
	   				if (isset($custom_fields['photographer'])) $oldphotographer = $custom_fields['photographer'][0];
	   			}
	   			
	   			do_action('sno_before_story');
	   			get_best_of_sno_badge($custom_fields);

            	echo '<h1 class="storyheadline">';
            		echo get_the_title();
            	echo '</h1>';

				if ($deck) {
					echo '<div class="storydeckbottom"></div>';
					echo '<div class="storydeck">';
					echo '<p>' . $deck . '</p>';
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
					echo '<div class="videowrap"><div class="embedcontainer">' . $video . '</div></div>';
					sno_videographer($classname);
				}
				           
            	echo '<div class="clear"></div>';

                   echo '<div class="permalinkphotobox">';

                       	if (((isset($teaser) && (isset($teaser) && $teaser)) || (isset($teasertitle) && $teasertitle)) && (isset ($aeaddon) && $aeaddon)) {
                          	echo '<div id="permalinkteaserbox">';
                             	if (isset($teasertitle) && $teasertitle) echo '<p class="teasertitle">' . $teasertitle . '</p>';
                             	if (isset($teaser) && $teaser) echo '<p class="teasertext">' . $teaser . '</p>';
                             	if (isset($grade) && $grade) echo '<p class="teasergrade">Our Rating: ' .  $grade . '</p>';
                             	if (isset($audio) && $audio) {
                             		$audioplayer = "[audio mp3=" . $audio . "]";
                             		echo '<div class="audiobox">';
                             		echo do_shortcode($audioplayer); 
                             		echo '</div>';
                             	}  
                         	echo '</div>';

							if (isset($showratings) && $showratings=="Yes") { 
								echo '<div class="clear"></div>';
								echo '<div class="ratingsbox">';
									echo '<p class="teasertitle">What\'s Your Rating of ' . $teasertitle . '?</p>';
									if (function_exists('wp_gdsr_render_article')) { wp_gdsr_render_article(10); }
								echo '</div>';
								echo '<div class="clear"></div>';
							}

						}
						
						if ($imagelocation == "" || $imagelocation == "Yes" || $imagelocation == "Beside Story") {
						

								if (has_post_thumbnail()) { 
									sno_get_single_image($post, $caption, $photographer);
								}
								
								
							echo '<div class="clear"></div>';
							if ((isset($photographer) && $photographer) || (isset ($oldphotographer) && $oldphotographer) || (isset($caption) && $caption) || (isset($oldcaption) && $oldcaption)) echo '<div class="captionboxmit">';

							sno_photographer($wrap = null);
	   						
	   						if (isset ($caption) && $caption) { 
	   							echo '<p class="photocaption">'.$caption.'</p>'; 
	   						} else if (isset($oldcaption) && $oldcaption) { 
	   							echo '<p class="photocaption">'.$oldcaption.'</p>';
	   						}
							if ((isset($photographer) && $photographer) || (isset ($oldphotographer) && $oldphotographer) || (isset($caption) && $caption) || (isset($oldcaption) && $oldcaption)) { echo '</div>'; } else { echo '<div class="photobottom"></div>'; }
						
						
						
						}



						if ((($videolocation == "") || ($videolocation == "Beside Story")) && ($video)) {
							$pattern = "/height=\"[0-9]*\"/"; 
								$video = preg_replace($pattern, "height='250'", $video); 
								$pattern = "/width=\"[0-9]*\"/"; 
								$video = preg_replace($pattern, "width='300'", $video);
							echo '<div class="videowrap"><div class="embedcontainer">' . $video . '</div></div>';
							sno_videographer($classname);

						}
				
                 	   
						if ($sno_sidebyside_list) {
                   			$other_story = sno_other_story($post->ID, $sno_sidebyside_list);
                   			if ($other_story) echo do_shortcode("[related align='right' title='Related Story' stories='$other_story' sidebyside='$sno_sidebyside_list']");
						}

                   	echo '</div>';

                   	echo '<div class="storydetails"><p>';
						if (get_theme_mod('story-byline-display') != 'Hide') {
							$byline = snowriter(); if ($byline) echo '<span class="storybyline">' . $byline . '</span><br />';
						}
               			echo '<span class="storydate">';
                   		if (get_theme_mod('story-date-display') != 'Hide') {
                   			echo get_sno_timestamp(); 
                   		}
                   		if (get_theme_mod('show-views') == 'Yes' && $sno_views > 1) { 
	                   		$sno_views = number_format ( $sno_views , 0, "." , "," );
                   			echo '<span class="byline-divider">|</span><span class="sno_views">' . $sno_views . ' Views</span>'; 
                   		} 
               			echo '</span>';
						if (get_theme_mod('story-bar') == 'Display') {
                   			echo '<br /><span class="storycategory">Filed under ';
                   			the_category(', ');
                   			echo '</span>';
                   		}
                   	echo '</p></div>';

                   	if ($sno_sidebyside_list && !isset($other_story)) {
                   		$other_story = sno_other_story($post->ID, $sno_sidebyside_list);
                   		echo do_shortcode("[related align='right' title='Related Story' stories='$other_story' sidebyside='$sno_sidebyside_list']");
					}
					
					sno_sharing_icons( $template = 'Classic', $location = 'Above');
					
					echo '<span class="storycontent">';
						the_content();
					echo '</span>';
					sno_sharing_icons( $template = 'Classic', $location = 'Below');

						$relatedlist = sno_make_list(sno_extract_related_stories(get_the_content()));
						if ($other_story) {
							if ($relatedlist) $relatedlist .= ',';
							$relatedlist .= $other_story.','.$sno_sidebyside_list;
							}
						if ($relatedlist) echo sno_related_stories_list($relatedlist);	

					
					echo '<div class="clear"></div>';
            		echo '<div class="postmeta">';
						the_tags('<p><span class="tags sno">Tags: ', ', ', '</span></p>');
					echo '</div>';
					
					echo sno_get_staff_profile_preview($postid);


        	endwhile; else: endif;
		
		echo '</div>';

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
        	echo '<div id="comments" class="sno-animate" style="height:60px;display:block"></div>';
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
	
	include(TEMPLATEPATH."/sidebar.php");

echo '</div>';
echo '</div>';

if (get_theme_mod('storybar-sidebar') != 'Hide' && get_theme_mod('storybar-content') != 'Off') sno_get_teaserbar();
	             	
get_footer(); 
?>