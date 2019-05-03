<!DOCTYPE html>
<html style="margin:0px!important;">
<head>
<meta name="viewport" content="width=device-width,maximum-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="stylesheet" media="screen" href="<?php bloginfo('template_url'); ?>/tools/superfish/css/superfish.css" />  
<link rel="Shortcut Icon" href="<?php echo get_theme_mod('favicon'); ?>" type="image/x-icon" />


<script src="<?php bloginfo('template_url'); ?>/javascript/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/tools/superfish/js/superfish.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/tools/superfish/js/supersubs.js"></script> 
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/tools/flexslider/flexslider.css" type="text/css">
<script src="<?php bloginfo('template_url'); ?>/tools/flexslider/jquery.flexslider.js"></script>
<script src="<?php bloginfo('template_url'); ?>/javascript/jquery-visible.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascript/remodal.min.js"></script> 
 <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/javascript/remodal.css"> 
 <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/javascript/remodal-default-theme.css"> 
<script> 
 
    $(document).ready(function(){ 
        $("ul.sf-menu").supersubs({ 
            minWidth:    12,   // minimum width of sub-menus in em units 
            maxWidth:    20,   // maximum width of sub-menus in em units 
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
        }).superfish({
    		delay:      200,     
        	speed:		'fast'
        });  // call supersubs first, then superfish, so that subs are 
                         // not display:none when measuring. Call before initialising 
                         // containing tabs for same reason. 
    }); 

</script>
<style>


</style>
<style type="text/css" media="screen"><!-- @import url( <?php bloginfo('stylesheet_url'); ?> ); --></style>
<style type="text/css" media="screen"><!-- @import url(http://fonts.googleapis.com/css?family=Gilda+Display); --></style>

<title><?php bloginfo('name'); ?> | <?php the_title(); ?></title>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascript/jquery-scrolltofixed-min.js"></script> 
<script>

	$(function () {

		$('#gototop').click(function () {
     var bottomPosition = $(".phototop").height();
     var bottomWindow = $(window).height();
     bottomWindow = bottomWindow - 50;
     if (bottomWindow < bottomPosition) {
     	photoHeight = bottomWindow;
		 photoHeight = photoHeight -45;
     } else {
     	photoHeight = bottomPosition +35;
     }
	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 300) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}


		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});

	});

$(function() { // when the DOM is ready...
     var bottomPosition = $(".phototop").height();
     var headerHeight = $(".header").height();
     var bottomWindow = $(window).height();
     bottomWindow = bottomWindow - 50;
     if (bottomWindow < bottomPosition) {
     	photoHeight = bottomWindow;
		 photoHeight = photoHeight -45;
     } else {
     	photoHeight = bottomPosition + headerHeight;
     }
     $('html, body').animate({
         scrollTop: $("#mainbody").offset().top-photoHeight
     }, 1000).delay();
    
	 });


	
</script>
<?php wp_head(); $test_for_mobile = new SNO_Mobile_Detect; ?>
<?php if ( !$test_for_mobile->isMobile() ) { ?>
<script src="/wp-content/themes/snoflex/parallax/js/skrollr.js"></script>
<?php } ?>
<?php include(TEMPLATEPATH . "/customstyles.php"); ?>
</head>
<body>
<?php
				echo '<ul id="menu">';
					echo '<li>';

						sno_display_search();
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
?>

