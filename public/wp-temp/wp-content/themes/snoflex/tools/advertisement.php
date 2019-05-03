<?php function sno_image_upload_scripts() {

	global $pagenow, $wp_customize;

	if ( 'widgets.php' === $pagenow || isset( $wp_customize ) ) {

		wp_enqueue_media();
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'sno-image-upload', get_template_directory_uri() . '/javascript/upload.js', array( 'jquery' ) );

	}

}
add_action( 'admin_enqueue_scripts', 'sno_image_upload_scripts' );


/**
 * Image Upload Widget
 */
class SNO_Advertisement_Widget extends WP_Widget {

    // Holds widget settings defaults, populated in constructor.
	protected $defaults;

    // Constructor. Set the default widget options and create widget.
	function __construct() {

		$this->defaults = array(
			'title' => '',
			'image' => '',
			'link'  => '',
			);

		$widget_ops = array(
			'classname'   => 'rightad',
			'description' => __( '(SNO) Advertisement', 'sno' ),
			);

		$control_ops = array(
			'id_base' => 'rightad',
			'width'   => 200,
			'height'  => 250,
			);

		parent::__construct( 'rightad', __( '(SNO) Advertisement', 'sno' ), $widget_ops, $control_ops );

	}

    // The widget content.
	function widget($args, $instance) 
	{
		extract($args); $customcolors=$instance['custom-colors']; $showtitle=$instance['show-title'];

		$unique = $this->id; 
		
		if(!empty($instance['ad_url'])) 
		{ 

			$shadow = '';
			if ($instance['hide-shadow'] == 'Hide' && get_theme_mod('widget-shadows') == 'On') {
				$shadow = "box-shadow: none;";
			} else if ($instance['hide-shadow'] == 'Show' && get_theme_mod('widget-shadows') != 'On') {
				$shadow = "box-shadow: -1px 0 2px 0 rgba(0, 0, 0, 0.12), 1px 0 2px 0 rgba(0, 0, 0, 0.12), 0 1px 1px 0 rgba(0, 0, 0, 0.24);";
			}

			echo "<div class='widgetwrap sno-animate sno-$unique' style='$shadow'>";

			if ($showtitle=='on') 
			{ 
				echo '<h4 ';
				if ($customcolors=="snoccon")
				{
					echo 'style="background: '.$instance['header-color'].' !important;"';
				}
				echo ' class="widget3">';
				echo $instance['title'];
				echo '</h4>';
			} ?>
			
			<?php 
				$imageid = sno_get_image_id( $instance['ad_url'] );
				$alt_text = get_post_field('post_excerpt', $imageid);
				if ($alt_text == '') $alt_text = 'Advertisement';
			?>
			<div class="widgetbody3" <?php if ($customcolors=="snoccon") { ?> style="background:<?php echo $instance['widget-background']; ?> !important;"<?php } echo '>';

			if(!empty($instance['link_url'])) { ?>
			<div class="advertisementwrap" style="margin:0px auto;max-width:100%">
				<?php 	$adurl = $instance['ad_url']; 
						if (is_ssl()) {
							$adurl = str_replace("http://", "https://", $adurl); 
						} else {
							$adurl = str_replace("https://", "http://", $adurl); 
						}
				?>
				<a target="_blank" href="<?php echo $instance['link_url']; ?>"><img src="<?php echo $adurl; ?>"  alt="<?php echo $alt_text; ?>" class="centered" style="max-width:100%" /></a>
			</div>
			<?php } else if(!empty($instance['ad_url'])) { ?>
				<?php 	$adurl = $instance['ad_url']; 
						if (is_ssl()) {
							$adurl = str_replace("http://", "https://", $adurl); 
						} else {
							$adurl = str_replace("https://", "http://", $adurl); 
						}
				?>
			<div class="advertisementwrap" style="margin:0px auto;max-width:100%">
				<img src="<?php echo $adurl; ?>" class="centered" alt="<?php echo $alt_text; ?>" style="max-width:100%" />
			</div>
			<?php } 

			echo '</div>';

			if ($showtitle=='on')
			{ 
				echo '<div style="display:block !important; background:';
				if ($instance['custom-colors'] == "snoccon") 
				{ 
					echo $instance['header-color'];
				}
				else 
				{
					echo get_theme_mod('widgetcolor3');
				}
				echo ' !important;" class="widgetfooter3"></div>';
			} 

			echo '<div class="clear"></div>';
			echo '</div>';
		}
	}

