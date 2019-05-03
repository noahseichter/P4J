<?php

add_action('widgets_init', create_function('', "register_widget('sno_sports_scrollbox');"));
class sno_sports_scrollbox extends WP_Widget {

	function __construct() {

		$this->defaults = array(
			'title' => '',
			'image' => '',
			'link'  => ''
			);

		$widget_ops = array(
			'classname' => 'sno_sports_score',
			'description' => __( 'Use this widget to display a Sports Score Scroller.' )
			);

		$control_ops = array(
			'id_base' => 'sportsscore'
			);

		parent::__construct( 'sportsscore', __( '(SNO) Sports Score Scroller' ), $widget_ops, $control_ops );

	}


	function widget($args, $instance) {
		extract($args);

				$widget = $this->id; $sidebartest = get_option('sidebars_widgets'); 
				$columns = get_theme_mod('sno-layout'); 
					
				$widget_area_info = sno_get_widget_width($widget);				
				$outer_width = $widget_area_info[1];
		
			$customcolors=$instance['custom-colors']; $categoryslug = ''; $videotitle = ''; $categoryname = '';
			
				$shadow = '';
				if (isset($instance['hide-shadow']) && $instance['hide-shadow'] == 'Hide' && get_theme_mod('widget-shadows') == 'On') {
					$shadow = "box-shadow: none;";
				} else if (isset($instance['hide-shadow']) && $instance['hide-shadow'] == 'Show' && get_theme_mod('widget-shadows') != 'On') {
					$shadow = "box-shadow: -1px 0 2px 0 rgba(0, 0, 0, 0.12), 1px 0 2px 0 rgba(0, 0, 0, 0.12), 0 1px 1px 0 rgba(0, 0, 0, 0.24);";
				}

				$widgetwrap_style = " style='$shadow'";
			
			
			echo "<div class='widgetwrap sno-animate sno-$widget'$widgetwrap_style>";
			echo sno_widget_styles($instance, $customcolors, $categoryslug, $videotitle, $categoryname); ?>

							
				<?php $number = $this->number; ?>		
			
				<script type="text/javascript">
					$(function() {
					$(".newsticker-jcarousellite<?php echo $number; ?>").jCarouselLite({
       						 <?php echo $instance['sports-scroll-style']; ?>: true,
        					visible: <?php echo $instance['sports-scrollbox-visible']; ?>,
        					auto: <?php echo $instance['sports-speed']; ?>,
        					speed:<?php echo $instance['sports-transition']; ?>,
							<?php if ($instance['sports-scroll-style'] == "vertical") {?>scroll: <?php echo $instance['sports-scrollbox-number']; ?><?php } ?>
						    });
					});
				</script>
			
				<?php $countmax = $instance['sports-scrollbox']; ?>
				<?php $count = 1; ?>	
					<?php wp_reset_query(); global $wpdb; $querystr = "
						SELECT * FROM $wpdb->posts 
						JOIN $wpdb->postmeta AS date ON(
						$wpdb->posts.ID = date.post_id 
						AND date.meta_key = 'date')
						JOIN $wpdb->postmeta AS ourscore ON(
						$wpdb->posts.ID = ourscore.post_id 
						AND ourscore.meta_key = 'ourscore' 
						AND ourscore.meta_value != '')
						AND $wpdb->posts.post_status = 'publish' 
						ORDER BY date.meta_value DESC LIMIT $countmax
						"; $pageposts = $wpdb->get_results($querystr, OBJECT); ?>
						
						<?php global $post; ?>
						<?php if ($pageposts): ?>
  						<?php foreach ($pageposts as $post): ?>
    						<?php setup_postdata($post); ?>
 						           	<?php $gamedate=get_post_meta($post->ID, 'date', true); $date = explode("-",$gamedate); $finaldate = date("l, F j",mktime(0,0,0,$date[1],$date[2],$date[0]));?>
								<?php $ourscore=get_post_meta($post->ID, 'ourscore', true);?>
							        <?php $theirscore=get_post_meta($post->ID, 'theirscore', true);?>
            							<?php $opponent = get_post_meta($post->ID, 'opponent', true); ?>
            							<?php $sport = get_post_meta($post->ID, 'sport', true); ?>
            							<?php $storylink = get_post_meta($post->ID, 'storylink', true); ?>
            							<?php $width = $outer_width; ?>

								<?php if ($count==1) { $exitkey=6; ?>
	
										<div class="sportsscrollbox"<?php if ($instance['sports-scroll-lines'] == 'Show') { ?> style="border-bottom: 1px solid #c0c0c0;overflow-y:hidden;"<?php } ?>>

    									<div id="newsticker-demo<?php echo $number; ?>" style="width:<?php echo $width; ?>px">    
        								<div class="newsticker-jcarousellite<?php echo $number; ?>" style="width:<?php echo $width; ?>px">
        								<ul>
								<?php } ?>
                							<li>
                							<div class="sportsscore" style="<?php if ($instance['sports-scroll-lines'] == 'Show') { ?>border-top: 1px solid #c0c0c0;<?php } ?>width:<?php echo $width; ?>px;padding-top:8px;margin-bottom:8px;">
                    							<p><?php echo $finaldate; ?></p>
                    							<p><?php echo $sport; ?></p>
                    							<?php if ($storylink) echo '<a href="' . $storylink . '">'; ?>
                    								<p><?php echo $instance['school'];?> <?php echo $ourscore; if (($theirscore == "0") || ($theirscore != "")) { ?>  - <?php echo $opponent; ?> <?php echo $theirscore; } ?></p>
                     							<?php if ($storylink) echo '</a>'; ?>
                    							</div>
                							<div class="clear"></div>
            								</li>
									<?php $count++; ?>
						<?php endforeach; ?>  
  						<?php else : ?>
 						<?php endif; ?>

							<?php if ($exitkey==6) { $exitkey=0; ?>
								</ul>
    								</div>
    								</div>
    								</div>

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
		
  	<?php } 
		function update( $new_instance, $old_instance ) {

		// let's add some code to force LiteSpeed to flush its cache when the widget is saved

		if ( is_plugin_active( 'litespeed-cache/litespeed-cache.php' ) ) {
			LiteSpeed_Cache_API::purge_all();
		}

		// cool, that's done

		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['school'] = strip_tags( $new_instance['school'] );
		$instance['sports-scrollbox'] = $new_instance['sports-scrollbox'];
		$instance['sports-scrollbox-visible'] = $new_instance['sports-scrollbox-visible'];
		$instance['sports-scrollbox-number'] = $new_instance['sports-scrollbox-number'];
		$instance['sports-scroll-style'] = $new_instance['sports-scroll-style'];
		$instance['sports-speed'] = $new_instance['sports-speed'];
		$instance['sports-transition'] = $new_instance['sports-transition'];
		$instance['sports-scroll-lines'] = $new_instance['sports-scroll-lines'];
		$instance['widget-style'] = $new_instance['widget-style'];
 		$instance['custom-colors'] = ( isset( $new_instance['custom-colors'] ) ? "snoccon" : "" );  
		$instance['header-color'] = $new_instance['header-color'];
		$instance['header-text'] = $new_instance['header-text'];
		$instance['widget-border'] = $new_instance['widget-border'];
		$instance['widget-background'] = $new_instance['widget-background'];
		$instance['border-thickness'] = $new_instance['border-thickness'];
		$instance['sidebarname'] = $new_instance['sidebarname'];
		$instance['photowidth'] = $new_instance['photowidth'];
		$instance['border-thickness2'] = $new_instance['border-thickness2'];
		$instance['widget-gradient'] = $new_instance['widget-gradient'];
		$instance['widget-padding'] = $new_instance['widget-padding'];
		$instance['widget-indent'] = $new_instance['widget-indent'];
		$instance['widget-pattern'] = $new_instance['widget-pattern'];
		$instance['box1'] = $new_instance['box1'];
		$instance['box2'] = $new_instance['box2'];
		$instance['widget-header-size'] = $new_instance['widget-header-size'];
		$instance['widget-expander'] = $new_instance['widget-expander'];
		$instance['center-title'] = $new_instance['center-title'];
		$instance['hide-shadow'] = $new_instance['hide-shadow'];
		return $instance;
	}

	function form($instance) { 
			$schoolname = get_theme_mod('school-name');
			if ($schoolname == '') $schoolname = 'Enter School Name Here';
			$defaults = array( 'title' => 'Recent Sports Scores', 'school' => $schoolname, 'sports-scrollbox' => '10', 'sports-scrollbox-visible' => '1', 'sports-scrollbox-number' => '1', 'sports-scroll-style' => 'vertical', 'sports-speed' => '3000', 'sports-transition' => '666', 'widget-style' => get_theme_mod('widget-style-sno'), 'header-color' => get_theme_mod('widgetcolor1'), 'header-text' => get_theme_mod('widgetcolor1-text'), 'widget-border' => '#aaaaaa', 'widget-background' => '#eeeeee', 'border-thickness' => '1px', 'border-thickness2' => '3px', 'widget-gradient' => 'On', 'sports-scroll-lines' => 'Hide', 'widget-header-size' => 'Small', 'widget-expander' => '0px', 'hide-shadow' => 'Use Default' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$random = mt_rand(); $disable_js = ''; $hide_all = '';
		$number = $this->number;
		
		$check = $this->number; $currentScreen = get_current_screen(); 
if ($check == '__i__' && $currentScreen->id === "widgets"){
	echo '<div class="not_saved">';
		?><script type="text/javascript">
			initwidgetssb = setInterval(function() {
				$('.widget-control-save').prop("disabled", false); // Saving is now enabled.
				$('.widget-control-save').val("Save"); 
				clearInterval(initwidgetssb)		
   			}, 1000);
		</script><?php
		echo '<p>Hit the Save button, pardner, and we\'ll get this party started.</p>';
	echo '</div>';
	$hide_all = ' style="display:none;';
		
}
if ($check == '__i__' ) { $disable_js = 'on'; } // disable javascript here
			
		if ( isset ( $instance['box1'] ) && $instance['box1'] == 'Closed') { 
			$box1 = ' style="display:none"'; $expand1 = ''; $collapse1 = ' style="display:none"'; 
		} else { 
			$box1 = ''; $collapse1 = ''; $expand1 = ' style="display:none"'; 
		} 
		
		if ( isset ( $instance['box2'] ) && $instance['box2'] == 'Closed') { 
			$box2 = ' style="display:none"'; $expand2 = ''; $collapse2 = ' style="display:none"'; 
		} else { 
			$box2 = ''; $collapse2 = ''; $expand2 = ' style="display:none"'; 
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

		<div class="widgetsection" id="widgetsection1-<?php echo $random; ?>">
			<div class="expand" id="expand1-<?php echo $random; ?>" <?php echo $expand1; ?>></div><div class="collapse" id="collapse1-<?php echo $random; ?>" <?php echo $collapse1; ?>></div>
			Display Options
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody1-<?php echo $random; ?>" <?php echo $box1; ?>>
			
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title"); ?>:</label><br />
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('school'); ?>"><?php _e("Your School Name"); ?>:</label><br />
			<input type="text" id="<?php echo $this->get_field_id('school'); ?>" name="<?php echo $this->get_field_name('school'); ?>" value="<?php echo $instance['school']; ?>" style="width:95%;" />
		</p>		
		<p>
			<input type="text" id="<?php echo $this->get_field_id('sports-scrollbox'); ?>" name="<?php echo $this->get_field_name('sports-scrollbox'); ?>" value="<?php echo $instance['sports-scrollbox']; ?>" size="2" /> Number of Scores to cycle through scrollbox? 
		</p>
        <p> 
			<input type="text" id="<?php echo $this->get_field_id('sports-scrollbox-visible'); ?>" name="<?php echo $this->get_field_name('sports-scrollbox-visible'); ?>" value="<?php echo $instance['sports-scrollbox-visible']; ?>" size="2" /> Number of Scores to be visible at once? (for vertical scroll only)
		</p>
        <p> 
			<input type="text" id="<?php echo $this->get_field_id('sports-scrollbox-number'); ?>" name="<?php echo $this->get_field_name('sports-scrollbox-number'); ?>" value="<?php echo $instance['sports-scrollbox-number']; ?>" size="2" /> Number of Scores to slide on each scroll? (for vertical scroll only)
		</p>
		<p>
			<select id="<?php echo $this->get_field_id( 'sports-scroll-style' ); ?>" name="<?php echo $this->get_field_name( 'sports-scroll-style' ); ?>">
				<option value="vertical" <?php if ( 'vertical' == $instance['sports-scroll-style'] ) echo 'selected="selected"'; ?>>vertical</option>
				<option value="horizontal" <?php if ( 'horizontal' == $instance['sports-scroll-style'] ) echo 'selected="selected"'; ?>>horizontal</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'sports-scroll-style' ); ?>">Slide Direction</label>
		<br />

			<select id="<?php echo $this->get_field_id( 'sports-speed' ); ?>" name="<?php echo $this->get_field_name( 'sports-speed' ); ?>">
				<option value="2000" <?php if ( '2000' == $instance['sports-speed'] ) echo 'selected="selected"'; ?>>2 Seconds</option>
				<option value="3000" <?php if ( '3000' == $instance['sports-speed'] ) echo 'selected="selected"'; ?>>3 Seconds</option>
				<option value="4000" <?php if ( '4000' == $instance['sports-speed'] ) echo 'selected="selected"'; ?>>4 Seconds</option>
				<option value="5000" <?php if ( '5000' == $instance['sports-speed'] ) echo 'selected="selected"'; ?>>5 Seconds</option>
				<option value="6000" <?php if ( '6000' == $instance['sports-speed'] ) echo 'selected="selected"'; ?>>6 Seconds</option>
				<option value="7000" <?php if ( '7000' == $instance['sports-speed'] ) echo 'selected="selected"'; ?>>7 Seconds</option>
				<option value="8000" <?php if ( '8000' == $instance['sports-speed'] ) echo 'selected="selected"'; ?>>8 Seconds</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'sports-speed' ); ?>">Slide Duration</label>
		<br />
		
			<select id="<?php echo $this->get_field_id( 'sports-transition' ); ?>" name="<?php echo $this->get_field_name( 'sports-transition' ); ?>">
				<option value="333" <?php if ( '333' == $instance['sports-transition'] ) echo 'selected="selected"'; ?>>Fast</option>
				<option value="666" <?php if ( '666' == $instance['sports-transition'] ) echo 'selected="selected"'; ?>>Medium</option>
				<option value="1000" <?php if ( '1000' == $instance['sports-transition'] ) echo 'selected="selected"'; ?>>Slow</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'sports-transition' ); ?>">Slide Transition Time</label><br />
			
			<select id="<?php echo $this->get_field_id( 'sports-scroll-lines' ); ?>" name="<?php echo $this->get_field_name( 'sports-scroll-lines' ); ?>">
				<option value="Show" <?php if ( 'Show' == $instance['sports-scroll-lines'] ) echo 'selected="selected"'; ?>>Show</option>
				<option value="Hide" <?php if ( 'Hide' == $instance['sports-scroll-lines'] ) echo 'selected="selected"'; ?>>Hide</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'sports-scroll-lines' ); ?>">Dividing Lines</label>
			
