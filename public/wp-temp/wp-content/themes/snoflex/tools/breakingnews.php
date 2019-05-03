				<script type="text/javascript">
					$(document).ready(function() {
						$(".newsticker3-jcarousellite").jCarouselLite({
        					<?php echo get_theme_mod('breaking-scroll-style'); ?>: true,
        					visible: 1,
        					auto:<?php if (get_theme_mod('breakingnews-scrollbox')=="1") { echo '0'; } else { echo get_theme_mod('breakingnews-speed'); } ?>,
        					speed:<?php echo get_theme_mod('breakingnews-transition'); ?>
    					});
					});
				</script><?php 
				
				$exitkey = '';

				if (get_theme_mod('breaking-recent') == "All Recent Posts") {
					$count = 1; 
					$args = array( 
						'showposts' => get_theme_mod('breakingnews-scrollbox'), 
						'cat' => '-'.get_theme_mod('breaking-hidecat')
					);
					query_posts($args); while (have_posts()) : the_post();
	
					if ($count==1) { $exitkey=6; 

						echo '<div class="breakingnewswrap">';
							echo '<div id="breakingnews">';
    							echo '<div id="newsticker3-demo">';
        							echo '<div class="newsticker3-jcarousellite">';
        								echo '<ul>';
					} 
                
                							echo '<li>';
                								echo '<div class="info">';
													echo '<p>';
                  										if (get_theme_mod('breakingnews-date')=="Show") { 
                  												if (get_theme_mod('breakingnews-time')=='Show') { 
		                    										echo '<span class="bndate">' . get_the_time('M j, g:i a') . '</span>';
                  												} else {
		                    										echo '<span class="bndate">' . get_the_time('F j') . '</span>';
		                    									}
	            										}
														echo '<span class="breakingnewsheadline">';
															echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
                    										$edit_link = get_edit_post_link();
                    										if ($edit_link) echo ' <a href="' . $edit_link . '"> (Edit This) </a>';
														echo '</span>';
                    								echo '</p>';
                								echo '</div><div class="clear"></div>';
            								echo '</li>';

											$count++;
					
					endwhile;
					wp_reset_query();
					
					if ($exitkey==6) { $exitkey=0;
					
										echo '</ul>';
    								echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
	
					} 

				} else {
					$count = 1; 
					$args = array(
						'post__not_in' => get_option('sticky_posts'),
						'ignore_sticky_posts'=> 1,
						'meta_key'=> 'breakingnewsheadline',
						'showposts'=> get_theme_mod('breakingnews-scrollbox')
					); 
					query_posts($args); while (have_posts()) : the_post(); 
						
						$headline = get_post_meta($post->ID, 'breakingnewsheadline', true); 
						$breakingnewslink = get_post_meta($post->ID, 'breakingnewslink', true); 

						if ($count==1) { $exitkey=6;

							echo '<div class="breakingnewswrap">';
								echo '<div id="breakingnews">';
									echo '<div id="newsticker3-demo">';   
										echo '<div class="newsticker3-jcarousellite">';
        									echo '<ul>';
						}
												echo '<li>';
                									echo '<div class="info">';
														echo '<p>';
                  											if (get_theme_mod('breakingnews-date')=="Show") { 
                  												if (get_theme_mod('breakingnews-time')=='Show') { 
		                    										echo '<span class="bndate">' . get_the_time('M j, g:i a') . '</span>';
                  												} else {
		                    										echo '<span class="bndate">' . get_the_time('F j') . '</span>';
		                    									}
	            											}
                    										if ($breakingnewslink) { 
                    											echo "<span class='breakingnewsheadline'><a href='$breakingnewslink'>$headline</a>";
                    											$edit_link = get_edit_post_link();
                    											if ($edit_link) echo ' <a href="' . $edit_link . '"> (Edit This) </a>';
                    											echo '</span>';
                    										} else { 
                    											echo "<span class='breakingnewsheadline'>$headline";
                    											$edit_link = get_edit_post_link();
                    											if ($edit_link) echo ' <a href="' . $edit_link . '"> (Edit This) </a>';
                    											echo '</span>';
															}
														echo '</p>';
													echo '</div><div class="clear"></div>';
												echo '</li>';

												$count++;
												
						endwhile;
						wp_reset_query();
						
						if ($exitkey==6) { $exitkey=0;

											echo '</ul>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
							echo '<div class="clear"></div>';

						}

				} 
