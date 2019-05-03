<?php $mobile = ''; $detect = new SNO_Mobile_Detect; if( $detect->isMobile() || $detect->isTablet() ) $mobile = 1; ?>
		<div id="carouselwrap" class="tsb23">
            <?php $count = 0; query_posts('meta_key=_thumbnail_id&showposts=10&cat='.get_theme_mod('featured-cat')); ?> 
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php $postid = $post->ID; $customlink=get_post_meta($post->ID, 'customlink', true); $sno_teaser = get_post_meta($post->ID, 'sno_teaser', true); ?>
			<?php if ($count<2) { ?>
			<?php if (has_post_thumbnail()) 
				{ $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
    			<?php if ( $image[1] > 300 && $image[2] > 200 ) { $count++; ?>
    			<?php $border = ''; if ($count == 2) $border = ' tbleftborder';  ?>
			    <?php $height_fallback = ''; if ($image[2] < 312 || ($image[1]/$image[2] > 1.5)) $height_fallback = ' min-height:312px;'; ?>

			<div id="container<?php echo $postid; ?>" class="topbox23top <?php echo $border; ?>">			
			<div class="photocontainer" id="box<?php echo $postid; ?>">
							<a href="<?php if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { echo $customlink; } else { the_permalink(); } ?>"><img src="<?php echo $image[0]; ?>" style="width:100%;<?php echo $height_fallback; ?>" class="catboxphoto" id="grow-<?php echo $postid; ?>" alt="<?php the_title(); ?>" /></a> 
				<?php $photosuccess = 3; ?>
    		<a href="<?php if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { echo $customlink; } else { the_permalink(); } ?>"><div <?php if ($photosuccess == 3) { ?>id="box<?php echo $postid; ?>-hover" <?php } else { ?>style="display:block!important;" <?php } ?>class="topboxsmallwideoverlay">
				<div id="gridmeta-<?php echo $postid; ?>" class="gridmeta">
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
				</div>
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
   		//	$("#gridmeta-<?php echo $postid; ?>").css({ marginTop:'-200px' });
   		//	$("#gridmeta-<?php echo $postid; ?>").stop().animate({ marginTop:'10%' },300);
   			$("#grow-<?php echo $postid; ?>").addClass('grow');
    	}).mouseleave(function() {
   		//	$("#gridmeta-<?php echo $postid; ?>").stop().animate({ marginTop:'80%' },600);
        	$("#box<?php echo $postid; ?>-hover").fadeOut();
   			$("#grow-<?php echo $postid; ?>").addClass('shrink');
    	});
	});</script>
<?php } else { ?>
	<script>
	$(document).ready(function() {
        	$("#box<?php echo $postid; ?>-hover").fadeIn();
	});</script>
	<style>
	.topboxsmallwideoverlay { background: none; }
	.topbox23top h3 { background: url('/wp-content/themes/snoflex/images/topback.png'); }
	</style>
<?php } ?>

			<?php }}} else if ($count < 5) { ?>
			
			<?php if (has_post_thumbnail()) 
				{ $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); ?>
    			<?php if ( $image[1] > 300 && $image[2] > 200 ) { $count++; ?>
    			<?php $border = ''; if ($count > 3) $border = ' tbleftborder'; ?>
    			<?php $height_fallback = ''; if ($image[2] < 208 || ($image[1]/$image[2] > 1.5)) $height_fallback = ' min-height:208px;'; ?>
    			<?php $hidebox = ''; if ($count == 4) $hidebox = ' hide23box5'; ?>
				<div class="topbox23bottom <?php echo $border . $hidebox; ?>">
					<div class="photocontainer" id="box<?php echo $postid; ?>">
						<?php if (has_post_thumbnail()) { 
							$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); ?>
							<a href="<?php if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { echo $customlink; } else { the_permalink(); } ?>"><img src="<?php echo $image[0]; ?>" style="width:100%;height:auto;<?php echo $height_fallback; ?>" class="catboxphoto" id="grow-<?php echo $postid; ?>" alt="<?php the_title(); ?>" /></a> 
							<?php $photosuccess = 3; } ?>
							<?php if ($photosuccess == 3) { ?><div id="boxback<?php echo $postid; ?>" class="topboxsmallwidehover"></div><?php } ?>
							<a href="<?php if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { echo $customlink; } else { the_permalink(); } ?>">
    							<div <?php if ($photosuccess == 3) { ?>id="box<?php echo $postid; ?>-hover" <?php } else { ?>style="display:block!important;" <?php } ?> class="topboxsmallwideoverlay">
								<div id="gridmeta-<?php echo $postid; ?>" class="gridmeta">
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
									<?php if (get_theme_mod('top-stories-hide-date')=="No") { ?>
										<p class="tssdatetime" style="text-align:center;padding-top:10px;"><?php the_time('F j, Y'); ?></p>
									<?php } ?>
								</div>
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
   		//	$("#gridmeta-<?php echo $postid; ?>").css({ marginTop:'-100px' });
   		//	$("#gridmeta-<?php echo $postid; ?>").stop().animate({ marginTop:'10%' },300);
   			$("#grow-<?php echo $postid; ?>").addClass('grow');
    	}).mouseleave(function() {
   		//	$("#gridmeta-<?php echo $postid; ?>").stop().animate({ marginTop:'80%' },600);
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
	.topbox23bottom h3 { background: url('/wp-content/themes/snoflex/images/topback.png'); }
	.topbox23bottom h3 { padding-top: 7px; padding-bottom:7px; }
	</style>
<?php } ?>
<?php }}} ?>

<?php $photosuccess = ""; ?>		
            <?php endwhile; else: ?>
            <?php endif; ?>

		</div>		
<div class="clear"></div>