		</p>

		</div>

		<div class="widgetsection" id="widgetsection2-<?php echo $random; ?>">
			<div class="expand" id="expand2-<?php echo $random; ?>" <?php echo $expand2; ?>></div><div class="collapse" id="collapse2-<?php echo $random; ?>" <?php echo $collapse2; ?>></div>
			Widget Appearance
		</div>
		<div class="clear"></div>
		<div class="widgetbody" id="widgetbody2-<?php echo $random; ?>" <?php echo $box2; ?>>
		
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

	<?php 
		$wid = array(); 
		$wid[0] = $this->number;
		$wid[1] = $this->get_field_id('box1'); 
		$wid[2] = $this->get_field_id('box2'); 
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
    						jQuery("#widgetbody2-<?php echo $random; ?>").slideUp('slow'); 
	    			    	jQuery("#collapse2-<?php echo $random; ?>").hide();
	    			    	jQuery("#expand2-<?php echo $random; ?>").show();
     						jQuery('#<?php echo $wid[1]; ?>').val('Open'); 
     						jQuery('#<?php echo $wid[2]; ?>').val('Closed'); 
    					} 

    				});
    				jQuery("#widgetsection2-<?php echo $random; ?>").click(function() {
    			    	jQuery("#widgetbody2-<?php echo $random; ?>").slideToggle('slow');
    			    	jQuery("#collapse2-<?php echo $random; ?>").toggle();
    			    	jQuery("#expand2-<?php echo $random; ?>").toggle();
    					if(jQuery('#collapse2-<?php echo $random; ?>').is(':visible')) { 
    						jQuery("#widgetbody1-<?php echo $random; ?>").slideUp('slow'); 
	    			    	jQuery("#collapse1-<?php echo $random; ?>").hide();
	    			    	jQuery("#expand1-<?php echo $random; ?>").show();
     						jQuery('#<?php echo $wid[1]; ?>').val('Closed'); 
     						jQuery('#<?php echo $wid[2]; ?>').val('Open'); 
    					} 
    				});


	</script>
	<?php } ?>
	</div>
	<div class="lastsection"></div>

	<?php 
	}
}
?>