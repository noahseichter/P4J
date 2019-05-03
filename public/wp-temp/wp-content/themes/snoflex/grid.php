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
<script src="<?php bloginfo('template_url'); ?>/javascript/grid.js"></script>
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
<script>

	

$(function() { // when the DOM is ready...
	var pageHeight = $(".footerbar").position().top;
	pageHeight = pageHeight + 30;
	$('#mainbody').css('min-height', pageHeight);

});


	
</script>
<?php wp_head(); ?>
<?php include(TEMPLATEPATH . "/customstyles.php"); ?>
</head>
<body>
<?php
				echo '<ul id="menu" class="mobile-menu">';
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
			
			$lf_parent = get_post_meta($post->ID, 'sno_grid_list', true);
  			$lf_format = get_post_meta($post->ID, 'sno_format', true);
  			
  			
  					if (($lf_parent) && ($lf_format == 'Grid Chapter')) {
  			
  			
	             			?><script type="text/javascript">
							$(function(){
										var storyid = '<?php echo $post->ID; ?>';
										var parentid = '<?php echo $lf_parent; ?>';
								        $("#gridcontainer").fadeOut();
								        $(".main").fadeOut();
								        $("#listloader").show();
               							$.ajax({
                				            url:"/wp-admin/admin-ajax.php",
                				            type:'POST',
                				            data:'action=gridchapter&parentid=' + parentid + '&storyid=' + storyid,
 	            				            success:function(results)
	            				            { $("#gridcontainer").replaceWith(results); $("#listloader").hide(); }
	           				    	  	});
							});
							
							
												
						</script><?php

					} 

  			

  			$lf_story_override = get_post_meta($post->ID, 'sno_grid_story_override', true); 
  			$lf_story_override_kill = get_post_meta($post->ID, 'sno_grid_story_override_kill', true); 

			$custom_fields = get_post_custom($post->ID);
				$video = $custom_fields['video'][0];
				$videographer = $custom_fields['videographer'][0];
				$deck = $custom_fields['sno_deck'][0];
				$imagelocation = $custom_fields['featureimage'][0]; 
				$videolocation = $custom_fields['videolocation'][0]; 
				$immersive = $custom_fields['sno_grid_image_master'][0]; 
				$columns = $custom_fields['sno_grid_columns'][0]; 
				$sidebyside_title = $custom_fields['sno_grid_title'][0]; 
				$byline = $custom_fields['writer'][0];
				$imageid = get_post_thumbnail_id(); 
				$parent_url = get_the_permalink();
				$parent_id = $post->ID;

						if (has_post_thumbnail()) {
	   						$caption = get_post_field('post_excerpt', $imageid);
							$photographer = get_post_meta($imageid, 'photographer', true);
	   					}
	   					
	   		switch ($columns) {
	   			case 1: $column_css = "width:80%;"; $container_css = "margin-left: 10%;"; break;
	   			case 2: $column_css = "width:48.5%;margin-left:1%"; break;
	   			case 3: $column_css = "width:32%;margin-left:1%"; break;
	   			case 4: $column_css = "width:23.75%;margin-left:1%"; break;
	   			case 5: $column_css = "width:18.8%;margin-left:1%"; break;
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
				.gridchapter { float:left;<?php echo $column_css; ?> }
			</style><?php


        		echo '<div class="header">';

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
					
			echo '<div id="listloader" class="spinner">
				  <div class="bounce1"></div>
				  <div class="bounce2"></div>
				  <div class="bounce3"></div>
				  </div>'; 



       
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
						AND sno_format.meta_value = 'Grid Chapter'
						)
						JOIN $wpdb->postmeta AS sno_grid_list ON(
						$wpdb->posts.ID = sno_grid_list.post_id
						AND sno_grid_list.meta_value = '$post->ID'
						)
						JOIN $wpdb->postmeta AS sno_grid_order ON(
						$wpdb->posts.ID = sno_grid_order.post_id
						AND sno_grid_order.meta_key = 'sno_grid_order'
						)
						WHERE $wpdb->posts.post_status = 'publish'
						ORDER BY CAST(sno_grid_order.meta_value AS UNSIGNED INTEGER ) ASC, post_date DESC
						";


 					$pageposts = $wpdb->get_results($querystr, OBJECT);
					wp_reset_query();


?>

