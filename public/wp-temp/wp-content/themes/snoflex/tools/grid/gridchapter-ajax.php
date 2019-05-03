<?php

function gridchapter_ajaxpost() {

	if ( isset ( $_POST['storyid'] ) ) $storyid = absint($_POST['storyid']); 
	if ( isset ( $_POST['parentid'] ) ) $parent_id = absint($_POST['parentid']); 
	
	echo '<div class="gridcontainer" id="gridcontainer">';
		echo '<div id="grid-chapter-row" class="flexslider">';
			echo '<ul class="slides">';
		
					global $wpdb; $o = ''; $selected = ''; $return_box_count = 0; $return_image = '';
					$querystr = "
						SELECT * FROM $wpdb->posts
						JOIN $wpdb->postmeta AS sno_format ON(
						$wpdb->posts.ID = sno_format.post_id
						AND sno_format.meta_key = 'sno_format'
						AND sno_format.meta_value = 'Grid Chapter'
						)
						JOIN $wpdb->postmeta AS sno_grid_list ON(
						$wpdb->posts.ID = sno_grid_list.post_id
						AND sno_grid_list.meta_value = '$parent_id'
						)
						JOIN $wpdb->postmeta AS sno_grid_order ON(
						$wpdb->posts.ID = sno_grid_order.post_id
						AND sno_grid_order.meta_key = 'sno_grid_order'
						)
						WHERE $wpdb->posts.post_status = 'publish'
						ORDER BY CAST(sno_grid_order.meta_value AS UNSIGNED INTEGER ) ASC, post_date DESC
						";


 					$pageposts = $wpdb->get_results($querystr, OBJECT); 
 					
 					$count = count($pageposts); 
 					if ($count >= 9) {
 						$return_box_style = "width:32.5%;height: 24px;";
 					} else {
 						$return_box_style = "width:49%;height: 37px;";
 					}  
 					
 					if ($count < 10) {
 						$totalteasers = $count + 1;
 						$teaserwidth = floor($totalteasers * 123);
 						$teaserwidth .= 'px';
 						echo "<style>
 								#sno_longform #grid-chapter-row { max-width: $teaserwidth !important; margin: 0 auto; }
 							</style>";
 					}

				if ($pageposts): 
					foreach ($pageposts as $post):
						setup_postdata($post);
					
						$custom_fields = get_post_custom($post->ID);
							$imageid = get_post_thumbnail_id($post->ID); 
							$postid = $post->ID;
							$storylink = get_permalink($post->ID);
							$selcted = '';
							
						if ($post->ID == $storyid) $selected = 'gridselected';

							$o .= "<li>";
							$o .= "<div id='box-$postid' class='gridchaptersmall $selected' style='position:relative'>"; $selected = '';
								$fullimage = wp_get_attachment_image_src( $imageid, 'tsmediumblock'); 

									if ($fullimage[0]) {
										$o .= '<img src="' . $fullimage[0] . '" style="width:100%;" alt="' . get_the_title() . '" />'; 
									} else {
										$o .= '<div style="background: #000;width: 100%; height: 100%;overflow: hidden;">';
										$o .= '<p class="photofallback">';
										$o .= get_the_title($post->ID);
										$o .= '</p></div>';
									}
								$return_box_count++;
								
								if (($count >= 9 && $return_box_count <= 9) || ($count >= 4 && $return_box_count <= 4)) {
									if ($fullimage[0]) {
										$return_image .= '<img src="' . $fullimage[0] . '" style="'.$return_box_style.'margin-right:1px;margin-bottom: 1px;float:left">';
									} else {
										$return_image .= '<div style="'.$return_box_style.'background: #000;margin-right:1px;margin-bottom: 1px;float:left"></div>';
									}
								}
		
							$o .= '</div>';
							$o .= '</li>';	                	
					
						?>
							<script>
								$(document).ready(function() {
    							
    							$("#box-<?php echo $postid; ?>").mouseenter(function() {
   							    // 	$("#box-<?php echo $postid; ?>-hover").slideDown();
   							     	$("#box-<?php echo $postid; ?>").addClass( "gridhover" );
   							 	}).mouseleave(function() {
  							     // $("#box-<?php echo $postid; ?>-hover").slideUp();
   							     	$("#box-<?php echo $postid; ?>").removeClass( "gridhover" );
  							  	});
  							  	
  								$('#grid-chapter-row').flexslider({
    								animation: "slide",
      								animationLoop: true,
      								controlNav: false,
      								directionNav: true,
      								slideshow: false,
      								itemMargin: 0,
      								touch: true,
      								itemWidth: 123,
      								minItems: 2,
      								move: 2,
      								maxItems: 12
    							});
								
								$(function(){
           							$('#box-<?php echo $postid; ?>').click(function(){
										var storyid = '<?php echo $postid ?>';
								        $("#gridchapcontainer").fadeOut();
	   							     	$(".gridchaptersmall").removeClass( "gridselected" );
	   							     	$("#box-<?php echo $postid; ?>").addClass( "gridselected" );
								        $("#listloader").show();
               							$.ajax({
                				            url:"/wp-admin/admin-ajax.php",
                				            type:'POST',
                				            data:'action=chapterrefresh&&storyid=' + storyid,
 	            				            success:function(results)
	            				            { $("#gridchapcontainer").replaceWith(results); $("#listloader").hide(); }
	           				    	  	});
	           				    	  	
	           				    	  	window.history.pushState("", "Title", "/?p=" + storyid);

	         						});
								});

								});

							</script><?php
						
					endforeach;  
// create link to return to main grid page

							echo "<li>";
							echo "<a href='/?p=$parent_id'><div id='box-return' class='gridchaptersmall returntogrid' style='position:relative;height: 75px; overflow: hidden;'>"; 
								if ($return_image) {
									echo $return_image;
								} else {
									echo '<div style="background: #000;color: #fff; width:100%; height: 75px;"><div class="fa fa-arrow-left" style="font-size:65px;line-height:70px;padding-left:30px;"></div></div>';
								}
							echo '</div></a>';
							echo '</li>';	 
							
							echo $o;               	

					
				else : endif; 
				wp_reset_query();
				echo '</ul>';
			echo '</div>'; //grid-chapter-row



			$args = array( 'p' => absint($_POST['storyid']) ); 
			$myposts = get_posts( $args ); global $post; 
			if ($myposts) { 
				echo '<div class="gridchapcontainer" id="gridchapcontainer">';
					
							
			foreach ($myposts as $post):	
				
					setup_postdata($post); 
						
						$custom_fields = get_post_custom($post->ID);
							$video = $custom_fields['video'][0];
							$videographer = $custom_fields['videographer'][0];
							$deck = $custom_fields['sno_deck'][0];
							$audio = $custom_fields['audio'][0];
								$audioplayer = '';
							$imagelocation = $custom_fields['featureimage'][0]; 
							$videolocation = $custom_fields['videolocation'][0]; 
							$sno_longform_image = $custom_fields['sno_longform_image'][0]; 
							$sno_grid_chapter_title = $custom_fields['sno_grid_chapter_title'][0]; 
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
							
						if ($imagelocation == "Slideshow of All Attached Images") {
	
							sno_sfi_story_page($post, $caption, $photographer);
							echo '<div class="clear"></div>';
							
						} else if ((has_post_thumbnail()) && ($imagelocation == "Above Story")) {
	
							echo '<div class="clear"></div>';
							sno_get_single_image($post, $caption, $photographer);
							echo sno_photographer($wrap);
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
				
						
						if ($deck) {
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

						if ((($videolocation == "Beside Story") && ($video)) || (($imagelocation == "Beside Story") && (has_post_thumbnail()) && ($sno_longform_image != "true"))) {

							echo '<div class="permalinkphotobox">';

	                		if ((has_post_thumbnail()) && ($imagelocation == "Beside Story") && ($sno_longform_image != "true")) {
                		
							sno_get_single_image($post, $caption, $photographer);
							
								echo '<div class="clear"></div>';
							

									sno_photographer($wrap = null);
	   						
	   								if (isset ($caption) && $caption) { 
	   									echo '<p class="photocaption">'.$caption.'</p>'; 
	   								} else if (isset ($oldcaption) && $oldcaption) { 
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
							
							echo sno_get_staff_profile_preview($part);


						echo '</div>';					
						echo '</div>';	
						echo '</div>';

				endforeach; 
				
				echo '</div>'; //gridchapcontainer
				}

	echo '</div>'; //gridcontainer
	
	die();
}

add_action('wp_ajax_gridchapter', 'gridchapter_ajaxpost');
add_action('wp_ajax_nopriv_gridchapter', 'gridchapter_ajaxpost'); 