<?php $unique_id = $post->ID; ?>
<div id="lf_wrap">
<div id="sno_longform" class="sno-story-<?php echo $unique_id; ?>">

		<?php if (have_posts()) : while (have_posts()) : the_post();
			
			$lf_parent = get_post_meta($post->ID, 'sno_longform_list', true);
  			$lf_format = get_post_meta($post->ID, 'sno_format', true);
  			$lf_story_override = get_post_meta($post->ID, 'sno_longform_story_override', true); 
  			$lf_story_override_kill = get_post_meta($post->ID, 'sno_longform_story_override_kill', true); 

			$custom_fields = get_post_custom($post->ID);
				$video = $custom_fields['video'][0];
				$videographer = $custom_fields['videographer'][0];
				$deck = $custom_fields['sno_deck'][0];
				$imagelocation = $custom_fields['featureimage'][0]; 
				$videolocation = $custom_fields['videolocation'][0]; 
				$immersive = $custom_fields['sno_sidebyside_image'][0]; 
				$sidebyside_title = $custom_fields['sno_sidebyside_title'][0]; 
				$imageid = get_post_thumbnail_id(); 
				$parent_url = get_the_permalink();

						if (has_post_thumbnail()) {
	   						$caption = get_post_field('post_excerpt', $imageid);
							$photographer = get_post_meta($imageid, 'photographer', true);
	   					}
	   
			if ($lf_story_override == 'true') { ?>
				<style type="text/css">
				#sno_longform #mainbody, #commentsbody, #commentsbox, .commentblock li, .widgetbody, .titlewrap, .commenttext { background: <?php echo get_theme_mod('lf-story-page-background'); ?> !important; }
				#sno_longform a { color: <?php echo get_theme_mod('lf-story-page-override-links'); ?> !important; }
				#sno_longform #storypage h1, #sno_longform p, #sno_longform h5, #sno_longform .relateddivider, #sno_longform .photocaption, #sno_longform .storydeck p  { color: <?php echo get_theme_mod('lf-story-page-override-text'); ?> !important; }
				#sno_longform .background-gray, #sno_longform .background-white { background: <?php echo get_theme_mod('lf-story-page-background'); ?> !important; }
				#sno_longform .largequote { text-shadow: none;}
				#sno_longform .storyshadow { box-shadow: none !important; }
				#sno_longform .dividinglinedeck, #sno_longform .dividingline { border-color: <?php echo get_theme_mod('lf-story-page-override-text'); ?> !important; }
				</style>
			<?php } else if ( $lf_story_override_kill == 'true') { ?>
				<style type="text/css">
				#sno_longform #mainbody, #commentsbody, #commentsbox, .commentblock li, .widgetbody, .titlewrap, .commenttext { background: #fff !important; }
				#sno_longform a { color: <?php echo get_theme_mod('accentcolor-links'); ?> !important; }
				#sno_longform #storypage h1, #sno_longform p, #sno_longform h5, #sno_longform .relateddivider, #sno_longform .photocaption, #sno_longform .storydeck p, #commentsbody, #commentsbox, .commentblock li, #commentsbody, #commentsbody ul li, #commentsbody ol li { color: #444 !important; }
				#sno_longform .background-gray { background: #f1f1f1 !important; }
				#sno_longform .background-white { background: #fff !important; }
				#sno_longform .dividinglinedeck, #sno_longform .dividingline { border-color: #444 !important; }
				</style>
			<?php } 
			?><style>
				#wpadminbar {display:none!important;}
			</style><?php


				$header_style = '';
				$show_on_load = get_theme_mod('lf-show-header');
				if ($show_on_load != 'Yes' && $immersive == 'true') $header_style = " style='display:none;'";

        		echo "<div class='header'$header_style>";

					echo '<div class="altheader-menu">';
					echo '<div id="hover-menu">';
						echo '<div class="sno-menu menu-icon dashicons dashicons-menu"></div>';
						echo '<div class="sno-menu close-icon foundation-icons fi-x" style="display:none;"></div>';
					echo '</div>';
        			        								
					echo '</div>';

 				echo '<div class="lf_headerleft">';
 					
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
						echo '<div class="sno-home menu-icon dashicons dashicons-admin-home"></div>';
						echo '</a>';
       				}
       				
       			echo '</div>';
       
        			if (get_theme_mod('lf-social') != "Hide") {	
						
						echo '<div class="socialmedia">';
						
						sno_sharing_icons( $template = 'Side by Side', $location = 'Bar');

						echo '</div>';
					}
					
					echo '<div id="back-top"><a id="snotop" href="#top" title="Return to Top"><div class="sno-arrow-up fa fa-arrow-up"></div></a></div>';
		
		echo '</div>';					

					$querystr = "
						SELECT * FROM $wpdb->posts
						JOIN $wpdb->postmeta AS sno_format ON(
						$wpdb->posts.ID = sno_format.post_id
						AND sno_format.meta_key = 'sno_format'
						AND sno_format.meta_value = 'Side by Side Chapter'
						)
						JOIN $wpdb->postmeta AS sno_sidebyside_list ON(
						$wpdb->posts.ID = sno_sidebyside_list.post_id
						AND sno_sidebyside_list.meta_value = '$post->ID'
						)
						JOIN $wpdb->postmeta AS sno_sidebyside_order ON(
						$wpdb->posts.ID = sno_sidebyside_order.post_id
						AND sno_sidebyside_order.meta_key = 'sno_sidebyside_order'
						)
						WHERE $wpdb->posts.post_status = 'publish'
						ORDER BY sno_sidebyside_order.meta_value ASC LIMIT 2
						";


 					$pageposts = $wpdb->get_results($querystr, OBJECT);
					wp_reset_query();


