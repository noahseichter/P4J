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
<?php $loopcounter=0; $featurecount = get_theme_mod('featured-count'); if ($featurecount == '') { $featurecount = 4; } ?>
<div class="flex-container">
	<div id="topstories" class="flexslider slideroverlay">
		<ul class="slides">
			<?php query_posts('showposts='.$featurecount.'&cat='.get_theme_mod('featured-cat')); ?> 
			<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
				<?php $customlink=get_post_meta($post->ID, 'customlink', true); ?>
				<?php if (has_post_thumbnail()) { ?> 

					<li class="topstoryslide">
							<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
							<a href="<?php if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { echo $customlink; } else { the_permalink(); } ?>"><img src="<?php echo $image[0]; ?>" style="width:100%;height:auto;" class="catboxphoto" alt="<?php the_title(); ?>" /></a> 
					<?php if (get_theme_mod('featured-scroll') == "Show") { ?>	
					
						<div class="desc">
							<h3><a href="<?php if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { echo $customlink; } else { the_permalink(); } ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
							<?php $writer = snowriter(); $hidedate = get_theme_mod('top-stories-hide-date'); if (($writer) || ($hidedate == "No")) { ?>
								<p class="carouselbyline">
									<?php if ($writer) echo $writer; ?> 
									<?php if (get_theme_mod('top-stories-hide-date')=="No") { 
										if ($writer) echo ' | '; 
										the_time('F j, Y ');
									} ?>
									<?php if (get_theme_mod('top-stories-credit')=="Show") { 
										sno_photographer ($wrap="carousel");
									} ?>
								</p>
							<?php } ?>
						</div>
						
					<?php } ?>		
				</li>
				<?php } ?>
			<?php endwhile; else: ?>
			<?php endif; ?>
		</ul>
	</div>
</div>
<div class="clear topboxbottommargin"></div>