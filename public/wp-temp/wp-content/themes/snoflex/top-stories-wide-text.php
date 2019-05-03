<script type="text/javascript" charset="utf-8">
<?php if ((get_theme_mod('top-stories-wide')=="Style 1") || (get_theme_mod('top-stories-wide')=="Style 2") || (get_theme_mod('top-stories-wide')=="Style 3") || (get_theme_mod('top-stories-wide')=="Style 8")) { ?>
$(window).load(function() {
    $('#topstories').flexslider({
		animationSpeed: <?php echo get_theme_mod('top-stories-trans-speed'); ?>,
    	animationLoop: true,
    	smoothHeight: true,
		slideshowSpeed: <?php echo get_theme_mod('top-stories-speed'); ?>,
		slideshow: <?php if (get_theme_mod('top-stories-automate') == "On") { echo 'true'; } else { echo 'false'; } ?>,
	<?php if (get_theme_mod('top-stories-transition') == "Horizontal") { ?> 
		animation: "slide",
		direction: "horizontal"
	<?php } else { ?> 
		animation: "fade"
	<?php } ?>
    });
  });
<?php } ?>
<?php if (get_theme_mod('sports-stories-scrollbox') == "Display") { ?>
$(window).load(function() {
    $('#sportspage').flexslider({
		animationSpeed: <?php echo get_theme_mod('top-stories-trans-speed'); ?>,
    	smoothHeight: true,
		slideshowSpeed: <?php echo get_theme_mod('top-stories-speed'); ?>,
		slideshow: true,
		animation: "slide",
		direction: "horizontal"
    });
  });
<?php } ?>

<?php if (get_theme_mod('top-stories-wide')=="Style 6") { ?>
$(window).load(function() {
  // The slider being synced must be initialized first
  $('#tscarousel').flexslider({
    animation: 'slide',
    controlNav: false,
    directionNav: true,
    animationLoop: true,
    slideshow: false,
    itemWidth: 122,
    itemMargin: 5,
    touch: true,
    asNavFor: '#tsslideshow'
  });
   
  $('#tsslideshow').flexslider({
		animationSpeed: <?php echo get_theme_mod('top-stories-trans-speed'); ?>,
    	smoothHeight: true,
		slideshowSpeed: <?php echo get_theme_mod('top-stories-speed'); ?>,
		slideshow: <?php if (get_theme_mod('top-stories-automate') == "On") { echo 'true'; } else { echo 'false'; } ?>,
    	smoothHeight: true,
	<?php if (get_theme_mod('top-stories-transition') == "Horizontal") { ?> 
		animation: "slide",
		direction: "horizontal",
	<?php } else { ?> 
		animation: "fade",
	<?php } ?>
    	controlNav: false,
    	directionNav: false,
    	animationLoop: true,
    	touch: true,
    	sync: "#tscarousel"
  });
});
<?php } ?>
<?php if (get_theme_mod('top-stories-wide')=="Style 7") { ?>
$(window).load(function() {
  $('#tscarousel').flexslider({
    animation: 'slide',
    controlNav: false,
    directionNav: true,
    animationLoop: true,
    slideshow: false,
    itemWidth: 80,
    itemMargin: 5,
    touch: true,
    asNavFor: '#topstories'
  });

    $('#topstories').flexslider({
		animationSpeed: <?php echo get_theme_mod('top-stories-trans-speed'); ?>,
		slideshowSpeed: <?php echo get_theme_mod('top-stories-speed'); ?>,
   		smoothHeight: true,
		slideshow: <?php if (get_theme_mod('top-stories-automate') == "On") { echo 'true'; } else { echo 'false'; } ?>,
	    sync: "#tscarousel",
	<?php if (get_theme_mod('top-stories-transition') == "Horizontal") { ?> 
		animation: "slide",
		direction: "horizontal",
	<?php } else if (get_theme_mod('top-stories-transition') == "Vertical") { ?> 
		animation: "slide",
		direction: "vertical",
	<?php } else { ?> 
		animation: "fade",
	<?php } ?>
		directionNav: false,
		controlNav: false
    });
  });
<?php } ?>