    // Update a particular instance.
	function update($new_instance, $old_instance) {

		// let's add some code to force LiteSpeed to flush its cache when the widget is saved

		if ( is_plugin_active( 'litespeed-cache/litespeed-cache.php' ) ) {
			LiteSpeed_Cache_API::purge_all();
		}

		// cool, that's done

		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['text'] = $new_instance['text'];
		$instance['widget-style'] = $new_instance['widget-style'];
		$instance['custom-colors'] = ( isset( $new_instance['custom-colors'] ) ? "snoccon" : "" );  
		$instance['header-color'] = $new_instance['header-color'];
		$instance['header-text'] = $new_instance['header-text'];
		$instance['widget-border'] = $new_instance['widget-border'];
		$instance['widget-background'] = $new_instance['widget-background'];
		$instance['border-thickness'] = $new_instance['border-thickness'];
		$instance['sidebarname'] = $new_instance['sidebarname'];
		$instance['ad_url'] = $new_instance['ad_url'];
		$instance['link_url'] = $new_instance['link_url'];
		$instance['sidebarsize'] = $new_instance['sidebarsize'];
		$instance['adwidth'] = $new_instance['adwidth'];
		$instance['show-title'] = $new_instance['show-title'];
		$instance['widget-gradient'] = $new_instance['widget-gradient'];
		$instance['widget-pattern'] = $new_instance['widget-pattern'];
		$instance['hide-shadow'] = $new_instance['hide-shadow'];
		return $instance;
	}

    // The settings update form.

