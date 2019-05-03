<?php wp_reset_query(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>> 
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="distribution" content="global" />
<meta name="robots" content="follow, all" />
<meta name="language" content="en, sv" />
<meta name="viewport" content="width=device-width" /> <?php // Removed ",maximum-scale=1.0" from content attribute on 12/5/18 ?>
<?php if (get_theme_mod('apple-app-id') == '') { ?>
	<?php if (get_theme_mod('touch-icon')) { ?>
		<script type="text/javascript">
			var addToHomeConfig = {
			expire: 10000,
			touchIcon: true
		};
		</script>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/tools/addtohome/add2home.css">
		<script type="application/javascript" src="<?php bloginfo('template_url'); ?>/tools/addtohome/add2home.js"></script>
		<meta name="apple-mobile-web-app-capable" content="yes">
	<?php } ?>
<?php } else { ?>
<meta name="apple-itunes-app" content="app-id=<?php echo get_theme_mod('apple-app-id'); ?>">
<?php } ?>
<?php if (get_theme_mod('touch-icon')) echo '<link rel="apple-touch-icon" href="' . get_theme_mod('touch-icon') . '" />'; ?>
<link rel="Shortcut Icon" href="<?php echo get_theme_mod('favicon'); ?>" type="image/x-icon" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="<?php bloginfo('name'); ?> RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


<?php wp_head(); $detect = new SNO_Mobile_Detect; ?>
<?php if ( !$detect->isMobile() ) { ?>
<script src="/wp-content/themes/snoflex/parallax/js/skrollr.js"></script>
<?php } ?>

<script>
	$(document).ready(function() {
		var wpadminbar = $('#wpadminbar').outerHeight();
		if (wpadminbar == null) { var wpadminbar = 0; }
		if ($('#wpadminbar').is(":hidden")) { wpadminbar = 0; }

	
	<?php if (get_theme_mod('topnav-stick') == 'Activate' && (get_theme_mod('topnav-location') != 'Off' || get_theme_mod('altheader-top') == 'Menu A') ) { ?>
		$('.navbarwrap').scrollToFixed({
			marginTop: wpadminbar,
			spacerClass: 'topnavspacer',
			zIndex: 2000
		});		
	<?php } ?>
	<?php if (get_theme_mod('bottomnav-stick') == 'Activate' && get_theme_mod('bottomnav') == 'Show' && ((get_theme_mod('header-alt') == 'Display' && get_theme_mod('altheader-right') != 3) || get_theme_mod('header-alt') != 'Display')) { ?>
		$('.subnavbarwrap').scrollToFixed({
			marginTop: <?php if (get_theme_mod('topnav-stick') == 'Activate' && get_theme_mod('topnav-location') != 'Off') { ?> $('.navbarwrap').outerHeight() + <?php } ?> wpadminbar,
		});		
	<?php } ?>
	<?php if (get_theme_mod('altheader-stick') == 'Activate' && !$detect->isMobile()) { ?>
		$('#altheader').scrollToFixed({
			marginTop: <?php if (get_theme_mod('topnav-stick') == 'Activate' && get_theme_mod('topnav-location') != 'Off') { ?> $('.navbarwrap').outerHeight() + <?php } ?> wpadminbar,
		});		
	<?php } ?>

	<?php if (get_theme_mod('topnav-mini-logo') == 'Display on Scroll' && get_theme_mod('topnav-location') != 'Off') { ?>
		var topmenuTop = $('.navbarwrap').offset().top;
		topmenuTop -= wpadminbar;
		$(window).scroll(function () {
			if ($(this).scrollTop() > topmenuTop) {
				$('#navbar .mini-logo').hide();
				$('#show-mini-logo-top').fadeIn();
				if ( $.isFunction($.fn.resizeMenuTop)) resizeMenuTop();
				
			} else {
				$('#show-mini-logo-top').hide();
				$('#navbar .mini-logo').fadeIn();
			}
		});
	<?php } ?>
	
	<?php if (get_theme_mod('bottomnav-mini-logo') == 'Display on Scroll' && get_theme_mod('bottomnav-location') != 'Off') { ?>
		var menuTop;
		if ($('#subnavbar').length){
			var menuTop = $('#subnavbar').offset().top;
		}
		menuTop -= wpadminbar;
		$(window).scroll(function () {
			if ($(this).scrollTop() > menuTop) {
				$('#subnavbar .mini-logo').hide();
				$('#show-mini-logo-bottom').fadeIn();
				if ( $.isFunction($.fn.resizeMenuBottom)) resizeMenuBottom();
				
			} else {
				$('#show-mini-logo-bottom').hide();
				$('#subnavbar .mini-logo').fadeIn();
			}
		});
	<?php } ?>
	
	
	});
</script>


<?php include(TEMPLATEPATH . "/customstyles.php"); ?>

</head>

<?php 

echo '<body>';

if (get_theme_mod('header-alt') == 'Display') { include(TEMPLATEPATH."/header-alt.php"); } else {

	if (is_home() && get_theme_mod('storybar-home') == "Top Edge") sno_get_teaserbar( $home='home' );

	$nav_menu = get_theme_mod('nav_menu_locations');
	if ((get_theme_mod('display-leader')=="Top Edge" && !is_home()) || (is_home() && get_theme_mod('leaderad-hidehome') != "Hide" && get_theme_mod('display-leader')=="Top Edge")) include(TEMPLATEPATH."/tools/leaderboard.php");
	if (get_theme_mod('breakingnews-location') == "Top Edge") include(TEMPLATEPATH."/tools/breakingnews.php");
	if (get_theme_mod('search-location') == "Top Edge") include(TEMPLATEPATH."/tools/searchbar.php");
	if (get_theme_mod('topnav-location') == "Top Edge") include(TEMPLATEPATH."/tools/header-menu-a.php"); 



			echo '<div id="sno_mobile_menu">';
				echo '<ul class="slidemenu mobile-menu">';
						echo '<li class="mobile-search-side">';
						echo '<div class="sno-side-menu side-close-icon foundation-icons fi-x"><span class="icon-hidden-text">Close Menu</span></div>';


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


if (sno_display_extra_column() == 'True' && get_theme_mod('background-wrap') == 'Defined Edges' && get_theme_mod('content-width') < 1200) include(TEMPLATEPATH . "/tools/extra-column-full-height.php");

	if ( is_active_sidebar('sidebar-h-11') && is_home() ) {
	echo '<div id="upperwrap-outer">';
	echo '<div id="upperwrap">';
	
		dynamic_sidebar('sidebar-h-11');
	echo '</div></div>';

		if ( get_theme_mod('above-header-jump') == 'bouncing' ) {
			echo '<div id="jump-arrow" class="jumparrow bouncearrow"></div>';
		} else if ( get_theme_mod('above-header-jump') == 'skip' ) {
			$jump_text = get_theme_mod('jump-text'); if ($jump_text == '') $jump_text = "Skip to Main Site";
			echo '<div id="jump-to-header" class="jump-to-header skip-transform" style="display:none;"><div class="skip-label"><div class="scrolldownarrow"></div><div class="skip-text">' . $jump_text . '</div></div></div>';
		} else if ( get_theme_mod('above-header-jump') == 'logo' ) {
 				echo '<div id="jump-to-header" class="jump-to-header-logo skip-transform" style="display:none;">';
 					$immersion_redirect = '';
					if (get_theme_mod('home-immersive-activate') == 'Immersive') $immersion_redirect = '?full-site';

 					if (get_theme_mod('mini-logo')) { 
		
						echo '<a href="/'.$immersion_redirect.'"><img src="' . get_theme_mod('mini-logo') . '" alt="' . get_bloginfo('description') . '" /></a>';			
					} else if (get_theme_mod('header-image-small')) {
		
						echo '<a href="/'.$immersion_redirect.'"><img src="' . get_theme_mod('header-image-small') . '" alt="' . get_bloginfo('description') . '" /></a>';									
					} else if (get_theme_mod('header-image-medium')) {
		
						echo '<a href="/'.$immersion_redirect.'"><img src="' . get_theme_mod('header-image-medium') . '" alt="' . get_bloginfo('description') . '" /></a>';									
					} else if (get_theme_mod('header-image')) {
		
						echo '<a href="/'.$immersion_redirect.'"><img src="' . get_theme_mod('header-image') . '" alt="' . get_bloginfo('description') . '" /></a>';									
					} else {
						echo '<a href="' . get_option('home') . $immersion_redirect . '">';
						echo '<div class="sno-home menu-icon dashicons dashicons-admin-home"><span class="icon-hidden-text">Home</span></div>';
						echo '</a>';
       				}
       			echo '</div>';
		}
		?><script type="text/javascript">
			$(document).ready(function () {
				var top_elements = jQuery('#upperwrap-outer').offset().top;
				var wp_adminbar = 0;
				if (jQuery('#wpadminbar').length > 0) wp_adminbar = jQuery('#wpadminbar').height();
				
				var jumpbutton = top_elements + 20;
				var headerLocation   = $("#wrap").offset().top;
				if ( headerLocation > $(window).height() ) { 
					$('#jump-to-header').css('top',jumpbutton + 'px').fadeIn();
				}
				$(window).scroll(function () {
					if ($(this).scrollTop() > (headerLocation - $(window).height()) ) {
						$('#jump-to-header').fadeOut();
						$('#jump-arrow').fadeOut();
					} else {
						$('#jump-to-header').fadeIn();
						$('#jump-arrow').fadeIn();
					}
				});

				$('#jump-to-header').click(function () {
					$('html, body').animate({ scrollTop: $("#wrap").offset().top - wp_adminbar }, 500);
					return false;
				});
				$('#jump-arrow').click(function () {
					$('html, body').animate({ scrollTop: $("#wrap").offset().top - wp_adminbar }, 500);
					return false;
				});
			
			});
		</script><?php

	}

echo '<div id="wrap" class="bodywrap">';
	
	echo '<div id="mobile-menu">';
		echo '<div class="sitetitle">';
			$immersion_redirect = '';
			if (get_theme_mod('home-immersive-activate') == 'Immersive') $immersion_redirect = '?full-site';
				
			if (is_archive()) { $cat_id = get_query_var('cat'); } else { $cat_id = ''; }
					
				if (get_theme_mod('header_blog_title') == 'Image') {
					if ($cat_id && get_theme_mod("cat-header-$cat_id") == 'on' && get_theme_mod("cat-$cat_id-header") != '') {
						echo '<div class="headerlink headersmall" style="display:none"><img src="' . get_theme_mod("cat-$cat_id-header") . '" class="headerimage" alt="' . get_bloginfo('description') . '" /></div>';
					} else if (get_theme_mod('header-image-small')) { 					
						echo '<div class="headerlink headersmall" style="display:none"><img src="' . get_theme_mod('header-image-small') . '" class="headerimage" alt="' . get_bloginfo('description') . '" /></div>';
					} else if (get_theme_mod('header-image-medium')) {
						echo '<div class="headerlink headersmall" style="display:none"><img src="' . get_theme_mod('header-image-medium') . '" class="headerimage" alt="' . get_bloginfo('description') . '" /></div>';
					} else if (get_theme_mod('header-image')) { 
						echo '<div class="headerlink headersmall" style="display:none"><img src="' . get_theme_mod('header-image') . '" class="headerimage" alt="' . get_bloginfo('description') . '" /></div>';
					} else {
						echo '<div class="headersmall" style="display:none"><div class="header-text"><h1><a href="' . get_option('home') . $immersion_redirect . '">' . get_bloginfo('name') . '</a></h1></div></div>';
					}

					if ($cat_id && get_theme_mod("cat-header-$cat_id") == 'on' && get_theme_mod("cat-$cat_id-header") != '') {
						echo '<div class="headerlink headermedium" style="display:none"><img src="' . get_theme_mod("cat-$cat_id-header") . '" class="headerimage" alt="' . get_bloginfo('description') . '" /></div>';
					} else if (get_theme_mod('header-image-medium')) { 					
						echo '<div class="headerlink headermedium" style="display:none"><img src="' . get_theme_mod('header-image-medium') . '" class="headerimage" alt="' . get_bloginfo('description') . '" /></div>';
					} else if (get_theme_mod('header-image')) {
						echo '<div class="headerlink headermedium" style="display:none"><img src="' . get_theme_mod('header-image') . '" class="headerimage" alt="' . get_bloginfo('description') . '" /></div>';
					} else {
						echo '<div class="headerlink headermedium" style="display:none"><div class="header-text"><h1 aria-hidden="true">' . get_bloginfo('name') . '</h1></div></div>';
					}
					
					if ($cat_id && get_theme_mod("cat-header-$cat_id") == 'on' && get_theme_mod("cat-$cat_id-header") != '') {
						echo '<div class="headerlink headerlarge" style="display:none"><img src="' . get_theme_mod("cat-$cat_id-header") . '" class="headerimage" alt="' . get_bloginfo('description') . '" /></div>';
					} else if (get_theme_mod('header-image')) { 
						echo '<div class="headerlink headerlarge"><img src="' . get_theme_mod('header-image') . '" class="headerlink headerimage" alt="' . get_bloginfo('description') . '" /></div>'; 
					} else {
						echo '<div class="headerlarge"><div class="header-text">';
						echo '<h1 aria-hidden="true">' . get_bloginfo('name') . '</h1>';
            	    	echo '</div></div>';
					}
					
					echo '<h1 style="display:none" aria-hidden="true">' . get_bloginfo('name') . '</h1>';
					?><script type="text/javascript">
						$(document).ready(function(){
							$(".headerlink").click(function(){
								window.location="<?php echo get_option('home') . $immersion_redirect; ?>";

							});
						});
					</script><?php

				} else {
							
					echo '<h1 aria-hidden="true"><div class="header-text"><a href="' . get_option('home') . $immersion_redirect . '#mobile">' . get_bloginfo('name') . '</a></div></h1>';
			
				}
					echo '<div id="hover-menu-side">';
						echo '<div class="sno-menu-side menu-icon dashicons dashicons-menu"><span class="icon-hidden-text">Menu</span></div>';
					echo '</div>';
		echo '</div>';
			


		echo '<div class="clear"></div>';
	echo '</div>';
	if (is_home() && get_theme_mod('storybar-home') == "Above Header") sno_get_teaserbar( $home='home' );
	if ((get_theme_mod('display-leader')=="Above Header" && !is_home()) || (is_home() && get_theme_mod('leaderad-hidehome') != "Hide" && get_theme_mod('display-leader')=="Above Header")) include(TEMPLATEPATH."/tools/leaderboard.php");
	if (get_theme_mod('topnav-location')=="Above Header") include(TEMPLATEPATH."/tools/header-menu-a.php");
	if (get_theme_mod('breakingnews-location') == "Above Header") include(TEMPLATEPATH."/tools/breakingnews.php");
	if (get_theme_mod('search-location') == "Above Header") include(TEMPLATEPATH."/tools/searchbar.php"); 

	if (get_theme_mod('header-off') != 'Off') {
	echo '<div class="headerwrap">';
		echo '<div id="header" style="position:relative;">';
				if (is_archive()) $cat_id = get_query_var('cat'); 
				
				if ($cat_id && get_theme_mod("cat-header-$cat_id") == 'on' && get_theme_mod("cat-$cat_id-header") != '') {
					
					echo '<div class="headerlarge"><a href="' . get_option('home') . $immersion_redirect . '"><img src="' . get_theme_mod("cat-$cat_id-header") . '" class="headerimage" alt="' . get_bloginfo('description') . '" /></a></div>'; 
					echo '<h1 style="display:none">' . get_bloginfo('name') . '</h1>';

				} else if (get_theme_mod('header_blog_title') == 'Image') {
				
					if (get_theme_mod('header-image')) { 
						echo '<div class="headerlarge"><a href="' . get_option('home') . $immersion_redirect . '"><img src="' . get_theme_mod('header-image') . '" class="headerimage" alt="' . get_bloginfo('description') . '" /></a></div>'; 
					} else {
						echo '<div class="headerlarge">';
						echo '<h1><a href="' . get_option('home') . $immersion_redirect . '">' . get_bloginfo('name') . '</a></h1>';
            	    	echo '<p>' . get_bloginfo('description') . '</p>';  
            	    	echo '</div>';
					}
					echo '<h1 style="display:none">' . get_bloginfo('name') . '</h1>';
					
				} else { 
					echo '<h1><a href="' . get_option('home') . $immersion_redirect . '">' . get_bloginfo('name') . '</a></h1>';
            	    echo '<p>' . get_bloginfo('description') . '</p>';  
				}
		
		$icon_location = get_theme_mod('icons-location'); $search_icons = get_theme_mod('search-location');
		if (($icon_location == "Top Right" || $icon_location == "Top Left" || $icon_location == "Center Right" || $icon_location == "Bottom Right" || $icon_location == "Bottom Left") && ($search_icons == "In Header")) {
			echo '<div class="header-icons">';
				echo sno_display_icons();
			echo '</div>';
		}	

		$search_location = get_theme_mod('search-header-location'); 
		if (($search_location == "Top Right" || $search_location == "Center Right" || $search_location == "Bottom Right") && ($search_icons == "In Header")) {
			echo '<div class="header-search">';
				echo sno_display_search();
			echo '</div>';		
		}

		echo '</div>';
				
	echo '</div>'; 
	}

	if (is_home() && get_theme_mod('storybar-home') == "Below Header") sno_get_teaserbar( $home='home' );

	if (get_theme_mod('breakingnews-location') == "Below Header") include(TEMPLATEPATH."/tools/breakingnews.php");

	if (get_theme_mod('search-location') == "Below Header") include(TEMPLATEPATH."/tools/searchbar.php");

	if (get_theme_mod('topnav-location') == "Below Header") include(TEMPLATEPATH."/tools/header-menu-a.php");

	if (get_theme_mod('bottomnav')=="Show") include(TEMPLATEPATH."/tools/header-menu-b.php"); 

	if (get_theme_mod('search-location') == "Below Nav Bars") include(TEMPLATEPATH."/tools/searchbar.php");

	if (get_theme_mod('breakingnews-location') == "Below Nav Bars") include(TEMPLATEPATH."/tools/breakingnews.php");

	if (is_home() && get_theme_mod('storybar-home') == "Below Nav Bars") sno_get_teaserbar( $home='home' );

	if ((get_theme_mod('display-leader')=="Below Header" && !is_home()) || (is_home() && get_theme_mod('leaderad-hidehome') != "Hide" && get_theme_mod('display-leader')=="Below Header")) include(TEMPLATEPATH."/tools/leaderboard.php");

	echo '<div id="fullwrap" style="position:relative;">';

		if (get_theme_mod('extra-column') == 'Display') echo '<div id="outerbackgroundwrap">';
			echo '<div class="innerbackgroundwrap">';
	
				if (sno_display_extra_column() == 'True' && get_theme_mod('background-wrap') == 'Full Browser Width' && get_theme_mod('content-width') < 1200) include(TEMPLATEPATH . "/tools/extra-column.php");
		echo '<div class="innerbackground">';

	if (get_option('qsno') == "qsno785643q") include(TEMPLATEPATH."/tools/quicklook/quicklook.php");
	
}