?>

<div id="storypage">
<?php		echo '<div id="altheader-searchbox">';
			
				echo '<ul class="slidemenu mobile-menu">';




						echo '<li class="mobile-search" style="margin-top: 0px; clear: both;">';


								?><form method="get" id="searchform-alt" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									<label for="s" class="assistive-text"><?php _e( 'Search', 'SNO' ); ?></label>
									<input type="text" class="field" name="s" id="s-alt" placeholder="<?php esc_attr_e( 'Search', 'SNO' ); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search'"/>
									<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'SNO' ); ?>" />
								</form><?php

						echo '</li>';

					$nav_menu = get_theme_mod('nav_menu_locations');

					if ($nav_menu['mobile-menu'] == '') {
						$menu_name = 'header-menu-2';
					} else { 
						$menu_name = 'mobile-menu';
					}
					
					wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'container_class' => 'mobile-menu' ) );	
    				
				echo '</ul>';
			
			
			
			
		echo '</div>';

	
	if ($immersive && has_post_thumbnail()) {
		$fullimage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
		
		$output = '';

			$image0 = $fullimage[0]; $image1 = $fullimage[1]; $image2 = $fullimage[2];
			
			if ( $test_for_mobile->isMobile() ) {	
				// this is the old display of immersive images prior to adding new parallax option
					echo '<img src="' . $fullimage[0] .'" style="width:100%" />';
					echo '<div id="mainbody">';
					if ($caption || $photographer) {
						echo '<div class="lf-immersive-caption">';
							if ($caption) echo $caption;
							if ($photographer) echo get_sno_photographer($wrap = 'false');
						echo '</div>';
					}					
			} else {	// this is the new parallax markup for immersive featured images.\

				echo "<div id='jump-arrow' class='jumparrow bouncearrow'$arrow_location></div>";

				echo "<style>#slide-mp .bcg {background-image:url('$image0')}</style>";
				$output .= '<div class="parallaxcontainer">';
				$output .= '<div class="loading" style="position:relative;">';
					$output .= '<div class="parallaximagesloading">';
						$output .= "<img src='$image0'>";
					$output .= '</div>';
	
					$output .= "<section style='height:100vh;'><div id='slide-mp' class='homeSlide' style='height:100vh;opacity:1;'>";
						$output .= "<div class='bcg' data-center='background-position: 50% 0px;' data-top-bottom='background-position: 50% -100px;' data-bottom-top='background-position: 50% 100px;' data-anchor-target='#slide-mp'>";
						
						
	
						if ($caption || $photographer) {
							$output .= "<div class='hsContainer lf_caption'>";
								$output .= "<div class='hsContent $custom_location' data-anchor-target='#slide-mp .parallaxtitle'>";
									$output .= "<div class='parallaxoverlay'>";
										$output .= "<div class='parallaxtitle widgetheadlineoverlay'>";
											if ($caption) $output .= $caption;
											if ($photographer) $output .= get_sno_photographer($wrap = 'true');
										$output .= "</div>";
									$output .= '</div>';
									$output .= '<div class="clear"></div>';
								$output .= '</div>';
							$output .= '</div>';
						}
	
	
	
	
	
	
	
	
	
						$output .= '</div>';
					$output .= '</section>';
				$output .= '</div>';
				$output .= '</div>';
			}
			
			

				if ( $test_for_mobile->isMobile() ) {
					$output .= '<style>.parallaxcontainer { height: auto !important; }</style>';
				} else {
					?>
					<script type="text/javascript">
						$(window).load(function() {
							$body = $('.parallaxcontainer');
							var s = skrollr.init({
								forceHeight: false
							}); 
							$(".parallaxcontainer").css('height','auto');
							$(".parallaxcontainer section").fadeIn(2000);
							s.refresh($('.homeSlide'));
						});
					</script>
					<?php
				}	

			echo $output;

		
        echo '<div id="mainbody">';
	} else {
        echo '<div id="mainbody" style="padding-top:70px;">';
	}
	
	
	















			echo '<div class="content main">';

			
						if (($imagelocation == "Slideshow of All Attached Images") && ($immersive == '')) {
	
							sno_sfi_story_page($post, $caption, $photographer);
														
						} else if ((has_post_thumbnail()) && ($immersive == '') && ($imagelocation != 'Do Not Display')) {
	
							sno_get_single_image($post, $caption, $photographer);
							echo sno_photographer($wrap);
		   					echo '<p class="photocaption">'.$caption.'</p>'; 							
		
						} 
						if ($video) {
						
							$pattern = "/height=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video); 
							$pattern = "/width=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video);
						
							echo '<div class="photowrap">';
							echo '<div class="videowrap"><div class="embedcontainer">' . $video . '</div></div>';
							sno_videographer($classname);
							echo '</div>';
						
						}
        	 
				$title = get_the_title(); 
				
				if ($sidebyside_title != 'true') {
	       			echo '<h1 id="storyheadline" class="storyheadline">' . $title . '</h1>';
					echo '<div class="dividingline"></div>';
				}

				$deck = get_post_meta($post->ID, 'sno_deck', true);
				if ($deck) {
					echo '<div class="storydeck">';
					echo '<p>' . $deck . '</p>';
					echo '</div>';
				echo '<div class="dividinglinedeck"></div>';
				}
				
				if (get_theme_mod('lf-byline-display') != 'Hide') {
					echo '<p class="byline">' . snowriter() . '</p>'; 
				}

				if ($sidebyside_title != 'true') {
					echo '<p class="longdate">';
						echo get_sno_timestamp(); edit_post_link('Edit Side by Side Container Story',' &bull; ','');
					echo '</p>';
				}
                
                echo '<div class="leftside storybody">';

					echo '<span class="storycontent">';
						the_content();
					echo '</span>';
				echo '</div>';
			echo '</div>';
		endwhile; else: endif; 
						
						echo '<div class="clear"></div>';

