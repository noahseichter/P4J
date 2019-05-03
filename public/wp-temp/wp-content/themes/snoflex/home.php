<?php 

if (isset($_GET['full-site'])) $homecheck = $_GET['full-site']; $immersion_activate = '';
if ((get_theme_mod('home-immersive-activate') == 'Immersive' && !(isset($homecheck))) || get_theme_mod('home-immersive-disable-widgets') == "Disable") { 

	query_posts('showposts=1&cat='.get_theme_mod('home-immersive-cat')); 
	if (have_posts()) : while (have_posts()) : the_post();
		$custom_fields = get_post_custom($post->ID);
		if (isset($custom_fields['_thumbnail_id'])) $imageid = $custom_fields['_thumbnail_id'][0]; 
		$breakingimage = wp_get_attachment_image_src( $imageid, 'full'); 
		if ($breakingimage[1] > 850) $immersion_activate = 'on';
	endwhile; else: endif;
}

if (get_theme_mod('home-immersive-activate') == 'Immersive' && (!(isset($homecheck)) || get_theme_mod('home-immersive-disable-widgets') == "Disable") && $immersion_activate == 'on') { 

	include(TEMPLATEPATH . "/home-immersion.php");	
	
} else {
get_header();

echo '<div id="home">';
echo '<div id="content">';

if ( is_active_sidebar(20) ) {

	echo '<div id="mobilehomepage" style="display:none;">';

		if ( function_exists('dynamic_sidebar') && dynamic_sidebar(20) ) : else : endif;

		echo '</div>';

}

echo '<div class="fullhomepage">';
	if (get_theme_mod('home-breaking') == 'Display') include(TEMPLATEPATH . "/breaking-home.php");
	if (get_theme_mod('mm-home') == 'Display') include(TEMPLATEPATH . "/multimedia-home.php");
	if ((get_theme_mod('top-stories-wide')=="Style 2") && (get_theme_mod('top-stories-scrollbox')=="Display")) include(TEMPLATEPATH . "/top-stories-wide.php");
	if ((get_theme_mod('top-stories-wide')=="Style 3") && (get_theme_mod('top-stories-scrollbox')=="Display")) include(TEMPLATEPATH . "/top-stories-wide-text.php");
	if ((get_theme_mod('top-stories-wide')=="Style 5") && (get_theme_mod('top-stories-scrollbox')=="Display")) include(TEMPLATEPATH . "/top-stories-blocks-wide.php");
	if ((get_theme_mod('top-stories-wide')=="Style 7") && (get_theme_mod('top-stories-scrollbox')=="Display")) include(TEMPLATEPATH . "/top-stories-wide-text-thumbs.php");
	if ((get_theme_mod('top-stories-wide')=="Style 8") && (get_theme_mod('top-stories-scrollbox')=="Display")) include(TEMPLATEPATH . "/top-stories-wide-tall.php");
	if ((get_theme_mod('top-stories-wide')=="Style 9") && (get_theme_mod('top-stories-scrollbox')=="Display")) include(TEMPLATEPATH . "/top-stories-photo-row.php");
	if ((get_theme_mod('top-stories-wide')=="Style 10") && (get_theme_mod('top-stories-scrollbox')=="Display")) include(TEMPLATEPATH . "/top-stories-blocks-23.php");

	if ( function_exists('dynamic_sidebar') && dynamic_sidebar(11) ) : else : endif;

	// add extra column here if options are 1200+ on width and extra widget area is checked
	// width should be set to a percentage in the custom css file and then homepage percentage needs to be adjusted accordingly with a 15px margin
	
	$width1 = get_theme_mod('content-width'); if ($width1 == '') $width1 = 980;
	if ( $width1 >= 1200 && is_active_sidebar(10) && get_theme_mod('extra-column') == 'Display') {
		echo "<div class='hp_extra'>";
			dynamic_sidebar(10);
		echo '</div>';
	}	
	
	
echo '<div class="hp_wide_extra" style="';	
		if ((get_theme_mod('sno-layout') == "Option 4") || (get_theme_mod('sno-layout') == "Option 5") || (get_theme_mod('sno-layout') == "Option 6")) { 
			echo 'float:right;';
		} else { 
			echo 'float:left;'; 
		} 
	echo '">';

	echo '<div id="homepage" style="';
		if ((get_theme_mod('sno-layout') == "Option 4") || (get_theme_mod('sno-layout') == "Option 5") || (get_theme_mod('sno-layout') == "Option 6")) { 
			echo 'float:right;';
		} else { 
			echo 'float:left;'; 
		} 
	echo '">';


		if (get_theme_mod('top-stories-scrollbox') == "Display") { 
			if (get_theme_mod('top-stories-wide') == "Style 1") include(TEMPLATEPATH . "/top-stories-scrollbox.php");
			if (get_theme_mod('top-stories-wide') == "Style 4") include(TEMPLATEPATH . "/top-stories-blocks.php");
			if (get_theme_mod('top-stories-wide') == "Style 6") include(TEMPLATEPATH . "/top-stories-scrollbox-thumbs.php");
		}
		
		
		echo '<div id="homepagewide">';
					
			if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : endif;
		echo '</div>';
		
		echo '<div class="clear"></div>';

		if (get_theme_mod('sno-layout') == "Option 3" || get_theme_mod('sno-layout') == "Option 1" || get_theme_mod('sno-layout') == "Option 2") {
			echo "<div class='hp_top_left'>";
				dynamic_sidebar(3);
			echo '</div>';
			echo "<div class='hp_top_center'>";
				dynamic_sidebar(4);
			echo '</div>';
		}

		if (get_theme_mod('sno-layout') == "Option 6" || get_theme_mod('sno-layout') == "Option 5"|| get_theme_mod('sno-layout') == "Option 4") {
			echo "<div class='hp_top_left'>";
				dynamic_sidebar(4);
			echo '</div>';
			echo "<div class='hp_top_center'>";
				dynamic_sidebar(5);
			echo '</div>';
		}



	echo '</div>';
echo '</div>';

	echo '<div id="sidebar" style="';	
		if ((get_theme_mod('sno-layout') == "Option 4") || (get_theme_mod('sno-layout') == "Option 5") || (get_theme_mod('sno-layout') == "Option 6")) { 
			echo 'float:left;';
		} else { 
			echo 'float:right;'; 
		} 
	echo '">';
		echo '<div class="nothing" style="width:100%">';
		
			if (get_theme_mod('sno_ad_network_position') != 'Bottom') echo sno_ad_network($ad=null, $styles=null);

			if ((get_theme_mod('sno-layout') == "Option 4") || (get_theme_mod('sno-layout') == "Option 5") || (get_theme_mod('sno-layout') == "Option 6")) { 
				if ( function_exists('dynamic_sidebar') && dynamic_sidebar(3) ) : else : endif;
			} else {
				if ( function_exists('dynamic_sidebar') && dynamic_sidebar(5) ) : else : endif;
			}

			if (get_theme_mod('sno_ad_network_position') == 'Bottom') echo sno_ad_network($ad=null, $styles=null);

		echo '</div>';
	echo '</div>';


echo '<div class="clear"></div>';

	if ( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-m-11') ) : else : endif;

	if (get_theme_mod('hts') == 'Display') include(TEMPLATEPATH . "/home-story-bar.php");
	
echo '<div class="clear"></div>';


	echo "<div class='hp_bottom_left'>";
		dynamic_sidebar(7);
	echo '</div>';
			
	echo "<div class='hp_bottom_center'>";
		dynamic_sidebar(8);
	echo '</div>';

	echo '<div class="hp_bottom_right">';
		dynamic_sidebar(9);
	echo '</div>';


echo '<div class="clear"></div>';
		
	if ( function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-b-11') ) : else : endif;

	if (get_theme_mod('hbs') == 'Display') include(TEMPLATEPATH . "/home-story-bar-bottom.php");
	
echo '</div>'; // end of fullhomepage

echo '</div>';
echo '</div>';
get_footer(); 
}
