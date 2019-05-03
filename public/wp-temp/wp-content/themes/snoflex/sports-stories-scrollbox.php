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

$sportscount = get_theme_mod('sports-count'); if ($sportscount == '') { $sportscount = 4; }
echo '<div id="sports-flex-container">';
	echo '<div id="sportspage" class="flexslider">';
		echo '<ul class="slides">';

			query_posts('showposts='.$sportscount.'&cat='.get_theme_mod('sports-scrollbox-cat'));
			if (have_posts()) : while (have_posts()) : the_post();
				if (has_post_thumbnail()) { 
					echo '<li class="sportsstoryslide" style="max-width:100%;">'; ?>
					
							<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
							<a href="<?php if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { echo $customlink; } else { the_permalink(); } ?>"><img src="<?php echo $image[0]; ?>" style="width:100%;height:auto;" class="catboxphoto" alt="<?php the_title(); ?>" /></a> <?php
						
					if (get_theme_mod('sports-scroll-teaser') == "Show") {	
							
						echo '<div class="desc">';
							echo '<h3><a href="' . get_permalink(). '" title="' . get_the_title() . '">';
							echo get_the_title() . '</a></h3>';
						echo '</div>';
						
					}		
		
				echo '</li>';
			
			}

			endwhile; else: endif;

		echo '</ul>';

	echo '</div>';
echo '</div>';
?>