	function form($instance) { 
		$defaults = array( 'header-color' => get_theme_mod('widgetcolor1'), 'header-text' => get_theme_mod('widgetcolor1-text'), 'widget-border' => '#aaaaaa', 'widget-background' => '#eeeeee', 'hide-shadow' => 'Use Default' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$random = mt_rand(); $disable_js = ''; $hide_all = '';
		$number = $this->number;

		$check = $this->number; $currentScreen = get_current_screen(); 
		if ($check == '__i__' && $currentScreen->id === "widgets"){
			echo '<div class="not_saved">';
			?><script type="text/javascript">
				initwidgetad = setInterval(function() {
					$('.widget-control-save').prop("disabled", false); // Saving is now enabled.
					$('.widget-control-save').val("Save"); 
					clearInterval(initwidgetad)		
   				}, 1000);
			</script><?php
			echo '<p>Hit the Save button, pardner, and we\'ll get this party started.</p>';
			echo '</div>';
			$hide_all = ' style="display:none;"';
		}

		if ($check == '__i__' ) { $disable_js = 'on'; } /* disable javascript here */
		?>
		<div class="hide_all"<?php echo $hide_all; ?>>

			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title"); ?>:</label><br />
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ($instance['title'])) echo $instance['title']; ?>" style="width:95%;" type="text" />
			</p>

			<p>Upload your ad by clicking the button below. After the image uploads, make sure the "Full Size" option is selected and then click "Insert into Post."
			</p>
			<p>
				<div class="wpshed-media-container">
					<div class="wpshed-media-inner">
						<?php $img_style = ( $instance[ 'ad_url' ] != '' ) ? '' : 'style="display:none;"'; ?>
						<img id="<?php echo $this->get_field_id( 'ad_url' ); ?>-preview" src="<?php echo esc_attr( $instance['ad_url'] ); ?>" <?php echo $img_style; ?> />
						<?php $no_img_style = ( $instance[ 'ad_url' ] != '' ) ? 'style="display:none;"' : ''; ?>
						<span class="wpshed-no-image" id="<?php echo $this->get_field_id( 'ad_url' ); ?>-noimg" <?php echo $no_img_style; ?>><?php _e( 'No image selected', 'sno' ); ?></span>
					</div>

					<input type="text" id="<?php echo $this->get_field_id( 'ad_url' ); ?>" name="<?php echo $this->get_field_name( 'ad_url' ); ?>" value="<?php echo esc_attr( $instance['ad_url'] ); ?>" class="wpshed-media-url" />

					<input type="button" value="<?php echo _e( 'Remove', 'sno' ); ?>" class="button wpshed-media-remove" id="<?php echo $this->get_field_id( 'ad_url' ); ?>-remove" <?php echo $img_style; ?> />

					<?php $button_text = ( $instance[ 'ad_url' ] != '' ) ? __( 'Change Image', 'sno' ) : __( 'Select Image', 'sno' ); ?>
					<input type="button" value="<?php echo $button_text; ?>" class="button wpshed-media-upload" id="<?php echo $this->get_field_id( 'ad_url' ); ?>-button" />
					<br class="clear">
				</div>
			</p>


			<p>
				<label for="<?php echo $this->get_field_id('link_url'); ?>"><?php _e('Advertisement Link'); ?>:</label><br />
				<input id="<?php echo $this->get_field_id('link_url'); ?>" name="<?php echo $this->get_field_name('link_url'); ?>" style="width: 95%;" value="<?php echo $instance['link_url']; ?>" type="text" />
			</p>


			<p>
				<input class="checkbox" type="checkbox" <?php if ($instance['show-title'] == 'on') echo 'checked'; ?> id="<?php echo $this->get_field_id( 'show-title' ); ?>" name="<?php echo $this->get_field_name( 'show-title' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show-title' ); ?>">Show Title Bar</label>			
			</p>

			<p>
				<input class="customoptionscheckbox<?php echo $random; ?>" type="checkbox" <?php if ($instance['custom-colors'] == "snoccon") echo 'checked'; ?> id="<?php echo $this->get_field_id( 'custom-colors' ); ?>" name="<?php echo $this->get_field_name( 'custom-colors' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'custom-colors' ); ?>">Turn on Custom Widget Colors</label>			
			</p>

			<div class="customoptions<?php echo $random; ?>">

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
			</div>

			<p>
				<select class="hideshadow<?php echo $random; ?>" id="<?php echo $this->get_field_id( 'hide-shadow' ); ?>" name="<?php echo $this->get_field_name( 'hide-shadow' ); ?>">
					<option value="Use Default" <?php if ( 'Use Default' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Use Default</option>
					<option value="Hide" <?php if ( 'Hide' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Hide</option>
					<option value="Show" <?php if ( 'Show' == $instance['hide-shadow'] ) echo 'selected="selected"'; ?>>Show</option>
				</select>
				
			 Widget Drop Shadow</p>
		</div>


		<script>
		jQuery('.customoptionscheckbox<?php echo $random; ?>').change(function() {
			jQuery('.customoptions<?php echo $random; ?>').slideToggle('slow');
		});

		if (jQuery('.customoptionscheckbox<?php echo $random; ?>').prop('checked')) {
			jQuery(".customoptions<?php echo $random; ?>").show();
		} else {
			jQuery(".customoptions<?php echo $random; ?>").hide();
		}

		jQuery(document).ready(function($) {
			$('.my-color-picker').wpColorPicker();
		});
		jQuery('.my-color-picker').wpColorPicker();
		</script>
		<?php 
	}
} 

/**
 * Register Widget
 */
function register_sno_advertisement_widget() { 
	register_widget( 'SNO_Advertisement_Widget' ); 
} 
add_action( 'widgets_init','register_sno_advertisement_widget' );
