<?php

add_action('widgets_init', create_function('', "register_widget('sno_video');"));
class sno_video extends WP_Widget {

	function __construct() {

		$this->defaults = array(
			'title' => '',
			'image' => '',
			'link'  => ''
			);

		$widget_ops = array(
			'classname' => 'sno_video_category_display',
			'description' => __( 'Use this widget to display video embeds and teasers from any category.' )
			);

		$control_ops = array(
			'id_base' => 'video'
			);

		parent::__construct( 'video', __( '(SNO) Video Category Display' ), $widget_ops, $control_ops );

	}

	function widget($args, $instance) {
		extract($args); 
		$totalvideos=$instance['number']+$instance['number-headlines']; $dividingline = '';

		if(!empty($totalvideos)) { 

			$widget = $this->id; $sidebartest = get_option('sidebars_widgets'); 
			
			if ($sidebartest["sidebar-2"]) foreach ($sidebartest["sidebar-2"] as $key => $value ) { 
				if ($widget == $value) {
					$instance['sidebarname'] = 'Home Main Column'; 
					}
			}


		$videotitle = $instance['title']; 
		if ($instance['custom-view-all'] == "on") {
			$categoryslug = $instance['custom-link'];
		} else {
			$categoryslug = cat_id_to_slug($instance['category']); 
		}
		$categoryname = cat_id_to_name($instance['category']);
		$customcolors=$instance['custom-colors']; 
		
				$shadow = '';
				if ($instance['hide-shadow'] == 'Hide' && get_theme_mod('widget-shadows') == 'On') {
					$shadow = "box-shadow: none;";
				} else if ($instance['hide-shadow'] == 'Show' && get_theme_mod('widget-shadows') != 'On') {
					$shadow = "box-shadow: -1px 0 2px 0 rgba(0, 0, 0, 0.12), 1px 0 2px 0 rgba(0, 0, 0, 0.12), 0 1px 1px 0 rgba(0, 0, 0, 0.24);";
				}

				$widgetwrap_style = " style='$shadow'";
		
	
		echo "<div class='widgetwrap sno-animate sno-$widget'$widgetwrap_style>";
		echo sno_widget_styles($instance, $customcolors, $categoryslug, $videotitle, $categoryname);

					$totalvideos=$instance['number']+$instance['number-headlines']; if((!is_int($totalvideos)) || ($totalvideos==0)) $totalvideos=1; $videodivider = $instance['number']+1;
					
		if (($instance['sidebarname'] == 'Home Main Column' ) && ($instance['number-headlines'] > 0) && ($instance['two-column'] == 'on')) { 

			$videocount=0; $recent = query_posts('cat=' . $instance['category'] . '&showposts=' . $totalvideos); if (have_posts()) : while (have_posts()) : the_post(); $videocount++;
			global $post; 

			if ($videocount == 1) {
				echo '<div class="catwidgetleft" style="width:51%;padding-right:2%;">';
				$exitkey = 4;
			}
					
			if ($videocount <= $instance['number']) { 

					$video = get_post_meta($post->ID, 'video', true); 
					
					if ($video) {
                 	echo '<div class="embedcontainer">';		
                 		$pattern = "/height=\"[0-9]*\"/"; $video = preg_replace($pattern, "", $video); $pattern = "/width=\"[0-9]*\"/"; $video = preg_replace($pattern, "", $video); echo $video; 
                 	echo '</div>'; 
                 	} ?>
					
					<div style="<?php if ((($instance['show-headline']=='on') || ($instance['show-teaser']=='on') || ($instance['show-date']=='on') || ($instance['show-comments']=='on') || ($instance['show-writer']) || (is_user_logged_in())) && ($instance['remove-padding']=='on')) { ?>padding:5px 10px 0px 10px;<? } ?>">

						<?php if ($instance['show-writer'] == "on") { 
                		sno_videographer($classname);
						} ?>

						<?php if ($instance['show-headline'] == "on") { 
						$headlinesize = $instance['headline-size']; $headlineheight = floor($headlinesize * 1.5); ?>
							<div class='widgetheadline'><a href="<?php the_permalink() ?>" rel="bookmark"  class="homeheadline" style="font-size:<?php echo $headlinesize; ?>px; line-height:<?php echo $headlineheight; ?>px;margin-top:0px"title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></div>
						<?php } ?>

						<?php if ($instance['show-teaser'] == "on") { 
				  			$teaser = $instance['category-teaser']; 
  							$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
  							if ($excerpt) { 
  								echo '<p>' . $excerpt . '</p> <a href="'.get_permalink().'"><span class="readmore">Read More &raquo;</span></a>'; 
  							} else if ($teaser) { 
  								the_content_limit($teaser, " <span class='readmore'>Read More &raquo;</span>"); 
  							}
						} 
						
						  	if (($instance['show-date']=='on') || ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on')) || (is_user_logged_in())) { ?><p class="datetime"><?php
            				if ($instance['show-date']=='on') { ?><?php echo get_sno_timestamp(); }
            				if (($instance['show-date']=='on') && ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on'))) echo ' &bull; '; 
            				if ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on')) { comments_popup_link(' 0 comments', ' 1 comment', ' % comments'); } 
    						edit_post_link('Edit this story', ' &bull; ', ''); ?></p>
    					<?php } ?>
    					
					</div>
					<div class="storybottomnolineleft"></div> 		
					<?php
					
			} else {
			
				if (($videocount==$videodivider) && ($instance['headline-header'] =='on')) { ?>
					<a href="<?php echo $categoryslug; ?>"><p class="sectionhead" style="font-size:16px;margin-bottom:7px;font-weight:normal;">Recent Videos</p></a>										
					<?php } ?>
                  	<?php if($instance['teaser-thumb']=='on') { 
                  	$thumbplacement=$instance['teaser-thumb-placement']; ?>

					<?php global $post; if (has_post_thumbnail()) { 

						$unique_id = 'cat' . $this->number . $post->ID;
						
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'carouselthumb'); 
						echo "<div class='videothumbwrap' style='float:$thumbplacement;margin-$thumbplacement:0px;'>";
						echo "<div class='videophoto' id='grow-$unique_id' style='float:$thumbplacement;margin:0;background:url($thumbnail[0]) no-repeat'>";
						echo '<img class="mmoverlay" alt="' . get_the_title() . '" src="' . get_template_directory_uri() . '/images/playbutton.png" />';
						echo '</div>';
						echo '</div>';
					
					
						if (get_theme_mod('photo-animate') != 'Disable') {
							?><script type="text/javascript">
								$(document).ready(function() {
   								 	$("#grow-<?php echo $unique_id; ?>").mouseenter(function() {
   										$("#grow-<?php echo $unique_id; ?>").removeClass('shrink');
   										$("#grow-<?php echo $unique_id; ?>").removeClass('grow');
   										$("#grow-<?php echo $unique_id; ?>").addClass('grow');
   									}).mouseleave(function() {
   										$("#grow-<?php echo $unique_id; ?>").addClass('shrink');
  									});
								});
							</script><?php
						}
					
					}  
				  		
				  	} ?>
                  		
                  	<p><a class="homeheadline" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p><?php if ($instance['teaser-date']=='on') { ?><p><?php echo get_sno_timestamp(); ?></p><?php } ?>
					<div class="clear"></div><div style="margin-top:10px"></div><?php

			
			
			}
		
    		if ($videocount == $instance['number']) {
	    		$dividingline = '';
    			if ($instance['dividing-line']=='on') { 
    			 	$thickness = $instance['dividing-line-thickness'];
    			 	$linetype = $instance['dividing-line-type'];
    				$dividingline = "style='border-top:$thickness $linetype #c0c0c0;border-bottom:$thickness $linetype #c0c0c0;'";
    			}
    			echo "</div><div class='catwidgetright' $dividingline>";
    		}
		
			endwhile; else: endif; wp_reset_query();

	        if ($exitkey == 4) echo '</div>';

		
		} else {
		
					
                	$videocount=0; $recent = query_posts('cat=' . $instance['category'] . '&showposts=' . $totalvideos); if (have_posts()) : while (have_posts()) : the_post(); $videocount++;
					global $post; 

					if ($videocount <= $instance['number']) { 

					$video = get_post_meta($post->ID, 'video', true); if ($video) { 

                 		echo '<div class="embedcontainer">';
                 			
                 		$pattern = "/height=\"[0-9]*\"/"; $video = preg_replace($pattern, "", $video); $pattern = "/width=\"[0-9]*\"/"; $video = preg_replace($pattern, "", $video); echo $video; 
                 		echo '</div>';
                 	}

					?>
						<div style="<?php if ((($instance['show-headline']=='on') || ($instance['show-teaser']=='on') || ($instance['show-date']=='on') || ($instance['show-comments']=='on') || ($instance['show-writer']) || (is_user_logged_in())) && ($instance['remove-padding']=='on')) { ?>padding:5px 10px 0px 10px;<? } ?>">

						<?php if ($instance['show-writer'] == "on") { 
                		sno_videographer($classname = null);
						} ?>

						<?php if ($instance['show-headline'] == "on") { 
						$headlinesize = $instance['headline-size']; $headlineheight = floor($headlinesize * 1.5); ?>
							<div class='widgetheadline'><a href="<?php the_permalink() ?>" rel="bookmark"  class="homeheadline" style="font-size:<?php echo $headlinesize; ?>px; line-height:<?php echo $headlineheight; ?>px;margin-top:0px"title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></div>
						<?php } ?>

						<?php if ($instance['show-teaser'] == "on") { 
				  			$teaser = $instance['category-teaser']; 
  							$excerpt = get_post_meta($post->ID, 'sno_teaser', true);
  							if ($excerpt) { 
  								echo '<p>' . $excerpt . '</p> <a href="'.get_permalink().'"><span class="readmore">Read More &raquo;</span></a>'; 
  							} else if ($teaser) { 
  								the_content_limit($teaser, " <span class='readmore'>Read More &raquo;</span>"); 
  							}
						} 
						
						  	if (($instance['show-date']=='on') || ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on')) || (is_user_logged_in())) { ?><p class="datetime"><?php
            				if ($instance['show-date']=='on') { ?><?php echo get_sno_timestamp(); }
            				if (($instance['show-date']=='on') && ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on'))) echo ' &bull; '; 
            				if ((get_theme_mod('comments')=="Enable") && ($instance['show-comments']=='on')) { comments_popup_link(' 0 comments', ' 1 comment', ' % comments'); } 
    						edit_post_link('Edit this story', ' &bull; ', ''); ?></p>
    					<?php } ?>
    					
						</div>

						<?php if (($videocount >= 1) && ($videocount < $totalvideos) && ($totalvideos!=1)) { ?><?php if ($instance['dividing-line']=='on') { ?><div style="border-bottom: <?php echo $instance['dividing-line-thickness']; ?> <?php echo $instance['dividing-line-type']; ?> #c0c0c0 !important;<?php if ($instance['remove-padding']=='on') { ?> margin-left: 10px; margin-right: 10px;<?php } ?>" class="storybottom"></div><?php } else { ?><div class="storybottomnolineleft"></div><?php } ?><?php } ?>


					<?php } else { ?>
						<div<?php if ($instance['remove-padding']=='on') { ?> style="padding-left:10px;padding-right:10px"<?php } ?>>
						<?php if (($videocount==$videodivider) && ($instance['headline-header'] =='on')) { ?>
						<a href="<?php echo $categoryslug; ?>"><p class="sectionhead" style="font-size:16px;padding-top:15px;margin-bottom:7px;font-weight:normal;">Recent Videos</p></a>										
						<?php } else { ?><div style="margin-top:10px"></div><?php } ?>
                  		<?php if($instance['teaser-thumb']=='on') { 
                  		$thumbplacement=$instance['teaser-thumb-placement']; ?>


					<?php global $post; if (has_post_thumbnail()) { 
						$unique_id = 'cat' . $instance['id'] . $post->ID;

						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'carouselthumb'); 
						
						echo "<div class='videothumbwrap' style='float:$thumbplacement;margin-$thumbplacement:0px;'>";
						echo "<div class='videophoto' id='grow-$unique_id' style='float:$thumbplacement;margin:0;background:url($thumbnail[0]) no-repeat'>";
						echo '<img class="mmoverlay" alt="' . get_the_title() . '" src="' . get_template_directory_uri() . '/images/playbutton.png" />';
						echo '</div>';
						echo '</div>';
					
						if (get_theme_mod('photo-animate') != 'Disable') {
							?><script type="text/javascript">
								$(document).ready(function() {
   								 	$("#grow-<?php echo $unique_id; ?>").mouseenter(function() {
   										$("#grow-<?php echo $unique_id; ?>").removeClass('shrink');
   										$("#grow-<?php echo $unique_id; ?>").removeClass('grow');
   										$("#grow-<?php echo $unique_id; ?>").addClass('grow');
   									}).mouseleave(function() {
   										$("#grow-<?php echo $unique_id; ?>").addClass('shrink');
  									});
								});
							</script><?php
						}

					}  
				  		
				  		} ?>
                  		<p><a class="homeheadline" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p><?php if ($instance['teaser-date']=='on') { ?><p><?php echo get_sno_timestamp(); ?></p><?php } ?>
						<div class="clear"></div>
						</div>
					<?php } ?>
					<?php endwhile; else: endif; wp_reset_query(); ?>
					
					
		
        			<?php if ($instance['view-all']=='on') {

						echo "<div class='clear'></div><a href='$categoryslug' class='view-all-link'><div class='view-all-container'><span class='view-all-text view-all-category'>";
						$view_all_text = get_theme_mod('viewall-text');
						if ($view_all_text == '') $view_all_text = "View All";
						$view_all_text = str_replace('%category%', $categoryname, $view_all_text);
						echo $view_all_text;
						echo '</span></div></a><div class="clear"></div>';

					} ?>

			<?php } ?>

		<div class="widget-expander" style="padding-bottom:<?php echo $instance['widget-expander']; ?>"></div><div class="clear"></div>

			</div>
			
		<?php if ($instance['widget-style']=="Style 3") { ?><div style="display:block !important;
		
		<?php if ($instance['custom-colors'] == "snoccon") { ?>background: <?php echo $instance['header-color']; ?> <?php if ($instance['widget-gradient'] == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if ($instance['widget-gradient'] == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo $instance['widget-pattern']; ?>) repeat <?php } ?> !important;
		<?php } else { ?>
				background: <?php echo get_theme_mod('widgetcolor3'); ?> <?php if (get_theme_mod('widget3-gradient') == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if (get_theme_mod('widget3-gradient') == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo get_theme_mod('widget3-pattern'); ?>) repeat <?php } ?> !important;
		<?php } ?>
		" class="widgetfooter3"></div><?php } else if ($instance['widget-style']=="Style 2") { ?><div style="display:inline-block;"></div><?php } ?>

</div>

	<?php }}

		function update( $new_instance, $old_instance ) {

		// let's add some code to force LiteSpeed to flush its cache when the widget is saved

		if ( is_plugin_active( 'litespeed-cache/litespeed-cache.php' ) ) {
			LiteSpeed_Cache_API::purge_all();
		}

		// cool, that's done

		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = $new_instance['number'];
		$instance['number-headlines'] = $new_instance['number-headlines'];
		$instance['category'] = $new_instance['category'];
		$instance['videowidth'] = $new_instance['videowidth'];
 		$instance['show-teaser'] = ( isset( $new_instance['show-teaser'] ) ? on : "" );  
		$instance['category-teaser'] = $new_instance['category-teaser'];
 		$instance['show-headline'] = ( isset( $new_instance['show-headline'] ) ? on : "" );  
 		$instance['show-date'] = ( isset( $new_instance['show-date'] ) ? on : "" );  
 		$instance['show-comments'] = ( isset( $new_instance['show-comments'] ) ? on : "" );  
 		$instance['show-writer'] = ( isset( $new_instance['show-writer'] ) ? on : "" );  
 		$instance['remove-padding'] = ( isset( $new_instance['remove-padding'] ) ? on : "" );  
 		$instance['dividing-line'] = ( isset( $new_instance['dividing-line'] ) ? on : "" );  
 		$instance['two-column'] = ( isset( $new_instance['two-column'] ) ? on : "" );  
 		$instance['view-all'] = ( isset( $new_instance['view-all'] ) ? on : "" );  
 		$instance['custom-view-all'] = ( isset( $new_instance['custom-view-all'] ) ? on : "" );  
		$instance['headline-size'] = $new_instance['headline-size'];
		$instance['widget-style'] = $new_instance['widget-style'];
 		$instance['custom-colors'] = ( isset( $new_instance['custom-colors'] ) ? "snoccon" : "" );  
		$instance['header-color'] = $new_instance['header-color'];
		$instance['header-text'] = $new_instance['header-text'];
		$instance['widget-border'] = $new_instance['widget-border'];
		$instance['widget-background'] = $new_instance['widget-background'];
		$instance['border-thickness'] = $new_instance['border-thickness'];
		$instance['sidebarname'] = $new_instance['sidebarname'];
		$instance['teaser-thumb-placement'] = $new_instance['teaser-thumb-placement'];
 		$instance['teaser-thumb'] = ( isset( $new_instance['teaser-thumb'] ) ? on : "" );  
 		$instance['teaser-date'] = ( isset( $new_instance['teaser-date'] ) ? on : "" );  
 		$instance['headline-header'] = ( isset( $new_instance['headline-header'] ) ? on : "" );  
		$instance['border-thickness2'] = $new_instance['border-thickness2'];
		$instance['widget-gradient'] = $new_instance['widget-gradient'];
		$instance['widget-padding'] = $new_instance['widget-padding'];
		$instance['widget-indent'] = $new_instance['widget-indent'];
		$instance['widget-pattern'] = $new_instance['widget-pattern'];
		$instance['dividing-line-type'] = $new_instance['dividing-line-type'];
		$instance['dividing-line-thickness'] = $new_instance['dividing-line-thickness'];
		$instance['custom-link'] = $new_instance['custom-link'];
		$instance['box1'] = $new_instance['box1'];
		$instance['box2'] = $new_instance['box2'];
		$instance['box3'] = $new_instance['box3'];
		$instance['widget-header-size'] = $new_instance['widget-header-size'];
		$instance['widget-expander'] = $new_instance['widget-expander'];
		$instance['center-title'] = $new_instance['center-title'];
		$instance['hide-shadow'] = $new_instance['hide-shadow'];

		return $instance;
	}

	function form($instance) { 
		$defaults = array( 'number' => '1', 'number-headlines' => '3', 'show-teaser' => 'on', 'show-headline' => 'on', 'category-teaser' => '150', 'widget-style'=>get_theme_mod('widget-style-sno'), 'view-all' => 'on', 'teaser-thumb' => 'on', 'header-color' => get_theme_mod('widgetcolor1'), 'header-text' => get_theme_mod('widgetcolor1-text'), 'widget-border' => '#aaaaaa', 'widget-background' => '#eeeeee', 'border-thickness' => '1px', 'border-thickness2' => '3px', 'widget-gradient' => 'On', 'widget-header-size' => 'Small', 'widget-expander' => '0px', 'hide-shadow' => 'Use Default' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$random = mt_rand(); $disable_js = ''; $hide_all = '';
		$number = $this->number;
		
		$check = $this->number; $currentScreen = get_current_screen(); 
if ($check == '__i__' && $currentScreen->id === "widgets"){
	echo '<div class="not_saved">';
		?><script type="text/javascript">
			initwidgetvid = setInterval(function() {
				$('.widget-control-save').prop("disabled", false); // Saving is now enabled.
				$('.widget-control-save').val("Save"); 
				clearInterval(initwidgetvid)		
   			}, 1000);
		</script><?php
		echo '<p>Hit the Save button, pardner, and we\'ll get this party started.</p>';
	echo '</div>';
	$hide_all = ' style="display:none;"';
		
}

if ($check == '__i__' ) { $disable_js = 'on'; } // disable javascript here
		
		if ($instance['box1'] == 'Closed') { 
			$box1 = ' style="display:none"'; $expand1 = ''; $collapse1 = ' style="display:none"'; 
		} else { 
			$box1 = ''; $collapse1 = ''; $expand1 = ' style="display:none"'; 
		} 
		
		if ($instance['box2'] == 'Closed') { 
			$box2 = ' style="display:none"'; $expand2 = ''; $collapse2 = ' style="display:none"'; 
		} else { 
			$box2 = ''; $collapse2 = ''; $expand2 = ' style="display:none"'; 
		} 

		if ($instance['box3'] == 'Closed') { 
			$box3 = ' style="display:none"'; $expand3 = ''; $collapse3 = ' style="display:none"'; 
		} else { 
			$box3 = ''; $collapse3 = ''; $expand3 = ' style="display:none"'; 
		} 

?>
<div class="hide_all"<?php echo $hide_all; ?>>

				<select style="display:none;" id="<?php echo $this->get_field_id('box1'); ?>" name="<?php echo $this->get_field_name( 'box1' ); ?>">
					<option value="Closed" <?php if ($instance['box1'] == 'Closed') echo ' selected="selected"'; ?>>Closed</option>
					<option value="Open" <?php if ($instance['box1'] == 'Open') echo ' selected="selected"'; ?>>Open</option>
				</select>
				<select style="display:none;" id="<?php echo $this->get_field_id('box2'); ?>" name="<?php echo $this->get_field_name( 'box2' ); ?>">
					<option value="Closed" <?php if ($instance['box2'] == 'Closed') echo ' selected="selected"'; ?>>Closed</option>
					<option value="Open" <?php if ($instance['box2'] == 'Open') echo ' selected="selected"'; ?>>Open</option>
				</select>
				<select style="display:none;" id="<?php echo $this->get_field_id('box3'); ?>" name="<?php echo $this->get_field_name( 'box3' ); ?>">
					<option value="Closed" <?php if ($instance['box3'] == 'Closed') echo ' selected="selected"'; ?>>Closed</option>
					<option value="Open" <?php if ($instance['box3'] == 'Open') echo ' selected="selected"'; ?>>Open</option>
				</select>

		<div class="widgetsection" id="widgetsection1-<?php echo $random; ?>">
			<div class="expand" id="expand1-<?php echo $random; ?>" <?php echo $expand1; ?>></div><div class="collapse" id="collapse1-<?php echo $random; ?>" <?php echo $collapse1; ?>></div>
			Video Story Display Options
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody1-<?php echo $random; ?>" <?php echo $box1; ?>>

		<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e("Select a video category"); ?></label><br />		
		<?php wp_dropdown_categories(array('selected' => $instance['category'], 'name' => $this->get_field_name( 'category' ), 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'studiopress'), 'hide_empty' => '0' )); ?>
		<br />
		
		
		<p>This widget will display the embed code from the video custom field from stories assigned to the selected category.</p>
		<?php $categorytitle = cat_id_to_name($instance['category']); ?><input type="hidden" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $categorytitle; ?>" />

		<div class="widgetdivider"></div>

			<p>
				<select id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>">
					<?php for ($i = 0; $i <= 14; $i++) { 
						echo "<option value='$i'";
						if ($i == $instance['number']) echo ' selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Videos'); ?></label>
			</p>

			<div class="widgetdivider"></div>

			<input class="headline<?php echo $random; ?>" type="checkbox" <?php if ($instance['show-headline'] =='on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-headline' ); ?>" name="<?php echo $this->get_field_name( 'show-headline' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-headline' ); ?>">Show Headline</label>
		<br />

		<div class="showheadline<?php echo $random; ?>">
				<select id="<?php echo $this->get_field_id( 'headline-size' ); ?>" name="<?php echo $this->get_field_name( 'headline-size' ); ?>">
					<?php for ($i=14; $i <= 26; $i+=2) {
						echo "<option value='$i' ";
						if ($instance['headline-size'] == $i) echo 'selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
			<label for="<?php echo $this->get_field_id( 'headline-size' ); ?>">Headline Size</label>
		<br />
		</div>
		<br />
		<div class="widgetdivider"></div>
			<input class="teaser<?php echo $random; ?>" type="checkbox" <?php if ($instance['show-teaser'] =='on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-teaser' ); ?>" name="<?php echo $this->get_field_name( 'show-teaser' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-teaser' ); ?>">Show Teaser</label>
		<br />

		<div class="showteaser<?php echo $random; ?>">
		
		<input id="<?php echo $this->get_field_id('category-teaser'); ?>" name="<?php echo $this->get_field_name('category-teaser'); ?>" type="text" maxlength="3" size="3" value="<?php echo $instance['category-teaser']; ?>" />
		<label for="<?php echo $this->get_field_id('category-teaser'); ?>">Teaser Length (characters)</label>
		<br />
		</div>
		<br />
		<div class="widgetdivider"></div>
			<input class="checkbox" type="checkbox" <?php if ($instance['show-writer'] =='on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-writer' ); ?>" name="<?php echo $this->get_field_name( 'show-writer' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-writer' ); ?>"> Show Video Credit</label>
		<br />

			<input class="checkbox" type="checkbox" <?php if ($instance['show-date'] =='on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-date' ); ?>" name="<?php echo $this->get_field_name( 'show-date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-date' ); ?>"> Show Date</label>	
		<br />

			<input class="checkbox" type="checkbox" <?php if ($instance['show-comments'] =='on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-comments' ); ?>" name="<?php echo $this->get_field_name( 'show-comments' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-comments' ); ?>"> Show Comments Link</label>	
		
		<br />			
			<input class="checkbox" type="checkbox" <?php if ($instance['remove-padding'] =='on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'remove-padding' ); ?>" name="<?php echo $this->get_field_name( 'remove-padding' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'remove-padding' ); ?>"> Remove padding around video</label>	
		
		<br />
		<input class="checkbox<?php echo $random; ?>" type="checkbox" <?php if ($instance['dividing-line'] =='on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'dividing-line' ); ?>" name="<?php echo $this->get_field_name( 'dividing-line' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'dividing-line' ); ?>"> Show Dividing Lines</label>
		<br /><br />

		<div class="dividinglines<?php echo $random; ?>">

		<div class="widgetdivider"></div>

			<select id="<?php echo $this->get_field_id( 'dividing-line-type' ); ?>" name="<?php echo $this->get_field_name( 'dividing-line-type' ); ?>">
				<option value="solid" <?php if ( 'solid' == $instance['dividing-line-type'] ) echo 'selected="selected"'; ?>>Solid</option>
				<option value="dotted" <?php if ( 'dotted' == $instance['dividing-line-type'] ) echo 'selected="selected"'; ?>>Dotted</option>
				<option value="dashed" <?php if ( 'dashed' == $instance['dividing-line-type'] ) echo 'selected="selected"'; ?>>Dashed</option>
			</select>
			<select id="<?php echo $this->get_field_id( 'dividing-line-thickness' ); ?>" name="<?php echo $this->get_field_name( 'dividing-line-thickness' ); ?>">
				<option value="1px" <?php if ( '1px' == $instance['dividing-line-thickness'] ) echo 'selected="selected"'; ?>>1px</option>
				<option value="2px" <?php if ( '2px' == $instance['dividing-line-thickness'] ) echo 'selected="selected"'; ?>>2px</option>
				<option value="3px" <?php if ( '3px' == $instance['dividing-line-thickness'] ) echo 'selected="selected"'; ?>>3px</option>
				<option value="4px" <?php if ( '4px' == $instance['dividing-line-thickness'] ) echo 'selected="selected"'; ?>>4px</option>
				<option value="5px" <?php if ( '5px' == $instance['dividing-line-thickness'] ) echo 'selected="selected"'; ?>>5px</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'dividing-line-thickness' ); ?>"> Line Style</label>
		</p>
		</div>

		</div>

		<div class="widgetsection" id="widgetsection2-<?php echo $random; ?>">
			<div class="expand" id="expand2-<?php echo $random; ?>" <?php echo $expand2; ?>></div><div class="collapse" id="collapse2-<?php echo $random; ?>" <?php echo $collapse2; ?>></div>
			Extra Headlines
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody2-<?php echo $random; ?>" <?php echo $box2; ?>>

			<span class='widewidgetarea'>
			<input class="checkbox" type="checkbox" <?php if ($instance['two-column'] =='on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'two-column' ); ?>" name="<?php echo $this->get_field_name( 'two-column' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'two-column' ); ?>"> Show as Second Column</label>
			<br />
			</span>
		
			<input class="checkbox" type="checkbox" <?php if ($instance['headline-header'] =='on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'headline-header' ); ?>" name="<?php echo $this->get_field_name( 'headline-header' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'headline-header' ); ?>"> Show Recent Headlines Label</label><br />

			<input class="checkbox" type="checkbox" <?php if ($instance['teaser-date'] =='on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'teaser-date' ); ?>" name="<?php echo $this->get_field_name( 'teaser-date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'teaser-date' ); ?>"> Show Dates</label>
			<br /><br />

			<div class="widgetdivider"></div>

			<p>
				<select id="<?php echo $this->get_field_id('number-headlines'); ?>" name="<?php echo $this->get_field_name('number-headlines'); ?>">
					<?php for ($i = 0; $i <= 14; $i++) { 
						echo "<option value='$i'";
						if ($i == $instance['number-headlines']) echo ' selected="selected"';
						echo ">$i</option>";
					} ?>
				
				</select>
				<label for="<?php echo $this->get_field_id('number-headlines'); ?>"><?php _e('Additional Video Headlines'); ?></label>
			</p>

			<div class="widgetdivider"></div>

			<p>
			<input class="teaserselect<?php echo $random; ?>" type="checkbox" <?php if ($instance['teaser-thumb'] =='on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'teaser-thumb' ); ?>" name="<?php echo $this->get_field_name( 'teaser-thumb' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'teaser-thumb' ); ?>"> Show Thumbnails</label><br />
			</p>
			<div class="teaseroptions<?php echo $random; ?>">
			<select id="<?php echo $this->get_field_id( 'teaser-thumb-placement' ); ?>" name="<?php echo $this->get_field_name( 'teaser-thumb-placement' ); ?>">
				<option value="left" <?php if ( 'left' == $instance['teaser-thumb-placement'] ) echo 'selected="selected"'; ?>>Left</option>
				<option value="right" <?php if ( 'right' == $instance['teaser-thumb-placement'] ) echo 'selected="selected"'; ?>>Right</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'teaser-thumb-placement' ); ?>">Thumbnail Placement</label><br /><br />
			</div>

		<div class="widgetdivider"></div>

			<input class="viewallcheckbox<?php echo $random; ?>" type="checkbox" <?php if ($instance['view-all'] =='on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'view-all' ); ?>" name="<?php echo $this->get_field_name( 'view-all' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'view-all' ); ?>"> Show "View All" Link</label><br />
			
			<div class="viewall<?php echo $random; ?>">
				<input class="viewalllinkcheckbox<?php echo $random; ?>" type="checkbox" <?php if ($instance['custom-view-all'] =='on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'custom-view-all' ); ?>" name="<?php echo $this->get_field_name( 'custom-view-all' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'custom-view-all' ); ?>"> Activate Custom "View All" Link</label>

				<div class="viewalllink<?php echo $random; ?>"><br />
					<label for="<?php echo $this->get_field_id('custom-link'); ?>">Enter Custom Link:</label><br />
					<input placeholder="Start with http://" id="<?php echo $this->get_field_id('custom-link'); ?>" name="<?php echo $this->get_field_name('custom-link'); ?>" type="text" size="25" value="<?php echo $instance['custom-link']; ?>" />
				</div>
			</div>
			<br />


		</div>
		
		<div class="widgetsection" id="widgetsection3-<?php echo $random; ?>">
			<div class="expand" id="expand3-<?php echo $random; ?>" <?php echo $expand3; ?>></div><div class="collapse" id="collapse3-<?php echo $random; ?>" <?php echo $collapse3; ?>></div>
			Widget Appearance
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody3-<?php echo $random; ?>" <?php echo $box3; ?>>
		
		<p>
			<select class="widgetstyle<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'widget-style' ); ?>" name="<?php echo $this->get_field_name( 'widget-style' ); ?>">
				<option value="Style 1" <?php if ( 'Style 1' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 1</option>
				<option value="Style 2" <?php if ( 'Style 2' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 2</option>
				<option value="Style 3" <?php if ( 'Style 3' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 3</option>
				<option value="Style 4" <?php if ( 'Style 4' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 4</option>
				<option value="Style 5" <?php if ( 'Style 5' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 5</option>
				<option value="Style 6" <?php if ( 'Style 6' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 6</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'widget-style' ); ?>">Widget Style</label>
		</p>

		<p>
			<select class="widgetstyle<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'widget-expander' ); ?>" name="<?php echo $this->get_field_name( 'widget-expander' ); ?>">
				<?php for ($i=0; $i<101; $i++) { ?>
					<?php $height = $i . 'px'; ?>
					<option value="<?php echo $height; ?>" <?php if ( $instance['widget-expander'] == $height ) echo 'selected="selected"'; ?>><?php echo $height; ?></option>
				<?php } ?>
			</select> Extend Widget Height
		</p>

		<p>
			<input class="customoptionscheckbox<?php echo $random; ?>" type="checkbox" <?php if ($instance['custom-colors'] == "snoccon") echo 'checked'; ?> id="<?php echo $this->get_field_id( 'custom-colors' ); ?>" name="<?php echo $this->get_field_name( 'custom-colors' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'custom-colors' ); ?>">Activate Custom Design</label>			
		</p>





		<div class="customoptions<?php echo $random; ?>">
		<div class="widgetdivider"></div>
			<select class="widgetheader<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'widget-gradient' ); ?>" name="<?php echo $this->get_field_name( 'widget-gradient' ); ?>">
				<option value="On" <?php if ( 'On' == $instance['widget-gradient'] ) echo 'selected="selected"'; ?>>Gradient</option>
				<option value="Off" <?php if ( 'Off' == $instance['widget-gradient'] ) echo 'selected="selected"'; ?>>Pattern</option>
				<option value="None" <?php if ( 'None' == $instance['widget-gradient'] ) echo 'selected="selected"'; ?>>None</option>
			</select> Header Overlay<br />
			
			<?php $sno_id_base = $this->id_base; ?>
			<?php $selectid = 'widget-'.$sno_id_base.'-'.$number.'-widget-pattern'; ?>
			<?php $selectname = 'widget-'.$sno_id_base.'['.$number.']'; ?>
			<?php $value = $instance['widget-pattern']; ?>

			<div class="widgetheaderoptions<?php echo $random; ?>">
				<?php sno_widget_pattern_selectbox($selectid, $selectname, $value, 'widget-pattern'); ?> Pattern<br />
			</div>
			<br />
			<div class="widgetdivider"></div>


			<label style="display:block" for="<?php echo $this->get_field_id('header-color'); ?>">Header Color</label>
			<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('header-color'); ?>" name="<?php echo $this->get_field_name('header-color'); ?>" value="<?php echo $instance['header-color']; ?>" />

			<br />

			<label style="display:block" for="<?php echo $this->get_field_id('header-text'); ?>">Header Text</label>
			<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('header-text'); ?>" name="<?php echo $this->get_field_name('header-text'); ?>" value="<?php echo $instance['header-text']; ?>" />

			<br />

			<label style="display:block" for="<?php echo $this->get_field_id('widget-border'); ?>">Widget Border</label>
			<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('widget-border'); ?>" name="<?php echo $this->get_field_name('widget-border'); ?>" value="<?php echo $instance['widget-border']; ?>" />

			<br />

			<label style="display:block" for="<?php echo $this->get_field_id('widget-background'); ?>">Widget Background</label>
			<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('widget-background'); ?>" name="<?php echo $this->get_field_name('widget-background'); ?>" value="<?php echo $instance['widget-background']; ?>" />

			
			<br /><br />

			<div class="widgetdivider"></div>

			<select class="widgetheader<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'widget-header-size' ); ?>" name="<?php echo $this->get_field_name( 'widget-header-size' ); ?>">
				<option value="Small" <?php if ( 'Small' == $instance['widget-header-size'] ) echo 'selected="selected"'; ?>>Small</option>
				<option value="Medium" <?php if ( 'Medium' == $instance['widget-header-size'] ) echo 'selected="selected"'; ?>>Medium</option>
				<option value="Large" <?php if ( 'Large' == $instance['widget-header-size'] ) echo 'selected="selected"'; ?>>Large</option>
			</select> Header Text Size<br />
			
		<p class="style6options<?php echo $random; ?>">
			<input type="checkbox" <?php if ($instance['center-title'] == "on") echo checked; ?> id="<?php echo $this->get_field_id( 'center-title' ); ?>" name="<?php echo $this->get_field_name( 'center-title' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'center-title' ); ?>">Center Title</label>			
		</p>
			
			<br />

			<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('.my-color-picker').wpColorPicker();
			});
			jQuery('.my-color-picker').wpColorPicker();
			</script>
			
			<div class="widgetdivider"></div>

			<select id="<?php echo $this->get_field_id( 'border-thickness' ); ?>" name="<?php echo $this->get_field_name( 'border-thickness' ); ?>">
				<?php for ($i=0; $i <= 10; $i++) {
					$width = $i . 'px';
					echo "<option value='$width' ";
					if ($instance['border-thickness'] == $width) echo 'selected="selected"';
					echo ">$width</option>";
				} ?>
			</select>
			<label for="<?php echo $this->get_field_id( 'border-thickness' ); ?>"> Widget Border</label>

			<br />
			
		<div class="style2options<?php echo $random; ?>">
			<select id="<?php echo $this->get_field_id( 'border-thickness2' ); ?>" name="<?php echo $this->get_field_name( 'border-thickness2' ); ?>">
				<?php for ($i=0; $i <= 10; $i++) {
					$width = $i . 'px';
					echo "<option value='$width' ";
					if ($instance['border-thickness2'] == $width) echo 'selected="selected"';
					echo ">$width</option>";
				} ?>
			</select>
			<label for="<?php echo $this->get_field_id( 'border-thickness' ); ?>"> Header Bottom Border</label>
			
			<br />
		</div>
		<br />
		<div class="widgetdivider"></div>
		<div class="style2options<?php echo $random; ?>">

			

			<select id="<?php echo $this->get_field_id( 'widget-padding' ); ?>" name="<?php echo $this->get_field_name( 'widget-padding' ); ?>">
				<option value="On" <?php if ( 'On' == $instance['widget-padding'] ) echo 'selected="selected"'; ?>>On</option>
				<option value="Off" <?php if ( 'Off' == $instance['widget-padding'] ) echo 'selected="selected"'; ?>>Off</option>
			</select> Body Padding
			
			<br />

		</div>
		<div class="style26options<?php echo $random; ?>">

			<select id="<?php echo $this->get_field_id( 'widget-indent' ); ?>" name="<?php echo $this->get_field_name( 'widget-indent' ); ?>">
				<option value="On" <?php if ( 'On' == $instance['widget-indent'] ) echo 'selected="selected"'; ?>>On</option>
				<option value="Off" <?php if ( 'Off' == $instance['widget-indent'] ) echo 'selected="selected"'; ?>>Off</option>
			</select> Title Indent<br />

			<br />
		</div>
		</div>



			<p>
				<select class="hideshadow<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'hide-shadow' ); ?>" name="<?php echo $this->get_field_name( 'hide-shadow' ); ?>">
					<option value="Use Default" <?php if ( 'Use Default' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Use Default</option>
					<option value="Hide" <?php if ( 'Hide' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Hide</option>
					<option value="Show" <?php if ( 'Show' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Show</option>
				</select>
				
			 Widget Drop Shadow</p>

		</div>
		<div class="lastsection"></div>
	</div>

	<?php 
		$wid = array(); 
		$wid[0] = $this->number;
		$wid[1] = $this->get_field_id('box1'); 
		$wid[2] = $this->get_field_id('box2'); 
		$wid[3] = $this->get_field_id('box3'); 
	//	sno_widget_toggles($wid, $boxes=3, $random);
		sno_widget_interface_styles(); 
	?>
		
	<?php if ($disable_js == '') { ?>
	
	<script type="text/javascript">
			jQuery('.headline<?php echo $random; ?>').change(function() {
   		 		jQuery('.showheadline<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.headline<?php echo $random; ?>').prop('checked')) {
				jQuery(".showheadline<?php echo $random; ?>").show();
			} else {
				jQuery(".showheadline<?php echo $random; ?>").hide();
			}

			jQuery('.teaser<?php echo $random; ?>').change(function() {
   		 		jQuery('.showteaser<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.teaser<?php echo $random; ?>').prop('checked')) {
				jQuery(".showteaser<?php echo $random; ?>").show();
			} else {
				jQuery(".showteaser<?php echo $random; ?>").hide();
			}

			jQuery('.checkbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.dividinglines<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.checkbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".dividinglines<?php echo $random; ?>").show();
			} else {
				jQuery(".dividinglines<?php echo $random; ?>").hide();
			}


    		jQuery(".displaystyle<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "Teasers") ? jQuery(".displayoptions<?php echo $random; ?>").slideDown('slow') : jQuery(".displayoptions<?php echo $random; ?>").slideUp('slow');
    		});
   			jQuery(document).ready(function() {
        		(jQuery(".displaystyle<?php echo $random; ?>").val() == "Teasers") ? jQuery(".displayoptions<?php echo $random; ?>").show() : jQuery(".displayoptions<?php echo $random; ?>").hide();
    		});


    		jQuery(".widgetstyle<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "Style 2") ? jQuery(".style2options<?php echo $random; ?>").slideDown('slow') : jQuery(".style2options<?php echo $random; ?>").slideUp('slow');
        		(jQuery(this).val() == "Style 6") ? jQuery(".style6options<?php echo $random; ?>").slideUp('slow') : jQuery(".style6options<?php echo $random; ?>").slideDown('slow');
        		(jQuery(this).val() == "Style 2" || jQuery(this).val() == "Style 6") ? jQuery(".style26options<?php echo $random; ?>").slideDown('slow') : jQuery(".style26options<?php echo $random; ?>").slideUp('slow');
    		});
        	(jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 2") ? jQuery(".style2options<?php echo $random; ?>").show() : jQuery(".style2options<?php echo $random; ?>").hide();
        	(jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 6") ? jQuery(".style6options<?php echo $random; ?>").hide() : jQuery(".style6options<?php echo $random; ?>").show();
        	(jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 2" || jQuery(".widgetstyle<?php echo $random; ?>").val() == "Style 6") ? jQuery(".style26options<?php echo $random; ?>").show() : jQuery(".style26options<?php echo $random; ?>").hide();


			jQuery('.customoptionscheckbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.customoptions<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.customoptionscheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".customoptions<?php echo $random; ?>").show();
			} else {
				jQuery(".customoptions<?php echo $random; ?>").hide();
			}

			jQuery('.threecolumncheckbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.threecolumn<?php echo $random; ?>').slideToggle('slow');
   		 		jQuery('.threecolumnhide<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.threecolumncheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".threecolumn<?php echo $random; ?>").hide();
			} else {
				jQuery(".threecolumn<?php echo $random; ?>").show();
			}

    		
    		if (jQuery('.threecolumncheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".threecolumnhide<?php echo $random; ?>").show();
			} else {
				jQuery(".threecolumnhide<?php echo $random; ?>").hide();
			}
			
			
			jQuery('.teaserselect<?php echo $random; ?>').change(function() {
   		 		jQuery('.teaseroptions<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.teaserselect<?php echo $random; ?>').prop('checked')) {
				jQuery(".teaseroptions<?php echo $random; ?>").show();
			} else {
				jQuery(".teaseroptions<?php echo $random; ?>").hide();
			}


			jQuery('.viewallcheckbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.viewall<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.viewallcheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".viewall<?php echo $random; ?>").show();
			} else {
				jQuery(".viewall<?php echo $random; ?>").hide();
			}
			
			jQuery('.viewalllinkcheckbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.viewalllink<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.viewalllinkcheckbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".viewalllink<?php echo $random; ?>").show();
			} else {
				jQuery(".viewalllink<?php echo $random; ?>").hide();
			}


    		jQuery(".widgetheader<?php echo $random; ?>").change(function() {
        		(jQuery(this).val() == "Off") ? jQuery(".widgetheaderoptions<?php echo $random; ?>").slideDown('slow') : jQuery(".widgetheaderoptions<?php echo $random; ?>").slideUp('slow');
    		});
 			(jQuery(".widgetheader<?php echo $random; ?>").val() == "Off") ? jQuery(".widgetheaderoptions<?php echo $random; ?>").show() : jQuery(".widgetheaderoptions<?php echo $random; ?>").hide();




    				jQuery("#widgetsection1-<?php echo $random; ?>").click(function() {
    			    	jQuery("#widgetbody1-<?php echo $random; ?>").slideToggle('slow');
    			    	jQuery("#collapse1-<?php echo $random; ?>").toggle();
    			    	jQuery("#expand1-<?php echo $random; ?>").toggle();
    					if(jQuery('#collapse1-<?php echo $random; ?>').is(':visible')) { 
    						jQuery("#widgetbody2-<?php echo $random; ?>").slideUp('slow'); 
    						jQuery("#widgetbody3-<?php echo $random; ?>").slideUp('slow'); 
	    			    	jQuery("#collapse2-<?php echo $random; ?>").hide();
	    			    	jQuery("#collapse3-<?php echo $random; ?>").hide();
	    			    	jQuery("#expand2-<?php echo $random; ?>").show();
	    			    	jQuery("#expand3-<?php echo $random; ?>").show();
     						jQuery('#<?php echo $wid[1]; ?>').val('Open'); 
     						jQuery('#<?php echo $wid[2]; ?>').val('Closed'); 
     						jQuery('#<?php echo $wid[3]; ?>').val('Closed'); 
    					} 

    				});
    				jQuery("#widgetsection2-<?php echo $random; ?>").click(function() {
    			    	jQuery("#widgetbody2-<?php echo $random; ?>").slideToggle('slow');
    			    	jQuery("#collapse2-<?php echo $random; ?>").toggle();
    			    	jQuery("#expand2-<?php echo $random; ?>").toggle();
    					if(jQuery('#collapse2-<?php echo $random; ?>').is(':visible')) { 
    						jQuery("#widgetbody1-<?php echo $random; ?>").slideUp('slow'); 
    						jQuery("#widgetbody3-<?php echo $random; ?>").slideUp('slow'); 
	    			    	jQuery("#collapse1-<?php echo $random; ?>").hide();
	    			    	jQuery("#collapse3-<?php echo $random; ?>").hide();
	    			    	jQuery("#expand1-<?php echo $random; ?>").show();
	    			    	jQuery("#expand3-<?php echo $random; ?>").show();
     						jQuery('#<?php echo $wid[1]; ?>').val('Closed'); 
     						jQuery('#<?php echo $wid[2]; ?>').val('Open'); 
     						jQuery('#<?php echo $wid[3]; ?>').val('Closed'); 
    					} 
    				});
    				jQuery("#widgetsection3-<?php echo $random; ?>").click(function() {
    			    	jQuery("#widgetbody3-<?php echo $random; ?>").slideToggle('slow');
    			    	jQuery("#collapse3-<?php echo $random; ?>").toggle();
    			    	jQuery("#expand3-<?php echo $random; ?>").toggle();
    					if(jQuery('#collapse3-<?php echo $random; ?>').is(':visible')) { 
    						jQuery("#widgetbody1-<?php echo $random; ?>").slideUp('slow'); 
    						jQuery("#widgetbody2-<?php echo $random; ?>").slideUp('slow'); 
	    			    	jQuery("#collapse1-<?php echo $random; ?>").hide();
	    			    	jQuery("#collapse2-<?php echo $random; ?>").hide();
	    			    	jQuery("#expand1-<?php echo $random; ?>").show();
	    			    	jQuery("#expand2-<?php echo $random; ?>").show();
     						jQuery('#<?php echo $wid[1]; ?>').val('Closed'); 
     						jQuery('#<?php echo $wid[2]; ?>').val('Closed'); 
     						jQuery('#<?php echo $wid[3]; ?>').val('Open'); 
    					} 
    				});
			

	</script>
	
	<?php } ?>
		
	<?php 
	}

}
?>