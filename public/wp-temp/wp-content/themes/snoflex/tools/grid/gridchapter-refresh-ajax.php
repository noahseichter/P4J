<?php

function chapterrefresh_ajaxpost() {

	if ( isset ( $_POST['storyid'] ) ) $storyid = absint($_POST['storyid']); 
	if ( isset ( $_POST['parentid'] ) ) $parent_id = absint($_POST['parentid']); 
	$sno_grid_chapter_title = '';
	

			echo '<div id="gridchapcontainer" class="gridchapcontainer">';
						?>
							<script>
								$(document).ready(function() {
									$(function(){
           							$('#box-<?php echo $postid; ?>').click(function(){
										var storyid = '<?php echo $postid ?>';
										var parentid = '<?php echo $parent_id; ?>';
								        $("#gridchapcontainer").fadeOut();
								        $("#listloader").show();
               							$.ajax({
                				            url:"/wp-admin/admin-ajax.php",
                				            type:'POST',
                				            data:'action=chapterrefresh&parentid=' + parentid + '&storyid=' + storyid,
 	            				            success:function(results)
	            				            { $("#gridchapcontainer").replaceWith(results); $("#listloader").hide(); }
	           				    	  	});
	
										window.history.pushState("", "Title", "/?p=" + storyid);

	         						});

								});
								


								});

							</script><?php


			$args = array( 'p' => absint($_POST['storyid'] )); 
			$myposts = get_posts( $args ); global $post; 
			if ($myposts) { 
		
			foreach ($myposts as $post):	
					setup_postdata($post); 					
						$custom_fields = get_post_custom($post->ID); $postid = $post->ID;
							if (isset ($custom_fields['video'][0])) $video = $custom_fields['video'][0];
							if (isset ($custom_fields['videographer'][0]))$videographer = $custom_fields['videographer'][0];
							if (isset ($custom_fields['sno_deck'][0])) $deck = $custom_fields['sno_deck'][0]; 
							if (isset ($custom_fields['audio'])) $audio = $custom_fields['audio'][0];
								$audioplayer = '';
							if (isset ($custom_fields['featureimage'][0])) $imagelocation = $custom_fields['featureimage'][0]; 
							if (isset ($custom_fields['videolocation'][0])) $videolocation = $custom_fields['videolocation'][0]; 
							if (isset ($custom_fields['sno_longform_image'][0])) $sno_longform_image = $custom_fields['sno_longform_image'][0]; 
							if (isset ($custom_fields['sno_grid_chapter_title'][0])) $sno_grid_chapter_title = $custom_fields['sno_grid_chapter_title'][0]; 
							$imageid = get_post_thumbnail_id(); 
							$part = $post->ID;

						if (has_post_thumbnail()) {
	   						$caption = get_post_field('post_excerpt', $imageid);
							$photographer = get_post_meta($imageid, 'photographer', true);
	   					}


						echo '<div class="clear"></div>';
						echo '<div class="content main">';

						$title = get_the_title();
						if ($sno_grid_chapter_title == '') {
	            			echo '<h1 id="storyheadline" class="storyheadline">' . $title . '</h1>';
							echo '<div class="dividingline"></div>';
						}
						
						if ( isset ($imagelocation) && $imagelocation == "Slideshow of All Attached Images") { 

							sno_sfi_story_page($post, $caption, $photographer);
							echo '<div class="clear"></div>';
							
						} else if ((has_post_thumbnail()) && ( isset ($imagelocation) && $imagelocation == "Above Story")) {
	
							echo '<div class="clear"></div>';
							sno_get_single_image($post, $caption, $photographer);
							echo sno_photographer($wrap = null);
		   					echo '<p class="photocaption">'.$caption.'</p>'; 							
		
						} else {
							
							echo '<div class="clear"></div>';
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
						
						if ( isset ( $deck ) && $deck) {
							echo '<div class="storydeck">';
							echo '<p>' . $deck . '</p>';
							echo '</div>';
							echo '<div class="dividinglinedeck"></div>';
						}
														
						if (get_theme_mod('lf-byline-display') != 'Hide') {
							echo '<p class="byline">' . snowriter() . '</p>'; 
						}
                	
                		echo '<div class="leftside">';
            			edit_post_link('Edit This Chapter','<p>','</p>');

						if ((($videolocation == "Beside Story") && ($video)) || (( isset ($imagelocation) && $imagelocation == "Beside Story") && (has_post_thumbnail()) && ($sno_longform_image != "true"))) {

							echo '<div class="permalinkphotobox">';

	                		if ((has_post_thumbnail()) && ($imagelocation == "Beside Story") && ($sno_longform_image != "true")) {
                		
								sno_get_single_image($post, $caption, $photographer);
							
								echo '<div class="clear"></div>';
							

									sno_photographer($wrap = null);
	   						
	   								if ( isset ( $caption ) && $caption) { 
	   									echo '<p class="photocaption">'.$caption.'</p>'; 
	   								} else if ( isset ( $oldcaption ) && $oldcaption) { 
	   									echo '<p class="photocaption">'.$oldcaption.'</p>';
	   								}
								if ($photographer || $caption) { } else { echo '<div class="photobottom"></div>'; }
		               	
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
						echo '<div class="storybody">';
							echo '<span class="storycontent">';
								the_content();
							echo '</span>';


							echo sno_get_staff_profile_preview($postid);
						
						echo '</div>';					
						echo '</div>';	
						echo '</div>';

				endforeach; 
				}
				
				echo '</div>'; //gridchapcontainer
	
	die();
}

add_action('wp_ajax_chapterrefresh', 'chapterrefresh_ajaxpost');
add_action('wp_ajax_nopriv_chapterrefresh', 'chapterrefresh_ajaxpost'); 
