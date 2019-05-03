<?php $mobile = ''; $detect = new SNO_Mobile_Detect; if( $detect->isMobile() || $detect->isTablet() ) $mobile = 1; ?>
			<div id="carouselwrap">
            <?php $count = 0; query_posts('meta_key=_thumbnail_id&showposts=10&cat='.get_theme_mod('featured-cat')); ?> 
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php $postid = $post->ID; $customlink=get_post_meta($post->ID, 'customlink', true); $sno_teaser = get_post_meta($post->ID, 'sno_teaser', true); ?>
			<?php if ($count==0) { ?>
			<?php if (has_post_thumbnail()) 
				{ $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
    			<?php if ( $image[1] >= 300 && $image[2] >= 200 ) { $count++; ?>
			    <?php $height_fallback = ''; if ($image[2] < 315 || ($image[1]/$image[2] > 1.5)) $height_fallback = ' min-height:315px;'; ?>
			<div class="topboxleftwide">			
			<div class="photocontainer3" id="box<?php echo $postid; ?>">
							<a href="<?php if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { echo $customlink; } else { the_permalink(); } ?>"><img src="<?php echo $image[0]; ?>" style="width:100%;<?php echo $height_fallback; ?>" class="catboxphoto" id="grow-<?php echo $postid; ?>" alt="<?php the_title(); ?>" /></a> 
				<?php $photosuccess = 3; ?>
    		<a href="<?php if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { echo $customlink; } else { the_permalink(); } ?>"><div <?php if ($photosuccess == 3) { ?>id="box<?php echo $postid; ?>-hover" <?php } else { ?>style="display:block!important;" <?php } ?>class="topboxsmallwideoverlay">
					<?php if (get_theme_mod('top-stories-hide-cat')=="No") { ?>
    								<?php $categories = get_the_category(); $cat_list = array();
										foreach($categories as $category)  {  	
											if ($category->term_id != get_theme_mod('featured-cat')) $cat_list[] = $category->term_id;							
										}
    									$cat_list = array_filter($cat_list); $co = '';
												if ($cat_list[0] && get_theme_mod('top-stories-hide-cat') == 'No') {
													foreach ($cat_list as $cat) {
														if ($co) $co .= ', ';
														$co .= get_cat_name($cat);
													}
													echo '<div class="topstorycat" style="margin-top: 5px;margin-bottom:15px;text-align:center;">';
														echo '<span class="blockscat">';
															echo $co;
														echo '</span>';
													echo '</div>';

												} else {
													echo '<div class="topstorycat"style="margin-top: 15px;text-align:center;"></div>';
												} ?>
					<?php } ?>
			<h3 class="maingridheadline"><?php the_title(); ?></h3>
					<?php if (get_theme_mod('top-stories-hide-date')=="No") { ?>
						<p class="tsdatetime"><?php the_time('F j, Y'); ?></p>
					<?php } ?>
					<?php $contentteaser = get_theme_mod('top-stories-teaser'); ?>
			</div></a>
			</div>
			</div>
	<style>
	#box<?php echo $postid; ?> { z-index: 3;float: left;position: relative;}
	#box<?php echo $postid; ?>-hover { position: absolute;top: 0px;left: 0px;z-index: 6;}
	</style>
<?php if ($mobile == '' || get_theme_mod('top-stories-mobile-override') == "On") { ?>
	<script>
	$(document).ready(function() {
    	$("#box<?php echo $postid; ?>").mouseenter(function() {
   			$("#grow-<?php echo $postid; ?>").removeClass('shrink');
   			$("#grow-<?php echo $postid; ?>").removeClass('grow');
        	$("#box<?php echo $postid; ?>-hover").fadeIn();
   			$("#grow-<?php echo $postid; ?>").addClass('grow');
    	}).mouseleave(function() {
        	$("#box<?php echo $postid; ?>-hover").fadeOut();
   			$("#grow-<?php echo $postid; ?>").addClass('shrink');
    	});
	});</script>
<?php } else { ?>
	<script>
		$(document).ready(function() {
        	$("#box<?php echo $postid; ?>-hover").fadeIn();
		});
	</script>
	<style>
		.topboxsmallwideoverlay { background: none; }
		.topboxleft h3, .topboxleftwide h3, .topboxsmall h3, .topboxsmallwide h3 { background: url('/wp-content/themes/snoflex/images/topback.png'); }
		.topboxsmall h3 { padding-top: 7px; padding-bottom:7px; }
	</style>
<?php } ?>
			<?php }}} else if ($count < 5) { ?>
			
			<?php if (has_post_thumbnail()) 
				{ $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); ?>
    			<?php if ( $image[1] >= 200 && $image[2] >= 100 ) { $count++; ?>
    			<?php $border = ''; if ($count == 2 || $count == 3) $border = ' tbbottomborder';  ?>
			    <?php $height_fallback = ''; if ($image[2] < 160 || ($image[1]/$image[2] > 1.5)) $height_fallback = ' min-height:160px;'; ?>
			    
				<div class="topboxsmallwide blocksleftborder <?php echo $border; if ($count > 3) echo ' hidebox'; ?>">
					<div class="photocontainer2" id="box<?php echo $postid; ?>">
						<?php if (has_post_thumbnail()) { 
							$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); ?>
							<a href="<?php if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { echo $customlink; } else { the_permalink(); } ?>"><img src="<?php echo $image[0]; ?>" style="width:100%;height:auto;<?php echo $height_fallback; ?>" class="catboxphoto" id="grow-<?php echo $postid; ?>" alt="<?php the_title(); ?>" /></a> 
							<?php $photosuccess = 3; } ?>
							<?php if ($photosuccess == 3) { ?><div id="boxback<?php echo $postid; ?>" class="topboxsmallwidehover"></div><?php } ?>
							<a href="<?php if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { echo $customlink; } else { the_permalink(); } ?>">
    							<div <?php if ($photosuccess == 3) { ?>id="box<?php echo $postid; ?>-hover" <?php } else { ?>style="display:block!important;" <?php } ?> class="topboxsmallwideoverlay">
    								<?php $categories = get_the_category(); $cat_list = array();
										foreach($categories as $category)  {  	
											if ($category->term_id != get_theme_mod('featured-cat')) $cat_list[] = $category->term_id;							
										}
    									$cat_list = array_filter($cat_list); $co = '';
												if (isset($cat_list[0]) && $cat_list[0] && get_theme_mod('top-stories-hide-cat') == 'No') {
													foreach ($cat_list as $cat) {
														if ($co) $co .= ', ';
														$co .= get_cat_name($cat);
													}
													echo '<div class="topstorycat" style="margin-top: 5px;margin-bottom:15px;text-align:center;">';
														echo '<span class="blockscat">';
															echo $co;
														echo '</span>';
													echo '</div>';

												} else {
													echo '<div class="topstorycat"style="margin-top: 15px;text-align:center;"></div>';
												} ?>
									<h3 class="headline" style="text-align:center;font-size:16px;line-height:22px;"><?php the_title(); ?></h3>
									<p class="tssdatetime" style="text-align:center;padding-top:10px;"><?php the_time('F j, Y'); ?></p>
								</div>
							</a>
					</div>
				</div>
	<style>
	#box<?php echo $postid; ?> { z-index: 3; float: left; position: relative; }
	#box<?php echo $postid; ?>-hover { position: absolute;top: 0px;left: 0px;z-index: 6;}
	</style>
<?php if ($mobile == '' || get_theme_mod('top-stories-mobile-override') == "On") { ?>
	<script>
	$(document).ready(function() {
    	$("#box<?php echo $postid; ?>").mouseenter(function() {
   			$("#grow-<?php echo $postid; ?>").removeClass('shrink');
   			$("#grow-<?php echo $postid; ?>").removeClass('grow');
        	$("#box<?php echo $postid; ?>-hover").fadeIn();
   			$("#grow-<?php echo $postid; ?>").addClass('grow');
    	}).mouseleave(function() {
        	$("#box<?php echo $postid; ?>-hover").fadeOut();
   			$("#grow-<?php echo $postid; ?>").addClass('shrink');
    	});
	});</script>
<?php } else { ?>
	<script>
		$(document).ready(function() {
        	$("#box<?php echo $postid; ?>-hover").fadeIn();
		});
	</script>
<?php } ?>
<?php }}} ?>

<?php $photosuccess = ""; ?>		
            <?php endwhile; else: ?>
            <?php endif; ?>
			</div>
			<div class="clear"></div>