</script>
<?php
echo '<div id="homepagefull">';
$loopcounter=0; $featurecount = get_theme_mod('featured-count'); if ($featurecount == '') { $featurecount = 4; }
echo '<div class="flex-container">';
	echo '<div id="topstories" class="flexslider">';
		echo '<ul class="slides">';
			query_posts('showposts='.$featurecount.'&cat='.get_theme_mod('featured-cat')); 
			if (have_posts()) : while (have_posts()) : the_post();
				$customlink = get_post_meta($post->ID, 'customlink', true);
				$sno_teaser = get_post_meta($post->ID, 'sno_teaser', true);
					if (has_post_thumbnail()) { 
					echo '<li class="topstorywideslide">';
							echo '<div class="topstoryimage">';
							$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'tsbigblock'); ?>
							<a href="<?php if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { echo $customlink; } else { the_permalink(); } ?>"><img src="<?php echo $image[0]; ?>" class="topwideteaserphoto" style="width:50%" alt="<?php the_title(); ?>" /></a> 
							</div>
						<div class="insert">
							<div class="contentbox">
								<?php if (get_theme_mod('top-stories-hide-cat')=="No") { ?>
    								<?php $categories = get_the_category(); $cat_list = array();
										foreach($categories as $category)  {  	
											if ($category->term_id != get_theme_mod('featured-cat')) $cat_list[] = $category->term_id;							
										}
    									$cat_list = array_filter($cat_list); $co = '';
												if (isset($cat_list[0]) && get_theme_mod('top-stories-hide-cat') == 'No') {
													foreach ($cat_list as $cat) {
														if ($co) $co .= ', ';
														$co .= get_cat_name($cat);
													}
													echo '<div class="topstorycat" style="margin-bottom:15px;">';
														echo '<span class="blockscat">';
															echo $co;
														echo '</span>';
													echo '</div>';

												} else {
													echo '<div class="topstorycat"style="margin-top: 15px;text-align:center;"></div>';
												} ?>
								<?php } ?>
								<h3><a class="headline" href="<?php if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { echo $customlink; } else { the_permalink(); } ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
									<?php $byline = snowriter(); if ($byline) echo '<p class="writer" style="font-size:12px;line-height:12px;">' . $byline . '</p>'; ?>
								<?php if (get_theme_mod('top-stories-hide-date')=="No") { ?>
									<p class="datetime" style="font-size:12px;padding-bottom:6px;line-height:12px;"><?php the_time('F j, Y'); ?></p>
								<?php } ?>
								<?php $contentteaser = get_theme_mod('top-stories-teaser'); ?>
								<div class="topstoryteaserbox">
								<?php if ($customlink) { 
						  	      	if ($sno_teaser) { 
		    					       	echo '<p>' . $sno_teaser . '</p>'; 
									} else {
										the_content_limit($contentteaser, ""); 
									}								
								} else { 
						  	      	if ($sno_teaser) { 
		    					       	echo '<p>' . $sno_teaser . ' <a href="' . get_permalink() . '">READ MORE <span style="font-size:24px;line-height:11px">&raquo;&raquo;</span></a></p>'; 
									} else {
										the_content_limit($contentteaser, "READ MORE <span style='font-size:24px;line-height:11px'>&raquo;&raquo;</span>"); 
									}
								} ?>
								<div class="storybottomnoline"></div>
								</div>
								<div class="topcaptionbox">
								<?php 
									$imageid = get_post_meta($post->ID, '_thumbnail_id', true);
	   								$caption = get_post_field(post_excerpt, $imageid);
								   						
	   								if ($caption) { 
		   							echo '<p class="photocaption" style="font-size:12px;padding-bottom:8px !important">'.$caption.'</p>'; 
			   						}
									sno_photographer($wrap); ?>
								</div>
							</div>
						</div>
						<div class="desc mobileslider">
							<h3><a href="<?php if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { echo $customlink; } else { the_permalink(); } ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
						</div>

					</li>
					<?php } ?>
				<?php endwhile; else: ?>
				<?php endif; ?>
			</ul>
		</div>
	 </div>
</div>
<div style="clear:both"></div>