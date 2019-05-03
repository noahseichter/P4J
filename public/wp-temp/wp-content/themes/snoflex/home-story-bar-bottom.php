<?php if (get_theme_mod('hbs-blocks') == "Blocks") { ?>
<?php 	if ((get_theme_mod('hbs-blocks-extend-width') == 15 && get_theme_mod('hbs-blocks-extend') == 'Extend') || (get_theme_mod('hbs-blocks-extend') != 'Extend' && get_theme_mod('outer-padding') == 'Remove'))  { 
			$itemwidth = 245; 
			if (get_theme_mod('hbs-style') == 'Style 4') $itemwidth -= 5;
			?><style>.bottom-row-blocks { max-width: <?php echo $itemwidth; ?>px; }</style><?php
		} else { 
			$itemwidth = 237; 
			if (get_theme_mod('hbs-style') == 'Style 4') $itemwidth -= 4;
			?><style>.bottom-row-blocks { max-width: <?php echo $itemwidth; ?>px; }</style><?php
		} ?>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
  $('#flex-bottom-row').flexslider({
    animation: "slide",
    animationLoop: true,
    controlNav: false,
    directionNav: true,
    slideshow: false,
    itemMargin: 1,
    touch: true,
    itemWidth: <?php echo $itemwidth; ?>,
    minItems: 2,
    move: 1,
    maxItems: 5
  });
});
</script>
<?php 	if (get_theme_mod('hbs-style') == 'Style 1') 	{ $padding_css = 'padding: 1px 1px 0px; margin-bottom: 1px;'; } else 
		if (get_theme_mod('hbs-style') == 'Style 2') 	{ $padding_css = 'padding: 0px 0px 0px; margin-bottom: 1px;'; } else 
		if (get_theme_mod('hbs-style') == 'Style 4') 	{ $padding_css = 'padding: 1px 9px 0px; margin-bottom:10px;'; } else 
														{ $padding_css = 'padding: 1px 1px 0px; margin-bottom: 1px;'; }  

		$instance['widget-style'] = get_theme_mod('hbs-style');
		$instance['header-color'] = get_theme_mod('hbs-titlebar');
		$instance['widget-gradient'] = get_theme_mod('hbs-overlay');
		$instance['widget-pattern'] = get_theme_mod('hbs-pattern');
		$instance['header-text'] = get_theme_mod('hbs-title');
		$instance['border-thickness'] = get_theme_mod('hbs-border-thickness');
		$instance['widget-border'] = get_theme_mod('hbs-border');
		$instance['widget-background'] = get_theme_mod('hbs-background');
		$instance['border-thickness2'] = get_theme_mod('hbs-border-thickness2');
		$customcolors = get_theme_mod('hbs-custom');
		$categoryslug = cat_id_to_slug(get_theme_mod('hbs-cat'));
		$categoryname = cat_id_to_name(get_theme_mod('hbs-cat'));
		$backgroundcolor = get_theme_mod('hbs-background');
		if ($customcolors != 'snoccon') {
			if ($instance['widget-style'] == 'Style 1') $backgroundcolor = get_theme_mod('widgetbackground1');
			if ($instance['widget-style'] == 'Style 2') $backgroundcolor = get_theme_mod('widgetbackground7');
			if ($instance['widget-style'] == 'Style 4') $backgroundcolor = get_theme_mod('widgetbackground4');
			if ($instance['widget-style'] == 'Style 5') $backgroundcolor = get_theme_mod('widgetbackground6');
		}
		$scroller = 'flex-container-row-bottom';

			echo '<div id="hbs-extendfull" class="teaserrow sno-animate" style="margin: 0px auto 15px;">';

		echo sno_scroller_styles($instance, $customcolors, $categoryslug, $categoryname, $scroller); 

			echo "<div id='flex-bottom-row' class='flexslider' style='$padding_css background: $backgroundcolor !important;'>";
			echo '<ul class="slides">';


			
			$exclusionarray = sno_exclude_posts();

			$args = array ( 'cat' => get_theme_mod('hbs-cat'), 'numberposts' => get_theme_mod('hbs-count'), 'post__not_in' => $exclusionarray);

			$queried_posts = get_posts( $args ); $i = '';
			foreach ($queried_posts as $queried_post) {

				$postid = $queried_post->ID;

				$image = wp_get_attachment_image_src( get_post_thumbnail_id($postid), 'tsmediumblock');
				if ( isset ($image[0]) && $image[1] == 240 && $image[2] == 150) {
			
				$link = get_permalink($postid);
				$i++;

					$catstoryposition = 'catstory-position-' . $i;
					
					echo "<li class='bottom-row-blocks' id='hbs-box-$postid'>";
						echo '<a href="' . $link . '"><img src="' . $image[0] . '" style="width:100%;height:auto;" id="hbs-grow-' . $postid . '" alt="test" />'; 
    						echo "<div id='hbs-box-$postid-hover' class='homeboxdesc' style='display:none;'>";
						
								echo '<h3 style="font-size:18px;line-height:24px;">';
									echo get_the_title($postid);
								echo '</h3>';
								
							echo '</div>';
						echo '</a>';
							?><script type="text/javascript">
								$(document).ready(function() {
   								 	$("#hbs-box-<?php echo $postid; ?>").mouseenter(function() {
   										$("#hbs-grow-<?php echo $postid; ?>").removeClass('shrink');
   										$("#hbs-grow-<?php echo $postid; ?>").removeClass('grow');
   										$("#hbs-grow-<?php echo $postid; ?>").addClass('grow');
   										$("#hbs-box-<?php echo $postid; ?>-hover").fadeIn();
   									}).mouseleave(function() {
  										$("#hbs-box-<?php echo $postid; ?>-hover").fadeOut();
   										$("#hbs-grow-<?php echo $postid; ?>").addClass('shrink');
  									});
								});
							</script><?php
					echo '</li>';	

				}
			}
			echo '</ul>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '<div class="clear"></div>';
