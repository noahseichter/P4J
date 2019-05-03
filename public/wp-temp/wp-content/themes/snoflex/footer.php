<?php 
if (get_theme_mod('extra-column') == 'Display') echo '</div>';
echo '</div>';

echo '</div></div><div style="clear:both;"></div>'; 
	echo '<div class="footerwrap">';
		echo '<div id="footer">';
		
if (get_theme_mod('display-footerad')=="Active") include(TEMPLATEPATH."/tools/footerad.php");

			echo '<div class="footername">';

			if (get_theme_mod('footer-name') != '') {
				echo '<div class="footerleft">';
				echo '<p>';
					echo '<a href="' . get_option('home') . '">';
						bloginfo('name');
					echo '</a>';
				echo '</p>';
				echo '</div>';
			}
			
			if (get_theme_mod('footer-social') != '') {
				echo '<div class="footerright social-classic">';
					echo sno_display_icons();
				echo '</div>';
		}		
			
		echo '</div>';
		
		if (get_theme_mod('footer-tagline') != '') {
			echo '<div class="footertagline">';
				echo '<p>';
					bloginfo('description');
				echo '</p>';
			echo '</div>';	
		}
		
		if (get_theme_mod('footer-search') != '') {
			echo '<div class="footersearch">';
				echo sno_display_search();
			echo '</div>';
		}
		echo '<div class="clear"></div>';
		if (get_theme_mod('address')) {
			echo '<div class="footer-address">';
				echo nl2br(get_theme_mod('address'));
			echo '</div>';
		}
		if (get_theme_mod('footer-menu') == 'Display') {
			echo '<div class="footermenu">';	
				$nav_menu = get_theme_mod('nav_menu_locations');
					if ($nav_menu['footer-menu'] == '') {} else { 
						wp_nav_menu( array('theme_location' => 'footer-menu', 'menu_class' => 'footer-menu') );
					}
			echo '</div>';
			
		}
			wp_reset_query();
		echo '<div class="footercredit">';
			sno_footer_close();
		echo '</div>';
		echo '<div class="clear"></div>';
		echo '</div>';
	echo '</div>';

?><script type="text/javascript">
jQuery(window).load(function() {
	jQuery('.flexslider').animate({'opacity': 1}, { 'duration': 'slow'});
	jQuery('.flex-container').css('background', 'unset');
});

</script><?php
if (get_theme_mod('sno-animate') != 'Disable') {
?><script type="text/javascript">
// start of scroll to view


$(document).ready(function() {
	
	$("a[href='#slideshow']").on('click', function(event) { return false; });
	$("a[href='#photo']").on('click', function(event) { return false; });

var win = $(window);
var allMods = $(".sno-animate");
var allWPcaptions = $(".wp-caption");

// Already visible modules
allMods.each(function(i, el) {
  var el = $(el);
  if (el.visible(true)) {
    el.addClass("already-visible"); 
  } 
else {
  /*  Like this!  */
  el.css('visibility', 'hidden');
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
	    el.css('visibility', 'visible'); // Visible
    } 
  });
  $(".wp-caption").each(function(i, el) {
    var el = $(el);
    if (el.visible(true)) {
      	el.addClass("come-in");     
	    el.css('visibility', 'visible'); // Visible
    } 
  });
  
});


});
//end of scroll to view
</script>
<?php } ?>
<script type="text/javascript">
	$(function(){
		$(".s").focus(function(){
			$(".sno-submit-search-button").prop("disabled", false);
		});				
	});
    var top_level_links = $(".sf-menu").find('> li > a');
    // Set tabIndex to -1 so that top_level_links can't receive focus until menu is open
    $(top_level_links).next('ul')
        .attr({ 'aria-hidden': 'true', 'role': 'menu' })
        .find('a')
            .attr('tabIndex',-1);

    // Adding aria-haspopup for appropriate items
    $(top_level_links).each(function(){
        if($(this).next('ul').length > 0)
            $(this).parent('li').attr('aria-haspopup', 'true');
    });
   
jQuery( function() {
 	jQuery( '#hover-menu-side' ).on( 'touchstart click', function(e) {
 		e.preventDefault();
 			$('#sno_mobile_menu').fadeToggle();
		    $("body").toggleClass('noscroll');

 	});
 	jQuery( '.side-close-icon' ).on( 'touchstart click', function(e) {
 		e.preventDefault();
 			$('#sno_mobile_menu').fadeToggle();
			    $("body").toggleClass('noscroll');
 	});
 		
});

</script><?php

do_action('wp_footer');


echo '</div>';



if (get_theme_mod('header-alt') != "Display" && get_theme_mod('extra-column') == 'Display' && get_theme_mod('background-wrap') == 'Defined Edges' && is_active_sidebar(10)) echo '</div></div>';


if (get_theme_mod('hoverbar') != 'Deactivate') sno_get_hoverbar();

//if (get_theme_mod('teaserbar') != 'Deactivate') sno_get_teaserbar();


echo '</body></html>';