// start of loop that creates individual chapter displays		
				$part = '';
				if ($pageposts): 
					foreach ($pageposts as $post):
						setup_postdata($post);
					
						$part++;
						$custom_fields = get_post_custom($post->ID);
							$video = $custom_fields['video'][0];
							$videographer = $custom_fields['videographer'][0];
							$deck = $custom_fields['sno_deck'][0];
							$audio = $custom_fields['audio'][0];
								$audioplayer = '';
							$imagelocation = $custom_fields['featureimage'][0]; 
							$videolocation = $custom_fields['videolocation'][0]; 
							$sno_longform_image = $custom_fields['sno_longform_image'][0]; 
							$imageid = get_post_thumbnail_id(); 
							$postid = $post->ID;
							

						if (has_post_thumbnail()) {
	   						$caption = get_post_field('post_excerpt', $imageid);
							$photographer = get_post_meta($imageid, 'photographer', true);
	   					}


						echo '<div class="content sidechapter">';
							
						if ($imagelocation == "Slideshow of All Attached Images") {

							sno_sfi_story_page($post, $caption, $photographer);
														
						} else if ((has_post_thumbnail()) && ($imagelocation == "Above Story")) {
	
							sno_get_single_image($post, $caption, $photographer);
							echo sno_photographer($wrap);
		   					echo '<p class="photocaption">'.$caption.'</p>'; 							
		
						} 
						
						if (($videolocation == "Above Story") && ($video)) {
						
							$pattern = "/height=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video); 
							$pattern = "/width=\"[0-9]*\"/"; 
							$video = preg_replace($pattern, "", $video);
						
							echo '<div class="photowrap">';
							echo '<div class="videowrap"><div class="embedcontainer">' . $video . '</div></div>';
							sno_videographer($classname);
							echo '</div>';
						
						}
				
						$title = get_the_title();
						if ($title != 'None') {
	            			echo '<h1 id="storyheadline" class="storyheadline">' . $title . '</h1>';
							echo '<div class="dividingline"></div>';
						}
						
						if ($deck) {
							echo '<div class="storydeck">';
							echo '<p>' . $deck . '</p>';
							echo '</div>';
							echo '<div class="dividinglinedeck"></div>';
						}
				
						if (get_theme_mod('lf-byline-display') != 'Hide') {
							echo '<p class="sbs_byline">' . snowriter() . '</p>'; 
						}
                	
                		echo '<div class="leftside">';
            			edit_post_link('Edit This Chapter','<p>','</p>');

						if ((($videolocation == "Beside Story") && ($video)) || (($imagelocation == "Beside Story") && (has_post_thumbnail()) && ($sno_longform_image != "true"))) {

							echo '<div class="permalinkphotobox">';

	                		if ((has_post_thumbnail()) && ($imagelocation == "Beside Story") && ($sno_longform_image != "true")) {
                		
									sno_get_single_image($post, $caption, $photographer);
							
									sno_photographer($wrap);
	   						
	   								if ($caption) { 
	   									echo '<p class="photocaption">'.$caption.'</p>'; 
	   								} else if ($oldcaption) { 
	   									echo '<p class="photocaption">'.$oldcaption.'</p>';
	   								}
								if ($photographer || $caption) { } else { echo '<div class="photobottom"></div>'; }
		               	
               				}
               				
							if ((($videolocation == "") || ($videolocation == "Beside Story")) && ($video)) {
						
								$pattern = "/height=\"[0-9]*\"/"; 
									$video = preg_replace($pattern, "height='300'", $video); 
									$pattern = "/width=\"[0-9]*\"/"; 
									$video = preg_replace($pattern, "width='400'", $video);
						
								echo '<div class="videowrap storyshadow"><div class="embedcontainer">' . $video . '</div></div>';
								sno_videographer($classname);

							}
							
							echo '</div>';
						
						}
						echo '<div class="storybody">';
							echo '<span class="storycontent">';
								the_content();
							echo '</span>';
						echo '</div>';	
						
						echo '<div class="clear" style="margin-top:30px;"></div>';		
						
						echo sno_get_staff_profile_preview($postid);
		

				// start comments
				
			        if (get_theme_mod('comments')=="Enable" && $post->comment_status == 'open') {
			        	$commentpost = $postid;
			        	echo "<div class='comments_link sno-animate' style='display:none;'><p><a href='" . get_the_permalink() . "#comments'>";
			        		comments_number( 'Leave a Comment', 'View 1 Comment', 'View % Comments' );
			        		echo '</a></p></div>';
			        	echo '<div class="comments_hide">';
						echo "<div class='widgetwrap sbscomments'>";
								echo "<div class='titlewrap cursorpoint commentsbox sbs$commentpost' id='commentsbox'><div id='expand' class='expand$commentpost'><div class='fa fa-plus-square'></div></div><div id='collapse' class='collapse$commentpost'><div class='fa fa-minus-square'></div></div>
									<div class='widgettitle-nonsno'>";

										$comments_number = get_comments_number($postid);
										if ($comments_number == 0) $comments_text = "Leave a Comment";
										if ($comments_number == 1) $comments_text = "1 Comment";
										if ($comments_number > 1) $comments_text = "$comments_number Comments";
										echo $comments_text;

									
									echo '</div>';
									echo "</div><div id='commentsbody' class='widgetbody commentsbody$commentpost'><div id='commentblock'>";

									if (get_theme_mod('comments-policy')) echo '<p>' . get_theme_mod('comments-policy') . '</p>'; 

									echo '<ol class="commentlist">';
										$comments = get_comments(array(
											'post_id' => $commentpost,
											'order' => 'ASC',
											'status' => 'approve' 
										));

									foreach ($comments as $comment) : 
										$comment_id = get_comment_ID();

										echo "<li id='comment-$comment_id'>";
											comment_author_link();
											echo ' on ';
											if ($comment->comment_approved == '0') echo '<em>Your comment is awaiting moderation.</em>';
											comment_date('F jS, Y'); echo ' '; comment_time(); echo ' '; edit_comment_link('(Edit)','','');
											echo '<div class="commenttext">';
												echo '<div style="float:left;margin:0px 10px 5px 0px;">';
													echo get_avatar( $comment, $size = '70' );
												echo '</div>';
												comment_text();
												echo '<div class="clear;"></div>';
											echo '</div>';
										echo '</li>';
									endforeach;
									
									echo '</ol>';

									?><form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
										<?php if ( $user_ID ) : ?>
											<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a></p>
										<?php else : ?>
											<p><label for="name">Name <?php if ($req) echo "(required)"; ?></label><br />
											<input type="text" name="author" id="name" value="<?php echo $comment_author; ?>" size="50" tabindex="1" /></p>
											<p><label for="email">Email Address <?php if ($req) echo "(required)"; ?></label><br />
											<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="50" tabindex="2" /></p>
										<?php endif; ?>

										<?php // spam control field ?>

											<div style="display:none"><input type="text" name="sno_is_legit_comment" id="spam_stopper" value="SNO_Spam_Stopper"/></p></div>

	             							<script type="text/javascript">
												$(function(){
													$('input[name="sno_is_legit_comment"]').attr('name', 'sno_stop_spam');
												});
											</script>

										<?php // end spam control ?>

										<p><label for="words">Speak your mind</label><br /><textarea name="comment" id="words" cols="40" rows="10" tabindex="4"></textarea></p>
										<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
										<input type="hidden" name="redirect_to" value="<?php echo $parent_url; ?>" />
										<input type="hidden" name="comment_post_ID" value="<?php echo $postid; ?>" /></p>
										<?php do_action('comment_form', $postid); ?>
										</form><?php

								echo '</div></div><div class="widgetfooter"></div>';
							echo '</div>';
							echo '</div>';
							?>
	             			
	             			<script type="text/javascript">
        						$(document).ready(function() {
    								$(".sbs<?php echo $commentpost; ?>").click(function() {
    							    	$(".commentsbody<?php echo $commentpost; ?>").slideToggle('slow');
    							    	$(".expand<?php echo $commentpost; ?>").toggle();
    							    	$(".collapse<?php echo $commentpost; ?>").toggle();
    								});
								});				
							</script><?php
        				}
				// end comments 

					echo '</div>';
					echo '</div>';
					

					endforeach;  
				else : endif; 
				wp_reset_query();
				
		echo '<div class="clear"></div>';

		echo '<div class="footerbar">';
		
				echo '<p>';
				if (get_theme_mod('google-apps')) {
					echo '<a href="' . get_theme_mod('google-apps') . '">';
					bloginfo('name');
					echo '</a> &bull; ';
				} else {
					echo '<a href="' . get_bloginfo('home') . '">';
					bloginfo('name');
					echo '</a> &bull; ';				
				}
				echo 'Copyright ' . date('Y'). ' &bull; ';
				$sno_attribution = get_option('sno_analytics_options');
				if ($sno_attribution['sno_hosting_credit'] == "None") {

				} else if ($sno_attribution['sno_hosting_credit'] == "Boosting Blue") {
					echo 'Hosting and Support by <a href="https://boostingblue.com">Boosting Blue</a> &bull; ';
				} else {
					echo '<a href="http://snosites.com/why-sno/">FLEX WordPress Theme</a> by <a href="https://snosites.com">SNO</a> &bull; ';
				}
				wp_loginout(); 
				wp_register(' &bull; ', '');
				echo '</p>';
		echo '</div>';
		
		do_action('wp_footer'); ?>

   </div>

