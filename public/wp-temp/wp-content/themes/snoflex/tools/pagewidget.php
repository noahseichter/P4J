<?php

add_action('widgets_init', create_function('', "register_widget('sno_page');"));
class sno_page extends WP_Widget {

	function __construct() {

		$this->defaults = array(
			'title' => '',
			'image' => '',
			'link'  => ''
			);

		$widget_ops = array(
			'classname' => 'SNO Page Display',
			'description' => __( 'Let\'s be honest. You don\'t need this widget. Just pretend it\'s not here.' )
			);

		$control_ops = array(
			'id_base' => 'page'
			);

		parent::__construct( 'page', __( 'SNO Page Display' ), $widget_ops, $control_ops );

	}


	function widget($args, $instance) {
		extract($args);
		if ($instance['page'] == "") {} else {

				$widget = $this->id; $sidebartest = get_option('sidebars_widgets'); 
				$columns = get_theme_mod('sno-layout'); 
					if (($columns == "Option 3") || ($columns == "Option 6")) { $columnwidth = "even"; } else { $columnwidth = "wide"; }
					
				if ($sidebartest["sidebar-1"]) foreach ($sidebartest["sidebar-1"] as $key => $value ) { 
					if ($widget == $value) {
						$instance['sidebarname'] = 'Non-Home Sidebar'; 
						}
				}
				if ($sidebartest["sidebar-2"]) foreach ($sidebartest["sidebar-2"] as $key => $value ) { 
					if ($widget == $value) {
						$instance['sidebarname'] = 'Home Main Column'; 
						}
				}
				if ($sidebartest["sidebar-3"]) foreach ($sidebartest["sidebar-3"] as $key => $value ) { 
					if (($widget == $value) && ($columnwidth == "even")) {
						$instance['sidebarname'] = 'Home Bottom Left'; 
						}
					if (($widget == $value) && ($columnwidth == "wide")) {
						$instance['sidebarname'] = 'Home Bottom Narrow';
						}
				}
				if ($sidebartest["sidebar-4"]) foreach ($sidebartest["sidebar-4"] as $key => $value ) { 
					if (($widget == $value) && ($columnwidth == "even")) {
						$instance['sidebarname'] = 'Home Bottom Right'; 
						}
					if (($widget == $value) && ($columnwidth == "wide")) {
						$instance['sidebarname'] = 'Home Bottom Wide';
						}
				}
				if ($sidebartest["sidebar-5"]) foreach ($sidebartest["sidebar-5"] as $key => $value ) { 
					if ($widget == $value) {
						$instance['sidebarname'] = 'Home Sidebar'; 
						}
				}
				if ($sidebartest["sidebar-6"]) foreach ($sidebartest["sidebar-6"] as $key => $value ) { 
					if ($widget == $value) {
						$instance['sidebarname'] = 'Sports Center Sidebar';
						} 
				}
				if ( isset ($sidebartest["sidebar-7"]) && $sidebartest["sidebar-7"]) foreach ($sidebartest["sidebar-7"] as $key => $value ) { 
					if ($widget == $value) {
						$instance['sidebarname'] = 'Home Bottom Left';
						} 
				}
				if ( isset ($sidebartest["sidebar-8"]) && $sidebartest["sidebar-8"]) foreach ($sidebartest["sidebar-8"] as $key => $value ) { 
					if ($widget == $value) {
						$instance['sidebarname'] = 'Home Bottom Right';
						} 
				}
				if ( isset ($sidebartest["sidebar-9"]) && $sidebartest["sidebar-9"]) foreach ($sidebartest["sidebar-9"] as $key => $value ) { 
					if ($widget == $value) {
						$instance['sidebarname'] = 'Home Sidebar';
						} 
				}

		$customcolors=$instance['custom-colors']; $categoryname = get_the_title($instance['page']); $categoryslug = get_permalink($instance['page']); $pageid=$instance['page']; $videotitle = '';
		

		$shadow = '';
		if ($instance['hide-shadow'] == 'Hide' && get_theme_mod('widget-shadows') == 'On') {
			$shadow = "box-shadow: none;";
		} else if ($instance['hide-shadow'] == 'Show' && get_theme_mod('widget-shadows') != 'On') {
			$shadow = "box-shadow: -1px 0 2px 0 rgba(0, 0, 0, 0.12), 1px 0 2px 0 rgba(0, 0, 0, 0.12), 0 1px 1px 0 rgba(0, 0, 0, 0.24);";
		}

				$widgetwrap_style = " style='$shadow'";
		

			echo "<div class='widgetwrap sno-animate sno-$widget'$widgetwrap_style>";

			echo sno_widget_styles($instance, $customcolors, $categoryslug, $videotitle, $categoryname); ?>

			<?php $the_query = new WP_Query( 'page_id=' . $instance['page'] );
while ( $the_query->have_posts() ) : $the_query->the_post(); 

				if (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Bottom Wide")) { $photowidth = "100%"; $thumbnailsize="home400"; }
				else if (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Main Column")) { $photowidth = "50%"; $thumbnailsize="permalink"; }
				else if ((($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Bottom Right")) || (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Bottom Left"))){ $photowidth = "100%"; $thumbnailsize="permalink"; }
				else if (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Bottom Narrow")) { $photowidth = "100%"; $thumbnailsize="permalink"; }
				else if ((($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Home Sidebar")) || (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Non-Home Sidebar")) || (($instance['category-photo-size'] == "Large") && ($instance['sidebarname'] == "Sports Center Sidebar"))) { $photowidth = "100%"; $thumbnailsize="permalink"; }
				
				else if ($instance['sidebarname'] == "Home Bottom Wide") { $photowidth = "33%"; $thumbnailsize="permalink"; } 
				else if ($instance['sidebarname'] == "Home Main Column") { $photowidth = "33%"; $thumbnailsize="permalink"; } 
				else if ($instance['sidebarname'] == "Home Bottom Narrow") { $photowidth = "100%"; $thumbnailsize="permalink"; } 
				else { $photowidth = "40%"; $thumbnailsize="permalink"; } 
								
				if ($photowidth=="") { $photowidth = "100%"; $thumbnailsize="permalink"; } ?>


						
					<?php if (has_post_thumbnail()) { 
						?><div class="catboxthumbnail" style="float:<?php echo $instance['category-photo-placement']; ?>; width: <?php echo 	$photowidth; ?>; margin-<?php echo $instance['category-photo-placement']; ?>:0px;"><?php
						
						$catimage = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium'); ?>
						<a href="<?php the_permalink(); ?>"><img src="<?php echo $catimage[0]; ?>" style="width:100%" class="catboxphoto" alt="<?php the_title(); ?>" /></a>
						</div>						
					<?php } ?>
						
					
			<?php
			
			$headlinesize = $instance['headline-size']; $headlineheight = floor($headlinesize * 1.5); ?>
  			<span style="font-size:<?php echo $headlinesize; ?>px; line-height:<?php echo $headlineheight; ?>px;"><?php $teaser = $instance['category-teaser']; 
  			if ($teaser) the_content_limit($teaser, " <span class='readmore'>Read More</span>"); ?></span>
   	 		<?php edit_post_link('Edit this page', '', ''); ?>
			<div style="clear:both"></div>

        <?php endwhile;
                 
        if ($instance['view-all']=='on') { ?>
			<?php if ($instance['dividing-line']=='on') { ?><div class="storybottom"></div><?php } else { ?><div class="storybottomnoline"></div><?php } ?>
					<a href="<?php echo get_permalink($instance['page']); ?>"><p class="viewall">View Page <span class="arrows"> &raquo;</span></p></a>
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
		$instance['widget-style'] = $new_instance['widget-style'];
 		$instance['custom-colors'] = ( isset( $new_instance['custom-colors'] ) ? "snoccon" : "" );  
		$instance['header-color'] = $new_instance['header-color'];
		$instance['header-text'] = $new_instance['header-text'];
		$instance['widget-border'] = $new_instance['widget-border'];
		$instance['widget-background'] = $new_instance['widget-background'];
		$instance['border-thickness'] = $new_instance['border-thickness'];
		$instance['page'] = $new_instance['page'];
		$instance['category-photo-placement'] = $new_instance['category-photo-placement'];
		$instance['category-photo-size'] = $new_instance['category-photo-size'];
		$instance['photowidth'] = $new_instance['photowidth'];
		$instance['sidebarname'] = $new_instance['sidebarname'];
		$instance['category-teaser'] = $new_instance['category-teaser'];
		$instance['headline-size'] = $new_instance['headline-size'];
 		$instance['dividing-line'] = ( isset( $new_instance['dividing-line'] ) ? on : "" );  
 		$instance['view-all'] = ( isset( $new_instance['view-all'] ) ? on : "" );  
		$instance['border-thickness2'] = $new_instance['border-thickness2'];
		$instance['widget-gradient'] = $new_instance['widget-gradient'];
		$instance['widget-padding'] = $new_instance['widget-padding'];
		$instance['widget-indent'] = $new_instance['widget-indent'];
		$instance['widget-pattern'] = $new_instance['widget-pattern'];
		$instance['widget-header-size'] = $new_instance['widget-header-size'];
		$instance['widget-expander'] = $new_instance['widget-expander'];
		$instance['center-title'] = $new_instance['center-title'];
		$instance['hide-shadow'] = $new_instance['hide-shadow'];
		return $instance;
	}

	function form($instance) { 
		$defaults = array( 'headline-size' => '18', 'category-photo-placement' => 'Left', 'category-photo-size' => 'Large', 'border-thickness' => '1px','category-teaser' => '170', 'widget-style'=>get_theme_mod('widget-style-sno'), 'header-color' => get_theme_mod('widgetcolor1'), 'header-text' => get_theme_mod('widgetcolor1-text'), 'widget-border' => '#aaaaaa', 'widget-background' => '#eeeeee', 'border-thickness' => '1px', 'border-thickness2' => '3px', 'widget-gradient' => 'On', 'widget-header-size' => 'Small', 'widget-expander' => '0px', 'hide-shadow' => 'Use Default' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$random = mt_rand(); $disable_js = ''; $hide_all = '';
		$number = $this->number;
		
		$check = $this->number; $currentScreen = get_current_screen(); 
if ($check == '__i__' && $currentScreen->id === "widgets"){
	echo '<div class="not_saved">';
		?><script type="text/javascript">
			initwidgetpage = setInterval(function() {
				$('.widget-control-save').prop("disabled", false); // Saving is now enabled.
				$('.widget-control-save').val("Save"); 
				clearInterval(initwidgetpage)		
   			}, 1000);
		</script><?php
		echo '<p>Hit the Save button, pardner, and we\'ll get this party started.</p>';
	echo '</div>';
	$hide_all = ' style="display:none;"';
		
}
if ($check == '__i__' ) { $disable_js = 'on'; } // disable javascript here

?>
<div class="hide_all"<?php echo $hide_all; ?>>

		<p>Select your page.<br />
			<?php wp_dropdown_pages(array('selected' => $instance['page'], 'name' => $this->get_field_name( 'page' ), 'orderby' => 'Name' , 'show_option_none' => __("None", 'studiopress') )); ?>
		</p>

				<div style="width:210px;border-bottom:1px solid #aaaaaa;margin-bottom:10px;"></div>

		<p>
			<select id="<?php echo $this->get_field_id( 'category-photo-placement' ); ?>" name="<?php echo $this->get_field_name( 'category-photo-placement' ); ?>">
				<option value="Left" <?php if ( 'Left' == $instance['category-photo-placement'] ) echo 'selected="selected"'; ?>>Left</option>
				<option value="Right" <?php if ( 'Right' == $instance['category-photo-placement'] ) echo 'selected="selected"'; ?>>Right</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'category-photo-placement' ); ?>">Photo Placement</label>
		<br />
			<select id="<?php echo $this->get_field_id( 'category-photo-size' ); ?>" name="<?php echo $this->get_field_name( 'category-photo-size' ); ?>">
				<option value="Small" <?php if ( 'Small' == $instance['category-photo-size'] ) echo 'selected="selected"'; ?>>Small</option>
				<option value="Large" <?php if ( 'Large' == $instance['category-photo-size'] ) echo 'selected="selected"'; ?>>Large</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'category-photo-size' ); ?>">Photo Size</label>
		<br />


			<select id="<?php echo $this->get_field_id( 'headline-size' ); ?>" name="<?php echo $this->get_field_name( 'headline-size' ); ?>">
				<option value="12" <?php if ( '12' == $instance['headline-size'] ) echo 'selected="selected"'; ?>>12</option>
				<option value="14" <?php if ( '14' == $instance['headline-size'] ) echo 'selected="selected"'; ?>>14</option>
				<option value="16" <?php if ( '16' == $instance['headline-size'] ) echo 'selected="selected"'; ?>>16</option>
				<option value="18" <?php if ( '18' == $instance['headline-size'] ) echo 'selected="selected"'; ?>>18</option>
				<option value="20" <?php if ( '20' == $instance['headline-size'] ) echo 'selected="selected"'; ?>>20</option>
				<option value="22" <?php if ( '22' == $instance['headline-size'] ) echo 'selected="selected"'; ?>>22</option>
			</select>
			<label for="<?php echo $this->get_field_id( 'headline-size' ); ?>">Text Size</label>
		<br />
		<input id="<?php echo $this->get_field_id('category-teaser'); ?>" name="<?php echo $this->get_field_name('category-teaser'); ?>" type="text" maxlength="3" size="3" value="<?php echo $instance['category-teaser']; ?>" />
		<label for="<?php echo $this->get_field_id('category-teaser'); ?>">Teaser Length (characters)</label>

		<br />
		<input class="checkbox" type="checkbox" <?php if ($instance['dividing-line'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'dividing-line' ); ?>" name="<?php echo $this->get_field_name( 'dividing-line' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'dividing-line' ); ?>"> Show Dividing Line</label><br />

			<input class="checkbox" type="checkbox" <?php if ($instance['view-all'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'view-all' ); ?>" name="<?php echo $this->get_field_name( 'view-all' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'view-all' ); ?>"> Show "View Page" Link</label>

		</p>

		
		<div class="widgetdivider"></div>
		
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


	</script>
	<?php } ?>
	</div>

	<?php 
	}

}
?>