<div id="storypage"><div id="gridpage">
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
?>

        <div id="mainbody" style="top:47px;">

			<div class="content main"><?php

			
						if (($imagelocation == "Slideshow of All Attached Images") && ($immersive == '')) {
	
							sno_sfi_story_page($post, $caption, $photographer);
														
						} else if ((has_post_thumbnail()) && ($immersive == '')) {
							
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
				
				if (get_theme_mod('lf-byline-display') != 'Hide' && $byline != '') {
					echo '<p class="byline">' . snowriter() . '</p>'; 
				}

				if ($sidebyside_title != 'true' && is_user_logged_in()) {
					echo '<p class="longdate">';
						echo get_sno_timestamp(); edit_post_link('Edit Grid Container Story',' &bull; ','');
					echo '</p>';
				}
                
                $edit_link = get_edit_post_link($post->ID);
                echo '<div class="leftside storybody">';

					echo '<span class="storycontent">';
						the_content();
					echo '</span>';
				echo '</div>';
			echo '</div>';
		endwhile; else: endif; 
						
						echo '<div class="clear"></div>';

// start of loop that creates individual chapter displays		

			echo '<div class="gridcontainer" id="gridcontainer">';
				$part = ''; $i = '';
				if ($pageposts): 
					foreach ($pageposts as $post):
						setup_postdata($post);
					
						$part++;
						$custom_fields = get_post_custom($post->ID);
							$sno_longform_image = $custom_fields['sno_longform_image'][0]; 
							$imageid = get_post_thumbnail_id(); 
							$postid = $post->ID;
							$writer = $custom_fields['writer'][0];
							$sno_teaser = $custom_fields['sno_teaser'][0];
							$storylink = get_permalink();


						echo "<div class='gridchapter sno-animate'>";
						
							echo "<div id='box-$postid' class='gridchaptercontent'>";
								$fullimage = wp_get_attachment_image_src( $imageid, 'tsbigblock'); 
								if ($fullimage[0]) {
									echo '<img src="' . $fullimage[0] . '" style="width:100%;" alt="' . get_the_title() . '" />'; 
								} else {
									echo '<div class="gridfallback" style="background: #000;width: 100%; height: 100%;overflow: hidden;">';
										echo '<h3>';
										echo get_the_title($post->ID);
										echo '</h3>';
									
										if ($writer) {
											echo '<div class="gridbyline">';
												echo snowriter();
											echo '</div>';
										}

								        if ($sno_teaser) { 
								           echo '<p>' . $sno_teaser . '</p>'; 
										} else {
											echo '<div class="gridfallbacktext">';
												the_content_limit(400, "");
											echo '</div>';
										}
									echo '</div>';
								}
								

    							echo "<div id='box-$postid-hover' class='griddesc box-$postid' style='display:none;'>";
									if ($imageid) { 
										echo '<h3 class="gridfallback">';
										echo get_the_title($post->ID);
										echo '</h3>';
									

								        if ($sno_teaser) { 
								           echo '<p>' . $sno_teaser . '</p>'; 
										} else {
											echo '<div class="gridfallbacktext">';
												the_content_limit(400, "");
											echo '</div>';
										}
									} 
    							echo '</div>';
    							

		
							echo '</div>';	                	
						echo '</div>';
					
						?>
							<script>
								$(document).ready(function() {
    							
    							$("#box-<?php echo $postid; ?>").mouseenter(function() {
   							     	$("#box-<?php echo $postid; ?>-hover").fadeIn();
   							 	}).mouseleave(function() {
  							      	$("#box-<?php echo $postid; ?>-hover").fadeOut();
  							  	});

								$(function(){
           							$('.box-<?php echo $postid; ?>').click(function(){
										var storyid = '<?php echo $postid ?>';
										var parentid = '<?php echo $parent_id; ?>';
								        $("#gridcontainer").fadeOut();
								        $(".main").fadeOut();
								        $("#listloader").show();
               							$.ajax({
                				            url:"/wp-admin/admin-ajax.php",
                				            type:'POST',
                				            data:'action=gridchapter&parentid=' + parentid + '&storyid=' + storyid,
 	            				            success:function(results)
	            				            { $("#gridcontainer").replaceWith(results); $("#listloader").hide(); }
	           				    	  	});
	         						});
								});
								});

							jQuery(window).load(function() {
								jQuery('.flexslider').animate({'opacity': 1}, { 'duration': 'slow'});
								jQuery('.flex-container').css('background', 'unset');
							});
							
							</script><?php
						
						
					endforeach;  
				else : endif; 
				wp_reset_query();
			echo '<div class="clear"></div>';
			
			if (is_user_logged_in()) {
				echo "<a href='$edit_link'>Edit Grid Container Story</a>";
			}
			echo '</div>';
				
		echo '<div class="clear"></div>';

		echo '<div class="footerbar" style="position:fixed;bottom:0;">';
		
				echo '<p>';
				if (get_theme_mod('google-apps')) {
					echo '<a href="' . get_theme_mod('google-apps') . '">';
					bloginfo('name');
					echo '</a> &bull; ';
				} else {
					echo '<a href="' . get_bloginfo('url') . '">';
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
			});

			$('#back-top a').click(function () {
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});

		});
	</script>

</html>