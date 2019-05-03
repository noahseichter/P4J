<?php echo '<div id="sidebar">';

	if (get_theme_mod('sno_ad_network_nonhome') != 'Bottom') echo sno_ad_network($ad=null, $styles=null);
		
	if ( is_active_sidebar(1) ) {
	
		dynamic_sidebar(1);
		
	} else {
					
		dynamic_sidebar(5);

	}
	
	if (get_theme_mod('sno_ad_network_nonhome') == 'Bottom') echo sno_ad_network($ad=null, $styles=null);


echo '</div>';
?>