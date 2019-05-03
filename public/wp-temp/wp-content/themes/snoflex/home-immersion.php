<!DOCTYPE html>
<html style="margin:0px!important;background: #000;">
<head>
<meta name="viewport" content="width=device-width,maximum-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="stylesheet" media="screen" href="<?php bloginfo('template_url'); ?>/tools/superfish/css/superfish.css" />  
<link rel="Shortcut Icon" href="<?php echo get_theme_mod('favicon'); ?>" type="image/x-icon" />



<?php include(TEMPLATEPATH . "/customstyles.php"); ?>
<style>
	#wpadminbar {display:none!important;}
	body { background: #000 !important; }
</style>
<?php wp_reset_query(); ?>
<title><?php bloginfo('name'); ?> | <?php bloginfo('description') ?></title>
<?php wp_head(); ?>
</head>
<body>
<div id="home-immersion">

<div id="lf_wrap">
	<?php

			echo '<div id="sno_mobile_menu">';
				echo '<ul id="slidemenu" class="mobile-menu">';
						echo '<div class="sno-side-menu close-icon foundation-icons fi-x"><span class="icon-hidden-text">Close Menu</span></div>';
						echo '<li class="mobile-search-side">';


								?><form method="get" id="searchform-alt-left" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									<label for="s-alt-left" class="assistive-text"><?php _e( 'Search', 'SNO' ); ?></label>
									<input type="text" class="field" name="s" id="s-alt-left" placeholder="<?php esc_attr_e( 'Search', 'SNO' ); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'"/>
									<input type="submit" class="submit" name="submit" id="searchsubmit-left" style="display:none;" value="<?php esc_attr_e( 'Search', 'SNO' ); ?>" />
								</form><?php

						echo '</li>';
					echo '<div class="clear"></div>';

					$nav_menu = get_theme_mod('nav_menu_locations');

					if ($nav_menu['mobile-menu'] == '') {
						$menu_name = 'header-menu-2';
					} else { 
						$menu_name = 'mobile-menu';
					}
					
					wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'container_class' => 'mobile-menu' ) );	
    				
				echo '</ul>';
				
			echo '</div>';


	query_posts('showposts=1&cat='.get_theme_mod('home-immersive-cat')); 
	if (have_posts()) : while (have_posts()) : the_post();

		$custom_fields = get_post_custom($post->ID);
			if (isset($custom_fields['video'])) $video = $custom_fields['video'][0];
			if (isset($custom_fields['deck'])) $deck = $custom_fields['sno_deck'][0];
			if (isset($custom_fields['_thumbnail_id'])) $imageid = $custom_fields['_thumbnail_id'][0]; 
			if (isset($custom_fields['sno_teaser'])) $sno_teaser = $custom_fields['sno_teaser'][0]; 
			if (isset($custom_fields['customlink'])) $customlink = $custom_fields['customlink'][0]; 


			if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { $storylink = $customlink; } else { $storylink = get_permalink(); }
		
		
		if (isset($imageid) && ($imageid)) $breakingimage = wp_get_attachment_image_src( $imageid, 'medium'); 
		$teaser = get_theme_mod('home-breaking-teaser');			
		
		
		if (has_post_thumbnail()) {

			echo '<div id="home-immersion-content">';

			$breakingimage = wp_get_attachment_image_src( $imageid, 'full'); 	
			$image_css = ''; $image_orientation = 'horizontal'; $overlay_css = '';
			
			if ($breakingimage[1] > $breakingimage[2]) { // image is horizontal
				$image_css = 'width:100%;';
				
			} else { // image is vertical
				$image_orientation = 'vertical';
				$image_css = 'height: 100%; width: auto; left:0;right:unset; transform:unset;';
				$overlay_css = 'left: unset; right: 10%;';
			
				
			}	

		
				echo '<div class="home-immersion-overlay">';
				
					echo '<img src="' . $breakingimage[0] . '" id="immersion-image" style="' . $image_css . '"/>'; 

					if ( get_theme_mod('home-immersive-hide-menu') != 'Hide' ) {

						echo "<div class='lf-dropdown' style='position:absolute;right:15px;top:15px;'>
							<ul class='sf-menu'>
								<li class='sf-menu' style='background:none!important;padding-left:20px;'>";
	
	        						echo '<div class="lf_menu_icon">';
	        							echo '<div class="lf_menu_icon_bar"></div>';
	        							echo '<div class="lf_menu_icon_bar"></div>';
	        							echo '<div class="lf_menu_icon_bar"></div>';
	        						echo '</div>';
	
	
	
								echo '</li>
							</ul>
						</div>';
					}
					
					$skip_text = get_theme_mod('skip-text'); if ($skip_text == '') $skip_text = "&#8212; View Full Site";

					if ( get_theme_mod('immersive-header') == 'logo' ) {
						echo '<div id="immersion-header" class="immersion-header-logo immersion-header skip-transform">';
						$immersion_redirect = '?full-site';

						if (get_theme_mod('mini-logo')) { 
							echo '<a href="/'.$immersion_redirect.'"><img src="' . get_theme_mod('mini-logo') . '" alt="' . get_bloginfo('description') . '" /></a>';			
						} else if (get_theme_mod('header-image-small')) {
							echo '<a href="/'.$immersion_redirect.'"><img src="' . get_theme_mod('header-image-small') . '" alt="' . get_bloginfo('description') . '" /></a>';									
						} else if (get_theme_mod('header-image-medium')) {
							echo '<a href="/'.$immersion_redirect.'"><img src="' . get_theme_mod('header-image-medium') . '" alt="' . get_bloginfo('description') . '" /></a>';									
						} else if (get_theme_mod('header-image')) {
							echo '<a href="/'.$immersion_redirect.'"><img src="' . get_theme_mod('header-image') . '" alt="' . get_bloginfo('description') . '" /></a>';									
						} else {
							echo '<div id="jump-to-header" class="jump-to-header skip-transform" style="display:none;"><div class="skip-label"><div class="skip-text">' . get_bloginfo('name') . ' ' . $skip_text . '</div></div></div>';
       					}
	   					echo '</div>';
					} else if ( get_theme_mod('immersive-header') == 'site' ){
						$immersion_redirect = '?full-site';
						echo '<a href="/'.$immersion_redirect.'"><div id="immersion-header" class="immersion-header skip-transform"><div class="skip-label"><div class="skip-text">' . get_bloginfo('name') . ' ' . $skip_text . '</div></div></div></a>';
					}
					
					?><script type="text/javascript">
						$("#home-immersion-content").hide();
						$(window).load(function () {
							$("#home-immersion-content").fadeIn(800);
							resize_photo();
						});
						<?php if (get_theme_mod('home-immersive-headline') != "Remove" && get_theme_mod('home-immersive-hide-overlay') != "on") { ?>
							$('#immersion-image').click(function() {
								window.location=$(".maingridheadline").find('a').attr('href');
							});
						<?php } else { ?>
							$('#immersion-image').click(function() {
								window.location.href = '<?php echo get_the_permalink(); ?>';
							});
						<?php } ?>
						window.onresize = function() {
                			resize_photo();
            			};
						function resize_photo() {
							$("#immersion-image").css( 'height', '100%' )
							$("#immersion-image").css( 'width', 'auto' )
								var image_orientation = "<?php echo $image_orientation; ?>";
								var immersion_frame_width = $(window).width();
								
								if (image_orientation == 'horizontal') {
									if (immersion_frame_width <= 800) {
										$(".home-immersion-overlay").css( 'height', '60vh' );
										$("#immersion-image").css( 'right', 'unset');
										$("#immersion-image").css( 'transform', 'unset');
									} else {
										$(".home-immersion-overlay").css( 'height', '100vh' );
										$("#immersion-image").css( 'right', '50%');
										$("#immersion-image").css( 'transform', 'translateX(50%)');
									}
								}
								var immersion_frame_height = $(".home-immersion-overlay").height();
								var immersion_frame_proportion = immersion_frame_width / immersion_frame_height;
								var immersion_image_width = <?php echo $breakingimage[1]; ?>;
								var immersion_image_height = <?php echo $breakingimage[2]; ?>;
								var immersion_image_proportion = immersion_image_width / immersion_image_height;
								var actual_photo_width = $("#immersion-image").width();
								var width_difference = immersion_frame_width - actual_photo_width;
								
								var immersion_differnce = immersion_frame_proportion - immersion_image_proportion;
									
								
								if ( image_orientation == 'horizontal' ) {
									
									
									if ( immersion_frame_proportion >= immersion_image_proportion || immersion_frame_width <= 800) {
										$("#immersion-image").css( 'width', '100%' )
										$("#immersion-image").css( 'height', 'auto' )
									} else { 
										$("#immersion-image").css( 'height', '100%' )
										$("#immersion-image").css( 'width', 'auto' )
									}
								} else {
									
									if ( immersion_differnce < .3 || width_difference < 350) {
										$("#immersion-image").css( 'width', '100%' )
										$("#immersion-image").css( 'height', 'auto' )
										if (immersion_frame_proportion > immersion_image_proportion) {
											$("#immersion-image").css( 'top', '50%' )
											$("#immersion-image").css( 'transform', 'translateY(-50%)' )
										} else {
											$("#immersion-image").css( 'top', '0' )
											$("#immersion-image").css( 'transform', 'translateY(0%)' )
										}
										// move overlay to the bottom
										$(".home-immersion-text").addClass( 'home-immersion-text-vertical' )
										$(".home-immersion-text h1").css( 'text-align', 'center' )
										$(".footerbar").hide()
										
									} else if ( immersion_differnce > .3 ) {
										$(".home-immersion-text").removeClass( 'home-immersion-text-vertical' )
										$(".footerbar").show()
										$("#immersion-image").css( 'height', '100%' )
										$("#immersion-image").css( 'width', 'auto' )
										// set overlay to go on the side black area
										$(".home-immersion-text").css( 'left', actual_photo_width )
										$(".home-immersion-text").css( 'right', '0' )
										$(".home-immersion-text").css( 'width', width_difference - 60 + 'px' )
										$(".home-immersion-text h1").css( 'text-align', 'center' )
										$(".home-immersion-text").css( 'text-align', 'center' )
										
										
										
									}
								}
								
							
						}

					</script><?php
			if ( get_theme_mod('home-immersive-hide-overlay') != 'on' ) {
				echo '<div class="home-immersion-text" style="' . $overlay_css . '">';
								
				if ( get_theme_mod('home-immersive-catname') != "Hide" ) {
    								$categories = get_the_category(); $cat_list = array();
										foreach($categories as $category)  {  	
											if ($category->term_id != get_theme_mod('featured-cat')) $cat_list[] = $category->term_id;							
										}
    									$cat_list = array_filter($cat_list); $co = '';
												if (isset ($cat_list[0]) && $cat_list[0]) {
													foreach ($cat_list as $cat) {
														if ($co) $co .= ', ';
														$co .= get_cat_name($cat);
													}
														echo '<div style="margin-bottom:15px;text-align:center;">';
															echo '<span class="blockscat">';
																echo $co;
															echo '</span>';
														echo '</div><div class="clear"></div>';

												} 
				}
				
				if (get_theme_mod('home-immersive-hide-headline') != "Hide") {
					if (get_theme_mod('home-immersive-headline') == "Remove") {
						echo '<h1 class="maingridheadline">' . get_the_title() . '</h1>';
					} else {
						echo '<h1 class="maingridheadline"><a class="immersion-headline-link" href="' . $storylink . '">' . get_the_title() . '</a></h1>';
					}
				}
				if (get_theme_mod('home-immersive-byline') == 'Display') {
						echo '<p class="home-immersion-byline">';
						$byline = snowriter(); if ($byline) echo $byline . ' &bull; ';
							the_time('F j, Y'); 
						echo '</p>';
				}
				
				if (get_theme_mod('home-immersive-hide-teaser') != 'Hide') {
					echo '<div class="home-immersion-teaser">';
						if (get_theme_mod('home-immersive-html') == "Allow") {
							the_content();
						} else {
				  	      	if ($sno_teaser) { 
				    	       	echo '<p>' . $sno_teaser . '</p>'; 
							} else {
								the_content_limit($teaser, "");
							}
						}
					echo '</div>';
				}
  									
  					if ( get_theme_mod('home-immersive-continue') != 'Hide' && get_theme_mod('home-immersive-headline') != "Remove") {
						echo "<div class='continue-overlay'><span class='continue-overlay-link'>";
							if (get_theme_mod('home-immersive-hide-teaser') != 'Hide') {
								$continue_text = get_theme_mod('continue-text');
							} else {
								$continue_text = get_theme_mod('read-text');
							}
							if ($continue_text == '') $continue_text = "Continue Reading";
							echo $continue_text;
						echo '<span></div>';
						echo "	
							<script type='text/javascript'>
								$(document).ready(function() {
									$('.home-immersion-text').click(function() {
										window.location=$(this).find('a').attr('href');
									});
								});
							</script>";
					}

				echo '</div>';
			}

				echo '</div>';
				echo '</div>';
				
		} 	
	endwhile; else: endif;
	
	
?>

		<?php echo '<div class="footerbar">';
			sno_footer_close();
		echo '</div>'; ?> 

</div>
</div>
</body>
<?php do_action('wp_footer'); ?>
<script type="text/javascript">

jQuery( function() {
 	jQuery( '.lf_menu_icon' ).on( 'touchstart click', function(e) {
 		e.preventDefault();
 			$('#sno_mobile_menu').fadeToggle();

 	});
 	jQuery( '.close-icon' ).on( 'touchstart click', function(e) {
 		e.preventDefault();
 			$('#sno_mobile_menu').fadeToggle();

 	});
 		
});
</script>

</html>