</div>
</div>
</div>
</body>
<script type="text/javascript">
// start of scroll to view

$(document).ready(function() {

var win = $(window);
var allMods = $(".sno-animate");
var allWPcaptions = $(".wp-caption");

// Already visible modules
allMods.each(function(i, el) {
  var el = $(el);
  if (el.visible(true)) {
    el.addClass("already-visible"); 
  } 
});
allWPcaptions.each(function(i, el) {
  var el = $(el);
  if (el.visible(true)) {
    el.addClass("already-visible"); 
  } 
});


$(window).scroll(function(event) {
  
  $(".sno-animate").each(function(i, el) {
    var el = $(el);
    if (el.visible(true)) {
      el.addClass("come-in");     
    } 
  });
  $(".wp-caption").each(function(i, el) {
    var el = $(el);
    if (el.visible(true)) {
      el.addClass("come-in");     
    } 
  });
  
});


});
//end of scroll to view

</script>
<script type="text/javascript">
    			$("#hover-menu").click(function(){
				    $("#altheader-searchbox").toggle('slow');					
				});  
				
								if ($('.slidemenu').is(":visible")) {
									$('.hidethis').css({ visibility: "hidden" });
									$('#altheader-searchbox').css({ zIndex: "1001"});
								} else {
									$('.hidethis').css({ visibility: "visible" });
									$('#altheader-searchbox').css({ zIndex: "99"});
								}
			$('.sno-menu').click(function() {
			
				$('#hoverbar_menu').fadeToggle();
				$('.menu-icon').toggle();
				$('.close-icon').toggle();
				$('#hoverbar_menu').css({ height: $(window).height() - 50 });
			
			});


</script>
	<script type="text/javascript">
		$("a[href='#slideshow']").on('click', function(event) { return false; });
		$("a[href='#photo']").on('click', function(event) { return false; });

		$("#snotop").hide();
	
		$(function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 400) {
					$('#snotop').fadeIn();
				} else {
					$('#snotop').fadeOut();
				}
				if ($(this).scrollTop() > 200) {
					$('.header').fadeIn();
				}
				
			});

			$('#back-top a').click(function () {
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});

		});

			$(document).ready(function () {
				var top_elements = jQuery('#mainbody').offset().top;
				var wp_adminbar = 0;
				if (jQuery('#wpadminbar').length > 0) wp_adminbar = jQuery('#wpadminbar').height();
				
				var jumpbutton = top_elements + 20;
				var headerLocation   = $("#mainbody").offset().top;
				$(window).scroll(function () {
					if ($(this).scrollTop() > (headerLocation - $(window).height()) ) {
						$('#jump-arrow').fadeOut();
					} else {
						$('#jump-arrow').fadeIn();
					}
				});

				$('#jump-arrow').click(function () {
					$('html, body').animate({ scrollTop: $("#mainbody").offset().top - wp_adminbar }, 500);
					return false;
				});
			
			});
	</script>

</html>