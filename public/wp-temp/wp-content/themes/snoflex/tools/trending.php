<?php

add_action('widgets_init', create_function('', "register_widget('sno_trending');"));
class sno_trending extends WP_Widget {

	function __construct() {

		$this->defaults = array(
			'title' => '',
			'image' => '',
			'link'  => ''
			);

		$widget_ops = array(
			'classname' => 'sno_trending',
			'description' => __( 'Use this widget to add a list of your trending stories based on Google Analytics data.' )
			);

		$control_ops = array(
			'id_base' => 'trending'
			);

		parent::__construct( 'trending', __( '(SNO) Trending Stories' ), $widget_ops, $control_ops );

	}


	function widget($args, $instance) {
		extract($args); $unique = $this->id;
		$customcolors=$instance['custom-colors']; $videotitle = '';

		$shadow = '';
		if ($instance['hide-shadow'] == 'Hide' && get_theme_mod('widget-shadows') == 'On') {
			$shadow = "box-shadow: none;";
		} else if ($instance['hide-shadow'] == 'Show' && get_theme_mod('widget-shadows') != 'On') {
			$shadow = "box-shadow: -1px 0 2px 0 rgba(0, 0, 0, 0.12), 1px 0 2px 0 rgba(0, 0, 0, 0.12), 0 1px 1px 0 rgba(0, 0, 0, 0.24);";
		}

		$widgetwrap_style = " style='$shadow'";
	

		echo "<div class='widgetwrap sno-animate sno-$unique'$widgetwrap_style>";

		echo sno_widget_styles($instance, $customcolors, $categoryslug=null, $videotitle, $categoryname=null); 
		
		$transient_id = 'sno_tc_' . $this->id;
	
		$transient = get_transient( $transient_id );
		  
		if( ! empty( $transient ) && 1==2) { // disabling caching temporarily
    		
    		echo "\n<!-- widget displayed from cache -->\n";

			echo $transient;
		
		} else {
			$posts = get_option('trending_stories');
			$count = 0;
			$output = '';
			if(is_array($posts) && count($posts) > 0) {	
				wp_reset_query();
				
				$borderstyle = '';
				if ($instance['dividing-line'] == 'on') {
					$dividingcolor = $instance['line-color'];
					$dividingthickness = $instance['dividing-line-thickness'];
					$dividingstyle = $instance['dividing-line-type'];
					$borderstyle = " style='border-top: $dividingthickness $dividingstyle $dividingcolor;border-bottom: $dividingthickness $dividingstyle $dividingcolor;margin-bottom: -$dividingthickness;'";
				} else {
					$borderstyle = " style='border-top:none;border-bottom:none;margin-bottom:0px;'";
				}
				foreach ($posts as $post_id => $meta) {
					$count++;
					if ($count <= $instance['number']) {
						$post = get_post($post_id);
						setup_postdata($post);
						$post_views = $meta['views'];
						$post_title = $meta['title'];
						
						
						$output .= "<div class='trending-row'$borderstyle>";
						$output .= '<div class="trending-number">';
						$output .= $count;
						$output .= '</div>';
					
					
						if	($instance['teaser-thumb']=='on') {  
							
							if (has_post_thumbnail($post->ID)) { 
								
								$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');
	
								if ($image) {
									$output .= '<div class="trending-image">';
									$output .= '<a href="' . get_the_permalink($post->ID) . '" title="'. $post_title .'">';
									$output .= '<img src="' . $image[0] . '" alt="' . $post_title . '"/></a>'; 
									$output .= '</div>';
								}	
	
							}
						} 
	              
						$output .= '<div class="trendingheadline"><p><a class="homeheadline" href="'. get_the_permalink($post->ID) . '">' . $post_title . '</a>';
							
						if ($instance['show-views'] == 'on') $output .= '<span class="trending-views"> &bull; ' . $post_views . ' Views</span>';
						
						$output .= '</p></div>';
	
						$output .= '<div class="clear"></div></div>';
					
					}
						
				}
				
			echo $output;
			wp_reset_query();
			
			set_transient( 'sno_tc_' . $this->id, $output, HOUR_IN_SECONDS );	
				
			}
    
  		}
		
		?><div class="widget-expander" style="padding-bottom:<?php echo $instance['widget-expander']; ?>"></div><div class="clear"></div>

</div>

		<?php if ($instance['widget-style']=="Style 3") { ?><div style="display:block !important;
		
		<?php if ($instance['custom-colors'] == "snoccon") { ?>background: <?php echo $instance['header-color']; ?> <?php if ($instance['widget-gradient'] == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if ($instance['widget-gradient'] == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo $instance['widget-pattern']; ?>) repeat <?php } ?> !important;
		<?php } else { ?>
				background: <?php echo get_theme_mod('widgetcolor3'); ?> <?php if (get_theme_mod('widget3-gradient') == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if (get_theme_mod('widget3-gradient') == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo get_theme_mod('widget3-pattern'); ?>) repeat <?php } ?> !important;
		<?php } ?>
		" class="widgetfooter3"></div><?php } else if ($instance['widget-style']=="Style 2") { ?><div style="display:inline-block;"></div><?php } ?>
		
		
		</div>



				
<?php	}
	

	function update( $new_instance, $old_instance ) {

		delete_transient( 'sno_tc_' . $this->id );

		// let's add some code to force LiteSpeed to flush its cache when the widget is saved

		if ( is_plugin_active( 'litespeed-cache/litespeed-cache.php' ) ) {
			LiteSpeed_Cache_API::purge_all();
		}

		// cool, that's done

		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['widget-style'] = $new_instance['widget-style'];
 		$instance['custom-colors'] = ( isset( $new_instance['custom-colors'] ) ? "snoccon" : "" );  
		$instance['header-color'] = $new_instance['header-color'];
		$instance['header-text'] = $new_instance['header-text'];
		$instance['widget-border'] = $new_instance['widget-border'];
		$instance['widget-background'] = $new_instance['widget-background'];
		$instance['border-thickness'] = $new_instance['border-thickness'];
		$instance['number'] = $new_instance['number'];
		$instance['photowidth'] = $new_instance['photowidth'];
		$instance['sidebarname'] = $new_instance['sidebarname'];
 		$instance['show-views'] = ( isset( $new_instance['show-views'] ) ? on : "" );  
 		$instance['view-all'] = ( isset( $new_instance['view-all'] ) ? on : "" );  
 		$instance['teaser-thumb'] = ( isset( $new_instance['teaser-thumb'] ) ? on : "" );  
 		$instance['dividing-line'] = ( isset( $new_instance['dividing-line'] ) ? on : "" );  
		$instance['border-thickness2'] = $new_instance['border-thickness2'];
		$instance['widget-gradient'] = $new_instance['widget-gradient'];
		$instance['widget-padding'] = $new_instance['widget-padding'];
		$instance['widget-indent'] = $new_instance['widget-indent'];
		$instance['widget-pattern'] = $new_instance['widget-pattern'];
		$instance['dividing-line-type'] = $new_instance['dividing-line-type'];
		$instance['dividing-line-thickness'] = $new_instance['dividing-line-thickness'];
		$instance['line-color'] = $new_instance['line-color'];
		$instance['custom-link'] = $new_instance['custom-link'];
		$instance['box1'] = $new_instance['box1'];
		$instance['box3'] = $new_instance['box3'];
		$instance['widget-header-size'] = $new_instance['widget-header-size'];
		$instance['widget-expander'] = $new_instance['widget-expander'];
		$instance['timeval'] = $new_instance['timeval'];
		$instance['time'] = $new_instance['time'];
		$instance['timeval-wp'] = $new_instance['timeval-wp'];
		$instance['time-wp'] = $new_instance['time-wp'];
		$instance['center-title'] = $new_instance['center-title'];
		$instance['hide-shadow'] = $new_instance['hide-shadow'];
		return $instance;
		
	}

	function form($instance) { 
		$defaults = array( 'title' => 'Trending Stories', 'number' => '5', 'number-headlines' => '3', 'show-views' => '', 'border-thickness' => '1px', 'teaser-thumb' => 'on', 'widget-style'=>get_theme_mod('widget-style-sno'), 'header-color' => get_theme_mod('widgetcolor1'), 'header-text' => get_theme_mod('widgetcolor1-text'), 'widget-border' => '#aaaaaa', 'widget-background' => '#eeeeee', 'border-thickness' => '1px', 'border-thickness2' => '3px', 'widget-gradient' => 'On', 'widget-header-size' => 'Small', 'widget-expander' => '0px', 'timeval-wp' => '2', 'time-wp' => '2628000', 'timeval' => '2', 'time' => '2628000', 'line-color' => '#dddddd', 'dividing-line' => 'on', 'hide-shadow' => 'Use Default');
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$random = mt_rand(); $disable_js = ''; $hide_all = '';
		$number = $this->number;
		
		$check = $this->number; $currentScreen = get_current_screen(); 
if ($check == '__i__' && $currentScreen->id === "widgets"){
	echo '<div class="not_saved">';
		?><script type="text/javascript">
			initwidgettrending = setInterval(function() {
				$('.widget-control-save').prop("disabled", false); // Saving is now enabled.
				$('.widget-control-save').val("Save"); 
				clearInterval(initwidgettrending)		
   			}, 1000);
		</script><?php
		echo '<p>Hit the Save button, pardner, and we\'ll get this party started.</p>';
	echo '</div>';
	$hide_all = ' style="display:none;"';
		
}

if ( !is_plugin_active( 'sno-google-analytics/sno-google-analytics.php' )) {
	echo '<div class="not_saved">';
		echo '<p>This widget requires that the SNO Google Analytics plugin be active. Contact <a href="https://sno.zendesk.com/hc/en-us/requests/new">SNO Support</a> if you need assistance.</p>';
	echo '</div>';
	$hide_all = ' style="display:none;"';
}




if ($check == '__i__' ) { $disable_js = 'on'; } // disable javascript here
		
		if ($instance['box1'] == 'Closed') { 
			$box1 = ' style="display:none"'; $expand1 = ''; $collapse1 = ' style="display:none"'; 
		} else { 
			$box1 = ''; $collapse1 = ''; $expand1 = ' style="display:none"'; 
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
			Content Options
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody1-<?php echo $random; ?>" <?php echo $box1; ?>>

		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title"); ?>:</label><br />
		<?php if ($instance['title'] == '') $instance['title'] = 'Trending Stories'; ?>
		<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" />
		</p>

			
<!--
		<p><label><b>Include traffic from the past</b>

			<div class="timestamp-wrap">
				<?php

				echo '<select style="margin-right: 5px;" id="'. $this->get_field_id( 'timeval' ) .'" name="'. $this->get_field_name( 'timeval' ) .'">';

				for ( $i = 1; $i <= 30; $i = $i + 1 ) {
					echo '<option value="'. $i .'"';
					if ($i == $instance['timeval']) echo ' selected="selected"';
					echo '>' . $i;
					echo '</option>';
				}

				echo '</select>';
				
				echo '<select style="width: 50%;" id="'. $this->get_field_id( 'time' ) .'" name="'. $this->get_field_name( 'time' ) .'">';

				echo '<option value="3600"', selected( '3600', $instance['time'] ) ,'>hour(s)</option>';
				echo '<option value="86400"', selected( '86400', $instance['time'] ) ,'>day(s)</option>';
				echo '<option value="2628000"', selected( '2628000', $instance['time'] ) ,'>month(s)</option>';
				echo '<option value="31536000"', selected( '31536000', $instance['time'] ) ,'>year(s)</option>';

				echo '</select>';
				?>
			</div>
		</label></p>

		<div class="widgetdivider"></div>

		<p><label><b>Include only stories published in the last</b>

			<div class="timestamp-wrap">
				<?php
					

				echo '<select style="margin-right: 5px;" id="'. $this->get_field_id( 'timeval-wp' ) .'" name="'. $this->get_field_name( 'timeval-wp' ) .'">';

				for ( $i = 1; $i <= 30; $i = $i + 1 ) {
					echo '<option value="'. $i .'"';
					if ($i == $instance['timeval-wp']) echo ' selected="selected"';
					echo '>' . $i;
					echo '</option>';
				}

				echo '</select>';

				echo '<select style="width: 50%;" id="'. $this->get_field_id( 'time-wp' ) .'" name="'. $this->get_field_name( 'time-wp' ) .'">';

				echo '<option value="3600"', selected( '3600', $instance['time-wp'] ) ,'>hour(s)</option>';
				echo '<option value="86400"', selected( '86400', $instance['time-wp'] ) ,'>day(s)</option>';
				echo '<option value="2628000"', selected( '2628000', $instance['time-wp'] ) ,'>month(s)</option>';
				echo '<option value="31536000"', selected( '31536000', $instance['time-wp'] ) ,'>year(s)</option>';

				echo '</select>';
				?>
			</div>
		</label></p>
-->

		<p>This widget will analyze your Google analytics data and display a list of the most viewed stories in the past 60 days on your site.</p>
				
		<div class="widgetdivider"></div>


			<p>
				<select id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>">
					<?php for ($i = 0; $i <= 14; $i++) { 
						echo "<option value='$i'";
						if ($i == $instance['number']) echo ' selected="selected"';
						echo ">$i</option>";
					} ?>
				</select>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Stories'); ?></label>
			</p>

			<div class="widgetdivider"></div>

			
			
			<input class="teaserselect<?php echo $random; ?>" type="checkbox" <?php if ($instance['teaser-thumb'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'teaser-thumb' ); ?>" name="<?php echo $this->get_field_name( 'teaser-thumb' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'teaser-thumb' ); ?>"> Show Thumbnails</label>
		<br />
		
			<input class="checkbox" type="checkbox" <?php if ($instance['show-views'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-views' ); ?>" name="<?php echo $this->get_field_name( 'show-views' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-views' ); ?>">Show Views</label>			
		
		<br />

		
			<input class="checkbox<?php echo $random; ?>" type="checkbox" <?php if ($instance['dividing-line'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'dividing-line' ); ?>" name="<?php echo $this->get_field_name( 'dividing-line' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'dividing-line' ); ?>"> Show Dividing Lines</label>

		<br />
				

		<div class="dividinglines<?php echo $random; ?>">
		<br />

		<div class="widgetdivider"></div>
				<label for="<?php echo $this->get_field_id( 'dividing-line-thickness' ); ?>"> Dividing Line Style</label><br />

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
				<br /><br />

				<label style="display:block" for="<?php echo $this->get_field_id('line-color'); ?>">Dividing Line Color</label>
				<input maxlength="7" size="7" class="my-color-picker" id="<?php echo $this->get_field_id('line-color'); ?>" name="<?php echo $this->get_field_name('line-color'); ?>" value="<?php echo $instance['line-color']; ?>" />

			<br />

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

			<p>
				<select class="hideshadow<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'hide-shadow' ); ?>" name="<?php echo $this->get_field_name( 'hide-shadow' ); ?>">
					<option value="Use Default" <?php if ( 'Use Default' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Use Default</option>
					<option value="Hide" <?php if ( 'Hide' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Hide</option>
					<option value="Show" <?php if ( 'Show' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Show</option>
				</select>
				
			 Widget Drop Shadow</p>
		
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
    						jQuery("#widgetbody3-<?php echo $random; ?>").slideUp('slow'); 
	    			    	jQuery("#collapse3-<?php echo $random; ?>").hide();
	    			    	jQuery("#expand3-<?php echo $random; ?>").show();
     						jQuery('#<?php echo $wid[1]; ?>').val('Open'); 
     						jQuery('#<?php echo $wid[3]; ?>').val('Closed'); 
    					} 

    				});
    				jQuery("#widgetsection3-<?php echo $random; ?>").click(function() {
    			    	jQuery("#widgetbody3-<?php echo $random; ?>").slideToggle('slow');
    			    	jQuery("#collapse3-<?php echo $random; ?>").toggle();
    			    	jQuery("#expand3-<?php echo $random; ?>").toggle();
    					if(jQuery('#collapse3-<?php echo $random; ?>').is(':visible')) { 
    						jQuery("#widgetbody1-<?php echo $random; ?>").slideUp('slow'); 
	    			    	jQuery("#collapse1-<?php echo $random; ?>").hide();
	    			    	jQuery("#expand1-<?php echo $random; ?>").show();
     						jQuery('#<?php echo $wid[1]; ?>').val('Closed'); 
     						jQuery('#<?php echo $wid[3]; ?>').val('Open'); 
    					} 
    				});
			

	</script>
	
	<?php } ?>
		</div>
		<div class="lastsection"></div>
	</div>
		
	<?php 
	}

}
