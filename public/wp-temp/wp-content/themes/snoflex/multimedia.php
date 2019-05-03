<?php
/*
Template Name: Multimedia Add-on Video
*/

get_header();


echo '<div id="multimediatemplate">';
echo '<div id="content">';

	echo '<div id="contentleftmm">';
	
		echo '<div class="postareamm mmwrap">';
		
			echo '<div id="loadingimage"><img src="' . get_template_directory_uri() . '/images/loading.gif" /></div>';

            	echo '<div id="moreposts">';
            	echo '<div id="videowrap">';

					$recent = new WP_Query("cat=".get_theme_mod('mm-video')."&showposts=1"); 
					while($recent->have_posts()) : $recent->the_post();	
					
						echo '<a class="headline mmheadline" href="' . get_permalink() . '" rel="bookmark"><h3>' . get_the_title() . '</h3></a>';

						$video = get_post_meta($post->ID, 'video', true); 
						if ($video) { 
							$pattern = "/height=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video); 
							$pattern = "/width=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video); 
							echo '<div class="videowrap"><div class="embedcontainer">' . $video . '</div></div>'; 
						}

						sno_videographer('mmcredit');
						
						$writer = get_post_meta($post->ID, 'writer', true); 
						if ($writer) echo '<p class="mmpermalink mmteaser"><a href="' . get_permalink() . '">Read full text</a> of accompanying story.</p>';

					endwhile;
					
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

									$catvariable = get_theme_mod('mm-video'); 
									$limitvariable = get_theme_mod('mm-video-count');
									$querystr = "
										SELECT * FROM $wpdb->posts
										LEFT JOIN $wpdb->postmeta AS video ON(
										$wpdb->posts.ID = video.post_id
										AND video.meta_key = 'video'
										AND video.meta_value != ''
										)
										LEFT JOIN $wpdb->term_relationships ON(
										$wpdb->posts.ID = $wpdb->term_relationships.object_id
										)
										LEFT JOIN $wpdb->term_taxonomy ON(
										$wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id
										)
										WHERE $wpdb->term_taxonomy.term_id = $catvariable
										AND $wpdb->term_taxonomy.taxonomy = 'category'
										AND $wpdb->posts.post_status = 'publish'
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
															data:'action=replace_video&type=video&id=' + videoid,
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
														echo '<img class="mmoverlay" src="' . get_template_directory_uri() . '/images/playbutton.png" /></div></a>';
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
															data:'action=replace_video&type=video&id=' + videoid,
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
													if ($thumbnail) {
														echo '<a href="#" onclick="return false" class="moreheadlines'.$videoid.'">';	
														echo '<div class="mmphoto" style="background:url('.$thumbnail[0].') no-repeat">';
														echo '<img class="mmoverlay" src="' . get_template_directory_uri() . '/images/playbutton.png" /></div></a>';
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
		
echo '</div>';
echo '</div>';

get_footer();


?>