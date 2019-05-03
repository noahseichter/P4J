<?php if ( 	(get_theme_mod('leaderad-type')=="Static Image" && get_theme_mod('leader-image')) || 
			(get_theme_mod('leaderad-type-right')=="Static Image" && get_theme_mod('leader-image-right') && (get_theme_mod('leaderad-center') != "Center")) || 
			(get_theme_mod('leaderad-type')=="Ad Tag" && get_theme_mod('openx-code')) || 
			(get_theme_mod('leaderad-type-right')=="Ad Tag" && get_theme_mod('openx-code-right')) && (get_theme_mod('leaderad-center') != "Center") ||
			(get_theme_mod('leaderad-type')=="SNO Ad Rotate" || get_theme_mod('leaderad-type-right')=="SNO Ad Rotate")
		) { ?>
<div class="leaderboardwrap">
	<div id="leaderboard">
	<div class="leaderboardadwrap"<?php if (get_theme_mod('leaderad-center') == "Center") echo ' style="margin:0px auto;float:none;"'; ?>>
	<?php if (get_theme_mod('leaderad-type')=="Static Image") { 
	
		 $leaderurl=get_theme_mod('leader-url'); $leaderimage=get_theme_mod('leader-image'); 
		 if ($leaderurl) echo '<a target="_blank" href="'.$leaderurl.'">'; if ($leaderimage) echo '<img src="'.$leaderimage.'" />'; if ($leaderurl) echo '</a>'; 

	 } else if (get_theme_mod('leaderad-type')=="Ad Tag") { 		
	
		 echo do_shortcode(get_theme_mod('openx-code')); 
	
	 } else if (get_theme_mod('leaderad-type')=="SNO Ad Rotate") { 
	 			
		$ad_args = array(
			'is_widget'		=> 0,
			'group_ids'		=> array( '0' => get_option('sno_ar_leaderboard_main') ),
			'num_ads'		=> 1,
			'num_columns'	=> 1
		);
		
		if (function_exists('snoadrotate_show_ad_group')) snoadrotate_show_ad_group( $ad_args );

	 
	 } ?>
	 </div>
	 
	 <?php if (get_theme_mod('leaderad-center') != 'Center') { ?>
	 
	 <div class="headeradright">

	<?php if (get_theme_mod('leaderad-type-right')=="Static Image") { 
	
		 $leaderurlright=get_theme_mod('leader-url-right'); $leaderimageright=get_theme_mod('leader-image-right'); 
		 if ($leaderurlright) echo '<a target="_blank" href="'.$leaderurlright.'">'; if ($leaderimageright) echo '<img src="'.$leaderimageright.'" class="leaderimageright" />'; if ($leaderurlright) echo '</a>'; 

	 } else if (get_theme_mod('leaderad-type-right')=="Ad Tag") { 		
	
		 echo do_shortcode(get_theme_mod('openx-code-right')); 

	 } else if (get_theme_mod('leaderad-type-right')=="SNO Ad Rotate") { 
	 			
		$ad_args = array(
			'is_widget'		=> 0,
			'group_ids'		=> array( '0' => get_option('sno_ar_leaderboard_small') ),
			'num_ads'		=> 1,
			'num_columns'	=> 1
		);
		if (function_exists('snoadrotate_show_ad_group')) snoadrotate_show_ad_group( $ad_args );

	 } ?>

	 </div>

	<?php } ?>
	
	</div>
</div>
<?php } ?>