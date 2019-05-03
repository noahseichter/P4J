<?php

add_action('widgets_init', create_function('', "register_widget('sno_audio');"));
class sno_audio extends WP_Widget {

	function sno_audio() {
		$widget_ops = array( 'classname' => 'SNO Podcasts', 'description' => 'Display a list of recent podcasts with this widget.' );
		$control_ops = array( 'width' => 500, 'height' => 250, 'id_base' => 'audio' );
		$this->WP_Widget( 'audio', 'SNO Podcasts', $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
		extract($args);
		
		if (($instance['category'] == -1) || ($instance['number'] <= 0)) {} else {
				$widget = $this->id; 

		$categoryslug = cat_id_to_slug($instance['category']); $categoryname = cat_id_to_name($instance['category']);$customcolors=$instance['custom-colors']; $videotitle = '';
			
			echo '<div class="widgetwrap sno-animate">';

			echo sno_widget_styles($instance, $customcolors, $categoryslug, $videotitle, $categoryname); ?>
			
						
                <?php $count=0; $recent = new WP_Query('cat=' . $instance['category'] . '&showposts=' . $instance['number']); while($recent->have_posts()) : $recent->the_post();?>

		<?php global $post; $count++; ?>
			<?php if (($count>1)&&($count<=$instance['number'])) { if ($instance['dividing-line']==on) { ?><div class="storybottom"></div><?php } else { ?><div class="storybottomnoline"></div><?php }} ?>
			<?php $headlinesize = $instance['headline-size']; $headlineheight = floor($headlinesize * 1.5); ?>
			<?php if (($instance['show-date']==on)) { ?><p class="datetime"><?php the_time('F j, Y '); ?></p><?php } ?>
			<h3><a href="<?php the_permalink() ?>"  class="homeheadline" style="font-size:<?php echo $headlinesize; ?>px; line-height:<?php echo $headlineheight; ?>px;"rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h3>

		     <?php if($instance['teaser-thumb']==on) { 
                   $thumbplacement=$instance['teaser-thumb-placement']; ?>
                                   				  
<?php global $post; $feature_photo = get_post_meta($post->ID, 'review_thumbnail', true); if (has_post_thumbnail()) 
			{ the_post_thumbnail( 'thumbnail', array('class' => 'catboxthumb', 'style' => 'margin-bottom:10px; float:'.$thumbplacement.'; margin-'.$thumbplacement.':0px;')); } 
	else if ($feature_photo) { ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $feature_photo; ?>" class="catboxthumb" style="float:<?php echo $thumbplacement; ?>;margin-bottom:10px !important;margin-<?php echo $thumbplacement; ?>:0px;width:70px" /></a><?php } ?>

				  
				<?  } 
		  	$teaser = $instance['category-teaser']; 
  			if ($teaser) the_content_limit($teaser, "<span class='readmore'>read story</span>"); 
  			echo '<div class="clear"></div>';
  			?>
  			
            <?php $audio = get_post_meta($post->ID, 'audio', true); if ($audio) { $audioplayer = "[audio mp3=" . $audio . "]"; echo do_shortcode($audioplayer); } ?>
              	<div style="clear:both;"></div>
            	<?php endwhile;?>	
        <?php if ($instance['view-all']==on) { ?>
			 <?php if ($instance['dividing-line']==on) { ?><div class="storybottom"></div><?php } else { ?><div class="storybottomnoline"></div><?php } ?>
					<a href="<?php echo cat_id_to_slug($instance['category']); ?>"><p class="viewall">View All <span class="arrows"> &raquo;</span></p></a>
		<?php } ?>

		</div>
			
		<?php if ($instance['widget-style']=="Style 3") { ?><div style="display:block !important;
		
		<?php if ($instance['custom-colors'] == "snoccon") { ?>background: <?php echo $instance['header-color']; ?> <?php if ($instance['widget-gradient'] == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if ($instance['widget-gradient'] == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo $instance['widget-pattern']; ?>) repeat <?php } ?> !important;
		<?php } else { ?>
				background: <?php echo get_theme_mod('widgetcolor3'); ?> <?php if (get_theme_mod('widget3-gradient') == "On") { ?>url(<?php bloginfo('template_url'); ?>/images/navbg.png) repeat-x <?php } else if (get_theme_mod('widget3-gradient') == 'Off') { ?>url(<?php bloginfo('template_url'); ?>/images/<?php echo get_theme_mod('widget3-pattern'); ?>) repeat <?php } ?> !important;
		<?php } ?>
		" class="widgetfooter3"></div><?php } else if ($instance['widget-style']=="Style 2") { ?><div style="display:inline-block;"></div><?php } ?>

</div><?php
	}
	}

		function update( $new_instance, $old_instance ) {


		// let's add some code to force LiteSpeed to flush its cache when the widget is saved

		if ( is_plugin_active( 'litespeed-cache/litespeed-cache.php' ) ) {
			LiteSpeed_Cache_API::purge_all();
		}

		// cool, that's done

		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['widget-style'] = $new_instance['widget-style'];
 		$instance['custom-colors'] = ( isset( $new_instance['custom-colors'] ) ? "snoccon" : "" );  
		$instance['header-color'] = $new_instance['header-color'];
		$instance['header-text'] = $new_instance['header-text'];
		$instance['widget-border'] = $new_instance['widget-border'];
		$instance['widget-background'] = $new_instance['widget-background'];
		$instance['border-thickness'] = $new_instance['border-thickness'];
		$instance['category'] = $new_instance['category'];
		$instance['number'] = $new_instance['number'];
		$instance['teaser-thumb-placement'] = $new_instance['teaser-thumb-placement'];
		$instance['sidebarname'] = $new_instance['sidebarname'];
		$instance['category-teaser'] = $new_instance['category-teaser'];
		$instance['headline-size'] = $new_instance['headline-size'];
 		$instance['view-all'] = ( isset( $new_instance['view-all'] ) ? on : "" );  
 		$instance['teaser-thumb'] = ( isset( $new_instance['teaser-thumb'] ) ? on : "" );  
 		$instance['dividing-line'] = ( isset( $new_instance['dividing-line'] ) ? on : "" );  
 		$instance['show-date'] = ( isset( $new_instance['show-date'] ) ? on : "" );  
		$instance['border-thickness2'] = $new_instance['border-thickness2'];
		$instance['widget-gradient'] = $new_instance['widget-gradient'];
		$instance['widget-padding'] = $new_instance['widget-padding'];
		$instance['widget-indent'] = $new_instance['widget-indent'];
		$instance['widget-pattern'] = $new_instance['widget-pattern'];
		return $instance;
	}
	function form($instance) { 
			$defaults = array( 'number' => '3', 'headline-size' => '16', 'teaser-thumb-placement' => 'right', 'teaser-thumb' => 'on', 'dividing-line' => 'on', 'header-color' => get_theme_mod('widgetcolor1'), 'header-text' => get_theme_mod('widgetcolor1-text'), 'widget-border' => '#aaaaaa', 'widget-background' => '#eeeeee', 'widget-style' => get_theme_mod('widget-style-sno'), 'border-thickness' => '1px', 'border-thickness2' => '3px', 'widget-gradient' => 'On' );
			$instance = wp_parse_args( (array) $instance, $defaults ); ?>


		<div style="float:left;width:230px;margin-right:20px;border-right:1px solid #aaaaaa;padding-right:10px;">
		<p style="font-weight:bold;text-decoration:underline;">Widget Content</p>

		<p>Select your audio/podcast category.<br />
		<?php wp_dropdown_categories(array('selected' => $instance['category'], 'name' => $this->get_field_name( 'category' ), 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_none' => __("None", 'studiopress'), 'hide_empty' => '0' )); ?>
		</p>
		<?php $categorytitle = cat_id_to_name($instance['category']); ?><input type="hidden" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $categorytitle; ?>" />
		<p>
			<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" maxlength="1" size="1" value="<?php echo $instance['number']; ?>" />
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number to Display'); ?></label>
		<br />
			<select id="<?php echo $this->get_field_id( 'headline-size' ); ?>" name="<?php echo $this->get_field_name( 'headline-size' ); ?>">
				<option value="14" <?php if ( '14' == $instance['headline-size'] ) echo 'selected="selected"'; ?>>14</option>
				<option value="16" <?php if ( '16' == $instance['headline-size'] ) echo 'selected="selected"'; ?>>16</option>
				<option value="18" <?php if ( '18' == $instance['headline-size'] ) echo 'selected="selected"'; ?>>18</option>
				<option value="20" <?php if ( '20' == $instance['headline-size'] ) echo 'selected="selected"'; ?>>20</option>
				<option value="22" <?php if ( '22' == $instance['headline-size'] ) echo 'selected="selected"'; ?>>22</option>
				<option value="24" <?php if ( '24' == $instance['headline-size'] ) echo 'selected="selected"'; ?>>24</option>
				<option value="26" <?php if ( '26' == $instance['headline-size'] ) echo 'selected="selected"'; ?>>26</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'headline-size' ); ?>">Headline Size</label>
		<br />
		<input id="<?php echo $this->get_field_id('category-teaser'); ?>" name="<?php echo $this->get_field_name('category-teaser'); ?>" type="text" maxlength="3" size="3" value="<?php echo $instance['category-teaser']; ?>" />
		<label for="<?php echo $this->get_field_id('category-teaser'); ?>">Teaser Length (characters)</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php if ($instance['show-date'] == on) echo checked; ?> id="<?php echo $this->get_field_id( 'show-date' ); ?>" name="<?php echo $this->get_field_name( 'show-date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show-date' ); ?>"> Show Date</label>
		<br />

			<input class="checkbox" type="checkbox" <?php if ($instance['teaser-thumb'] == on) echo checked; ?> id="<?php echo $this->get_field_id( 'teaser-thumb' ); ?>" name="<?php echo $this->get_field_name( 'teaser-thumb' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'teaser-thumb' ); ?>"> Show Thumbnails</label>
		<br />
			<select id="<?php echo $this->get_field_id( 'teaser-thumb-placement' ); ?>" name="<?php echo $this->get_field_name( 'teaser-thumb-placement' ); ?>">
				<option value="left" <?php if ( 'left' == $instance['teaser-thumb-placement'] ) echo 'selected="selected"'; ?>>Left</option>
				<option value="right" <?php if ( 'right' == $instance['teaser-thumb-placement'] ) echo 'selected="selected"'; ?>>Right</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'teaser-thumb-placement' ); ?>">Thumbnail Placement</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php if ($instance['dividing-line'] == on) echo checked; ?> id="<?php echo $this->get_field_id( 'dividing-line' ); ?>" name="<?php echo $this->get_field_name( 'dividing-line' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'dividing-line' ); ?>"> Show Dividing Lines</label>
		<br />
			<input class="checkbox" type="checkbox" <?php if ($instance['view-all'] == on) echo checked; ?> id="<?php echo $this->get_field_id( 'view-all' ); ?>" name="<?php echo $this->get_field_name( 'view-all' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'view-all' ); ?>"> Show "View All" Link</label>
		</p>

		</div>		
		<div style="float:left;width:210px">
		<p style="font-weight:bold;text-decoration:underline;">Widget Appearance</p>
		<p>
			<select id="<?php echo $this->get_field_id( 'widget-style' ); ?>" name="<?php echo $this->get_field_name( 'widget-style' ); ?>">
				<option value="Style 1" <?php if ( 'Style 1' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 1</option>
				<option value="Style 2" <?php if ( 'Style 2' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 2</option>
				<option value="Style 3" <?php if ( 'Style 3' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 3</option>
				<option value="Style 4" <?php if ( 'Style 4' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 4</option>
				<option value="Style 5" <?php if ( 'Style 5' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 5</option>
				<option value="Style 6" <?php if ( 'Style 6' == $instance['widget-style'] ) echo 'selected="selected"'; ?>>Style 6</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'category-photo-size' ); ?>">Widget Style</label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php if ($instance['custom-colors'] == "snoccon") echo checked; ?> id="<?php echo $this->get_field_id( 'custom-colors' ); ?>" name="<?php echo $this->get_field_name( 'custom-colors' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'custom-colors' ); ?>">Turn on Custom Widget Colors</label>			
		</p>
		<p>Save this widget to make the color selector active.</p>
<?php $number = $this->number; ?>

		<p>
			<select id="<?php echo $this->get_field_id( 'widget-gradient' ); ?>" name="<?php echo $this->get_field_name( 'widget-gradient' ); ?>">
				<option value="On" <?php if ( 'On' == $instance['widget-gradient'] ) echo 'selected="selected"'; ?>>Gradient</option>
				<option value="Off" <?php if ( 'Off' == $instance['widget-gradient'] ) echo 'selected="selected"'; ?>>Pattern</option>
				<option value="None" <?php if ( 'None' == $instance['widget-gradient'] ) echo 'selected="selected"'; ?>>None</option>
			</select> Header Overlay<br />
			
			<?php $sno_id_base = $this->id_base; ?>
			<?php $selectid = 'widget-'.$sno_id_base.'-'.$number.'-widget-pattern'; ?>
			<?php $selectname = 'widget-'.$sno_id_base.'['.$number.']'; ?>
			<?php $value = $instance['widget-pattern']; ?>

			<?php sno_widget_pattern_selectbox($selectid, $selectname, $value, 'widget-pattern'); ?> Header Pattern<br />

			<input class="colorwellaudio<?php echo $number; ?>" id="<?php echo $this->get_field_id('header-color'); ?>" name="<?php echo $this->get_field_name('header-color'); ?>" type="text" maxlength="7" size="7" value="<?php echo $instance['header-color']; ?>" /> Header Bar <br />
			<input class="colorwellaudio<?php echo $number; ?>" id="<?php echo $this->get_field_id('header-text'); ?>" name="<?php echo $this->get_field_name('header-text'); ?>" type="text" maxlength="7" size="7" value="<?php echo $instance['header-text']; ?>" /> Header Bar Text<br />
			<input class="colorwellaudio<?php echo $number; ?>" id="<?php echo $this->get_field_id('widget-border'); ?>" name="<?php echo $this->get_field_name('widget-border'); ?>" type="text" maxlength="7" size="7" value="<?php echo $instance['widget-border']; ?>" /> Border<br />
			<input class="colorwellaudio<?php echo $number; ?>" id="<?php echo $this->get_field_id('widget-background'); ?>" name="<?php echo $this->get_field_name('widget-background'); ?>" type="text" maxlength="7" size="7" value="<?php echo $instance['widget-background']; ?>" /> Background
		</p>
<script>
		  jQuery(document).ready(function() {
    var f = jQuery.farbtastic('#snocolorpickeraudio<?php echo $number; ?>');
    var p = jQuery('#snocolorpickeraudio<?php echo $number; ?>').css('opacity', 0.25);
    var selected;
    jQuery('.colorwellaudio<?php echo $number; ?>')
      .each(function () { f.linkTo(this); jQuery(this).css('opacity', 0.75); })
      .focus(function() {
        if (selected) {
          jQuery(selected).css('opacity', 0.75).removeClass('colorwell-selected');          
        }
        f.linkTo(this);
        p.css('opacity', 1);
        jQuery(selected = this).css('opacity', 1).addClass('colorwell-selected');
      });

  });

 
  jQuery(document).ready(function() {
    jQuery('#snocolorpickeraudio<?php echo $number; ?>').hide();
    jQuery('#snocolorpickeraudio<?php echo $number; ?>').farbtastic(".colorwellaudio<?php echo $number; ?>");
    jQuery(".colorwellaudio<?php echo $number; ?>").click(function(){jQuery('#snocolorpickeraudio<?php echo $number; ?>').slideDown()});
  });
</script>
		<div id="snocolorpickeraudio<?php echo $number; ?>"></div>
        <p>
			<select id="<?php echo $this->get_field_id( 'border-thickness' ); ?>" name="<?php echo $this->get_field_name( 'border-thickness' ); ?>">
				<option value="0px" <?php if ( '0px' == $instance['border-thickness'] ) echo 'selected="selected"'; ?>>0px</option>
				<option value="1px" <?php if ( '1px' == $instance['border-thickness'] ) echo 'selected="selected"'; ?>>1px</option>
				<option value="2px" <?php if ( '2px' == $instance['border-thickness'] ) echo 'selected="selected"'; ?>>2px</option>
				<option value="3px" <?php if ( '3px' == $instance['border-thickness'] ) echo 'selected="selected"'; ?>>3px</option>
				<option value="4px" <?php if ( '4px' == $instance['border-thickness'] ) echo 'selected="selected"'; ?>>4px</option>
				<option value="5px" <?php if ( '5px' == $instance['border-thickness'] ) echo 'selected="selected"'; ?>>5px</option>
				<option value="6px" <?php if ( '6px' == $instance['border-thickness'] ) echo 'selected="selected"'; ?>>6px</option>
				<option value="7px" <?php if ( '7px' == $instance['border-thickness'] ) echo 'selected="selected"'; ?>>7px</option>
				<option value="8px" <?php if ( '8px' == $instance['border-thickness'] ) echo 'selected="selected"'; ?>>8px</option>
				<option value="9px" <?php if ( '9px' == $instance['border-thickness'] ) echo 'selected="selected"'; ?>>9px</option>
				<option value="10px" <?php if ( '10px' == $instance['border-thickness'] ) echo 'selected="selected"'; ?>>10px</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'border-thickness' ); ?>"> Border Thickness</label>
		</p>
			<p>
			<span style="font-weight:bold">Style 2 Additional Options</span><br />
			<select id="<?php echo $this->get_field_id( 'widget-indent' ); ?>" name="<?php echo $this->get_field_name( 'widget-indent' ); ?>">
				<option value="On" <?php if ( 'On' == $instance['widget-indent'] ) echo 'selected="selected"'; ?>>On</option>
				<option value="Off" <?php if ( 'Off' == $instance['widget-indent'] ) echo 'selected="selected"'; ?>>Off</option>
			</select> Title Indent<br />

			<select id="<?php echo $this->get_field_id( 'border-thickness2' ); ?>" name="<?php echo $this->get_field_name( 'border-thickness2' ); ?>">
				<option value="0px" <?php if ( '0px' == $instance['border-thickness2'] ) echo 'selected="selected"'; ?>>0px</option>
				<option value="1px" <?php if ( '1px' == $instance['border-thickness2'] ) echo 'selected="selected"'; ?>>1px</option>
				<option value="2px" <?php if ( '2px' == $instance['border-thickness2'] ) echo 'selected="selected"'; ?>>2px</option>
				<option value="3px" <?php if ( '3px' == $instance['border-thickness2'] ) echo 'selected="selected"'; ?>>3px</option>
				<option value="4px" <?php if ( '4px' == $instance['border-thickness2'] ) echo 'selected="selected"'; ?>>4px</option>
				<option value="5px" <?php if ( '5px' == $instance['border-thickness2'] ) echo 'selected="selected"'; ?>>5px</option>
				<option value="6px" <?php if ( '6px' == $instance['border-thickness2'] ) echo 'selected="selected"'; ?>>6px</option>
				<option value="7px" <?php if ( '7px' == $instance['border-thickness2'] ) echo 'selected="selected"'; ?>>7px</option>
				<option value="8px" <?php if ( '8px' == $instance['border-thickness2'] ) echo 'selected="selected"'; ?>>8px</option>
				<option value="9px" <?php if ( '9px' == $instance['border-thickness2'] ) echo 'selected="selected"'; ?>>9px</option>
				<option value="10px" <?php if ( '10px' == $instance['border-thickness2'] ) echo 'selected="selected"'; ?>>10px</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'border-thickness' ); ?>"> Border (Header Bottom)</label><br />

			<select id="<?php echo $this->get_field_id( 'widget-padding' ); ?>" name="<?php echo $this->get_field_name( 'widget-padding' ); ?>">
				<option value="On" <?php if ( 'On' == $instance['widget-padding'] ) echo 'selected="selected"'; ?>>On</option>
				<option value="Off" <?php if ( 'Off' == $instance['widget-padding'] ) echo 'selected="selected"'; ?>>Off</option>
			</select> Widget Body Padding<br />
		</p>

		</div><div style="clear:both"></div>

		
	<?php 
	}
}
?>