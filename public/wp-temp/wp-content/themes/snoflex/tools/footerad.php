<?php if (	(get_theme_mod('footerad-type')=="Static Image" && get_theme_mod('footerad-image')) || 
			(get_theme_mod('footerad-type-right')=="Static Image" && get_theme_mod('footerad-image-right') && (get_theme_mod('footerad-center') != "Center")) || 
			(get_theme_mod('footerad-type')=="Ad Tag" && get_theme_mod('footerad-code')) || 
			(get_theme_mod('footerad-type-right')=="Ad Tag" && get_theme_mod('footerad-code-right')) && (get_theme_mod('footerad-center') != "Center") ||
			(get_theme_mod('footerad-type')=="SNO Ad Rotate" || get_theme_mod('footerad-type-right')=="SNO Ad Rotate")
		) { ?>
<div class="footeradboardwrap">
	<div id="footeradboard">
	<div class="footeradboardadwrap"<?php if (get_theme_mod('footerad-center') == "Center") echo ' style="margin:0px auto;float:none;"'; ?>>
	<?php if (get_theme_mod('footerad-type')=="Static Image") { 
	
		 $footerurl=get_theme_mod('footerad-url'); $footerimage=get_theme_mod('footerad-image'); 
		 if ($footerurl) echo '<a target="_blank" href="'.$footerurl.'">'; if ($footerimage) echo '<img src="'.$footerimage.'" />'; if ($footerurl) echo '</a>'; 

	 } else if (get_theme_mod('footerad-type')=="Ad Tag") { 		
	
		 echo do_shortcode(get_theme_mod('footerad-code')); 

	 } else if (get_theme_mod('footerad-type')=="SNO Ad Rotate") { 
	 			
		$ad_args = array(
			'is_widget'		=> 0,
			'group_ids'		=> array( '0' => get_option('sno_ar_footer_main') ),
			'num_ads'		=> 1,
			'num_columns'	=> 1
		);
		if (function_exists('snoadrotate_show_ad_group')) snoadrotate_show_ad_group( $ad_args );
	
	 } ?>
	 </div>
	 
	 <?php if (get_theme_mod('footerad-center') != 'Center') { ?>
	 
	 <div class="footeradright">

	<?php if (get_theme_mod('footerad-type-right')=="Static Image") { 
	
		 $footerurlright=get_theme_mod('footerad-url-right'); $footerimageright=get_theme_mod('footerad-image-right'); 
		 if ($footerurlright) echo '<a target="_blank" href="'.$footerurlright.'">'; if ($footerimageright) echo '<img src="'.$footerimageright.'" class="footerimageright" />'; if ($footerurlright) echo '</a>'; 

	 } else if (get_theme_mod('footerad-type-right')=="Ad Tag") { 		
	
		 echo do_shortcode(get_theme_mod('footerad-code-right')); 

	 } else if (get_theme_mod('footerad-type-right')=="SNO Ad Rotate") { 
	 			
		$ad_args = array(
			'is_widget'		=> 0,
			'group_ids'		=> array( '0' => get_option('sno_ar_footer_small') ),
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