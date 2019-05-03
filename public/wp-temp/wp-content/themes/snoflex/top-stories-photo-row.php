<?php $mobile = ''; $detect = new SNO_Mobile_Detect; if( $detect->isMobile() || $detect->isTablet() ) $mobile = 1; ?>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
  $('#topstories').flexslider({
    animation: "slide",
    animationLoop: true,
    controlNav: false,
    directionNav: true,
    slideshow: false,
    itemMargin: 1,
    touch: true,
    startAt: 0,
    itemWidth: 313,
    minItems: 1,
    move: 1,
    maxItems: 3
  });
});
//$(window).load(function() {
//	$('.topstoryphotoslide').width('313');
//});
</script>
<div id="rowslider">
<div id="homepagefull">
		<?php $loopcounter=0; $featurecount = get_theme_mod('featured-count'); if ($featurecount == '') { $featurecount = 4; } ?>
<div class="flex-container" id="extendfull">
	<div id="topstories" class="flexslider slideroverlay">
		<ul class="slides">
				<?php query_posts('showposts='.$featurecount.'&cat='.get_theme_mod('featured-cat')); ?> 
				<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
				<?php if (has_post_thumbnail()) { ?>
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'tsbigblock');?>
    			<?php if ( $image[1] == 475 && $image[2] == 300 ) { ?>

				<li class="topstoryphotoslide" style="max-width:33%;" id='box-<?php echo $post->ID; ?>'>
					<?php $customlink=get_post_meta($post->ID, 'customlink', true); $postid = $post->ID; ?>
    
    
    
							<a href="<?php if (($customlink) && (get_theme_mod('top-stories-links')=="Yes")) { echo $customlink; } else { the_permalink(); } ?>"><img src="<?php echo $image[0]; ?>" style="width:100%;height:auto;" id="grow-<?php echo $postid; ?>" class="catboxphoto" alt="<?php the_title(); ?>" /> 
		
    						<?php	echo "<div id='box-$postid-hover' class='homeboxdesc' style='display:none;'>";
    								$categories = get_the_category(); $cat_list = array();
										foreach($categories as $category)  {  	
											if ($category->term_id != get_theme_mod('featured-cat')) $cat_list[] = $category->term_id;							
										}
    									$cat_list = array_filter($cat_list); $co = '';
												if (isset ($cat_list[0]) && $cat_list[0] && get_theme_mod('top-stories-hide-cat') == 'No') {
													foreach ($cat_list as $cat) {
														if ($co) $co .= ', ';
														$co .= get_cat_name($cat);
													}
													echo '<div class="topstorycat"style="margin-top: 30px;text-align:center;">';
														echo '<span class="blockscat">';
															echo $co;
														echo '</span>';
													echo '</div>';

												} else {
													echo '<div class="topstorycat"style="margin-top: 65px;text-align:center;"></div>';
												}
										echo '<h3 class="gridfallback maingridheadline">';
										echo get_the_title($post->ID);
										echo '</h3>';
										
										if (get_theme_mod('top-stories-hide-date')=="No") {
											echo '<p class="photorowdate">';
												the_time("F j, Y");
											echo '</p>';
										}						

    								echo '</div>'; ?>
							</a>
							<?php if ($mobile == '' || get_theme_mod('top-stories-mobile-override') == "On") { ?>
								<script type="text/javascript">
									$(document).ready(function() {
   									 	$("#box-<?php echo $postid; ?>").mouseenter(function() {
   											$("#grow-<?php echo $postid; ?>").removeClass('shrink');
   											$("#grow-<?php echo $postid; ?>").removeClass('grow');
   											$("#box-<?php echo $postid; ?>-hover").fadeIn();
   											$("#grow-<?php echo $postid; ?>").addClass('grow');
   											}).mouseleave(function() {
   											$("#box-<?php echo $postid; ?>-hover").fadeOut();
   											$("#grow-<?php echo $postid; ?>").addClass('shrink');
  										});
  										});
								</script>
							<?php } else { ?>
								<script type="text/javascript">
									$(document).ready(function() {
   											$("#box-<?php echo $postid; ?>-hover").fadeIn();
  										});
								</script>
							<?php } ?>

				</li>
				<?php } ?>
				<?php } ?>
				<?php endwhile; else: ?>
				<?php endif; ?>
				
		</ul>



	</div>
</div>
</div>
</div>
<?php if (get_theme_mod('top-stories-extend') == 'Extend') { 
	if (get_theme_mod('top-stories-extend-width') == 'Full Browser') { ?>
		<script>
			$(document).ready(function() {
				var offset = $("#homepagefull").offset();
				var left = 15 - offset.left;
				document.getElementById('extendfull').style.marginRight = left + "px";		
				document.getElementById('extendfull').style.marginLeft = left + "px";
			});
		</script>
	<?php } else { ?>
		<script>
			$(document).ready(function() {
				var offset = $("#homepagefull").offset();
				var left;
				left = -<?php echo get_theme_mod('top-stories-extend-width')?>; 
				if (Math.abs(left) - 15 > offset.left) left = 15 - offset.left;
				document.getElementById('extendfull').style.marginRight = left + "px";		
				document.getElementById('extendfull').style.marginLeft = left + "px";		
			});
		</script>
<?php }} ?>

<div style="clear:both"></div>