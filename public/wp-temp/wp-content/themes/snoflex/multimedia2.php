<?php
/*
Template Name: Multimedia Add-on Slideshows
*/

get_header();

echo '<div id="content">';

	echo '<div id="contentleftmm">';
	
		echo '<div class="postarea mmwrap" style="position:relative;">';

			echo '<div id="loadingimage" class="spinner" style="display:block;position:absolute;margin-top:0;top:250px;left:350px;">
									<div class="bounce1"></div>
									<div class="bounce2"></div>
									<div class="bounce3"></div>
									</div>';

            	echo '<div id="moreposts">';
            	echo '<div id="videowrap">';

 					$querystr = "
						SELECT * FROM $wpdb->posts
						JOIN $wpdb->postmeta AS featureimage ON(
						$wpdb->posts.ID = featureimage.post_id
						AND featureimage.meta_key = 'featureimage'
						AND featureimage.meta_value = 'Slideshow of All Attached Images'
						)
						WHERE $wpdb->posts.post_status = 'publish'
						ORDER BY post_date DESC LIMIT 1
    					";
 					$pageposts = $wpdb->get_results($querystr, OBJECT);
 					
					if ($pageposts):
						foreach ($pageposts as $post):
							global $post; $caption = ''; $photographer = '';
							setup_postdata($post);
							echo '<a class="headline mmheadline" href="' . get_permalink() . '" rel="bookmark">';
							echo '<h3>' . get_the_title() . '</h3>';
							echo '</a>';
							$custom_fields = get_post_custom($post->ID);
							if (isset($custom_fields['_thumbnail_id'])) $imageid = $custom_fields['_thumbnail_id'][0]; 
							if (has_post_thumbnail()) {
								$photographer = get_post_meta($imageid, 'photographer', true);
								$caption = get_post_field('post_excerpt', $imageid);
							}

							sno_sfi_story_page($post, $caption, $photographer, $widget = 'true');																
							
						endforeach; 
					else : endif;
					
				echo '</div>';	
				echo '</div>';

		echo '</div>';

	echo '</div>';

	echo '<div id="sidebarmm">';

		echo '<div class="widgetwrap mmscroller">';

			echo '<div class="widgetbody mmwidget">';
				
				echo '<div class="carousel vertical">';
					echo '<div class="prev uparrow"></div>';
						echo '<div class="videolist">';
							echo '<ul>';
								echo '<div class="multimediaboxline"></div>';
									$limitvariable = get_theme_mod('mm-slideshow-count'); 
 									$querystr = "
										SELECT * FROM $wpdb->posts
										JOIN $wpdb->postmeta AS featureimage ON(
										$wpdb->posts.ID = featureimage.post_id
										AND featureimage.meta_key = 'featureimage'
										AND featureimage.meta_value = 'Slideshow of All Attached Images'
										)
										WHERE $wpdb->posts.post_status = 'publish'
										ORDER BY post_date DESC LIMIT $limitvariable
    									";
 									$pageposts = $wpdb->get_results($querystr, OBJECT);


									if ($pageposts):
										foreach ($pageposts as $post):
											global $post;
											setup_postdata($post);
											$videoid= get_the_ID();
											
											?><script type="text/javascript">
												$(function(){
													$('.moreheadlines<?php echo $videoid; ?>').click(function(){
														var videoid = <?php echo $videoid; ?>;
														$("#loadingimage").show();
														$("#videowrap").fadeOut();
														$.ajax({
															url:"/wp-admin/admin-ajax.php",
															type:'POST',
															data:'action=replace_video&type=slideshow&id=' + videoid,
															success:function(results) { 
																$("#moreposts").replaceWith(results); 
																$("#loadingimage").hide();
															}
	                 									});
													});
												});
											</script><?php

											echo '<li style="padding-left:0px;margin-top:0px;">';
												echo '<div class="multimediabox">';
													$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'carouselthumb'); 
													if ($thumbnail) {
														echo '<a href="#" onclick="return false" class="moreheadlines'.$videoid.'">';	
														echo '<div class="mmphoto" style="background:url('.$thumbnail[0].') no-repeat">';
														echo '<img class="mmoverlay" src="' . get_template_directory_uri() . '/images/playbutton.png" />';
														echo '</div></a>';
														
													} else {
													
													}
													
                      								echo '<p>'; the_time('F j, Y'); echo '</p>';
													echo '<p><a href="#" onclick="return false" class="moreheadlines'.$videoid.'">';
													the_title();
													echo '</a></p>';
													echo '<div class="clear"></div>';
												echo '</div>';
												echo '<div class="multimediaboxline"></div>';
											echo '</li>';

										endforeach; 
									else : endif;

							echo '</ul>';
						echo '</div>';
					echo '<div class="multimediaboxline"></div>';
					echo '<div class="next downarrow"></div>';
				echo '</div>';
			echo '</div>';
			echo '<div class="widgetfooter"></div>';
		echo '</div>';

		?><script type="text/javascript">
				$(function() {
					$(".videolist").jCarouselLite({
       					vertical: true,
        				visible: 5,
       					auto: 0,
       					speed: 666,
						scroll: 1,
				        btnNext: ".vertical .next",
       					btnPrev: ".vertical .prev"						    
       				});
				});
		</script><?php

	echo '</div>';
		echo '<div class="mmmobile">';
	
									if ($pageposts):
										foreach ($pageposts as $post):
											global $post;
											setup_postdata($post);
											$videoid= get_the_ID();
											
											?><script type="text/javascript">
												$(function(){
													$('.moreheadlines<?php echo $videoid; ?>').click(function(){
														var videoid = <?php echo $videoid; ?>;
														$("#loadingimage").show();
														$("#videowrap").fadeOut();
														$.ajax({
															url:"/wp-admin/admin-ajax.php",
															type:'POST',
															data:'action=replace_video&type=slideshow&id=' + videoid,
															success:function(results) { 
																$("#moreposts").replaceWith(results); 
																$("#loadingimage").hide();
															}
	                 									});
													});
												});
											</script><?php

												echo '<div class="multimediamobilebox">';
													$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'carouselthumb'); 
													$slideshow = get_post_meta($post->ID, 'slideshow', true);
													if ($slideshow == "") $slideshow = get_post_meta($post->ID, 'gallery', true);
													if ($thumbnail) {
														echo '<a href="#" onclick="return false" class="moreheadlines'.$videoid.'">';	
														echo '<div class="mmphoto" style="background:url('.$thumbnail[0].') no-repeat">';
														echo '<img class="mmoverlay" src="' . get_template_directory_uri() . '/images/playbutton.png" />';
														echo '</div></a>';
														
													} else {

														echo '<a href="#" onclick="return false" class="moreheadlines'.$videoid.'">';	
														echo '<div class="mmphoto">';

														echo '<img class="mmoverlay" src="' . get_template_directory_uri() . '/images/playbutton.png" />';
														echo '</div></a>';
													
													}
													
                      								echo '<p>'; the_time('F j, Y'); echo '</p>';
													echo '<p><a href="#" onclick="return false" class="moreheadlines'.$videoid.'">';
													the_title();
													echo '</a></p>';
													echo '<div class="clear"></div>';
												echo '</div>';

										endforeach; 
									else : endif;

		echo '</div>';
		
echo '</div>';

get_footer();