if (get_theme_mod('hbs-blocks-extend') == 'Extend') { 
	if (get_theme_mod('hbs-blocks-extend-width') == 'Full Browser') { ?>
		<script>
			$(document).ready(function() {
				var offsetb = $("#flex-bottom-row").offset();
				var leftb = 15 - offsetb.left;
				document.getElementById('hbs-extendfull').style.marginRight = leftb + "px";		
				document.getElementById('hbs-extendfull').style.marginLeft = leftb + "px";		
			});
		</script>
	<?php } else { ?>
		<script>
			$(document).ready(function() {
				var offsetb = $("#flex-bottom-row").offset();
				var leftb;
				leftb = -<?php echo get_theme_mod('hbs-blocks-extend-width')?>; 

				if (Math.abs(leftb) + 15 > offsetb.left) leftb = 15 - offsetb.left;
				document.getElementById('hbs-extendfull').style.marginRight = leftb + "px";		
				document.getElementById('hbs-extendfull').style.marginLeft = leftb + "px";		
			});
		</script>
<?php }} 


} else { ?>

<?php $itemmargin = 15; if (get_theme_mod('outer-padding') == 'Remove') $itemmargin = 21; ?>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
  $('#flex-bottom-row').flexslider({
    animation: "slide",
    animationLoop: true,
    controlNav: false,
    directionNav: true,
    slideshow: false,
    itemMargin: <?php echo $itemmargin; ?>,
    touch: true,
    itemWidth: 174,
    minItems: 2,
    move: 1,
    maxItems: 5
  });
});
</script>
<?php
		$instance['widget-style'] = get_theme_mod('hbs-style');
		$instance['header-color'] = get_theme_mod('hbs-titlebar');
		$instance['widget-gradient'] = get_theme_mod('hbs-overlay');
		$instance['widget-pattern'] = get_theme_mod('hbs-pattern');
		$instance['header-text'] = get_theme_mod('hbs-title');
		$instance['border-thickness'] = get_theme_mod('hbs-border-thickness');
		$instance['widget-border'] = get_theme_mod('hbs-border');
		$instance['widget-background'] = get_theme_mod('hbs-background');
		$instance['border-thickness2'] = get_theme_mod('hbs-border-thickness2');
		$customcolors = get_theme_mod('hbs-custom');
		$categoryslug = cat_id_to_slug(get_theme_mod('hbs-cat'));
		$categoryname = cat_id_to_name(get_theme_mod('hbs-cat'));
		$backgroundcolor = get_theme_mod('hbs-background');
		if ($customcolors != 'snoccon') {
			if ($instance['widget-style'] == 'Style 1') $backgroundcolor = get_theme_mod('widgetbackground1');
			if ($instance['widget-style'] == 'Style 2') $backgroundcolor = get_theme_mod('widgetbackground7');
			if ($instance['widget-style'] == 'Style 4') $backgroundcolor = get_theme_mod('widgetbackground4');
			if ($instance['widget-style'] == 'Style 5') $backgroundcolor = get_theme_mod('widgetbackground6');
		}
		$scroller = 'flex-container-row-bottom';
		$o = '';
		$maxwidth = "max-width:950px;";
		if (get_theme_mod('outer-padding') == 'Remove') $maxwidth = "max-width:980px;";

					echo "<div class='teaserrow sno-animate' style='$maxwidth margin: 0px auto 15px;'>";

		echo sno_scroller_styles($instance, $customcolors, $categoryslug, $categoryname, $scroller); 

						$o .= '<div id="flex-bottom-row" class="flexslider" style="padding: 15px 10px;';
						$o .= 'background: '.$backgroundcolor.' !important;'; 
						$o .= '">';
						$o .= '<ul class="slides">';

			
			$exclusionarray = sno_exclude_posts();

			$args = array ( 'cat' => get_theme_mod('hbs-cat'), 'numberposts' => get_theme_mod('hbs-count'), 'post__not_in' => $exclusionarray);

			$queried_posts = get_posts( $args ); $i = '';
			foreach ($queried_posts as $queried_post) {
			
				$thePostID = $queried_post->ID;
				$link = get_permalink($thePostID);
				$i++;

					$catstoryposition = 'catstory-position-' . $i;
					
					$o .= "<li class='bottom-row'>";
						$image = wp_get_attachment_image_src( get_post_thumbnail_id($thePostID), 'tsmediumblock');
						if ($image) {
							$o .= '<a href="' . $link . '" title="'. get_the_title($thePostID) .'"><img src="' . $image[0] . '" alt="' . get_the_title($thePostID) . '" style="max-width:174px;"/></a>'; 
						}
						$o .= '<p class="relatedtitle">';
						$o .= '<a href="' . $link . '">' . get_the_title($thePostID) . '</a>';
						$o .= '</p>';
						if ($image == "") {
							$o .= '<p class="relatedteaser">';
							$storycontent = $queried_post->post_content;
						    $storycontent = strip_tags($storycontent);
    						$storycontent = strip_shortcodes($storycontent);
							$o .= substr($storycontent, 0, 150);
							$o .= '...</p>';
							$teaser = '';
						}
					$o .= '</li>';	
			}
			$o .= '</ul>';
			$o .= '</div>';
			$o .= '</div>';
			$o .= '</div>';
			$o .= '<div class="clear"></div>';

echo $o; $o = '';
}
?>