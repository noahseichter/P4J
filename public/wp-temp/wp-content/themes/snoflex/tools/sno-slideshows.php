<?php

// if sno photo gallery plugin is active, deactivate it and delete it.  
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );	
	
if ( is_plugin_active( 'sno-gallery-widget/sno-gallery-widget.php' ) ) {
	
	deactivate_plugins( 'sno-gallery-widget/sno-gallery-widget.php' );
	
	if ( !function_exists( 'get_home_path' ) ) require_once( dirname(__FILE__) . '/../../../../wp-admin/includes/file.php' );
	
	$url = get_home_path() . "wp-content/plugins/sno-gallery-widget";
	
	if (is_dir($url)) sno_plugin_removal($url);	

} else {


add_action('widgets_init', create_function('', "register_widget('sno_gallery');"));
class sno_gallery extends WP_Widget {

	function __construct() {

		$this->defaults = array(
			'title' => '',
			'image' => '',
			'link'  => ''
			);

		$widget_ops = array(
			'classname' => 'sno_photo_gallery_widget',
			'description' => __( 'Use this widget to showcase a gallery from the images attached to any story on your site.' )
			);

		$control_ops = array(
			'id_base' => 'sno_gallery'
			);

		parent::__construct( 'sno_gallery', __( '(SNO) Photo Gallery Widget' ), $widget_ops, $control_ops );

	}


	function widget($args, $instance) {
		extract($args); $widget = $this->id; 


				$storyid = $instance['story-id']; $number = $instance['number']; if ($number == '') $number == 10;
								
				$unique = rand(0, 1000000);
				
				if ($storyid && $storyid != 'All') {

					$args = array(
						'orderby'        => 'menu_order',
						'order'			 => 'ASC',
						'post_type'      => 'attachment',
						'post_parent'    => $storyid,
						'post_status'    => null,
						'post_mime_type' => 'image',
						'numberposts'	 => 40			// 40 is the max number of thumbnails that will display for thumbnails -- this won't impact the overlay view 
						);
			
				} else {
					
					$args = array(
						'orderby'        => 'date',
						'order'			 => 'DESC',
						'post_type'      => 'attachment',
						'post_status'    => null,
						'post_mime_type' => 'image',
						'numberposts'    => $number
						);
	
				}

				$widget_width = sno_get_widget_width($widget_id)[1];
				switch(true) {
					case $widget_width >= 1000:
						$columns = 8;
						break;

					case $widget_width >= 900:
						$columns = 7;
						break;
					
					case $widget_width >= 800:
						$columns = 6;
						break;
					
					case $widget_width >= 500:
						$columns = 5;
						break;

					case $widget_width >= 4000:
						$columns = 4;
						break;
						
					case $widget_width >= 300:
						$columns = 3;
						break;
						
					case $widget_width >= 200:
						$columns = 2;
						break;
						
					default:
						$columns = 1;
						break;
				}
				
				$attachments = get_posts($args);
				$number_of_thumbs = count($attachments);
				
				for ($i = $columns; $i > $number_of_thumbs; $i--) {
					if ($number_of_thumbs < $columns) $columns--; 
				}

				$thumb_class = " thumb_class_$columns";

  					if ($attachments) {

	  					$shadow = '';
	  					if ($instance['hide-shadow'] == 'Hide' && get_theme_mod('widget-shadows') == 'On') {
	  						$shadow = "box-shadow: none;";
						} else if ($instance['hide-shadow'] == 'Show' && get_theme_mod('widget-shadows') != 'On') {
							$shadow = "box-shadow: -1px 0 2px 0 rgba(0, 0, 0, 0.12), 1px 0 2px 0 rgba(0, 0, 0, 0.12), 0 1px 1px 0 rgba(0, 0, 0, 0.24);";
						}
						$widgetwrap_style = " style='$shadow'";
	
	  					echo "<div class='widgetwrap sno-$widget'$widgetwrap_style>";
	  						  											
						$customcolors=$instance['custom-colors']; $categoryslug=''; $videotitle=''; $categoryname='';
						if ($instance['hide-title'] != 'on' && $instance['title'] != '') echo sno_widget_styles($instance, $customcolors, $categoryslug, $videotitle, $categoryname); 
	  					
	  					if ($instance['display-style'] != "Thumbnails") {
		  					
		  					$t = $instance['display-style'] == "Slideshow" ? false : true ;
		  		
	  						if ($storyid == "All") {
		  						echo sno_get_inline_slideshow($attachments, "Recent", $n=$number, $instance, $widget, $unique);
		  					} else {
		  						echo sno_get_inline_slideshow($attachments, "Widget", $n=null, $instance, $widget, $unique);
		  					}
	  					} else {

								echo '<div class="photowrap">';
								echo "<div id='storypageslideshow$unique' style='position:relative'>";
									
							
									echo "<div class='slideshowwrap' id='slideshowwrap$unique'>";
									

											
											foreach ($attachments as $attachment) {
												$image = wp_get_attachment_image_src($attachment->ID, 'tsmediumblock', false);
												if ($image[1] > 239) { // skip any images that are too small or don't have proper thumbnails
													$caption = get_post_field('post_excerpt', $attachments[0]->ID);
													$title = get_the_title($attachment->ID);
													if ($title == '') $title = ' This Photo';
													$alternate_text = $caption; if ($alternate_text == '') $alternate_text = "Alternate Text Not Supplied for $title.";
	
													echo "<div class='photo-gallery-thumb $thumb_class sno-thumb-gallery-widget'><div class='modal-photo$unique ' href='#slideshow' data-image='".$attachment->ID."'><img src='".$image[0]."' alt='$alternate_text' /></div></div>";
												}
											}
																					
										
									echo '</div>';
				
								echo '</div>';
								echo '</div>';		

						}
								
								echo "<div class='remodal remodal-story-image' data-remodal-id='modal-photo$unique' data-remodal-options='hashTracking: false, closeOnConfirm: false'>";
									echo '<button data-remodal-action="close" class="remodal-close"><span class="icon-hidden-text">Close</span></button>';
									echo "<div id='photo-container$unique' class='photo-container'>";
										echo '<div id="listloader" class="spinner" style="display:block;float:none;margin:45vh auto;">
											<div class="bounce1"></div>
											<div class="bounce2"></div>
											<div class="bounce3"></div>
										</div>'; 
									echo "</div>";
								echo "</div>";
								
								
								?><script type="text/javascript">
								$(document).ready(function() {
									$(function(){
										$(".modal-photo<?php echo $unique; ?>").click(function() {
											var image = $(this).attr('data-image');
											var inst = $("[data-remodal-id=modal-photo<?php echo $unique; ?>]").remodal();
											inst.open();
											var storyid = '<?php echo $storyid; ?>';
											var unique = '<?php echo $unique; ?>';
											<?php if ($storyid == 'All') { ?>
												var recent = '<?php echo $number; ?>';
											<?php } else { ?>
												var recent = 'false';
											<?php } ?>

											$.ajax({
												url:"/wp-admin/admin-ajax.php",
												type:'POST',
												data:'action=getslideshow&storyid=' + storyid + '&unique=' + unique + '&widget=true&recent=' + recent + '&image=' + image,
												success:function(results)
													{ $("#photo-container<?php echo $unique; ?>").replaceWith(results); }
	           								});
										});
									});
									$('#slideshowwrap<?php echo $unique; ?>').hover(function(){
										$('#slideshow-enlarge<?php echo $unique; ?>').css("background", "<?php echo get_theme_mod('reset-color1'); ?>");
									}, function(){
										$('#slideshow-enlarge<?php echo $unique; ?>').css("background", "#000");
									})
								});
								</script>
							</div>
							<?php if ($instance['hide-title'] != 'on' && $instance['title'] != '') { ?>
									<?php if ($instance['widget-style']=="Style 3") { ?><div style="display:block !important;
		
									<?php if ($instance['custom-colors'] == "snoccon") { ?>background: <?php echo $instance['header-color']; ?> <?php if ($instance['widget-gradient'] == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if ($instance['widget-gradient'] == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo $instance['widget-pattern']; ?>) repeat <?php } ?> !important;
									<?php } else { ?>
				background: <?php echo get_theme_mod('widgetcolor3'); ?> <?php if (get_theme_mod('widget3-gradient') == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if (get_theme_mod('widget3-gradient') == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo get_theme_mod('widget3-pattern'); ?>) repeat <?php } ?> !important;
									<?php } ?>
									" class="widgetfooter3"></div><?php } else if ($instance['widget-style']=="Style 2") { ?><div style="display:inline-block;"></div><?php } ?>
									</div>
							<?php } ?>


				<?php } ?>
				
		<?php	}

		function update( $new_instance, $old_instance ) {

		// let's add some code to force LiteSpeed to flush its cache when the widget is saved

		if ( is_plugin_active( 'litespeed-cache/litespeed-cache.php' ) ) {
			LiteSpeed_Cache_API::purge_all();
		}

		// cool, that's done

		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		if ($new_instance['title'] == '') $instance['title'] = get_the_title($new_instance['story-id']);
		$instance['display-style'] = $new_instance['display-style'];
		$instance['widget-style'] = $new_instance['widget-style'];
 		$instance['custom-colors'] = ( isset( $new_instance['custom-colors'] ) ? "snoccon" : "" );  
		$instance['header-color'] = $new_instance['header-color'];
		$instance['header-text'] = $new_instance['header-text'];
		$instance['widget-border'] = $new_instance['widget-border'];
		$instance['widget-background'] = $new_instance['widget-background'];
		$instance['border-thickness'] = $new_instance['border-thickness'];
		$instance['number'] = $new_instance['number'];
		$instance['width'] = $new_instance['width'];
		$instance['margin'] = $new_instance['margin'];
		$instance['photowidth'] = $new_instance['photowidth'];
		$instance['sidebarname'] = $new_instance['sidebarname'];
 		$instance['show-credit'] = ( isset( $new_instance['show-credit'] ) ? on : "" );  
 		$instance['hide-title'] = ( isset( $new_instance['hide-title'] ) ? on : "" );  
		$instance['border-thickness2'] = $new_instance['border-thickness2'];
		$instance['widget-gradient'] = $new_instance['widget-gradient'];
		$instance['widget-padding'] = $new_instance['widget-padding'];
		$instance['widget-indent'] = $new_instance['widget-indent'];
		$instance['widget-pattern'] = $new_instance['widget-pattern'];
		$instance['custom-link'] = $new_instance['custom-link'];
		$instance['story-id'] = $new_instance['story-id'];
		$instance['widget-header-size'] = $new_instance['widget-header-size'];
		$instance['widget-expander'] = $new_instance['widget-expander'];
		$instance['center-title'] = $new_instance['center-title'];
		$instance['hide-shadow'] = $new_instance['hide-shadow'];
		$instance['autoscroll'] = $new_instance['autoscroll'];
		$instance['autoscroll-speed'] = $new_instance['autoscroll-speed'];
		$instance['slideshow-height'] = $new_instance['slideshow-height'];
		$instance['thumb-location'] = $new_instance['thumb-location'];
		return $instance;
	}

	function form($instance) { 
		$defaults = array( 'display-style' => 'Slideshow', 'number' => '9', 'margin' => '2', 'width' => '98', 'border-thickness' => '1px','category-teaser' => '170','headline-teaser' => '0', 'show-credit' => 'on', 'show-caption' => '', 'teaser-date' => 'on', 'teaser-thumb' => 'on', 'teaser-thumb-placement' => 'Left', 'widget-style'=>get_theme_mod('widget-style-sno'), 'bullet-list' => 'Bullet List', 'header-color' => get_theme_mod('widgetcolor1'), 'header-text' => get_theme_mod('widgetcolor1-text'), 'widget-border' => '#aaaaaa', 'widget-background' => '#eeeeee', 'border-thickness' => '1px', 'border-thickness2' => '3px', 'widget-gradient' => 'On', 'widget-header-size' => 'Small', 'widget-expander' => '0px', 'hide-shadow' => 'Use Default', 'autoscroll' => 'Yes', 'autoscroll-speed' => '4000', 'slideshow-height' => '66', 'thumb-location' => 'Bottom' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$random = mt_rand(); $disable_js = ''; $hide_all = '';
		$number = $this->number;
		
		$check = $this->number; $currentScreen = get_current_screen(); 
if ($check == '__i__' && $currentScreen->id === "widgets"){
	echo '<div class="not_saved">';
		?><script type="text/javascript">
			initwidgetslide = setInterval(function() {
				$('.widget-control-save').prop("disabled", false); // Saving is now enabled.
				$('.widget-control-save').val("Save"); 
				clearInterval(initwidgetslide)		
   			}, 1000);
		</script><?php
		echo '<p>Hit the Save button, pardner, and we\'ll get this party started.</p>';
	echo '</div>';
	$hide_all = ' style="display:none;"';
		
}
if ($check == '__i__' ) { $disable_js = 'on'; } // disable javascript here

?>

<div class="hide_all"<?php echo $hide_all; ?>>


		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title"); ?>:</label><br />
		<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" />
		</p>
		<p>
			<input class="hidetitle<?php echo $random; ?>" type="checkbox" <?php if ($instance['hide-title'] == 'on') echo checked; ?> id="<?php echo $this->get_field_id( 'hide-title' ); ?>" name="<?php echo $this->get_field_name( 'hide-title' ); ?>" /><label for="<?php echo $this->get_field_id('hide-title'); ?>">Hide title and title bar</label>
		</p>
				
		<p><?php 
		
			$limitvariable = 100;
			global $wpdb;
			$querystr = "
				SELECT * FROM $wpdb->posts
				JOIN $wpdb->postmeta AS featureimage ON(
				$wpdb->posts.ID = featureimage.post_id
				AND featureimage.meta_key = 'featureimage'
				AND featureimage.meta_value = 'Slideshow of All Attached Images'
				)
				WHERE $wpdb->posts.post_status = 'publish'
				ORDER BY post_date DESC LIMIT $limitvariable
    			";
 			$pageposts = $wpdb->get_results($querystr, OBJECT);

			if ($pageposts): global $post;
				
				?><select class="story-id<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'story-id' ); ?>" name="<?php echo $this->get_field_name( 'story-id' ); ?>"><?php
					?><option value="All" <?php if ( $storyid == $instance['story-id'] ) echo 'selected="selected"'; ?>><?php echo 'Recently Added Photos'; ?></option><?php
				foreach ($pageposts as $post):
					//setup_postdata($post);
					$storyid= $post->ID;
					$storytitle = substr(get_the_title($storyid),0,30);

					
					if ($storyid) { ?><option value="<?php echo $storyid; ?>" <?php if ( $storyid == $instance['story-id'] ) echo 'selected="selected"'; ?>><?php echo $storyid . ': ' . $storytitle; ?></option><?php }
					
				endforeach; 
			
				echo '</select>';
				
			else : 
			
				echo '<div class="not_saved">';
					echo '<p>It looks like you haven\'t yet created any SNO slideshows. Check out these <a target="_blank" href="http://help.snosites.com/?p=456">instructions</a>. <br /><br />Once you\'ve created a slideshow, you can select it here. In the meantime, this widget will default to display recently added photos.</p>';
				echo '</div>';
			
			endif;
			
			
		?></p>		
				

		<p>
			<select  id="<?php echo $this->get_field_id( 'display-style' ); ?>" class="display-style<?php echo $random; ?>" name="<?php echo $this->get_field_name( 'display-style' ); ?>">
				<option value="Slideshow" <?php if ( 'Slideshow' == $instance['display-style'] ) echo 'selected="selected"'; ?>>Slideshow</option>
				<option value="Thumbnails" <?php if ( 'Thumbnails' == $instance['display-style'] ) echo 'selected="selected"'; ?>>Thumbnails</option>
				<option value="Slideshow with Thumbnails" <?php if ( 'Slideshow with Thumbnails' == $instance['display-style'] ) echo 'selected="selected"'; ?>>Slideshow with Thumbnails</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'display-style' ); ?>"> Style</label>
		</p>
		<div class="recentaddedoptions<?php echo $random; ?>">
			<p>
				<select id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>">
					<?php for ($i = 1; $i <= 40; $i++) { 
						echo "<option value='$i'";
						if ($i == $instance['number']) echo ' selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Photos'); ?></label>
			</p>
		</div>

		<div class="autoscrolloptions<?php echo $random; ?>">
			<div class="widgetdivider"></div>
	
			<p>
				<select id="<?php echo $this->get_field_id( 'autoscroll' ); ?>" name="<?php echo $this->get_field_name( 'autoscroll' ); ?>">
					<option value="Yes" <?php if ( 'Yes' == $instance['autoscroll'] ) echo 'selected="selected"'; ?>>Yes</option>
					<option value="No" <?php if ( 'No' == $instance['autoscroll'] ) echo 'selected="selected"'; ?>>No</option>
				</select>
				<label for="<?php echo $this->get_field_id( 'autoscroll' ); ?>">Activate Auto-Scroll</label>
			</p>
			<p>
				<select id="<?php echo $this->get_field_id( 'autoscroll-speed' ); ?>" name="<?php echo $this->get_field_name( 'autoscroll-speed' ); ?>">
					<option value="3000" <?php if ( '3000' == $instance['autoscroll-speed'] ) echo 'selected="selected"'; ?>>3 Seconds</option>
					<option value="4000" <?php if ( '4000' == $instance['autoscroll-speed'] ) echo 'selected="selected"'; ?>>4 Seconds</option>
					<option value="5000" <?php if ( '5000' == $instance['autoscroll-speed'] ) echo 'selected="selected"'; ?>>5 Seconds</option>
					<option value="6000" <?php if ( '6000' == $instance['autoscroll-speed'] ) echo 'selected="selected"'; ?>>6 Seconds</option>
					<option value="7000" <?php if ( '7000' == $instance['autoscroll-speed'] ) echo 'selected="selected"'; ?>>7 Seconds</option>
					<option value="8000" <?php if ( '8000' == $instance['autoscroll-speed'] ) echo 'selected="selected"'; ?>>8 Seconds</option>
					<option value="9000" <?php if ( '9000' == $instance['autoscroll-speed'] ) echo 'selected="selected"'; ?>>9 Seconds</option>
					<option value="10000" <?php if ( '10000' == $instance['autoscroll-speed'] ) echo 'selected="selected"'; ?>>10 Seconds</option>
				</select>
				<label for="<?php echo $this->get_field_id( 'widget-style' ); ?>">Auto-Scroll Speed</label>
			</p>
			<div class="thumblocationoptions<?php echo $random; ?>">
				<p>
					<select id="<?php echo $this->get_field_id( 'thumb-location' ); ?>" name="<?php echo $this->get_field_name( 'thumb-location' ); ?>">
						<option value="Bottom" <?php if ( 'Bottom' == $instance['thumb-location'] ) echo 'selected="selected"'; ?>>Bottom</option>
						<option value="Top" <?php if ( 'Top' == $instance['thumb-location'] ) echo 'selected="selected"'; ?>>Top</option>
					</select>
					<label for="<?php echo $this->get_field_id( 'autoscroll' ); ?>">Thumbnail Location</label>
				</p>
			</div>
			<p>
				<select id="<?php echo $this->get_field_id( 'slideshow-height' ); ?>" name="<?php echo $this->get_field_name( 'slideshow-height' ); ?>">
					<option value="66" <?php if ( '66' == $instance['slideshow-height'] ) echo 'selected="selected"'; ?>>66%</option>
					<option value="75" <?php if ( '75' == $instance['slideshow-height'] ) echo 'selected="selected"'; ?>>75%</option>
					<option value="100" <?php if ( '100' == $instance['slideshow-height'] ) echo 'selected="selected"'; ?>>100%</option>
					<option value="125" <?php if ( '125' == $instance['slideshow-height'] ) echo 'selected="selected"'; ?>>125%</option>
					<option value="150" <?php if ( '150' == $instance['slideshow-height'] ) echo 'selected="selected"'; ?>>150%</option>
				</select>
				<label for="<?php echo $this->get_field_id( 'widget-style' ); ?>">Slideshow Height</label>
			</p>
		</div>

		<div class="widgetdivider"></div>
		
			<div class="thumbnail-options<?php echo $random; ?>">

			<p>
				<select id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>">
					<?php for ($i = 90; $i <= 200; $i++) { 
						echo "<option value='$i'";
						if ($i == $instance['width']) echo ' selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Thumbnail Width'); ?></label>
			</p>

			<p>
				<select id="<?php echo $this->get_field_id('margin'); ?>" name="<?php echo $this->get_field_name('margin'); ?>">
					<?php for ($i = 0; $i <= 10; $i++) { 
						echo "<option value='$i'";
						if ($i == $instance['margin']) echo ' selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id('margin'); ?>"><?php _e('Margin'); ?></label>
			</p>

			<div class="widgetdivider"></div>
			</div>
			
		<div class="allstyles<?php echo $random; ?>">
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
			<input class="customoptionscheckbox<?php echo $random; ?>" type="checkbox" <?php if ($instance['custom-colors'] == "snoccon") echo checked; ?> id="<?php echo $this->get_field_id( 'custom-colors' ); ?>" name="<?php echo $this->get_field_name( 'custom-colors' ); ?>" />
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

	</div>
			<p>
				<select class="hideshadow<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'hide-shadow' ); ?>" name="<?php echo $this->get_field_name( 'hide-shadow' ); ?>">
					<option value="Use Default" <?php if ( 'Use Default' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Use Default</option>
					<option value="Hide" <?php if ( 'Hide' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Hide</option>
					<option value="Show" <?php if ( 'Show' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Show</option>
				</select>
				
			 Widget Drop Shadow</p>

	<?php if ($disable_js == '') { ?>
	
	<script type="text/javascript">
		
			jQuery('.hidetitle<?php echo $random; ?>').change(function() {
   		 		jQuery('.allstyles<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.hidetitle<?php echo $random; ?>').prop('checked')) {
				jQuery(".allstyles<?php echo $random; ?>").hide();
			} else {
				jQuery(".allstyles<?php echo $random; ?>").show();
			}		

    		jQuery(".display-style<?php echo $random; ?>").change(function() {
        		if (jQuery(this).val() == "Thumbnails") {
	        		jQuery(".thumbnail-options<?php echo $random; ?>").slideDown('slow');
	        		jQuery(".autoscrolloptions<?php echo $random; ?>").slideUp('slow');
	        	} else {
		        	jQuery(".thumbnail-options<?php echo $random; ?>").slideUp('slow');
	        		jQuery(".autoscrolloptions<?php echo $random; ?>").slideDown('slow');
		        }
        		if (jQuery(this).val() == "Slideshow with Thumbnails") {
	        		jQuery(".thumblocationoptions<?php echo $random; ?>").slideDown('slow');
	        	} else {
	        		jQuery(".thumblocationoptions<?php echo $random; ?>").slideUp('slow');
	        	}
		        
    		});
   			jQuery(document).ready(function() {
        		if (jQuery(".display-style<?php echo $random; ?>").val() == "Thumbnails") {
	        		jQuery(".thumbnail-options<?php echo $random; ?>").show();
	        		jQuery(".autoscrolloptions<?php echo $random; ?>").hide();
	        	} else { 
		        	jQuery(".thumbnail-options<?php echo $random; ?>").hide();
	        		jQuery(".autoscrolloptions<?php echo $random; ?>").show();
		        }
        		if (jQuery(".display-style<?php echo $random; ?>").val() == "Slideshow with Thumbnails") {
					jQuery(".thumblocationoptions<?php echo $random; ?>").show();
				} else {
					jQuery(".thumblocationoptions<?php echo $random; ?>").hide();
				}
    		});

    		jQuery(".story-id<?php echo $random; ?>").change(function() {
        		if (jQuery(this).val() == "All") {
	        		jQuery(".recentaddedoptions<?php echo $random; ?>").slideDown('slow');
	        	} else {
		        	jQuery(".recentaddedoptions<?php echo $random; ?>").slideUp('slow');
		        }
		        
    		});
   			jQuery(document).ready(function() {
        		if (jQuery(".story-id<?php echo $random; ?>").val() == "All") {
	        		jQuery(".recentaddedoptions<?php echo $random; ?>").show();
	        	} else { 
		        	jQuery(".recentaddedoptions<?php echo $random; ?>").hide();
		        }
    		});



			jQuery('.checkbox<?php echo $random; ?>').change(function() {
   		 		jQuery('.dividinglines<?php echo $random; ?>').slideToggle('slow');
			});
    		
    		if (jQuery('.checkbox<?php echo $random; ?>').prop('checked')) {
				jQuery(".dividinglines<?php echo $random; ?>").show();
			} else {
				jQuery(".dividinglines<?php echo $random; ?>").hide();
			}

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


	</script>
	
	<?php } ?>
	</div>


		
	<?php 
	}

}
}